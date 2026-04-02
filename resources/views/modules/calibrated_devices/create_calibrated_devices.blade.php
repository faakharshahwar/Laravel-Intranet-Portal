@extends('layouts.app')
@section('pageTitle')
    Add Calibrated Devices
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
                                <form action="{{route('store_calibrated_devices')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                @csrf
                                <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Device ID</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="device_id"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Device Image 1</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
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
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($calibrationCategoryArr as $calibrationCategory)
                                                    <option
                                                        value="{{$calibrationCategory}}">{{$calibrationCategory}}</option>
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
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                <option
                                                    value="Will be reviewed for completeness, approvals, NIST traceability, AS FOUND and AS LEFT conditions. Calibration Reports will be maintained as a quality record.">
                                                    Will be reviewed for completeness, approvals, NIST traceability, "AS
                                                    FOUND" and "AS LEFT" conditions. Calibration Reports will be
                                                    maintained
                                                    as a quality record.
                                                </option>
                                                <option value="N/A">N/A</option>
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
                                                   name="calibration_supplier" value="{{old('calibration_supplier')}}"/>
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
                                                   name="serial_no" value="{{old('serial_no')}}"/>
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
                                               name="device_description" value="{{old('device_description')}}"/>
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
                                                   name="manufacturer" value="{{old('manufacturer')}}"/>
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
                                                   name="model" value="{{old('model')}}"/>
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
                                               value="{{old('location')}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Calibration Type</label>
                                        <select name="calibration_type" data-control="select2"
                                                data-placeholder="Select a position..."
                                                class="form-select form-select-solid">
                                            <option value="Periodic Frequency">Periodic Frequency</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Calibration Frequency</label>
                                        <select name="calibration_frequency" data-control="select2"
                                                data-placeholder="Select a position..."
                                                class="form-select form-select-solid">
                                            <option value="01 Month">01 Month</option>
                                            <option value="03 Month">03 Months</option>
                                            <option value="06 Month">06 Months</option>
                                            <option value="09 Month">09 Months</option>
                                            <option value="12 Month">12 Months</option>
                                            <option value="18 Month">18 Months</option>
                                            <option value="24 Month">24 Months</option>
                                            <option value="36 Month">36 Months</option>
                                            <option value="48 Month">48 Months</option>
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
                                               value="{{old('accuracy_required')}}"/>
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
                                               value="{{old('standards_used')}}"/>
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
                                                    value="{{$methodOfCalibration}}">{{$methodOfCalibration}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Nominal Values</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_nominal_values"
                                               value="{{old('readings_nominal_values')}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Actual Values 1</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_1" value="{{old('readings_actual_values_1')}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Readings - Actual Values 2</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_2" value="{{old('readings_actual_values_2')}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Readings - Actual Values 3</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_actual_values_3" value="{{old('readings_actual_values_3')}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="required fs-6 fw-semibold mb-2">Readings - Corrected
                                            Values </label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="readings_corrected_values"
                                               value="{{old('readings_corrected_values')}}"/>
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
                                                   name="date_last_calibrated" value="{{old('date_last_calibrated')}}"/>
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
                                                   value="{{old('next_calibration_due_date')}}"/>
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
                                                   name="temperature" value="{{old('temperature')}}"/>
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
                                                <option value="C">C</option>
                                                <option value="F">F</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Humidity</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="humidity" value="{{old('humidity')}}"/>
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
                                                   name="calibrated_by" value="{{old('calibrated_by')}}"/>
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
                                                   name="approved_by" value="{{old('approved_by')}}"/>
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
                                                <option value="Active">Active</option>
                                                <option value="Out of Service">Out of Service</option>
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
                                                <option value="Need Data">Need Data</option>
                                                <option value="Pass">Pass</option>
                                                <option value="Fail">Fail</option>
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
                                                <option selected value="N/A">N/A</option>
                                                <option value="Pass">Pass</option>
                                                <option value="Fail">Fail</option>
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
                                                <option selected value="N/A">N/A</option>
                                                <option value="Pass">Pass</option>
                                                <option value="Fail">Fail</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment (If Any)</label>
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">NCR # (If Out of Calibration)</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="ncr" value="{{old('ncr')}}"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Comments, If Any</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="comments"
                                                  placeholder="">{{old('comments')}}</textarea>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <h1 class="mb-8">Past Years Data</h1>

                                    <!--begin::Alert-->
                                    <div class="alert alert-primary d-flex align-items-center p-5">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                                        <!--end::Icon-->

                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Title-->
                                            <h4 class="mb-1 text-dark">You can add past data after creating the record.</h4>
                                            <!--end::Title-->

                                            <!--begin::Content-->
                                            <span>Edit the record to add past years data.</span>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Alert-->

                                    <!--begin::Separator-->
                                    <div class="separator mt-8 mb-8"></div>
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
