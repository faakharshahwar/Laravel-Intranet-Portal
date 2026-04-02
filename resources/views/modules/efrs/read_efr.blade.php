@extends('layouts.app')
@section('pageTitle')
    View EFRs Environmental Feedback Records
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
                            <h1>View EFR</h1>
                        </div>
                        <div style="text-align: right" class="position-relative align-right mb-17">
                            <a href="{{ url('/') }}/edit_efr/{{ $efr->id }}"
                               class="btn btn-light-primary"><i class="bi bi-pencil fs-4 me-2"></i>Edit</a>
                            <a href="javascript:void(0);"
                               onclick="openPopup('{{ url('/') }}/print_efr/{{ $efr->id }}')"
                               class="btn btn-secondary"><i class="bi bi-printer fs-4 me-2"></i>Print</a>

                            <a href="{{ url('/') }}/email_efr/{{ $efr->id }}" class="btn btn-secondary"><i
                                    class="bi bi-envelope fs-4 me-2"></i>Email</a>
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
                                <form action="{{route('update_efr')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$efr->id}}">
                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="site" name="site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option
                                                        {{$efr->site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
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
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="type" name="type" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($typeArr as $type)
                                                    <option
                                                        {{$efr->type == $type ? 'selected' : ''}} value="{{$type}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Interested Party (IP)</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="interested_party"
                                               value="{{$efr->interested_party}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">IP Location</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="ip_location"
                                               value="{{$efr->ip_location}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">IP Contact</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="ip_contact"
                                               value="{{$efr->ip_contact}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">IP Contact Telephone</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="ip_contact_telephone"
                                               value="{{$efr->ip_contact_telephone}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Feedback</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="feedback"
                                                  placeholder="" readonly>{{$efr->feedback}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Originator</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="originator" name="originator" data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$efr->originator == $user->id ? 'selected' : ''}}
                                                            value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Date Originated</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="date_originated"
                                               value="{{$efr->date_originated}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Action Taken</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="action_taken"
                                                  placeholder="" readonly>{{$efr->action_taken}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Completed By</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="completed_by" name="completed_by" data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$efr->completed_by == $user->id ? 'selected' : ''}}
                                                            value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Feedback to IP</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="feedback_to_ip"
                                                  placeholder="" readonly>{{$efr->feedback_to_ip}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Feedback to IP By</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="feedback_to_ip_by" name="feedback_to_ip_by"
                                                    data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$efr->feedback_to_ip_by == $user->id ? 'selected' : ''}}
                                                            value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Date of Feedback</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="date_of_feedback"
                                               value="{{$efr->date_of_feedback}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Closed By</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="closed_by" name="closed_by" data-control="select2"
                                                    data-placeholder="Search and Select"
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$efr->closed_by == $user->id ? 'selected' : ''}}
                                                            value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Closure Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="closure_date"
                                               value="{{$efr->closure_date}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

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
            var $select2_1 = $('#site').select2();
            var $select2_2 = $('#type').select2();
            var $select2_3 = $('#originator').select2();
            var $select2_4 = $('#completed_by').select2();
            var $select2_5 = $('#feedback_to_ip_by').select2();
            var $select2_6 = $('#closed_by').select2();

            $select2_1.prop('disabled', true);
            $select2_2.prop('disabled', true);
            $select2_3.prop('disabled', true);
            $select2_4.prop('disabled', true);
            $select2_5.prop('disabled', true);
            $select2_6.prop('disabled', true);

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
            $select2_5.on("select2:opening select2:closing", function (e) {
                e.preventDefault();
            });
            $select2_6.on("select2:opening select2:closing", function (e) {
                e.preventDefault();
            });
        });
    </script>

@endsection
