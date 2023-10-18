@extends('layouts.app')
@section('title', 'submitted approval')
@section('content')

    <h4 class="fw-bold py-3 mb-4">Data Approval</h4>
    <div class="card">
        <h5 class="card-header">Approval yang sudah di Submit oleh <span class="badge bg-success">{{ Auth::user()->name }}</span></h5>
        <div class="d-flex justify-content-start ms-4">
            <a href="{{ route ('create.approval') }}" class="btn btn-primary">Tambah Approval</a>
        </div>
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>dokumen</th>
                        <th>judul</th>
                        <th>level</th>
                        <th>komen</th>
                        <th>status</th>
                        <th>Aksi</th>
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
            ajax: "{{ route('submitted.approval.data') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'document', name: 'document' },
                { data: 'title', name: 'title' },
                { data: 'level', name: 'level' },
                { data: 'comment', name: 'comment' },
                { 
                    data:'status',
                    name:'status',
                    render: function(data,type,row,meta){
                        if (row.status == 'final') {
                            return '<span class="badge bg-success">'+row.status+'</span>'
                        }else if(row.status == 'submit'){
                            return '<span class="badge bg-primary">'+row.status+'</span>'
                        }else{
                            return '<span class="badge bg-danger">'+row.status+'</span>'
                        }
                    }
                },
                { 
                    data: 'halo',
                    name: 'halo',
                    render: function(data, type, row, meta) {

                        let submit = ''
                        let hapus = ''
                        let edit = ''
                        if (row.status == "belum") {
                            submit = '<a href="/submit-approval/' + row.id + '" class="btn btn-success">Submit</a> '
                            edit = '<a href="/edit-approval/' + row.id + '" class="btn btn-info">Edit</a> '
                            hapus = '<a href="/delete-approval/' + row.id + '" class="btn btn-danger">Delete</a> '
                        }
                        let detail = '<a href="/detail-approval/' + row.id + '" class="btn btn-secondary">Detail</a>'

                        let approverButton = '<a href="/approver-approval/' + row.id + '" class="btn btn-primary">approver</a> '

                       

                        return submit+approverButton+edit+hapus+detail

                        

                        
                    }

                    
                },
                
            ]
        });
    });
</script>
@endpush
