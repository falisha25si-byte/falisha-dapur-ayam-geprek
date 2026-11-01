@extends('layouts.admin.app')

@section('title', 'Tambah Ulasan')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
          <h1 class="fs-3 mb-1">Tambah Ulasan</h1>
          <p class="mb-0">Form untuk menambahkan ulasan pelanggan</p>
        </div>
        <div>
          <a href="{{ route('ulasan.index') }}" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body p-4">

          @include('layouts.admin.alert')

          <form action="{{ route('ulasan.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select id="pelanggan_id" name="pelanggan_id" class="form-select @error('pelanggan_id') is-invalid @enderror">
                  <option value="">-- Pilih Pelanggan --</option>
                  @foreach ($dataPelanggan as $p)
                    <option value="{{ $p->pelanggan_id }}" {{ old('pelanggan_id') == $p->pelanggan_id ? 'selected' : '' }}>{{ $p->nama_pelanggan }}</option>
                  @endforeach
                </select>
                @error('pelanggan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="menu_id" class="form-label">Menu</label>
                <select id="menu_id" name="menu_id" class="form-select @error('menu_id') is-invalid @enderror">
                  <option value="">-- Pilih Menu --</option>
                  @foreach ($dataMenu as $m)
                    <option value="{{ $m->menu_id }}" {{ old('menu_id') == $m->menu_id ? 'selected' : '' }}>{{ $m->nama_menu }}</option>
                  @endforeach
                </select>
                @error('menu_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select id="rating" name="rating" class="form-select @error('rating') is-invalid @enderror">
                  <option value="">-- Pilih Rating --</option>
                  @for ($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ str_repeat('★', $i) }} ({{ $i }})</option>
                  @endfor
                </select>
                @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="tanggal_ulasan" class="form-label">Tanggal Ulasan</label>
                <input type="date" id="tanggal_ulasan" name="tanggal_ulasan" value="{{ old('tanggal_ulasan', date('Y-m-d')) }}"
                  class="form-control @error('tanggal_ulasan') is-invalid @enderror">
                @error('tanggal_ulasan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-4 mb-3 d-flex align-items-end">
                <div class="form-check form-switch mb-2">
                  <input type="checkbox" id="tampil" name="tampil" value="1" class="form-check-input"
                    {{ (old('_token') ? old('tampil') : true) ? 'checked' : '' }}>
                  <label for="tampil" class="form-check-label">Tampilkan di halaman Guest</label>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="komentar" class="form-label">Komentar</label>
              <textarea id="komentar" name="komentar" rows="4" class="form-control @error('komentar') is-invalid @enderror"
                placeholder="Sambalnya mantap, ayamnya crispy...">{{ old('komentar') }}</textarea>
              @error('komentar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('ulasan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
