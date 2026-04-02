@extends('layouts.app')
@section('pageTitle')
    Email Auditor
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
                        <div style="float: left" class="position-relative mb-17">
                            <h1>Email Auditor</h1>
                        </div>
                        <div style="text-align: right" class="position-relative align-right mb-17">
                            <a href="javascript:void(0);"
                               onclick="openPopup('{{ url('/') }}/print_qualified_auditors_list/{{$qal->id}}')"
                               class="btn btn-secondary"><i class="bi bi-printer fs-4 me-2"></i> Print</a>
                        </div>
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
                                <form action="{{route('send_email_qualified_auditors_list')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$qal->id}}">

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Recipients</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-lg form-select-solid"
                                                    data-control="select2" data-close-on-select="false"
                                                    data-placeholder="Select an option" data-allow-clear="true"
                                                    multiple="multiple" name="recipient[]">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option
                                                        value="{{$user->email}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Add a personal message</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid" name="personal_message"
                                                      id="personal_message" cols="30"
                                                      rows="5"></textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Auditor's Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="auditor_name" id="auditor_name" data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$qal->auditor_name == $user->id ? 'selected' : ''}}
                                                            value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="site" id="site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option {{$qal->site == $site ? 'selected' : ''}}
                                                            value="{{$site}}">{{$site}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Auditor Status</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="auditor_status" id="auditor_status" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($auditor_statusArr as $auditor_status)
                                                    <option
                                                        {{$qal->auditor_status == $auditor_status ? 'selected' : ''}}
                                                        value="{{$auditor_status}}">{{$auditor_status}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Qualification Basis 1</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="qualification_basis_1" id="qualification_basis_1"
                                                    data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($qualification_basisArr as $qualification_basis)
                                                    <option
                                                        {{$qal->qualification_basis_1 == $qualification_basis ? 'selected' : ''}}
                                                        value="{{$qualification_basis}}">{{$qualification_basis}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Qualification Basis 2</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="qualification_basis_2" id="qualification_basis_2"
                                                    data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($qualification_basisArr as $qualification_basis)
                                                    <option
                                                        {{$qal->qualification_basis_2 == $qualification_basis ? 'selected' : ''}}
                                                        value="{{$qualification_basis}}">{{$qualification_basis}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Qualification Basis 3</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="qualification_basis_3" id="qualification_basis_3"
                                                    data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($qualification_basisArr as $qualification_basis)
                                                    <option
                                                        {{$qal->qualification_basis_3 == $qualification_basis ? 'selected' : ''}}
                                                        value="{{$qualification_basis}}">{{$qualification_basis}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Comments (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="comments"
                                                      id="comments" cols="30"
                                                      rows="5" readonly>{{$qal->comments}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">File Attachment 1 (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="hidden" name="old_file_attachment_1"
                                                   value="{{$qal->file_attachment_1}}">
                                            <a target="_blank"
                                               href="/uploads/qualified_auditors_list/{{$qal->file_attachment_1}}">{{$qal->file_attachment_1}}</a>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">File Attachment 2 (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="hidden" name="old_file_attachment_2"
                                                   value="{{$qal->file_attachment_2}}">
                                            <!--end::Input-->
                                            <a target="_blank"
                                               href="/uploads/qualified_auditors_list/{{$qal->file_attachment_2}}">{{$qal->file_attachment_2}}</a>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Web Link 1 (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" name="web_link_1"
                                                   class="form-control form-control-solid" value="{{$qal->web_link_1}}"
                                                   readonly>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Web Link 2 (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" name="web_link_2"
                                                   class="form-control form-control-solid" value="{{$qal->web_link_2}}"
                                                   readonly>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Send Email</span>
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
    <script>
        jQuery(document).ready(function ($) {
            function disableSelect2(selector) {
                var $select2 = $(selector).select2();
                $select2.prop('disabled', true);
                $select2.on("select2:opening select2:closing", function (e) {
                    e.preventDefault();
                });
            }

            disableSelect2('#auditor_name');
            disableSelect2('#site');
            disableSelect2('#auditor_status');
            disableSelect2('#qualification_basis_1');
            disableSelect2('#qualification_basis_2');
            disableSelect2('#qualification_basis_3');
        });
    </script>
@endsection
