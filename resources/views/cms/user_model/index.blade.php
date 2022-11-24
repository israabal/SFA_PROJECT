 @extends('cms.parent');
@section('title',__('cms.models'))
@section('page-lg',__('cms.home'))
@section('main-pg-md',__('cms.models_Management'))
@section('page-md',__('cms.models_list'))
@section('Content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Products-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                
                    <!--begin::Add product-->
                    <a href="{{route('users.create-models')}}"
                    class="btn btn-primary">{{__('cms.create_models')}}  </a>
                    <!--end::Add product-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div id="kt_ecommerce_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="table-responsive"><table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_ecommerce_products_table">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        
                            <th class="min-w-200px sorting" tabindex="0" aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1" aria-label="Product: activate to sort column ascending" style="width: 206.828px;">{{__('cms.product_model')}}</th>

                            <th class="text-end min-w-100px sorting" tabindex="0" aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1" aria-label="SKU: activate to sort column ascending" style="width: 103.562px;">{{__('cms.JOINED_DATE')}}</th>
                            <th class="text-end min-w-100px sorting" tabindex="0" aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1" aria-label="SKU: activate to sort column ascending" style="width: 103.562px;"></th>

                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    @foreach($user_models as $user_model)
                    <tbody class="fw-semibold text-gray-600">
                    <tr class="odd">

                            <td class="text-left pe-0">
                                <span class="fw-bold">{{$user_model->models->name}}</span>
                            </td>
                            <!--end::SKU=-->
                            <!--begin::Qty=-->
                            <td class="text-end pe-0" data-order="16">
                                <span class="fw-bold ms-3">{{$user_model->created_at}}</span>
                            </td>
                            <td class="text-end pe-0">            
                            <!--end::Action=-->
                        </tr>
                     </tbody>
                     @endforeach
                    <!--end::Table body-->
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                </div>
               
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
@endsection

