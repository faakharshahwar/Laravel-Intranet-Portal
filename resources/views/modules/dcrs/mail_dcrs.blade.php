@extends('layouts.app')
@section('pageTitle')
    Email DCR
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
                            <h1>Email DCR</h1>
                        </div>
                        <div style="text-align: right" class="position-relative align-right mb-17">
                            <a href="javascript:void(0);"
                               onclick="openPopup('{{ url('/') }}/print_dcrs/{{ $dcr->id }}')"
                               class="btn btn-secondary"><i class="bi bi-printer fs-4 me-2"></i> Print</a>

                            <a href="{{ url('/') }}/email_dcrs/{{ $dcr->id }}" class="btn btn-secondary"><i
                                    class="bi bi-envelope fs-4 me-2"></i> Email</a>
                        </div>
                        <!--begin::Layout-->
                        <div class="d-flex flex-column flex-lg-row mb-17">

                            <!--begin::Content-->
                            <div class="flex-lg-row-fluid me-0 me-lg-20">
                                @if(session()->has('success'))

                                    <div class="alert alert-success" role="alert">
                                        {{session()->get('success')}}
                                    </div>

                                @endif

                                @if(session()->has('error'))

                                    <div class="alert alert-danger" role="alert">
                                        {{session()->get('error')}}
                                    </div>

                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                            @endif
                            <!--begin::Form-->
                                <form action="{{route('send_email_dcrs')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$dcr->id}}">
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

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">DOC ID</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="doc_id" value="{{$dcr->doc_id}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Title</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="title" value="{{$dcr->title}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">REV</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="number" class="form-control form-control-solid" placeholder=""
                                                   name="rev" value="{{$dcr->rev}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">DCR #</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="dcr_num" value="{{$dcr->dcr_num}}"
                                                   readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Source Document</label>

                                            <input type="hidden" name="source_document"
                                                   value="{{$dcr->source_document}}">
                                            <h5><a target="_blank"
                                                   href="/uploads/documents/{{$document->document_attachment}}">{{$document->document_attachment}}</a>
                                            </h5>

                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Document For Approval</label>
                                            <!--end::Label-->
                                            <h5><a target="_blank"
                                               href="/uploads/dcrs/{{$dcr->document_for_approval}}">{{$dcr->document_for_approval}}</a></h5>

                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Effective Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="effective_date" value="{{$dcr->effective_date}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Approver 1</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="approver_1" id="approver_1" data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$dcr->approver_1 == $user->id ? 'selected' : ''}}
                                                        value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Approver 2</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="approver_2" id="approver_2" data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$dcr->approver_2 == $user->id ? 'selected' : ''}}
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
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Approved By 1</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="approved_by_1" id="approved_by_1" data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$dcr->approved_by_1 == $user->id ? 'selected' : ''}}
                                                            value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Approved By 2</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="approved_by_2" id="approved_by_2" data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$dcr->approved_by_2 == $user->id ? 'selected' : ''}}
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
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input {{$dcr->document_approved == 'approved' ? 'checked' : ''}} class="form-check-input" type="checkbox" value="approved"
                                                       id="flexSwitchDefault" name="document_approved"/>
                                                <label class="form-check-label" for="flexSwitchDefault">
                                                    Do you want to approve this document?
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Approval Review Comments (If
                                                Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="approval_review_comments"
                                                      id="approval_review_comments" cols="30"
                                                      rows="5" readonly>{{$dcr->approval_review_comments}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Date Approved</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="date_approved" value="{{$dcr->date_approved}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Training Assessed</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="training_assessed" value="{{$dcr->training_assessed}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5 mt-6">
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row">
                                            <div class="form-check">
                                                <input
                                                    {{$document->internal_folder == 1 ? 'checked' : ''}} class="form-check-input"
                                                    type="checkbox" value="1"
                                                    name="internal_folder" id="internal_folder"
                                                    onclick="return false;"/>
                                                <label class="form-check-label" for="internal_folder">
                                                    Internal Folder
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row">
                                            <div class="form-check">
                                                <input
                                                    {{$document->external_folder == 1 ? 'checked' : ''}} class="form-check-input"
                                                    type="checkbox" value="1"
                                                    name="external_folder" id="external_folder"
                                                    onclick="return false;"/>
                                                <label class="form-check-label" for="external_folder">
                                                    External Folder
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row">
                                            <div class="form-check">
                                                <input
                                                    {{$document->distributor_folder == 1 ? 'checked' : ''}} class="form-check-input"
                                                    type="checkbox" value="1"
                                                    name="distributor_folder" id="distributor_folder"
                                                    onclick="return false;"/>
                                                <label class="form-check-label" for="distributor_folder">
                                                    Distributor Portal
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5 mt-6">
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row">
                                            <div class="form-check">
                                                <input
                                                    {{$document->website_product_documents == 1 ? 'checked' : ''}} class="form-check-input"
                                                    type="checkbox" value="1"
                                                    name="website_product_documents" id="website_product_documents"
                                                    onclick="return false;"/>
                                                <label class="form-check-label" for="website_product_documents">
                                                    Website Product Documents
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row">
                                            <div class="form-check">
                                                <input
                                                    {{$document->website_technical_documents == 1 ? 'checked' : ''}} class="form-check-input"
                                                    type="checkbox" value="1"
                                                    name="website_technical_documents"
                                                    id="website_technical_documents" onclick="return false;"/>
                                                <label class="form-check-label" for="website_technical_documents">
                                                    Website Technical Documents
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Col-->`
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->
                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                        <span class="indicator-label">Send Email</span>
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
        jQuery(document).ready(function($) {
            var $select2_1 = $('#approver_1').select2();
            var $select2_2 = $('#approver_2').select2();
            var $select2_3 = $('#approved_by_1').select2();
            var $select2_4 = $('#approved_by_2').select2();

            $select2_1.prop('disabled', true);
            $select2_2.prop('disabled', true);
            $select2_3.prop('disabled', true);
            $select2_4.prop('disabled', true);

            $select2_1.on("select2:opening select2:closing", function (e) {
                e.preventDefault();
            });
            $select2_2.on("select2:opening select2:closing", function (e) {
                e.preventDefault();
            });
            $select2_3.on("select2:opening select2:closing", function (e) {
                e.preventDefault();
            });
            $select2_4.on("select2:opening select2:closing", function (e) {
                e.preventDefault();
            });
        });
    </script>

@endsection
