@extends('layouts.admin.app')

@section('title', 'Edit Menu')

@section('content')
  {{-- Judul halaman (referensi: create-product.html template InApp) --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
          <h1 class="fs-3 mb-1">Edit Menu</h1>
          <p class="mb-0">Form untuk mengubah data menu</p>
        </div>
        <div>
          <a href="{{ route('menu.index') }}" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Kembali</a>
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

          <form action="{{ route('menu.update', $dataMenu->menu_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $dataMenu->nama_menu) }}"
                  class="form-control @error('nama_menu') is-invalid @enderror" placeholder="Contoh: Ayam Geprek Original">
                @error('nama_menu') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                  <option value="">-- Pilih Kategori --</option>
                  <option value="Ayam Geprek" {{ old('kategori', $dataMenu->kategori) == 'Ayam Geprek' ? 'selected' : '' }}>Ayam Geprek</option>
                  <option value="Paket Hemat" {{ old('kategori', $dataMenu->kategori) == 'Paket Hemat' ? 'selected' : '' }}>Paket Hemat</option>
                  <option value="Minuman" {{ old('kategori', $dataMenu->kategori) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                  <option value="Tambahan" {{ old('kategori', $dataMenu->kategori) == 'Tambahan' ? 'selected' : '' }}>Tambahan</option>
                </select>
                @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" id="harga" name="harga" value="{{ old('harga', $dataMenu->harga) }}"
                  class="form-control @error('harga') is-invalid @enderror" placeholder="15000">
                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="level_pedas" class="form-label">Level Pedas (0-5)</label>
                <input type="number" id="level_pedas" name="level_pedas" value="{{ old('level_pedas', $dataMenu->level_pedas) }}"
                  class="form-control @error('level_pedas') is-invalid @enderror">
                @error('level_pedas') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                  <option value="Tersedia" {{ old('status', $dataMenu->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                  <option value="Habis" {{ old('status', $dataMenu->status) == 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror"
                placeholder="Ayam crispy digeprek dengan sambal bawang...">{{ old('deskripsi', $dataMenu->deskripsi) }}</textarea>
              @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-info text-white">Simpan Perubahan</button>
              <a href="{{ route('menu.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
