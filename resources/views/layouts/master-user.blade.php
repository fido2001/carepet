
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>@yield('title', 'Care Pet')</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('../assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/fontawesome/css/all.min.css') }}">

<!-- CSS Libraries -->
@yield('css')

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('../assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/css/components.css') }}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <a href="/petowner" class="navbar-brand sidebar-gone-hide">Care Pet</a>
            <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
            <div class="nav-collapse">
                <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
            </div>
            <form class="form-inline ml-auto">
                {{-- <ul class="navbar-nav">
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
                <div class="search-element">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    <div class="search-backdrop"></div>
                    <div class="search-result">
                        <div class="search-header">
                            Histories
                        </div>
                        <div class="search-item">
                            <a href="#">How to hack NASA using CSS</a>
                            <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="search-item">
                            <a href="#">Kodinger.com</a>
                            <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="search-item">
                            <a href="#">#Stisla</a>
                            <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="search-header">
                            Result
                        </div>
                        <div class="search-item">
                            <a href="#">
                            <img class="mr-3 rounded" width="30" src="assets/img/products/product-3-50.png" alt="product">
                            oPhone S9 Limited Edition
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                            <img class="mr-3 rounded" width="30" src="assets/img/products/product-2-50.png" alt="product">
                            Drone X2 New Gen-7
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                            <img class="mr-3 rounded" width="30" src="assets/img/products/product-1-50.png" alt="product">
                            Headphone Blitz
                            </a>
                        </div>
                        <div class="search-header">
                            Projects
                        </div>
                        <div class="search-item">
                            <a href="#">
                            <div class="search-icon bg-danger text-white mr-3">
                                <i class="fas fa-code"></i>
                            </div>
                            Stisla Admin Template
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                            <div class="search-icon bg-primary text-white mr-3">
                                <i class="fas fa-laptop"></i>
                            </div>
                            Create a new Homepage Design
                            </a>
                        </div>
                    </div>
                </div> --}}
            </form>
            <ul class="navbar-nav navbar-right">
                {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Messages
                            <div class="float-right">
                            <a href="#">Mark All As Read</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-message">
                            <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-avatar">
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                                <div class="is-online"></div>
                            </div>
                            <div class="dropdown-item-desc">
                                <b>Kusnaedi</b>
                                <p>Hello, Bro!</p>
                                <div class="time">10 Hours Ago</div>
                            </div>
                            </a>
                            <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-avatar">
                                <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
                            </div>
                            <div class="dropdown-item-desc">
                                <b>Dedik Sugiharto</b>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                <div class="time">12 Hours Ago</div>
                            </div>
                            </a>
                            <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-avatar">
                                <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
                                <div class="is-online"></div>
                            </div>
                            <div class="dropdown-item-desc">
                                <b>Agung Ardiansyah</b>
                                <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <div class="time">12 Hours Ago</div>
                            </div>
                            </a>
                            <a href="#" class="dropdown-item">
                            <div class="dropdown-item-avatar">
                                <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
                            </div>
                            <div class="dropdown-item-desc">
                                <b>Ardian Rahardiansyah</b>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                                <div class="time">16 Hours Ago</div>
                            </div>
                            </a>
                            <a href="#" class="dropdown-item">
                            <div class="dropdown-item-avatar">
                                <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
                            </div>
                            <div class="dropdown-item-desc">
                                <b>Alfa Zulkarnain</b>
                                <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                <div class="time">Yesterday</div>
                            </div>
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li> --}}
                {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Notifications
                        <div class="float-right">
                        <a href="#">Mark All As Read</a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon bg-primary text-white">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Template update is available now!
                            <div class="time text-primary">2 Min Ago</div>
                        </div>
                        </a>
                        <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                            <div class="time">10 Hours Ago</div>
                        </div>
                        </a>
                        <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-success text-white">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                            <div class="time">12 Hours Ago</div>
                        </div>
                        </a>
                        <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-danger text-white">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Low disk space. Let's clean it!
                            <div class="time">17 Hours Ago</div>
                        </div>
                        </a>
                        <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Welcome to Stisla template!
                            <div class="time">Yesterday</div>
                        </div>
                        </a>
                    </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li> --}}
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ asset('../assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Logged in 5 min ago</div>
                    <a href="/petowner/editProfile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profil
                    </a>
                    {{-- <a href="features-activities.html" class="dropdown-item has-icon">
                        <i class="fas fa-bolt"></i> Activities
                    </a>
                    <a href="features-settings.html" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> Settings
                    </a> --}}
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item has-icon text-danger" data-toggle="modal" data-target="#exampleModalOut">
                        <i class="fas fa-sign-out-alt"></i>Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </div>
                </li>
            </ul>
        </nav>

        <nav class="navbar navbar-secondary navbar-expand-lg">
            <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item @if(Request::segment(1)=="petowner" && Request::segment(2)=="") active @endif">
                    <a href="{{ route('petowner.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item @if(Request::segment(1)=="petowner" && Request::segment(2)=="showPetshop") active @endif">
                    <a href="{{ route('show.petshop') }}" class="nav-link"><i class="fas fa-store"></i><span>Daftar Pet Shop</span></a>
                </li>
                <li class="nav-item @if(Request::segment(1)=="petowner" && Request::segment(2)=="produk") active @endif">
                    <a href="{{ route('index.produk.petowner') }}" class="nav-link"><i class="fas fa-bone"></i><span>Medicine and Food</span></a>
                </li>
                <li class="nav-item @if(Request::segment(1)=="petowner" && Request::segment(2)=="paket") active @endif">
                    <a href="{{ route('index.paket.petowner') }}" class="nav-link"><i class="fas fa-tag"></i><span>Service Packages</span></a>
                </li>
                <li class="nav-item @if(Request::segment(1)=="petowner" && Request::segment(2)=="article") active @endif">
                    <a href="{{ route('index.article.petowner') }}" class="nav-link"><i class="fas fa-newspaper"></i><span>Artikel</span></a>
                </li>
                <li class="nav-item @if(Request::segment(1)=="petowner" && Request::segment(2)=="consultation") active @endif">
                    <a href="{{ route('index.consultation.petowner') }}" class="nav-link"><i class="far fa-comment"></i><span>Konsultasi</span></a>
                </li>
                <li class="nav-item dropdown @if(Request::segment(1)=="petowner" && Request::segment(2)=="historyMedicine") active @elseif (Request::segment(1)=="petowner" && Request::segment(2)=="historyPackages") active @endif">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i><span>Order History</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item @if(Request::segment(1)=="petowner" && Request::segment(2)=="historyMedicine") active @endif">
                        <a href="/petowner/historyMedicine" class="nav-link">Medicine and Food</a>
                    </li>
                    <li class="nav-item @if(Request::segment(1)=="petowner" && Request::segment(2)=="historyPackages") active @endif">
                        <a href="/petowner/historyPackages" class="nav-link">Service Packages</a>
                    </li>
                    {{-- <li class="nav-item"><a href="#" class="nav-link">Not Dropdown Link</a></li>
                    <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Hover Me</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                            <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Link 2</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                            </ul>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">Link 3</a></li>
                        </ul>
                    </li> --}}
                </ul>
                </li>
            </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('header')</h1>
                </div>

                <div class="section-body">
                    @yield('content')
                </div>
            </section>
            <div class="modal fade" id="exampleModalOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin Keluar ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <div class="d-flex">
                                    <button class="btn btn-danger mr-3" type="submit">Iya</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                TRPL B - Kelompok G<div class="bullet"></div>CARE PET
            </div>
            <div class="footer-right">
            
            </div>
        </footer>
        </div>
    </div>

<!-- General JS Scripts -->
<script src="{{ asset('../assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('../assets/modules/popper.js') }}"></script>
<script src="{{ asset('../assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('../assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('../assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('../assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('../assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
@stack('page-scripts')

<!-- Page Specific JS File -->
@stack('page-spesific-scripts')

<!-- Template JS File -->
<script src="{{ asset('../assets/js/scripts.js') }}"></script>
<script src="{{ asset('../assets/js/custom.js') }}"></script>

@stack('after-scripts')

</body>
</html>