@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1  rounded-xl">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Daftar Pesanan Vendor</p>
                <a href="/create-vendors" class="btn-shadow ">Tambah Data Vendor</a>
            </div>
            <table class="table-auto w-full text-left text-sm">
                <thead>
                    <tr class="">
                        <th class=" p-3 ">Gambar</th>
                        <th class=" p-3 ">Tanggal Transaksi</th>
                        <th class=" p-3 ">Nama Produk</th>
                        <th class=" p-3 ">Nama Vendor</th>
                        <th class=" p-3 ">harga</th>
                        <th class=" p-3 ">quantity</th>
                        <th class=" p-3 ">Total</th>
                        <th class=" p-3 ">Catatan</th>
                        <th class=" p-3 ">Aksi</th>
                    </tr>
                </thead>
                @foreach ($vendor as $item)
                    <tbody>
                        <tr>
                            <td class=" p-3">
                                <img src="{{ asset('images/' . $item->gambar) }}" class="w-20 h-20 " alt="">
                            </td>
                            <td class=" p-3">{{ $item->tanggal }}</td>
                            <td class=" p-3">{{ $item->nama_produk }}</td>
                            <td class=" p-3">{{ $getVendorsName->nama }}</td>
                            <td class=" p-3">@currency($item->harga)</td>
                            <td class=" p-3">{{ $item->quantity }}</td>
                            <td class=" p-3">@currency($item->total_pengeluaran)</td>
                            <td class=" p-3">{{ $item->catatan }}</td>
                            <td class=" p-3">
                                <form action="{{ route('vendors.edit', ['id' => $item->id]) }}">
                                    <button type="submit"">
                                        <i class="far fa-edit ml-2 mt-3 text-blue-600"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="p-4">
                                <form method="GET" action="{{ route('vendors.delete', ['id' => $item->id]) }}">
                                    <button type="submit" class="deleteVendor">
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
        $('.deleteVendor').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Data Vendor?',
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
