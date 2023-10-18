@extends('layouts.app')
@section('title', 'Role')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Internship /</span> Data Role</h4>
    <div class="card">
        <h5 class="card-header">Data Role Lokpro</h5>
        <div class="d-flex justify-content-start ms-4">
            <a href="{{ route('role.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Role</th>
                        <th>Tanggal Dibuat</th>
                        <th>Tanggal Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($role as $roles)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $roles->name }}</td>
                            <td>{{ $roles->created_at }}</td>
                            <td>{{ $roles->updated_at == null ? 'Belum Diperbarui' : $role->updated_at }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('role.edit', $roles->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('role.destroy', $roles->id) }}" method="POST">
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
