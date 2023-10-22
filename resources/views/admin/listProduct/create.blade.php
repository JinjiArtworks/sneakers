@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Tambah Produk</p>
            </div>
            <div class="p-6">
                <form method="POST" action="/store-products" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="productName" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                            Produk</label>
                        <input type="text" name="productName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Nama Produk" required>
                    </div>
                    <div class="mb-4">
                        <label for="productImage" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar
                            Produk </label>
                        <img src="{{ asset('images/no-profile.png') }}" id="blah" width="150px" height="150px"
                            class="mb-3">
                        <input accept="image/*" id="image" type="file" name="productImage"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-3">
                    </div>
                    <div class="mb-4">
                        <label for="productCat" class="block mb-2 text-sm font-medium text-gray-900 ">Kategori Produk
                        </label>
                        <select id="countries" name="productCategories"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-3">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="usia" class="block mb-2 text-sm font-medium text-gray-900 ">Kategori Usia
                        </label>
                        <select id="usia" name="usia"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-3">
                            <option value="1-2 Tahun">1-2 Tahun</option>
                            <option value="3-5 Tahun">3-5 Tahun</option>
                            <option value="5-10 Tahun">5-10 Tahun</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="productSize" class="block mb-2 text-sm font-medium text-gray-900 ">Ukuran
                            Produk
                        </label>
                        <select id="countries" name="productSize"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-3">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="All Size">All Size</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="productDesc" class="block mb-2 text-sm font-medium text-gray-900 ">Deskripsi
                            Produk
                        </label>
                        <textarea type="text"name="productDesc" placeholder="Masukkan Deskripsi Produk"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"></textarea>
                    </div>
                  
                    <div class="mb-4">
                        <label for="productStock" class="block mb-2 text-sm font-medium text-gray-900 ">Stok
                            Produk
                        </label>
                        <input type="number" name="productStock"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Stok Produk" required>
                    </div>
                    <div class="mb-4">
                        <label for="productPrice" class="block mb-2 text-sm font-medium text-gray-900 ">Harga
                            Produk
                        </label>
                        <input type="number" name="productPrice"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Harga Produk" required>
                    </div>
                    <div class="mb-4">
                        <label for="productDisc" class="block mb-2 text-sm font-medium text-gray-900 ">Diskon
                            Produk
                        </label>
                        <input type="number" name="productDisc"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Diskon">
                        <small>*kosongkan jika tidak ada diskon</small>
                    </div>
                    <div class="mb-4">
                        <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 ">Brand Produk
                        </label>
                        <input type="text" name="productBrand"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Brand Produk" >
                    </div>
                    <div class="mb-4">
                        <label for="bahan" class="block mb-2 text-sm font-medium text-gray-900 ">Bahan Produk
                        </label>
                        <input type="text" name="productBahan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Bahan Produk" >
                    </div>
                    <div class="mb-4">
                        <label for="usia" class="block mb-2 text-sm font-medium text-gray-900 ">Kandungan Alergi
                        </label>
                        <select id="usia" name="productAlergi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-3">
                            <option value=""> -- Tidak Memiliki Kandungan Alergi -- </option>
                            @foreach ($alergi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <small>*kosongkan jika tidak ada kandungan alergi.</small>

                    </div>
                    <div class="mb-4">
                        <label for="productWeight" class="block mb-2 text-sm font-medium text-gray-900 ">Berat
                            Produk
                        </label>
                        <input type="number" name="productWeight" value="300"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Berat Produk" >
                        <small>*Berat normal produk yaitu 300g / Produk</small>
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
                title: 'Konfirmasi Produk?',
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
