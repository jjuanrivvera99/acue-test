@extends('layouts.dashboard')

@section('content')
<div class="d-flex flex-stack mb-5">
    <!--begin::Search-->
    <div class="d-flex align-items-center position-relative my-1">
        <span class="svg-icon svg-icon-2">...</span>
        <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15"
            placeholder="Search courses" />
    </div>
    <!--end::Search-->

    <!--begin::Toolbar-->
    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
        <!--begin::Add customer-->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
            Send report
        </button>
        <!--end::Add customer-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Wrapper-->

<!--begin::Datatable-->
<table id="datatable" class="table align-middle table-row-dashed fs-6 gy-5">
    <thead>
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th>ID</th>
            <th>Name</th>
            <th>Course Code</th>
            <th>Workflow state</th>
            <th>Start at</th>
            <th>End at</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
    </tbody>
</table>
<!--end::Datatable-->

<!--begin::Modal - SendReport -->
<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <form id="report" action="/api/courses/report">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Send Report</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">
                    <!--begin::Input group-->
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input name="email" type="email" class="form-control fv-row" placeholder="Email" aria-label="Email"/>
                    </div>
                    <!--end::Input group-->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button id="submit" type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Send
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--end::Modal - SendReport -->
@endsection

@section('scripts')
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/js/custom/courses/datatable.js"></script>
    <script src="assets/js/custom/courses/report.js"></script>
@endsection
