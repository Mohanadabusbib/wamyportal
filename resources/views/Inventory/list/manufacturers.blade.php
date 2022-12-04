{{-- <select class="form-control item" style="height: 50px" name="manufacturer_id" id="manufacturer_id">
    <option>Please select a manufacture</option>
    @foreach ($manufacturers as $value)
        <option value="{{ $value->id }}">{{ $value->name }}</option>
    @endforeach
</select> --}}

    @foreach ($manufacturers as $value)
        <option value="{{ $value->id }}">{{ $value->name }}</option>
    @endforeach