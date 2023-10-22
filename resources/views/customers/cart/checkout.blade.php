@extends('layouts.customers')
@section('breadcrumbs')
    <div class="text-sm breadcrumbs mt-4">
        <ul>
            <li>
                Home
            </li>
            <li>
                Detail Produk
            </li>
            <li>
                Keranjang
            </li>
            <li>
                Checkout
            </li>
        </ul>
    </div>
@endsection
@section('content')
    @php
        $subtotal = 0;
        if ($cart != null) {
            foreach ($cart as $key => $value) {
                $subtotal += $value['subtotal'];
            }
            $grandTotal = $subtotal + $cekongkir - $getCoupon;
        }
    @endphp
    <div class="container mx-auto">

        <div class="flex shadow-md mt-10 rounded-xl">

            <div class="w-full bg-white px-10 py-10 rounded-xl ">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Informasi Pesanan</h1>
                    <h2 class="font-semibold text-2xl">3 Items</h2>
                </div>
                <div class="mt-4 border-b pb-8">
                    <h2 class="font-semibold text-sm text-gray-600">Penerima : <span
                            class=" font-normal ">{{ Auth::user()->name }}</span></h2>
                    <h2 class="font-semibold text-sm text-gray-600  my-2">Nomor Handphone : <span
                            class=" font-normal ">{{ Auth::user()->phone }}</span></h2>
                    <h2 class="font-semibold text-sm text-gray-600">Alamat :
                        <span class=" font-normal ">{{ Auth::user()->address }} - {{ $cityName->name }},
                            {{ $provinceName->name }}</span>
                    </h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold  text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold  text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold  text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                @foreach ($cart as $key => $c)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5"> <!-- product -->
                            <div class="w-28">
                                <img class="h-24" src="{{ asset('images/' . $c['gambar']) }}" alt="">
                            </div>
                            <div class="flex flex-col justify-center ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ $c['nama'] }}</span>
                                <span class="font-normal text-xs">Ukuran : {{ $c['size'] }}</span>
                            </div>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">x{{ $c['quantity'] }}</span>
                        <span class="text-center w-1/5 font-semibold text-sm">@currency($c['harga'])</span>
                        <span class="text-center w-1/5 font-semibold text-sm">@currency($c['subtotal'])</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex shadow-md my-10 rounded-xl">
            <div class="w-full bg-secondary px-10 py-10 rounded-xl text-white">
                <h1 class="font-semibold text-2xl border-b pb-8">Informasi Pembayaran</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Ekspedisi</span>
                    @if ($cekongkir == 0)
                        <span class="font-semibold text-sm">Ambil Ditempat</span>
                    @else
                        @if ($getServices == 'OKE')
                            <span class="font-semibold text-sm">JNE - OKE (4-5 Hari)</span>
                        @else
                            <span class="font-semibold text-sm">JNE - REG (2-3 Hari)</span>
                        @endif
                    @endif

                </div>

                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Ongkos Kirim</span>
                    <span class="font-semibold text-sm">@currency($cekongkir)</span>
                </div>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Subtotal</span>
                    <span class="font-semibold text-sm">@currency($subtotal)</span>
                </div>
                @if ($getCoupon != null)
                    <div class="flex justify-between mt-10 mb-5">
                        <span class="font-semibold text-sm uppercase">Potongan Kupon</span>
                        <span class="font-semibold text-sm"> - @currency($getCoupon)</span>
                    </div>
                @endif
                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total</span>
                        <span>@currency($grandTotal)</span>
                    </div>
                    <button id="pay-button"
                        class="pay bg-white font-semibold py-3 text-sm hover:bg-primary hover:text-white text-secondary uppercase w-full">Checkout</button>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data" id="submit_form">
        @csrf
        <input type="hidden" name="json" id="json_callback">
        <input type="hidden" value="{{ Auth::user()->alamat }}" name="address">
        <input type="hidden" value="{{ $grandTotal }}" name="grandTotal">
        <input type="hidden" value="{{ $getServices }}" name="courierService">
        <input type="hidden" value="{{ $cekongkir }}" name="ongkos_kirim">
        <input type="hidden" value="{{ $getCoupon }}" name="potongan_kupon">
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
