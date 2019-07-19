<label>{{$label}}</label>
<select name="{{$name}}" class="form-control" id="{{$id}}">
    <option>Select</option>
    @foreach($options as $label)
        <option @if(isset($value)) {{$label->id == $value ? 'selected' : ''}} @endif value="{{$label->id}}">{{$label->name}}</option>
    @endforeach
</select>
