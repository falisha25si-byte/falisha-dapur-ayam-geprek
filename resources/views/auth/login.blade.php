@extends('layouts.auth.app')

@section('title', 'Login')
@section('heading', 'Masuk ke Geprekku')
@section('subheading', 'Login sebagai Admin atau Pelanggan')

@section('content')
  <form method="POST" action="{{ route('auth.login') }}">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}"
        class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" autocomplete="email" autofocus>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label d-flex justify-content-between">
        <span>Password</span>
        <a href="{{ route('password.request') }}" class="small link-primary">Lupa password?</a>
      </label>
      <input id="password" type="password" name="password"
        class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="current-password">
    </div>
    <div class="form-check mb-3">
      <input id="remember" class="form-check-input" type="checkbox" name="remember" value="1">
      <label class="form-check-label small" for="remember">Ingat saya</label>
    </div>
    <button class="btn btn-primary w-100" type="submit"><i class="ti ti-login-2"></i> Login</button>
  </form>

  <div class="text-center mt-3 small text-muted">
    Belum punya akun? <a href="{{ route('register') }}" class="link-primary">Daftar sebagai Pelanggan</a>
  </div>
@endsection
