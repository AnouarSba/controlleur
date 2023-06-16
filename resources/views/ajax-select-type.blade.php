<option>--- اختر نوع الخطأ ---</option>

@if(!empty($emp))

  @foreach($emp as $key => $value)

    <option value="{{ $key }}">{{ $value }}</option>

  @endforeach

@endif