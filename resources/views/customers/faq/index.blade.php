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
                    FAQ
                </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="bg-white py-4 rounded-b-xl my-10 rounded-xl">
        <div class="container mx-auto flex items-center flex-wrap  pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between px-2 py-3">
                    <a class=" tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                        Frequently Asked Question (FAQ)
                    </a>
                    @foreach ($faq as $item)
                        <div class="collapse collapse-arrow bg-white border-2 border-secondary my-4" tabindex="0">
                            <input type="checkbox" />
                            <div class="collapse-title text-md font-medium ">
                                {{ $item->pesan }}
                            </div>
                            <div class="collapse-content mx-2">
                                @if ($item->jawaban != null)
                                    <p> -> {{ $item->jawaban }}</p>
                                @else
                                    <p>Belum ada jawaban.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
            </nav>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('.confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Kirim Pertanyaan?',
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
