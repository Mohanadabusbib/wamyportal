@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<style>
    .name-header{
        font-size: 25px;
        font-weight: bolder;
        text-decoration: underline;
        text-align: center;
    }
    .ava-border{
        border: 5px solid #0162E8;
    }
    
    .img-cov{
        /* border: 0.5px solid #0162E8;
        border-radius: 20px;
        height: 110px;
        width: 80px; */
        margin: -11% 36% 2% 0%;
    }
    .hvr-bounce-in {
    display: block;
    vertical-align: middle;
    -webkit-transform: perspective(1px) translateZ(0);
    transform: perspective(1px) translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
    -webkit-transition-duration: 0.5s;
    transition-duration: 0.5s;
    text-align: center;
    }
    .hvr-bounce-in span{
        color: #000;
        font-weight: bolder
    }
    .hvr-bounce-in:hover, .hvr-bounce-in:focus, .hvr-bounce-in:active {
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        -webkit-transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
        transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
        border-bottom: 2px solid #0162E8;
    }
    .hvr-float-shadow {
        display: inline-block;
        vertical-align: middle;
        -webkit-transform: perspective(1px) translateZ(0);
        transform: perspective(1px) translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        position: relative;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: transform;
        transition-property: transform;
    }
    .hvr-float-shadow:before {
        pointer-events: none;
        position: absolute;
        z-index: -1;
        content: '';
        top: 100%;
        left: 5%;
        height: 10px;
        width: 90%;
        opacity: 0;
        background: -webkit-radial-gradient(center, ellipse, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0) 80%);
        background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0) 80%);
        /* W3C */
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: transform, opacity;
        transition-property: transform, opacity;
    }
    .hvr-float-shadow:hover, .hvr-float-shadow:focus, .hvr-float-shadow:active {
        -webkit-transform: translateY(-5px);
        transform: translateY(-5px);
    /* move the element up by 5px */
    }
    .hvr-float-shadow:hover:before, .hvr-float-shadow:focus:before, .hvr-float-shadow:active:before {
        opacity: 1;
        -webkit-transform: translateY(5px);
        transform: translateY(5px);
        /* move the element down by 5px (it will stay in place because it's attached to the element that also moves up 5px) */
    }
    .search{
        display: flex;
        justify-content:space-around
    }
    .search-item label{
        font-weight: bold;
    }
    .search-item .item{
        font-size: 16px;
        border:1px solid #0162E8;
        width: 100%;
        padding: 12px 5px;
        
    }

