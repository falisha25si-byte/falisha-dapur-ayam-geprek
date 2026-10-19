@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')
  {{-- Judul halaman --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
          <h1 class="fs-3 mb-1">Tambah User</h1>
          <p class="mb-0">Form untuk menambahkan user baru</p>
        </div>
        <div>
          <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body p-4">

          {{-- Flash data & error validasi --}}
          @include('layouts.admin.alert')

          <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                  class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                  class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                {{-- password tidak di-repopulate (alasan keamanan) --}}
                <input type="password" id="password" name="password"
                  class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                  class="form-control" placeholder="Ulangi password">
              </div>
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
