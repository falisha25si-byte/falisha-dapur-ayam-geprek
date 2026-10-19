<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>@yield('title', 'Dashboard') - Admin Geprekku</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- CSS & favicon --}}
  @include('layouts.admin.css')
</head>

<body>
  <div id="overlay" class="overlay"></div>

  {{-- TOPBAR --}}
  @include('layouts.admin.header')

  {{-- SIDEBAR --}}
  @include('layouts.admin.sidebar')

  {{-- MAIN CONTENT: isi tiap halaman masuk di sini --}}
  <main id="content" class="content py-10">
    <div class="container-fluid">

      @yield('content')

      {{-- FOOTER --}}
      @include('layouts.admin.footer')
    </div>
  </main>

  {{-- JS --}}
  @include('layouts.admin.js')
</body>

</html>
