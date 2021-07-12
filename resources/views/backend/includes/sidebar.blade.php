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
      <li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-fire"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="{{ Request::is('admin/user*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
          <i class="far fa-user"></i> <span>User</span>
        </a>
      </li>
      <li class="dropdown 
        {{ Request::is('admin/penduduk*') ? 'active' : '' }}
        {{ Request::is('admin/kartu-keluarga*') ? 'active' : '' }}
      ">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Penduduk</span></a>
        <ul class="dropdown-menu" style="">
          <li class="{{ Request::is('admin/kartu-keluarga*') ? 'active' : '' }}">
            <a class=" nav-link" href="{{ route('admin.kartu-keluarga') }}">
              Kartu Keluarga
            </a>
          </li>
          <li class="{{ Request::is('admin/penduduk*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.penduduk.index') }}">Data
              Penduduk
            </a>
          </li>
        </ul>
      </li>
      <li class="{{ Request::is('admin/kelurahan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.kelurahan.index') }}">
          <i class="fa fa-user-friends"></i><span>Kelurahan</span>
        </a>
      </li>
    </ul>
  </aside>
</div>
