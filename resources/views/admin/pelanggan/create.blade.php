@extends('layouts.admin')

@section('title', 'Tambah Pelanggan')

@section('content')
  {{-- Judul halaman (referensi: create-product.html template InApp) --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
          <h1 class="fs-3 mb-1">Tambah Pelanggan</h1>
          <p class="mb-0">Form untuk menambahkan pelanggan baru</p>
        </div>
        <div>
          <a href="{{ route('pelanggan.index') }}" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body p-4">

          {{-- Error validasi --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}"
                  class="form-control @error('nama_pelanggan') is-invalid @enderror" placeholder="Nama lengkap">
                @error('nama_pelanggan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                  <option value="">-- Pilih --</option>
                  <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                  class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890">
                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                  class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                  class="form-control @error('tanggal_lahir') is-invalid @enderror">
                @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea id="alamat" name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"
                placeholder="Alamat pengantaran">{{ old('alamat') }}</textarea>
              @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
