@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Ubah Kategori</p>
            </div>
            <div class="p-6">
                <form method="POST"
                    action="{{ route('resources.update-kategori', ['id' => $kategori->id]) }} "enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <div class="mb-4">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Kategori</label>
                        <input type="text" name="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Nama Kategori" value="{{ $kategori->nama }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 ">Deskripsi</label>
                        <input type="text" name="deskripsi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Deskripsi Kategori" value="{{ $kategori->deskripsi }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="catImages" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar
                            Produk </label>
                        <img src="{{ asset('images/' . $kategori->gambar ) }}" id="blah" width="150px" height="150px"
                            class="mb-3">
                        <input accept="image/*" id="image" type="file" name="catImages"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-3">
                    </div>
                    <button type="submit"
                        class="confirm-edit text-white btn-shadow hover:bg-green-400  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 ">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.confirm-edit').click(function(event) {
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
     <script type="text/javascript">
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
