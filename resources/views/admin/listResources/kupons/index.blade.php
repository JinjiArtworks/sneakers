@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1  rounded-xl">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Daftar Kupon</p>
                <a href="/create-kupons" class="btn-shadow ">Tambah Kupon</a>
            </div>
            <table class="table-auto w-full text-left text-sm">
                <thead>
                    <tr class="">
                        <th class="p-4">Kode Kupon</th>
                        <th class="p-4">Potongan</th>
                        <th class="p-4">Tanggal Berlaku</th>
                        <th class="p-4">Tanggal Berakhir</th>
                    </tr>
                </thead>
                @foreach ($coupon as $item)
                    <tbody>
                        <tr>
                            <td class="p-4 font-semibold">#{{ $item->kode_kupon }}</td>
                            <td class="p-4">@currency($item->potongan)</td>
                            <td class="p-4">{{ $item->tanggal_berlaku }}</td>
                            <td class="p-4">{{ $item->tanggal_berakhir }}</td>
                            <td class="p-4">
                                <form action="{{ route('resources.edit-kupons', ['id' => $item->id]) }}">
                                    <button type="submit"">
                                        <i class="far fa-edit ml-2 mt-3 text-blue-600"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="p-4">
                                <form method="GET" action="{{ route('resources.delete-kupons', ['id' => $item->id]) }}">
                                    <button type="submit" class="deleteCoupon">
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
        $('.deleteCoupon').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Kupon?',
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
