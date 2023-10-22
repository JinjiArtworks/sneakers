@extends('layouts.customers')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Detail History Order</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Detail History Order</span>

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
                            <div class="d-flex">
                                <div class="p-2">
                                    <h4>Detail History Order</h4>
                                </div>
                                <hr>
                                <div class="text-right">
                                    <a href="/details-pesanan/1" class="btn btn-sm btn-primary">Kirim Pesanan</a>
                                </div>
                            </div>

                            <ul>
                                <div class="d-flex">
                                    <div class="p-2">
                                        <li>
                                            <img src="{{ asset('img/product/details/product-details-2.jpg') }}"
                                                width="100px">
                                        </li>
                                    </div>
                                    <div class="p-2">
                                        <li>Nama Produk : #123456</li>
                                        <li>Quantity : #123456</li>
                                        <li>S : #123456</li>
                                        <li>Total : Rp. 123.444</li>
                                    </div>

                                </div>
                                <hr>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.btn-send-item').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Terima Pesanan?',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $('.sendItemBack').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Kirim Balik Pesanan?',
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

    <script type="text/javascript">
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
