@extends('layouts.app')
@section('pageTitle')
    Edit Audit Schedule
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
                                <form action="{{route('update_audit_schedule')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$audit_schedule->id}}">
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option
                                                        {{$audit_schedule->site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Audit ID</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="audit_id"
                                                   value="{{$audit_schedule->audit_id}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Audit Type</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="audit_type" data-control="select2"
                                                data-placeholder="Select a Audit Type..."
                                                class="form-select form-select-solid">
                                            @foreach($auditTypeArr as $auditType)
                                                <option
                                                    {{$audit_schedule->audit_type == $auditType ? 'selected' : ''}} value="{{$auditType}}">{{$auditType}}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Sub Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="sub_type" data-control="select2"
                                                    data-placeholder="Select a Sub Type..."
                                                    class="form-select form-select-solid">
                                                @foreach($subTypeArr as $subType)
                                                    <option
                                                        {{$audit_schedule->sub_type == $subType ? 'selected' : ''}} value="{{$subType}}">{{$subType}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Start Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="start_date"
                                                   value="{{$audit_schedule->start_date}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Acutal Audit Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="dates"
                                               value="{{$audit_schedule->dates}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Audit Schedule</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="hidden" name="old_audit_schedule"
                                                   value="{{$audit_schedule->audit_schedule}}">
                                            <input type="file" name="audit_schedule"
                                                   class="form-control form-control-solid">
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Audit Checklist (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="hidden" name="old_audit_checklist"
                                                   value="{{$audit_schedule->audit_checklist}}">
                                            <input type="file" name="audit_checklist"
                                                   class="form-control form-control-solid">
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Audit Year</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="audit_year" data-control="select2"
                                                    data-placeholder="Select a Audit Year..."
                                                    class="form-select form-select-solid">
                                                @foreach($auditYearArr as $auditYear)
                                                    <option
                                                        {{$audit_schedule->audit_year == $auditYear ? 'selected' : ''}} value="{{$auditYear}}">{{$auditYear}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Status</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="status" data-control="select2"
                                                    data-placeholder="Select a Status..."
                                                    class="form-select form-select-solid">
                                                @foreach($statusArr as $status)
                                                    <option
                                                        {{$audit_schedule->status == $status ? 'selected' : ''}} value="{{$status}}">{{$status}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Audit Completion Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" name="audit_completion_date"
                                               value="{{$audit_schedule->audit_completion_date}}"
                                               class="form-control form-control-solid">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Audit Report</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="hidden" name="old_audit_report"
                                               value="{{$audit_schedule->audit_report}}">
                                        <input type="file" name="audit_report" class="form-control form-control-solid">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Number of Issues</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="num_of_issues"
                                               value="{{$audit_schedule->num_of_issues}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">ABS CPAR Acceptance (If Any)</label>
                                        <input type="hidden" name="old_abs_cpar_acceptance"
                                               value="{{$audit_schedule->abs_cpar_acceptance}}">
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="abs_cpar_acceptance"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Nonconformity Note Attachment (If
                                                Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="hidden" name="old_nonconformity_note_attachment"
                                                   value="{{$audit_schedule->nonconformity_note_attachment}}">
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                   name="nonconformity_note_attachment"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Comments (If Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid" name="comments"
                                                      id="comments" cols="30"
                                                      rows="5">{{$audit_schedule->comments}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
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
