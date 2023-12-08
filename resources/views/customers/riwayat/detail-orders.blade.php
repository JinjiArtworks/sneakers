@extends('layouts.customers')
<style>
    body {
        background-color: #eee;
    }



    input.star {
        display: none;
    }



    label.star {

        float: right;

        padding: 10px;

        font-size: 18px;

        color: #4A148C;

        transition: all .2s;

    }



    input.star:checked~label.star:before {

        content: '\f005';

        color: #FD4;

        transition: all .25s;

    }


    input.star-5:checked~label.star:before {

        color: #FE7;

        text-shadow: 0 0 20px #952;

    }



    input.star-1:checked~label.star:before {
        color: #F62;
    }



    label.star:hover {
        transform: rotate(-15deg) scale(1.3);
    }



    label.star:before {

        content: '\f006';

        font-family: FontAwesome;

    }
</style>
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
                                    <h4>Detail History Order -
                                        <span class="badge" style="color: green">
                                            @if ($getOrderDetail->order->status == 'Proses Validasi Admin')
                                                Pesanan sedang diproses.
                                            @elseif ($getOrderDetail->order->status == 'Pesanan Dikirim Kepada Admin')
                                                Pesanan sedang diproses.
                                            @elseif ($getOrderDetail->order->status == 'Pesanan Dikirim Kepada Pembeli')
                                                Pesanan sedang dikirim ke alamat Anda.
                                            @elseif ($getOrderDetail->order->status == 'Pesanan Ditolak Admin')
                                                Pesanan tidak tidak dapat dilanjutkan. Saldo Anda akan kembali
                                            @else
                                                Pesanan Selesai
                                            @endif
                                        </span>
                                    </h4>
                                </div>
                                <hr>
                                <div class="text-right">
                                    @if ($getOrderDetail->order->status == 'Selesai')
                                        @if ($getReviewById != null)
                                            @if ($getReviewById->product_id == $getOrderDetail->order->orderdetail->product_id)
                                                <p>Anda telah memberikan review kepada produk ini</p>
                                            @else
                                                <a type="button" class="btn btn-sm btn-primary " style="color: white"
                                                    data-toggle="modal" data-target="#reviewModal" data-whatever="@mdo">Send
                                                    review</a>
                                            @endif
                                        @else
                                            <a type="button" class="btn btn-sm btn-primary " style="color: white"
                                                data-toggle="modal" data-target="#reviewModal" data-whatever="@mdo">Send
                                                review</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @foreach ($orderDetails as $item)
                                <ul>
                                    <div class="d-flex">
                                        <div class="p-2">
                                            <li>
                                                <img src="{{ asset('img/product/details/product-details-2.jpg') }}"
                                                    width="100px">
                                            </li>
                                        </div>
                                        <div class="p-2">
                                            <li>Nama Produk : {{ $item->product->name }}</li>
                                            <li>Quantity : x{{ $item->quantity }}</li>
                                            <li>Ekspedisi : {{ $item->order->ekspedisi }}</li>
                                            <li>Sub Total : @currency($item->price)</li>
                                            <li>Ongkos Kirim : @currency($item->order->shipping_cost)</li>
                                            {{-- <li>Total : @currency($item->order->total)</li> --}}
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
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Review Produk <b> {{ $getOrderDetail->product->name }}
                        </b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ route('history-order.send-review', ['id' => $getOrderDetail->product->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Rating</label>
                            <input class="star star-5" id="star-5" type="radio" value="5" name="ratings" />
                            <label class="star star-5" for="star-5"></label>

                            <input class="star star-4" id="star-4" type="radio" value="4" name="ratings" />
                            <label class="star star-4" for="star-4"></label>

                            <input class="star star-3" id="star-3" type="radio" value="3" name="ratings" />
                            <label class="star star-3" for="star-3"></label>

                            <input class="star star-2" id="star-2" type="radio" value="2" name="ratings" />
                            <label class="star star-2" for="star-2"></label>

                            <input class="star star-1" id="star-1" type="radio" value="1" name="ratings" />
                            <label class="star star-1" for="star-1"></label>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Comment</label>
                            <textarea name="comments" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="confirmSaldo btn btn-primary">Confirm</button>
                    </form>
                </div>
                {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> --}}
            </div>
        </div>
    </div>
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

        $('.confirmOrder').click(function(event) {
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
            })
        });
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
