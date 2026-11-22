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
      @if (Auth::check())
        {{-- nama & role user yang sedang login --}}
        <li class="ms-3 d-none d-md-block text-end lh-sm">
          <div class="fw-semibold small">{{ Auth::user()->name }}</div>
          <span class="badge bg-primary-subtle text-primary">{{ Auth::user()->role }}</span>
        </li>
        <li class="ms-2 dropdown">
          <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets-admin/images/avatar-1.jpg') }}" alt="" class="avatar avatar-sm rounded-circle" />
          </a>
          <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 230px;">
            <div class="d-flex gap-3 align-items-center border-bottom px-3 py-3">
              <img src="{{ asset('assets-admin/images/avatar-1.jpg') }}" alt="" class="avatar avatar-md rounded-circle" />
              <div>
                <h4 class="mb-0 small">{{ Auth::user()->name }}</h4>
                <p class="mb-0 small text-secondary">{{ Auth::user()->email }}</p>
                <span class="badge bg-primary">{{ Auth::user()->role }}</span>
              </div>
            </div>
            <div class="p-3 d-flex flex-column gap-1 small lh-lg">
              <span class="text-secondary"><i class="ti ti-clock"></i> Login terakhir: {{ session('last_login') ?? '-' }}</span>
              <a href="{{ route('dashboard') }}">Dashboard</a>
              <a href="{{ route('home') }}">Halaman Guest</a>
              {{-- logout wajib POST + CSRF --}}
              <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 text-danger small"><i class="ti ti-logout"></i> Logout</button>
              </form>
            </div>
          </div>
        </li>
      @else
        <li class="ms-3"><a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a></li>
      @endif
    </ul>
  </div>
</nav>
