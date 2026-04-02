@extends('layouts.app')
@section('pageTitle')
    Add DCR
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
                                @if(session()->has('success'))

                                    <div class="alert alert-success" role="alert">
                                        {{session()->get('success')}}
                                    </div>

                                @endif

                                @if(session()->has('error'))

                                    <div class="alert alert-danger" role="alert">
                                        {{session()->get('error')}}
                                    </div>

                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                            @endif
                            <!--begin::Form-->
                                <form action="{{route('store_dcrs')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                @csrf
                                <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">DOC ID</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="doc_id"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Title</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="title"/>
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
                                            <label class="fs-5 fw-semibold mb-2">REV</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="number" class="form-control form-control-solid" placeholder=""
                                                   name="rev" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">DCR #</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="dcr_num" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <div class="source_document_section">

                                                <label class="fs-5 fw-semibold mb-2">Source Document</label>

                                                <select name="source_document" id="source_document" data-control="select2"
                                                        data-placeholder="Select a Source Document..."
                                                        class="form-select form-select-solid">
                                                    <option value=""></option>
                                                    @foreach($allDocuments as $documents)
                                                        <option value="{{$documents->id}}">{{$documents->document_attachment}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <em style="cursor: pointer;" class="add-new-document" data-select-name="new_source_document">Add New Document</em>
                                            </div>

                                            <!-- New Document Input (Initially hidden) -->
                                            <div id="new_document_input" style="display:none; margin-top: 15px;">
                                                <label class="fs-5 fw-semibold mb-2">Source Document</label>
                                                <input type="file" name="new_source_document" id="new_document_file" class="form-control form-control-solid" />
                                            </div>
                                            <!-- Reset Option -->
                                            <div id="reset_option" style="display:none; margin-top: 10px;">
                                                <em class="reset-option-link" style="cursor: pointer;" data-select-name="source_document">Reset</em>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->


                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Document For Approval</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                   name="document_for_approval"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Effective Date</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="effective_date"/>
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
                                            <label class="fs-5 fw-semibold mb-2">Approver 1</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="approver_1" data-control="select2"
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
                                            <label class="fs-5 fw-semibold mb-2">Approver 2</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="approver_2" data-control="select2"
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
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Approved By 1</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="approved_by_1" data-control="select2"
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
                                            <label class="fs-5 fw-semibold mb-2">Approved By 2</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <select name="approved_by_2" data-control="select2"
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
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="approved"
                                                       id="flexSwitchDefault" name="document_approved"/>
                                                <label class="form-check-label" for="flexSwitchDefault">
                                                    Do you want to approve this document?
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Approval Review Comments (If
                                                Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid"
                                                      name="approval_review_comments"
                                                      id="approval_review_comments" cols="30"
                                                      rows="5"></textarea>
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
                                            <label class="fs-5 fw-semibold mb-2">Date Approved</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="date_approved"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Training Assessed</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="date" class="form-control form-control-solid" placeholder=""
                                                   name="training_assessed"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->

{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-5 mt-6">--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-md-4 fv-row">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="1"--}}
{{--                                                       name="internal_folder" id="internal_folder"--}}
{{--                                                       onclick="return false;"/>--}}
{{--                                                <label class="form-check-label" for="internal_folder">--}}
{{--                                                    Internal Folder--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}

{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-md-4 fv-row">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="1"--}}
{{--                                                       name="external_folder" id="external_folder"--}}
{{--                                                       onclick="return false;"/>--}}
{{--                                                <label class="form-check-label" for="external_folder">--}}
{{--                                                    External Folder--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}

{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-md-4 fv-row">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="1"--}}
{{--                                                       name="distributor_folder" id="distributor_folder"--}}
{{--                                                       onclick="return false;"/>--}}
{{--                                                <label class="form-check-label" for="distributor_folder">--}}
{{--                                                    Distributor Portal--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}

{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-5 mt-6">--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-md-4 fv-row">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="1"--}}
{{--                                                       name="website_product_documents" id="website_product_documents"--}}
{{--                                                       onclick="return false;"/>--}}
{{--                                                <label class="form-check-label" for="website_product_documents">--}}
{{--                                                    Website Product Documents--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}

{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-md-4 fv-row">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="1"--}}
{{--                                                       name="website_technical_documents"--}}
{{--                                                       id="website_technical_documents" onclick="return false;"/>--}}
{{--                                                <label class="form-check-label" for="website_technical_documents">--}}
{{--                                                    Website Technical Documents--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->`--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}

                                    <!--begin::Submit-->
                                    <button type="submit" class="mt-5 btn btn-primary" id="kt_careers_submit_button">
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

        $(document).ready(function() {
            // Handle Add New Document functionality
            $('.add-new-document').on('click', function() {

                $('.source_document_section').hide();
                $('.add-new-document').hide();
                $('#new_document_input').show();
                $('#reset_option').show();
            });

            // Reset functionality to reset everything back to the dropdown state
            $('.reset-option-link').on('click', function() {
                $('.source_document_section').val('').trigger('change').show();
                $('.add-new-document').show();
                $('#new_document_input').hide();
                $('#reset_option').hide();
                $('#new_document_file').val('');
            });
        });


        $(document).ready(function () {
            // Bind the change event handler to the select element with the name "mySelect"
            $('select[name="source_document"]').change(function () {

                // Get the selected value
                var selectedSourceId = $(this).val();

                $.ajax({
                    url: '{{ route( 'get_documents_details') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "document_id": selectedSourceId,
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function (result) {
                        var doc_id = result.doc_id;
                        var title = result.title;
                        var internal_folder = result.internal_folder;
                        var external_folder = result.external_folder;
                        var distributor_folder = result.distributor_folder;
                        var website_product_documents = result.website_product_documents;
                        var website_technical_documents = result.website_technical_documents;
                        // var rev = result.rev;
                        var site = result.site;
                        var dcr_num = result.dcr_num;

                        if (site == "Applicable to All Sites") {

                            var DCRValue = "DCR-CPCP-" + dcr_num;
                            $('input[name="dcr_num"]').val(DCRValue);

                        } else if (site == "CPAE - Dubai") {

                            var DCRValue = "DCR-CPAE-" + dcr_num;
                            $('input[name="dcr_num"]').val(DCRValue);

                        } else if (site == "CPLA - Mandeville") {

                            var DCRValue = "DCR-CPLA-" + dcr_num;
                            $('input[name="dcr_num"]').val(DCRValue);
                        } else if (site == "CPTX - West Texas") {

                            var DCRValue = "DCR-CPTX-" + dcr_num;
                            $('input[name="dcr_num"]').val(DCRValue);

                        } else if (site == "CPUK - Aberdeen") {

                            var DCRValue = "DCR-CPUK-" + dcr_num;
                            $('input[name="dcr_num"]').val(DCRValue);
                        }

                        $('input[name="doc_id"]').val(doc_id);
                        $('input[name="title"]').val(title);
                        // $('input[name="rev"]').val(rev);

                        if (internal_folder == 1) {
                            $('input[name="internal_folder"]').prop('checked', true);
                        }
                        if (external_folder == 1) {
                            $('input[name="external_folder"]').prop('checked', true);
                        }
                        if (distributor_folder == 1) {
                            $('input[name="distributor_folder"]').prop('checked', true);
                        }
                        if (website_product_documents == 1) {
                            $('input[name="website_product_documents"]').prop('checked', true);
                        }
                        if (website_technical_documents == 1) {
                            $('input[name="website_technical_documents"]').prop('checked', true);
                        }
                    },
                });
            });
        });
    </script>
@endsection
