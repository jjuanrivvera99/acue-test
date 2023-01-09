<x-mail::message>
# Available Courses

<x-mail::table>
| ID       | Name         | Course Code  |
| ------------- |:-------------:| --------:|
@foreach ($courses as $course)
| {{ $course['id'] }} | {{ $course['name'] }} | {{ $course['course_code'] }} |
@endforeach
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
