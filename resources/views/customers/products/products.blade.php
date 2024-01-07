@extends('layouts.customers')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/bg1.jpeg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>All Product</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-7">
                    <div class="row">
                        @if (Auth::check())
                            @if (Auth::user()->role_id == 3)
                            {{-- Buyer --}}
                                @foreach ($productsSeller as $item)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg">
                                                <a
                                                    href="detail-product-seller/{{ $item->id }}/{{ $item->product_id }}/{{ $item->user_id }}">
                                                    <img src="{{ asset('img/list/' . $item->product->images) }}"
                                                        height="250px" alt="">
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
                                                <p class="mt-2" style="color: green"> <a
                                                        href="/">{{ $item->user->name }}'s Store</a></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif (Auth::user()->role_id == 2)
                                {{-- Seller --}}
                                @foreach ($products as $item)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg">
                                                <a href="detail-product/{{ $item->id }}">
                                                    <img src="{{ asset('img/list/' . $item->images) }}" height="250px"
                                                        alt="">
                                                </a>
                                            </div>
                                            <div class="product__item__text">
                                                <h6>
                                                    <b>
                                                        <a
                                                            href="/detail-product/{{ $item->id }}/{{ $item->user_id }}">{{ $item->name }}</a>
                                                    </b>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @else
                            @foreach ($productsSeller as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg">
                                            <a
                                                href="detail-product-seller/{{ $item->id }}/{{ $item->product_id }}/{{ $item->user_id }}">
                                                <img src="{{ asset('img/list/' . $item->product->images) }}"
                                                    height="250px" alt="">
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
                                            <p class="mt-2" style="color: green"> <a
                                                    href="/">{{ $item->user->name }}'s Store</a></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
