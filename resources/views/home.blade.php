@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-xxl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="dashboard-heading">
                        <span class="card-label fw-bold fs-3">Key Documents / Manuals</span>
                    </h3>
                </div>

                <div class="card-header border-0 dashboard-button-container">
                    {{--                    <a href="/documents?document_type=Policy%20Statement" class="btn">Quality Policy Statement</a>--}}
                    <a target="_blank"
                       href="https://cppumpsdb.com/uploads/Documents/CPHQ-POL-IMS-001-R04%20QHSE%20(IMS)%20Policy.pdf"
                       class="btn">IMS Policy (QHSE Policy)</a>
{{--                    <a href="/documents?document_type=Objectives%20Measurements" class="btn">Objectives for Quality</a>--}}
                    <a href="/documents?document_type=ATEX%20Declaration%20Conformity" class="btn">ATEX
                        Declaration of Conformity</a>
                    <a href="/documents?document_type=Form" class="btn">Forms</a>
                    <a href="/documents?document_type=Procedure" class="btn">Procedures</a>
{{--                    <a href="/documents?location=OPM%20Operations%20Manual" class="btn">OPM Operations Manual</a>--}}
                    <a href="/documents?document_type=Manual" class="btn">IMS Manual</a>
{{--                    <a href="/documents?location=SSM%20Safety%20System%20Manual" class="btn">SSM Safety System--}}
{{--                        Manual</a>--}}
                    <a href="/documents?document_type=System%20Level%20Procedure" class="btn">IMS Procedures</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-xxl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="dashboard-heading">
                        <span class="card-label fw-bold fs-3 mb-1">Key Databases</span>
                    </h3>
                </div>
                <div class="card-header border-0 key-databases-button-container">
                    <a href="{{route('customer_feedback_records')}}" class="btn">CFRs</a>
                    <a href="{{route('continual_improvement_records')}}" class="btn">CIRs</a>
                    <a href="{{route('calibrated_devices')}}" class="btn">CDs</a>
                    <a href="{{route('cpars')}}" class="btn">CPARs</a>
                    <a href="{{route('ncrs')}}" class="btn">NCRs</a>
                    <a href="{{route('snrs')}}" class="btn">SNRs</a>
                    <a href="{{route('dcrs')}}" class="btn">DCRs</a>
                    <a href="{{route('hse')}}" class="btn">HSE Key</a>
                    <a href="{{route('training_history')}}" class="btn">Training History</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-xxl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="dashboard-heading">
                        <span class="card-label fw-bold fs-3 mb-1">External Links</span>
                    </h3>
                </div>
                <div class="card-header border-0">
                    <p><a href="https://cppumps.com" target="_blank">CheckPoint Pumps and Systems Web Site</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if(auth()->user()->can('read_continual_improvement_records') || auth()->user()->can('edit_continual_improvement_records') ||
                    auth()->user()->can('create_continual_improvement_records') || auth()->user()->can('delete_continual_improvement_records'))
                    <!--begin::Col-->
                    <div class="col-xxl-6">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xxl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold fs-3 mb-1">{{$cirHeading}}</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4"
                                           id="kt_cir_table">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fw-bold text-muted">
                                            <th class="min-w-125px">Site</th>
                                            <th class="min-w-125px">Date Originated</th>
                                            <th class="min-w-125px">Originator</th>
                                            <th class="min-w-125px">Target Completion Date</th>
                                            <th class="min-w-100px text-end">Actions</th>
                                        </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-semibold">
                                        @if(isset($cirs) && !empty($cirs))
                                            @foreach($cirs as $cir)
                                                <tr>
                                                    <td>{{$cir->site}}</td>
                                                    <td>{{$cir->date_originated}}</td>
                                                    <td>{{$cir->originator}}</td>
                                                    <td>{{$cir->target_completion_date}}</td>
                                                    <td style="text-align: right;">
                                                        <a href="{{route('continual_improvement_records')}}"
                                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                            <span class="svg-icon svg-icon-3">
																			<svg width="24" height="24"
                                                                                 viewBox="0 0 24 24" fill="none"
                                                                                 xmlns="http://www.w3.org/2000/svg">
																				<path
                                                                                    d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                                                                    fill="currentColor"></path>
																				<path opacity="0.3"
                                                                                      d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                                                                      fill="currentColor"></path>
																			</svg>
																		</span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        <a href="edit_continual_improvement_records/{{$cir->id}}"
                                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="svg-icon svg-icon-3">
																			<svg width="24" height="24"
                                                                                 viewBox="0 0 24 24" fill="none"
                                                                                 xmlns="http://www.w3.org/2000/svg">
																				<path opacity="0.3"
                                                                                      d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                                                      fill="currentColor"></path>
																				<path
                                                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                                                    fill="currentColor"></path>
																			</svg>
																		</span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
                @endif

                @if(auth()->user()->can('read_calibrated_devices') || auth()->user()->can('edit_calibrated_devices') ||
                    auth()->user()->can('create_calibrated_devices') || auth()->user()->can('delete_calibrated_devices'))
                    <!--begin::Col-->
                    <div class="col-xxl-6">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xxl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold fs-3 mb-1">{{$cdHeading}}</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4"
                                           id="kt_cd_table">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fw-bold text-muted">
                                            <th class="min-w-125px">Site</th>
                                            <th class="min-w-125px">Calibration Category</th>
                                            <th class="min-w-125px">Location</th>
                                            <th class="min-w-125px">Next Calibration Due Date</th>
                                            <th class="min-w-100px text-end">Actions</th>
                                        </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-semibold">
                                        @if(isset($cirs) && !empty($cirs))
                                            @foreach($cds as $cd)
                                                <tr>
                                                    <td>{{$cd->site}}</td>
                                                    <td>{{$cd->calibration_category}}</td>
                                                    <td>{{$cd->location}}</td>
                                                    <td>{{$cd->next_calibration_due_date}}</td>
                                                    <td style="text-align: right;">
                                                        <a href="{{route('calibrated_devices')}}"
                                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                            <span class="svg-icon svg-icon-3">
																			<svg width="24" height="24"
                                                                                 viewBox="0 0 24 24" fill="none"
                                                                                 xmlns="http://www.w3.org/2000/svg">
																				<path
                                                                                    d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                                                                    fill="currentColor"></path>
																				<path opacity="0.3"
                                                                                      d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                                                                      fill="currentColor"></path>
																			</svg>
																		</span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        <a href="edit_calibrated_devices/{{$cd->id}}"
                                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="svg-icon svg-icon-3">
																			<svg width="24" height="24"
                                                                                 viewBox="0 0 24 24" fill="none"
                                                                                 xmlns="http://www.w3.org/2000/svg">
																				<path opacity="0.3"
                                                                                      d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                                                      fill="currentColor"></path>
																				<path
                                                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                                                    fill="currentColor"></path>
																			</svg>
																		</span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <!--end::Col-->
            </div>
            <!--end::Row-->
            @endif

        </div>
        <!--end::Container-->
    </div>
@endsection

@section('scripts')
    <script>
        $("#kt_cd_table").DataTable({});
        $("#kt_cir_table").DataTable({});
    </script>
@endsection
