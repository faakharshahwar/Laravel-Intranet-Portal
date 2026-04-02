@extends('layouts.app')
@section('pageTitle')
    View Calibrated Devices
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
                            <h1>View Calibrated Devices</h1>
                        </div>
                        <div style="text-align: right" class="position-relative align-right mb-17">
                            <a href="{{ url('/') }}/edit_calibrated_devices/{{ $cds->id }}"
                               class="btn btn-light-primary"><i class="bi bi-pencil fs-4 me-2"></i>Edit</a>
                            <a href="javascript:void(0);"
                               onclick="openPopup('{{ url('/') }}/print_calibrated_devices/{{$cds->id}}')"
                               class="btn btn-secondary"><i class="bi bi-printer fs-4 me-2"></i> Print</a>

                            <a href="{{ url('/') }}/email_calibrated_devices/{{ $cds->id }}"
                               class="btn btn-secondary"><i class="bi bi-envelope fs-4 me-2"></i>Email</a>
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
                                <div class="me-7 mb-4">
                                    <a target="_blank"
                                       href="{{asset('uploads/calibrated_devices')}}/{{$cds->calibration_device_front_image}}">
                                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                            <img title="Device Front Image"
                                                src="{{asset('uploads/calibrated_devices')}}/{{$cds->calibration_device_front_image}}"
                                                alt="image">
                                        </div>
                                    </a>

                                    <a target="_blank"
                                       href="{{asset('uploads/calibrated_devices')}}/{{$cds->calibration_device_back_image}}">
                                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                            <img title="Device Back Image"
                                                src="{{asset('uploads/calibrated_devices')}}/{{$cds->calibration_device_back_image}}"
                                                alt="image">
                                        </div>
                                    </a>
                                </div>
                            {{--                                    {{dd($cds)}}--}}
                            <!--begin::Form-->
                                <form action="{{route('update_calibrated_devices')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$cds->id}}">

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Device ID</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="device_id" readonly value="{{$cds->device_id}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="device_id" readonly value="{{$cds->site}}"/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Calibration Category</label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="device_id" readonly value="{{$cds->calibration_category}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Calibration Report</label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="device_id" readonly value="{{$cds->calibration_report}}"/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Calibration Supplier (If
                                                Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="calibration_supplier" readonly
                                                   value="{{$cds->calibration_supplier}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Serial # (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="serial_no" readonly value="{{$cds->serial_no}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Device Description</span>
                                            {{--                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Your payment statements may very based on selected position"></i>--}}
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="device_description" readonly value="{{$cds->device_description}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Manufacturer</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="manufacturer" readonly value="{{$cds->manufacturer}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Model</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="model" readonly value="{{$cds->model}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Location</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="" name="location"
                                               value="{{$cds->location}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Calibration Type</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="serial_no" readonly value="{{$cds->calibration_type}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Calibration Frequency</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="calibration_frequency" readonly
                                               value="{{$cds->calibration_frequency}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Accuracy Required</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder=""
                                               name="accuracy_required"
                                               value="{{$cds->accuracy_required}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Standards Used</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder=""
                                               name="standards_used"
                                               value="{{$cds->standards_used}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Method of Calibration (If
                                            Any)</label>
                                        <input class="form-control form-control-solid" placeholder=""
                                               name="standards_used"
                                               value="{{$cds->method_of_calibration}}" readonly/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Nominal Values</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_nominal_values"
                                               value="{{$cds->readings_nominal_values}}" readonly/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Actual Values 1</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_1"
                                               value="{{$cds->readings_actual_values_1}}" readonly/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Actual Values 2</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_2"
                                               value="{{$cds->readings_actual_values_2}}" readonly/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Actual Values 3</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_3"
                                               value="{{$cds->readings_actual_values_3}}" readonly/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Corrected
                                            Values</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_corrected_values"
                                               value="{{$cds->readings_corrected_values}}" readonly/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Date Last Calibrated</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="date_last_calibrated" value="{{format_date($cds->date_last_calibrated)}}"
                                                   readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Next Calibration Due
                                                Date </label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="next_calibration_due_date"
                                                   value="{{format_date($cds->next_calibration_due_date)}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Temperature</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="temperature" value="{{$cds->temperature}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">C/F</label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="temp_unit" value="{{$cds->temp_unit}}" readonly/>
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Humidity</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="humidity" value="{{$cds->humidity}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Calibrated By</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="calibrated_by" value="{{$cds->calibrated_by}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Approved By</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="approved_by" value="{{$cds->approved_by}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Device Status</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="approved_by" value="{{$cds->device_status}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Calibration Status</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="approved_by" value="{{$cds->calibration_status}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Third Party Calibration Results - 'AS
                                                FOUND" Conditions</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="approved_by" value="{{$cds->tp_calibrated_results_as_found}}"
                                                   readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Third Party Calibration Results - 'AS
                                                LEFT"
                                                Conditions</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="approved_by" value="{{$cds->tp_calibrated_results_as_left}}"
                                                   readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment (If Any)</label>
                                        <a target="_blank"
                                           href="{{asset('uploads/calibrated_devices')}}/{{$cds->attachment}}">{{$cds->attachment}}</a>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">NCR # (If Out of Calibration)</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="ncr" value="{{$cds->ncr}}" readonly/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Comments, If Any</label>
                                        <textarea readonly class="form-control form-control-solid" rows="4"
                                                  name="comments"
                                                  placeholder="">{{$cds->comments}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <h1 class="mb-8">Past Years Data</h1>

                                    <div class="ajax_response"></div>

                                    <!--begin::Repeater-->
                                    <div id="kt_docs_repeater_basic">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="kt_docs_repeater_basic">
                                                @foreach ($cdsPastData as $past_data)
                                                    <div data-repeater-item-db>
                                                        <div class="form-group row mt-5">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Year</label>
                                                                <input type="text"
                                                                       class="form-control form-control-solid"
                                                                       placeholder=""
                                                                       name="past_year"
                                                                       value="{{ $past_data->past_year }}" readonly/>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-5">Attachment 1</label>
                                                                @if($past_data->past_attachment_1 != null)
                                                                    <p>
                                                                        <a target="_blank"
                                                                           href="{{asset('uploads/calibrated_devices/past_attachments')}}/{{$past_data->past_attachment_1}}">{{$past_data->past_attachment_1}}</a>
                                                                    </p>
                                                                @endif
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label mb-5">Attachment 2</label>
                                                                @if($past_data->past_attachment_2 != null)
                                                                    <p>
                                                                        <a target="_blank"
                                                                           href="{{asset('uploads/calibrated_devices/past_attachments')}}/{{$past_data->past_attachment_2}}">{{$past_data->past_attachment_2}}</a>
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->

                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Layout-->

                        <div class="text-dark order-2 order-md-1">
                            <span
                                class="text-gray-400 fw-semibold me-1">Created by <strong>{{$created_by}}</strong>. Last updated by <strong>{{$updated_by}}</strong>. </span>
                            <span
                                class="text-gray-400 fw-semibold me-1">Created at <strong>{{$cds->created_at}}</strong>. Last updated at <strong>{{$cds->updated_at}}</strong>. </span>
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
