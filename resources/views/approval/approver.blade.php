<label for="approver" class="form-label">Approver {{$i+1}}</label>
<select class="form-select approver" name="approver[]" aria-label="approver" value="{{ old('approver') }}" required>
  <option value="0">pilih</option>
  @foreach ($approvers as $approver)
      <option value="{{$approver->id}}">{{$approver->name}}</option>
  @endforeach
</select>
@error('approver')
 <p style="color: rgb(253, 21, 21)">{{ $message }}</p>
@enderror

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.approver').select2();
});

console.log($('.approver'))
</script>