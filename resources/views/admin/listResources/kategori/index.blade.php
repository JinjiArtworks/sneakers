@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1  rounded-xl">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Daftar Kategori</p>
                <a href="/create-kategori" class="btn-shadow ">Tambah Kategori</a>
            </div>
            <table class="table-auto w-full text-left text-sm">
                <thead>
                    <tr class="">
                        <th class="p-4">Gambar</th>
                        <th class="p-4">Nama Kategori</th>
                        <th class="p-4">Deskripsi</th>
                    </tr>
                </thead>
                @foreach ($kategori as $item)
                    <tbody>
                        <tr>
                            <td class="p-4">
                                <img src="{{ asset('images/' . $item->gambar) }}" class="w-20 h-20 " alt="">
                            </td>
                            <td class="p-4">{{ $item->nama }}</td>
                            <td class="p-4">{{ $item->deskripsi }}</td>
                            <td class="p-4">
                                <form action="{{ route('resources.edit-kategori', ['id' => $item->id]) }}">
                                    <button type="submit"">
                                        <i class="far fa-edit ml-2 mt-3 text-blue-600"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="p-4">
                                <form method="GET" action="{{ route('resources.delete-kategori', ['id' => $item->id]) }}">
                                    <button type="submit" class="deleteKategori">
                                        <i class="far fa-trash-alt ml-2 mt-3 text-red-600"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
    <!-- End Recent Sales -->
@endsection
@section('script')
    <script>
        $('.deleteKategori').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Kategori?',
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
