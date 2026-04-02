@extends('layouts.app')

@section('pageTitle')
    All Documents
@endsection

@section('style')
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <!--begin::Container-->
    <div class="container-xxl custom-container" id="kt_content_container">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <div class="container-xxl custom-container" id="kt_content_container">
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

            <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                          height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                          fill="currentColor"></rect>
													<path
                                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                        fill="currentColor"></path>
												</svg>
											</span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-module-table-filter="search"
                                       class="form-control form-control-solid me-3 w-250px ps-14"
                                       placeholder="Search Document">
                            </div>
                            <!--end::Search-->
                            <div class="me-3"></div>

                            <x-site-filter-dropdown :siteArr="$siteArr" :selectedSite="$selectedSite" />

                            <div class="me-3"></div>

                            <select id="document_type" name="document_type" data-control="select2"
                                    data-placeholder="Filter By Document Type..."
                                    class="form-select form-select-solid me-3">
                                <option value="" disabled selected></option>
                                <option value="All">All</option>
                                @foreach($document_typeArr as $document_type)
                                    <option value="{{ $document_type }}" {{ $selected_document_type == $document_type ? 'selected' : '' }}>
                                        {{ $document_type }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="me-3"></div>

                            <select id="location" name="location" data-control="select2"
                                    data-placeholder="Filter By Location..."
                                    class="form-select form-select-solid me-3">
                                <option value="" disabled selected></option>
                                <option value="All">All</option>
                                @foreach($locationArr as $location)
                                    <option value="{{ $location }}" {{ $selected_location == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                            @if(auth()->user()->can('create_documents'))
                                <!--begin::Add user-->
                                    <a href="{{route('create_documents')}}" class="btn btn-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
													<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                          rx="1" transform="rotate(-90 11.364 20.364)"
                                                          fill="currentColor"></rect>
													<rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                          fill="currentColor"></rect>
												</svg>
											</span>
                                        <!--end::Svg Icon-->Add Document
                                    </a>
                                    <!--end::Add user-->
                                @endif
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_module_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">ID</th>
                                        <th class="min-w-125px">Title</th>
                                        <th class="min-w-125px">DOC ID</th>
                                        <th class="min-w-125px">Location</th>
                                        <th class="min-w-125px">Document Type</th>
                                        <th class="min-w-125px">Document Attachment</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-semibold">
                                    @foreach($documents as $document)
                                        <!--begin::Table row-->
                                        <tr>
                                            <td>{{$document->id}}</td>
                                            <td>{{$document->title}}</td>
                                            <td>{{$document->doc_id}}</td>
                                            <td>{{$document->location}}</td>
                                            <td>{{$document->document_type}}</td>
                                            <td><a target="_blank"
                                                   href="/uploads/Documents/{{$document->document_attachment}}">{{$document->document_attachment}}</a>
                                            </td>

                                            <!--begin::Action=-->
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
															<path
                                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                fill="currentColor"/>
														</svg>
													</span>
                                                    <!--end::Svg Icon--></a>
                                                <!--begin::Menu-->
                                                <div
                                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    @if(auth()->user()->can('read_documents'))
                                                        <div class="menu-item px-3">
                                                            <a href="read_documents/{{$document->id}}"
                                                               class="menu-link px-3">View</a>
                                                        </div>
                                                    @endif
                                                <!--begin::Menu item-->
                                                    @if(auth()->user()->can('edit_documents'))
                                                        <div class="menu-item px-3">
                                                            <a href="edit_documents/{{$document->id}}"
                                                               class="menu-link px-3">Edit</a>
                                                        </div>
                                                    @endif
                                                <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    @if(auth()->user()->can('delete_documents'))
                                                        <div class="menu-item px-3">
                                                            <a href="delete_documents/{{$document->id}}"
                                                               class="menu-link px-3"
                                                               data-kt-users-table-filter="delete_row"
                                                               onclick="return confirm('Are you sure you want to delete the record? If this document has been added to the DCR, it will also be deleted.')">Delete</a>
                                                        </div>
                                                @endif
                                                <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                            <!--end::Action=-->
                                        </tr>
                                        <!--end::Table row-->
                                    @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>

                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>
    <!--begin::Content-->

    <!--begin::Modal - Upload File-->
    <div class="modal fade" id="kt_modal_upload" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="{{route('import_ncrs')}}" method="POST"
                      id="kt_modal_upload_form" enctype="multipart/form-data">
                @csrf
                <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Upload CSV File</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                                  rx="1" transform="rotate(-45 6 17.3137)"
                                                                  fill="currentColor"/>
															<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                  transform="rotate(45 7.41422 6)" fill="currentColor"/>
														</svg>
													</span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body pt-10 pb-15 px-lg-17">
                        <!--begin::Input group-->
                        <div class="form-group">
                            <!--begin::Dropzone-->
                            <div class="dropzone dropzone-queue mb-2" id="kt_modal_upload_dropzone">
                                <!--begin::Controls-->
                                <div class="dropzone-panel mb-4">
                                    <input type="file" name="attachment_csv_file" accept=".csv" class="form-control">
                                </div>
                                <div class="dropzone-panel mb-4">
                                    <input style="width: 100%;" type="submit" value="Submit"
                                           class="btn btn-secondary">
                                </div>
                                <!--end::Controls-->
                            </div>
                            <!--end::Dropzone-->
                            <!--begin::Hint-->
                            <span class="form-text fs-6 text-muted">Max file size is 1MB per file.</span>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Modal body-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Upload File-->

@endsection

@section('scripts')

    <script src="{{ asset('assets/js/siteFilter.js') }}"></script>

@endsection
