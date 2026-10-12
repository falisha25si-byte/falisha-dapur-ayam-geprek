<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>@yield('title', 'Dashboard') - Admin Geprekku</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon (logo Geprekku) -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-admin/images/icon-geprekku-32.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('assets-admin/images/icon-geprekku-256.png') }}">

  <!-- CSS template InApp (hasil build, tema admin Geprekku) -->
  <link rel="stylesheet" href="{{ asset('assets-admin/css/main.css') }}">
</head>

<body>
  <div id="overlay" class="overlay"></div>

  <!-- TOPBAR -->
  <nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3">
    <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm">
      <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>

    <!-- MOBILE -->
    <button id="mobileBtn" class="btn btn-light btn-icon btn-sm d-lg-none me-2">
      <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>

    <div>
      <ul class="list-unstyled d-flex align-items-center mb-0 gap-1">
        <li>
          <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-primary">
            <i class="ti ti-world"></i> Lihat Website
          </a>
        </li>
        <li class="ms-3 dropdown">
          <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets-admin/images/avatar-1.jpg') }}" alt="" class="avatar avatar-sm rounded-circle" />
          </a>
          <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
            <div class="d-flex gap-3 align-items-center border-bottom px-3 py-3">
              <img src="{{ asset('assets-admin/images/avatar-1.jpg') }}" alt="" class="avatar avatar-md rounded-circle" />
              <div>
                <h4 class="mb-0 small">Admin Geprekku</h4>
                <p class="mb-0 small text-secondary">Administrator</p>
              </div>
            </div>
            <div class="p-3 d-flex flex-column gap-1 small lh-lg">
              <a href="{{ route('dashboard') }}">Dashboard</a>
              <a href="{{ route('home') }}">Halaman Guest</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>

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

      <li class="px-4 pt-4 pb-2"><small class="nav-text">Lainnya</small></li>
      <li>
        <a class="nav-link" href="{{ route('home') }}" target="_blank">
          <i class="ti ti-world"></i><span class="nav-text">Halaman Guest</span>
        </a>
      </li>
    </ul>
  </aside>

  <!-- MAIN CONTENT -->
  <main id="content" class="content py-10">
    <div class="container-fluid">

      @yield('content')

      <div class="row">
        <div class="col-12">
          <footer class="text-center py-2 mt-6 text-secondary">
            <p class="mb-0">Copyright &copy; {{ date('Y') }} Geprekku. Template InApp by
              <a href="https://codescandy.com/" target="_blank" class="text-primary">CodesCandy</a></p>
          </footer>
        </div>
      </div>
    </div>
  </main>

  <!-- JS template InApp (Bootstrap + sidebar) -->
  <script type="module" src="{{ asset('assets-admin/js/main.js') }}"></script>
</body>

</html>
