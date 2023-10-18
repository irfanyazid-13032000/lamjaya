@extends('layouts.app')
@section('title', 'Data Absensi')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Internship /</span> Data Absensi</h4>
    <div class="card">
        <div class="d-flex pe-4">
            <h5 class="card-header">Data Absensi Intern Lokpro</h5>
            {{-- eport pdf --}}
            @if (auth()->user()->role == 'HRD')
                <button type="button" class="btn btn-primary ms-auto align-self-center" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Export PDF
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Export</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Export Semua Data</label>
                                            <a href="{{ url('/ekspor-pdf') }}" target="_blank"
                                                class="btn btn-primary w-100">Export
                                                Semua</a>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Export Data 1 Bulan</label>
                                            <a href="{{ url('/ekspor-pdf/bulan') }}" target="_blank"
                                                class="btn btn-primary w-100">Export
                                                Bulan</a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Export Data 7 Hari Terakhir</label>
                                            <a href="{{ url('/ekspor-pdf/minggu') }}" target="_blank"
                                                class="btn btn-primary w-100">Export
                                                Minggu</a>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Export Data Hari Ini</label>
                                            <a href="{{ url('/ekspor-pdf/hari') }}" target="_blank"
                                                class="btn btn-primary w-100">Export
                                                Hari</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
                        <th>Waktu Dibuat</th>
                        <th>Waktu Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($absensi as $abs)
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
                            <td>{{ $abs->created_at }}</td>
                            <td>{{ $abs->updated_at }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('intern.edit', $abs->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('intern.destroy', $abs->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="10">Data Kosong</td>
                        </tr>
                    @endforelse
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