</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex"><h4 class="content-title mb-0 my-auto">{{__('menu.inventory')}}</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.inventory')}}</span></div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    {{--Start Search --}}
    <div class="row">
        <div class="col-lg-2">
            <a href="{{route('Inventory.index')}}" class="btn btn-info " id="btnReset">
                <i class="fas fa-redo">&nbsp; Refresh</i>
            </a>
        </div>
        <div class="col-lg-2">
            @can('proc-custody')
            <button class="btn btn-primary " data-toggle="modal" data-id="1" data-target="#addCustody">
                <i class="fas fa-plus">&nbsp; Add custody</i>
            </button>
            @endcan
        </div>
        <div class="col-lg-2">
                <form action="{{route('Inventory-printEmp',1)}}" method="get" id="frmPrintEmp">
                    {{-- @csrf
                    @method('PATCH') --}}
                    <input class="form-control" type="text" name="printEmp" id="printEmp" placeholder="Employee ID">  
        </div>
        <div class="col-lg-2">
                    <button class="btn btn-secondary" style="display: none">
                        <i class="mdi mdi-printer ml-1">&nbsp; Print</i>
                        {{-- fas fa-plus --}}
                    </button>
                </form>
        
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-lg-12">

            @if (Session::has('success'))
                <div class="card bd-0 mg-b-20 bg-success" id="successmsg">
                    <div class="card-body text-white">
                        <div class="main-error-wrapper">
                            <i class="si si-check mg-b-20 tx-50"></i>
                            <h4 class="mg-b-0" id="message">{{Session::get('success')}}</h4>
                        </div>
                    </div>
                </div>
            @elseif (Session::has('error'))
                <div class="card bd-0 mg-b-20 bg-danger">
                    <div class="card-body text-white">
                        <div class="main-error-wrapper">
                            <i class="si si-close mg-b-20 tx-50"></i>
                            <h4 class="mg-b-0">{{Session::get('error')}}</h4>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card card-primary">
                <div class="card-body ">
                    <div class="search-item">
                        <div class="row">
                            <div class="col-lg-2">
                                <form action="{{route('Inventory-newsearch',1)}}" method="post" id="frmSchBarcode">
                                    {{ csrf_field() }}
                                    <label for="searchItem">Barcode</label>
                                    <input class="item" type="text" name="schBarcode" id="schBarcode">
                                </form>
                                
                            </div>
                            <div class="col-lg-2">
                                <form action="{{route('Inventory-newsearch',2)}}" method="post" id="frmSchStoreId">
                                    {{ csrf_field() }}
                                    <label for="searchItem">Store Id</label>
                                    <input class="item" type="text" name="schStoreId" id="schStoreId">
                                </form>
                            </div>
                            <div class="col-lg-2">
                                <form action="{{route('Inventory-newsearch',3)}}" method="post" id="frmSchStockName">
                                    {{ csrf_field() }}
                                    <label for="schStockId">Stocks</label>
                                    {{-- <select class="form-control item" style="height: 50px" name="schStockId" id="schStockId">
                                        <option>Please select a stock</option>
                                        @include('Inventory.list.stock')
                                    </select> --}}
                                    <input type="text" style="height: 50px;" list="stocks" class="form-control item"  name="schStockId" id="schStockId">
                                    <datalist  id="stocks" >
                                        <option >Please select a stock</option>
                                        @include('Inventory.list.stock')
                                    </datalist> 
                                        
                                </form>
                                
                            </div>
                            <div class="col-lg-2">
                                <form action="{{route('Inventory-newsearch',4)}}" method="post" id="frmSchHardwareId">
                                    {{ csrf_field() }}
                                    <label for="schHardwareId">Device</label>
                                    <select class="form-control item" style="height: 50px" name="schHardwareId" id="schHardwareId">
                                        <option value="0">Please select a device</option>
                                        @include('Inventory.list.hardware')    
                                    </select>
                                </form>
                                
                            </div>
                            <div class="col-lg-2">
                                <form action="{{route('Inventory-newsearch',5)}}" method="post" id="frmSchManufacturerId">
                                    {{ csrf_field() }}
                                    <label for="schManufacturerId">Manufacturers</label>
                                    <select class="form-control item" style="height: 50px" name="schManufacturerId" id="schManufacturerId" >
                                        <option value="0">Please select a manufacture</option>
                                        @include('Inventory.list.manufacturers')
                                    </select>    
                                </form>
                            </div>
                            <div class="col-lg-2">
                                <form action="{{route('Inventory-newsearch',6)}}" method="post" id="frmSchInvtyType">
                                    {{ csrf_field() }}
                                    <label for="schInvtyType">Inventory Types</label>
                                    <select class="form-control item" style="height: 50px" name="schInvtyType" id="schInvtyType">
                                        <option>Please select a inventory type</option>
                                        @include('Inventory.list.InvtyType')
                                    </select>
                                </form>
                                
                            </div>
                        </div>
                        {{-- @include("Inventory.list.stock") --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Search --}}

    {{--Start Table --}}
    <P id="testData"></P>
    <div class="row ">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <table id="example1" class="table key-buttons text-md-nowrap" style="font-size: 16px">
                <div class="card-body">
                    <h1 id="MMA"></h1>
                    <div class="table-responsive">                          
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Barcode</th>
                                <th class="border-bottom-0">Device</th>
                                <th class="border-bottom-0">Device Company</th>
                                <th class="border-bottom-0">Store</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Processes</th>

                            </tr>
                        </thead>
                        <tbody id="tableSearch">
                            @foreach ($devices as $item)
                            <tr>
                                <td>{{$item->HdwBarcode}}</td>
                                <td>{{$item->device}}</td>
                                <td>{{$item->company}}</td>
                                <td>{{$item->stock}}</td>
                                <td>
                                    {{ $item->HdwType == 101 ? $item->hdType . " من " .$item->stockName : $item->hdType }}
                                </td>
                                <td>
                                        <button class="btn btn-success" data-toggle="modal"
                                            data-hdwbarcode="{{$item->HdwBarcode}}"
                                            data-deviceid="{{$item->TohdwId}}"
                                            data-devicename="{{$item->device}}"
                                            data-companyid="{{$item->ManfId}}"
                                            data-companyname="{{$item->company}}"
                                            data-modeledit="{{$item->HdwModel}}"
                                            data-typeid="{{$item->HdwType}}"
                                            data-typename="{{$item->hdType}}"
                                            data-stockid="{{$item->StockIN}}"
                                            data-stockname="{{$item->stock}}"
                                            data-target="#edit-device">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Table --}}

    {{--Start Add Custody Modal --}}
    <div class="modal fade" id="addCustody" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Custody </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('Inventory.store')}}" method="post">
                    {{-- @method('delete') --}}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                            {{-- <input class="form-control" onvolumechange="changDevice()" type="number" name="countDevice" id="countDevice" required> --}}
                        {{-- <h4 style="color:red">
                            هل أنت متاكد من عملية الغاء الإشتراك للموظف ادناه؟
                        </h4> --}}
                        </p>
                        <div id="countEntry">
                            <div class="card">
                                <div class="card-body">
                                    <label for="id">Barcode</label>
                                    <input class="form-control" type="text" name="barcode" id="barcode" value="">
                                    <label for="hardware_id">Device Type</label>
                                    <select class="form-control item" style="height: 50px" name="hardware_id" id="hardware_id">
                                        <option>Please select a device</option>
                                        @include('Inventory.list.hardware')    
                                    </select>
                                    <label for="manufacturer_id">Manufacturers</label>
                                    <select class="form-control item" style="height: 50px" name="manufacturer_id" id="manufacturer_id">
                                        <option>Please select a manufacture</option>
                                        @include('Inventory.list.manufacturers')
                                    </select>
                                    <label for="model">Model</label>
                                    <input class="form-control" type="text" name="model" id="model" value="">
                                    <label for="note">Note</label>
                                    <input class="form-control" type="text" name="note" id="note" value="">
                                    <label for="typeId">Inventory Type</label>
                                    <select class="form-control item" style="height: 50px" name="typeId" id="typeId">
                                        <option>Please select a inventory type</option>
                                        @include('Inventory.list.InvtyType')
                                    </select>
                                    <label for="stock_id">Stock</label>
                                    
                                    <select class="form-control item" style="height: 50px" name="stock_id" id="stock_id">
                                        <option>Please select a stock</option>
                                        @include('Inventory.list.stock')
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End Add Custody Modal --}}

    {{--Start Edit Device Modal --}}
    <div class="modal fade" id="edit-device" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Custody </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('Inventory.update',1)}}" method="POST">
                    
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="modal-body">
                        <p class="text-center">
                            {{-- <input class="form-control" onvolumechange="changDevice()" type="number" name="countDevice" id="countDevice" required> --}}
                        {{-- <h4 style="color:red">
                            هل أنت متاكد من عملية الغاء الإشتراك للموظف ادناه؟
                        </h4> --}}
                        </p>
                        <div id="countEntry">
                            <div class="card">
                                <div class="card-body">
                                    <label for="barcodeedit">Barcode</label>
                                    <input class="form-control" type="text" name="barcodeedit" id="barcodeedit" value="" readonly>
                                    <label for="hardwarenameedit">Device Type</label>
                                    <input class="form-control" type="hidden" name="hardwareidedit" id="hardwareidedit" value="">
                                    <input class="form-control" type="text" name="hardwarenameedit" id="hardwarenameedit" value="" readonly>
                                    
                                    <label for="manufacturernameedit">Manufacturers</label>
                                    <input class="form-control" type="hidden" name="manufactureridedit" id="manufactureridedit" value="">
                                    <input class="form-control" type="text" name="manufacturernameedit" id="manufacturernameedit" value="" readonly>
                                    
                                    
                                    <label for="modeledit">Model</label>
                                    <input class="form-control" type="text" name="modeledit" id="modeledit" value="" readonly>
                                    <label for="noteedit">Note</label>
                                    <input class="form-control" type="text" name="noteedit" id="noteedit" value="">
                                    
                                    <label for="typeId">Inventory Type</label>
                                    <input class="form-control" type="hidden" name="typeidedit" id="typeidedit" value="">
                                    <input class="form-control" type="text" name="typenameedit" id="typenameedit" value="" readonly>
                                    <select class="form-control item" style="height: 50px" name="typeId" id="typeId" required>
                                        {{-- <option value="0">Please select a inventory type</option> --}}
                                        @include('Inventory.list.InvtyType')
                                    </select>
                                    <label for="stock_id">Stock</label>
                                    <input class="form-control" type="hidden" name="stockidedit" id="stockidedit" value="">
                                    <input class="form-control" type="text" name="stocknameedit" id="stocknameedit" value="" readonly>
                                    <select class="form-control item" style="height: 50px" name="stock_id" id="stock_id" required>
                                        <option value="0">Please select a stock</option>
                                        @include('Inventory.list.stock')
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End Edit Device Modal --}}
@endsection

