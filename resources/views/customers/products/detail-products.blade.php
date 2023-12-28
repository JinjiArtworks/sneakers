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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sellModal">
                            Sell this product
                        </button>
                        <ul>
                            <li><b>Models : </b> <span>{{ $products->models->name }} </span></li>
                            <li><b>Brand : </b> <span>{{ $products->brand }} </span></li>
                            <li><b>Products Sold : </b> <span>{{ $products->sold }} pcs </span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <hr>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Product Description</h6>
                                    <p>{{ $products->description }}</p>
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
                        <input type="hidden" name="modelsID" value="{{ $products->models_id }}">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Size Product:</label>
                            <br>
                            <select name="size" class="form-control">
                                <option value="7 (EUR 37-38)">7 (EUR 37-38)</option>
                                <option value="7.5 (EUR 38)">7.5 (EUR 38)</option>
                                <option value="8 (EUR 38-39)">8 (EUR 38-39)</option>
                                <option value="8.5 (EUR 39)">8.5 (EUR 39)</option>
                                <option value="9 (EUR 39-40)">9 (EUR 39-40)</option>
                                <option value="9.5 (EUR 40)">9.5 (EUR 40)</option>
                                <option value="10 (EUR 40-41)">10 (EUR 40-41)</option>
                                <option value="10.5 (EUR 41)">10.5 (EUR 41)</option>
                                <option value="11 (EUR 41-42)">11 (EUR 41-42)</option>
                                <option value="11.5 (EUR 42)">11.5 (EUR 42)</option>
                                <option value="12 (EUR 42-43)">12 (EUR 42-43)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Price Product:</label>
                            <input type="text" class="form-control" id="tanpa-rupiah" name="price"
                                placeholder="Price Product" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Stock Product:</label>
                            <input type="number" min="1" oninput="this.value = Math.abs(this.value)"
                                class="form-control" name ="stock" placeholder="Stock Product" required>
                        </div>
                        {{-- <div class="form-group mt-3">
                            <label for="message-text" class="col-form-label">Description Product:</label>
                            <textarea type="text" class=" form-control" id="message-text" placeholder="Description Product"
                                name="description"></textarea>
                        </div> --}}
                        <hr>
                        <button type="submit" class="confirm btn btn-primary">Confirm</button>
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
        // $('.confirm').click(function(event) {
        //     event.preventDefault();
        //     var form = $(this).closest("form");
        //     Swal.fire({
        //         title: 'Add Product?',
        //         icon: 'success',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             form.submit();
        //         }
        //     });
        // });
    </script>
@endsection
