@extends('layouts.app')
@section('pageTitle')
    Add NCR
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
                                <form action="{{route('update_ncrs')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$ncr->id}}">
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">NCR #</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="ncr_id"
                                                   value="{{$ncr->ncr_id}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Originating Site</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="originating_site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option
                                                        {{$ncr->originating_site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
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
                                            <label class="fs-5 fw-semibold mb-2">Date of Issue</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="date_of_issue"
                                                   value="{{$ncr->date_of_issue}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Results Area / Dept</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="results_area" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($cparResultsAreaArr as $cparResultsArea)
                                                    <option
                                                        {{$ncr->results_area == $cparResultsArea ? 'selected' : ''}} value="{{$cparResultsArea}}">{{$cparResultsArea}}</option>
                                                @endforeach
                                            </select>
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
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Responsible Site</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="responsible_site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option
                                                        {{$ncr->responsible_site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Quantity</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="quantity"
                                                   value="{{$ncr->quantity}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Product / Process Description</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" name="process_description"
                                                  id="process_description" cols="30"
                                                  rows="5">{{$ncr->process_description}}</textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Order #</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="order_num"
                                                   value="{{$ncr->order_num}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Nonconformance Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="nonconformance_type" data-control="select2"
                                                    data-placeholder="Select a value..."
                                                    class="form-select form-select-solid">
                                                @foreach($ncrNonconformanceTypeArr as $ncrNonconformanceType)
                                                    <option
                                                        {{$ncr->nonconformance_type == $ncrNonconformanceType ? 'selected' : ''}}
                                                        value="{{$ncrNonconformanceType}}">{{$ncrNonconformanceType}}</option>
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
                                            <label class="fs-5 fw-semibold mb-2">Customer (If Applicable)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder="N/A"
                                                   name="customer_if_applicable"
                                                   value="{{$ncr->customer_if_applicable}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Description of Nonconformance</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="description_of_nonconformance"
                                                      id="description_of_nonconformance" cols="30"
                                                      rows="5">{{$ncr->description_of_nonconformance}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Originator</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="originator"
                                                   value="{{$ncr->originator}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Date Originated</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="date_originated"
                                                   value="{{$ncr->date_originated}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">NCR Category</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="ncr_category" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($ncrCategoryArr as $ncrCategory)
                                                    <option
                                                        {{$ncr->ncr_category == $ncrCategory ? 'selected' : ''}} value="{{$ncrCategory}}">{{$ncrCategory}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">System Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="system_type" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($ncrSystemTypeArr as $ncrSystemType)
                                                    <option
                                                        {{$ncr->system_type == $ncrSystemType ? 'selected' : ''}} value="{{$ncrSystemType}}">{{$ncrSystemType}}</option>
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
                                            <label class="fs-5 fw-semibold mb-2">Disposition Decision</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="disposition_decision" data-control="select2"
                                                    data-placeholder="Select a Disposition Decision..."
                                                    class="form-select form-select-solid">
                                                @foreach($ncrDispositionDecisionArr as $ncrDispositionDecision)
                                                    <option
                                                        {{$ncr->disposition_decision == $ncrDispositionDecision ? 'selected' : ''}}
                                                        value="{{$ncrDispositionDecision}}">{{$ncrDispositionDecision}}</option>
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
                                            <label class="fs-5 fw-semibold mb-2">Disposition (If Other)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="disposition_if_other"
                                                      id="disposition_if_other" cols="30"
                                                      rows="5">{{$ncr->disposition_if_other}}</textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">Root Cause</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid" name="root_cause"
                                                      id="root_cause" cols="30"
                                                      rows="5">{{$ncr->root_cause}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Action To Be Taken</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid" name="action_to_be_taken"
                                                      id="action_to_be_taken" cols="30"
                                                      rows="5">{{$ncr->action_to_be_taken}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Assigned To</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="assigned_to"
                                                   value="{{$ncr->assigned_to}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Target Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="target_date"
                                                   value="{{$ncr->target_date}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Comments (If Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="comments_if_any"
                                                      id="comments_if_any" cols="30"
                                                      rows="2">{{$ncr->comments_if_any}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Authorized By</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="authorized_by"
                                                   value="{{$ncr->authorized_by}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Authorization Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="authorization_date"
                                                   value="{{$ncr->authorization_date}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Action Taken</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="action_taken"
                                                      id="action_taken" cols="30"
                                                      rows="2">{{$ncr->action_taken}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

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
                                                      rows="5">{{$ncr->effectiveness_evaluated}}</textarea>
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
                                                    data-control="select2"
                                                    class="form-select form-select-solid">
                                                <option
                                                    {{$ncr->action_taken_effective == 'Yes' ? 'selected' : ''}} value="Yes">
                                                    Yes
                                                </option>
                                                <option
                                                    {{$ncr->action_taken_effective == 'No' ? 'selected' : ''}} value="No">
                                                    No
                                                </option>
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
                                                      rows="2">{{$ncr->what_action_was_taken}}</textarea>
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
                                                   value="{{$ncr->action_taken_by}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Completed By</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="completed_by"
                                                   value="{{$ncr->completed_by}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Date Completed</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="date_completed"
                                                   value="{{$ncr->date_completed}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">CPAR Required?</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="cpar_required" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                <option value=""></option>
                                                <option {{$ncr->cpar_required == 'Yes' ? 'selected' : ''}} value="Yes">
                                                    Yes
                                                </option>
                                                <option {{$ncr->cpar_required == 'No' ? 'selected' : ''}} value="No">
                                                    No
                                                </option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">If Yes, CPAR#</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="cpar_num"
                                                   value="{{$ncr->cpar_num}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Closed By</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="closed_by"
                                                   value="{{$ncr->closed_by}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Closure Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="closure_date"
                                                   value="{{$ncr->closure_date}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

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
