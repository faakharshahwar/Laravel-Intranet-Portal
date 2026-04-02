<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <base href=""/>
    <title>{{$application_settings->application_name}}</title>

    <meta name="robots" content="noindex, nofollow">

    <link rel="shortcut icon" href="{{asset('uploads/application_settings')}}/{{$application_settings->favicon}}"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/global.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/fontawesome/css/fontawesome.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href={{ asset('assets/plugins/owlcarousel/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/plugins/owlcarousel/owl.theme.default.min.css') }}>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--end::Global Stylesheets Bundle-->
    <style>
        .owl-nav {
            display: flex;
            justify-content: space-between;
            position: relative;
            top: -75px; /* Adjust based on your layout */
        }

        .owl-nav button.owl-prev,
        .owl-nav button.owl-next {
            border: none;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 50%;
            z-index: 1;
            background-color: #f5f5f5;
        }
    </style>
    @yield('style')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" style="" class="header align-items-stretch">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <div class="d-flex align-items-center" id="kt_header_wrapper">
                        <!--begin::Page title-->
                        <div
                            class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 pb-5 pb-lg-0"
                            data-kt-swapper="true" data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_wrapper'}">
                            <!--begin::Heading-->

                            <a href="{{route('home')}}">
                                <img alt="Logo"
                                     src="{{asset('uploads/application_settings')}}/{{$application_settings->logo}}"
                                     class="h-25px"/>
                            </a>

                            <!--end::Heading-->
                        </div>
                        <!--end::Page title=-->
                        <div class="home-icon">
                            <a href="{{route('home')}}">
                                <i class="fa-solid fa-house"></i>
                            </a>
                        </div>
                    </div>
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between">
                        <div class="travel-btn mt-4 me-4">
                            <a href="{{route('create_travel_booking')}}" class="btn btn-sm btn-primary">Book a
                                Travel</a>
                        </div>
                        <div class="travel-btn mt-6 me-4">
                                        <span class="menu-link py-3">
                                                <a href="{{route("travel_booking")}}"><i class="fas fa-plane me-1"></i>
                                                <span class="menu-title">Travel Bookings</span></a>
                                            </span>
                        </div>
                        @if(auth()->user()->can('read_user') || auth()->user()->can('edit_user') || auth()->user()->can('create_user') || auth()->user()->can('delete_user'))
                            <!--begin::Navbar-->
                            <div class="d-flex align-items-stretch" id="kt_header_nav">
                                <!--begin::Menu wrapper-->
                                <div class="header-menu align-items-stretch" data-kt-drawer="true"
                                     data-kt-drawer-name="header-menu"
                                     data-kt-drawer-activate="{default: true, lg: false}"
                                     data-kt-drawer-overlay="true"
                                     data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                                     data-kt-drawer-direction="end"
                                     data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
                                     data-kt-swapper="true" data-kt-swapper-mode="prepend"
                                     data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                                    <!--begin::Menu-->
                                    <div
                                        class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-state-primary menu-title-gray-600 menu-arrow-gray-400 fw-semibold fs-6 my-5 my-lg-0 px-2 px-lg-0 align-items-stretch"
                                        id="#kt_header_menu" data-kt-menu="true">
                                        <!--begin:Menu item-->
                                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                             data-kt-menu-placement="bottom-start"
                                             class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                            <!--begin:Menu link-->
                                            <span class="menu-link py-3">
                                                <i class="fa-solid fa-user me-1"></i>
                                                <span class="menu-title">Users</span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0">
                                                <!--begin:Pages menu-->
                                                <div class="menu-active-bg px-4 px-lg-0">
                                                    <!--begin:Tabs nav-->
                                                    <div class="d-flex w-100 overflow-auto">
                                                        <ul class="nav nav-stretch nav-line-tabs fw-bold fs-6 p-0 p-lg-10 flex-nowrap flex-grow-1">
                                                            <!--begin:Nav item-->
                                                            <li class="nav-item mx-lg-1">
                                                                <a class="nav-link py-3 py-lg-6 active text-active-primary"
                                                                   href="#" data-bs-toggle="tab"
                                                                   data-bs-target="#kt_app_header_menu_pages_authentication">User
                                                                    Settings</a>
                                                            </li>
                                                            <!--end:Nav item-->
                                                        </ul>
                                                    </div>
                                                    <!--end:Tabs nav-->
                                                    <!--begin:Tab content-->
                                                    <div class="tab-content py-4 py-lg-8 px-lg-7">
                                                        <!--begin:Tab pane-->
                                                        <div class="tab-pane active w-lg-1000px"
                                                             id="kt_app_header_menu_pages_authentication">
                                                            <!--begin:Row-->
                                                            <div class="row">
                                                                <!--begin:Col-->
                                                                <div class="col-lg-3 mb-6 mb-lg-0">
                                                                    <!--begin:Menu section-->
                                                                    <div class="mb-0">
                                                                        <!--begin:Menu heading-->
                                                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                            User Management</h4>
                                                                        <!--end:Menu heading-->
                                                                        <!--begin:Menu item-->
                                                                        @if(auth()->user()->can('read_user') || auth()->user()->can('edit_user') ||
                                                                            auth()->user()->can('create_user') || auth()->user()->can('delete_user'))
                                                                            <div class="menu-item p-0 m-0">
                                                                                <!--begin:Menu link-->
                                                                                <a href="{{route('users_list')}}"
                                                                                   class="menu-link">
                                                                                    <span
                                                                                        class="menu-title">Users List</span>
                                                                                </a>
                                                                                <!--end:Menu link-->
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <!--end:Menu section-->
                                                                </div>
                                                                <!--end:Col-->
                                                                <!--begin:Col-->
                                                                <div class="col-lg-3 mb-6 mb-lg-0">
                                                                    <!--begin:Menu section-->
                                                                    <div class="mb-0">
                                                                        <!--begin:Menu heading-->
                                                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                            Roles</h4>
                                                                        <!--end:Menu heading-->
                                                                        <!--begin:Menu item-->
                                                                        @if(auth()->user()->can('read_calibrated_devices') || auth()->user()->can('edit_calibrated_devices') ||
                                                                            auth()->user()->can('create_calibrated_devices') || auth()->user()->can('delete_calibrated_devices'))
                                                                            <div class="menu-item p-0 m-0">
                                                                                <!--begin:Menu link-->
                                                                                <a href="{{route('role_list')}}"
                                                                                   class="menu-link">
                                                                            <span
                                                                                class="menu-title">Roles List</span>
                                                                                </a>
                                                                                <!--end:Menu link-->
                                                                            </div>
                                                                        @endif
                                                                        <!--end:Menu item-->
                                                                        @if(auth()->user()->can('read_continual_improvement_records') || auth()->user()->can('edit_continual_improvement_records') ||
                                                                            auth()->user()->can('create_continual_improvement_records') || auth()->user()->can('delete_continual_improvement_records'))
                                                                            <!--begin:Menu item-->
                                                                            <div class="menu-item p-0 m-0">
                                                                                <!--begin:Menu link-->
                                                                                <a href="{{route('user_access_role')}}"
                                                                                   class="menu-link">
                                                                            <span
                                                                                class="menu-title">User's Access Role</span>
                                                                                </a>
                                                                                <!--end:Menu link-->
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <!--end:Menu section-->
                                                                </div>
                                                                <!--end:Col-->
                                                            </div>
                                                            <!--end:Row-->
                                                        </div>
                                                        <!--end:Tab pane-->
                                                    </div>
                                                    <!--end:Tab content-->
                                                </div>
                                                <!--end:Pages menu-->
                                            </div>
                                            <!--end:Menu sub-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Menu wrapper-->
                            </div>
                        @endif

                        @if(auth()->user()->can('read_user') || auth()->user()->can('edit_user') || auth()->user()->can('create_user') || auth()->user()->can('delete_user'))
                            <!--begin::Navbar-->
                            <div class="d-flex align-items-stretch" id="kt_header_nav">
                                <!--begin::Menu wrapper-->
                                <div class="header-menu align-items-stretch" data-kt-drawer="true"
                                     data-kt-drawer-name="header-menu"
                                     data-kt-drawer-activate="{default: true, lg: false}"
                                     data-kt-drawer-overlay="true"
                                     data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                                     data-kt-drawer-direction="end"
                                     data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
                                     data-kt-swapper="true" data-kt-swapper-mode="prepend"
                                     data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                                    <!--begin::Menu-->
                                    <div
                                        class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-state-primary menu-title-gray-600 menu-arrow-gray-400 fw-semibold fs-6 my-5 my-lg-0 px-2 px-lg-0 align-items-stretch"
                                        id="#kt_header_menu" data-kt-menu="true">
                                        <!--begin:Menu item-->
                                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                             data-kt-menu-placement="bottom-start"
                                             class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                            <!--begin:Menu link-->
                                            <span class="menu-link py-3">
                                                <i class="fas fa-plane me-1"></i>
                                                <span class="menu-title">Travel Reports</span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0">
                                                <!--begin:Pages menu-->
                                                <div class="menu-active-bg px-4 px-lg-0">
                                                    <!--begin:Tabs nav-->
                                                    <div class="d-flex w-100 overflow-auto">
                                                        <ul class="nav nav-stretch nav-line-tabs fw-bold fs-6 p-0 p-lg-10 flex-nowrap flex-grow-1">
                                                            <!--begin:Nav item-->
                                                            <li class="nav-item mx-lg-1">
                                                                <a class="nav-link py-3 py-lg-6 active text-active-primary"
                                                                   href="#" data-bs-toggle="tab"
                                                                   data-bs-target="#kt_app_header_menu_pages_authentication">Travel
                                                                    Reports</a>
                                                            </li>
                                                            <!--end:Nav item-->
                                                        </ul>
                                                    </div>
                                                    <!--end:Tabs nav-->
                                                    <!--begin:Tab content-->
                                                    <div class="tab-content py-4 py-lg-8 px-lg-7">
                                                        <!--begin:Tab pane-->
                                                        <div class="tab-pane active w-lg-1000px"
                                                             id="kt_app_header_menu_pages_authentication">
                                                            <!--begin:Row-->
                                                            <div class="row">
                                                                <!--begin:Col-->
                                                                <div class="col-lg-3 mb-6 mb-lg-0">
                                                                    <!--begin:Menu section-->
                                                                    <div class="mb-0">
                                                                        <!--begin:Menu heading-->
                                                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                            Travel & Location Reports</h4>
                                                                        <!--end:Menu heading-->
                                                                        <!--begin:Menu item-->
                                                                        @if(auth()->user()->can('read_user') || auth()->user()->can('edit_user') ||
                                                                            auth()->user()->can('create_user') || auth()->user()->can('delete_user'))
                                                                            <div class="menu-item p-0 m-0">
                                                                                <!--begin:Menu link-->
                                                                                <a href="{{route('reports.travel.calendar')}}"
                                                                                   class="menu-link">
                                                                                    <span
                                                                                        class="menu-title">Upcoming Travel Schedule<em><sup>beta</sup></em></span>
                                                                                </a>
                                                                                <!--end:Menu link-->
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <!--end:Menu section-->
                                                                </div>
                                                                <!--end:Col-->
                                                                <!--begin:Col-->
                                                                <div class="col-lg-3 mb-6 mb-lg-0">
                                                                    <!--begin:Menu section-->
                                                                    <div class="mb-0">
                                                                        <!--begin:Menu heading-->
                                                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">
                                                                            Cost & Budget Report</h4>
                                                                        <!--end:Menu heading-->
                                                                        <!--begin:Menu item-->
                                                                        @if(auth()->user()->can('read_calibrated_devices') || auth()->user()->can('edit_calibrated_devices') ||
                                                                            auth()->user()->can('create_calibrated_devices') || auth()->user()->can('delete_calibrated_devices'))
                                                                            <div class="menu-item p-0 m-0">
                                                                                <!--begin:Menu link-->
                                                                                <a href="#"
                                                                                   class="menu-link">
                                                                            <span
                                                                                class="menu-title">Trip Cost Summary <em><sup>not clickable yet</sup></em></span>
                                                                                </a>
                                                                                <!--end:Menu link-->
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <!--end:Menu section-->
                                                                </div>
                                                                <!--end:Col-->
                                                            </div>
                                                            <!--end:Row-->
                                                        </div>
                                                        <!--end:Tab pane-->
                                                    </div>
                                                    <!--end:Tab content-->
                                                </div>
                                                <!--end:Pages menu-->
                                            </div>
                                            <!--end:Menu sub-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Menu wrapper-->
                            </div>
                        @endif
                        <!--end::Navbar-->
                        <!--begin::Toolbar wrapper-->
                        <div class="d-flex align-items-stretch justify-self-end flex-shrink-0">
                            <!--begin::User-->
                            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                <div class="app-settings">
                                    <a href="{{route('application_settings')}}"><i class="fa-solid fa-gear"></i></a>
                                </div>
                                <h1 class="app-name fw-semibold mt-2 me-9">{{$application_settings->application_name}}</h1>
                                <!--begin::Menu wrapper-->
                                <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                     data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                     data-kt-menu-placement="bottom-end">
                                    <img src="assets/media/avatars/man.png" alt="user"/>
                                </div>
                                <!--begin::User account menu-->
                                <div
                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo" src="assets/media/avatars/man.png"/>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">
                                                    @auth
                                                        Welcome, {{ auth()->user()->first_name . " " . auth()->user()->last_name}}
                                                    @endauth
                                                </div>
                                                @auth
                                                    <a href="#"
                                                       class="fw-semibold text-muted text-hover-primary fs-7">{{auth()->user()->email}}</a>
                                                @endauth
                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    {{--                                    <div class="menu-item px-5">--}}
                                    {{--                                        <a href="../../demo4/dist/account/overview.html" class="menu-link px-5">My--}}
                                    {{--                                            Profile</a>--}}
                                    {{--                                    </div>--}}
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="{{ route('logout') }}" class="menu-link px-5" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign
                                            Out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::User account menu-->
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User -->
                            <!--begin::Heaeder menu toggle-->
                            <div class="d-flex align-items-center d-lg-none ms-3 me-n1" title="Show header menu">
                                <div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                                     id="kt_header_menu_mobile_toggle">
                                    <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                                    <span class="svg-icon svg-icon-1">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
													<path
                                                        d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                                                        fill="currentColor"/>
													<path opacity="0.3"
                                                          d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                                                          fill="currentColor"/>
												</svg>
											</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Heaeder menu toggle-->
                        </div>
                        <!--end::Toolbar wrapper-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->
            <!--begin::Search form-->
            <div class="sub-header"
                 style="background-color: #4A4E53;">
                <h1 class="fw-semibold me-3 text-white">CheckPoint Intranet</h1>
            </div>
            <!--end::Search form-->
            <!--begin::Navs-->
            <div class="owl-carousel owl-theme menu-nav-items nav d-flex justify-content-xxl-evenly flex-wrap gap-5">
                @if(auth()->user()->can('read_documents') || auth()->user()->can('edit_documents') ||
                    auth()->user()->can('create_documents') || auth()->user()->can('delete_documents'))
                    <li style="margin-left: 15px;" class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('documents') ? 'active' : '' }}"
                           href="{{route('documents')}}" title="Documents">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Documents</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('read_audit_schedule') || auth()->user()->can('edit_audit_schedule') ||
                    auth()->user()->can('create_audit_schedule') || auth()->user()->can('delete_audit_schedule'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('audit_schedule') ? 'active' : '' }}"
                           href="{{route('audit_schedule')}}" title="Audit Schedule">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Audit Schedule</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_calibrated_devices') || auth()->user()->can('edit_calibrated_devices') ||
                    auth()->user()->can('create_calibrated_devices') || auth()->user()->can('delete_calibrated_devices'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('calibrated_devices') ? 'active' : '' }}"
                           href="{{route('calibrated_devices')}}" title="CDs Calibrated Devices">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-clone"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">CDs Calibrated Devices</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_continual_improvement_records') || auth()->user()->can('edit_continual_improvement_records') ||
                    auth()->user()->can('create_continual_improvement_records') || auth()->user()->can('delete_continual_improvement_records'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('continual_improvement_records') ? 'active' : '' }}"
                           href="{{route('continual_improvement_records')}}" title="CIRs Continual Improvement Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-clipboard"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">CIRs Continual Improvement Records</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_cpars') || auth()->user()->can('edit_cpars') ||
                    auth()->user()->can('create_cpars') || auth()->user()->can('delete_cpars'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('cpars') ? 'active' : '' }}"
                           href="{{route('cpars')}}" title="CPARs Corr./Prev. Action Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">CPARs Corr./Prev. Action Records</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_customer_feedback_records') || auth()->user()->can('edit_customer_feedback_records') ||
                    auth()->user()->can('create_customer_feedback_records') || auth()->user()->can('delete_customer_feedback_records'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('customer_feedback_records') ? 'active' : '' }}"
                           href="{{route('customer_feedback_records')}}" title="CFRs Customer Feedback Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-clipboard"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">CFRs Customer Feedback Records</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_customer_satisfaction_records') || auth()->user()->can('edit_customer_satisfaction_records') ||
                    auth()->user()->can('create_customer_satisfaction_records') || auth()->user()->can('delete_customer_satisfaction_records'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('customer_satisfaction_records') ? 'active' : '' }}"
                           href="{{route('customer_satisfaction_records')}}" title="CSRs Customer Satisfaction Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">CSRs Customer Satisfaction Records</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_dcrs') || auth()->user()->can('edit_dcrs') ||
                    auth()->user()->can('create_dcrs') || auth()->user()->can('delete_dcrs'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('dcrs') ? 'active' : '' }}"
                           href="{{route('dcrs')}}" title="DCRs">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-clipboard"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">DCRs</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_eco') || auth()->user()->can('edit_eco') ||
                auth()->user()->can('create_eco') || auth()->user()->can('delete_eco'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                        {{ \Illuminate\Support\Facades\Route::currentRouteNamed('eco') ? 'active' : '' }}"
                           href="{{route('eco')}}" title="ECOs Engineering Change Operations">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">ECOs</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_edr') || auth()->user()->can('edit_edr') ||
                    auth()->user()->can('create_edr') || auth()->user()->can('delete_edr'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                        {{ \Illuminate\Support\Facades\Route::currentRouteNamed('edrs') ? 'active' : '' }}"
                           href="{{route('edrs')}}" title="EDRs Emergency Drill Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">EDRs</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_efr') || auth()->user()->can('edit_efr') ||
                auth()->user()->can('create_efr') || auth()->user()->can('delete_efr'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                        {{ \Illuminate\Support\Facades\Route::currentRouteNamed('efrs') ? 'active' : '' }}"
                           href="{{route('efrs')}}" title="EFRs Environmental Feedback Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">EFRs</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_external_document') || auth()->user()->can('edit_external_document') ||
                    auth()->user()->can('create_external_document') || auth()->user()->can('delete_external_document'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('external_document') ? 'active' : '' }}"
                           href="{{route('external_document')}}" title="External Document">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">External Document</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_first_aid') || auth()->user()->can('edit_first_aid') ||
                    auth()->user()->can('create_first_aid') || auth()->user()->can('delete_first_aid'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                            {{ \Illuminate\Support\Facades\Route::currentRouteNamed('first_aid') ? 'active' : '' }}"
                           href="{{route('first_aid')}}" title="First Aid">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-suitcase-medical"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">First Aid</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_hse') || auth()->user()->can('edit_hse') ||
                    auth()->user()->can('create_hse') || auth()->user()->can('delete_hse'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('hse') ? 'active' : '' }}"
                           href="{{route('hse')}}" title="HSE Key Data">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">HSE Key Data</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_inspection_report') || auth()->user()->can('edit_inspection_report') ||
                    auth()->user()->can('create_inspection_report') || auth()->user()->can('delete_inspection_report'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                            {{ \Illuminate\Support\Facades\Route::currentRouteNamed('inspection_reports') ? 'active' : '' }}"
                           href="{{route('inspection_reports')}}" title="Inspection Report">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Inspection Reports</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_maintenance_list') || auth()->user()->can('edit_maintenance_list') ||
                       auth()->user()->can('create_maintenance_list') || auth()->user()->can('delete_maintenance_list'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                            {{ \Illuminate\Support\Facades\Route::currentRouteNamed('maintenance_list') ? 'active' : '' }}"
                           href="{{route('maintenance_list')}}" title="Maintenance List">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Maintenance List</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_management_reviews') || auth()->user()->can('edit_management_reviews') ||
                    auth()->user()->can('create_management_reviews') || auth()->user()->can('delete_management_reviews'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('management_reviews') ? 'active' : '' }}"
                           href="{{route('management_reviews')}}" title="Management Reviews">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Management Reviews</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_mocrs') || auth()->user()->can('edit_mocrs') ||
                    auth()->user()->can('create_mocrs') || auth()->user()->can('delete_mocrs'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('mocrs') ? 'active' : '' }}"
                           href="{{route('mocrs')}}" title="MOCRs Management of Change Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-clipboard"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">MOCRs</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_ncrs') || auth()->user()->can('edit_ncrs') ||
                    auth()->user()->can('create_ncrs') || auth()->user()->can('delete_ncrs'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('ncrs') ? 'active' : '' }}"
                           href="{{route('ncrs')}}" title="NCRs Nonconformance Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-clipboard"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">NCRs Nonconformance Records</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_permits') || auth()->user()->can('edit_permits') ||
                    auth()->user()->can('create_permits') || auth()->user()->can('delete_permits'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                            {{ \Illuminate\Support\Facades\Route::currentRouteNamed('permits') ? 'active' : '' }}"
                           href="{{route('permits')}}" title="Permits/Certificates">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-clipboard"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Permits/Certificates</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_qualified_auditors_list') || auth()->user()->can('edit_qualified_auditors_list') ||
                    auth()->user()->can('create_qualified_auditors_list') || auth()->user()->can('delete_qualified_auditors_list'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('ncrs') ? 'active' : '' }}"
                           href="{{route('qualified_auditors_list')}}" title="Qualified Auditors List">
                            <div class="nav-icon mb-3">
                                <i class="fa-regular fa-clipboard"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Qualified Auditors List</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_rars') || auth()->user()->can('edit_rars') ||
                    auth()->user()->can('create_rars') || auth()->user()->can('delete_rars'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('rars') ? 'active' : '' }}"
                           href="{{route('rars')}}" title="RARs Risk Assessment Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">RARs Risk Assessment Records</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_record_summary') || auth()->user()->can('edit_record_summary') ||
                    auth()->user()->can('create_record_summary') || auth()->user()->can('delete_record_summary'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('record_summary') ? 'active' : '' }}"
                           href="{{route('record_summary')}}" title="Record Summary">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Record Summary</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_snrs') || auth()->user()->can('edit_snrs') ||
                    auth()->user()->can('create_snrs') || auth()->user()->can('delete_snrs'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('snrs') ? 'active' : '' }}"
                           href="{{route('snrs')}}" title="SNRs Supplier Nonconformance Records">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-clipboard"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">SNRs Supplier Nonconformance Records</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->can('read_training_history') || auth()->user()->can('edit_training_history') ||
                    auth()->user()->can('create_training_history') || auth()->user()->can('delete_training_history'))
                    <li class="item nav-item mb-2">
                        <a class="nav-link btn btn-active-success btn-center rounded-3 flex-column overflow-hidden w-90px h-85px pt-7 pt-lg-5 pb-2
                {{ \Illuminate\Support\Facades\Route::currentRouteNamed('training_history') ? 'active' : '' }}"
                           href="{{route('training_history')}}" title="Training History">
                            <div class="nav-icon mb-3">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </div>
                            <span class="fw-semibold fs-7 lh-1">Training History</span>
                        </a>
                    </li>
                @endif
            </div>


            <div class="owl-nav">
                <button type="button" class="owl-prev">←</button>
                <button type="button" class="owl-next">→</button>
            </div>

            <!--end::Items-->
            <!--begin::Search form-->
            <div class="menu-icons-sub-header"
                 style="">
                @if(Route::is('home') )
                    <h1 class="fw-semibold me-3">Dashboard</h1>
                @else
                    <h1 class="fw-semibold me-3">@yield('pageTitle')</h1>
                @endif
            </div>
            <!--end::Search form-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Container-->
                @yield('content')
                <!--end::Container-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <!--begin::Container-->
                <div class="container-xxl d-flex flex-column flex-md-row flex-stack">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-gray-400 fw-semibold me-1">Created by</span>
                        <a href="https://cppumpsdb.com" target="_blank"
                           class="text-muted text-hover-primary fw-semibold me-2 fs-6">Faakhar Shahwar,</a>
                        <span class="text-gray-400 fw-semibold me-1">Powered by</span>
                        <a href="https://cppumps.com" target="_blank"
                           class="text-muted text-hover-primary fw-semibold me-2 fs-6">CP Pumps & Systems</a>
                    </div>
                    <!--end::Copyright-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->

<!--end::Main-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/fontawesome/js/fontawesome.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/plugins/owlcarousel/js/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/global-add-new.js') }}"></script>

<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
@yield('scripts')
{{--<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/custom/utilities/modals/select-location.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>--}}
<!--end::Custom Javascript-->

<script>
    jQuery(document).ready(function ($) {
        var owl = $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            dots: false,
            navText: ["←", "→"],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 5,
                    nav: true
                },
                600: {
                    items: 5,
                    nav: true
                },
                1000: {
                    items: 14,
                    nav: true,
                    loop: false
                }
            }
        });

        // Reuse 'owl' instance for next and previous triggers
        $('.owl-next').click(function () {
            owl.trigger('next.owl.carousel');
        });

        $('.owl-prev').click(function () {
            owl.trigger('prev.owl.carousel');
        });
    });


</script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"
        type="text/javascript"></script>

<script>
    function openPopup(url) {
        var popup = window.open(url, '_blank', 'width=1000,height=1000');
        if (popup) {
            popup.focus();
        } else {
            alert('Please allow popups for this site');
        }
    }
</script>

<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
