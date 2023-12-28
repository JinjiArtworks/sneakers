@extends('layouts.customers')
@section('content')
    <!-- Product Section Begin -->
    {{-- <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
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
    </section> --}}
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-7">
                    <h4 style="font-weight: bold" class=" text-center">All {{ $getProducts->models->name }} Product</h4>
                    <div class="row">
                        {{-- Seller --}}
                        @foreach ($productsSeller as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <a
                                            href="/detail-product-seller/{{ $item->id }}/{{ $item->product_id }}/{{ $item->user_id }}">
                                            <img src="{{ asset('img/list/' . $item->product->images) }}" height="250px"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>
                                            <a
                                                href="/detail-product-seller/{{ $item->id }}/{{ $item->product_id }}/{{ $item->user_id }}">
                                                {{ $item->product->name }}
                                            </a>
                                        </h6>
                                        <h5> @currency($item->price) </h5>
                                        <p class="mt-2" style="color: green"> <a href="/">{{ $item->user->name }}'s
                                                Store</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-7">
                    <div class="product__discount">
                        <h4 style="font-weight: bold" class="mt-2 mb-4 text-center">{{ $getProducts->models->name }}
                            Recommendation Product</h4>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($images as $item)
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg">
                                                {{-- <a
                                                    href="/detail-product-seller/{{ $getProductId->id }}/{{ $getProductId->product_id }}/{{ $userId }}"> --}}
                                                    <img src="{{ asset('img/list/' . $item) }}" height="250px"
                                                        alt="">
                                                {{-- </a> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="product__discount__item__text">
                                            <div class="product__item__price">{{ $item }}</div>
                                        </div> --}}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
