@extends('layouts.app')
@section('pageTitle')
    Edit Inspection Report
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
                                <form action="{{route('update_inspection_reports')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$inspection_report->id}}">
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
                                                    <option
                                                        {{$inspection_report->site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
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
                                                  placeholder="">{{$inspection_report->description}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Report Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="report_type" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($reportTypeArr as $reportType)
                                                    <option
                                                        {{$inspection_report->reportType == $reportType ? 'selected' : ''}} value="{{$reportType}}">{{$reportType}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Completion Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="completion_date"
                                               value="{{$inspection_report->completion_date}}"/>
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
                                                <option
                                                    {{$inspection_report->status == $status ? 'selected' : ''}} value="{{$status}}">{{$status}}</option>
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
                                               value="{{$inspection_report->next_due_date}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Attachment 1</label>
                                        <a class="mb-3" target="_blank"
                                           href="{{asset('uploads/inspection_reports')}}/{{$inspection_report->attachment_1}}">{{$inspection_report->attachment_1}}</a>
                                        <input type="hidden" name="old_attachment_1"
                                               value="{{$inspection_report->attachment_1}}">
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_1"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment 2 (If Any)</label>
                                        <a class="mb-3" target="_blank"
                                           href="{{asset('uploads/inspection_reports')}}/{{$inspection_report->attachment_2}}">{{$inspection_report->attachment_2}}</a>
                                        <input type="hidden" name="old_attachment_2"
                                               value="{{$inspection_report->attachment_2}}">
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_2"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment 3 (If Any)</label>
                                        <a class="mb-3" target="_blank"
                                           href="{{asset('uploads/inspection_reports')}}/{{$inspection_report->attachment_3}}">{{$inspection_report->attachment_3}}</a>
                                        <input type="hidden" name="old_attachment_3"
                                               value="{{$inspection_report->attachment_3}}">
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_3"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Remarks</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="remarks"
                                                  placeholder="">{{$inspection_report->remarks}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Update</span>
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
