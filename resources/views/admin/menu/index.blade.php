@extends('layouts.admin.app')

@section('title', 'Data Menu')

@section('content')
  {{-- Judul halaman (referensi: inventory.html template InApp) --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Data Menu</h1>
          <p class="mb-0">List seluruh menu Geprekku</p>
        </div>
        <div>
          <a href="{{ route('menu.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Menu</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Flash data (success/error) --}}
  @include('layouts.admin.alert')

  <div class="row">
    <div class="col-12">
      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>No</th>
              <th>Nama Menu</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Level Pedas</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($dataMenu as $item)
              <tr class="align-middle">
                <td>{{ $loop->iteration }}</td>
                <td>
                  <span class="fw-semibold">{{ $item->nama_menu }}</span>
                  <small class="d-block text-secondary">{{ Str::limit($item->deskripsi, 40) }}</small>
                </td>
                <td>{{ $item->kategori }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>
                  @for ($i = 1; $i <= $item->level_pedas; $i++)
                    <i class="ti ti-flame text-danger"></i>
                  @endfor
                  <small class="text-secondary">({{ $item->level_pedas }})</small>
                </td>
                <td>
                  @if ($item->status == 'Tersedia')
                    <span class="badge bg-success-subtle text-success">Tersedia</span>
                  @else
                    <span class="badge bg-danger-subtle text-danger">Habis</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('menu.edit', $item->menu_id) }}" class="btn btn-info btn-sm text-white">
                    <i class="ti ti-edit"></i> Edit
                  </a>
                  <form action="{{ route('menu.destroy', $item->menu_id) }}" method="POST" style="display:inline"
                        onsubmit="return confirm('Yakin ingin menghapus menu {{ $item->nama_menu }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="ti ti-trash"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center text-secondary py-4">Belum ada data menu.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
