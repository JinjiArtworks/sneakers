<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sneakers">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sneakers</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->

    <link rel="stylesheet" href="{{ asset('templates/customers/css/backend.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('templates/customers/css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                @if (Auth::check())
                                    @if (Auth::user()->role_id == 3)
                                        <a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }} -
                                            {{ Auth::user()->role_id }} - @currency(Auth::user()->saldo)
                                            <div class="header__top__right__auth ml-4">
                                                <form
                                                    action="{{ route('users.switch-to-seller', ['id' => Auth::user()->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="switchToSeller btn btn-sm btn-primary">Switch
                                                        To Seller</button>
                                                </form>
                                            </div>
                                            <button type="button" class="btn btn-sm ml-4 btn-primary"
                                                style="background-color: green" data-toggle="modal"
                                                data-target="#topUpModal" data-whatever="@mdo">Top Up Saldo</button>
                                        </a>
                                    @elseif (Auth::user()->role_id == '2')
                                        <a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }} -
                                            {{ Auth::user()->role_id }} - @currency(Auth::user()->saldo)
                                            <div class="header__top__right__auth ml-4">
                                                <form
                                                    action="{{ route('users.switch-to-buyer', ['id' => Auth::user()->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="switchToBuyer btn btn-sm btn-primary">Switch
                                                        To Buyers</button>
                                                </form>
                                            </div>
                                        </a>
                                        <a href="/seller-dashboard/{{ Auth::user()->id }}">Kunjungi Toko Anda </a>
                                    @else
                                        <a href="/admin-dashboard">Lihat Toko</a>
                                    @endif
                                @endif
                            </div>
                            {{-- Untuk bagian logoutnya --}}
                            @if (Auth::check())
                                <div class="header__top__right__auth">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="confirmLogout btn btn-sm btn-secondary" type="submit">Log
                                            out</button>
                                    </form>
                                </div>
                            @else
                                <div class="header__top__right__auth">
                                    <a href="/login"><i class="fa fa-user"></i> Login |</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="/register"> Register</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-lg-9">
                    <nav class="header__menu">
                        <ul>
                            <li class=""><a href="/">Home</a></li>
                            <li><a href="/shop">Shop</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            {{-- <li><a href="/wishlist"><i class="fa fa-heart"></i> </a></li> --}}
                            <li><a href="/cart"><i class="fa fa-shopping-bag"></i></li>
                            <li><a href="/riwayat-pesanan"><i class="fa-solid fa-clock-rotate-left"></i></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    @yield('content')
    <div class="modal fade" id="topUpModal" tabindex="-1" role="dialog" aria-labelledby="topUpModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="topUpModalLabel">Top Up Saldo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/top-up-saldo" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nominal Saldo</label>
                            <input type="number" name="saldo" class="form-control" id="recipient-name">
                        </div>
                        <button type="submit" class="confirmSaldo btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('templates/customers/js/app.js') }}"></script>

    <script src="{{ asset('templates/customers/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('templates/customers/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('templates/customers/js/jquery.nice-select.min.js') }}"></script> --}}
    <script src="{{ asset('templates/customers/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('templates/customers/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('templates/customers/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('templates/customers/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('templates/customers/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="CLIENT-KEY"></script>
    <script src="https://kit.fontawesome.com/515aa46707.js" crossorigin="anonymous"></script>
    @yield('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.switchToSeller').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Switch to Seller?',
                    icon: 'info',
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
            $('.switchToBuyer').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Switch to Buyer?',
                    icon: 'info',
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
            $('.confirmSaldo').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Confirm Top Up?',
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
            $('.confirmLogout').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Confirm Log Out?',
                    icon: 'info',
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
        });
    </script>

</body>

</html>
