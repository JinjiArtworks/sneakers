@extends('layouts.customers')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-1.jpg">
                            <h5><a href="#">Fresh Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-2.jpg">
                            <h5><a href="#">Dried Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-3.jpg">
                            <h5><a href="#">Vegetables</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-4.jpg">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-5.jpg">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Products Model</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @if (Auth::check())
                    {{-- Customers, menampilkan seluruh produk yg sudah ada penjualnya ? --}}
                    @if (Auth::user()->role_id == 3)
                        @foreach ($models as $item)
                            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg">
                                        <a href="detail-model/{{ $item->id }}">
                                            <img src="{{ asset('img/list/' . $item->thumbnail) }}" height="250px"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="featured__item__text">
                                        <h6>
                                            <a href="detail-model/{{ $item->id }}/">
                                                <b> {{ $item->name }}</b>
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- @foreach ($productSeller as $item)
                            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg">
                                        <a
                                            href="detail-product-seller/{{ $item->id }}/{{ $item->product_id }}/{{ $item->user_id }}">
                                            <img src="{{ asset('img/list/' . $item->product->images) }}" height="250px"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="featured__item__text">
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
                        @endforeach --}}
                    @elseif(Auth::user()->role_id == 2)
                        {{-- Sellers --}}
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
                    @foreach ($productSeller as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg">
                                    <a
                                        href="detail-product-seller/{{ $item->id }}/{{ $item->product_id }}/{{ $item->user_id }}">
                                        <img src="{{ asset('img/list/' . $item->product->images) }}" height="250px"
                                            alt="">
                                    </a>
                                </div>
                                <div class="featured__item__text">
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
                @endif



            </div>
        </div>
    </section>
@endsection
