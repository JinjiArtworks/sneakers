@extends('layouts.customers')
@section('content')
    <section class="py-8 rounded-b-xl pb-40">
        <div class="container mx-auto items-center flex flex-wrap pt-4 pb-12">
            <div class=" flex w-full">
                <div class="md:w-3/12 md:mx-2 ">
                    <div class="bg-white p-3 border-2 border-secondary rounded-xl">
                        <h1 class=" font-bold text-xl leading-8 my-1">{{ Auth::user()->name }}</h1>
                        <p class="text-sm  leading-6"><span class="font-bold">Nomor Handphone : </span>
                            {{ Auth::user()->phone }}</p>
                        <p class="text-sm leading-6"><span class="font-bold">Alamat : </span>{{ Auth::user()->address }}</p>
                        <span class="flex text-secondary hover:text-primary text-sm underline">
                            <label for="my_modal_7">Ubah Alamat </label>
                        </span>
                    </div>
                    <div class="my-4"></div>
                </div>

                <div class="w-full">
                    <div class="bg-white p-3 shadow-sm border-2 border-secondary rounded-xl">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mx-4">
                            <span class="tracking-wide text-xl underline my-3">Wishlist</span>
                        </div>
                        @foreach ($getWishlist as $item)
                            <div class="p-3 w-full">
                                <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded-xl">
                                    <div class="w-28">
                                        <img src="{{ asset('images/' . $item->product->gambar) }}" class="w-full">
                                    </div>
                                    <div class="w-1/2">
                                        <h2 class="text-xl font-medium ">
                                            {{ $item->product->nama }}
                                        </h2>
                                        <p class="text-gray-500 text-sm">Stock Tersedia: <span
                                                class="text-primary">{{ $item->product->stok }} pcs</span>
                                        </p>
                                    </div>

                                    <div class="text-lg font-semibold">
                                        <a href="/detail-product/{{ $item->product_id }}"
                                            class="text-white bg-secondary hover:bg-primary rounded-xl text-sm px-5 py-2.5 text-center">
                                            Lihat Produk</a>
                                    </div>
                                    <div class="mr-4">
                                        <form action="{{ route('wishlist.remove', ['id' => $item->product_id]) }}"
                                            method="GET">
                                            <input type="hidden" name="products" value="{{ $item->product_id }}">
                                            <button type="submit" class="mt-4 delete-wishlist">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                    {{-- <a href="/detail-pesanan/{{ $item->orderdetail->order_id }}" --}}
                    {{-- <a href="/detail-pesanan/{{ $item->orderdetail->order_id }}" 
                            class="block w-full  text-sm font-semibold bg-secondary text-white rounded-lg hover:bg-primary hover:shadow-xs p-3 my-4">
                            Ubah Informasi
                        </a> --}}
                </div>
            </div>
            <input type="checkbox" id="my_modal_7" class="modal-toggle" />
            <div class="modal">
                <form method="POST" class="modal-box"
                    action="{{ route('cart.updateAddress', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <h3 class="font-bold text-lg">Tambah Alamat</h3>
                    <label class="label">
                        <span class="label-text">Alamat</span>
                    </label>
                    <input type="text" placeholder="Type here" required name="address"
                        class="block p-2 text-gray-600 w-full text-sm" value="{{ Auth::user()->address }}" />

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
                    <button class="mt-4 btn-confirm rounded-xl font-semibold py-3 text-sm text-white uppercase w-full"
                        style="background:#ef9fbc" type="submit">Konfirmasi
                    </button>
                </form>
                <label class="modal-backdrop" for="my_modal_7">Close</label>
            </div>
    </section>
@endsection
@section('script')
    <script>
        $('.btn-confirm').click(function(event) {
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
        $('.delete-wishlist').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Dari Wishlist?',
                icon: 'warning',
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
    </script>
@endsection
