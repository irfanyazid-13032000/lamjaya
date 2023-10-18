@extends('layouts.app')

@section('title', 'Lihat Approval')

@section('content')
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Lihat Approval</h5>
                <div class="card-body">
                   
                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{$approval->title}}" readonly>
                        </div>
                       
                        <div class="mb-3">
                            <label for="comment" class="form-label">comment</label>
                            <input type="comment" class="form-control" id="comment" name="comment"
                                value="{{$approval->comment}}" readonly>
                        </div>


                        <div class="mb-3">
                            <label for="document" class="form-label">document</label>
                            <input type="document" class="form-control" id="document" name="document"
                                value="{{$approval->document}}" readonly>
                        </div>
                       
                        
                      
                      
                      
                        
                        
                       
                        <div class="d-flex justify-content-end mt-2">
                          @if ($giliranMu)
                          <button class="btn btn-primary me-2" id="approve">Approve</button>
                          
                          <button class="btn btn-danger me-2" id="reject">Reject</button>
                          @endif
                            <a href="{{ route('responsibility.index') }}" class="btn btn-success ms-3">Kembali</a>
                        </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal approve -->

    <!-- Modal -->
<div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLabel">Berikan Komentar Approve</h5>

      </div>
      <div class="modal-body">
        <!-- Comment form -->
        <form action="{{route('approve.approval')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
            <input type="text" name="id" value="{{$approval->id}}" hidden>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <!-- modal reject -->

    <!-- Modal -->
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLabel">Berikan Komentar Reject</h5>

      </div>
      <div class="modal-body">
        <!-- Comment form -->
        <form action="{{route('reject.approval')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
            <input type="text" name="id" value="{{$approval->id}}" hidden>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection

@push('addon-script')

<!-- Your HTML content -->

<!-- JavaScript code -->
<script>
  document.getElementById('approve').addEventListener('click', function() {
    $('#modalApprove').modal('show'); // Show the modal when the button is clicked
  });

  document.getElementById('reject').addEventListener('click', function() {
    $('#modalReject').modal('show'); // Show the modal when the button is clicked
  });
</script>
</body>

    
@endpush
