@extends('layouts.auth.app')

@section('title', 'Akses Ditolak')
@section('heading', '403 - Akses Ditolak')
@section('subheading', 'Halaman ini hanya untuk role Admin.')

@section('content')
  <div class="alert alert-warning text-center mb-3">
    <i class="ti ti-lock"></i>
    {{ $exception->getMessage() ?: 'Anda tidak memiliki izin.' }}
    @auth
      <div class="small mt-1">Login sebagai <strong>{{ Auth::user()->name }}</strong>
        (<span class="badge bg-primary">{{ Auth::user()->role }}</span>)</div>
    @endauth
  </div>
  @auth
    <form method="POST" action="{{ route('auth.logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline-primary w-100"><i class="ti ti-logout"></i> Logout & ganti akun</button>
    </form>
  @endauth
@endsection
