@extends('layouts.app')

@section('title', 'Tambah Data Approval')

@section('content')



    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Internship / <a class="text-decoration-none text-muted fw-light"
                href="{{ route('approval.index') }}">Approval</a> /</span>
        Tambah Approval
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Data Approval</h5>
                <div class="card-body">
                    <form action="{{ route('approver.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="judul_approval" class="form-label">Judul approval</label>
                            <input type="text" name="judul_approval" class="form-control" id="judul_approval" value="{{ old('judul_approval') }}" required>
                            @error('judul_approval')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <input type="text" class="form-control" id="comment" name="comment"
                                value="{{ old('comment') }}" required>
                            @error('comment')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dokumen" class="form-label">dokumen</label>
                            <input type="file" class="form-control" id="dokumen" name="dokumen"
                                value="{{ old('dokumen') }}" required>
                            @error('dokumen')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        


                        <div class="mb-3">
                            <label for="level_approval" class="form-label">level approval</label>
                            <select class="form-select level_approval" name="level_approval" aria-label="level_approval" onchange="jumlahApprover()"
                                value="{{ old('level_approval') }}" required>
                                <option value="0">pilih</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                            @error('level_approval')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3" id="approver">
                            
                        </div>




                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Add Approval</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
  function jumlahApprover()
  {
    var selectedValue = $('.level_approval').val()
   
        // Lakukan apa pun yang perlu Anda lakukan dengan nilai selectedValue di sini
        // Contoh:
    // console.log("Nilai terpilih: " + selectedValue);

    $('#approver').empty();

    for (let i = 0; i < selectedValue; i++) {
      
    $.ajax({
      url: `{{ url('/approver') }}/`+i, // Ganti dengan URL yang sesuai
      type: 'GET',
      data: {
      _token: '{{ csrf_token() }}' // Jika menggunakan CSRF protection
         },
      success: function(response) {
        // Manipulasi respons dari controller di sini
        
        $('#approver').append(response);

        },
       error: function(xhr) {
         console.log(xhr.responseText);
         }
      });

    }


  }


</script>


