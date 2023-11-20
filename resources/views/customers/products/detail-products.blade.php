@extends('layouts.customers')
@section('content')
    <!-- Breadcrumb Section Begin -->
    {{-- MENAMPILKAN HALAMAN UNTUK SELLER DAPAT MENJUAL PRODUK  --}}
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
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $products->name }} </h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sellModal"
                            data-whatever="@mdo">Sell this product</button>
                        <p>{{ $products->description }}</p>
                        <ul>
                            <li><b>Availability : </b> <span>{{ $products->stock }} pcs.</span></li>
                            {{-- <li><b>Ready Size : </b>
                                <span>
                                    7, 7.5, 8
                                </span>
                            </li> --}}
                            <li><b>Weight : </b> <span>{{ $products->weight }} gr / pcs</span></li>
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
    <!-- Modal -->
    <div class="modal fade" id="sellModal" tabindex="-1" role="dialog" aria-labelledby="sellModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sellModalLabel">Sell Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/store-product-seller" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="productID" value="{{ $products->id }}">
                        <input type="hidden" name="userID" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Size Product:</label>
                            <br>
                            <select name="size" class="form-select">
                                <option value="7">7 (39cm)</option>
                                <option value="7.5">7.5 (40cm)</option>
                                <option value="8">8 (40.5 cm)</option>
                                <option value="8.5">8.5 (41 cm)</option>
                                <option value="9">9 (42 cm)</option>
                                <option value="9.5">9.5 (42.5 cm)</option>
                                <option value="10">10 (43 cm)</option>
                                <option value="10.5">10.5 (44 cm)</option>
                                <option value="11">11 (44.5 cm)</option>
                                <option value="11.5">11.5 (45 cm)</option>
                                <option value="12">12 (45.5 cm)</option>
                            </select>
                            {{-- <input type="number" class="form-control" id="message-text" name="size"></input> --}}
                        </div>
                        <br>
                        <div class="form-group mt-3">
                            <label for="recipient-name" class="col-form-label">Price Product:</label>
                            {{-- <input type="number" name="price" class=" calculatePrice form-control" id="product-price"> --}}
                            <input type="text" class="form-control" id="tanpa-rupiah" name="price"
                                placeholder="Price Product">
                        </div>
                        <div class="form-group mt-3">
                            <label for="message-text" class="col-form-label">Description Product:</label>
                            <textarea type="text" class=" form-control" id="message-text" placeholder="Description Product"
                                name="description"></textarea>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Product Details Section End -->
@endsection
@section('script')
    <script>
        var tanpa_rupiah = document.getElementById('tanpa-rupiah');
        tanpa_rupiah.addEventListener('keyup', function(e) {
            tanpa_rupiah.value = formatRupiah(this.value);
        });
        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
