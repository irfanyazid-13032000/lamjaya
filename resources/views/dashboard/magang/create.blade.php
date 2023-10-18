@extends('layouts.app')

@section('title', 'Tambah Data Anggota Magang')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Internship / <a class="text-decoration-none text-muted fw-light"
                href="{{ route('intern.index') }}">Data
                Anggota Magang</a> /</span>
        Tambah Data Anggota Magang
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Data Anggota Magang</h5>
                <div class="card-body">
                    <form action="{{ route('intern.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="divisi" class="form-label">Divisi</label>
                            <select class="form-select" id="divisi" name="divisi" aria-label="divisi"
                                value="{{ old('divisi') }}" required>
                                @foreach ($divisi as $div)
                                    <option value="{{ $div->name }}">{{ $div->name }}</option>
                                @endforeach
                            </select>
                            @error('divisi')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Telp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" aria-label="status" required>
                                <option value="Laki-Laki" {{ $div->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ $div->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" required>
                            @error('nim')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenjang_pendidikan" class="form-label">Jenjang Pendidikan</label>
                            <input type="text" class="form-control" id="jenjang_pendidikan" name="jenjang_pendidikan"
                                required>
                            @error('jenjang_pendidikan')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                            @error('jurusan')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="universitas" class="form-label">Universitas</label>
                            <input type="text" class="form-control" id="universitas" name="universitas" required>
                            @error('universitas')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="surat_kontrak" class="form-label">Surat Kontrak</label>
                            <input type="file" class="form-control" id="surat_kontrak" name="surat_kontrak" required>
                            @error('surat_kontrak')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                            @error('tanggal_masuk')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                            <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
                                required>
                            @error('tanggal_keluar')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" aria-label="status"
                                value="{{ old('status') }}" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                            @error('status')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sertifikat" class="form-label">Sertifikat</label>
                            <input type="text" class="form-control" id="sertifikat" name="sertifikat">
                            @error('sertifikat')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a href="{{ route('intern.index') }}" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
