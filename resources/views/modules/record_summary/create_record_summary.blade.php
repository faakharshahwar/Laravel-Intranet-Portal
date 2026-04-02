@extends('layouts.app')
@section('pageTitle')
    Add Record Summary
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
                                <form action="{{route('store_record_summary')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Record Title</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="record_title" value="{{old('record_title')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">DOC ID (If
                                                Applicable) </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="doc_id" value="{{old('doc_id')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
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
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Location</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="location" data-api-url="/add-location"
                                                    data-placeholder="Select a Physical or Electronic Location..."
                                                    class="form-select form-select-solid add-new-select">
                                                @foreach($record_summary_locationArr as $location)
                                                    <option value="{{$location}}">{{$location}}</option>
                                                @endforeach
                                                <option value="add_new">Add New</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="type" data-api-url="/add-type"
                                                    data-placeholder="Select a type..."
                                                    class="form-select form-select-solid add-new-select">
                                                @foreach($record_summary_typeArr as $type)
                                                    <option value="{{$type}}">{{$type}}</option>
                                                @endforeach
                                                <option value="add_new">Add New</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">File or Manual Title</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="file_manual_title" data-api-url="/add-file_manual_title"
                                                data-placeholder="Select a file manual title..."
                                                class="form-select form-select-solid add-new-select">
                                            @foreach($record_summary_fileArr as $file)
                                                <option value="{{$file}}">{{$file}}</option>
                                            @endforeach
                                            <option value="add_new">Add New</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Maintained By</label>
                                        <select name="maintained_by" data-api-url="/add-maintained_by"
                                                data-placeholder="Select..."
                                                class="form-select form-select-solid add-new-select">
                                            @foreach($record_summary_maintained_byArr as $maintained_by)
                                                <option value="{{$maintained_by}}">{{$maintained_by}}</option>
                                            @endforeach
                                            <option value="add_new">Add New</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Minimum Retention</label>
                                        <select name="minimum_retention" data-api-url="/add-minimum_retention"
                                                data-placeholder="Select..."
                                                class="form-select form-select-solid add-new-select">
                                            @foreach($record_summary_minimum_retention_byArr as $minimum_retention)
                                                <option value="{{$minimum_retention}}">{{$minimum_retention}}</option>
                                            @endforeach
                                            <option value="add_new">Add New</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Record Status</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="record_status" data-control="select2"
                                                data-placeholder="Select a type..."
                                                class="form-select form-select-solid">
                                            @foreach($record_summary_record_status_byArr as $record_status)
                                                <option value="{{$record_status}}">{{$record_status}}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Comments (If Any)</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" rows="4"
                                                  name="comments"
                                                  placeholder="">{{old('comments')}}</textarea>
                                        <!--end::Input-->
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
