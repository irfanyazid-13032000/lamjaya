@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')



    <h4 class="fw-bold py-3 mb-4">
        Edit Pegawai
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('pegawai.update',['id'=>$pegawai->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pegawai" class="form-label">nama_pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai" value="{{ $pegawai->nama_pegawai }}" required>
                            @error('nama_pegawai')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">tempat lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{ $pegawai->tempat_lahir }}" required>
                            @error('tempat_lahir')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">tgl lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" value="{{ $pegawai->tgl_lahir }}" required>
                            @error('tgl_lahir')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">jenis_kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                              <option value="laki-laki">laki-laki</option>
                              <option value="perempuan">perempuan</option>
                            </select>
                        </div>

                        
                        <div class="mb-3">
                            <label for="agama" class="form-label">agama</label>
                            <select name="agama" id="" class="form-control">
                              <option value="islam">islam</option>
                              <option value="kristen">kristen</option>
                              <option value="katolik">katolik</option>
                              <option value="hindu">hindu</option>
                              <option value="budha">budha</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat') }}" required>
                            @error('alamat')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>




                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">kecamatan</label>
                            <select name="kecamatan_id" id="" class="form-control">
                              <option value="">pilih kecamatan</option>
                              @foreach ($allKecamatan as $kecamatan)
                              @if ($pegawai->kecamatan_id == $kecamatan->id)
                              <option value="{{$kecamatan->id}}" selected>{{$kecamatan->nama_kecamatan}}</option>
                              @else
                              <option value="{{$kecamatan->id}}">{{$kecamatan->nama_kecamatan}}</option>
                              @endif
                              @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">kelurahan</label>
                            <select name="kelurahan_id" id="" class="form-control">
                              <option value="">pilih kelurahan</option>
                              @foreach ($allKelurahan as $kelurahan)
                              @if ($pegawai->kelurahan_id == $kelurahan->id)
                              <option value="{{$kelurahan->id}}" selected>{{$kelurahan->nama_kelurahan}}</option>
                              @else
                              <option value="{{$kelurahan->id}}">{{$kelurahan->nama_kelurahan}}</option>
                              @endif
                              @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="provinsi" class="form-label">provinsi</label>
                            <select name="provinsi_id" id="" class="form-control">
                              <option value="">pilih provinsi</option>
                              @foreach ($allProvinsi as $provinsi)
                              @if ($pegawai->provinsi_id == $provinsi->id)
                              <option value="{{$provinsi->id}}" selected>{{$provinsi->nama_provinsi}}</option>
                              @else
                              <option value="{{$provinsi->id}}">{{$provinsi->nama_provinsi}}</option>
                              @endif
                              @endforeach
                            </select>
                        </div>


                       
              




                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a href="{{ route('kelurahan.index') }}" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
 


</script>


