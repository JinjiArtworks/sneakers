@extends('layouts.customers')
@section('breadcrumbs')
    <div class="text-sm breadcrumbs mt-4">
        <ul>
            <li>
                <a href="/">
                    Home
                </a>
            </li>
            <li>
                <a href="/products">
                    Belanja
                </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="bg-white py-4 rounded-b-xl my-10 rounded-xl">
        <div class="container mx-auto flex items-center flex-wrap  pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto   items-center  px-2 py-3">
                    {{-- <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                        href="#">
                        Produk Kami
                    </a> --}}
                    <div id="store-nav-content ">
                        <div class="pt-2 text-gray-600">
                            <form action="" method="get">
                                <select id="countries" name="filter_alergi"
                                    class="bg-gray-50 border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-4  ">
                                    <option value=""> -- Hindari produk dengan Alergi : -- </option>
                                    @foreach ($alergi as $item)
                                        <option
                                            value="{{ $item->id }}"{{ Request::get('filter_alergi') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                <select id="countries" name="filter2"
                                    class="bg-gray-50 border border-gray-100 text-gray-900 text-sm rounded-lg   p-4  ">
                                    <option value=""> -- Urutkan berdasarkan -- </option>
                                    <option value="Termurah"{{ Request::get('filter2') == 'Termurah' ? 'selected' : '' }}>
                                        Harga Termurah</option>
                                    <option value="Termahal"{{ Request::get('filter2') == 'Termahal' ? 'selected' : '' }}>
                                        Harga Termahal</option>
                                    <option value="Terlaris"{{ Request::get('filter2') == 'Terlaris' ? 'selected' : '' }}>
                                        Produk Terlaris</option>
                                    <option
                                        value="BestRating"{{ Request::get('filter2') == 'BestRating' ? 'selected' : '' }}>
                                        Rating Terbanyak</option>
                                </select>
                                <button
                                    class=" px-4 py-4 rounded-lg  text-sm bg-secondary p-0 border-0 text-white hover:bg-primary inline-flex justify-center items-center">
                                    Filter
                                </button>
                            </form>
                            {{--                             
                            <form action="{{ route('products.search') }}" method="GET">
                                <input
                                    class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                                    type="search" name="search" placeholder="Search">
                                <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                        x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                        style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px"
                                        height="512px">
                                        <path
                                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                    </svg>
                                </button>
                            </form> --}}
                        </div>

                    </div>
                </div>

            </nav>
            @foreach ($products as $item)
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="/detail-product/{{ $item->id }}">
                        <img class="hover:grow hover:shadow-lg " style="width: 450px; height: 300px"
                            src="{{ asset('images/' . $item->gambar) }}">
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">{{ $item->nama }}</p>
                            <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                            </svg>
                        </div>
                        <p class="pt-1 text-gray-900">@currency($item->harga)</p>

                        <span>
                            <small>
                                Terjual : {{ $item->terjual }}
                            </small>
                        </span>
                        <br>
                        <span>
                            <small class="text-secondary">
                                @if ($item->alergi != null)
                                    * Alergi : {{ $item->alergi->nama }}
                                @endif
                            </small>
                        </span>
                    </a>
                </div>
            @endforeach

        </div>
        {{-- <div class="flex my-4 justify-center">
            <div class="join">
                <button class="join-item btn btn-active">1</button>
                <button class="join-item btn ">2</button>
                <button class="join-item btn">3</button>
                <button class="join-item btn">4</button>
            </div>
        </div> --}}
    </section>
@endsection
