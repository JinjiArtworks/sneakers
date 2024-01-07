@extends('layouts.customers')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/bg1.jpeg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Detail Product</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Detail Product</span>
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
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <div class="d-flex flex-row">
                            <h3>{{ $productsSeller->product->name }} </h3>
                        </div>

                        {{-- <div class="product__details__rating">
                            <a href="https://wa.me/+62{{ $productsSeller->user->phone }}">{{ $productsSeller->user->name }}'s
                                Stores.
                            </a>
                        </div> --}}
                        {{-- Menampilkan product yg BUKAN milik toko user --}}
                        @if ($productsSeller->user->id != Auth::user()->id)
                            <div class="product__details__price"> @currency($productsSeller->price) </div>
                            <p> <b>Availability:</b> {{ $products->productsseller->stock }} pcs.</p>
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
                                            pattern="[0-100]*" style="width: 5rem; border:none">
                                        <a class="btn btn-increase">+</a>
                                    </div>
                                </div>
                                <button class="add-to-cart confirm-cart btn-primary btn-lg">Add To Cart</button>
                            </form>
                        @else
                            <span>{{ $productsSeller->user->name }} Stores *Product Ini adalah milik toko anda</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <hr>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Product Description {{ $products->stock }}</h6>
                                    <p>{{ $products->description }}</p>
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
                if ($('.count').val() > {{  $products->productsseller->stock }}) {
                    $('.add-to-cart').prop('disabled', true);
                }
            });
            $(document).on('click', '.btn-reduce', function() {
                $('.count').val(parseInt($('.count').val()) - 1);
                if ($('.count').val() == 0) {
                    $('.count').val(1);
                }
                if ($('.count').val() <= {{  $products->productsseller->stock }}) {
                    $('.add-to-cart').prop('disabled', false);
                }
            });
            $(document).on('click', '.add-to-cart', function() {
                if ($('.count').val() > {{  $products->productsseller->stock }}) {
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
