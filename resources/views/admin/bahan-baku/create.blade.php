@extends('layouts.admin')

@section('title', 'Tambah Bahan Baku')

@section('content')
  {{-- Judul halaman (referensi: create-product.html template InApp) --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
          <h1 class="fs-3 mb-1">Tambah Bahan Baku</h1>
          <p class="mb-0">Form untuk menambahkan bahan baku baru</p>
        </div>
        <div>
          <a href="{{ route('bahan-baku.index') }}" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Kembali</a>
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

          <form action="{{ route('bahan-baku.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nama_bahan" class="form-label">Nama Bahan</label>
                <input type="text" id="nama_bahan" name="nama_bahan" value="{{ old('nama_bahan') }}"
                  class="form-control @error('nama_bahan') is-invalid @enderror" placeholder="Contoh: Daging Ayam">
                @error('nama_bahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <input type="text" id="supplier" name="supplier" value="{{ old('supplier') }}"
                  class="form-control @error('supplier') is-invalid @enderror" placeholder="Nama toko / pemasok">
                @error('supplier') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" id="stok" name="stok" value="{{ old('stok') }}"
                  class="form-control @error('stok') is-invalid @enderror" placeholder="0">
                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <select id="satuan" name="satuan" class="form-select @error('satuan') is-invalid @enderror">
                  <option value="">-- Pilih --</option>
                  <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                  <option value="gram" {{ old('satuan') == 'gram' ? 'selected' : '' }}>gram</option>
                  <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>liter</option>
                  <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>pcs</option>
                  <option value="ikat" {{ old('satuan') == 'ikat' ? 'selected' : '' }}>ikat</option>
                </select>
                @error('satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="harga_satuan" class="form-label">Harga Satuan (Rp)</label>
                <input type="number" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan') }}"
                  class="form-control @error('harga_satuan') is-invalid @enderror" placeholder="35000">
                @error('harga_satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                  class="form-control @error('tanggal_masuk') is-invalid @enderror">
                @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('bahan-baku.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
