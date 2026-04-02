@extends('layouts.app')

@section('pageTitle')
    Permits
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
                                       class="form-control form-control-solid w-250px ps-14"
                                       placeholder="Search Permits">
                            </div>
                            <!--end::Search-->
                            <div class="me-3"></div>

                            <x-site-filter-dropdown :siteArr="$siteArr" :selectedSite="$selectedSite" />
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                                @if(auth()->user()->can('create_permits'))
                                    <!--begin::Add record-->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_upload">
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->
                                        <span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
													<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z"
                                                          fill="currentColor"/>
													<path
                                                        d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z"
                                                        fill="currentColor"/>
													<path opacity="0.3"
                                                          d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z"
                                                          fill="currentColor"/>
												</svg>
											</span>
                                        <!--end::Svg Icon-->Import CSV
                                    </button>
                                    <!--end::Add record-->
                                @endif

                                @if(auth()->user()->can('read_permits'))

                                    <!--begin::Export-->
                                    <a href="{{route('export_permit')}}" class="btn btn-light-primary me-3">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                        <span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
													<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1"
                                                          transform="rotate(90 12.75 4.25)" fill="currentColor"></rect>
													<path
                                                        d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                                        fill="currentColor"></path>
													<path opacity="0.3"
                                                          d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                                          fill="currentColor"></path>
												</svg>
											</span>
                                        <!--end::Svg Icon-->Export CSV
                                    </a>
                                    <!--end::Export-->
                                @endif
                                @if(auth()->user()->can('create_permits'))
                                    <!--begin::Add user-->
                                    <a href="{{route('create_permit')}}" class="btn btn-primary">
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
                                        <!--end::Svg Icon-->Add Permit
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
                                        <th class="min-w-125px">Site</th>
                                        <th class="min-w-125px">Permit Type</th>
                                        <th class="min-w-125px">Agency Type</th>
                                        <th class="min-w-125px">Expiration Date</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-semibold">
                                    @foreach($permits as $permit)
                                        <!--begin::Table row-->
                                        <tr>
                                            <td>{{$permit->id}}</td>
                                            <td>{{$permit->site}}</td>
                                            <td>{{$permit->permit_type}}</td>
                                            <td>{{$permit->agency_type}}</td>
                                            <td>{{format_date($permit->expiration_date)}}</td>

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
                                                    @if(auth()->user()->can('read_permits'))
                                                        <div class="menu-item px-3">
                                                            <a href="read_permit/{{$permit->id}}"
                                                               class="menu-link px-3">View</a>
                                                        </div>
                                                    @endif
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    @if(auth()->user()->can('edit_permits'))
                                                        <div class="menu-item px-3">
                                                            <a href="edit_permit/{{$permit->id}}"
                                                               class="menu-link px-3">Edit</a>
                                                        </div>
                                                    @endif
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    @if(auth()->user()->can('delete_permits'))
                                                        <div class="menu-item px-3">
                                                            <a href="delete_permit/{{$permit->id}}"
                                                               class="menu-link px-3"
                                                               data-kt-users-table-filter="delete_row"
                                                               onclick="return confirm('Are you sure to delete the record?')">Delete</a>
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
                <form class="form" action="{{route('import_permit')}}" method="POST"
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
