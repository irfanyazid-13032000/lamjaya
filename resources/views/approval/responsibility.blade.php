@extends('layouts.app')
@section('title', 'approver approval')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data Approval yang dikirimkan ke kamu<span class="badge bg-danger"></span></h4>
    <div class="card">
        <h5 class="card-header">Responsibilities dari user yang sudah submit ke kamu (<span class="badge bg-success">{{ Auth::user()->name }}</span>)</h5>
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>Judul</th>
                        <th>Kamu Approver ke</th>
                        <th>Keseluruhan Approver</th>
                        <th>Comment</th>
                        <th>Giliran</th>
                        <th>Submitter</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                 
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
    <script>
    $(document).ready(function() {
        $('#table').DataTable({
            serverSide: true,
            ajax: "{{ route('responsibility.data') }}",
            columns: [
                { data: 'title', name: 'title' },
                { data: 'level_approval', name: 'level_approval' },
                { data: 'level', name: 'level' },
                { data: 'comment', name: 'comment' },
                { data: 'giliran_approve', name: 'giliran_approve' },
                { data: 'submitter_name', name: 'submitter_name' },
                { 
                    data: 'halo',
                    name: 'halo',
                    render: function(data, type, row, meta) {

                        let lihatApproval = '<a href="/lihat-approval/' + row.approval_id + '" class="btn btn-success">lihat Approval</a> '
                        let lihatApprover = '<a href="/approver-approval/' + row.approval_id + '" class="btn btn-primary">lihat Approver</a>'

                        return lihatApproval+lihatApprover
                        
                    }

                    
                },
                
            ]
        });
    });
</script>
@endpush