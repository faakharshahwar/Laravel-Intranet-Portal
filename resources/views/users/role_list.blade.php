@extends('layouts.app')
@section('pageTitle')
    Create Role
@endsection

@section('style')

    <!--begin::Vendor Stylesheets(used by this page)-->
    <link
        href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css') }}"/>
    <!--end::Vendor Stylesheets-->

@endsection

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <div class="ajax_response"></div>
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

            @if(session()->has('error'))

                <div class="alert alert-danger" role="alert">
                    {{session()->get('error')}}
                </div>
            @endif
            <!--begin::Row-->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">

                @foreach($role_permissions as $r)
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Card-->
                        <div class="card card-flush h-md-100">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{$r->name}}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-1">
                                <!--begin::Users-->
                                {{--                                <div class="fw-bold text-gray-600 mb-5">Total users with this role: 5</div>--}}
                                <!--end::Users-->
                                <!--begin::Permissions-->
                                <div class="d-flex flex-column text-gray-600">
                                    @foreach($r->permissions->take(4) as $p)
                                        <div class="d-flex align-items-center py-2">
                                            <span
                                                class="bullet bg-primary me-3"></span>{{Permissions_friendly_names($p->name)}}
                                        </div>
                                    @endforeach
                                    <br>
                                    <div class='d-flex align-items-center py-2'>
                                        <span class='bullet-dot bg-primary me-3'></span>
                                        <em>Click <strong>Edit</strong> to see all permissions....</em>
                                    </div>
                                </div>
                                <!--end::Permissions-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer flex-wrap pt-0">
                                {{--                                <a href="#"--}}
                                {{--                                   class="btn btn-light btn-active-primary my-1 me-2">View Role</a>--}}
                                @if(auth()->user()->can('edit_user'))
                                    <button type="button"
                                            class="edit_role_button btn btn-light btn-active-light-primary my-1"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_update_role"
                                            data-item-id="{{$r->id}}" {{$r->name == 'Super Admin' ? 'style=display:none;' : ''}}>
                                        Edit Role
                                    </button>
                                @endif
                                @if(auth()->user()->can('delete_user'))
                                    <button type="button"
                                            class="delete_role_button btn btn-danger btn-active-light-danger my-1"
                                            data-bs-toggle="modal" data-bs-target=""
                                            data-item-id="{{$r->id}}"
                                        {{$r->name == 'Super Admin' ? 'style=display:none;' : ''}}>
                                        Delete Role
                                    </button>
                                @endif
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                @endforeach
                <!--begin::Add new card-->
                <div class="ol-md-4">
                    <!--begin::Card-->
                    <div class="card h-md-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center">
                            <!--begin::Button-->
                            <button type="button" class="btn btn-clear d-flex flex-column flex-center"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                <!--begin::Illustration-->
                                <img src="assets/media/illustrations/dozzy-1/4.png" alt=""
                                     class="mw-100 mh-150px mb-7"/>
                                <!--end::Illustration-->
                                <!--begin::Label-->
                                <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                                <!--end::Label-->
                            </button>
                            <!--begin::Button-->
                        </div>
                        <!--begin::Card body-->
                    </div>
                    <!--begin::Card-->
                </div>
                <!--begin::Add new card-->
            </div>
            <!--end::Row-->
            <!--begin::Modals-->
            <!--begin::Modal - Add role-->
            <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-750px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Add a Role</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
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
                        <div class="modal-body scroll-y mx-lg-5 my-7">
                            <!--begin::Form-->
                            <form method="POST" id="kt_modal_add_role_form" class="form"
                                  action="{{route('create_role')}}">
                                @csrf
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                                     data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                     data-kt-scroll-max-height="auto"
                                     data-kt-scroll-dependencies="#kt_modal_add_role_header"
                                     data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-bold form-label mb-2">
                                            <span class="required">Role name</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input required class="form-control form-control-solid"
                                               placeholder="Enter a role name"
                                               name="role_name"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Permissions-->
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                                        <!--end::Label-->
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-semibold">
                                                <!--begin::Table row-->
                                                <tr>
                                                    <td class="text-gray-800">Administrator Access
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                           data-bs-toggle="tooltip"
                                                           title="Allows a full access to the system"></i></td>
                                                    <td>
                                                        <!--begin::Checkbox-->
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-9">
                                                            <input class="form-check-input" type="checkbox" value="1"
                                                                   id="kt_roles_select_all"/>
                                                            <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </td>
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">User Management</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_user"
                                                                       name="read_user"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_user"
                                                                       name="edit_user"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_user"
                                                                       name="create_user"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_user"
                                                                       name="delete_user"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Calibrated Devices</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_calibrated_devices"
                                                                       name="read_calibrated_devices"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_calibrated_devices"
                                                                       name="edit_calibrated_devices"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_calibrated_devices"
                                                                       name="create_calibrated_devices"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_calibrated_devices"
                                                                       name="delete_calibrated_devices"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Customer Feedback Records</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_customer_feedback_records"
                                                                       name="read_customer_feedback_records"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_customer_feedback_records"
                                                                       name="edit_customer_feedback_records"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_customer_feedback_records"
                                                                       name="create_customer_feedback_records"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_customer_feedback_records"
                                                                       name="delete_customer_feedback_records"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Continual Improvement Records</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_continual_improvement_records"
                                                                       name="read_continual_improvement_records"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_continual_improvement_records"
                                                                       name="edit_continual_improvement_records"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_continual_improvement_records"
                                                                       name="create_continual_improvement_records"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_continual_improvement_records"
                                                                       name="delete_continual_improvement_records"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">CPARS</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_cpars"
                                                                       name="read_cpars"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_cpars"
                                                                       name="edit_cpars"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_cpars"
                                                                       name="create_cpars"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_cpars"
                                                                       name="delete_cpars"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Customer Satisfaction Records</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_customer_satisfaction_records"
                                                                       name="read_customer_satisfaction_records"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_customer_satisfaction_records"
                                                                       name="edit_customer_satisfaction_records"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_customer_satisfaction_records"
                                                                       name="create_customer_satisfaction_records"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_customer_satisfaction_records"
                                                                       name="delete_customer_satisfaction_records"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">SNRS</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_snrs"
                                                                       name="read_snrs"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_snrs"
                                                                       name="edit_snrs"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_snrs"
                                                                       name="create_snrs"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_snrs"
                                                                       name="delete_snrs"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">NCRS</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_ncrs"
                                                                       name="read_ncrs"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_ncrs"
                                                                       name="edit_ncrs"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_ncrs"
                                                                       name="create_ncrs"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_ncrs"
                                                                       name="delete_ncrs"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">RARS</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_rars"
                                                                       name="read_rars"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_rars"
                                                                       name="edit_rars"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_rars"
                                                                       name="create_rars"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_rars"
                                                                       name="delete_rars"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Training History</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_training_history"
                                                                       name="read_training_history"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_training_history"
                                                                       name="edit_training_history"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_training_history"
                                                                       name="create_training_history"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_training_history"
                                                                       name="delete_training_history"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->


                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Audit Schedule</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_audit_schedule"
                                                                       name="read_audit_schedule"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_audit_schedule"
                                                                       name="edit_audit_schedule"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_audit_schedule"
                                                                       name="create_audit_schedule"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_audit_schedule"
                                                                       name="delete_audit_schedule"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Management Reviews</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_management_reviews"
                                                                       name="read_management_reviews"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_management_reviews"
                                                                       name="edit_management_reviews"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_management_reviews"
                                                                       name="create_management_reviews"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_management_reviews"
                                                                       name="delete_management_reviews"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Maintenance List</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_maintenance_list"
                                                                       name="read_maintenance_list"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_maintenance_list"
                                                                       name="edit_maintenance_list"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_maintenance_list"
                                                                       name="create_maintenance_list"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_maintenance_list"
                                                                       name="delete_maintenance_list"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Documents</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_documents"
                                                                       name="read_documents"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_documents"
                                                                       name="edit_documents"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_documents"
                                                                       name="create_documents"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_documents"
                                                                       name="delete_documents"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">DCRs</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_dcrs"
                                                                       name="read_dcrs"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_dcrs"
                                                                       name="edit_dcrs"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_dcrs"
                                                                       name="create_dcrs"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_dcrs"
                                                                       name="delete_dcrs"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">External Document</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_external_document"
                                                                       name="read_external_document"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_external_document"
                                                                       name="edit_external_document"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_external_document"
                                                                       name="create_external_document"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_external_document"
                                                                       name="delete_external_document"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Record Summary</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_record_summary"
                                                                       name="read_record_summary"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_record_summary"
                                                                       name="edit_record_summary"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_record_summary"
                                                                       name="create_record_summary"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_record_summary"
                                                                       name="delete_record_summary"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">HSE</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_hse"
                                                                       name="read_hse"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_hse"
                                                                       name="edit_hse"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_hse"
                                                                       name="create_hse"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_hse"
                                                                       name="delete_hse"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">MOCR</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_mocr"
                                                                       name="read_mocr"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_mocr"
                                                                       name="edit_mocr"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_mocr"
                                                                       name="create_mocr"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_mocr"
                                                                       name="delete_mocr"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">EDR</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_edr"
                                                                       name="read_edr"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_edr"
                                                                       name="edit_edr"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_edr"
                                                                       name="create_edr"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_edr"
                                                                       name="delete_edr"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Qualified Auditors List</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_qualified_auditors_list"
                                                                       name="read_qualified_auditors_list"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_qualified_auditors_list"
                                                                       name="edit_qualified_auditors_list"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_qualified_auditors_list"
                                                                       name="create_qualified_auditors_list"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_qualified_auditors_list"
                                                                       name="delete_qualified_auditors_list"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">First Aid</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_first_aid"
                                                                       name="read_first_aid"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_first_aid"
                                                                       name="edit_first_aid"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_first_aid"
                                                                       name="create_first_aid"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_first_aid"
                                                                       name="delete_first_aid"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Inspection Reports</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_inspection_report"
                                                                       name="read_inspection_report"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_inspection_report"
                                                                       name="edit_inspection_report"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_inspection_report"
                                                                       name="create_inspection_report"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_inspection_report"
                                                                       name="delete_inspection_report"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">EFRs</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_efr"
                                                                       name="read_efr"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_efr"
                                                                       name="edit_efr"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_efr"
                                                                       name="create_efr"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_efr"
                                                                       name="delete_efr"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Permits</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_permits"
                                                                       name="read_permits"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_permits"
                                                                       name="edit_permits"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_permits"
                                                                       name="create_permits"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_permits"
                                                                       name="delete_permits"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::Permissions-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">
                                        Discard
                                    </button>
                                    <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
														<span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add role-->
            <!--begin::Modal - Update role-->
            <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-750px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Update Role</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
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
                        <div class="modal-body scroll-y mx-5 my-7">
                            <!--begin::Form-->
                            <form method="POST" id="kt_modal_update_role_form" class="form"
                                  action="{{route('update_role')}}">
                                @csrf
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll"
                                     data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                     data-kt-scroll-max-height="auto"
                                     data-kt-scroll-dependencies="#kt_modal_update_role_header"
                                     data-kt-scroll-wrappers="#kt_modal_update_role_scroll"
                                     data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-bold form-label mb-2">
                                            <span class="required">Role name</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="role_input_field form-control form-control-solid"
                                               placeholder="Enter a role name"
                                               name="role_name" value=""/>
                                        <input class="role_input_id_field" name="role_id" type="hidden" value="">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Permissions-->
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                                        <!--end::Label-->
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table
                                                class="edit_role_permission_table table align-middle table-row-dashed fs-6 gy-5">
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-semibold">
                                                <!--begin::Table row-->
                                                <tr>
                                                    <td class="text-gray-800">Administrator Access
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                           data-bs-toggle="tooltip"
                                                           title="Allows a full access to the system"></i></td>
                                                    <td>
                                                        <!--begin::Checkbox-->
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-9">
                                                            <input class="form-check-input" type="checkbox" value="1"
                                                                   id="kt_roles_select_all"/>
                                                            <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </td>
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">User Management</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_user"
                                                                       name="read_user"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_user"
                                                                       name="edit_user"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_user"
                                                                       name="create_user"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_user"
                                                                       name="delete_user"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Calibrated Devices</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_calibrated_devices"
                                                                       name="read_calibrated_devices"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_calibrated_devices"
                                                                       name="edit_calibrated_devices"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_calibrated_devices"
                                                                       name="create_calibrated_devices"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_calibrated_devices"
                                                                       name="delete_calibrated_devices"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Customer Feedback Records</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_customer_feedback_records"
                                                                       name="read_customer_feedback_records"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_customer_feedback_records"
                                                                       name="edit_customer_feedback_records"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_customer_feedback_records"
                                                                       name="create_customer_feedback_records"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_customer_feedback_records"
                                                                       name="delete_customer_feedback_records"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Continual Improvement Records</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_continual_improvement_records"
                                                                       name="read_continual_improvement_records"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_continual_improvement_records"
                                                                       name="edit_continual_improvement_records"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_continual_improvement_records"
                                                                       name="create_continual_improvement_records"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_continual_improvement_records"
                                                                       name="delete_continual_improvement_records"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">CPARS</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_cpars"
                                                                       name="read_cpars"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_cpars"
                                                                       name="edit_cpars"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_cpars"
                                                                       name="create_cpars"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_cpars"
                                                                       name="delete_cpars"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Customer Satisfaction Records</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_customer_satisfaction_records"
                                                                       name="read_customer_satisfaction_records"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_customer_satisfaction_records"
                                                                       name="edit_customer_satisfaction_records"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_customer_satisfaction_records"
                                                                       name="create_customer_satisfaction_records"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_customer_satisfaction_records"
                                                                       name="delete_customer_satisfaction_records"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">NCRS</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_ncrs"
                                                                       name="read_ncrs"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_ncrs"
                                                                       name="edit_ncrs"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_ncrs"
                                                                       name="create_ncrs"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_ncrs"
                                                                       name="delete_ncrs"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">SNRS</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_snrs"
                                                                       name="read_snrs"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_snrs"
                                                                       name="edit_snrs"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_snrs"
                                                                       name="create_snrs"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_snrs"
                                                                       name="delete_snrs"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">RARS</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_rars"
                                                                       name="read_rars"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_rars"
                                                                       name="edit_rars"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_rars"
                                                                       name="create_rars"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_rars"
                                                                       name="delete_rars"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Training History</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_training_history"
                                                                       name="read_training_history"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_training_history"
                                                                       name="edit_training_history"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_training_history"
                                                                       name="create_training_history"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_training_history"
                                                                       name="delete_training_history"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Audit Schedule</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_audit_schedule"
                                                                       name="read_audit_schedule"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_audit_schedule"
                                                                       name="edit_audit_schedule"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_audit_schedule"
                                                                       name="create_audit_schedule"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_audit_schedule"
                                                                       name="delete_audit_schedule"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Management Reviews</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_management_reviews"
                                                                       name="read_management_reviews"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_management_reviews"
                                                                       name="edit_management_reviews"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_management_reviews"
                                                                       name="create_management_reviews"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_management_reviews"
                                                                       name="delete_management_reviews"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Maintenance List</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_maintenance_list"
                                                                       name="read_maintenance_list"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_maintenance_list"
                                                                       name="edit_maintenance_list"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_maintenance_list"
                                                                       name="create_maintenance_list"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_maintenance_list"
                                                                       name="delete_maintenance_list"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Documents</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_documents"
                                                                       name="read_documents"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_documents"
                                                                       name="edit_documents"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_documents"
                                                                       name="create_documents"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_documents"
                                                                       name="delete_documents"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">DCRs</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_dcrs"
                                                                       name="read_dcrs"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_dcrs"
                                                                       name="edit_dcrs"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_dcrs"
                                                                       name="create_dcrs"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_dcrs"
                                                                       name="delete_dcrs"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">External Document</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_external_document"
                                                                       name="read_external_document"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_external_document"
                                                                       name="edit_external_document"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_external_document"
                                                                       name="create_external_document"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_external_document"
                                                                       name="delete_external_document"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Record Summary</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_record_summary"
                                                                       name="read_record_summary"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_record_summary"
                                                                       name="edit_record_summary"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_record_summary"
                                                                       name="create_record_summary"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_record_summary"
                                                                       name="delete_record_summary"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">HSE</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_hse"
                                                                       name="read_hse"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_hse"
                                                                       name="edit_hse"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_hse"
                                                                       name="create_hse"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_hse"
                                                                       name="delete_hse"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">MOCR</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_mocr"
                                                                       name="read_mocr"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_mocr"
                                                                       name="edit_mocr"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_mocr"
                                                                       name="create_mocr"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_mocr"
                                                                       name="delete_mocr"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">EDR</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_edr"
                                                                       name="read_edr"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_edr"
                                                                       name="edit_edr"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_edr"
                                                                       name="create_edr"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_edr"
                                                                       name="delete_edr"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Qualified Auditors List</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_qualified_auditors_list"
                                                                       name="read_qualified_auditors_list"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_qualified_auditors_list"
                                                                       name="edit_qualified_auditors_list"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_qualified_auditors_list"
                                                                       name="create_qualified_auditors_list"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_qualified_auditors_list"
                                                                       name="delete_qualified_auditors_list"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">First Aid</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_first_aid"
                                                                       name="read_first_aid"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_first_aid"
                                                                       name="edit_first_aid"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_first_aid"
                                                                       name="create_first_aid"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_first_aid"
                                                                       name="delete_first_aid"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Inspection Reports</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_inspection_report"
                                                                       name="read_inspection_report"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_inspection_report"
                                                                       name="edit_inspection_report"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_inspection_report"
                                                                       name="create_inspection_report"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_inspection_report"
                                                                       name="delete_inspection_report"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">EFRs</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_efr"
                                                                       name="read_efr"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_efr"
                                                                       name="edit_efr"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_efr"
                                                                       name="create_efr"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_efr"
                                                                       name="delete_efr"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Permits</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="read_permits"
                                                                       name="read_permits"/>
                                                                <span class="form-check-label">Read</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="edit_permits"
                                                                       name="edit_permits"/>
                                                                <span class="form-check-label">Edit</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="create_permits"
                                                                       name="create_permits"/>
                                                                <span class="form-check-label">Create</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="delete_permits"
                                                                       name="delete_permits"/>
                                                                <span class="form-check-label">Delete</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->

                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::Permissions-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">
                                        Discard
                                    </button>
                                    <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
														<span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Update role-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->

