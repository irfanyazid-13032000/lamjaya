<?php
use App\Models\User;
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Data Absensi</h1>
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
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse ($absensi as $abs)
                @php
                    $dataUser = User::all();
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
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="10">Data Kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
