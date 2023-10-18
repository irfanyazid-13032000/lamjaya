@extends('layouts.app')

@section('title', 'Tambah Data User')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Internship / <a class="text-decoration-none text-muted fw-light"
                href="{{ route('users.index') }}">Data
                User</a> /</span>
        Tambah User
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Data User</h5>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" >
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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                value="{{ old('password') }}" required>
                            @error('password')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Divisi</label>
                            <select class="form-select" id="role" name="role" aria-label="role"
                                value="{{ old('role') }}" required>
                                @foreach ($role as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
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
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
