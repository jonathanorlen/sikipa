<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Sikipa</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{Request::is('admin/dashboard*')?'active':''}}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{Request::is('admin/user*')?'active':''}}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="far fa-user"></i> <span>User</span>
                </a>
            </li>
            <li class="{{Request::is('admin/penduduk*')?'active':''}}">
                <a class="nav-link" href="{{ route('penduduk.index') }}">
                    <i class="fa fa-user-friends"></i> <span>Penduduk</span>
                </a>
            </li>
        </ul>
    </aside>
</div>