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
        </ul>
    </div>
@endsection
@section('content')
    @php
        $subtotal = 0;
        $subtotal = 0;
        $berat = 0;
        if ($cart != null) {
            foreach ($cart as $key => $value) {
                $subtotal += $value['subtotal'];
                $totalBerat = $value['berat'] * $value['quantity'];
            }
        }
    @endphp
    <div class="container mx-auto">
        <div class="flex shadow-md my-10 rounded-l-xl">

            @if ($cart == null)
                <div class="w-full bg-white px-10 py-10 rounded-l-xl">

                    <h2 class="flex justify-center">Keranjang Kosong</h2>
                    <h2 class="flex justify-center text-secondary underline"> <a href="/products">Lanjut Belanja</a></h2>
                </div>
            @else
                <div class="w-3/4 bg-white px-10 py-10 rounded-l-xl">
                    <div class="flex justify-between border-b pb-8">
                        <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                        <h2 class="font-semibold text-2xl">{{ $countCart }} Items</h2>
                    </div>
                    <div class="mt-4 border-b pb-8">
                        <h2 class="font-semibold text-sm text-gray-600">Penerima : <span
                                class=" font-normal ">{{ Auth::user()->name }}</span></h2>
                        <h2 class="font-semibold text-sm text-gray-600  my-2">Nomor Handphone : <span
                                class=" font-normal ">{{ Auth::user()->phone }}</span></h2>
                        @if (Auth::user()->address != null)
                            <h2 class="font-semibold text-sm text-gray-600">Alamat :
                                <span class=" font-normal ">{{ Auth::user()->address }} - {{ $city->name }},
                                    {{ $province->name }}
                                    <span class="flex text-secondary hover:text-primary underline">
                                        <label for="my_modal_7">Ubah Alamat </label>
                                    </span>
                                </span>
                            </h2>
                        @else
                            <h2 class="font-semibold text-sm text-gray-600">Alamat :
                                <span class="font-normal">Belum ada alamat.
                                    <span class="flex text-secondary hover:text-primary underline">
                                        <label for="my_modal_7">Tambah Alamat </label>
                                    </span>
                                </span>
                            </h2>
                        @endif
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
                                    <span class="font-normal text-xs">Alergi : {{ $c['alergi'] }}</span>
                                </div>
                            </div>
                            <span class="text-center w-1/5 font-semibold text-sm">x{{ $c['quantity'] }}</span>
                            <span class="text-center w-1/5 font-semibold text-sm">@currency($c['harga'])</span>
                            <span class="text-center w-1/5 font-semibold text-sm">@currency($c['subtotal'])</span>
                            <form action="{{ route('cart.delete', ['id' => $c['id']]) }}" method="GET">
                                <button type="submit" class="deleteCart flex items-center text-red-600 mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="w-4 h-4 fill-current">
                                        <path
                                            d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z">
                                        </path>
                                        <rect width="32" height="200" x="168" y="216">
                                        </rect>
                                        <rect width="32" height="200" x="240" y="216">
                                        </rect>
                                        <rect width="32" height="200" x="312" y="216">
                                        </rect>
                                        <path
                                            d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                    <div class=" text-secondary hover:text-primary font-semibold text-sm mt-10">
                        <a href="/products" class="flex ">
                            <svg class="fill-current mr-2 w-4" viewBox="0 0 448 512">
                                <path
                                    d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                            </svg>
                            Lanjut Belanja
                        </a>
                    </div>
                </div>

                <div id="summary" class="w-1/4 px-8 py-10 bg-secondary rounded-r-xl">
                    <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                    <form method="POST" action="{{ route('checkout.index') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $totalBerat }}" name="berat">
                        <input type="hidden" value="{{ $subtotal }}" name="total">
                        <input type="hidden" value="444" name="origin">
                        <input type="hidden" value="{{ Auth::user()->city_id }}" name="destination">
                        <input type="hidden" value="{{ Auth::user()->province_id }}" name="province">
                        <div>
                            <label class=" font-semibold inline-block mb-3 text-sm uppercase mt-4">Shipping</label>
                            <select class="block p-2 text-gray-600 w-full text-sm" name="courier" id="payment-type">
                                @foreach ($ekspedisi as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                                <option value="Ambil Ditempat">Ambil Ditempat</option>
                            </select>
                            <select class="block p-2 text-gray-600 w-full text-sm mt-4" name="service" id="services">
                                <option value="OKE">OKE (4-5 Hari)</option>
                                <option value="REG">REG (2-3 Hari)</option>
                            </select>
                        </div>
                        <div class="py-4">
                            <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo
                                Code</label>
                            <select class="block p-2 text-gray-600 w-full text-sm" name="coupon">
                                @if ($kupons != null)
                                    @foreach ($kupons as $item)
                                        <option value="{{ $item->potongan }}">{{ $item->kode_kupon }} - Potongan
                                            @currency($item->potongan)</option>
                                    @endforeach
                                @else
                                    <option value="Tidak Pakai Kupon">Kupon Tidak Tersedia</option>
                                @endif
                            </select>
                        </div>

                        <div class="border-t mt-8">
                            <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                <span>Sub Total</span>
                                <span>@currency($subtotal)</span>
                            </div>
                        </div>
                        @if (Auth::user()->roles != 'Customers')
                            <button type="submit"
                                class="btn-checkout rounded-xl bg-white font-semibold py-3 text-sm hover:bg-primary hover:text-white text-secondary uppercase w-full"
                                disabled>Checkout
                            </button>
                        @else
                            @if (Auth::user()->address != null)
                                <button type="submit"
                                    class="btn-checkout rounded-xl bg-white font-semibold py-3 text-sm hover:bg-primary hover:text-white text-secondary uppercase w-full">Checkout
                                </button>
                            @else
                                <button type="submit"
                                    class="btn-checkout rounded-xl bg-white font-semibold py-3 text-sm hover:bg-primary hover:text-white text-secondary uppercase w-full"
                                    disabled>Checkout
                                </button>
                            @endif
                        @endif

                    </form>

                </div>
            @endif
        </div>
    </div>
    <input type="checkbox" id="my_modal_7" class="modal-toggle" />
    <div class="modal">
        <form method="POST" class="modal-box" action="{{ route('cart.updateAddress', ['id' => Auth::user()->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <h3 class="font-bold text-lg">Tambah Alamat</h3>
            <label class="label">
                <span class="label-text">Alamat</span>
            </label>
            @if ($userAddress == null)
                <textarea type="text" placeholder="Masukkan Alamat Anda" required name="address"
                    class=" block p-2 text-gray-600 w-full text-sm"></textarea>
            @else
                <textarea type="text" placeholder="Masukkan Alamat Anda" required name="address"
                    class=" block p-2 text-gray-600 w-full text-sm" value="{{ $userAddress }}"></textarea>
            @endif

            <label class="label">
                <span class="label-text">Provinsi</span>
            </label>
            <select class="block p-2 text-gray-600 w-full text-sm" name="province">
                @if ($getUsersProvince == null)
                    @foreach ($allProvince as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                @else
                    <option value="{{ $getUsersProvince }}">{{ $province->name }}</option>
                    @foreach ($allProvince as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                @endif
            </select>

            <label class="label">
                <span class="label-text">Kota</span>
            </label>
            <select class="block p-2 text-gray-600 w-full text-sm" name="city">
                @if ($getUsersCity == null)
                    @foreach ($allCities as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                @else
                    <option value="{{ $getUsersCity }}">{{ $city->name }}</option>
                    @foreach ($allCities as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                @endif
            </select>
            <button class="confirm mt-4 rounded-xl font-semibold py-3 text-sm text-white uppercase w-full"
                style="background:#ef9fbc" type="submit">Konfirmasi
            </button>
        </form>
        <label class="modal-backdrop" for="my_modal_7">Close</label>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $(document).on('click', '.btn-checkout', function() {
        //         if ({{ $userAddress }} = '') {
        //             alert('Harap Masukkan Alamat');
        //         }

        //     });
        // });
        $('.deleteCart').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Produk Dari Keranjang?',
                icon: 'info',
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
        $('.confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Konfirmasi Alamat?',
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
        $('.btn-checkout').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Checkout Produk?',
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
        $("#payment-type").change(function() {
            // alert('asd');
            var control = $(this);
            if (control.val() == 'Ambil Ditempat') {
                $("#services").hide();
            } else {
                $("#services").show();
            }
        });
    </script>
@endsection
