@extends('layouts.customers')
@section('breadcrumbs')
    <div class="text-sm breadcrumbs mt-4">
        <ul>
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="w-4 h-4 mr-2 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="w-4 h-4 mr-2 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    Detail Produk
                </a>
            </li>

        </ul>
    </div>
@endsection
@section('content')
    <section class="body-font overflow-hidden bg-white border border-secondary rounded-lg my-4">
        <div class="container px-5 py-5 mx-auto">
            <div class="w-full mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200"
                    src="{{ asset('images/' . $products->gambar) }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <div class="flex justify-between">
                        <h1 class="text-3xl title-font font-medium mb-1">{{ $products->nama }}</h1>
                        {{-- @foreach ($wishlist as $item)
                            @if ($products->id == $item->product_id)
                                Sudah ada di wishlist
                            @elseif ($item == null) --}}
                        <form action="{{ route('products.addToWishlist', ['id' => $products->id]) }}" method="POST">
                            @csrf
                            <button
                                class="add-wishlist rounded-full w-10 h-10 ml-auto bg-secondary p-0 border-0 text-white hover:bg-primary ">
                                <i class="fa-regular text-white text-lg fa-heart"></i>
                            </button>
                        </form>
                        {{-- @endif
                        @endforeach --}}
                    </div>
                    {{-- Stars --}}

                    <div class="my-2">
                        <p class="text-sm leading-relaxed">• Kategori : {{ $products->categories->nama }}</p>
                        <p class="text-sm leading-relaxed">• Stock : {{ $products->stok }} pcs</p>
                        <p class="text-sm leading-relaxed">• Terjual : {{ $products->terjual }} pcs</p>
                        <p class="text-sm leading-relaxed ">• {{ $products->jumlah_penilaian }} Person Reviews*</p>
                    </div>

                    <form action="{{ route('cart.add', ['id' => $products->id]) }}" method="POST">
                        @csrf
                        <div class="flex mt-6 items-center border-gray-200 ">
                            <div class="flex items-center">
                                <span class="mr-3">Size</span>
                                <div class="relative">
                                    @if ($products->ukuran == 'All Size')
                                        <select name="size"
                                            class="rounded border appearance-none border-gray-400 py-2 focus:outline-none focus:border-red-500 text-base pl-3 pr-10">
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                        </select>
                                    @else
                                        <select name="size"
                                            class="rounded border appearance-none border-gray-400 py-2 focus:outline-none focus:border-red-500 text-base pl-3 pr-10">
                                            <option value="{{ $products->ukuran }}">{{ $products->ukuran }}</option>
                                        </select>
                                    @endif

                                    <span
                                        class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class=" flex items-center pb-5 border-b-2 my-4">
                            <span class="mr-3">Quantity</span>
                            <div class="flex border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                                <a
                                    class="btn btn-reduce bg-secondary hover:bg-primary text-white h-2 mr-2 text-xl flex items-center ">
                                    -</a>
                                <div class="flex border-secondary rounded border ">
                                    <input class="rounded count" type="number" name="quantity" value="1"
                                        data-max="120" pattern="[0-9]*" style="width: 5rem">
                                </div>
                                <a
                                    class="btn btn-increase bg-secondary hover:bg-primary  text-white h-2 ml-2 text-xl flex items-center ">
                                    +</a>
                            </div>
                        </div>
                        <div class="flex">
                            @if ($products->diskon != null)
                                <span class="title-font font-medium text-2xl text-gray-900">@currency($products->harga - $products->diskon) - Potongan :
                                    {{ $products->diskon }}</span>
                            @else
                                <span class="title-font font-medium text-2xl text-gray-900">@currency($products->harga)</span>
                            @endif
                        </div>
                        <button
                            class="add-to-cart confirm-cart px-4 py-4 rounded-lg my-4 text-sm bg-secondary p-0 border-0 text-white hover:bg-primary inline-flex justify-center items-center">
                            Masukkan Keranjang
                        </button>
                    </form>
                </div>
                <table class="table-auto border-collapse w-full text-left text-xs my-6">
                    <h1 class="mt-4 font-bold text-xl">Informasi Produk</h1>
                    <tr>
                        <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Deskripsi</th>
                        <th class="py-2 px-4 border border-gray-300 font-normal leading-5">
                            {{ $products->deskripsi }}
                        </th>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Kategori Usia </th>
                        <th class="py-2 px-4 border border-gray-300 font-normal">{{ $products->usia }}</th>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Brand </th>
                        <th class="py-2 px-4 border border-gray-300 font-normal">{{ $products->brand }}</th>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Bahan</th>
                        <th class="py-2 px-4 border border-gray-300 font-normal">{{ $products->bahan }}</th>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Alergi</th>
                        @if ($products->alergi != null)
                            <th class="py-2 px-4 border border-gray-300 font-normal leading-5">
                                <b>{{ $products->alergi->nama }}</b>
                                <ul>
                                    <li>
                                        - {{ $products->alergi->deskripsi }}
                                    </li>
                                    <li>
                                        - {{ $products->alergi->efek }}
                                    </li>
                                </ul>
                            </th>
                        @else
                            <th class="py-2 px-4 border border-gray-300 font-normal leading-5">
                                Tidak ada kandungan alergi.
                            </th>
                        @endif
                    </tr>

                    <tr>
                        @if ($getReviews != null)
                            <th class="py-2 px-4 border border-gray-300 w-40 font-semibold">Review</th>
                            <th class="py-2 px-4 border border-gray-300 font-normal leading-5">
                                @foreach ($getReviews as $item)
                                    <b>User X</b> :
                                    {{ $item->komentar }} [Memberikan {{ $item->rating }} Bintang] <br>
                                @endforeach
                            </th>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        // alert('test');
        $(document).ready(function() {
            $(document).on('click', '.btn-increase', function() {
                $('.count').val(parseInt($('.count').val()) + 1);
                if ($('.count').val() > {{ $products->stok }}) {
                    $(':input[type="submit"]').prop('disabled', true);
                }
            });
            $(document).on('click', '.btn-reduce', function() {
                $('.count').val(parseInt($('.count').val()) - 1);
                if ($('.count').val() == 0) {
                    $('.count').val(1);
                }
                if ($('.count').val() <= {{ $products->stok }}) {
                    $(':input[type="submit"]').prop('disabled', false);
                }
            });
            $(document).on('click', '.add-to-cart', function() {
                if ($('.count').val() > {{ $products->stok }}) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Stock Tidak Tersedia',
                        icon: 'error',
                    })
                }
            });

        });
        $('.add-wishlist').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Masukkan Kedalam Wishlist?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

        $('.confirm-cart').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Tambahkan Kedalam Keranjang?',
                text: "Harap cek kandungan alergi terhadap produk ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
            // Swal.fire({
            //     title: 'Masukkan Kedalam Keranjang? Cek kandungan alergi terhadap produk ini ',
            //     icon: 'info',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Yes'
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         form.submit();
            //     }
            // })
        });
    </script>
@endsection
