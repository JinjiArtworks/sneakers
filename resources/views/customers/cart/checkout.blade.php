@extends('layouts.customers')
@section('content')
    @php
        $subtotal = 0;
        if ($cart != null) {
            foreach ($cart as $key => $value) {
                $subtotal += $value['subtotal'];
            }
            $grandTotal = $subtotal + $cekongkir;
        }
    @endphp

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="checkout__input">
                            <p>Receipent Name<span>*</span></p>
                            <input type="text" placeholder="Receipent Name" value="{{ Auth::user()->name }}"
                                class="checkout__input__add" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Phone<span>*</span></p>
                            <input type="text" placeholder="Phone Number" value="{{ Auth::user()->phone }}"
                                class="checkout__input__add" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" value="{{ Auth::user()->address }}"
                                class="checkout__input__add" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>City<span>*</span></p>
                            <input type="text" placeholder="Street Address" value="{{ $cityName->name }}"
                                class="checkout__input__add" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Province<span>*</span></p>
                            <input type="text" placeholder="Street Address" value="{{ $provinceName->name }}"
                                class="checkout__input__add" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                @foreach ($cart as $key => $value)
                                    <li>
                                        {{ $value['name'] }}
                                        (Size: {{ $value['size'] }})
                                        <b>x {{ $value['quantity'] }} pcs</b>
                                        <span>@currency($value['price'])</span>

                                    </li>
                                @endforeach
                            </ul>
                            <div class="checkout__order__products">
                                Ongkos Kirim <span>@currency($cekongkir)</span>
                            </div>
                            <div class="checkout__order__subtotal">Subtotal <span>@currency($subtotal)</span></div>
                            <div class="checkout__order__total">Total <span>@currency($grandTotal)</span></div>
                            <button id="pay-button" class="pay site-btn"type="submit">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <form method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data" id="submit_form">
        @csrf
        <input type="hidden" name="json" id="json_callback">
        <input type="hidden" value="{{ $grandTotal }}" name="grandTotal">
        <input type="hidden" value="{{ $getServices }}" name="courierService">
        <input type="hidden" value="{{ $cekongkir }}" name="ongkos_kirim">
        <input type="hidden" value="{{ $sellers_id }}" name="sellers_id">
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.pay', function() {
                // alert('asdas');
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay('{{ $snap_token }}', {
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            console.log(result);
                            send_response_to_form(result);
                        },
                        onPending: function(result) {
                            alert(
                                'Harap menyelesaikan pembayaran dalam waktu 24 Jam'
                            );
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal.');

                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('Batalkan pembayaran ? ');
                        }
                    })
                });

                function send_response_to_form(result) {
                    document.getElementById('json_callback').value = JSON.stringify(result);
                    $('#submit_form').submit();
                }
            });
        });
    </script>
@endsection
