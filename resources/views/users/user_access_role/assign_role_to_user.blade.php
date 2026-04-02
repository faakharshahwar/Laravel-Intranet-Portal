@extends('layouts.app')
@section('pageTitle')
    Assign Role
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
                        <!--begin::Hero-->
                        <div class="position-relative mb-17">
                            <!--begin::Overlay-->
                            <div class="overlay overlay-show">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                                     style="background-image:url({{ asset('assets/media/stock/1600x800/img-1.jpg') }}"></div>
                                <!--end::Image-->
                                <!--begin::layer-->
                                <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                                <!--end::layer-->
                            </div>
                            <!--end::Overlay-->
                            <!--begin::Heading-->
                            <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                                <!--begin::Title-->
                                <h3 class="text-white fs-2qx fw-bold mb-3 m">Assign Role to User</h3>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fs-5 fw-semibold">You sit down. You stare at your screen. The cursor blinks.
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Heading-->
                        </div>
                        <!--end::-->
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
                                <form action="{{route('assign_role_to_user')}}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                @csrf
                                    <input type="hidden" name="status" id="status" value="1">
                                <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">User</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="user_id" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
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
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Role</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="role_id" data-control="select2"
                                                    data-placeholder="Select a position..."
                                                    class="form-select form-select-solid">
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->


                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->
                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
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