@endsection

@section('scripts')

    <script src="{{ asset('assets/js/custom/apps/user-management/roles/list/add.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/roles/list/update-role.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>

    <script>
        $(".edit_role_button").map(function () {
            $(this).on("click", function () {
                $.LoadingOverlay("show");
                var id = $(this).attr('data-item-id')
                $.ajax({
                    url: '{{ route( 'edit_role' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function (result) {

                        $('.edit_role_permission_table input:checkbox ').prop('checked', false);

                        var role = result['role'];
                        $(".role_input_field").val(role);
                        $(".role_input_id_field").val(id);

                        var permissions = result['permissions'];
                        $.each(permissions, function (i, val) {
                            $(".edit_role_permission_table input[value='" + val + "']").prop('checked', true);
                        });
                        $.LoadingOverlay("hide");
                    },
                });
            });
        }).get();

        //Delete Role
        $(".delete_role_button").on("click", function () {
            var id = $(this).attr('data-item-id');

            var confirmDelete = confirm("Are you sure to delete that role?");

            if (!confirmDelete) {
                return; // Stop further execution if the user clicks 'Cancel'
            }

            $.LoadingOverlay("show");

            $.ajax({
                url: '{{ route('delete_role') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                type: 'post',
                success: function (result) {
                    $.LoadingOverlay("hide");
                    location.reload();
                    $(".ajax_response").html(result);
                },
            });
        });
    </script>

@endsection
