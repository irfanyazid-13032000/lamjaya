@extends('layouts.app')

@section('title', 'Edit Provinsi')

@section('content')



    <h4 class="fw-bold py-3 mb-4">
        Edit Provinsi
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('provinsi.update',['id'=>$provinsi->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" name="kode" class="form-control" id="kode" value="{{$provinsi->kode}}" required>
                            @error('kode')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_provinsi" class="form-label">nama_provinsi</label>
                            <input type="text" name="nama_provinsi" class="form-control" id="nama_provinsi" value="{{$provinsi->nama_provinsi}}" required>
                            @error('nama_provinsi')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        




                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a href="{{ route('provinsi.index') }}" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
  

<script>
 
  
  
  
  
</script>
  @endpush


