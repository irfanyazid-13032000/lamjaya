@extends('layouts.app')

@section('title', 'Tambah Provinsi')

@section('content')



    <h4 class="fw-bold py-3 mb-4">
        Tambah Provinsi
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('provinsi.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" name="kode" class="form-control" id="kode" value="{{ old('kode') }}" required>
                            @error('kode')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_provinsi" class="form-label">nama provinsi</label>
                            <input type="text" name="nama_provinsi" class="form-control" id="nama_provinsi" value="{{ old('nama_provinsi') }}" required>
                            @error('nama_provinsi')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="active" class="form-label">active</label>
                            <select name="active" id="" class="form-control">
                              <option value="0">non active</option>
                              <option value="1">active</option>
                            </select>
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

<script>
 


</script>


