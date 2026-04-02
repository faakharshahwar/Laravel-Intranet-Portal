@extends('layouts.app')
@section('pageTitle')
    Edit Calibrated Devices
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
                                                   name="device_id" value="{{$cds->device_id}}"/>
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
                                                    class="form-select form-select-solid">
                                                @foreach($siteArr as $site)
                                                    <option
                                                        {{$cds->site == $site ? 'selected' : ''}} value="{{$site}}">{{$site}}</option>
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
                                            <label class="fs-5 fw-semibold mb-2">Device Image 1</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="hidden" name="old_calibration_device_front_image"
                                                   value="{{$cds->calibration_device_front_image}}">
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                   name="calibration_device_front_image"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Device Image 2</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="hidden" name="old_calibration_device_back_image"
                                                   value="{{$cds->calibration_device_back_image}}">
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                   name="calibration_device_back_image"/>
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
                                            <!--begin::Input-->
                                            <select name="calibration_category" data-control="select2"
                                                    class="form-select form-select-solid">
                                                @foreach($calibrationCategoryArr as $calibrationCategory)
                                                    <option
                                                        {{$cds->calibration_category == $calibrationCategory ? 'selected' : ''}} value="{{$calibrationCategory}}">{{$calibrationCategory}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Calibration Report</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="calibration_report" data-control="select2"
                                                    class="form-select form-select-solid">
                                                <option
                                                    {{$cds->calibration_report == "Will be reviewed for completeness, approvals, NIST traceability, AS FOUND and AS LEFT conditions. Calibration Reports will be maintained as a quality record." ? 'selected' : ''}}
                                                    value="Will be reviewed for completeness, approvals, NIST traceability, AS FOUND and AS LEFT conditions. Calibration Reports will be maintained as a quality record.">
                                                    Will be reviewed for completeness, approvals, NIST traceability, "AS
                                                    FOUND" and "AS LEFT" conditions. Calibration Reports will be
                                                    maintained
                                                    as a quality record.
                                                </option>
                                                <option
                                                    {{$cds->calibration_report == "N/A" ? 'selected' : ''}} value="N/A">
                                                    N/A
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
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Calibration Supplier (If
                                                Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="calibration_supplier" value="{{$cds->calibration_supplier}}"/>
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
                                                   name="serial_no" value="{{$cds->serial_no}}"/>
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
                                               name="device_description" value="{{$cds->device_description}}"/>
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
                                                   name="manufacturer" value="{{$cds->manufacturer}}"/>
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
                                                   name="model" value="{{$cds->model}}"/>
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
                                               value="{{$cds->location}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Calibration Type</label>
                                        <select name="calibration_type" data-control="select2"
                                                data-placeholder="Select a position..."
                                                class="form-select form-select-solid">
                                            <option
                                                {{$cds->calibration_type == "Periodic Frequency" ? 'selected' : ''}} value="Periodic Frequency">
                                                Periodic Frequency
                                            </option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Calibration Frequency</label>
                                        <select name="calibration_frequency" data-control="select2"
                                                data-placeholder="Select a position..."
                                                class="form-select form-select-solid">
                                            <option
                                                {{$cds->calibration_frequency == "01 Month" ? 'selected' : ''}} value="01 Month">
                                                01 Month
                                            </option>
                                            <option
                                                {{$cds->calibration_frequency == "03 Month" ? 'selected' : ''}} value="03 Month">
                                                03 Months
                                            </option>
                                            <option
                                                {{$cds->calibration_frequency == "06 Month" ? 'selected' : ''}} value="06 Month">
                                                06 Months
                                            </option>
                                            <option
                                                {{$cds->calibration_frequency == "09 Month" ? 'selected' : ''}} value="09 Month">
                                                09 Months
                                            </option>
                                            <option
                                                {{$cds->calibration_frequency == "12 Month" ? 'selected' : ''}} value="12 Month">
                                                12 Months
                                            </option>
                                            <option
                                                {{$cds->calibration_frequency == "18 Month" ? 'selected' : ''}} value="18 Month">
                                                18 Months
                                            </option>
                                            <option
                                                {{$cds->calibration_frequency == "24 Month" ? 'selected' : ''}} value="24 Month">
                                                24 Months
                                            </option>
                                            <option
                                                {{$cds->calibration_frequency == "36 Month" ? 'selected' : ''}} value="36 Month">
                                                36 Months
                                            </option>
                                            <option
                                                {{$cds->calibration_frequency == "48 Month" ? 'selected' : ''}} value="48 Month">
                                                48 Months
                                            </option>
                                        </select>
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
                                               value="{{$cds->accuracy_required}}"/>
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
                                               value="{{$cds->standards_used}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Method of Calibration (If
                                            Any)</label>
                                        <select name="method_of_calibration" data-control="select2"
                                                data-placeholder="Select a position..."
                                                class="form-select form-select-solid">
                                            @foreach($methodOfCalibrationArr as $methodOfCalibration)
                                                <option
                                                    {{$cds->method_of_calibration == $methodOfCalibration ? 'selected' : ''}} value="{{$methodOfCalibration}}">{{$methodOfCalibration}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Nominal Values</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_nominal_values"
                                               value="{{$cds->readings_nominal_values}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Actual Values 1</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_1"
                                               value="{{$cds->readings_actual_values_1}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Readings - Actual Values 2</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_2"
                                               value="{{$cds->readings_actual_values_2}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Readings - Actual Values 3</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_3"
                                               value="{{$cds->readings_actual_values_3}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Corrected
                                            Values</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_corrected_values"
                                               value="{{$cds->readings_corrected_values}}"/>
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
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="date_last_calibrated" value="{{$cds->date_last_calibrated}}"/>
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
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="next_calibration_due_date"
                                                   value="{{$cds->next_calibration_due_date}}"/>
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
                                                   name="temperature" value="{{$cds->temperature}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">C/F</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="temp_unit" data-control="select2"
                                                    data-placeholder="Select a Unit..."
                                                    class="form-select form-select-solid">
                                                <option {{$cds->temp_unit == "C" ? 'selected' : ''}} value="C">C</option>
                                                <option {{$cds->temp_unit == "F" ? 'selected' : ''}} value="F">F</option>
                                            </select>
                                            <!--end::Input-->
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
                                                   name="humidity" value="{{$cds->humidity}}"/>
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
                                                   name="calibrated_by" value="{{$cds->calibrated_by}}"/>
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
                                                   name="approved_by" value="{{$cds->approved_by}}"/>
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
                                            <select name="device_status" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                <option
                                                    {{$cds->device_status == "Active" ? 'selected' : ''}} value="Active">
                                                    Active
                                                </option>
                                                <option
                                                    {{$cds->device_status == "Out of Service" ? 'selected' : ''}} value="Out of Service">
                                                    Out of Service
                                                </option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Calibration Status</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="calibration_status" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                <option
                                                    {{$cds->calibration_status == "Need Data" ? 'selected' : ''}} value="Need Data">
                                                    Need Data
                                                </option>
                                                <option
                                                    {{$cds->calibration_status == "Pass" ? 'selected' : ''}} value="Pass">
                                                    Pass
                                                </option>
                                                <option
                                                    {{$cds->calibration_status == "Fail" ? 'selected' : ''}} value="Fail">
                                                    Fail
                                                </option>
                                            </select>
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
                                            <select name="tp_calibrated_results_as_found" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                <option
                                                    {{$cds->tp_calibrated_results_as_found == "N/A" ? 'selected' : ''}} selected
                                                    value="N/A">N/A
                                                </option>
                                                <option
                                                    {{$cds->tp_calibrated_results_as_found == "Pass" ? 'selected' : ''}} value="Pass">
                                                    Pass
                                                </option>
                                                <option
                                                    {{$cds->tp_calibrated_results_as_found == "Fail" ? 'selected' : ''}} value="Fail">
                                                    Fail
                                                </option>
                                            </select>
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
                                            <select name="tp_calibrated_results_as_left" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                <option
                                                    {{$cds->tp_calibrated_results_as_left == "N/A" ? 'selected' : ''}} selected
                                                    value="N/A">N/A
                                                </option>
                                                <option
                                                    {{$cds->tp_calibrated_results_as_left == "Pass" ? 'selected' : ''}} value="Pass">
                                                    Pass
                                                </option>
                                                <option
                                                    {{$cds->tp_calibrated_results_as_left == "Fail" ? 'selected' : ''}} value="Fail">
                                                    Fail
                                                </option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment (If Any)</label>
                                        <input type="hidden" name="old_attachment" value="{{$cds->attachment}}">
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">NCR # (If Out of Calibration)</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="ncr" value="{{$cds->ncr}}"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Comments, If Any</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="comments"
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
                                                                <select name="past_year" data-control="select2"
                                                                        data-placeholder="Select a Year..."
                                                                        class="form-select form-select-solid"
                                                                        data-kt-repeater="select2">
                                                                    <option selected value="N/A">N/A</option>
                                                                    @foreach(getLastTenYears() as $year)
                                                                        <option
                                                                            {{$past_data->past_year == $year ? 'selected' : ''}} value="{{ $year }}">{{ $year }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Attachment 1</label>
                                                                <input type="file"
                                                                       class="form-control form-control-solid"
                                                                       placeholder=""
                                                                       name="past_attachment_1"/>
                                                                @if($past_data->past_attachment_1 != null)
                                                                    <span>
                                                                    <a target="_blank"
                                                                       href="{{asset('uploads/calibrated_devices/past_attachments')}}/{{$past_data->past_attachment_1}}">{{$past_data->past_attachment_1}}</a>
                                                                </span>
                                                                @endif
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Attachment 2</label>
                                                                <input type="file"
                                                                       class="form-control form-control-solid"
                                                                       placeholder=""
                                                                       name="past_attachment_2"/>
                                                                @if($past_data->past_attachment_2 != null)
                                                                    <span>
                                                                    <a target="_blank"
                                                                       href="{{asset('uploads/calibrated_devices/past_attachments')}}/{{$past_data->past_attachment_2}}">{{$past_data->past_attachment_2}}</a>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-3 delete_past_data">
                                                                <a href="javascript:;" data-repeater-delete
                                                                   class="btn btn-sm btn-light-danger mt-5 mt-md-9"
                                                                   data-item-id="{{$past_data->id}}">
                                                                    Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div data-repeater-item>
                                                    <div class="form-group row mt-5">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Year</label>
                                                            <select name="past_year" data-control="select2"
                                                                    data-placeholder="Select a Year..."
                                                                    class="form-select form-select-solid"
                                                                    data-kt-repeater="select2">
                                                                <option selected value="N/A">N/A</option>
                                                                @foreach(getLastTenYears() as $year)
                                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Attachment 1</label>
                                                            <input type="file"
                                                                   class="form-control form-control-solid"
                                                                   placeholder=""
                                                                   name="past_attachment_1"/>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label">Attachment 2</label>
                                                            <input type="file"
                                                                   class="form-control form-control-solid"
                                                                   placeholder=""
                                                                   name="past_attachment_2"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="javascript:;" data-repeater-delete
                                                               class="btn btn-sm btn-light-danger mt-5 mt-md-9">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="form-group mt-5 mb-5">
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                Add
                                            </a>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->

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

    <script>
        $(".delete_past_data").on("click", function () {
            var id = $(this).find('a').first().attr('data-item-id');

            $.ajax({
                url: '{{ route( 'delete_calibrated_devices_past_record' ) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                type: 'post',
                dataType: 'html',
                success: function (result) {
                    $.LoadingOverlay("hide");
                    $(".ajax_response").html(result);
                    location.reload();
                },
                beforeSend: function () {
                    $.LoadingOverlay("show");
                },
                error: function () {
                    $.LoadingOverlay("hide");
                    $(".ajax_response").html('<div class="alert alert-danger" role="alert">Something went wrong</div>');
                }
            });
        });
    </script>
@endsection
