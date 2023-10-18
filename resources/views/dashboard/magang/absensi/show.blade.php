@extends('layouts.app')
@section('title', 'Data Absensi')
@section('content')
    @if (session()->has('success'))
        <div class="bs-toast toast fade show bg-primary float-end" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Notifikasi</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Internship /</span> Absensi Harian Lokpro Media</h4>
    @if (auth()->user()->role == 'User')
        <div class="d-flex justify-content-start mb-4 ms-1">
            <form action="{{ route('absensi.store') }}" method="POST">
                @csrf
                <button class="btn btn-primary" type="submit">Isi Absen Masuk</button>
            </form>
        </div>
    @endif
    <div class="card">
        <div class="d-flex pe-4">
            <h5 class="card-header">Data Absensi Harian Kamu</h5>

        </div>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Aktivitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $abs)
                        @php
                            $user = $dataUser->where('id', $abs->user_id)->first();
                        @endphp
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $abs->tanggal }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->divisi->name }}</td>
                            <td>{{ $abs->jam_masuk }}</td>
                            <td>{{ $abs->jam_keluar }}</td>
                            <td>{{ $abs->deskripsi }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('absensi.edit', $abs->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Isi Absen Pulang</a>
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
