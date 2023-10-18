@extends('layouts.app')
@section('title', 'approver approval')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data Approver dari Approval <span class="badge bg-danger">{{$approval->title}}</span></h4>
    <div class="card">
        <h5 class="card-header">Approver dari Approval yang sudah disubmit <span class="badge bg-success">{{ $submitter->name }}</span></h5>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>Level Approval</th>
                        <th>Approver</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                  @foreach ($approvers as $approver)
                  <tr class="text-center">
                       <th>{{$approver->level_approval}}</th>
                       <th>{{$approver->name}}</th>
                       <th>{{$approver->comment}}</th>
                       <th>{{$approver->status}}</th>
                       <th>{{$approver->created_at}}</th>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data History dari Approval <span class="badge bg-danger">{{$approval->title}}</span></h4>
    <div class="card">
        <h5 class="card-header">History dari Approval yang sudah disubmit <span class="badge bg-success">{{ $submitter->name }}</span></h5>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>Actor</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                  @foreach ($histories as $history)
                  <tr class="text-center">
                       <th>{{$history->name}}</th>
                       <th>{{$history->status}}</th>
                       <th>{{$history->comment}}</th>
                       <th>{{$history->created_at}}</th>
                      </tr>
                    @endforeach
                </tbody>
            </table>
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
