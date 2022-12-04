{{-- <select class="form-control item" style="height: 50px" name="stock_id" id="stock_id">
    <option>Please select a stock</option>
    @foreach ($stocks as $value)
        <option value="{{ $value->StockId }}">{{ $value->StockNameAr.'---'.$value->StockNameEn}}</option>
    @endforeach
</select>
 --}}

    @foreach ($stocks as $value)
        <option  value="{{ $value->StockId }}">{{ $value->StockNameAr.' --- '.$value->StockNameEn}}</option>
    @endforeach