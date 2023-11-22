<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->

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

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> </a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i></li>
            </ul>

        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="/">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

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
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class=""><a href="/">Home</a></li>
                            <li><a href="/shop">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="/wishlist"><i class="fa fa-heart"></i> </a></li>
                            <li><a href="/cart"><i class="fa fa-shopping-bag"></i></li>
                            <li><a href="/riwayat-pesanan"><i class="fa-solid fa-shoe-prints"></i></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="/"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i
                                    class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}
            </div>
        </div>
    </div>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('templates/customers/js/app.js') }}"></script>
    
    <script src="{{ asset('templates/customers/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('templates/customers/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templates/customers/js/jquery.nice-select.min.js') }}"></script>
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
