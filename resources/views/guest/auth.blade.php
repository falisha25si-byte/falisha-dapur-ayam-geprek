@extends('layouts.guest.app')

@section('title', 'Login - Geprekku')

@section('content')
  <section id="login-section" style="padding: 80px 0; background: var(--cream);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5" data-aos="fade-up">

          <div class="text-center mb-4">
            <span class="slbl">Admin Area</span>
            <h2 class="stitle">Login <span>Admin</span></h2>
            <div class="sline"></div>
          </div>

          <div class="fcard">
            {{-- PartialView alert: pesan error "username/password salah" muncul di sini --}}
            @include('layouts.guest.alert')

            <form action="{{ route('auth.login') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="username" class="flbl">Username</label>
                <input type="text" id="username" name="username" class="fctrl"
                  placeholder="Masukkan username" value="{{ old('username') }}" autofocus />
              </div>

              <div class="mb-4">
                <label for="password" class="flbl">Password</label>
                <input type="password" id="password" name="password" class="fctrl"
                  placeholder="Masukkan password" />
              </div>

              <button type="submit" class="btn-red w-100 justify-content-center">
                <i class="fas fa-sign-in-alt"></i> Login
              </button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection
