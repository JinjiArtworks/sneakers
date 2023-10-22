@extends('layouts.customers')
@section('breadcrumbs')
    <div class="text-sm breadcrumbs mt-4">
        <ul>
            <li>
                Home
            </li>
            <li>
                Chat
            </li>
        </ul>
    </div>
@endsection
@section('content')
    @if (Auth::user()->roles == 'Customers')

        <div class="flex flex-col flex-auto h-full p-6 ">
            <div class="flex flex-row h-full w-full overflow-x-hidden">
                <div class="flex flex-col py-8 px-6 mt-6 rounded-xl w-64 bg-white flex-shrink-0">
                    <div class="flex flex-row items-center justify-center h-12 w-full">
                        <div class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-2 font-bold text-2xl">Chat Admin</div>
                    </div>
                    <div class="flex flex-col mt-8">
                        <div class="flex flex-row items-center justify-between text-xs">
                            <span class="font-bold">Active Conversations</span>
                            <span class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full">1</span>
                        </div>
                        <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48 overflow-y-auto">
                            <button class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
                                <div class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full">
                                    A
                                </div>
                                <div class="ml-2 text-sm font-semibold">Admin Toko</div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col flex-auto h-full p-6">
                    <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                        <div class="flex flex-col h-full overflow-x-auto mb-4">
                            <div class="flex flex-col h-full">
                                <div class="grid grid-cols-12 gap-y-2">
                                    @if ($chats == null)
                                        <h2>Belum ada obrolan</h2>
                                    @else
                                        @foreach ($chats as $item)
                                            @if ($item->chat_user != null)
                                                <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                                    <div class="flex flex-row items-center">
                                                        <div
                                                            class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                            U
                                                        </div>
                                                        <div
                                                            class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                            <div>{{ $item->chat_user }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @foreach ($chats as $items2)
                                            @if ($items2->chat_admin != null)
                                                <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                                    <div class="flex items-center justify-start flex-row-reverse">
                                                        <div
                                                            class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                            A
                                                        </div>
                                                        <div
                                                            class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                            <div>{{ $item->chat_admin }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
                            <div>
                                <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('chat.userMsg') }}" class="flex flex-grow"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="flex-grow ml-4 mt-3">
                                    <div class="relative w-full">
                                        <input type="text" name="userMsg"
                                            class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" />
                                    </div>
                                </div>
                                <div class="ml-4 mt-4">
                                    <button
                                        class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                                        <span>Send</span>
                                        <span class="ml-2">
                                            <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
