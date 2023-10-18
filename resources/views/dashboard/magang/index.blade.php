@extends('layouts.app')
@section('title', 'Magang')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Internship /</span> Data Anggota Magang</h4>
    <div class="card">
        <h5 class="card-header">Data Intern Lokpro</h5>
        <div class="d-flex justify-content-start ms-4">
            <a href="{{ route('intern.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Jenis Kelamin</th>
                        <th>NIM</th>
                        <th>Jenjang Pendidikan</th>
                        <th>Jurusan</th>
                        <th>Universitas</th>
                        <th>Surat Kontrak</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Status</th>
                        <th>Sertifikat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($magang as $mag)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mag->name }}</td>
                            <td>{{ $mag->divisi->name }}</td>
                            <td>{{ $mag->email }}</td>
                            <td>{{ $mag->no_hp }}</td>
                            <td>{{ $mag->jenis_kelamin }}</td>
                            <td>{{ $mag->nim }}</td>
                            <td>{{ $mag->jenjang_pendidikan }}</td>
                            <td>{{ $mag->jurusan }}</td>
                            <td>{{ $mag->universitas }}</td>
                            <td><a href="{{ $mag->surat_kontrak }}">Surat Kontrak | {{ $mag->nama }}</a></td>
                            <td>{{ $mag->tanggal_masuk }}</td>
                            <td>{{ $mag->tanggal_keluar }}</td>
                            @if ($mag->status == 'Aktif')
                                <td><span class="badge bg-label-success me-1">{{ $mag->status }}</span></td>
                            @else
                                <td><span class="badge bg-label-danger me-1">{{ $mag->status }}</span></td>
                            @endif
                            @if ($mag->sertifikat == null)
                                <td><span class="badge bg-label-danger me-1">Belum Ada</span></td>
                            @else
                            

                                <td>
                                    <form action="/sertifikat/{{ $mag->id }}"  method="POST" target="_blank">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="dropdown-item"><i class="bx bg-label-success bx-print me-1"></i>
                                            Lihat Sertifikat</button>
                                    </form>
                                </td>
                            @endif
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('intern.edit', $mag->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('intern.destroy', $mag->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                      
                                      
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css') }}">
@endpush

@push('addon-script')
    <script src="{{ url('https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        let table = new DataTable('#table');
    </script>
@endpush
