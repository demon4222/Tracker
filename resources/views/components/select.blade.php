@if(isset($label))<label>{{$label}}</label>@endif
<select name="{{$name}}" class="form-control" id="{{$id}}">
    @if(!isset($value))<option>Select</option>@endif
    @foreach($options as $option)
        <option
            @if(isset($value)) {{$option->id == $value ? 'selected' : ''}} @endif value="{{$option->id}}">{{$option->name}}</option>
    @endforeach
</select>
