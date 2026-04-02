@extends('layouts.app')

@section('pageTitle')
    Travel Bookings
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
                                       placeholder="Quick Search">
                            </div>
                            <!--end::Search-->

                            <div class="me-3"></div>

                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                                @if(auth()->user()->can('create_travel_booking'))
                                    <!--begin::Add user-->
                                    <a href="{{route('create_travel_booking')}}" class="btn btn-primary">
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
                                        <!--end::Svg Icon-->Book a Travel
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

                        {{-- Advanced Filters --}}
                        <form method="GET" action="{{ route('travel_booking') }}" id="tb-filters" class="mb-6">
                            <div class="row g-3 align-items-end">

                                <h1>Advance Search</h1>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Booking Date (From)</label>
                                    <input type="date" name="booking_date_from" class="form-control form-control-solid"
                                           value="{{ request('booking_date_from') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Booking Date (To)</label>
                                    <input type="date" name="booking_date_to" class="form-control form-control-solid"
                                           value="{{ request('booking_date_to') }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Approval Status</label>
                                    <select name="approval_status"
                                            class="form-select form-select-solid"
                                            data-control="select2"
                                            data-placeholder="All"
                                            data-allow-clear="true"
                                            data-selected="{{ request('approval_status') ?? '' }}">
                                        <option value="">All</option>
                                        <option value="0" @selected((string)request('approval_status')==='0')>Pending
                                        </option>
                                        <option value="1" @selected((string)request('approval_status')==='1')>Approved
                                        </option>
                                        <option value="2" @selected((string)request('approval_status')==='2')>Not
                                            Approved
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Traveller</label>
                                    <select name="traveler"
                                            class="form-select form-select-solid"
                                            data-control="select2"
                                            data-placeholder="All"
                                            data-allow-clear="true"
                                            data-selected="{{ request('traveler') ?? '' }}">
                                        <option value="">All</option>
                                        @foreach(($travellers ?? collect()) as $u)
                                            @php $uid = (string)$u->id; @endphp
                                            <option value="{{ $uid }}" @selected((string)request('traveler')===$uid)>
                                                {{ trim($u->first_name.' '.$u->last_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Destination</label>
                                    <input type="text" name="destination" class="form-control form-control-solid"
                                           placeholder="e.g., Dubai"
                                           value="{{ request('destination') }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Departure (From)</label>
                                    <input type="date" name="departure_date_from"
                                           class="form-control form-control-solid"
                                           value="{{ request('departure_date_from') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Departure (To)</label>
                                    <input type="date" name="departure_date_to" class="form-control form-control-solid"
                                           value="{{ request('departure_date_to') }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Return (From)</label>
                                    <input type="date" name="return_date_from" class="form-control form-control-solid"
                                           value="{{ request('return_date_from') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Return (To)</label>
                                    <input type="date" name="return_date_to" class="form-control form-control-solid"
                                           value="{{ request('return_date_to') }}">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">Month</label>
                                    <select name="month"
                                            class="form-select form-select-solid"
                                            data-control="select2"
                                            data-placeholder="Any"
                                            data-allow-clear="true"
                                            data-selected="{{ request('month') ?? '' }}">
                                        <option value="">Any</option>
                                        @for($m=1;$m<=12;$m++)
                                            <option value="{{ $m }}" @selected((string)request('month')===(string)$m)>
                                                {{ date('F', mktime(0,0,0,$m,1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">Year</label>
                                    <select name="year"
                                            class="form-select form-select-solid"
                                            data-control="select2"
                                            data-placeholder="Any"
                                            data-allow-clear="true"
                                            data-selected="{{ request('year') ?? '' }}">
                                        <option value="">Any</option>
                                        @for($y=(int)date('Y')+1; $y>=2000; $y--)
                                            <option value="{{ $y }}" @selected((string)request('year')===(string)$y)>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100" id="tb-apply">Apply</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('travel_booking') }}" class="btn btn-light w-100" id="tb-reset">Reset</a>
                                </div>

                            </div>
                        </form>


                        <!--begin::Table-->
                        <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_module_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 gs-0">
                                        <th class="min-w-125px">ID</th>
                                        <th class="min-w-125px">Shortcuts</th>
                                        <th class="min-w-125px">Booking Date</th>
                                        <th class="min-w-125px">Approval Status</th>
                                        <th class="min-w-125px">Approver Name & Date</th>
                                        <th class="min-w-125px">Traveller</th>
                                        <th class="min-w-125px">Destination</th>
                                        <th class="min-w-125px">Departure Date</th>
                                        <th class="min-w-125px">Return Date</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-semibold">
                                    @foreach($travel_bookings as $travel_booking)
                                        <tr>
                                            <td>{{$travel_booking->id}}</td>
                                            <td><a class="me-5"
                                                   href="read_travel_booking/{{$travel_booking->id}}"><i
                                                        class="fa-solid fa-eye"></i></a><a
                                                    href="edit_travel_booking/{{$travel_booking->id}}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a></td>
                                            <td>{{format_date($travel_booking->booking_date)}}</td>
                                            <td>
                                                @if($travel_booking->management_approval_status == 1)
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif($travel_booking->management_approval_status == 0)
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif($travel_booking->management_approval_status == 2)
                                                    <span class="badge badge-danger">Not Approved</span>
                                                @else
                                                    <span class="badge badge-secondary">N/A</span>
                                                @endif
                                            </td>

                                            <td>{{$travel_booking->approver_first_name . " " . $travel_booking->approver_last_name}}</td>
                                            <td>{{$travel_booking->traveller_first_name . " " . $travel_booking->traveller_last_name}}</td>
                                            <td>{{$travel_booking->destination}}</td>
                                            <td>{{format_date($travel_booking->departure_date)}}</td>
                                            <td>{{format_date($travel_booking->return_date)}}</td>
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
                                                    {{--                                                    @if(auth()->user()->can('read_travel_booking'))--}}
                                                    <div class="menu-item px-3">
                                                        <a href="read_travel_booking/{{$travel_booking->id}}"
                                                           class="menu-link px-3">View</a>
                                                    </div>
                                                    {{--                                                    @endif--}}
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    {{--                                                    @if(auth()->user()->can('edit_travel_booking'))--}}
                                                    <div class="menu-item px-3">
                                                        <a href="edit_travel_booking/{{$travel_booking->id}}"
                                                           class="menu-link px-3">Edit</a>
                                                    </div>
                                                    {{--                                                    @endif--}}
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    {{--                                                    @if(auth()->user()->can('delete_travel_booking'))--}}
                                                    <div class="menu-item px-3">
                                                        <a href="delete_travel_booking/{{$travel_booking->id}}"
                                                           class="menu-link px-3"
                                                           onclick="return confirm('<?php echo "Are you sure to delete that record?" ?>')"
                                                           data-kt-users-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    {{--                                                    @endif--}}
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                            <!--end::Action=-->
                                        </tr>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const $ = window.jQuery;

            // Initialize all select2 fields and restore selection
            $('select[data-control="select2"]').each(function () {
                const $el = $(this);

                // read the server-emitted value
                const selectedFromServer = $el.data('selected');

                // init select2
                $el.select2({
                    placeholder: $el.data('placeholder') || '',
                    allowClear: String($el.data('allow-clear')).toLowerCase() === 'true',
                    width: '100%'
                });

                // re-apply the selected value (Select2 can reset it when there's a placeholder)
                if (selectedFromServer !== undefined && selectedFromServer !== null && selectedFromServer !== '') {
                    $el.val(String(selectedFromServer)).trigger('change.select2');
                } else {
                    // ensure "All/Any" empty option shows correctly
                    $el.val('').trigger('change.select2');
                }
            });
        });
    </script>


    <script src="{{ asset('assets/js/siteFilter.js') }}"></script>

@endsection
