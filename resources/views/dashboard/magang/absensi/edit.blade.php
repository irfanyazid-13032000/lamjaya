@extends('layouts.app')

@section('title', 'Isi Absen Keluar')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Internship /</span>
        Absensi Harian Lokpro Media
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Isi Absensi Keluar</h5>
                <div class="card-body">
                    <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Aktivitas Hari Ini</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                value="{{ old('deskripsi') }}" required>
                            @error('deskripsi')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a href="{{ route('absensi.show', Auth::user()->email) }}"
                                class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
