@extends('layouts.app')
@section('pageTitle')
    View MOCRs Management of Change Record
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
                            <h1>View MOCRs</h1>
                        </div>
                        <div style="text-align: right" class="position-relative align-right mb-17">
                            <a href="javascript:void(0);"
                               onclick="openPopup('{{ url('/') }}/print_mocr/{{$mocr->id}}')"
                               class="btn btn-secondary"><i class="bi bi-printer fs-4 me-2"></i> Print</a>

                            <a href="{{ url('/') }}/email_mocr/{{ $mocr->id }}"
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
                                <!--begin::Form-->
                                <form action="{{route('update_mocrs')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$mocr->id}}">
                                    <!--begin::Accordion-->
                                    <div class="accordion accordion-icon-toggle" id="kt_accordion_2">
                                        <!--begin::Item-->
                                        <div class="mb-5">
                                            <!--begin::Header-->
                                            <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                 data-bs-target="#kt_accordion_2_item_1">
                                                <span class="accordion-icon">
                                                        <i class="fa-solid fa-angle-down"></i>
                                                </span>
                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">Step 1 - MOC Requested</h3>
                                            </div>
                                            <!--end::Header-->

                                            <!--begin::Body-->
                                            <div id="kt_accordion_2_item_1" class="fs-6 collapse show ps-10"
                                                 data-bs-parent="#kt_accordion_2">
                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Change Requested By</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select id="change_requested_by" name="change_requested_by" data-control="select2"
                                                                data-placeholder="Select a originator..."
                                                                class="form-select form-select-solid">
                                                            @foreach($users as $user)
                                                                <option {{$mocr->change_requested_by == $user->id ? 'selected' : ''}}
                                                                    value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Date Requested</label>
                                                        <!--end::Label-->
                                                        <!--end::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                               placeholder="Date Requested"
                                                               name="date_requested"
                                                               value="{{ format_date($mocr->date_requested)}}" readonly/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">MOCR #</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                               placeholder="Auto generated based on site"
                                                               name="mocr_id"
                                                               value="{{$mocr->mocr_id}}" readonly/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Accordion-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <!--begin::Accordion-->
                                    <div class="accordion accordion-icon-toggle mt-10" id="kt_accordion_3">
                                        <!--begin::Item-->
                                        <div class="mb-5">
                                            <!--begin::Header-->
                                            <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                 data-bs-target="#kt_accordion_3_item_1">
                                                <span class="accordion-icon">
                                                        <i class="fa-solid fa-angle-down"></i>
                                                </span>
                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">Step 2 - MOC Details</h3>
                                            </div>
                                            <!--end::Header-->

                                            <!--begin::Body-->
                                            <div id="kt_accordion_3_item_1" class="fs-6 collapse show ps-10"
                                                 data-bs-parent="#kt_accordion_3">
                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Proposed QMS Change</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid" name="proposed_qms_change"
                                                                  id="proposed_qms_change" cols="30"
                                                                  rows="2" readonly>{{$mocr->proposed_qms_change}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Purpose of Change</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid" name="purpose_of_change"
                                                                  id="purpose_of_change" cols="30"
                                                                  rows="2" readonly>{{$mocr->purpose_of_change}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Potential Consequence of Change</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid" name="potential_consequence_of_change"
                                                                  id="potential_consequence_of_change" cols="30"
                                                                  rows="2" readonly>{{$mocr->potential_consequence_of_change}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Impact on Integrity of QMS</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid" name="impact_on_integrity_of_qms"
                                                                  id="impact_on_integrity_of_qms" cols="30"
                                                                  rows="2" readonly>{{$mocr->impact_on_integrity_of_qms}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Availability of Resources</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid" name="availability_of_resources"
                                                                  id="availability_of_resources" cols="30"
                                                                  rows="2" readonly>{{$mocr->availability_of_resources}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Allocation or Reallocation of Responsibilities and Authorities</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid" name="allocation_or_reallocation"
                                                                  id="allocation_or_reallocation" cols="30"
                                                                  rows="2" readonly>{{$mocr->allocation_or_reallocation}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-12 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2 required">Additional Considerations</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control form-control-solid" name="additional_considerations"
                                                                  id="additional_considerations" cols="30"
                                                                  rows="2" readonly>{{$mocr->additional_considerations}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Accordion-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

                                    <!--begin::Accordion-->
                                    <div class="accordion accordion-icon-toggle" id="kt_accordion_4">
                                        <!--begin::Item-->
                                        <div class="mb-5">
                                            <!--begin::Header-->
                                            <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                 data-bs-target="#kt_accordion_4_item_1">
                                                <span class="accordion-icon">
                                                        <i class="fa-solid fa-angle-down"></i>
                                                </span>
                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">Step 3 MOC Authoization</h3>
                                            </div>
                                            <!--end::Header-->

                                            <!--begin::Body-->
                                            <div id="kt_accordion_4_item_1" class="fs-6 collapse show ps-10"
                                                 data-bs-parent="#kt_accordion_4">
                                                <!--begin::Input group-->
                                                <div class="row mt-10 mb-10">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Change Authorized By</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select id="change_authorized_by" name="change_authorized_by" data-control="select2"
                                                                data-placeholder="Select a originator..."
                                                                class="form-select form-select-solid">
                                                            @foreach($users as $user)
                                                                <option {{$mocr->change_authorized_by == $user->id ? 'selected' : ''}}
                                                                    value="{{$user->id}}">{{$user->first_name . " " . $user->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">Date Authorized</label>
                                                        <!--end::Label-->
                                                        <!--end::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                               placeholder="Date Authorized"
                                                               name="date_authorized"
                                                               value="{{ format_date($mocr->date_authorized)}}" readonly/>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Accordion-->

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

        jQuery(document).ready(function ($) {
            function disableSelect2(selector) {
                var $select2 = $(selector).select2();
                $select2.prop('disabled', true);
                $select2.on("select2:opening select2:closing", function (e) {
                    e.preventDefault();
                });
            }
            disableSelect2('#change_requested_by');
            disableSelect2('#change_authorized_by');
        });

    </script>
@endsection
