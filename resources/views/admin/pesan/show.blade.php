@extends('layouts.admin.app')

@section('title', 'Detail Pesan')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Detail Pesan</h1>
          <p class="mb-0">{{ $dataPesan->subjek }}</p>
        </div>
        <div>
          <a href="{{ route('pesan.index') }}" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body p-4">
      <dl class="row mb-0">
        <dt class="col-sm-3">Nama</dt>
        <dd class="col-sm-9">{{ $dataPesan->nama }}</dd>
        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9"><a href="mailto:{{ $dataPesan->email }}">{{ $dataPesan->email }}</a></dd>
        <dt class="col-sm-3">No. Telepon</dt>
        <dd class="col-sm-9">{{ $dataPesan->no_telepon ?? '-' }}</dd>
        <dt class="col-sm-3">Dikirim</dt>
        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($dataPesan->created_at)->format('d M Y H:i') }}</dd>
        <dt class="col-sm-3">Pesan</dt>
        <dd class="col-sm-9" style="white-space: pre-line;">{{ $dataPesan->pesan }}</dd>
      </dl>
    </div>
  </div>
@endsection
