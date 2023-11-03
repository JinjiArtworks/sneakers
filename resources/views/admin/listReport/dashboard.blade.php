@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-transparent card-block card-stretch card-height border-none">
                        <div class="card-body p-0 mt-lg-2 mt-0">
                            <h3 class="mb-3">Hi {{ Auth::user()->name }}, Good Morning</h3>
                            <p class="mb-0 mr-4">Your dashboard gives you views of key performance or business
                                process.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-info-light">
                                            <img src="{{ asset('templates/admin/assets/images/product/1.png') }}"
                                                class="img-fluid" alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">Total Sales</p>
                                            <h4>31.50</h4>
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-info iq-progress progress-1" data-percent="85">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-danger-light">
                                            <img src="{{ asset('templates/admin/assets/images/product/2.png') }}"
                                                class="img-fluid" alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">Total Cost</p>
                                            <h4>$ 4598</h4>
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-danger iq-progress progress-1" data-percent="70">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-success-light">
                                            <img src="{{ asset('templates/admin/assets/images/product/3.png') }}"
                                                class="img-fluid" alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">Product Sold</p>
                                            <h4>4589 M</h4>
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-success iq-progress progress-1" data-percent="75">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">List Order</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="data-tables table mb-0 tbl-server-info">
                                    <thead class="bg-white text-uppercase">
                                        <tr class="ligth ligth-data">
                                            <th>Product</th>
                                            <th>Sellers Name</th>
                                            <th>Quantity</th>
                                            <th>Size</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ligth-body">
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('img/list/' . $item->orderdetail->product->images) }}"
                                                            class="img-fluid rounded avatar-50 mr-3" alt="image">
                                                        {{ $item->orderdetail->product->name }}
                                                    </div>
                                                </td>
                                                <td>{{ $item->users->name }}</td>
                                                <td>{{ $item->orderdetail->quantity }}</td>
                                                <td>{{ $item->orderdetail->product->productsseller->size }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>@currency($item->orderdetail->product->productsseller->price)</td>
                                                <td>
                                                    <form action="{{ route('dashboard.details', ['id' => $item->id]) }}">
                                                        <button class="badge bg-success mr-2 mt-2" type="submit"">
                                                            <i class="ri-pencil-line mr-0"></i>
                                                        </button>
                                                    </form>
                                                {{-- <td>
                                                    <form method="GET"
                                                        action="{{ route('products.delete', ['id' => $item->id]) }}">
                                                        <button class="badge bg-danger mr-2 mt-2" type="submit"
                                                            class="deleteProduk">
                                                            <i class="ri-delete-bin-line mr-0"></i>
                                                        </button>
                                                    </form>
                                                </td> --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
