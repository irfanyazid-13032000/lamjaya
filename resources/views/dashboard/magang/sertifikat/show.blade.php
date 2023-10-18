@extends('layouts.app')
@section('title', 'user')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity / </span> Sertifikat</h4>
    <div class="card">
        @if($user->sertifikat == 'Ya')
            <h5 class="card-header">Halo <b>{{$user->name}}</b>, kamu sudah bisa cetak sertifikatmu disini</h5>
            <div class="d-flex justify-content-start ms-4 mb-4">
                <form action="{{ route('sertifikat.process',$user->id) }}" method="POST" target="_blank">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-primary"><i class="bx bx-print me-1"></i>
                        Sertifikat</button>
                </form>
                
            </div>
        
        @else
            <h5 class="card-header">Halo <b>{{$user->name}}</b>, Maaf sertifikatmu belum dapat diunduh</h5>
        
        @endif
        
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
      
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
