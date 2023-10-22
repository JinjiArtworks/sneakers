@extends('layouts.toko')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <!-- Start Recent Sales -->
        <div class="card mt-6">
            <div class="card-body">
                <div class="card-header flex justify-between">
                    <p class="text-2xl text-black ">Frequently Asking Questions (FAQ)</p>
                    <div class="flex justify-end">
                        <button data-modal-target="faq-modal" data-modal-toggle="faq-modal"
                            class=" text-white btn-shadow hover:bg-green-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 my-4 "
                            type="button">
                            Tambah Pertanyaan
                        </button>
                    </div>
                </div>
                <div class="container mx-auto ">
                    @foreach ($faq as $item)
                        <div id="accordion-flush" data-accordion="collapse"
                            data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                            data-inactive-classes="text-gray-500 dark:text-gray-400">
                            <h2 id="accordion-flush-heading-1">
                                <button type="button"
                                    class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                    data-accordion-target="#accordion-flush-body-{{ $item->id }}" aria-expanded="true"
                                    aria-controls="accordion-flush-body-{{ $item->id }}">
                                    <span>Pertanyaan : {{ $item->pesan }}?</span>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-flush-body-{{ $item->id }}" class="hidden"
                                aria-labelledby="accordion-flush-heading-1">
                                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                    <div class="flex justify-between">
                                        <p class="mb-2 text-gray-500 dark:text-gray-400">Jawaban : {{ $item->jawaban }}</p>
                                        <form action="{{ route('admin-faq.delete', ['id' => $item->id]) }}" method="GET">
                                            <button type="submit" class="deleteCart flex items-center text-red-600 mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                    class="w-4 h-4 fill-current">
                                                    <path
                                                        d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z">
                                                    </path>
                                                    <rect width="32" height="200" x="168" y="216">
                                                    </rect>
                                                    <rect width="32" height="200" x="240" y="216">
                                                    </rect>
                                                    <rect width="32" height="200" x="312" y="216">
                                                    </rect>
                                                    <path
                                                        d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <form method="POST" class="modal-box"
                                        action="{{ route('admin-faq.update', ['id' => $item->id]) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('put') }}
                                        <textarea type="text" placeholder="Masukkan Jawaban" required name="jawaban"
                                            class="border-2  mb-4 p-2 text-gray-600 w-full text-sm"></textarea>
                                        <button type="submit"
                                            class="confirm-answer text-white btn-shadow hover:bg-green-400  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 ">Kirim</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div id="faq-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="faq-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only p-4">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Pertanyaan</h3>
                    <form method="POST" class="modal-box space-y-4" action="{{ route('admin-faq.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="productStock" class="block text-sm font-medium text-gray-900 ">Pertanyaan :
                        </label>
                        <textarea type="text" name="pertanyaan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-3"
                            placeholder="Masukkan Pertanyaan" required> </textarea>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="confirm-pertanyaan w-full text-white btn-shadow hover:bg-green-400  font-medium rounded-lg text-sm  px-5 py-2 ">Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.confirm-answer').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Konfirmasi Jawaban?',
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
        $('.confirm-pertanyaan').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Konfirmasi Pertanyaan?',
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
        $('.send-answer').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Kirim Jawaban?',
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
        $('.deleteCart').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Hapus Pertanyaan?',
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
