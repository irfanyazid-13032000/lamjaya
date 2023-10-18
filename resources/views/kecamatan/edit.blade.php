@extends('layouts.app')

@section('title', 'Edit Kecamatan')

@section('content')



    <h4 class="fw-bold py-3 mb-4">
        Edit Kecamatan
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('kecamatan.update',['id'=>$kecamatan->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" name="kode" class="form-control" id="kode" value="{{$kecamatan->kode}}" required>
                            @error('kode')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_kecamatan" class="form-label">nama_kecamatan</label>
                            <input type="text" name="nama_kecamatan" class="form-control" id="nama_kecamatan" value="{{$kecamatan->nama_kecamatan}}" required>
                            @error('nama_kecamatan')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        




                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a href="{{ route('kecamatan.index') }}" class="btn btn-danger ms-3">Kembali</a>
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


