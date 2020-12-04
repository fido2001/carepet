<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Care Pet</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">CP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="@if(Request::segment(1)=="petshop" && Request::segment(2)=="") active @endif">
                <a href="{{ route('petshop.index') }}" class=""><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Fitur</li>
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> --}}
            <li class="@if(Request::segment(1)=="petshop" && Request::segment(2)=="produk") active @endif"><a class="nav-link" href="{{ route('index.produk.petshop') }}"><i class="far fa-square"></i> <span>Medicine and Food</span></a></li>
            <li class="@if(Request::segment(1)=="petshop" && Request::segment(2)=="paket") active @endif"><a class="nav-link" href="{{ route('index.paket.petshop') }}"><i class="far fa-square"></i> <span>Service Packages</span></a></li>
            <li class="@if(Request::segment(1)=="petshop" && Request::segment(2)=="article") active @endif"><a class="nav-link" href="{{ route('index.article.petshop') }}"><i class="far fa-square"></i> <span>Artikel</span></a></li>
            <li class="@if(Request::segment(1)=="petshop" && Request::segment(2)=="consultation") active @endif"><a class="nav-link" href="{{ route('index.consultation.petshop') }}"><i class="far fa-square"></i> <span>Konsultasi</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Order History</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('history.paket.petshop') }}">Service Packages</a></li> 
                    <li><a href="{{ route('history.produk.petshop') }}">Medicine and Food</a></li> 
                </ul>
            </li>
        </ul>      
    </aside>
</div>