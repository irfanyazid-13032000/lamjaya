@extends('layouts.app')
@section('title', 'Pegawai')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data Pegawai </h4>
    <div class="card">
        <h5 class="card-header"> <span class="badge bg-success"></span></h5>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>no</th>
                        <th>nama</th>
                        <th>tempat lahir</th>
                        <th>tgl lahir</th>
                        <th>jenis kelamin</th>
                        <th>agama</th>
                        <th>alamat</th>
                        <th>kelurahan</th>
                        <th>kecamatan</th>
                        <th>provinsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                  @foreach ($allPegawai as $pegawai)
                  <tr class="text-center">
                    <th>{{$loop->iteration}}</th>
                    <th>{{$pegawai->nama_pegawai}}</th>
                    <th>{{$pegawai->tempat_lahir}}</th>
                    <th>{{$pegawai->tgl_lahir}}</th>
                    <th>{{$pegawai->jenis_kelamin}}</th>
                    <th>{{$pegawai->agama}}</th>
                    <th>{{$pegawai->alamat}}</th>
                    <th>{{$pegawai->nama_kelurahan}}</th>
                    <th>{{$pegawai->nama_kecamatan}}</th>
                    <th>{{$pegawai->nama_provinsi}}</th>
                    
                    <th>
                      <a href="{{route('pegawai.edit',['id'=>$pegawai->id])}}" class="btn btn-primary">edit</a>
                      <a href="{{route('pegawai.delete',['id'=>$pegawai->id])}}" class="btn btn-danger">delete</a>
                    </th>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            <a href="{{route('pegawai.create')}}" class="btn btn-success">add</a>
        </div>
    </div>

@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css') }}">
@endpush

@push('addon-script')
    <script src="{{ url('https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js') }}"></script>
    
    
@endpush
