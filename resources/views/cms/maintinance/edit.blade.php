@extends('cms.parent')
@section('title',__('cms.maintenance'))
@section('page-lg',__('cms.home'))
@section('main-pg-md',__('cms.maintenance_Management'))
@section('page-md',__('cms.edit_maintenance'))
@section('Content')
<div class="col-xl-12">
    <!--begin::Contacts-->
    <div class="card card-flush h-lg-100" id="kt_contacts_main">
        <!--begin::Card header-->
        <div class="card-header pt-7" id="kt_chat_contacts_header">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                <span class="svg-icon svg-icon-1 me-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                            fill="currentColor"></path>
                        <path opacity="0.3"
                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                            fill="currentColor"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <h2>{{__('cms.edit_maintenance')}}</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-5">
            <!--begin::Form-->
            <form id="create-form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                @csrf

                <!--begin::Input group-->
                <div class="fv-row mb-7 fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">{{__('cms.log')}}</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                            aria-label="Enter the contact's name." data-bs-original-title="Enter the contact's name."
                            data-kt-initialized="1"></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="number" class="form-control form-control-solid" id="d_log"  value="{{ $maint->d_lat }}">
                    <!--end::Input-->
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>

                <div class="fv-row mb-7 fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">{{__('cms.lat')}}
                        </span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                            aria-label="Enter the lat." data-kt-initialized="1"></i>
                    </label>
                    <!--end::Label-->


                    <!--begin::Input-->
                    <input type="number" class="form-control form-control-solid" id="d_lat" value="{{ $maint->d_log }}">
                    <!--end::Input-->
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>

                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                        <span class="required">{{__('cms.status')}}</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                            aria-label="Enter the contact's name." data-bs-original-title="Enter the contact's name."
                            data-kt-initialized="1"></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <div class="col-lg-8 fv-row">
                        <select class="form-select form-select-solid form-select-lg" data-control="select2"
                            name="app_status" id="app_status" data-select2-id="select2-data-10-uyhn">


                            <option value="pending" @if( $maint->app_status == 'pending') selected
                                @endif>{{__('cms.pending')}}
                            </option>
                            <option value="accepted" @if( $maint->app_status == 'accepted') selected
                                @endif>{{__('cms.accepted')}}
                            </option>
                            <option value="refused" @if( $maint->app_status == 'refused') selected
                                @endif>{{__('cms.refused')}}
                            </option>

                        </select>
                        <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        <!--end::Hint-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                            <span class="required">{{__('cms.username')}}</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                aria-label="Enter the user name." data-bs-original-title="Enter the user name."
                                data-kt-initialized="1"></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-8 fv-row">
                            <select id="technecal_id" name=" technecal_id"
                                class="form-select form-select-solid form-select-lg" data-control="select2"
                                name="technecal_id" id="technecal_id" data-select2-id="select2-data-10-uyhn">
                                @foreach ($users as $user)
                                <option data-kt-flag="flags/indonesia.svg"
                                value="{{ $user->id }}">{{$user->name}}
                                </option>



                                @endforeach

                            </select>
                            <!--end::Input-->
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            <!--end::Hint-->
                        </div>





                            <div class="d-flex justify-content-begin">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" id="active" type="checkbox" checked="checked">
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-semibold text-muted">{{__('cms.active')}}</span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>






                            <!--end::Separator-->
                            <!--begin::Action buttons-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <!--end::Button-->
                                <!--begin::Button-->

                                <button type="button" onclick="performUpdate('{{$maint->id}}')" class="btn btn-primary">
                                    <span class="indicator-label">{{__('cms.save')}}</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Action buttons-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Contacts-->
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init()
    });
</script>






<script>
    function performUpdate() {
        axios.put('/cms/main/{{$maint->id}}', {
            d_log: document.getElementById('d_log').value,
            d_lat: document.getElementById('d_lat').value,
            technecal_id: document.getElementById('technecal_id').value,
            app_status: document.getElementById('app_status').value,
            active: document.getElementById('active').checked?1:0,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/main'
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection
