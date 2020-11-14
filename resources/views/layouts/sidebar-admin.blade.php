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
                <a href="{{ route('admin.index') }}" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            {{-- <li class="@if (Request::fullUrl() == 'http://127.0.0.1:8000/admin')
            active @endif"><a class="nav-link" href="/admin"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}
            <li class="@if (Request::segment(1) == 'admin' && Request::segment(2) == 'users-management')
            active @endif"><a class="nav-link" href="{{ route('show.users-management') }}"><i class="far fa-user"></i> <span>User Management</span></a></li>
            <li class="@if (Request::segment(1) == 'admin' && Request::segment(2) == 'produk')
            active @endif"><a class="nav-link" href="{{ route('index.produk.admin') }}"><i class="far fa-square"></i> <span>Data Produk</span></a></li>
            <li class="menu-header">Pages</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li><a href="auth-forgot-password.html">Forgot Password</a></li> 
                    <li><a href="auth-login.html">Login</a></li> 
                    <li><a href="auth-register.html">Register</a></li> 
                    <li><a href="auth-reset-password.html">Reset Password</a></li> 
                </ul>
            </li>
        </ul>      
    </aside>
</div>