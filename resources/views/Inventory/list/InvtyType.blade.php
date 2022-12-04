@foreach ($invtyTypes as $value)
    <option value="{{ $value->TypeId }}">{{ $value->TypeNameAr.' --- '.$value->TypeNameEn}}</option>
@endforeach
