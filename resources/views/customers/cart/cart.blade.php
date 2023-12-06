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
                                                <h5>{{ $value['name'] }}
                                                    <br>
                                                    <span>
                                                        <small> <b> Size : {{ $value['size'] }}</b></small>
                                                    </span>
                                                </h5>

                                            </td>
                                            <td class="shoping__cart__price">
                                                @currency($value['price'])
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                x{{ $value['quantity'] }}
                                            </td>
                                            <td class="shoping__cart__total">
                                                @currency($value['subtotal'])
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <form action="{{ route('cart.delete', ['id' => $value['id']]) }}"
                                                    method="GET">
                                                    <button type="submit"
                                                        class="deleteCart btn-primary p-2 flex items-center text-red-600 mt-3 ">
                                                        <i class="fa fa-trash"></i>
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
                                <input type="hidden" value="{{ $value['sellers_id'] }}" name="sellers_id">
                                <input type="hidden" value="jne" name="courier">
                                <input type="hidden" value="REG" name="service">
                                <input type="hidden" value="444" name="origin">
                                <input type="hidden" value="{{ $getUsersCity }}" name="destination">
                                <input type="hidden" value="{{ $getUsersProvince }}" name="province">
                                <ul>
                                    <li>Alamat
                                        <span class="text-secondary">
                                            @if ($userAddress == null && $getUsersCity == null && $getUsersProvince == null)
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#addressModal">Tambah Alamat</button>
                                            @else
                                                {{ $userAddress }} - {{ $city->name }} - {{ $province->name }}
                                                <br>
                                                <button type="button" class="btn btn-sm btn-primary float-right"
                                                    data-toggle="modal" data-target="#addressModal">Ubah Alamat</button>
                                            @endif
                                        </span>
                                    </li>

                                    <li>Penerima <span class="text-secondary">{{ $userName }}</span></li>
                                    <li>Nomor Handphone <span class="text-secondary">0{{ $userPhone }}</span></li>
                                    <li>Ekspedisi <span class="text-secondary">JNE - REG (3-4 Hari)</span></li>
                                    <li>Subtotal <span class="text-secondary">@currency($subtotal)</span></li>
                                    {{-- <li>Total <span class="text-primary">$454.98</span></li> --}}
                                </ul>
                                @if (Auth::user()->address && $city && $province != null)
                                    <button class="primary-btn" style="width: 100%">Check Out</button>
                                @else
                                    <button class="btn-checkout primary-btn" style="width: 100%">Check
                                        Out</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="sellModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sellModalLabel">Add Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('cart.updateAddress', ['id' => Auth::user()->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userID" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label w-full">Province:</label>
                            <br>
                            <select name="province" class=" setProvince form-control" data-style="py-0">
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
                        <div class="form-group">
                            <label for="message-text" class="col-form-label w-full">City:</label>
                            <br>
                            <select name="city" id="setCity" class="form-control">
                                {{-- <option value="">Select </option> --}}
                                @if ($getUsersCity == null)
                                    @foreach ($allProvince as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @else
                                    <option value="{{ $getUsersCity }}">{{ $city->name }}</option>
                                    @foreach ($allProvince as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label w-full">Address:</label>
                            <br>
                            @if ($userAddress == null && $getUsersCity == null && $getUsersProvince == null)
                                <textarea type="text" placeholder="Masukkan Alamat Anda" required name="address" class="form-control"></textarea>
                            @else
                                <textarea type="text" placeholder="Masukkan Alamat Anda" required name="address" class="form-control">{{ $userAddress }}</textarea>
                            @endif
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $('select[name="province"]').on('change', function() {
                console.log('asd');
                var province_id = $(this).val();
                if (province_id) {
                    $.ajax({
                        url: "{{ url('/getCities/') }}/" + province_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('select[name="city"]').empty();
                            $.each(data, function(key, value) {
                                console.log(key, value);
                                let a = $('select[name="city"]').append(
                                    '<option value="' +
                                    key + '">' +
                                    value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="city"]').empty();
                }
            });
            $('.deleteCart').click(function(event) {
                console.log('asd');
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
            $('.btn-checkout').click(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Masukkan Alamat Anda',
                    icon: 'info',
                })
            });

            $('.confirmAddress').click(function(event) {
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
            // $('.checkOutProduct').click(function(event) {
            //     event.preventDefault();
            //     var form = $(this).closest("form");
            //     Swal.fire({
            //         title: 'Checkout Product?',
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
        });
    </script>
@endsection
