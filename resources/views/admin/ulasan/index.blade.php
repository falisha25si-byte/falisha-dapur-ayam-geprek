@extends('layouts.admin.app')

@section('title', 'Data Ulasan')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Data Ulasan</h1>
          <p class="mb-0">Ulasan pelanggan untuk setiap menu <span class="badge bg-primary-subtle text-primary">Eloquent ORM</span></p>
        </div>
        <div>
          <a href="{{ route('ulasan.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Ulasan</a>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.admin.alert')

  {{-- Pencarian & filter (referensi: search bar inventory.html) --}}
  <form method="GET" action="{{ route('ulasan.index') }}" class="d-flex gap-2 mb-3 flex-wrap">
    <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" style="max-width: 280px;"
      placeholder="Cari komentar, pelanggan, menu...">
    <select name="rating" class="form-select" style="max-width: 160px;">
      <option value="">Semua rating</option>
      @for ($i = 5; $i >= 1; $i--)
        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} bintang</option>
      @endfor
    </select>
    <button type="submit" class="btn btn-outline-secondary"><i class="ti ti-filter"></i> Filter</button>
    @if (request('cari') || request('rating'))
      <a href="{{ route('ulasan.index') }}" class="btn btn-light">Reset</a>
    @endif
  </form>

  <div class="row">
    <div class="col-12">
      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>No</th>
              <th>Pelanggan</th>
              <th>Menu</th>
              <th>Rating</th>
              <th>Komentar</th>
              <th>Tanggal</th>
              <th>Tampil di Guest</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($dataUlasan as $item)
              <tr class="align-middle">
                <td>{{ $dataUlasan->firstItem() + $loop->index }}</td>
                {{-- data relasi diakses lewat property: $item->pelanggan->..., $item->menu->... --}}
                <td class="fw-semibold">{{ $item->pelanggan->nama_pelanggan }}</td>
                <td>{{ $item->menu->nama_menu }}</td>
                <td class="text-warning">
                  @for ($i = 1; $i <= 5; $i++)
                    <i class="ti {{ $i <= $item->rating ? 'ti-star-filled' : 'ti-star' }}"></i>
                  @endfor
                </td>
                <td>{{ Str::limit($item->komentar, 40) }}</td>
                <td>{{ $item->tanggal_ulasan->format('d M Y') }}</td>
                <td>
                  @if ($item->tampil)
                    <span class="badge bg-success-subtle text-success">Ya</span>
                  @else
                    <span class="badge bg-secondary-subtle text-secondary">Tidak</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('ulasan.edit', $item->ulasan_id) }}" class="btn btn-info btn-sm text-white">
                    <i class="ti ti-edit"></i> Edit
                  </a>
                  <form action="{{ route('ulasan.destroy', $item->ulasan_id) }}" method="POST" style="display:inline"
                        onsubmit="return confirm('Yakin ingin menghapus ulasan dari {{ $item->pelanggan->nama_pelanggan }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i> Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-secondary py-4">Belum ada data ulasan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $dataUlasan->links() }}</div>
    </div>
  </div>
@endsection
