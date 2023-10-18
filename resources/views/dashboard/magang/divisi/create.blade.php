@extends('layouts.app')

@section('title', 'Tambah Data Anggota Magang')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Internship / <a class="text-decoration-none text-muted fw-light"
                href="{{ route('divisi.index') }}">Divisi
                Magang</a> /</span> Tambah Data Divisi Magang
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Data Divisi Magang</h5>
                <div class="card-body">
                    <form action="{{ route('divisi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Divisi</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_anggota" class="form-label">Jumlah Anggota</label>
                            <input type="number" class="form-control" id="jumlah_anggota" name="jumlah_anggota"
                                value="{{ old('jumlah_anggota') }}">
                            <p class="text-muted">Tidak perlu diisi jika jumlah anggota = 0.</p>
                            @error('jumlah_anggota')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a href="{{ route('divisi.index') }}" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
