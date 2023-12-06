@extends('layouts.sellers')
@section('notif')
    <li class="nav-item nav-icon nav-item-icon dropdown">
        <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-bell">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <span class="bg-primary "> {{ count($notifOrder) }}</span>
        </a>
        <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="card shadow-none m-0">
                <div class="card-body p-0 ">
                    <div class="cust-title p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Notifications</h5>
                            <a class="badge badge-primary badge-card" href="#">{{ count($notifOrder) }}</a>
                        </div>
                    </div>
                    <div class="px-3 pt-0 pb-0 sub-card">
                        @foreach ($notifOrder as $key => $item)
                            <a href="#" class="iq-sub-card">
                                <div class="media align-items-center cust-card py-3 border-bottom">
                                    <div class="">
                                        <img src="{{ asset('img/list/' . $item->orderdetail->product->images) }}"
                                            style="width: 50px;" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">{{ $item->users->name }}</h6>
                                            <small class="text-dark"><b>{{ $item->date }}</b></small>
                                        </div>
                                        <small class="mb-0">{{ $item->orderdetail->product->name }}</small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </li>
@endsection
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Investment</h5>
                                <span class="badge badge-primary">Monthly</span>
                            </div>
                            <h3>$<span class="counter">35000</span></h3>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <p class="mb-0">Total Revenue</p>
                                <span class="text-primary">65%</span>
                            </div>
                            <div class="iq-progress-bar bg-primary-light mt-2">
                                <span class="bg-primary iq-progress progress-1" data-percent="65"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Sales</h5>
                                <span class="badge badge-warning">Anual</span>
                            </div>
                            <h3>$<span class="counter">25100</span></h3>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <p class="mb-0">Total Revenue</p>
                                <span class="text-warning">35%</span>
                            </div>
                            <div class="iq-progress-bar bg-warning-light mt-2">
                                <span class="bg-warning iq-progress progress-1" data-percent="35"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Cost</h5>
                                <span class="badge badge-success">Today</span>
                            </div>
                            <h3>$<span class="counter">33000</span></h3>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <p class="mb-0">Total Revenue</p>
                                <span class="text-success">85%</span>
                            </div>
                            <div class="iq-progress-bar bg-success-light mt-2">
                                <span class="bg-success iq-progress progress-1" data-percent="85"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Profit</h5>
                                <span class="badge badge-info">Weekly</span>
                            </div>
                            <h3>$<span class="counter">2500</span></h3>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <p class="mb-0">Total Revenue</p>
                                <span class="text-info">55%</span>
                            </div>
                            <div class="iq-progress-bar bg-info-light mt-2">
                                <span class="bg-info iq-progress progress-1" data-percent="55"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">List Order</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Images</th>
                                            <th>Name Product</th>
                                            {{-- <th>Buyer Name</th> --}}
                                            <th>Date</th>
                                            {{-- <th>Size</th> --}}
                                            <th>Shipping Cost</th>
                                            <th>Price </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('img/list/' . $item->orderdetail->product->images) }}"
                                                        style="width: 100px;" alt="">
                                                </td>
                                                <td>{{ $item->orderdetail->product->name }}</td>
                                                <td>{{ $item->date }}</td>
                                                <td>@currency($item->shipping_cost)</td>
                                                <td>@currency($item->total - $item->shipping_cost)</td>
                                                <td class="text-primary">{{ $item->status }}</td>
                                                <td>
                                                    <form method="GET"
                                                        action="{{ route('seller.list-edit-order', ['id' => $item->id]) }}">
                                                        <button class="btn btn-primary " type="submit">
                                                            <i class="fa-regular fa-eye mr-0 my-1"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">List Product</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Images</th>
                                            <th>Product Name</th>
                                            <th>Size</th>
                                            <th>Models</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($sellerProducts as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('img/list/' . $item->product->images) }}"
                                                        style="width: 100px;" alt="">
                                                </td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->size }}</td>
                                                <td>{{ $item->product->models->name }}</td>
                                                <td>@currency($item->price)</td>
                                                <td>
                                                    <form method="GET"
                                                        action="{{ route('seller.delete-product', ['id' => $item->id]) }}">
                                                        @csrf
                                                        <button
                                                            class="deletProductSeller btn btn-danger mr-2 mt-2"type="submit">
                                                            <i class="ri-delete-bin-line mr-0"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.deletProductSeller').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Delete Product?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
