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
                                            <img src="{{ asset('templates/admin/assets/images/product/1.png') }}" class="img-fluid"
                                                alt="image">
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
                                            <img src="{{ asset('templates/admin/assets/images/product/2.png') }}" class="img-fluid"
                                                alt="image">
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
                                            <img src="{{ asset('templates/admin/assets/images/product/3.png') }}" class="img-fluid"
                                                alt="image">
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
                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Top Products</h4>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                    <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton006"
                                        data-toggle="dropdown">
                                        This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right shadow-none"
                                        aria-labelledby="dropdownMenuButton006">
                                        <a class="dropdown-item" href="#">Year</a>
                                        <a class="dropdown-item" href="#">Month</a>
                                        <a class="dropdown-item" href="#">Week</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled row top-product mb-0 ">
                                <li class="col-lg-3">
                                    <div class="card card-block card-stretch card-height mb-0">
                                        <div class="card-body">
                                            <div class="bg-warning-light rounded">
                                                <img src="{{ asset('templates/admin/assets/images/product/01.png') }}"
                                                    class="style-img img-fluid m-auto p-3" alt="image">
                                            </div>
                                            <div class="style-text text-left my-4">
                                                <h5 class="mb-1">Organic Cream</h5>
                                                <p class="mb-0">789 Item</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-lg-3">
                                    <div class="card card-block card-stretch card-height mb-0">
                                        <div class="card-body">
                                            <div class="bg-danger-light rounded">
                                                <img src="{{ asset('templates/admin/assets/images/product/02.png') }}"
                                                    class="style-img img-fluid m-auto p-3" alt="image">
                                            </div>
                                            <div class="style-text text-left my-4">
                                                <h5 class="mb-1">Rain Umbrella</h5>
                                                <p class="mb-0">657 Item</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-lg-3">
                                    <div class="card card-block card-stretch card-height mb-0">
                                        <div class="card-body">
                                            <div class="bg-info-light rounded">
                                                <img src="{{ asset('templates/admin/assets/images/product/03.png') }}"
                                                    class="style-img img-fluid m-auto p-3" alt="image">
                                            </div>
                                            <div class="style-text text-left my-4">
                                                <h5 class="mb-1">Serum Bottle</h5>
                                                <p class="mb-0">489 Item</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-lg-3">
                                    <div class="card card-block card-stretch card-height mb-0">
                                        <div class="card-body">
                                            <div class="bg-success-light rounded">
                                                <img src="{{ asset('templates/admin/assets/images/product/02.png') }}"
                                                    class="style-img img-fluid m-auto p-3" alt="image">
                                            </div>
                                            <div class="style-text text-left my-4">
                                                <h5 class="mb-1">Organic Cream</h5>
                                                <p class="mb-0">468 Item</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
