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
            <li class="@if(Request::segment(1)=="admin" && Request::segment(2)=="") active @endif">
                <a href="{{ route('admin.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            {{-- <li class="@if (Request::fullUrl() == 'http://127.0.0.1:8000/admin')
            active @endif"><a class="nav-link" href="/admin"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}
            <li class="@if (Request::segment(1) == 'admin' && Request::segment(2) == 'users-management')
            active @endif"><a class="nav-link" href="{{ route('show.users-management') }}"><i class="far fa-user"></i> <span>User Management</span></a></li>
            <li class="@if (Request::segment(1) == 'admin' && Request::segment(2) == 'produk')
            active @endif"><a class="nav-link" href="{{ route('index.produk.admin') }}"><i class="fas fa-bone"></i> <span>Medicine and Food</span></a></li>
            <li class="@if (Request::segment(1) == 'admin' && Request::segment(2) == 'paket')
            active @endif"><a class="nav-link" href="{{ route('index.paket.admin') }}"><i class="fas fa-tag"></i> <span>Service Packages</span></a></li>
            <li class="@if (Request::segment(1) == 'admin' && Request::segment(2) == 'article')
            active @endif"><a class="nav-link" href="/admin/article"><i class="far fa-newspaper"></i> <span>Artikel</span></a></li>
            <li class="@if (Request::segment(1) == 'admin' && Request::segment(2) == 'withdrawal')
            active @endif"><a class="nav-link" href="/admin/withdrawal"><i class="fas fa-wallet"></i> <span>Penarikan Saldo</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Order History</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('history.paket.admin') }}">Service Packages</a></li> 
                    <li><a href="{{ route('history.produk.admin') }}">Medicine and Food</a></li> 
                </ul>
            </li>
        </ul>      
    </aside>
</div>