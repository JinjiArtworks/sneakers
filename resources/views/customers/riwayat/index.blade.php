@extends('layouts.customers')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>History Order</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>History Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="checkout__order">
                            <h4>History Order</h4>
                            @foreach ($orders as $item)
                                <ul>
                                    <div class="d-flex">
                                        <div class="p-2">
                                            <li>
                                                <img src="img/product/details/product-details-2.jpg" width="100px">
                                            </li>
                                        </div>
                                        <div class="p-2">
                                            <li>Order Number : {{ $item->id }}</li>
                                            <li>Penerima : {{ Auth::user()->name }} - {{ Auth::user()->phone }}</li>
                                            <li>Alamat : {{ $fullAddress }}</li>
                                        </div>

                                        <div class="ml-auto p-2">
                                            <li> <a href="/detail-pesanan/{{ $item->id }}"
                                                    class="btn btn-sm btn-primary">Details</a>
                                            </li>
                                        </div>
                                    </div>
                                    <hr>
                                </ul>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
