@extends('layouts.app')
@section('pageTitle')
    Edit Customer Feedback Records
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
                                <form action="{{route('update_customer_feedback_records')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$cfr->id}}">
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">CFR #</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="cfr_id" value="{{$cfr->cfr_id}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
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
                                                        {{$cfr->site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
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
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Type</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="type" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                <option
                                                    {{$cfr->type == "Complaint" ? 'selected' : ''}} value="Complaint">
                                                    Complaint
                                                </option>
                                                <option
                                                    {{$cfr->type == "Compliment" ? 'selected' : ''}} value="Compliment">
                                                    Compliment
                                                </option>
                                                <option {{$cfr->type == "Inquiry" ? 'selected' : ''}} value="Inquiry">
                                                    Inquiry
                                                </option>
                                                <option
                                                    {{$cfr->type == "Suggestion" ? 'selected' : ''}} value="Suggestion">
                                                    Suggestion
                                                </option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Customer</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="customer" value="{{$cfr->customer}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Customer Location</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="customer_location" value="{{$cfr->customer_location}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Customer Contact</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="customer_contact" value="{{$cfr->customer_contact}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Customer Contact Telephone</span>
                                                {{--                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Your payment statements may very based on selected position"></i>--}}
                                            </label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="customer_phone" value="{{$cfr->customer_phone}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Customer Contact Email (If
                                                Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="customer_email" value="{{$cfr->customer_email}}"/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Description</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid" rows="4"
                                                      name="description"
                                                      placeholder="">{{$cfr->description}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">CFR Category</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="cfr_category" data-control="select2"
                                                data-placeholder="Select a position..."
                                                class="form-select form-select-solid">
                                            <option
                                                {{$cfr->cfr_category == "Package/Labeling - Incorrect Packaging" ? 'selected' : ''}} value="Package/Labeling - Incorrect Packaging">
                                                Package/Labeling - Incorrect Packaging
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Performance - Not Working As Intended" ? 'selected' : ''}} value="Performance - Not Working As Intended">
                                                Performance - Not Working As Intended
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Compliment" ? 'selected' : ''}} value="Compliment">
                                                Compliment
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Production - Product Lead Time" ? 'selected' : ''}} value="Production - Product Lead Time">
                                                Production - Product Lead Time
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Service - Poor Response Time" ? 'selected' : ''}} value="Service - Poor Response Time">
                                                Service - Poor Response Time
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Appearance - Nicks, Scratches, Dents, Bends" ? 'selected' : ''}} value="Appearance - Nicks, Scratches, Dents, Bends">
                                                Appearance - Nicks, Scratches, Dents, Bends
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Service - Wrong Quantity" ? 'selected' : ''}} value="Service - Wrong Quantity">
                                                Service - Wrong Quantity
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Shipment - Wrong Destination" ? 'selected' : ''}} value="Shipment - Wrong Destination">
                                                Shipment - Wrong Destination
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Administration - Phone Tree Navigation" ? 'selected' : ''}} value="Administration - Phone Tree Navigation">
                                                Administration - Phone Tree Navigation
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Service - Did Not Meet Customer Needs" ? 'selected' : ''}} value="Service - Did Not Meet Customer Needs">
                                                Service - Did Not Meet Customer Needs
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Shipment - Late Delivery" ? 'selected' : ''}} value="Shipment - Late Delivery">
                                                Shipment - Late Delivery
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Shipment - Wrong Part/Product" ? 'selected' : ''}} value="Shipment - Wrong Part/Product">
                                                Shipment - Wrong Part/Product
                                            </option>
                                            <option {{$cfr->cfr_category == "Other" ? 'selected' : ''}} value="Other">
                                                Other
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Package/Labeling - Torn Packaging" ? 'selected' : ''}} value="Package/Labeling - Torn Packaging">
                                                Package/Labeling - Torn Packaging
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Shipping Acct #" ? 'selected' : ''}} value="Shipping Acct #">
                                                Shipping Acct #
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Shipping/Invoicing" ? 'selected' : ''}} value="Shipping/Invoicing">
                                                Shipping/Invoicing
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Shipping - Missing Parts" ? 'selected' : ''}} value="Shipping - Missing Parts">
                                                Shipping - Missing Parts
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Shipping - Labels" ? 'selected' : ''}} value="Shipping - Labels">
                                                Shipping - Labels
                                            </option>
                                            <option
                                                {{$cfr->cfr_category == "Technical" ? 'selected' : ''}} value="Technical">
                                                Technical
                                            </option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Originator</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="originator" value="{{$cfr->originator}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Date Originated</label>
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="date_originated" value="{{$cfr->date_originated}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Root Cause</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid" rows="4" name="root_cause"
                                                      placeholder="">{{$cfr->root_cause}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Action To Be Taken</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid" rows="4"
                                                      name="action_to_be_taken"
                                                      placeholder="">{{$cfr->action_to_be_taken}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Assigned To</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="assigned_to" value="{{$cfr->assigned_to}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Target Completion Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="target_completion_date"
                                                   value="{{$cfr->target_completion_date}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Completed By</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="completed_by" value="{{$cfr->completed_by}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Date Completed</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="date_completed" value="{{$cfr->date_completed}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Feedback to Customer</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" rows="4"
                                                  name="feedback_to_customer"
                                                  placeholder="">{{$cfr->feedback_to_customer}}</textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <!--end::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Feedback By</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="feedback_by" value="{{$cfr->feedback_by}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">How Was Effectiveness
                                                Evaluated?</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="effectiveness_evaluated"
                                                      id="effectiveness_evaluated" cols="30"
                                                      rows="5">{{$cfr->effectiveness_evaluated}}</textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">Was Action Taken Effective?</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="action_taken_effective" id="action_taken_effective"
                                                    class="form-select form-select-solid">
                                                <option {{$cfr->action_taken_effective == 'Yes' ? 'selected' : ''}} value="Yes">Yes</option>
                                                <option {{$cfr->action_taken_effective == 'No' ? 'selected' : ''}} value="No">No</option>
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
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">If NO, What Action Was Taken?</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="what_action_was_taken"
                                                      id="what_action_was_taken" cols="30"
                                                      rows="2">{{$cfr->what_action_was_taken}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">If NO, Action Taken By</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="action_taken_by"
                                                   value="{{$cfr->action_taken_by}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Date of Feedback</label>
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="date_of_feedback" value="{{$cfr->date_of_feedback}}"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">CPAR Required?</label>
                                        <select name="cpar_required" data-control="select2"
                                                data-placeholder="Select a position..."
                                                class="form-select form-select-solid">
                                            <option selected value=""></option>
                                            <option {{$cfr->cpar_required == "Yes" ? 'selected' : ''}} value="Yes">Yes
                                            </option>
                                            <option {{$cfr->cpar_required == "No" ? 'selected' : ''}} value="No">No
                                            </option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">If Yes, CPAR#</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="if_yes_cpar" value="{{$cfr->if_yes_cpar}}"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment (If Any)</label>
                                        <input type="hidden" name="old_attachment_field"
                                               value="{{$cfr->attachment_field}}">
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_field"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Photo Field (If Any)</label>
                                        <input type="hidden" name="old_photo_field" value="{{$cfr->attachment_field}}">
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="photo_field"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Closed By</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="closed_by" value="{{$cfr->closed_by}}"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Closure Date</label>
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="closure_date" value="{{$cfr->closure_date}}"/>
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
