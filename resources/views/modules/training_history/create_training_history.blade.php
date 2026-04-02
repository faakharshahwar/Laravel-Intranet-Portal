@extends('layouts.app')
@section('pageTitle')
    Add Training
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
                                <form action="{{route('store_training_history')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">TRR #</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   placeholder="Auto generated"
                                                   name="trr_id"
                                                   value="" readonly/>
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
                                            <label class="fs-5 fw-semibold mb-2 required">Employee Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="employee_name" data-control="select2"
                                                    data-placeholder="Search and Select"
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
                                            <label class="fs-5 fw-semibold mb-2">Person to Notify</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="person_to_notify" readonly
                                                   value="{{old('person_to_notify')}}"/>
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
                                                   name="site" readonly value="{{old('site')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Current Job Title</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="current_job_title" readonly
                                                   value="{{old('current_job_title')}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Results Area 1</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_1" readonly value="{{old('results_area_1')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Results Area 2</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_2" readonly value="{{old('results_area_2')}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Results Area 3</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_3" readonly value="{{old('results_area_3')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Results Area 4</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_4" readonly value="{{old('results_area_4')}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Results Area 5</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_5" readonly value="{{old('results_area_5')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Results Area 6</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_6" readonly value="{{old('results_area_6')}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Results Area 7</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_7" readonly value="{{old('results_area_7')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Results Area 8</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_8" readonly value="{{old('results_area_8')}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Results Area 9</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_9" readonly value="{{old('results_area_9')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Results Area 10</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_10" readonly value="{{old('results_area_10')}}"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Results Area 11</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_11" readonly value="{{old('results_area_11')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Results Area 12</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="results_area_12" readonly value="{{old('results_area_12')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Assessment Date</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="assessment_date" value="{{old('assessment_date')}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Must Be Completed By</span>
                                            {{--                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Your payment statements may very based on selected position"></i>--}}
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="must_be_completed_by" value="{{old('must_be_completed_by')}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Learning Session Title</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="learning_session_title"
                                                   value="{{old('learning_session_title')}}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Training Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="training_type" data-api-url="/add-training-type" id="training_type"
                                                    data-placeholder="Select a training..."
                                                    class="form-select form-select-solid add-new-select">
                                                @foreach($trainingTypeArr as $trainingType)
                                                    <option value="{{$trainingType}}">{{$trainingType}}</option>
                                                @endforeach
                                                <option value="add_new">Add New</option> <!-- Add New option -->
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Instructor</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="instructor"
                                               value="{{old('instructor')}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="required fs-6 fw-semibold mb-2">Learning Time (Hours)</label>

                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="learning_time"
                                               value="{{old('learning_time')}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5">
                                        <label class="fs-6 fw-semibold mb-2">Learning Session Completion Date</label>

                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                               name="learning_session_completion_date"
                                               value="{{old('learning_session_completion_date')}}"/>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Link to Learning Module</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder=""
                                               name="link_to_learning_module"
                                               value="{{old('link_to_learning_module')}}"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Comments (If Any)</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" rows="4" name="comments"
                                                  placeholder="" spellcheck="false"></textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->


                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment 1 (If Any)</label>
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_1"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment 2 (If Any)</label>
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_2"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Attachment 3 (If Any)</label>
                                        <input type="file" class="form-control form-control-solid" placeholder=""
                                               name="attachment_3"/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Employee Status</label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="employee_status" value="{{old('employee_status')}}" disabled/>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin:`:Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                                        <h1 class="mb-8">Administrative Use Only</h1>

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-5">
                                            <label class="fs-6 fw-semibold mb-2">Training Expiry Date (If
                                                Applicable)</label>

                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="training_expiry_date"
                                                   value="{{old('training_expiry_date')}}"/>
                                        </div>
                                        <!--end::Input group-->
                                    @endif

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
        $(document).ready(function () {
            // Bind the change event handler to the select element with the name "mySelect"
            $('select[name="employee_name"]').change(function () {
                // Get the selected value
                var selectedEmployeeId = $(this).val();

                $.ajax({
                    url: '{{ route( 'get_employee_details') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "employee_id": selectedEmployeeId,
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function (result) {
                        var current_job_title = result.current_job_title;
                        var employee_status = result.employee_status;
                        var person_to_notify = result.person_to_notify;
                        var results_area_1 = result.results_area_1;
                        var results_area_2 = result.results_area_2;
                        var results_area_3 = result.results_area_3;
                        var results_area_4 = result.results_area_4;
                        var results_area_5 = result.results_area_5;
                        var results_area_6 = result.results_area_6;
                        var results_area_7 = result.results_area_7;
                        var results_area_8 = result.results_area_8;
                        var results_area_9 = result.results_area_9;
                        var results_area_10 = result.results_area_10;
                        var results_area_11 = result.results_area_11;
                        var results_area_12 = result.results_area_12;
                        var site = result.site;

                        $('input[name="current_job_title"]').val(current_job_title);
                        $('input[name="employee_status"]').val(employee_status);
                        $('input[name="person_to_notify"]').val(person_to_notify);
                        $('input[name="results_area_1"]').val(results_area_1);
                        $('input[name="results_area_2"]').val(results_area_2);
                        $('input[name="results_area_3"]').val(results_area_3);
                        $('input[name="results_area_4"]').val(results_area_4);
                        $('input[name="results_area_5"]').val(results_area_5);
                        $('input[name="results_area_6"]').val(results_area_6);
                        $('input[name="results_area_7"]').val(results_area_7);
                        $('input[name="results_area_8"]').val(results_area_8);
                        $('input[name="results_area_9"]').val(results_area_9);
                        $('input[name="results_area_10"]').val(results_area_10);
                        $('input[name="results_area_11"]').val(results_area_11);
                        $('input[name="results_area_12"]').val(results_area_12);
                        $('input[name="site"]').val(site);
                    },
                });
            });
        });
    </script>

    <script>
        jQuery(document).ready(function ($) {
            $('#training_type').on('change', function () {
                if ($(this).val() === 'add_new') {
                    $('#add-training-type-modal').modal('show');
                }
            });

            $('#save-training-type-btn').on('click', function () {
                var newTrainingType = $('#new-training-type').val().trim();

                if (newTrainingType) {
                    $.ajax({
                        url: '/add-training-type',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            training_type: newTrainingType
                        },
                        success: function (response) {
                            if (response.success) {
                                alert('Training Type added successfully!');
                                $('#training_type').append('<option value="' + newTrainingType + '">' + newTrainingType + '</option>');

                                $('#training_type').val(newTrainingType).trigger('change');

                                $('#add-training-type-modal').modal('hide');
                            } else {
                                alert('Failed to add Training Type.');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('XHR:', xhr);
                            console.error('Status:', status);
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        }
                    });
                } else {
                    alert('Please enter a valid Training Type.');
                }
            });

        });
    </script>
@endsection
