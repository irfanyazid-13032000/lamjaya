@extends('layouts.app')
@section('title', 'Provinsi')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data Provinsi </h4>
    <div class="card">
        <h5 class="card-header"> <span class="badge bg-success"></span></h5>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>no</th>
                        <th>kode</th>
                        <th>nama Provinsi</th>
                        <th>active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                  @foreach ($allProvinsi as $provinsi)
                  <tr class="text-center">
                    <th>{{$loop->iteration}}</th>
                    <th>{{$provinsi->kode}}</th>
                    <th>{{$provinsi->nama_provinsi}}</th>
                    
                    <th><input type="checkbox" name="active" id="" onclick="updateActive({{ $provinsi->id }},{{ $provinsi->active }})" {{ ($provinsi->active == 1)  ? 'checked' : '' }}></th>
                    <th>
                      <a href="{{route('provinsi.edit',['id'=>$provinsi->id])}}" class="btn btn-primary">edit</a>
                      <a href="{{route('provinsi.delete',['id'=>$provinsi->id])}}" class="btn btn-danger">delete</a>
                    </th>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            <a href="{{route('provinsi.create')}}" class="btn btn-success">add</a>
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
        var url = `{{ route('provinsi.update-active', ['id' => ':id','active' => ':active']) }}`
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
