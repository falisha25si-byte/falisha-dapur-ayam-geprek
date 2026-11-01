@extends('layouts.admin.app')

@section('title', 'Data Promo')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Data Promo</h1>
          <p class="mb-0">Promo diskon untuk menu Geprekku <span class="badge bg-warning-subtle text-warning">Query Builder</span></p>
        </div>
        <div>
          <a href="{{ route('promo.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Promo</a>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.admin.alert')

  {{-- Pencarian & filter (referensi: search bar inventory.html) --}}
  <form method="GET" action="{{ route('promo.index') }}" class="d-flex gap-2 mb-3 flex-wrap">
    <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" style="max-width: 280px;"
      placeholder="Cari judul promo atau menu...">
    <select name="status" class="form-select" style="max-width: 160px;">
      <option value="">Semua status</option>
      <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
      <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>
    <button type="submit" class="btn btn-outline-secondary"><i class="ti ti-filter"></i> Filter</button>
    @if (request('cari') || request('status'))
      <a href="{{ route('promo.index') }}" class="btn btn-light">Reset</a>
    @endif
  </form>

  <div class="row">
    <div class="col-12">
      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>No</th>
              <th>Judul Promo</th>
              <th>Menu</th>
              <th>Diskon</th>
              <th>Harga Normal</th>
              <th>Harga Promo</th>
              <th>Periode</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($dataPromo as $item)
              <tr class="align-middle">
                <td>{{ $dataPromo->firstItem() + $loop->index }}</td>
                <td class="fw-semibold">{{ $item->judul_promo }}</td>
                {{-- nama_menu & harga berasal dari leftJoin ke tabel menu --}}
                <td>{{ $item->nama_menu ?? '-' }}</td>
                <td><span class="badge bg-danger-subtle text-danger">{{ $item->diskon_persen }}%</span></td>
                <td class="text-secondary text-decoration-line-through">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="fw-semibold text-primary">Rp {{ number_format($item->harga_promo, 0, ',', '.') }}</td>
                <td>
                  {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} &ndash;
                  {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') : 'tanpa batas' }}
                </td>
                <td>
                  @if ($item->status == 'Aktif')
                    <span class="badge bg-success-subtle text-success">Aktif</span>
                  @else
                    <span class="badge bg-secondary-subtle text-secondary">Nonaktif</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('promo.edit', $item->promo_id) }}" class="btn btn-info btn-sm text-white">
                    <i class="ti ti-edit"></i> Edit
                  </a>
                  <form action="{{ route('promo.destroy', $item->promo_id) }}" method="POST" style="display:inline"
                        onsubmit="return confirm('Yakin ingin menghapus promo {{ $item->judul_promo }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i> Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center text-secondary py-4">Belum ada data promo.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $dataPromo->links() }}</div>
    </div>
  </div>
@endsection
