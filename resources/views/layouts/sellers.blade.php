@if (Auth::user()->role_id == 2)
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Webkit | Responsive Bootstrap 4 Admin Dashboard Template</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('templates/sellers/images/favicon.ico') }}" />
        <link rel="stylesheet" href="{{ asset('templates/sellers/css/backend-plugin.min.css') }}">
        <link rel="stylesheet" href="{{ asset('templates/sellers/css/backend.css?v=1.0.0') }}">
        <link rel="stylesheet"
            href="{{ asset('templates/sellers/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('templates/sellers/vendor/remixicon/fonts/remixicon.css') }}">

        <link rel="stylesheet"
            href="{{ asset('templates/sellers/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css') }}">
        <link rel="stylesheet"
            href="{{ asset('templates/sellers/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css') }}">
        <link rel="stylesheet"
            href="{{ asset('templates/sellers/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css') }}">
    </head>

    <body class="">
        <!-- loader Start -->
        <div id="loading">
            <div id="loading-center">
            </div>
        </div>
        <div class="wrapper">

            <div class="iq-sidebar  sidebar-default ">
                <div class="iq-sidebar-logo d-flex align-items-center">
                    <a href="../backend/index.html" class="header-logo">
                        <img src="../assets/images/logo.svg" alt="logo">
                        <h3 class="logo-title light-logo">Webkit</h3>
                    </a>
                    <div class="iq-menu-bt-sidebar ml-0">
                        <i class="las la-bars wrapper-menu"></i>
                    </div>
                </div>
                <div class="data-scrollbar" data-scroll="1">
                    <nav class="iq-sidebar-menu">
                        <ul id="iq-sidebar-toggle" class="iq-menu">
                            <li class="active">
                                <a href="../backend/index.html" class="svg-icon">
                                    <svg class="svg-icon" width="25" height="25"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    <span class="ml-4">Dashboards</span>
                                </a>
                            </li>
                            {{-- <li class="">
                                <a href="../backend/page-project.html" class="svg-icon">
                                    <svg class="svg-icon" width="25" height="25"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                        <path
                                            d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                        </path>
                                        <rect x="6" y="14" width="12" height="8"></rect>
                                    </svg>
                                    <span class="ml-4">Projects</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="../backend/page-task.html" class="svg-icon">
                                    <svg class="svg-icon" width="25" height="25"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                        </path>
                                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1">
                                        </rect>
                                    </svg>
                                    <span class="ml-4">Task</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="../backend/page-employee.html" class="svg-icon">
                                    <svg class="svg-icon" width="25" height="25"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ml-4">Employees</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="../backend/page-desk.html" class="svg-icon">
                                    <svg class="svg-icon" width="25" height="25"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                        </path>
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                    </svg>
                                    <span class="ml-4">Desk</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="../backend/page-calender.html" class="svg-icon">
                                    <svg class="svg-icon" width="25" height="25"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                            ry="2">
                                        </rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span class="ml-4">Calender</span>
                                </a>
                            </li> --}}
                        </ul>
                    </nav>
                    <div class="pt-5 pb-2"></div>
                </div>
            </div>
            <div class="iq-top-navbar">
                <div class="iq-navbar-custom">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                            <i class="ri-menu-line wrapper-menu"></i>
                            <a href="../backend/index.html" class="header-logo">
                                <h4 class="logo-title text-uppercase">Webkit</h4>

                            </a>
                        </div>
                        <div class="navbar-breadcrumb">
                            <h5>Dashboard</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-label="Toggle navigation">
                                <i class="ri-menu-3-line"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                    <li class="nav-item nav-icon search-content">
                                        <a href="#" class="search-toggle rounded" id="dropdownSearch"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-search-line"></i>
                                        </a>
                                        <div class="iq-search-bar iq-sub-dropdown dropdown-menu"
                                            aria-labelledby="dropdownSearch">
                                            <form action="#" class="searchbox p-2">
                                                <div class="form-group mb-0 position-relative">
                                                    <input type="text" class="text search-input font-size-12"
                                                        placeholder="type here to search...">
                                                    <a href="#" class="search-link"><i
                                                            class="las la-search"></i></a>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                    <li class="nav-item nav-icon nav-item-icon dropdown">
                                        <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-mail">
                                                <path
                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                </path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                            <span class="bg-primary"></span>
                                        </a>
                                        <div class="iq-sub-dropdown dropdown-menu"
                                            aria-labelledby="dropdownMenuButton2">
                                            <div class="card shadow-none m-0">
                                                <div class="card-body p-0 ">
                                                    <div class="cust-title p-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h5 class="mb-0">All Messages</h5>
                                                            <a class="badge badge-primary badge-card"
                                                                href="#">3</a>
                                                        </div>
                                                    </div>
                                                    <div class="px-3 pt-0 pb-0 sub-card">
                                                        <a href="#" class="iq-sub-card">
                                                            <div
                                                                class="media align-items-center cust-card py-3 border-bottom">
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small"
                                                                        src="../assets/images/user/01.jpg"
                                                                        alt="01">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Emma Watson</h6>
                                                                        <small class="text-dark"><b>12 : 47
                                                                                pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit
                                                                        amet</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="iq-sub-card">
                                                            <div
                                                                class="media align-items-center cust-card py-3 border-bottom">
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small"
                                                                        src="../assets/images/user/02.jpg"
                                                                        alt="02">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Ashlynn Franci</h6>
                                                                        <small class="text-dark"><b>11 : 30
                                                                                pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit
                                                                        amet</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="iq-sub-card">
                                                            <div class="media align-items-center cust-card py-3">
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small"
                                                                        src="../assets/images/user/03.jpg"
                                                                        alt="03">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Kianna Carder</h6>
                                                                        <small class="text-dark"><b>11 : 21
                                                                                pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit
                                                                        amet</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <a class="right-ic btn btn-primary btn-block position-relative p-2"
                                                        href="#" role="button">
                                                        View All
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item nav-icon nav-item-icon dropdown">
                                        <a href="#" class="search-toggle dropdown-toggle"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-bell">
                                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                            </svg>
                                            <span class="bg-primary "></span>
                                        </a>
                                        <div class="iq-sub-dropdown dropdown-menu"
                                            aria-labelledby="dropdownMenuButton">
                                            <div class="card shadow-none m-0">
                                                <div class="card-body p-0 ">
                                                    <div class="cust-title p-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h5 class="mb-0">Notifications</h5>
                                                            <a class="badge badge-primary badge-card"
                                                                href="#">3</a>
                                                        </div>
                                                    </div>
                                                    <div class="px-3 pt-0 pb-0 sub-card">
                                                        <a href="#" class="iq-sub-card">
                                                            <div
                                                                class="media align-items-center cust-card py-3 border-bottom">
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small"
                                                                        src="../assets/images/user/01.jpg"
                                                                        alt="01">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Emma Watson</h6>
                                                                        <small class="text-dark"><b>12 : 47
                                                                                pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit
                                                                        amet</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="iq-sub-card">
                                                            <div
                                                                class="media align-items-center cust-card py-3 border-bottom">
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small"
                                                                        src="../assets/images/user/02.jpg"
                                                                        alt="02">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Ashlynn Franci</h6>
                                                                        <small class="text-dark"><b>11 : 30
                                                                                pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit
                                                                        amet</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="iq-sub-card">
                                                            <div class="media align-items-center cust-card py-3">
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small"
                                                                        src="../assets/images/user/03.jpg"
                                                                        alt="03">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Kianna Carder</h6>
                                                                        <small class="text-dark"><b>11 : 21
                                                                                pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit
                                                                        amet</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <a class="right-ic btn btn-primary btn-block position-relative p-2"
                                                        href="#" role="button">
                                                        View All
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item nav-icon dropdown caption-content">
                                        <a href="#"
                                            class="search-toggle dropdown-toggle  d-flex align-items-center"
                                            id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <img src="{{ asset('templates/sellers/images/user/1.jpg') }}"
                                                class="img-fluid rounded-circle" alt="user">
                                            <div class="caption ml-3">
                                                <h6 class="mb-0 line-height">Savannah Nguyen<i
                                                        class="las la-angle-down ml-2"></i></h6>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right border-none"
                                            aria-labelledby="dropdownMenuButton">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <li class="dropdown-item d-flex svg-icon ">
                                                    <i class="fa-solid fa-right-from-bracket mt-1"
                                                        style="color: blue"></i>
                                                    <a class="confirmLogout" type="button">Logout</a>
                                                </li>
                                            </form>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            @yield('content')
            <footer class="iq-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="../backend/privacy-policy.html">Privacy
                                        Policy</a>
                                </li>
                                <li class="list-inline-item"><a href="../backend/terms-of-service.html">Terms of
                                        Use</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>©
                            </span> <a href="#" class="">Webkit</a>.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="{{ asset('templates/sellers/js/backend-bundle.min.js') }}"></script>
        <!-- Table Treeview JavaScript -->
        <script src="{{ asset('templates/sellers/js/table-treeview.js') }}"></script>
        <!-- Chart Custom JavaScript -->
        <script src="{{ asset('templates/sellers/js/customizer.js') }}"></script>
        <!-- Chart Custom JavaScript -->
        <script async src="{{ asset('templates/sellers/js/chart-custom.js') }}"></script>
        <!-- Chart Custom JavaScript -->
        <script async src="{{ asset('templates/sellers/js/slider.js') }}"></script>
        <!-- app JavaScript -->
        <script src="{{ asset('templates/sellers/js/app.js') }}"></script>
        <script src="{{ asset('templates/sellers/vendor/moment.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/515aa46707.js" crossorigin="anonymous"></script>
        <script>
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
        </script>
        @yield('script')
        <!-- Backend Bundle JavaScript -->
    </body>

    </html>
@else
    <p>Anda tidak dapat mengakses halaman ini</p>
@endif
