<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>@yield('title', 'Login') - Geprekku</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- CSS & favicon template InApp (sama dengan halaman admin) --}}
  @include('layouts.admin.css')
  <style>
    body { background: linear-gradient(135deg, #0E2A27 0%, #0F766E 100%); }
    .auth-logo { height: 90px; width: auto; }
  </style>
</head>

<body>
  {{-- Referensi: signin.html & signup.html template InApp --}}
  <div class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="card shadow border-0" style="max-width: 440px; width: 100%;">
      <div class="card-body p-5">
        <div class="text-center mb-3">
          <a href="{{ route('home') }}" class="d-inline-block mb-2">
            <img src="{{ asset('assets-admin/images/logo-geprekku.png') }}" alt="Logo Geprekku" class="auth-logo">
          </a>
          <h1 class="card-title mb-1 h5">@yield('heading')</h1>
          <p class="text-secondary small mb-4">@yield('subheading')</p>
        </div>

        {{-- Flash data (success/error) & error validasi --}}
        @include('layouts.admin.alert')

        @yield('content')

        <div class="text-center mt-4 small">
          <a href="{{ route('home') }}" class="link-secondary"><i class="ti ti-arrow-left"></i> Kembali ke beranda</a>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.admin.js')
</body>

</html>
