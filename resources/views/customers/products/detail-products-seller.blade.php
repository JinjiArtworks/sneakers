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
    {{-- Menampilkan produk sbg seller --}}
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('img/list/' . $productsSeller->product->images) }}" alt="">
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
                        <div class="d-flex flex-row">
                            <h3>{{ $productsSeller->product->name }} </h3>
                            <div class="ml-4">
                                <form action="{{ route('wishlist.addToWishlist', ['id' => $products->id]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $productsSeller->product_id }}">

                                    <button class="add-wishlist confirm-cart btn-primary btn-md rounded p-3">
                                        <i class="fa-regular text-white text-lg fa-heart fa-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="product__details__rating">
                            <a href="https://wa.me/+62{{ $productsSeller->user->phone }}">{{ $productsSeller->user->name }}'s
                                Stores.
                            </a>
                        </div>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        {{-- Menampilkan product yg BUKAN milik toko user --}}
                        @if ($productsSeller->user->id != Auth::user()->id)
                            <div class="product__details__price"> @currency($productsSeller->price) </div>
                            <p>{{ $productsSeller->description }}</p>
                            {{-- Mengecek agar produk tidak punya si pemilik toko --}}
                            <form action="{{ route('cart.add', ['id' => $productsSeller->id]) }}" method="POST">
                                @csrf
                                {{-- <input type="hidden" name="sellers_id" value="{{ $productsSeller->user_id }}"> --}}
                                {{-- <input type="hidden" name="product_id" value="{{ $productsSeller->product_id}}"> --}}
                                <div class="product__details__quantity">
                                    <label for="size">Size </label>
                                    <br>
                                    <select name="size" id="">
                                        <option value="{{ $productsSeller->size }}">{{ $productsSeller->size }}
                                        </option>
                                    </select>
                                    {{-- <input type="number" class="form-control" name="size" value=""> --}}
                                </div>
                                <hr>
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <a class="btn btn-reduce"> -</a>
                                        <input class="count" type="number" name="quantity" value="1" data-max="120"
                                            pattern="[0-9]*" style="width: 3rem; border:none">
                                        <a class="btn btn-increase">+</a>
                                    </div>
                                </div>
                                <button class="add-to-cart confirm-cart btn-primary btn-lg">Add To Cart</button>
                            </form>


                            <ul>
                                <li><b>Availability : </b> <span>{{ $products->stock }} pcs.</span></li>
                                <li><b> Size : </b>
                                    <span>
                                        {{ $productsSeller->size }} cm
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
                        @else
                            <span>{{ $productsSeller->user->name }} Stores (Product Ini adalah milik toko anda)</span>
                        @endif
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
                                        Proin eget tortor risus.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        // alert('test');
        $(document).ready(function() {
            $(document).on('click', '.btn-increase', function() {
                $('.count').val(parseInt($('.count').val()) + 1);
                if ($('.count').val() > {{ $products->stock }}) {
                    $('.add-to-cart').prop('disabled', true);
                }
            });
            $(document).on('click', '.btn-reduce', function() {
                $('.count').val(parseInt($('.count').val()) - 1);
                if ($('.count').val() == 0) {
                    $('.count').val(1);
                }
                if ($('.count').val() <= {{ $products->stock }}) {
                    $('.add-to-cart').prop('disabled', false);
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
                if ({{ $userSaldo }} < ($('.count').val() * {{ $productsSeller->price }})) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Saldo Anda tidak cukup',
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
        $('.add-to-cart').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Masukkan Produk Kedalam Keranjang?',
                icon: 'success',
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
    </script>
@endsection
