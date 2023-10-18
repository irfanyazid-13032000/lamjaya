@extends('layouts.app')
@section('title', 'Kecamatan')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data Kecamatan </h4>
    <div class="card">
        <h5 class="card-header"> <span class="badge bg-success"></span></h5>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>no</th>
                        <th>kode</th>
                        <th>nama kecamatan</th>
                        <th>active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                  @foreach ($allKecamatan as $kecamatan)
                  <tr class="text-center">
                    <th>{{$loop->iteration}}</th>
                    <th>{{$kecamatan->kode}}</th>
                    <th>{{$kecamatan->nama_kecamatan}}</th>
                    
                    <th><input type="checkbox" name="active" id="" onclick="updateActive({{ $kecamatan->id }},{{ $kecamatan->active }})" {{ ($kecamatan->active == 1)  ? 'checked' : '' }}></th>
                    <th>
                      <a href="{{route('kecamatan.edit',['id'=>$kecamatan->id])}}" class="btn btn-primary">edit</a>
                      <a href="{{route('kecamatan.delete',['id'=>$kecamatan->id])}}" class="btn btn-danger">delete</a>
                    </th>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            <a href="{{route('kecamatan.create')}}" class="btn btn-success">add</a>
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
      function updateActive(id,active) {
        var url = `{{ route('kecamatan.update-active', ['id' => ':id','active' => ':active']) }}`
        url = url.replace(':id',id)
        url = url.replace(':active',active)
        $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
          location.reload();
        

        },
       error: function(xhr) {
         console.log(xhr.responseText);
        }
      });
        
      }
    </script>
    
@endpush
