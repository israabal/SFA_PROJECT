@extends('cms.parent');
@section('styles')
    
@endsection
@section('Content')
    <!--begin::Card-->
    <div class="card">

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                        id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                    rowspan="1" colspan="1" aria-label="User: activate to sort column ascending"
                                    style="width: 206.375px;">{{__('cms.models')}}</th>



                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                    rowspan="1" colspan="1"
                                    aria-label="Joined Date: activate to sort column ascending"
                                    style="width: 142.234px;">{{__('cms.status')}}</th>


                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">

                            @foreach ($product_models as $productmodel)
                            <tr>
                                <td>{{$productmodel->name}}</td>
                                <td >
                                    <div class="form-group clearfix align-middle">
                                        <div class="icheck-success d-inline">
                                            <input class="form-check-input " type="checkbox"
                                            onclick="performUpdate('{{$sparepart->id}}','{{$productmodel->id}}')"
                                                id="models-{{$productmodel->id}}"
                                              @checked($productmodel->assigned)
                                              
                                            >
                                            <label class="form-check-label ms-3"  for="productmodel_{{$productmodel->id}}"></label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection
@section('scripts')

<script>
    $(function () { bsCustomFileInput.init() });
</script>
<script>
    function performUpdate(sparePartId,id) {
        axios.put('/cms/spaerparts/product_models/edit', {
            sparePart_id: sparePartId,
            productmodel_id: id,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
    
</script>


@endsection
