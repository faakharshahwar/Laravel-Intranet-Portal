@extends('layouts.app')
@section('pageTitle')
    View Document
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
                        <!--begin::Hero-->
                        <div style="float: left" class="position-relative mb-17">
                            <h1>View Document</h1>
                        </div>
                        <div style="text-align: right" class="position-relative align-right mb-17">
                            <a href="{{ url('/') }}/edit_documents/{{ $document->id }}"
                               class="btn btn-light-primary"><i class="bi bi-pencil fs-4 me-2"></i>Edit</a>
                            <a href="javascript:void(0);"
                               onclick="openPopup('{{ url('/') }}/print_documents/{{ $document->id }}')"
                               class="btn btn-secondary"><i class="bi bi-printer fs-4 me-2"></i> Print</a>

                            <a href="{{ url('/') }}/email_documents/{{ $document->id }}" class="btn btn-secondary"><i
                                        class="bi bi-envelope fs-4 me-2"></i> Email</a>
                        </div>
                        <!--end::-->
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
                                <form action="{{route('update_documents')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$document->id}}" readonly>
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="title" value="{{$document->site}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Management Systems</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="title" value="{{$document->management_system}}" readonly/>
                                            <!--end::Input-->
                                        </div>

                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Location</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="location" value="{{$document->location}}" readonly/>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Sub Location</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="title" value="{{$document->sub_location}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Document Type</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="title" value="{{$document->document_type}}" readonly/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Title</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="title" value="{{$document->title}}" readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">DOC ID</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="doc_id" value="{{$document->doc_id}}" readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Revision</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="revision" value="{{$document->revision}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Document Attachment</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <a target="_blank"
                                               href="/uploads/Documents/{{$document->document_attachment}}">{{$document->document_attachment}}</a>
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
                                            <label class="fs-5 fw-semibold mb-2">Document Review Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="document_review_date"
                                                   value="{{format_date($document->document_review_date)}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Next Review Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="document_next_review_date"
                                                   value="{{format_date($document->document_next_review_date)}}"
                                                   readonly/>
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

                                    <!--begin:`:Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->
                                    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                                        <h1 class="mb-8">Administrative Use Only</h1>

                                        <!--begin::Input group-->
                                        <div class="row mb-5">
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 1</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_1}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 2</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_2}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 3</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_3}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-5">
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 4</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_4}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 5</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_5}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 6</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_6}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-5">
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 7</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_7}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 8</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_8}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 9</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_9}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-5">
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 10</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_10}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 11</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_11}}" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 12</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="doc_id" value="{{$document->results_area_12}}" readonly/>
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
                                                <label class="fs-5 fw-semibold mb-2">Master Document Attachment</label>
                                                <!--end::Label-->
                                                <!--end::Input-->
                                                <a target="_blank"
                                                   href="/uploads/Documents/Master/{{$document->master_document_attachment}}">{{$document->master_document_attachment}}</a>
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
                                                <label class="fs-5 fw-semibold mb-2">Training Completion Days
                                                    Allowed</label>
                                                <!--end::Label-->
                                                <!--end::Input-->
                                                <input type="number" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="training_completion_days_allowed"
                                                       value="{{$document->training_completion_days_allowed}}"
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
                                                <label class="fs-5 fw-semibold mb-2">Learning Time (Hours)</label>
                                                <!--end::Label-->
                                                <!--end::Input-->
                                                <input type="number" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="learning_time" value="{{$document->learning_time}}"
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
                                                <label class="fs-5 fw-semibold mb-2">Training Note for Training History
                                                    Comments</label>
                                                <!--end::Label-->
                                                <!--end::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="training_note_for_training_history_comments"
                                                       value="{{$document->training_note_for_training_history_comments}}"
                                                       readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                    @endif
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Layout-->
                        <div class="text-dark order-2 order-md-1">
                            <span
                                    class="text-gray-400 fw-semibold me-1">Created on <strong>{{$document->created_at}}</strong>. Last updated on <strong>{{$document->updated_at}}</strong>. </span>
                        </div>
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
        function openPopup(url) {
            var popup = window.open(url, '_blank', 'width=1000,height=1000');
            if (popup) {
                popup.focus();
            } else {
                alert('Please allow popups for this site');
            }
        }
    </script>

@endsection
