@extends('layouts.app')
@section('title', 'user')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Internship /</span> Data User</h4>
    <div class="card">
        <h5 class="card-header">Data User Management</h5>
        <div class="d-flex justify-content-start ms-4">
            <a href="{{ route ('users.create') }}" class="btn btn-primary">Tambah User</a>
        </div>
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                    @foreach ($user as $key => $items)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $items->name }}</td>
                            <td>{{ $items->email }}</td>
                            <td>{{ $items->role }}</td>
                            @if ($items->status == 'Aktif')
                                <td><span class="badge bg-label-success me-1">{{ $items->status }}</span></td>
                            @else
                                <td><span class="badge bg-label-danger me-1">{{ $items->status }}</span></td>
                            @endif
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('users.edit', $items->id ) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('users.destroy' , $items->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this user?')"><i class="bx bx-trash me-1"></i>
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
