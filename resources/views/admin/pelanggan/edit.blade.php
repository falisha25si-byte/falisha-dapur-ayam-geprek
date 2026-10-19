@extends('layouts.admin.app')

@section('title', 'Edit Pelanggan')

@section('content')
  {{-- Judul halaman (referensi: create-product.html template InApp) --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
          <h1 class="fs-3 mb-1">Edit Pelanggan</h1>
          <p class="mb-0">Form untuk mengubah data pelanggan</p>
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

          {{-- Flash data & error validasi --}}
          @include('layouts.admin.alert')

          <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $dataPelanggan->nama_pelanggan) }}"
                  class="form-control @error('nama_pelanggan') is-invalid @enderror" placeholder="Nama lengkap">
                @error('nama_pelanggan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                  <option value="">-- Pilih --</option>
                  <option value="Laki-laki" {{ old('jenis_kelamin', $dataPelanggan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ old('jenis_kelamin', $dataPelanggan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $dataPelanggan->no_hp) }}"
                  class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890">
                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" name="email" value="{{ old('email', $dataPelanggan->email) }}"
                  class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $dataPelanggan->tanggal_lahir) }}"
                  class="form-control @error('tanggal_lahir') is-invalid @enderror">
                @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea id="alamat" name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"
                placeholder="Alamat pengantaran">{{ old('alamat', $dataPelanggan->alamat) }}</textarea>
              @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-info text-white">Simpan Perubahan</button>
              <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
