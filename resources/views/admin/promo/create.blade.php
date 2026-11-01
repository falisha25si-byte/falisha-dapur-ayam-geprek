@extends('layouts.admin.app')

@section('title', 'Tambah Promo')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
          <h1 class="fs-3 mb-1">Tambah Promo</h1>
          <p class="mb-0">Form untuk menambahkan promo menu</p>
        </div>
        <div>
          <a href="{{ route('promo.index') }}" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body p-4">

          @include('layouts.admin.alert')

          <form action="{{ route('promo.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="judul_promo" class="form-label">Judul Promo</label>
                <input type="text" id="judul_promo" name="judul_promo" value="{{ old('judul_promo') }}"
                  class="form-control @error('judul_promo') is-invalid @enderror" placeholder="Contoh: Promo Gajian">
                @error('judul_promo') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="menu_id" class="form-label">Menu</label>
                <select id="menu_id" name="menu_id" class="form-select @error('menu_id') is-invalid @enderror">
                  <option value="">-- Pilih Menu --</option>
                  @foreach ($dataMenu as $m)
                    <option value="{{ $m->menu_id }}" {{ old('menu_id') == $m->menu_id ? 'selected' : '' }}>
                      {{ $m->nama_menu }} (Rp {{ number_format($m->harga, 0, ',', '.') }})
                    </option>
                  @endforeach
                </select>
                @error('menu_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="diskon_persen" class="form-label">Diskon (%)</label>
                <input type="number" id="diskon_persen" name="diskon_persen" value="{{ old('diskon_persen') }}"
                  class="form-control @error('diskon_persen') is-invalid @enderror" placeholder="20">
                @error('diskon_persen') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}"
                  class="form-control @error('tanggal_mulai') is-invalid @enderror">
                @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai <small class="text-secondary">(opsional)</small></label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                  class="form-control @error('tanggal_selesai') is-invalid @enderror">
                @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                  <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                  <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
                placeholder="Berlaku untuk makan di tempat dan bawa pulang">{{ old('deskripsi') }}</textarea>
              @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('promo.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
