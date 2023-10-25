@extends('layouts.customers')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Vegetable’s Package</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Vegetables</a>
                            <span>Vegetable’s Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('img/list/' . $products->images) }}" alt="">
                        </div>
                        {{-- <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ asset('img/product/details/product-details-2.jpg') }}"
                                src="{{ asset('img/product/details/thumb-1.jpg') }}" alt="">

                            <img data-imgbigurl="{{ asset('img/product/details/product-details-3.jpg') }}"
                                src="{{ asset('img/product/details/thumb-2.jpg') }}" alt="">

                            <img data-imgbigurl="{{ asset('img/product/details/product-details-4.jpg') }}"
                                src="{{ asset('img/product/details/thumb-3.jpg') }}" alt="">

                            <img data-imgbigurl="{{ asset('img/product/details/product-details-4.jpg') }}"
                                src="{{ asset('img/product/details/thumb-4.jpg') }}" alt="">
                        </div> --}}
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">



                    <div class="product__details__text">
                        <h3>{{ $products->name }} </h3>
                        @if (Auth::user()->is_seller == 0)
                            <form action="{{ route('users.switch-to-seller', ['id' => Auth::user()->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="mb-2 btn btn-sm btn-primary">Become a Seller!
                                </button>
                            </form>
                        @endif

                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <span>Toko : <a href=""> {{ $products->users->name }} -
                                {{ $products->users->phone }}</a></span>

                        <div class="product__details__price"> @currency($products->price) </div>
                        <p>{{ $products->description }}</p>
                        <form action="{{ route('cart.add', ['id' => $products->id]) }}" method="POST">
                            @csrf
                            @if (Auth::user()->is_seller == 1)
                                <button class="primary-btn">Sell this product</button>
                                {{-- tampilkan modal untuk masukkan product size dan  --}}
                            @else
                                @if ($products->users_id != Auth::user()->id)
                                    <div class="product__details__quantity">
                                        <div class="quantity">
                                            <a class="btn btn-reduce"> -</a>
                                            <input class="count" type="number" name="quantity" value="1"
                                                data-max="120" pattern="[0-9]*" style="width: 3rem; border:none">
                                            <a class="btn btn-increase">+</a>
                                        </div>
                                    </div>
                                    <button class=" add-to-cart confirm-cart primary-btn">Add To Cart</button>
                                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                                @else
                                    <p>Anda menjual produk ini.</p>
                                @endif
                            @endif
                        </form>

                        <ul>
                            <li><b>Availability : </b> <span>{{ $products->stock }} pcs.</span></li>
                            <li><b>Ready Size : </b>
                                <span>
                                    {{ $products->size }} cm
                                </span>
                            </li>
                            <li><b>Weight : </b> <span>{{ $products->weight }} gr / pcs</span></li>
                            {{-- <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Review</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
@endsection
@section('script')
    <script type="text/javascript">
        // alert('test');
        $(document).ready(function() {
            $(document).on('click', '.btn-increase', function() {
                $('.count').val(parseInt($('.count').val()) + 1);
                if ($('.count').val() > {{ $products->stock }}) {
                    $(':input[type="submit"]').prop('disabled', true);
                }
            });
            $(document).on('click', '.btn-reduce', function() {
                $('.count').val(parseInt($('.count').val()) - 1);
                if ($('.count').val() == 0) {
                    $('.count').val(1);
                }
                if ($('.count').val() <= {{ $products->stock }}) {
                    $(':input[type="submit"]').prop('disabled', false);
                }
            });
            $(document).on('click', '.add-to-cart', function() {
                if ($('.count').val() > {{ $products->stock }}) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Stock Tidak Tersedia',
                        icon: 'error',
                    })
                }
            });

        });
        $('.add-wishlist').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Masukkan Kedalam Wishlist?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

        // $('.confirm-cart').click(function(event) {
        //     event.preventDefault();
        //     var form = $(this).closest("form");
        //     const swalWithBootstrapButtons = Swal.mixin({
        //         customClass: {
        //             confirmButton: 'btn btn-success',
        //             cancelButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             form.submit();
        //         }
        //     })
        //     Swal.fire({
        //         title: 'Masukkan Kedalam Keranjang? Cek kandungan alergi terhadap produk ini ',
        //         icon: 'info',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             form.submit();
        //         }
        //     })
        // });
    </script>
@endsection
