@extends('layouts.app')
@section('pageTitle')
    Add Inspection Report
@endsection
@section('content')
    <!--begin::Content-->
    <div class="container-xxl" id="kt_content_container">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Container-->
            <div class="container-xxl" id="kt_content_container">
                <!--begin::Careers - Apply-->
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body p-lg-17">
                        <!--begin::Layout-->
                        <div class="d-flex flex-column flex-lg-row mb-17">

                            <!--begin::Content-->
                            <div class="flex-lg-row-fluid me-0 me-lg-20">
                                @if($errors->any())
                                    <div class="alert alert-outline-danger alert-dismissible fade show" role="alert">
                                        <ul class="list-group">
                                            @foreach($errors->all() as $error)
                                                <li class="list-group-item text-danger">
                                                    {{$error}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('success'))

                                    <div class="alert alert-success" role="alert">
                                        {{session()->get('success')}}
                                    </div>

                                @endif
                                <!--begin::Form-->
                                <form action="{{route('store_inspection_reports')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option value="{{$site}}">{{$site}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Description</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="description"
                                                  placeholder="">{{old('description')}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Report Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            {{--                                            <select name="report_type" id="report_type-select" data-control="select2"--}}
                                            {{--                                                    data-placeholder="Select a position..."--}}
                                            {{--                                                    class="form-select form-select-solid">--}}
                                            {{--                                                @foreach($reportTypeArr as $reportType)--}}
                                            {{--                                                    <option value="{{$reportType}}">{{$reportType}}</option>--}}
                                            {{--                                                @endforeach--}}
                                            {{--                                                <option value="add_new">Add New</option> <!-- Add New option -->--}}
                                            {{--                                            </select>--}}

                                            <select id="report-type-select" name="report_type"
                                                    class="form-select form-select-solid add-new-select"
                                                    data-api-url="/add-report-type"
                                                    data-placeholder="Enter new report type">
                                                @foreach($reportTypeArr as $reportType)
                                                    <option value="{{ $reportType }}">{{ $reportType }}</option>
                                                @endforeach
                                                <option value="add_new">Add New</option>
                                            </select>

                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!-- Popup Modal -->
                                    <div id="add-report-type-modal" class="modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Report Type</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" id="new-report-type-name" class="form-control"
                                                           placeholder="Enter new Report Type">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="save-report-type-btn"
                                                            class="btn btn-primary">Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Completion Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="completion_date"
                                               value="{{old('completion_date')}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Status</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="status" data-control="select2"
                                                data-placeholder="Select a Status..."
                                                class="form-select form-select-solid">
                                            @foreach($statusArr as $status)
                                                <option value="{{$status}}">{{$status}}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Next Due Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="next_due_date"
                                               value="{{old('next_due_date')}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Attachment 1</label>
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_1"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment 2 (If Any)</label>
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_2"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment 3 (If Any)</label>
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_3"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Remarks</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="remarks"
                                                  placeholder="">{{old('remarks')}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Save</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
													<span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Submit-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Layout-->

                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Careers - Apply-->
            </div>
            <!--end::Container-->
        </div>
    </div>
    <!--end::Content-->
@endsection

@section('scripts')
    {{--    <script>--}}
    {{--        jQuery(document).ready(function ($) {--}}
    {{--            $('#report_type-select').on('change', function () {--}}
    {{--                if ($(this).val() === 'add_new') {--}}
    {{--                    $('#add-report-type-modal').modal('show');--}}
    {{--                }--}}
    {{--            });--}}

    {{--            $('#save-report-type-btn').on('click', function () {--}}
    {{--                var newReportType = $('#new-report-type-name').val().trim();--}}

    {{--                if (newReportType) {--}}
    {{--                    $.ajax({--}}
    {{--                        url: '/add-report-type',--}}
    {{--                        type: 'POST',--}}
    {{--                        data: {--}}
    {{--                            _token: $('meta[name="csrf-token"]').attr('content'),--}}
    {{--                            report_type: newReportType--}}
    {{--                        },--}}
    {{--                        success: function (response) {--}}
    {{--                            if (response.success) {--}}
    {{--                                alert('ReportType added successfully!');--}}

    {{--                                // Add the new ReportType to the dropdown list dynamically--}}
    {{--                                $('#report_type-select').append('<option value="' + newReportType + '">' + newReportType + '</option>');--}}

    {{--                                // Select the new ReportType--}}
    {{--                                $('#report_type-select').val(newReportType).trigger('change');--}}

    {{--                                // Close the modal--}}
    {{--                                $('#add-report-type-modal').modal('hide');--}}
    {{--                            } else {--}}
    {{--                                alert('Failed to add ReportType.');--}}
    {{--                            }--}}
    {{--                        },--}}
    {{--                        error: function (xhr, status, error) {--}}
    {{--                            console.error('Error:', error);--}}
    {{--                            alert('An error occurred. Please try again.');--}}
    {{--                        }--}}
    {{--                    });--}}
    {{--                } else {--}}
    {{--                    alert('Please enter a valid Report Type name.');--}}
    {{--                }--}}
    {{--            });--}}

    {{--        });--}}
    {{--    </script>--}}

@endsection
