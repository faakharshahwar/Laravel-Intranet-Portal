@extends('layouts.app')
@section('pageTitle')
    View Management Review Record
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
                            <h1>View Management Reviews</h1>
                        </div>
                        <div style="text-align: right" class="position-relative align-right mb-17">
                            <a href="javascript:void(0);"
                               onclick="openPopup('{{ url('/') }}/print_management_reviews/{{$management_reviews->id}}')"
                               class="btn btn-secondary"><i class="bi bi-printer fs-4 me-2"></i> Print</a>

                            <a href="{{ url('/') }}/email_management_reviews/{{ $management_reviews->id }}"
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
                                <form action="{{route('update_management_reviews')}}"
                                      enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$management_reviews->id}}">
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Date of Management
                                                Review</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="date_of_management_review"
                                                   value="{{format_date($management_reviews->date_of_management_review)}}" readonly/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                   name="site"
                                                   value="{{$management_reviews->site}}" readonly/>
                                            <!--end::Input-->
                                        </div>

                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">Status</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                               name="status"
                                               value="{{$management_reviews->status}}" readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Agenda/Notice</label>
                                        <a target="_blank"
                                           href="{{asset('uploads/management_reviews')}}/{{$management_reviews->agenda}}">{{$management_reviews->agenda}}</a>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--end::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Minutes Attachment</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <a target="_blank"
                                               href="{{asset('uploads/management_reviews')}}/{{$management_reviews->minutes_attachment}}">{{$management_reviews->minutes_attachment}}</a>
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
                                            <label class="fs-5 fw-semibold mb-2">Attachment 1 (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <a target="_blank"
                                               href="{{asset('uploads/management_reviews')}}/{{$management_reviews->attachment_1}}">{{$management_reviews->attachment_1}}</a>
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
                                            <label class="fs-5 fw-semibold mb-2">Attachment 2 (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <a target="_blank"
                                               href="{{asset('uploads/management_reviews')}}/{{$management_reviews->attachment_2}}">{{$management_reviews->attachment_2}}</a>
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
                                            <label class="fs-5 fw-semibold mb-2">Attachment 3 (If Any)</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <a target="_blank"
                                               href="{{asset('uploads/management_reviews')}}/{{$management_reviews->attachment_3}}">{{$management_reviews->attachment_3}}</a>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2">Comments (If Any)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid" name="comments"
                                                      id="comments" cols="30"
                                                      rows="5" readonly>{{$management_reviews->comments}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

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
