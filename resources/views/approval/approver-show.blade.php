<label for="approver" class="form-label">Approver {{$i+1}}</label>
<select class="form-select approver" name="approver[]" aria-label="approver" value="{{ old('approver') }}" disabled>
@foreach ($allApprovers as $approver)
@if ($approver->id == $approverSelected->approver)
  <option value="{{$approver->id}}" selected>{{$approver->name}}</option>
  @else
  <option value="{{$approver->id}}">{{$approver->name}}</option>
@endif
@endforeach




</select>
@error('approver')
 <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
@enderror

<script>
$(document).ready(function() {
    $('.approver').select2();
});

</script>