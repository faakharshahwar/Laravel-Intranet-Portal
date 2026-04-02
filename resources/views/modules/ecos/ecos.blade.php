@extends('layouts.app')

@section('pageTitle')
    {{$approval_status_text}} ECO Records
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
                                <input type="text" data-kt-user-table-filter="search"
                                       class="form-control form-control-solid w-250px ps-14" placeholder="Search ECOs">

                                <div style="margin-left: 10px">
                                    <a href="{{ url('/eco') }}" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary">All ECOs</a>
                                </div>
                                <div style="margin-left: 10px">
                                    <a href="{{ url('/eco?approval_status=1') }}" class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success">Approved ECOs</a>
                                </div>
                                <div style="margin-left: 10px">
                                    <a href="{{ url('/eco?approval_status=0') }}" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger">Rejected ECOs</a>
                                </div>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content- me-3" data-kt-user-table-toolbar="base">
                                <!--end::Export-->
                            @if(auth()->user()->can('create_eco'))
                                <!--begin::Add user-->
                                    <a href="{{route('eco_pending_for_approval')}}" class="btn btn-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <i class="fa-regular fa-circle-check"></i>
                                        <!--end::Svg Icon-->Pending for Approval
                                    </a>
                                    <!--end::Add user-->
                                @endif
                            </div>
                            <!--end::Toolbar-->

                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <!--end::Export-->
                            @if(auth()->user()->can('create_eco'))
                                <!--begin::Add user-->
                                    <a href="{{route('create_eco')}}" class="btn btn-primary">
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
                                        <!--end::Svg Icon-->Add ECO
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
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">ECO #</th>
                                        <th class="min-w-125px">Site</th>
                                        <th class="min-w-125px">Originator</th>
                                        <th class="min-w-125px">Date Originated</th>
                                        <th class="min-w-125px">ECO Part Type</th>
                                        <th class="min-w-125px">Submitted By</th>
                                        <th class="min-w-125px">Approval Status</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-semibold">
                                    @foreach($ecos as $eco)
                                        <!--begin::Table row-->
                                        <tr>
                                            <td>{{$eco->eco_id}}</td>
                                            <td>{{$eco->site}}</td>
                                            <td>{{$eco->originator_first_name}} {{$eco->originator_last_name}}</td>
                                            <td>{{$eco->date_originated}}</td>
                                            <td>{{$eco->eco_part_type}}</td>
                                            <td>{{$eco->submitter_first_name}} {{$eco->submitter_last_name}}</td>
                                            <td>{{$eco->approval_status == 1 ? 'Approved' : 'Rejected'}}</td>
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
                                                    @if(auth()->user()->can('edit_ncrs'))
                                                        <div class="menu-item px-3">
                                                            <a href="edit_eco/{{$eco->id}}"
                                                               class="menu-link px-3">Edit</a>
                                                        </div>
                                                @endif
                                                <!--end::Menu item-->
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

@endsection

@section('scripts')

@endsection
