<!DOCTYPE html>
<html lang="id">

<head>
  {{-- PartialView: meta + CSS --}}
  @include('layouts.guest.css')
</head>

<body>
  {{-- PartialView: topbar + navbar --}}
  @include('layouts.guest.header')

  {{-- ISI HALAMAN: tiap halaman guest mengisi section 'content' --}}
  @yield('content')

  {{-- PartialView: footer --}}
  @include('layouts.guest.footer')

  {{-- PartialView: JavaScript --}}
  @include('layouts.guest.js')
</body>

</html>
