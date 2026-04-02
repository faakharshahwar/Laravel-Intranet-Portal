@extends('layouts.app')
@section('pageTitle')
    Mail RAR
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
                                <form action="{{route('send_email_rars')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$rar->id}}">

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
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">RAR #</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="rar_id"
                                                   value="{{$rar->rar_id}}" readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="site"
                                                   value="{{$rar->site}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Date Identified</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="date_identified"
                                                   value="{{$rar->date_identified}}" readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Department</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="department"
                                                   value="{{$rar->department}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Risk Type</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="risk_type"
                                                   value="{{$rar->risk_type}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Risk Title</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="risk_title"
                                                   value="{{$rar->risk_title}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Risk Description</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid" name="risk_description"
                                                      id="risk_description" cols="30"
                                                      rows="5" readonly>{{$rar->risk_description}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Risk Source</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="risk_source"
                                               value="{{$rar->risk_source}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Risk Category</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="risk_category"
                                                   value="{{$rar->risk_category}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Risk Probability</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="risk_probability"
                                                   value="{{$rar->risk_probability}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Risk Impact</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="risk_impact"
                                                   value="{{$rar->risk_impact}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Management System</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="management_system"
                                                   value="{{$rar->management_system}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Mitigation/Contingency</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid" name="mitigation"
                                                      id="mitigation" cols="30"
                                                      rows="5" readonly>{{$rar->mitigation}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Risk Priority</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="risk_priority"
                                                   value="{{$rar->risk_priority}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Responsible Person(s)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder="N/A"
                                                   name="responsible_person"
                                                   value="{{$rar->responsible_person}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Next Risk Review Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder="N/A"
                                                   name="next_risk_review_date"
                                                   value="{{$rar->next_risk_review_date}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">How Was Effectiveness
                                                Evaluated?</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="effectiveness_evaluated"
                                                      id="effectiveness_evaluated" cols="30"
                                                      rows="5" readonly>{{$rar->effectiveness_evaluated}}</textarea>
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
                                            <input type="text" class="form-control form-control-solid" placeholder="N/A"
                                                   name="action_taken_effective"
                                                   value="{{$rar->action_taken_effective}}" readonly/>
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
                                                      rows="2" readonly>{{$rar->what_action_was_taken}}</textarea>
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
                                                   value="{{$rar->action_taken_by}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">CPAR # (If Applicable)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="cpar_num"
                                                   value="{{$rar->action_taken_by}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Status</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="status"
                                                   value="{{$rar->status}}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Comments</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="comments"
                                                      id="comments" cols="30"
                                                      rows="5" readonly>{{$rar->comments}}</textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">Closed Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="closed_date"
                                                   value="{{$rar->closed_date}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

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
