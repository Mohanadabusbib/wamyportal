    @foreach ($invtyHardware as $value)
        <option value="{{ $value->id }}">{{ $value->name }}</option>
    @endforeach
{{-- <select class="form-control item" style="height: 50px" name="hardware_id" id="hardware_id">
    <option>Please select a device</option>
    @foreach ($invtyHardware as $value)
        <option value="{{ $value->id }}">{{ $value->name }}</option>
    @endforeach
</select> --}}