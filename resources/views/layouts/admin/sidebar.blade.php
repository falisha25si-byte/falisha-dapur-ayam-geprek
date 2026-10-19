<!-- SIDEBAR -->
<aside id="sidebar" class="sidebar">
  <div class="logo-area">
    <a href="{{ route('dashboard') }}" class="d-inline-flex align-items-center text-white">
      <img src="{{ asset('assets-admin/images/icon-geprekku-64.png') }}" alt="Logo Geprekku" width="30">
      <span class="logo-text brand-name ms-2">Geprek<span>ku</span></span>
    </a>
  </div>
  <ul class="nav flex-column">
    <li class="px-4 py-2"><small class="nav-text">Main</small></li>
    <li>
      <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <i class="ti ti-home"></i><span class="nav-text">Dashboard</span>
      </a>
    </li>

    <li class="px-4 pt-4 pb-2"><small class="nav-text">Data Master</small></li>
    <li>
      <a class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ route('menu.index') }}">
        <i class="ti ti-tools-kitchen-2"></i><span class="nav-text">Menu</span>
      </a>
    </li>
    <li>
      <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">
        <i class="ti ti-users"></i><span class="nav-text">Pelanggan</span>
      </a>
    </li>
    <li>
      <a class="nav-link {{ request()->routeIs('bahan-baku.*') ? 'active' : '' }}" href="{{ route('bahan-baku.index') }}">
        <i class="ti ti-box-seam"></i><span class="nav-text">Bahan Baku</span>
      </a>
    </li>

    <li class="px-4 pt-4 pb-2"><small class="nav-text">Pengaturan</small></li>
    <li>
      <a class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}">
        <i class="ti ti-user-cog"></i><span class="nav-text">User</span>
      </a>
    </li>

    <li class="px-4 pt-4 pb-2"><small class="nav-text">Lainnya</small></li>
    <li>
      <a class="nav-link" href="{{ route('home') }}" target="_blank">
        <i class="ti ti-world"></i><span class="nav-text">Halaman Guest</span>
      </a>
    </li>
  </ul>
</aside>
