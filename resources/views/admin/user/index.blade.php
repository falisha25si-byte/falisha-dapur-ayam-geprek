@extends('layouts.admin.app')

@section('title', 'Data User')

@section('content')
  {{-- Judul halaman --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Data User</h1>
          <p class="mb-0">List data seluruh user</p>
        </div>
        <div>
          <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah User</a>
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
              <th>Name</th>
              <th>Email</th>
              <th>Password (hash)</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($dataUser as $item)
              <tr class="align-middle">
                <td>{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                {{-- Menampilkan hasil Hash::make() sebagai bukti password terenkripsi --}}
                <td><small class="text-secondary">{{ Str::limit($item->password, 30) }}</small></td>
                <td>
                  <a href="{{ route('user.edit', $item->id) }}" class="btn btn-info btn-sm text-white">
                    <i class="ti ti-edit"></i> Edit
                  </a>
                  <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline"
                        onsubmit="return confirm('Yakin ingin menghapus user {{ $item->name }}?')">
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
                <td colspan="5" class="text-center text-secondary py-4">Belum ada data user.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
