@extends('layouts.app')
@section('pageTitle')
    View EDRs Emergency Drill Records
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
                            <h1>View EDR</h1>
                        </div>
                        <div style="text-align: right" class="position-relative align-right mb-17">
                            <a href="{{ url('/') }}/edit_edr/{{ $edr->id }}"
                               class="btn btn-light-primary"><i class="bi bi-pencil fs-4 me-2"></i>Edit</a>
                            <a href="javascript:void(0);"
                               onclick="openPopup('{{ url('/') }}/print_edr/{{ $edr->id }}')"
                               class="btn btn-secondary"><i class="bi bi-printer fs-4 me-2"></i> Print</a>

                            <a href="{{ url('/') }}/email_edr/{{ $edr->id }}" class="btn btn-secondary"><i
                                    class="bi bi-envelope fs-4 me-2"></i> Email</a>
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
                                <form action="{{route('update_edrs')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$edr->id}}">
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">EDR #</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   placeholder="Auto generated based on site"
                                                   name="edr_id" value="{{$edr->edr_id}}" readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Date and Time of Drill</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="datetime-local" class="form-control form-control-solid"
                                                   placeholder=""
                                                   name="date_and_time_drill" value="{{ $edr->date_and_time_drill }}"
                                                   readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="site" id="site" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option
                                                        {{$edr->site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
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
                                            <label class="required fs-5 fw-semibold mb-2">Type of Emergency
                                                Simulated</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="type_of_emergency_simulated" id="type_of_emergency_simulated"
                                                    data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($type_of_emergency_simulatedArr as $type_of_emergency_simulated)
                                                    <option
                                                        {{$edr->type_of_emergency_simulated == $type_of_emergency_simulated ? 'selected' : ''}} value="{{$type_of_emergency_simulated}}">{{$type_of_emergency_simulated}}</option>
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
                                            <label class="required fs-5 fw-semibold mb-2">Person(s) Conducting The
                                                Drill</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="person_conducting_the_drill"
                                                   value="{{ $edr->person_conducting_the_drill }}"/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Notification Used</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="notification_used" id="notification_used"
                                                    data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($notification_usedArr as $notification_used)
                                                    <option
                                                        {{$edr->notification_used == $notification_used ? 'selected' : ''}} value="{{$notification_used}}">{{$notification_used}}</option>
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
                                            <label class="required fs-5 fw-semibold mb-2">Staff On
                                                Duty/Participating</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="staff_on_duty"
                                                      id="staff_on_duty" cols="30"
                                                      rows="5" readonly>{{ $edr->staff_on_duty }}</textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">Attachment Staff Participating</label>
                                            <!--end::Label-->
                                            <input type="hidden" name="old_attachment_staff_participating"
                                                   value="{{$edr->attachment_staff_participating}}">
                                            <h5><a target="_blank"
                                                   href="/uploads/edrs/{{$edr->attachment_staff_participating}}">{{$edr->attachment_staff_participating}}</a>
                                            </h5>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Number Evacuated</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="number_evacuated" value="{{ $edr->number_evacuated }}"
                                                   readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Weather Conditions</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="weather_conditions"
                                                      id="weather_conditions" cols="30"
                                                      rows="5" readonly>{{ $edr->weather_conditions }}</textarea>
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
                                            <label class="required fs-5 fw-semibold mb-2">Time Required to Complete
                                                (Minutes)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="time_required" value="{{ $edr->time_required }}" readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Problems Encountered (If
                                                Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="problems_encountered"
                                                      id="problems_encountered" cols="30"
                                                      rows="5" readonly>{{ $edr->problems_encountered }}</textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">CPAR #s (If Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="cpars" value="{{ $edr->cpars }}" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2">Comments (If Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="comments"
                                                      id="comments" cols="30"
                                                      rows="5" readonly>{{ $edr->comments }}</textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">Photo 1 Description (If Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="photo_1_description"
                                                      id="photo_1_description" cols="30"
                                                      rows="5" readonly>{{ $edr->photo_1_description }}</textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">Photo 1 (If Any)</label>
                                            <!--end::Label-->
                                            <h5><a target="_blank"
                                                   href="/uploads/edrs/{{$edr->photo_1}}">{{$edr->photo_1}}</a></h5>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Photo 2 Description (If Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="photo_2_description"
                                                      id="photo_2_description" cols="30"
                                                      rows="5" readonly>{{ $edr->photo_2_description }}</textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">Photo 2 (If Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="hidden" name="old_photo_2"
                                                   value="{{$edr->photo_2}}">
                                            <h5><a target="_blank"
                                                   href="/uploads/edrs/{{$edr->photo_2}}">{{$edr->photo_2}}</a></h5>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
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
            var $select2_2 = $('#type_of_emergency_simulated').select2();
            var $select2_3 = $('#notification_used').select2();

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
