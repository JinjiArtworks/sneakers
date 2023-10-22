@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1  rounded-xl">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Daftar Alergi</p>
                <a href="/create-alergi" class="btn-shadow ">Tambah Data Alergi</a>
            </div>
            <table class="table-auto w-full text-left text-xs">
                <thead>
                    <tr class="">
                        <th class="p-4">Nama Alergi</th>
                        <th class="p-4">Deskripsi Alergi</th>
                        <th class="p-4">Efek Samping Alergi</th>
                    </tr>
                </thead>
                @foreach ($alergi as $item)
                    <tbody>
                        <tr>
                            <td class="p-4 ">{{ $item->nama }}</td>
                            <td class="p-4">{{ $item->deskripsi }}</td>
                            <td class="p-4">{{ $item->efek }}</td>
                            <td class="p-4">
                                <form action="{{ route('resources.edit-alergi', ['id' => $item->id]) }}">
                                    <button type="submit"">
                                        <i class="far fa-edit ml-2 mt-3 text-blue-600"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="p-4">
                                <form method="GET" action="{{ route('resources.delete-alergi', ['id' => $item->id]) }}">
                                    <button type="submit" class="delete-confirm">
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
        $('.delete-confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Data?',
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
