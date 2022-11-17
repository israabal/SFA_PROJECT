@extends('cms.parent')
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
                        <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path>
                        <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <h2>{{__('cms.edit_user')}}</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-5">
            <!--begin::Form-->
            <form id="create-form" class="form fv-plugins-bootstrap5 fv-plugins-framework" >
                @csrf
                <!--begin::Input group-->
                <div class="mb-7">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold mb-3">
                        <span>{{__('cms.Update_avatar')}}</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Allowed file types: png, jpg, jpeg." data-bs-original-title="Allowed file types: png, jpg, jpeg." data-kt-initialized="1"></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Image input wrapper-->
                    <div class="mt-1">
                        <!--begin::Image placeholder-->
                        <style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                        <!--end::Image placeholder-->
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline image-input-placeholder image-input-empty" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-100px h-100px" style="background-image: url('assets/media//avatars/300-6.jpg')"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Edit-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" id="user_image"   accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="avatar_remove" value="{{$user->image}}" >
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                    </div>
                    <!--end::Image input wrapper-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7 fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">{{__('cms.name')}}</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Enter the contact's name." data-bs-original-title="Enter the contact's name." data-kt-initialized="1"></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" id="name" value="{{$user->name}}">
                    <!--end::Input-->
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
            
                <div class="fv-row mb-7 fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">{{__('cms.email')}}
                            </span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Enter the contact's email." data-bs-original-title="Enter the contact's email." data-kt-initialized="1"></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="email" class="form-control form-control-solid" id="email" value="{{$user->email}}">
                    <!--end::Input-->
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                
                <div class="fv-row mb-7 fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">{{__('cms.roles')}}</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Enter the contact's name." data-bs-original-title="Enter the contact's name." data-kt-initialized="1"></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select-solid" data-control="select2" name="roles" id="roles" data-select2-id="select2-data-10-uyhn">
                                                        <option value="" data-select2-id="select2-data-12-0cmm">{{__('cms.choose')}}</option>
                                                        <option value="superadmin"{{($user->roles === 'superadmin') ? 'Selected' : ''}}> {{__('cms.superadmin')}}</option>
                                                        <option value="agent"{{($user->roles === 'agent') ? 'Selected' : ''}}>  {{__('cms.agent')}} </option>
                                                        <option value="technical" {{($user->roles === 'technical') ? 'Selected' : ''}}> {{__('cms.technical')}}</option>
                                                        <option value="customers" {{($user->roles === 'customers') ? 'Selected' : ''}}> {{__('cms.customers')}}</option>
                                                    </select>                    <!--end::Input-->
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                <!--end::Separator-->
                <!--begin::Action buttons-->
                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" onclick="performUpdate('{{$user->id}}')" class="btn btn-primary">
                        <span class="indicator-label">{{__('cms.Save')}}</span>
                        <span class="indicator-progress">{{__('cms.Please_wait')}}...
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
    $(function () { bsCustomFileInput.init() });
</script>
<script>
     function performUpdate(id) {
   
   var formData = new FormData();
       formData.append('name',document.getElementById('name').value);
       formData.append('email',document.getElementById('email').value);
        formData.append('image', document.getElementById('user_image').files[0]);
        formData.append('roles', document.getElementById('roles').value);
       if(document.getElementById('user_image').files[0] != undefined) {
           formData.append('image',document.getElementById('user_image').files[0]);
       }
       formData.append('_method','PUT');

       axios.post('/users/{{$user->id}}', formData)
       .then(function (response) {
           console.log(response);
           toastr.success(response.data.message);
           window.location.href = '/users';
       })
       .catch(function (error) {
           console.log(error.response);
           toastr.error(error.response.data.message);
       });
  }
</script>
@endsection