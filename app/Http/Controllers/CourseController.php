<?php

namespace App\Http\Controllers;

use Arr;
use DataTables;
use App\Mail\Report;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
    /**
     * Get courses.
     * @return Collection
     */
    private function getCourses()
    {
        // Get courses from API
        $response = Http::get('https://lmstest.acue.org/ACUE-microcourselist.json')->collect();

        // Filter the attributes we want
        return $response->map(function ($course) {
            return Arr::only($course, ['id', 'name', 'course_code', 'workflow_state']);
        });
    }

    /**
     * Get courses for datatable.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(CourseRequest $request)
    {
        return DataTables::of($this->getCourses())->toJson();
    }

    /**
     * Send report via email.
     * @param ReportRequest $request
     * @return JsonResponse
     */
    public function sendReport(ReportRequest $request)
    {
        $state = $request->state;

        // Get courses
        $data = $this->getCourses();

        // Filter courses by state
        $courses = $data->filter(function ($course) use ($state) {
            return $course['workflow_state'] === $state;
        });

        // Send email
        Mail::to($request->email)->send(new Report($courses));

        return response()->json(['message' => 'Report sent successfully.']);
    }
}