@section('js')
    <script src="{{asset('public/assets/js/jquery-3.4.1.js')}}"></script>
    <script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('public/assets/js/main.js')}}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>
    <script src="{{asset('public/assets/js/Inventory/filterData.js')}}"></script>
    <script>
        $('#printEmp').on('focusout', function() {
        var frmPrintEmp = document.getElementById('frmPrintEmp');
        frmPrintEmp.submit();
    });
    </script>
    <script>
        $('#edit-device').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var hdwbarcode = button.data('hdwbarcode');
            var deviceid = button.data('deviceid');
            var devicename = button.data('devicename');
            var companyid = button.data('companyid');
            var companyname = button.data('companyname');
            var modeledit = button.data('modeledit');
            var typeid = button.data('typeid');
            var typename = button.data('typename');
            var stockid = button.data('stockid');
            var stockname = button.data('stockname');
            var modal = $(this);

            modal.find('.modal-body #barcodeedit').val(hdwbarcode);
            modal.find('.modal-body #hardwareidedit').val(deviceid);
            modal.find('.modal-body #hardwarenameedit').val(devicename);
            modal.find('.modal-body #manufactureridedit').val(companyid);
            modal.find('.modal-body #manufacturernameedit').val(companyname);
            modal.find('.modal-body #modeledit').val(modeledit);
            modal.find('.modal-body #typeidedit').val(typeid);
            modal.find('.modal-body #typenameedit').val(typename);
            modal.find('.modal-body #stockidedit').val(stockid);
            modal.find('.modal-body #stocknameedit').val(stockname);

        });
    </script>
@endsection