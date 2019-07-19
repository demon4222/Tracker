<label>{{$label}}</label>
<select name="{{$name}}" class="form-control" id="{{$id}}">
    <option>Select</option>
    @foreach($options as $label)
        <option value="{{$label->id}}">{{$label->name}}</option>
    @endforeach
</select>
