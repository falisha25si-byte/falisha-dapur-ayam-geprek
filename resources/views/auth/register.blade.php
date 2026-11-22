@extends('layouts.auth.app')

@section('title', 'Daftar')
@section('heading', 'Daftar Akun Pelanggan')
@section('subheading', 'Akun baru otomatis mendapat role Pelanggan')

@section('content')
  <form method="POST" action="{{ route('auth.register') }}">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nama lengkap</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}"
        class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap" autofocus>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}"
        class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      {{-- password tidak di-repopulate (alasan keamanan) --}}
      <input id="password" type="password" name="password"
        class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
    </div>
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Konfirmasi password</label>
      <input id="password_confirmation" type="password" name="password_confirmation"
        class="form-control" placeholder="Ulangi password">
    </div>
    <button class="btn btn-primary w-100" type="submit"><i class="ti ti-user-plus"></i> Daftar</button>
  </form>

  <div class="text-center mt-3 small text-muted">
    Sudah punya akun? <a href="{{ route('login') }}" class="link-primary">Login</a>
  </div>
@endsection
