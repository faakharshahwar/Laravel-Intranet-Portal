@extends('layouts.app')
@section('pageTitle')
    Edit DCR
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
                                <form action="{{route('update_dcrs')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$dcr->id}}">
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
                                                   name="rev" value="{{$dcr->rev}}"/>
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
                                            <!--end::Label-->
                                            @if($document)
                                                <input type="hidden" name="source_document"
                                                       value="{{$dcr->source_document}}">
                                                <h5><a target="_blank"
                                                       href="/uploads/documents/{{$document->document_attachment}}">{{$document->document_attachment}}</a>
                                                </h5>
                                            @else
                                                <h5><a target="_blank"
                                                       href="/uploads/dcrs/{{$dcr->new_source_document}}">{{$dcr->new_source_document}}</a>
                                                </h5>
                                            @endif


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
                                            <!--end::Input-->
                                            <input type="hidden" name="old_document_for_approval"
                                                   value="{{$dcr->document_for_approval}}">
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                   name="document_for_approval"/>
                                            <!--end::Input-->

                                            <a target="_blank"
                                               href="/uploads/dcrs/{{$dcr->document_for_approval}}">{{$dcr->document_for_approval}}</a>

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
                                                   name="effective_date" value="{{$dcr->effective_date}}"/>
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
                                            <select name="approver_1" data-control="select2"
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
                                            <select name="approver_2" data-control="select2"
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
                                            <select name="approved_by_1" data-control="select2"
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
                                            <select name="approved_by_2" data-control="select2"
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
                                                <input
                                                    {{$dcr->document_approved == 'approved' ? 'checked' : ''}} class="form-check-input"
                                                    type="checkbox" value="approved"
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
                                                      rows="5">{{$dcr->approval_review_comments}}</textarea>
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
                                                   name="date_approved" value="{{$dcr->date_approved}}"/>
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
                                                   name="training_assessed" value="{{$dcr->training_assessed}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    {{--                                    <!--begin::Input group-->--}}
                                    {{--                                    <div class="row mb-5 mt-6">--}}
                                    {{--                                        <!--begin::Col-->--}}
                                    {{--                                        <div class="col-md-4 fv-row">--}}
                                    {{--                                            <div class="form-check">--}}
                                    {{--                                                <input--}}
                                    {{--                                                    {{$document->internal_folder == 1 ? 'checked' : ''}} class="form-check-input"--}}
                                    {{--                                                    type="checkbox" value="1"--}}
                                    {{--                                                    name="internal_folder" id="internal_folder"--}}
                                    {{--                                                    onclick="return false;"/>--}}
                                    {{--                                                <label class="form-check-label" for="internal_folder">--}}
                                    {{--                                                    Internal Folder--}}
                                    {{--                                                </label>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!--end::Col-->--}}

                                    {{--                                        <!--begin::Col-->--}}
                                    {{--                                        <div class="col-md-4 fv-row">--}}
                                    {{--                                            <div class="form-check">--}}
                                    {{--                                                <input--}}
                                    {{--                                                    {{$document->external_folder == 1 ? 'checked' : ''}} class="form-check-input"--}}
                                    {{--                                                    type="checkbox" value="1"--}}
                                    {{--                                                    name="external_folder" id="external_folder"--}}
                                    {{--                                                    onclick="return false;"/>--}}
                                    {{--                                                <label class="form-check-label" for="external_folder">--}}
                                    {{--                                                    External Folder--}}
                                    {{--                                                </label>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!--end::Col-->--}}

                                    {{--                                        <!--begin::Col-->--}}
                                    {{--                                        <div class="col-md-4 fv-row">--}}
                                    {{--                                            <div class="form-check">--}}
                                    {{--                                                <input--}}
                                    {{--                                                    {{$document->distributor_folder == 1 ? 'checked' : ''}} class="form-check-input"--}}
                                    {{--                                                    type="checkbox" value="1"--}}
                                    {{--                                                    name="distributor_folder" id="distributor_folder"--}}
                                    {{--                                                    onclick="return false;"/>--}}
                                    {{--                                                <label class="form-check-label" for="distributor_folder">--}}
                                    {{--                                                    Distributor Portal--}}
                                    {{--                                                </label>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!--end::Col-->--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <!--end::Input group-->--}}

                                    {{--                                    <!--begin::Input group-->--}}
                                    {{--                                    <div class="row mb-5 mt-6">--}}
                                    {{--                                        <!--begin::Col-->--}}
                                    {{--                                        <div class="col-md-4 fv-row">--}}
                                    {{--                                            <div class="form-check">--}}
                                    {{--                                                <input--}}
                                    {{--                                                    {{$document->website_product_documents == 1 ? 'checked' : ''}} class="form-check-input"--}}
                                    {{--                                                    type="checkbox" value="1"--}}
                                    {{--                                                    name="website_product_documents" id="website_product_documents"--}}
                                    {{--                                                    onclick="return false;"/>--}}
                                    {{--                                                <label class="form-check-label" for="website_product_documents">--}}
                                    {{--                                                    Website Product Documents--}}
                                    {{--                                                </label>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!--end::Col-->--}}

                                    {{--                                        <!--begin::Col-->--}}
                                    {{--                                        <div class="col-md-4 fv-row">--}}
                                    {{--                                            <div class="form-check">--}}
                                    {{--                                                <input--}}
                                    {{--                                                    {{$document->website_technical_documents == 1 ? 'checked' : ''}} class="form-check-input"--}}
                                    {{--                                                    type="checkbox" value="1"--}}
                                    {{--                                                    name="website_technical_documents"--}}
                                    {{--                                                    id="website_technical_documents" onclick="return false;"/>--}}
                                    {{--                                                <label class="form-check-label" for="website_technical_documents">--}}
                                    {{--                                                    Website Technical Documents--}}
                                    {{--                                                </label>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!--end::Col-->`--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <!--end::Input group-->--}}

                                    <!--begin::Submit-->
                                    <button type="submit" class="mt-5 btn btn-primary" id="kt_careers_submit_button">
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
    <script>

    </script>
@endsection
