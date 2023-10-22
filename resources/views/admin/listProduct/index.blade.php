@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1  rounded-xl">
            <div class="card-header flex justify-between">
                <p class="text-2xl text-black ">Daftar Produk</p>
                <a href="/create-products" class="btn-shadow ">Tambah Produk</a>
            </div>
            <table class="table-auto w-full text-left text-sm">
                <thead>
                    <tr class="">
                        <th class="p-4 ">Gambar</th>
                        <th class="p-4 ">Nama produk</th>
                        <th class="p-4 ">kategori</th>
                        <th class="p-4 ">harga</th>
                        <th class="p-4 ">ukuran</th>
                        <th class="p-4 ">stok</th>
                        <th class="p-4 ">terjual</th>
                        <th class="p-4 ">berat</th>
                        <th class="p-4 ">aksi</th>
                    </tr>
                </thead>
                @foreach ($products as $item)
                    <tbody>
                        <tr>
                            <td class="p-4">
                                <img src="{{ asset('images/' . $item->gambar) }}" class="w-20 h-20 " alt="">
                            </td>
                            <td class="p-4">{{ $item->nama }}</td>
                            <td class="p-4">{{ $item->categories->nama }}</td>
                            <td class="p-4">@currency($item->harga)</td>
                            <td class="p-4">{{ $item->ukuran }}</td>
                            <td class="p-4">{{ $item->stok }}</td>
                            <td class="p-4">{{ $item->terjual }}</td>
                            <td class="p-4">{{ $item->berat }}g</td>
                            {{-- @if ($item->coupons_id != null)
                                <td class="p-4"><span class="badge btn-info btn-sm p-2 text-black text-sm">Aktif</span>
                                </td>
                            @else
                                <td class="p-4"><span class="badge btn-info  btn-sm p-2 text-black text-sm">Tidak
                                        Aktif</span></td>
                            @endif --}}
                            <td class="p-4">
                                <form action="{{ route('products.edit', ['id' => $item->id]) }}">
                                    <button type="submit"">
                                        <i class="far fa-edit ml-2 mt-3 text-blue-600"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="p-4">
                                <form method="GET" action="{{ route('products.delete', ['id' => $item->id]) }}">
                                    <button type="submit" class="deleteProduk">
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
        $('.deleteProduk').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Produk?',
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
