@extends('layouts.auth.app')

@section('title', 'Lupa Password')
@section('heading', 'Lupa Password')
@section('subheading', 'Masukkan email akun Anda lalu buat password baru')

@section('content')
  <form method="POST" action="{{ route('password.reset') }}">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email terdaftar</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}"
        class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" autofocus>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password baru</label>
      <input id="password" type="password" name="password"
        class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
    </div>
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Konfirmasi password baru</label>
      <input id="password_confirmation" type="password" name="password_confirmation"
        class="form-control" placeholder="Ulangi password baru">
    </div>
    <button class="btn btn-primary w-100" type="submit"><i class="ti ti-key"></i> Simpan Password Baru</button>
  </form>

  <div class="text-center mt-3 small text-muted">
    Ingat password? <a href="{{ route('login') }}" class="link-primary">Kembali ke Login</a>
  </div>
@endsection
