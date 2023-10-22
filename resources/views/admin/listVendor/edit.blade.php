@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Ubah Data Pembelian Pada Vendor</p>
            </div>
            <div class="p-6">
                <form method="POST"
                    action="{{ route('vendors.update', ['id' => $vendor->id]) }} "enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}

                    <div class="mb-4">
                        <label for="ordersDate" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Transaksi
                        </label>
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3""
                            name="ordersDate" required type="date" placeholder="Tanggal Transaksi" aria-label="date"
                            max="<?= date('Y-m-d') ?>" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-4">
                        <label for="vendorOwnerName" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Vendor
                        </label>
                        <select id="countries" name="vendorOwnerName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-3">
                            {{-- <option value="{{ $getVendorsName->id }}">{{ $getVendorsName->nama }}</option> --}}
                            @foreach ($vendorOwner as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="productName" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                            Produk</label>
                        <input type="text" name="productName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Nama Produk" required value="{{ $vendor->nama_produk }}">
                    </div>
                    <div class="mb-4">
                        <label for="productImage" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar
                            Produk </label>
                        <img src="{{ asset('images/' . $vendor->gambar) }}" id="blah" width="150px" height="150px"
                            class="mb-3">
                        <input accept="image/*" id="image" type="file" name="productImage" required
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-3">
                    </div>
                    <div class="mb-4">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 ">Catatan Transaksi
                        </label>
                        <textarea type="text"name="ordersNote" placeholder="Masukkan Catatan Transaksi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3">{{ $vendor->catatan }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="productPrice" class="block mb-2 text-sm font-medium text-gray-900  ">Harga Produk
                        </label>
                        <input type="number" name="productPrice" value="{{ $vendor->harga }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Harga" required>
                    </div>
                    <div class="mb-4">
                        <label for="productQty" class="block mb-2 text-sm font-medium text-gray-900 ">Quantity Produk
                        </label>
                        <input type="number" name="productQty" value="{{ $vendor->quantity }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Quantity Produk">
                    </div>
                    <button type="submit"
                        class="confirm text-white btn-shadow hover:bg-green-400  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 ">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script>
        $('.confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Konfirmasi Perubahan?',
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
    </script>
@endsection
