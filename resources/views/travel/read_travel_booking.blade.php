@extends('layouts.app')
@section('pageTitle')
    Read Booking
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
                                <form action="{{route('update_travel_booking')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$tb->id}}">
                                    <h1 class="mb-5">Booking Details</h1>
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Booking Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date"
                                                   class="form-control form-control-solid"
                                                   name="booking_date"
                                                   value="{{ $tb->booking_date }}"
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
                                            <label class="required fs-5 fw-semibold mb-2">Travel Type</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="travel_type" name="travel_type" data-control="select2"
                                                    data-placeholder="Select a option..."
                                                    class="form-select form-select-solid">
                                                <option value="" disabled></option>
                                                @foreach($travelArr as $travel)
                                                    <option
                                                        {{$tb->travel_type == $travel ? 'selected' : ''}} value="{{$travel}}">{{$travel}}</option>
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
                                            <label class="required fs-5 fw-semibold mb-2">Purpose of Travel</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid" rows="4"
                                                      name="purpose_of_travel"
                                                      placeholder="">{{$tb->purpose_of_travel}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Management Approval
                                                Status</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            @if($tb->management_approval_status == 1)
                                                <div class="status-message bg-light-success text-success">Approved</div>
                                            @elseif($tb->management_approval_status == 0)
                                                <div class="status-message bg-light-primary text-primary">Pending</div>
                                            @elseif($tb->management_approval_status == 2)
                                                <div class="status-message bg-light-danger text-danger">Not Approved
                                                </div>
                                            @else
                                                <div class="status-message bg-light-primary text-primary">N/A</div>
                                            @endif
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Approver Name & Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            @if($tb->management_approval_status == 0 || $tb->management_approval_status == "")
                                                <div
                                                    class="status-message bg-light-primary text-primary"> Approval
                                                    Status Pending
                                                </div>
                                            @endif

                                            @if($tb->management_approval_status == 1)
                                                <div
                                                    class="status-message bg-light-success text-success"> {{$approved_by}}
                                                    approved the booking
                                                    on {{format_date($approved_on)}}</div>
                                            @endif

                                            @if($tb->management_approval_status == 2)
                                                <div
                                                    class="status-message bg-light-danger text-danger"> {{$approved_by}}
                                                    decline the booking
                                                    on {{format_date($approved_on)}}</div>
                                            @endif
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <h1 class="mb-5">Traveler Details</h1>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Select Traveller</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="traveler" name="traveler" data-control="select2"
                                                    data-placeholder="Select a option..."
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($users as $user)
                                                    <option {{$tb->traveler == $user->id ? 'selected' : ''}}
                                                            value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
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
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Department</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="department" value="{{$department}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Nationality</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="nationality" value="{{$nationality}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Passport Number</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="passport_number" value="{{$passport_number}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Contact Number</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="contact_number" value="{{$work_phone}}" readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Home Location / Base
                                                City</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="base_city" value="{{$site}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <h1 class="mb-5">Travel Itinerary</h1>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-12 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Destination</label>
                                            <select class="form-select form-select-lg form-select-solid"
                                                    id="destination"
                                                    name="destination"
                                                    id="destination_select"
                                                    data-placeholder="Type city or country..."
                                                    style="width:100%"
                                                    data-init-id="{{ old('destination_id', isset($booking) && $booking->destination_city ? ($booking->destination_city.'|'.($booking->destination_country ?? '')) : '') }}"
                                                    data-init-text="{{ old('destination_text', isset($booking) && $booking->destination_city && $booking->destination_country ? ($booking->destination_city.', '.$booking->destination_country) : '') }}">
                                                @if(isset($tb) && $tb->destination)
                                                    <option value="{{ $tb->destination }}" selected>
                                                        {{ str_replace('|', ', ', $tb->destination) }}
                                                    </option>
                                                @endif
                                            </select>

                                            @error('destination_city')
                                            <div class="text-danger small">{{ $message }}</div> @enderror
                                            @error('destination_country')
                                            <div class="text-danger small">{{ $message }}</div> @enderror
                                        </div>

                                        <input type="hidden" name="destination_city" id="destination_city"
                                               value="{{ old('destination_city', $booking->destination_city ?? '') }}">
                                        <input type="hidden" name="destination_country" id="destination_country"
                                               value="{{ old('destination_country', $booking->destination_country ?? '') }}">
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Client / Project Name</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="client" value="{{$tb->client}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Departure Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="departure_date" value="{{$tb->departure_date}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Return Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="return_date" value="{{$tb->return_date}}" readonly/>
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
                                            <label class="required fs-5 fw-semibold mb-2">Mode of Travel</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select id="mode_of_travel" name="mode_of_travel" data-control="select2"
                                                    data-placeholder="Select a option..."
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                @foreach($modeOfTravelArr as $mode_of_travel)
                                                    <option {{$tb->mode_of_travel == $mode_of_travel ? 'selected' : ''}}
                                                            value="{{$mode_of_travel}}">{{$mode_of_travel}}</option>
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
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Booking Reference
                                                (PNR)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="booking_reference_pnr"
                                                   value="{{$tb->booking_reference_pnr}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Passenger Last Name</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="passenger_last_name" value="{{$tb->passenger_last_name}}"
                                                   readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <h1 class="mb-5">Cost & Budget</h1>
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Estimated Travel Cost (USD)</label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="estimated_travel_cost"
                                                   value="{{$tb->estimated_travel_cost}}" readonly/>
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Actual Travel Cost (USD)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="actual_travel_cost" value="{{$tb->actual_travel_cost}}"
                                                   readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <h1 class="mb-5">Compliance & Safety</h1>
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Visa Requirement</label>
                                            <select id="visa_requirement" name="visa_requirement" data-control="select2"
                                                    data-placeholder="Select a option..."
                                                    class="form-select form-select-solid">
                                                <option value="" selected disabled></option>
                                                <option
                                                    {{$tb->visa_requirement == "Yes" ? 'selected' : ''}} value="Yes">Yes
                                                </option>
                                                <option {{$tb->visa_requirement == "No" ? 'selected' : ''}} value="No">
                                                    No
                                                </option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Travel Insurance Provider (If
                                                Applicable)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="travel_insurance_provider"
                                                   value="{{$tb->travel_insurance_provider}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-6 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Emergency Contact Name</label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="emergency_contact_name" value="{{$emergency_contact_name}}"
                                                   readonly/>
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-md-12-cust fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Emergency Contact
                                                Number</label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="emergency_contact_number" value="{{$emergency_contact_phone}}"
                                                   readonly/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-12 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Safety Notes</label>
                                            <textarea class="form-control form-control-solid" rows="4"
                                                      name="safety_notes"
                                                      placeholder="" readonly>{{$tb->safety_notes}}</textarea>
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-12 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Risk Status</label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="risk_status" value="{{$tb->risk_status}}" readonly/>

                                            <!-- Loader text -->
                                            <span id="risk_loader"
                                                  style="display:none; color: #7239ea; font-style: italic;">
                                                        Checking risk status...
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <h1 class="mb-5">Additional Notes</h1>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-12 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Additional Comments</label>
                                            <textarea class="form-control form-control-solid" rows="4"
                                                      name="additional_comments"
                                                      placeholder="" readonly>{{$tb->additional_comments}}</textarea>
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <h1 class="mb-8">Attachments</h1>

                                    <div class="ajax_response"></div>

                                    <!--begin::Repeater-->
                                    <div id="kt_docs_repeater_basic">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="kt_docs_repeater_basic">
                                                @foreach ($travel_booking_attachments as $travel_booking_attachment)
                                                    <div data-repeater-item-db>
                                                        <div class="form-group row mt-5">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Attachment Type</label>
                                                                <select name="attachment_type"
                                                                        data-control="select2"
                                                                        data-placeholder="Select a option..."
                                                                        class="form-select form-select-solid"
                                                                        data-kt-repeater="select2">
                                                                    <option selected disabled value=""></option>
                                                                    @foreach($travelAttachmentsArr as $travelAttachments)
                                                                        <option
                                                                            {{$travel_booking_attachment->attachment_type == $travelAttachments ? 'selected' : ''}}
                                                                            value="{{ $travelAttachments }}">{{ $travelAttachments }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Attachment 1</label>
                                                                <input type="file"
                                                                       class="form-control form-control-solid"
                                                                       placeholder=""
                                                                       name="attachment_1"/>
                                                                @if($travel_booking_attachment->attachment_1 != null)
                                                                    <span>
                                                                    <a target="_blank"
                                                                       href="{{asset('uploads/travel_bookings')}}/{{$travel_booking_attachment->attachment_1}}">{{$travel_booking_attachment->attachment_1}}</a>
                                                                </span>
                                                                @endif
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Attachment 2</label>
                                                                <input type="file"
                                                                       class="form-control form-control-solid"
                                                                       placeholder=""
                                                                       name="attachment_2"/>
                                                                @if($travel_booking_attachment->attachment_2 != null)
                                                                    <span>
                                                                    <a target="_blank"
                                                                       href="{{asset('uploads/travel_bookings')}}/{{$travel_booking_attachment->attachment_2}}">{{$travel_booking_attachment->attachment_2}}</a>
                                                                </span>
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

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->
                                </form>
                                <!--end::Form-->

                                    <h1 class="mb-5">Change Logs</h1>

                                    @if(isset($change_logs) && $change_logs->count())
                                        <div class="table-responsive">
                                            <table class="table table-row-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Updated By</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                    <th>Changes</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($change_logs as $log)
                                                    <tr>
                                                        <td>{{ $log->created_at }}</td>
                                                        <td>
                                                            @if($log->user)
                                                                {{ $log->user->first_name }} {{ $log->user->last_name }}
                                                            @else
                                                                System
                                                            @endif
                                                        </td>

                                                        <td>{{ $log->status_at_time }}</td>
                                                        <td>{{ $log->remarks }}</td>
                                                        <td>
                                                        <pre
                                                            style="white-space: pre-wrap; margin:0;">{{ json_encode($log->changes, JSON_PRETTY_PRINT) }}</pre>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert bg-light-primary">No logs yet.</div>
                                    @endif
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
            $('select[name="traveler"]').change(function () {
                // Get the selected value
                var selectedEmployeeId = $(this).val();

                $.ajax({
                    url: '{{ route('get_traveler_details') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        employee_id: selectedEmployeeId
                    },
                    success: function (result) {
                        $('input[name="department"]').val(result.department || '');
                        $('input[name="nationality"]').val(result.nationality || '');
                        $('input[name="passport_number"]').val(result.passport_number || '');
                        $('input[name="contact_number"]').val(result.contact_number || '');
                        $('input[name="base_city"]').val(result.site || '');
                        $('input[name="emergency_contact_name"]').val(result.emergency_contact_name || '');
                        $('input[name="emergency_contact_number"]').val(result.emergency_contact_phone || '');
                    },
                    error: function (xhr) {
                        console.error('AJAX error', xhr.status, xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        (function () {
            const $sel = $('#destination_select');
            const $city = $('#destination_city');
            const $country = $('#destination_country');

            // If initialized by theme somewhere, destroy and re-init cleanly
            if ($sel.data('select2')) {
                try {
                    $sel.select2('destroy');
                } catch (e) {
                }
            }
            if ($sel.hasClass('select2-hidden-accessible')) {
                try {
                    $sel.select2('destroy');
                } catch (e) {
                }
            }

            $sel.select2({
                ajax: {
                    url: '{{ route('cities.suggest') }}',
                    dataType: 'json',
                    delay: 250,
                    data: params => ({
                        q: params.term || '',
                        limit: 20
                    }),
                    // IMPORTANT: return an object with {results: [...]}
                    processResults: data => ({results: (data && data.results) ? data.results : []})
                },
                placeholder: $sel.data('placeholder') || 'Type city or country...',
                minimumInputLength: 2,
                allowClear: true,
                width: '100%',
                dropdownParent: $sel.closest('.modal, .card, body') // helps if inside modal/card
            });

            // On select, persist strings into hidden inputs
            $sel.on('select2:select', function (e) {
                const d = (e.params && e.params.data) ? e.params.data : {};
                if (d.city) $city.val(d.city).trigger('change');
                if (d.country) $country.val(d.country).trigger('change');
            });

            // On clear, wipe hidden inputs
            $sel.on('select2:clear', function () {
                $city.val('').trigger('change');
                $country.val('').trigger('change');
            });

            // Preselect for Edit / old()
            const initId = (String($sel.data('init-id') || '')).trim();
            const initText = (String($sel.data('init-text') || '')).trim();
            const cityVal = (String($city.val() || '')).trim();
            const countryVal = (String($country.val() || '')).trim();

            let preId = initId, preText = initText;
            if (!preId && !preText && cityVal && countryVal) {
                preId = `${cityVal}|${countryVal}`;
                preText = `${cityVal}, ${countryVal}`;
            }
            if (preId && preText) {
                const opt = new Option(preText, preId, true, true);
                $sel.append(opt).trigger('change');
            }
        })();
    </script>

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
        $(".delete_attachment").on("click", function () {
            var id = $(this).find('a').first().attr('data-item-id');

            $.ajax({
                url: '{{ route( 'delete_travel_booking_attachments' ) }}',
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

    <script>
        $(function () {
            $('#destination_select').on('change', function () {
                const raw = $(this).val() || '';
                if (!raw) return;

                console.log('Risk lookup raw value:', raw); // <-- sanity check

                $.ajax({
                    url: '{{ route("api.risk.lookup") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {country: raw, _token: '{{ csrf_token() }}'},

                    beforeSend: function () {
                        $('#risk_loader').show();
                    },
                    success: function (resp) {
                        const $input = $('input[name="risk_status"]');
                        $input.val(resp.status || 'Unavailable');
                        $input.removeClass('risk-low risk-medium risk-high risk-extreme');
                        if (resp.status) $input.addClass('risk-' + resp.status.toLowerCase());
                    },
                    error: function () {
                        $('input[name="risk_status"]').val('Unavailable');
                    },
                    complete: function () {
                        $('#risk_loader').hide();
                    }
                });
            });
        });
    </script>

    <script>
        jQuery(document).ready(function ($) {
            function disableSelect2(selector) {
                var $select2 = $(selector).select2();
                $select2.prop('disabled', true);
                $select2.on("select2:opening select2:closing", function (e) {
                    e.preventDefault();
                });
            }

            disableSelect2('#travel_type');
            disableSelect2('#traveler');
            disableSelect2('#destination');
            disableSelect2('#mode_of_travel');
            disableSelect2('#visa_requirement');
        });
    </script>

@endsection
