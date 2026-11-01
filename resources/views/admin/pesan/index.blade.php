@extends('layouts.admin.app')

@section('title', 'Pesan Masuk')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="mb-4">
        <h1 class="fs-3 mb-1">Pesan Masuk</h1>
        <p class="mb-0">Pesan dari form Contact Us di halaman Guest</p>
      </div>
    </div>
  </div>

  @include('layouts.admin.alert')

  <form method="GET" action="{{ route('pesan.index') }}" class="d-flex gap-2 mb-3 flex-wrap">
    <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" style="max-width: 280px;"
      placeholder="Cari nama, email, isi pesan...">
    <button type="submit" class="btn btn-outline-secondary"><i class="ti ti-search"></i> Cari</button>
    @if (request('cari'))
      <a href="{{ route('pesan.index') }}" class="btn btn-light">Reset</a>
    @endif
  </form>

  <div class="row">
    <div class="col-12">
      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>No</th>
              <th>Pengirim</th>
              <th>Subjek</th>
              <th>Pesan</th>
              <th>Dikirim</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($dataPesan as $item)
              <tr class="align-middle {{ $item->sudah_dibaca ? '' : 'fw-semibold' }}">
                <td>{{ $dataPesan->firstItem() + $loop->index }}</td>
                <td>
                  {{ $item->nama }}
                  <small class="d-block text-secondary fw-normal">{{ $item->email }}</small>
                </td>
                <td>{{ $item->subjek }}</td>
                <td>{{ Str::limit($item->pesan, 40) }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</td>
                <td>
                  @if ($item->sudah_dibaca)
                    <span class="badge bg-secondary-subtle text-secondary">Dibaca</span>
                  @else
                    <span class="badge bg-warning-subtle text-warning">Baru</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('pesan.show', $item->pesan_id) }}" class="btn btn-info btn-sm text-white">
                    <i class="ti ti-eye"></i> Baca
                  </a>
                  <form action="{{ route('pesan.destroy', $item->pesan_id) }}" method="POST" style="display:inline"
                        onsubmit="return confirm('Yakin ingin menghapus pesan dari {{ $item->nama }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i> Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center text-secondary py-4">Belum ada pesan masuk.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $dataPesan->links() }}</div>
    </div>
  </div>
@endsection
