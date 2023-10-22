@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Tambah Data Alergi</p>
            </div>
            <div class="p-6">
                <form method="POST" action="/store-alergi" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Alergi</label>
                        <input type="text" name="nama" min="1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Nama Alergi " required>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 ">Deskripsi Alergi
                        </label>
                        <textarea type="text" name="deskripsi" min="1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Deskripsi Alergi" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="efek" class="block mb-2 text-sm font-medium text-gray-900 ">Efek Samping Alergi
                        </label>
                        <textarea type="text" name="efek" min="1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Efek Alergi" required></textarea>
                    </div>
                    <button type="submit"
                        class="confirm text-white btn-shadow hover:bg-green-400  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 ">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Konfirmasi Data?',
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
