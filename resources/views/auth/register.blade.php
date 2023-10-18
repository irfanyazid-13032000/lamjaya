@extends('layouts.auth')
@section('title', 'Daftar')

@section('content')
    <form method="POST" action="{{ route('register-post') }}" class="login100-form validate-form">
        @csrf
        <span class="login100-form-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Lokpro" width="90">
        </span>

        <span class="login100-form-title p-b-34 p-t-27">
            Daftarkan Akun Anda
        </span>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Nama dengan Benar!">
            <input class="input100" type="text" name="name" placeholder="Nama Anda" value="{{ old('name') }}">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Email dengan Benar!">
            <input class="input100" type="email" name="email" placeholder="Email Anda" value="{{ old('email') }}">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Password dengan Benar!">
            <input class="input100" type="password" name="password" placeholder="Password Anda">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
            @if ($errors->has('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Password dengan Benar!">
            <input class="input100" type="password" name="password_confirmation" placeholder="Masukkan Ulang Password Anda">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
            @if ($errors->has('password_confirmation'))
                <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Posisi Anda dengan Benar!">
            <select name="divisi_id" class="input100 divisi" style="border: none; outline:none;">
                @foreach ($divisi as $div)
                    <option class="text-dark" value="{{ $div->id }}">{{ $div->name }}</option>
                @endforeach
            </select>
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('divisi_id'))
                <p class="text-danger">{{ $errors->first('divisi_id') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Nomor HP dengan Benar!">
            <input class="input100" type="number" name="no_hp" placeholder="Nomor HP baru" value="{{ old('no_hp') }}">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('no_hp'))
                <p class="text-danger">{{ $errors->first('no_hp') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Jenis Kelamin dengan Benar!">
            <select name="jenis_kelamin" class="input100 divisi" style="border: none; outline:none;">
                <option class="text-dark">Jenis Kelamin</option>
                <option class="text-dark" value="Laki-Laki">Laki-Laki</option>
                <option class="text-dark" value="Perempuan">Perempuan</option>
            </select>
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('jenis_kelamin'))
                <p class="text-danger">{{ $errors->first('jenis_kelamin') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Nim dengan Benar!">
            <input class="input100" type="number" name="nim" placeholder="Nim" value="{{ old('nim') }}">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('nim'))
                <p class="text-danger">{{ $errors->first('nim') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Jenjang Pendidikan dengan Benar!">
            <input class="input100" type="text" name="jenjang_pendidikan" placeholder="Jenjang Pendidikan"
                value="{{ old('jenjang_pendidikan') }}">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('jenjang_pendidikan'))
                <p class="text-danger">{{ $errors->first('jenjang_pendidikan') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Jurusan dengan Benar!">
            <input class="input100" type="text" name="jurusan" placeholder="Jurusan" value="{{ old('jurusan') }}">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('jurusan'))
                <p class="text-danger">{{ $errors->first('jurusan') }}</p>
            @endif
        </div>

        <div class="wrap-input100 validate-input" data-validate="Masukkan Universitas dengan Benar!">
            <input class="input100" type="text" name="universitas" placeholder="Universitas"
                value="{{ old('universitas') }}">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if ($errors->has('universitas'))
                <p class="text-danger">{{ $errors->first('universitas') }}</p>
            @endif
        </div>


        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
                Daftar
            </button>
        </div>

        <div class="text-center p-t-90 txt1">
            Sudah Punya Akun?
            <a class="txt1" href="{{ route('login') }}">Login Disini
            </a>
        </div>
    </form>
@endsection
