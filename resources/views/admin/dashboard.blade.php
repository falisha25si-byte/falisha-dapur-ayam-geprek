@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
  <!-- Banner sambutan + logo -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 overflow-hidden welcome-card">
        <div class="card-body p-4 p-lg-5 d-flex flex-column flex-md-row align-items-center gap-4">
          <img src="{{ asset('assets-admin/images/logo-geprekku.png') }}" alt="Logo Geprekku" class="welcome-logo">
          <div>
            <p class="text-uppercase small fw-semibold mb-1 opacity-75">Panel Admin</p>
            <h1 class="fs-2 fw-bold mb-2">Selamat datang di Dashboard Geprekku</h1>
            <p class="mb-3 opacity-75">Kelola data menu, pelanggan, dan bahan baku warung ayam geprek dari sini.</p>
            <a href="{{ route('menu.create') }}" class="btn btn-light btn-sm me-2"><i class="ti ti-plus"></i> Tambah Menu</a>
            <a href="{{ route('bahan-baku.index') }}" class="btn btn-outline-light btn-sm"><i class="ti ti-box-seam"></i> Cek Stok</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Kartu statistik (dari database) -->
  <div class="row g-3 mb-3">
    <div class="col-lg-3 col-12">
      <div class="card p-4 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-2">
        <div class="d-flex gap-3">
          <div class="icon-shape icon-md bg-primary text-white rounded-2">
            <i class="ti ti-tools-kitchen-2 fs-4"></i>
          </div>
          <div>
            <h2 class="mb-3 fs-6">Total Menu</h2>
            <h3 class="fw-bold mb-0">{{ $jumlahMenu }}</h3>
            <a href="{{ route('menu.index') }}" class="text-primary mb-0 small">Lihat data</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-12">
      <div class="card p-4 bg-success bg-opacity-10 border border-success border-opacity-25 rounded-2">
        <div class="d-flex gap-3">
          <div class="icon-shape icon-md bg-success text-white rounded-2">
            <i class="ti ti-users fs-4"></i>
          </div>
          <div>
            <h2 class="mb-3 fs-6">Total Pelanggan</h2>
            <h3 class="fw-bold mb-0">{{ $jumlahPelanggan }}</h3>
            <a href="{{ route('pelanggan.index') }}" class="text-success mb-0 small">Lihat data</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-12">
      <div class="card p-4 bg-info bg-opacity-10 border border-info border-opacity-25 rounded-2">
        <div class="d-flex gap-3">
          <div class="icon-shape icon-md bg-info text-white rounded-2">
            <i class="ti ti-box-seam fs-4"></i>
          </div>
          <div>
            <h2 class="mb-3 fs-6">Jenis Bahan Baku</h2>
            <h3 class="fw-bold mb-0">{{ $jumlahBahan }}</h3>
            <a href="{{ route('bahan-baku.index') }}" class="text-info mb-0 small">Lihat data</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-12">
      <div class="card p-4 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-2">
        <div class="d-flex gap-3">
          <div class="icon-shape icon-md bg-warning text-white rounded-2">
            <i class="ti ti-alert-triangle fs-4"></i>
          </div>
          <div>
            <h2 class="mb-3 fs-6">Stok Menipis</h2>
            <h3 class="fw-bold mb-0">{{ $stokMenipis->count() }}</h3>
            <p class="text-warning mb-0 small">stok &le; 5</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik bawaan template -->
  <div class="row g-3 mb-3">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent px-4 py-3">
          <h3 class="h5 mb-0">Penjualan vs Pembelian <small class="text-secondary fs-6">(contoh grafik template)</small></h3>
        </div>
        <div class="card-body p-4">
          <div id="salesPurchaseChart"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Data terbaru dari database -->
  <div class="row g-3">
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
          <h4 class="mb-0 h5">Menu Terbaru</h4>
          <a href="{{ route('menu.index') }}" class="small text-primary text-decoration-underline">Lihat Semua</a>
        </div>
        <ul class="list-group list-group-flush">
          @forelse ($menuTerbaru as $item)
            <li class="list-group-item d-flex align-items-center gap-3">
              <div class="icon-shape icon-md bg-primary bg-opacity-10 text-primary rounded-2"><i class="ti ti-flame"></i></div>
              <div class="flex-grow-1">
                <p class="mb-1">{{ $item->nama_menu }}</p>
                <small class="text-muted">{{ $item->kategori }} &bull; Rp {{ number_format($item->harga, 0, ',', '.') }}</small>
              </div>
            </li>
          @empty
            <li class="list-group-item text-muted">Belum ada data menu.</li>
          @endforelse
        </ul>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
          <h4 class="mb-0 h5">Stok Bahan Menipis</h4>
          <a href="{{ route('bahan-baku.index') }}" class="small text-primary text-decoration-underline">Lihat Semua</a>
        </div>
        <ul class="list-group list-group-flush">
          @forelse ($stokMenipis as $item)
            <li class="list-group-item d-flex align-items-center gap-3">
              <div class="flex-grow-1">
                <p class="mb-1">{{ $item->nama_bahan }}</p>
                <small class="text-muted">{{ $item->supplier ?? '-' }}</small>
              </div>
              <div class="text-center">
                <span class="fw-semibold text-danger">{{ $item->stok }}</span>
                <small class="text-muted d-block">{{ $item->satuan }}</small>
              </div>
            </li>
          @empty
            <li class="list-group-item text-muted">Semua stok aman.</li>
          @endforelse
        </ul>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
          <h4 class="mb-0 h5">Pelanggan Baru</h4>
          <a href="{{ route('pelanggan.index') }}" class="small text-primary text-decoration-underline">Lihat Semua</a>
        </div>
        <ul class="list-group list-group-flush">
          @forelse ($pelangganBaru as $item)
            <li class="list-group-item d-flex align-items-center gap-3">
              <div class="icon-shape icon-md bg-success bg-opacity-10 text-success rounded-circle"><i class="ti ti-user"></i></div>
              <div class="flex-grow-1">
                <p class="mb-1">{{ $item->nama_pelanggan }}</p>
                <small class="text-muted">{{ $item->no_hp }}</small>
              </div>
            </li>
          @empty
            <li class="list-group-item text-muted">Belum ada data pelanggan.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
@endsection
