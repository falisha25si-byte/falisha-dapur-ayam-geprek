@extends('layouts.admin.app')

@section('title', 'Data Bahan Baku')

@section('content')
  {{-- Judul halaman (referensi: inventory.html template InApp) --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Data Bahan Baku</h1>
          <p class="mb-0">List stok bahan baku dapur Geprekku</p>
        </div>
        <div>
          <a href="{{ route('bahan-baku.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Bahan Baku</a>
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
              <th>Nama Bahan</th>
              <th>Stok</th>
              <th>Satuan</th>
              <th>Harga Satuan</th>
              <th>Supplier</th>
              <th>Tanggal Masuk</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($dataBahanBaku as $item)
              <tr class="align-middle">
                <td>{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $item->nama_bahan }}</td>
                <td>
                  @if ($item->stok <= 5)
                    <span class="badge bg-danger-subtle text-danger">{{ $item->stok }} (menipis)</span>
                  @else
                    {{ $item->stok }}
                  @endif
                </td>
                <td>{{ $item->satuan }}</td>
                <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $item->supplier ?? '-' }}</td>
                <td>{{ $item->tanggal_masuk }}</td>
                <td>
                  <a href="{{ route('bahan-baku.edit', $item->bahan_baku_id) }}" class="btn btn-info btn-sm text-white">
                    <i class="ti ti-edit"></i> Edit
                  </a>
                  <form action="{{ route('bahan-baku.destroy', $item->bahan_baku_id) }}" method="POST" style="display:inline"
                        onsubmit="return confirm('Yakin ingin menghapus bahan {{ $item->nama_bahan }}?')">
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
                <td colspan="8" class="text-center text-secondary py-4">Belum ada data bahan baku.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
