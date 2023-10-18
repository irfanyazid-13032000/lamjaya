@extends('layouts.app')

@section('title', 'Detail Data Approval')

@section('content')



    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a class="text-decoration-none text-muted fw-light"
                href="{{ route('approval.index') }}">Approval</a> /</span>
        Edit Approval
    </h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Data Approval</h5>
                <div class="card-body">
                    <form action="{{ route('update.approval',['id'=>$approval->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="judul_approval" class="form-label">Judul approval</label>
                            <input type="text" name="judul_approval" class="form-control" id="judul_approval" value="{{$approval->title}}" required>
                            @error('judul_approval')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <input type="text" class="form-control" id="comment" name="comment"
                            value="{{$approval->comment}}" required>
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
                            <select class="form-select level_approval" name="level_approval" aria-label="level_approval" onchange="jumlahApproverDiubah()" required>
                              <option value="0">pilih</option>
                                  @for ($i = 1; $i <= 9; $i++)
                              <option value="{{ $i }}" @if ($approval->level == $i) selected @endif>{{ $i }}</option>
                                  @endfor
                            </select>

                            @error('level_approval')
                                <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3" id="approver">
                            
                        </div>

                        @if ($errors->any())
                       <div class="alert alert-danger">
                          <ul>
                          @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                          @endforeach
                          </ul>
                        </div>
                        @endif




                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Edit Approval</button>
                            <a href="{{ route('approval.index') }}" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
  

<script>

  jumlahApproverAwal();

  
  
  function jumlahApproverAwal()
  {
    var selectedValue = $('.level_approval').find(':selected').val();

    
    $('#approver').empty();
    
    for (let i = 0; i < selectedValue; i++) {
      
      $.ajax({
        url: `{{ url('/approver-edit') }}/`+i+'/{{$approval->id}}', // Ganti dengan URL yang sesuai
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


  function jumlahApproverDiubah()
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
  @endpush


