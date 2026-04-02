@extends('layouts.app')
@section('pageTitle')
    Add ECO Record
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
                                <form action="{{route('submit_for_approval')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                @csrf
                                <!--begin::Input group-->
                                    <input type="hidden" name="id" value="{{$eco->id}}">
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">ECO #</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   placeholder="Auto generated based on site"
                                                   name="eco_id"
                                                   value="{{$eco->eco_id}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option
                                                        {{$eco->site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Accordion-->
                                    <div class="accordion accordion-icon-toggle mt-10" id="kt_accordion_2">
                                        <!--begin::Item-->
                                        <div class="mb-5">
                                            <!--begin::Header-->
                                            <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                 data-bs-target="#kt_accordion_2_item_1">
                                                <span class="accordion-icon">
                                                        <i class="fa-solid fa-angle-down"></i>
                                                </span>
                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">STEP 1: ITEM ENTRY</h3>
                                            </div>
                                            <!--end::Header-->

                                            <!--begin::Body-->
                                            <div id="kt_accordion_2_item_1" class="fs-6 collapse show ps-10"
                                                 data-bs-parent="#kt_accordion_2">
                                                <!--begin::Repeater-->
                                                <div id="kt_docs_repeater_basic">
                                                    <!--begin::Form group-->
                                                    <div class="form-group">
                                                        <div data-repeater-list="kt_docs_repeater_basic">
                                                            @foreach ($ecos_items as $ecos_item)
                                                                <div data-repeater-item-db>
                                                                    <input type="hidden" name="eco_item_id" value="{{$ecos_item->id}}">
                                                                    <div class="form-group row mt-5">
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Current Part
                                                                                Number:</label>
                                                                            <input type="text"
                                                                                   name="current_part_number"
                                                                                   class="form-control mb-2 mb-md-0"
                                                                                   placeholder=""
                                                                                   value="{{$ecos_item->current_part_number}}"/>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Drawing:</label>
                                                                            <input type="text" name="drawing"
                                                                                   class="form-control mb-2 mb-md-0"
                                                                                   placeholder=""
                                                                                   value="{{$ecos_item->drawing}}"/>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <label class="form-label">Revision:</label>
                                                                            <input type="text" name="revision"
                                                                                   class="form-control mb-2 mb-md-0"
                                                                                   placeholder=""
                                                                                   value="{{$ecos_item->revision}}"/>
                                                                        </div>
                                                                        <div class="col-md-3 delete_ecos_item">
                                                                            <a href="javascript:;" data-repeater-delete
                                                                               class="btn btn-sm btn-light-danger mt-5 mt-md-9"
                                                                               data-item-id="{{$ecos_item->id}}">
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <div data-repeater-item>
                                                                <div class="form-group row mt-5">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Current Part
                                                                            Number:</label>
                                                                        <input type="text" name="current_part_number"
                                                                               class="form-control mb-2 mb-md-0"
                                                                               placeholder=""/>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Drawing:</label>
                                                                        <input type="text" name="drawing"
                                                                               class="form-control mb-2 mb-md-0"
                                                                               placeholder=""/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">Revision:</label>
                                                                        <input type="text" name="revision"
                                                                               class="form-control mb-2 mb-md-0"
                                                                               placeholder=""/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <a href="javascript:;" data-repeater-delete
                                                                           class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                            <i class="fa-solid fa-trash-can"></i>
                                                                            Delete
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Form group-->

                                                    <!--begin::Form group-->
                                                    <div class="form-group mt-5">
                                                        <a href="javascript:;" data-repeater-create
                                                           class="btn btn-light-primary">
                                                            <i class="fa-solid fa-plus"></i>
                                                            Add
                                                        </a>
                                                    </div>
                                                    <!--end::Form group-->
                                                </div>
                                                <!--end::Repeater-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Originator</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select name="originator" data-control="select2"
                                                                data-placeholder="Select a originator..."
                                                                class="form-select form-select-solid">
                                                            <option value="" selected disabled></option>
                                                            @foreach($users as $user)
                                                                <option
                                                                    {{$eco->originator == $user->id ? 'selected' : ''}}
                                                                    value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Date Originated</label>
                                                        <!--end::Label-->
                                                        <!--end::Input-->
                                                        <input type="date" class="form-control form-control-solid"
                                                               placeholder="Date Originated"
                                                               name="date_originated"
                                                               value="{{$eco->date_originated}}"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Attachment 1 (If
                                                            Any)</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="hidden" name="old_attachment_1"
                                                               value="{{$eco->attachment_1}}">
                                                        <input type="file" class="form-control form-control-solid"
                                                               placeholder="attachment_1"
                                                               name="attachment_1"
                                                               value=""/>
                                                        <!--end::Input-->
                                                        @if($eco->attachment_1 != null)
                                                            <p>
                                                                <a target="_blank"
                                                                   href="{{asset('uploads/Eco')}}/{{$eco->attachment_1}}">{{$eco->attachment_1}}</a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Attachment 2 (If
                                                            Any)</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="hidden" name="old_attachment_2"
                                                               value="{{$eco->attachment_2}}">
                                                        <input type="file" class="form-control form-control-solid"
                                                               placeholder="attachment_2"
                                                               name="attachment_2"
                                                               value=""/>
                                                        @if($eco->attachment_2 != null)
                                                            <p>
                                                                <a target="_blank"
                                                                   href="{{asset('uploads/Eco')}}/{{$eco->attachment_2}}">{{$eco->attachment_2}}</a>
                                                            </p>
                                                        @endif
                                                    <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Attachment 3 (If
                                                            Any)</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="hidden" name="old_attachment_3"
                                                               value="{{$eco->attachment_3}}">
                                                        <input type="file" class="form-control form-control-solid"
                                                               placeholder="attachment_3"
                                                               name="attachment_3"
                                                               value=""/>
                                                        <!--end::Input-->
                                                        @if($eco->attachment_3 != null)
                                                            <p>
                                                                <a target="_blank"
                                                                   href="{{asset('uploads/Eco')}}/{{$eco->attachment_3}}">{{$eco->attachment_3}}</a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Attachment 4 (If
                                                            Any)</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="hidden" name="old_attachment_4"
                                                               value="{{$eco->attachment_4}}">
                                                        <input type="file" class="form-control form-control-solid"
                                                               placeholder="attachment_4"
                                                               name="attachment_4"
                                                               value=""/>
                                                        <!--end::Input-->
                                                        @if($eco->attachment_4 != null)
                                                            <p>
                                                                <a target="_blank"
                                                                   href="{{asset('uploads/Eco')}}/{{$eco->attachment_4}}">{{$eco->attachment_4}}</a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Attachment 5 (If
                                                            Any)</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="hidden" name="old_attachment_5"
                                                               value="{{$eco->attachment_5}}">
                                                        <input type="file" class="form-control form-control-solid"
                                                               placeholder="attachment_5"
                                                               name="attachment_5"
                                                               value=""/>
                                                        <!--end::Input-->
                                                        @if($eco->attachment_5 != null)
                                                            <p>
                                                                <a target="_blank"
                                                                   href="{{asset('uploads/Eco')}}/{{$eco->attachment_5}}">{{$eco->attachment_5}}</a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Details for Request</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid"
                                                                  name="details_for_request"
                                                                  id="details_for_request" cols="30"
                                                                  rows="5">{{$eco->details_for_request}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Message to Initiator (If
                                                            Any)</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid"
                                                                  name="message_to_initiator"
                                                                  id="message_to_initiator" cols="30"
                                                                  rows="5">{{$eco->message_to_initiator}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Importance</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select name="importance" data-control="select2"
                                                                data-placeholder="Select a importance..."
                                                                class="form-select form-select-solid">
                                                            <option value="" selected disabled></option>
                                                            <option
                                                                {{$eco->importance == "Low" ? 'selected' : ''}} value="Low">
                                                                Low
                                                            </option>
                                                            <option
                                                                {{$eco->importance == "Moderate" ? 'selected' : ''}} value="Moderate">
                                                                Moderate
                                                            </option>
                                                            <option
                                                                {{$eco->importance == "High" ? 'selected' : ''}} value="High">
                                                                High
                                                            </option>
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">ECO Part Type</label>
                                                        <!--end::Label-->
                                                        <!--end::Input-->
                                                        <select name="eco_part_type" data-control="select2"
                                                                data-placeholder="Select a part type..."
                                                                class="form-select form-select-solid">
                                                            <option value="" selected disabled></option>
                                                            <option
                                                                {{$eco->eco_part_type == "Part" ? 'selected' : ''}} value="Part">
                                                                Part
                                                            </option>
                                                            <option
                                                                {{$eco->eco_part_type == "Assembly" ? 'selected' : ''}} value="Assembly">
                                                                Assembly
                                                            </option>
                                                            <option
                                                                {{$eco->eco_part_type == "Sub Assembly" ? 'selected' : ''}} value="Sub Assembly">
                                                                Sub Assembly
                                                            </option>
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Reviewed By</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select name="reviewed_by" data-control="select2"
                                                                data-placeholder="Select a reviewer..."
                                                                class="form-select form-select-solid">
                                                            <option value="" selected disabled></option>
                                                            @foreach($users as $user)
                                                                <option
                                                                    value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Date Reviewed</label>
                                                        <!--end::Label-->
                                                        <!--end::Input-->
                                                        <input type="date" class="form-control form-control-solid"
                                                               placeholder="Date Reviewed"
                                                               name="date_reviewed"
                                                               value="{{$eco->date_reviewed}}"/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Submitted By</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select name="submitted_by" data-control="select2"
                                                                data-placeholder="Select..."
                                                                class="form-select form-select-solid">
                                                            <option value="{{$userId}}"
                                                                    selected>{{$submitted_by}}</option>
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Row-->
                                                <div class="row mw-500px mb-5" data-kt-buttons="true"
                                                     data-kt-buttons-target=".form-check-image, .form-check-input">
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <label class="form-check-image active">
                                                            <div class="form-check-wrapper">
                                                                <img width="50%"
                                                                     src="{{asset('assets/media/icons/check.png')}}"/>
                                                            </div>

                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="radio" checked
                                                                       value="1" name="approvalStatus"/>
                                                                <div class="form-check-label">
                                                                    Approve
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <!--end::Col-->

                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <label class="form-check-image">
                                                            <div class="form-check-wrapper">
                                                                <img width="50%"
                                                                     src="{{asset('assets/media/icons/delete.png')}}"/>
                                                            </div>

                                                            <div
                                                                class="form-check form-check-custom form-check-solid me-10">
                                                                <input class="form-check-input" type="radio" value="0"
                                                                       name="approvalStatus" id="approvalStatus"/>
                                                                <div class="form-check-label">
                                                                    Reject
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Item-->

                                        {{--                                        <!--begin::Item-->--}}
                                        {{--                                        <div class="mb-5">--}}
                                        {{--                                            <!--begin::Header-->--}}
                                        {{--                                            <div class="accordion-header py-3 d-flex collapsed"--}}
                                        {{--                                                 data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_2">--}}
                                        {{--                                                <span class="accordion-icon">--}}
                                        {{--                                                    <i class="fa-solid fa-angle-down"></i>--}}
                                        {{--                                                </span>--}}
                                        {{--                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">STEP 2: ENGINEERING ---}}
                                        {{--                                                    ASSESSMENT</h3>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <!--end::Header-->--}}

                                        {{--                                            <!--begin::Body-->--}}
                                        {{--                                            <div id="kt_accordion_2_item_2" class="collapse fs-6 ps-10"--}}
                                        {{--                                                 data-bs-parent="#kt_accordion_2">--}}
                                        {{--                                                ...--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <!--end::Body-->--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <!--end::Item-->--}}

                                        {{--                                        <!--begin::Item-->--}}
                                        {{--                                        <div class="mb-5">--}}
                                        {{--                                            <!--begin::Header-->--}}
                                        {{--                                            <div class="accordion-header py-3 d-flex collapsed"--}}
                                        {{--                                                 data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_3">--}}
                                        {{--                                                <span class="accordion-icon">--}}
                                        {{--                                                    <i class="fa-solid fa-angle-down"></i>--}}
                                        {{--                                                </span>--}}
                                        {{--                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">STEP 3: ENGINEERING ---}}
                                        {{--                                                    INVESTIGATION</h3>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <!--end::Header-->--}}

                                        {{--                                            <!--begin::Body-->--}}
                                        {{--                                            <div id="kt_accordion_2_item_3" class="collapse fs-6 ps-10"--}}
                                        {{--                                                 data-bs-parent="#kt_accordion_2">--}}
                                        {{--                                                ...--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <!--end::Body-->--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <!--end::Item-->--}}
                                    </div>
                                    <!--end::Accordion-->

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
    <script>
        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },


            show: function () {
                if ($("#kt_docs_repeater_basic div[data-repeater-item]").length <= 10) {
                    $(this).slideDown();
                    $(this).find('[data-kt-repeater="select2"]').select2();
                } else {
                    $(this).remove();
                }
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
@endsection
