@extends('layouts.admin')

@section('title', 'Data Pelanggan')

@section('content')
  {{-- Judul halaman (referensi: inventory.html template InApp) --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Data Pelanggan</h1>
          <p class="mb-0">List seluruh pelanggan Geprekku</p>
        </div>
        <div>
          <a href="{{ route('pelanggan.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Pelanggan</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Flash data: info sukses setelah redirect --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="ti ti-circle-check me-1"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="row">
    <div class="col-12">
      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>No</th>
              <th>Nama Pelanggan</th>
              <th>Jenis Kelamin</th>
              <th>No. HP</th>
              <th>Email</th>
              <th>Tanggal Lahir</th>
              <th>Alamat</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($dataPelanggan as $item)
              <tr class="align-middle">
                <td>{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $item->nama_pelanggan }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->tanggal_lahir ?? '-' }}</td>
                <td>{{ Str::limit($item->alamat ?? '-', 30) }}</td>
                <td>
                  <a href="{{ route('pelanggan.edit', $item->pelanggan_id) }}" class="btn btn-info btn-sm text-white">
                    <i class="ti ti-edit"></i> Edit
                  </a>
                  <form action="{{ route('pelanggan.destroy', $item->pelanggan_id) }}" method="POST" style="display:inline"
                        onsubmit="return confirm('Yakin ingin menghapus pelanggan {{ $item->nama_pelanggan }}?')">
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
                <td colspan="8" class="text-center text-secondary py-4">Belum ada data pelanggan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
