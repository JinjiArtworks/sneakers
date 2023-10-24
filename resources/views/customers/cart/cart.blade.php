@extends('layouts.customers')
@section('content')
    @php
        $subtotal = 0;
        $berat = 0;
        if ($cart != null) {
            foreach ($cart as $key => $value) {
                $subtotal += $value['subtotal'];
                $totalBerat = $value['weight'] * $value['quantity'];
            }
        }
    @endphp

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            @if ($cart == null)
                <p>Cart is Empty</p>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item => $value)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{ asset('img/list/' . $value['images']) }}" width="100px"
                                                    alt="">
                                                <h5>{{ $value['name'] }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                @currency($value['price'])
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                {{ $value['quantity'] }}
                                            </td>
                                            <td class="shoping__cart__total">
                                                @currency($value['subtotal'])

                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <form action="{{ route('cart.delete', ['id' => $value['id']]) }}"
                                                    method="GET">
                                                    <button type="submit"
                                                        class="deleteCart flex items-center text-red-600 mt-3 "> X
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <form method="POST" action="{{ route('checkout.index') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $totalBerat }}" name="berat">
                                <input type="hidden" value="{{ $subtotal }}" name="total">
                                <input type="hidden" value="jne" name="courier">
                                <input type="hidden" value="REG" name="service">
                                <input type="hidden" value="444" name="origin">
                                <input type="hidden" value="{{ Auth::user()->city_id }}" name="destination">
                                <input type="hidden" value="{{ Auth::user()->province_id }}" name="province">
                                <ul>
                                    <li>Alamat
                                        <span class="text-secondary">
                                            @if (Auth::user()->address == null)
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">Tambah Alamat</button>
                                            @else
                                                {{ Auth::user()->address }}
                                                <br>
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">Ubah Alamat</button>
                                            @endif
                                        </span>
                                    </li>
                                    <li>Penerima <span class="text-secondary">{{ Auth::user()->name }}</span></li>
                                    <li>Nomor Handphone <span class="text-secondary">{{ Auth::user()->phone }}</span></li>
                                    <li>Ekspedisi <span class="text-secondary">JNE - REG (3-4 Hari)</span></li>
                                    <li>Subtotal <span class="text-secondary">@currency($subtotal)</span></li>
                                    {{-- <li>Total <span class="text-primary">$454.98</span></li> --}}
                                </ul>
                                <button type="submit" href="#" style="width: 100%"
                                    class=" primary-btn">Checkout</button>
                            </form>
                        </div>

                    </div>
                </div>
            @endif

        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="modal-box"
                            action="{{ route('cart.updateAddress', ['id' => Auth::user()->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="">Alamat Anda</label>
                                @if ($userAddress == null)
                                    <textarea type="text" placeholder="Masukkan Alamat Anda" required name="address" class="form-control"></textarea>
                                @else
                                    <textarea type="text" placeholder="Masukkan Alamat Anda" required name="address" class="form-control"
                                        value="{{ $userAddress }}"></textarea>
                                @endif
                            </div>
                            <div class="mb-3">
                                <select name="province" class="mb-3">
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
                            </div>
                            <br>
                            <div class="mb-3">
                                <select name="city">
                                    @if ($getUsersCity == null)
                                        @foreach ($allCities as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="{{ $getUsersCity }}">{{ $city->name }}</option>
                                        @foreach ($allCities as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send message</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
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
        // $('.deleteCart').click(function(event) {
        //     event.preventDefault();
        //     var form = $(this).closest("form");
        //     Swal.fire({
        //         title: 'Hapus Produk Dari Keranjang?',
        //         icon: 'info',
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
        // $('.confirm').click(function(event) {
        //     event.preventDefault();
        //     var form = $(this).closest("form");
        //     Swal.fire({
        //         title: 'Konfirmasi Alamat?',
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
        // $('.btn-checkout').click(function(event) {
        //     event.preventDefault();
        //     var form = $(this).closest("form");
        //     Swal.fire({
        //         title: 'Checkout Produk?',
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
