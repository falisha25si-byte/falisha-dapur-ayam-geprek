<!DOCTYPE html>
<html lang="id">

<head>
  {{-- PartialView: meta + CSS --}}
  @include('layouts.guest.css')
</head>

<body>
  {{-- PartialView: topbar + navbar --}}
  @include('layouts.guest.header')

  {{-- Flash pesan login/logout (halaman Contact sudah menampilkan alert sendiri) --}}
  @if (session('success') && !request()->routeIs('contact'))
    <div class="container mt-3">
      <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

  {{-- ISI HALAMAN: tiap halaman guest mengisi section 'content' --}}
  @yield('content')

  {{-- PartialView: footer --}}
  @include('layouts.guest.footer')

  {{-- PartialView: JavaScript --}}
  @include('layouts.guest.js')
</body>

</html>
