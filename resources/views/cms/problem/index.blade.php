@extends('cms.parent');
@section('title',__('cms.problem'))
@section('page-lg',__('cms.home'))
@section('main-pg-md',__('cms.problem'))
@section('page-md',__('cms.problem_list'))
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
                    {{-- @can('Create-problem') --}}

                    <!--begin::Add product-->
                    <a href="{{route('problems.create' )}}" class="btn btn-primary">{{__('cms.create_problem')}}</a>
                    <!--end::Add product-->
                    {{-- @endcan --}}
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
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">



                             <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"  aria-label="Two-step: activate to sort column ascending" style="width: 125px;">{{__('cms.user')}}</th>


                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"  aria-label="Joined Date: activate to sort column ascending"  >{{__('cms.product_model')}}</th>



                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"  aria-label="Joined Date: activate to sort column ascending"  >{{__('cms.log')}}</th>


                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"  aria-label="Joined Date: activate to sort column ascending"  >{{__('cms.lat')}}</th>

                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"  aria-label="Joined Date: activate to sort column ascending" ></th>


                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"  aria-label="Joined Date: activate to sort column ascending"  >      {{__('cms.details')}}</th>




                            <th class="text-end min-w-100px sorting_disabled"  aria-label="Actions" style="width: 100px;">{{__('cms.actions')}}</th></tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($problems as $problem)


                    <tr class="odd">




                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->

                            <!--end::Avatar-->
                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">  {{ $problem->user->user_type ??'NULL' }}</a>
                                </div>
                            <!--begin::User details-->
                        </td>

                        <!--end::Two step=-->
                        <!--begin::Joined-->
                        <td> {{Auth::user()->name}}</td>

                        <td> {{$problem->d_log}}</td>
                        <td>   {{$problem->d_lat}}</td>

                        <td >
                            <span class="fw-bold">{{$problem->app_status}}</span>
                        </td>

                        <td>   {{$problem->details}}</td>

{{--
                        <td ><span class="badge @if($problem->active) bg-success @else bg-danger @endif">{{$problem->active_status}}</span>
 --}}




                            <!--end::SKU=-->
                            <!--begin::Qty=-->


                            <td>
                                <div class="d-flex justify-content-end flex-shrink-0">

                                    <a  href="{{route('problems.edit', $problem->id )}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="#" onclick="confirmDelete('{{$problem->id}}', this)"  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </div>
                            </td>
                            <!--end::Action=-->
                        </tr>
                        @endforeach
                     </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                </div>

            </div>
        </div>
    </div>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Products-->
    </div>
    <!--end::Content container-->
</div>
@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id, reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/cms/problem/'+id)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            reference.closest('tr').remove();
            // showMessage(response.data.message);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
            // showMessage(error.response.data.message);
        });
    }

    function showMessage(data) {
        Swal.fire(
            data.title,
            data.text,
            data.icon
        );
    }
</script>

@endsection

