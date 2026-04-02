@extends('layouts.app')
@section('pageTitle')
    Edit Document
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
                                    <input type="hidden" name="id" value="{{$document->id}}">
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option
                                                        {{$document->site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Management Systems</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="management_system" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($management_systemArr as $management_system)
                                                    <option
                                                        {{$document->management_system == $management_system ? 'selected' : ''}} value="{{$management_system}}">{{$management_system}}</option>
                                                @endforeach
                                            </select>
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
                                            <select name="location" data-control="select2"
                                                    data-placeholder="Select a Location..."
                                                    class="form-select form-select-solid">
                                                @foreach($locationArr as $location)
                                                    <option
                                                        {{$document->location == $location ? 'selected' : ''}} value="{{$location}}">{{$location}}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                <em class="reset-option-link" data-select-name="location">Reset Option</em>
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Sub Location</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="sub_location" data-control="select2"
                                                    data-placeholder="Select a Sub Location..."
                                                    class="form-select form-select-solid">
                                                @foreach($sub_locationArr as $sub_location)
                                                    <option
                                                        {{$document->sub_location == $sub_location ? 'selected' : ''}} value="{{$sub_location}}">{{$sub_location}}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                <em class="reset-option-link" data-select-name="sub_location">Reset Option</em>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Document Type</label>
                                        <select name="document_type" data-control="select2"
                                                data-placeholder="Select a Document Type..."
                                                class="form-select form-select-solid">
                                            <option value="">Select a Document Type...</option>
                                            <!-- Default empty option -->
                                            @foreach($document_typeArr as $document_type)
                                                <option
                                                    {{$document->document_type == $document_type ? 'selected' : ''}} value="{{$document_type}}">{{$document_type}}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            <em class="reset-option-link" data-select-name="document_type">Reset Option</em>
                                        </div>
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
                                                   name="title" value="{{$document->title}}"/>
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
                                                   name="doc_id" value="{{$document->doc_id}}"/>
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
                                                   name="revision" value="{{$document->revision}}"/>
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
                                            <input type="hidden" name="old_document_attachment"
                                                   value="{{$document->document_attachment}}">
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                   name="document_attachment"/>
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
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="document_review_date" value="{{$document->document_review_date}}"/>
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
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="document_next_review_date" value="{{$document->document_next_review_date}}"/>
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
                                                    name="internal_folder" id="internal_folder"/>
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
                                                    name="external_folder" id="external_folder"/>
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
                                                    name="distributor_folder" id="distributor_folder"/>
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
                                                    name="website_product_documents" id="website_product_documents"/>
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
                                                    id="website_technical_documents"/>
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
                                                <select name="results_area_1" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_1)
                                                        <option
                                                            {{$document->results_area_1 == $results_area_1 ? 'selected' : ''}} value="{{$results_area_1}}">{{$results_area_1}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 2</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_2" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_2)
                                                        <option
                                                            {{$document->results_area_2 == $results_area_2 ? 'selected' : ''}} value="{{$results_area_2}}">{{$results_area_2}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 3</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_3" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_3)
                                                        <option
                                                            {{$document->results_area_3 == $results_area_3 ? 'selected' : ''}} value="{{$results_area_3}}">{{$results_area_3}}</option>
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
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 4</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_4" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_4)
                                                        <option
                                                            {{$document->results_area_4 == $results_area_4 ? 'selected' : ''}} value="{{$results_area_4}}">{{$results_area_4}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 5</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_5" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_5)
                                                        <option
                                                            {{$document->results_area_5 == $results_area_5 ? 'selected' : ''}} value="{{$results_area_5}}">{{$results_area_5}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 6</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_6" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_6)
                                                        <option
                                                            {{$document->results_area_6 == $results_area_6 ? 'selected' : ''}} value="{{$results_area_6}}">{{$results_area_6}}</option>
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
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 7</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_7" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_7)
                                                        <option
                                                            {{$document->results_area_7 == $results_area_7 ? 'selected' : ''}} value="{{$results_area_7}}">{{$results_area_7}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 8</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_8" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_8)
                                                        <option
                                                            {{$document->results_area_8 == $results_area_8 ? 'selected' : ''}} value="{{$results_area_8}}">{{$results_area_8}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 9</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_9" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_9)
                                                        <option
                                                            {{$document->results_area_9 == $results_area_9 ? 'selected' : ''}} value="{{$results_area_9}}">{{$results_area_9}}</option>
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
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 10</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_10" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_10)
                                                        <option
                                                            {{$document->results_area_10 == $results_area_10 ? 'selected' : ''}} value="{{$results_area_10}}">{{$results_area_10}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 11</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_11" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_11)
                                                        <option
                                                            {{$document->results_area_11 == $results_area_11 ? 'selected' : ''}} value="{{$results_area_11}}">{{$results_area_11}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--end::Label-->
                                                <label class="fs-5 fw-semibold mb-2">Results Area 12</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="results_area_12" data-control="select2"
                                                        data-placeholder="Select a Results Area..."
                                                        class="form-select form-select-solid">
                                                    @foreach($results_areaArr as $results_area_12)
                                                        <option
                                                            {{$document->results_area_12 == $results_area_12 ? 'selected' : ''}} value="{{$results_area_12}}">{{$results_area_12}}</option>
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
                                                <label class="fs-5 fw-semibold mb-2">Master Document Attachment</label>
                                                <!--end::Label-->
                                                <!--end::Input-->
                                                <input type="hidden" name="old_master_document_attachment"
                                                       value="{{$document->master_document_attachment}}">
                                                <input type="file" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="master_document_attachment"/>
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
                                                       value="{{$document->training_completion_days_allowed}}"/>
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
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder=""
                                                       name="learning_time" value="{{$document->learning_time}}"/>
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
                                                       value="{{$document->training_note_for_training_history_comments}}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                    @endif
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

@endsection
