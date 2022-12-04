@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('public/assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('menu.inventory')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المستودعات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
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
    
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <table id="example1" class="table key-buttons text-md-nowrap" style="font-size: 16px">
                    
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <button class="btn btn-primary " data-toggle="modal" data-target="#add-stocks">
                                <i class="fas fa-plus">&nbsp; إضافة مستودع</i>
                           </button>
                        </div>
                        <div class="col-xl-3">
                            <select class="form-control" name="schStockTyp" id="schStockTyp">
                                <option>Please choose the type of warehouse</option>
                                <option value="S">Store</option>
                                <option value="E">Employees</option>
                                <option value="M">Maintenance </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="table-responsive" >                          
                        <thead>
                            <tr>
                                <th class="border-bottom-0">رقم المستودع</th>
                                <th class="border-bottom-0">المستودع</th>
                                <th class="border-bottom-0">Store</th>
                                <th class="border-bottom-0">Processes</th>
                            </tr>
                        </thead>
                        <tbody id="tableSearch">
                            @foreach ($stocks as $item)
                            <tr>
                                <td>{{$item->StockId}}</td>
                                <td>{{ $item->StockNameAr }}</td>
                                <td>{{ $item->StockNameEn }}</td>
                                <td>
                                    @can('proc-approval-visit')
                                    <div>
                                        <button class="btn btn-success" data-toggle="modal"
                                            data-stockidedit="{{$item->StockId}}"
                                            data-stocknamearedit="{{$item->StockNameAr}}"
                                            data-stocknameenedit="{{$item->StockNameEn}}"
                                            data-target="#edit-stocks">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button class="btn btn-danger"  data-toggle="modal"
                                            data-stockiddel="{{$item->StockId}}"
                                            data-stocknameardel="{{$item->StockNameAr}}"
                                            data-stocknameendel="{{$item->StockNameEn}}"
                                            data-target="#delete-stocks">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                       
                                    </div>
                                    @endcan
                                    
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
    <!-- row closed -->

    <!--Start Add Stocks -->
        <div class="modal fade" id="add-stocks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelAdd" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelAdd">Add Store</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('Stocks.store')}}" method="post">
                        
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            
                            </p>
                            <label for="StockId">Store ID</label>
                            <input class="form-control" type="text" name="StockId" id="StockId" required>
                            <label for="StockNameAr">Store in Ar</label>
                            <input class="form-control" type="text" name="StockNameAr" id="StockNameAr" required>
                            <label for="StockNameEn">Store in En </label>
                            <input class="form-control" type="text" name="StockNameEn" id="StockNameEn" required>
                            <label for="StockTyp">Store Type</label>
                            <select class="form-control" name="StockTyp" id="StockTyp" required>
                                <option>Please choose the type of warehouse</option>
                                <option value="S">Store</option>
                                <option value="E">Employee</option>
                                <option value="M">Maintenance</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End Add Stocks -->

    <!--Start Edit Stocks -->
        <div class="modal fade" id="edit-stocks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelEdit">Update Store</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('Stocks.update',1)}}" method="post">
                        @method('PATCH')
                        {{ csrf_field() }}
                        <div class="modal-body" id="modal-body-edit">
                            <p class="text-center">
                           {{--  <h4 style="color:red; text-align: left">
                                Are you sure about the edit process below ?
                                <br>
                                <span style="font-size: 12px">You can only edit the name</span>
                            </h4> --}}
                                
                            </p>
                            <label for="stockId">Store Id</label>
                            <input type="text" class="form-control" name="stockIdEdit" id="stockIdEdit" value="" readonly required>
                            <label for="stockNameAr">Store in Ar</label>
                            <input type="text" class="form-control" name="stockNameArEdit" id="stockNameArEdit" value="" required>
                            <label for="stockNameEn">Store in En </label>
                            <input type="text" class="form-control" name="stockNameEnEdit" id="stockNameEnEdit" value="" required>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End Edit Stocks -->
    <!--Start Delete Stocks -->
        <div class="modal fade" id="delete-stocks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelDel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelDel">Delete Store</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('Stocks.destroy',2)}}" method="post">
                        @method('delete')
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            <h4 style="color:red">
                                Are you sure about the process of deleting the store
                            </h4>
                            </p>
                            <label for="stockIdDel">Store Id</label>
                            <input class="form-control" type="text" name="stockIdDel" id="stockIdDel" value="" readonly>
                            <label for="stockNameArDel">Store in Ar</label>
                            <input class="form-control" type="text" name="StockNameArDel" id="stockNameArDel" value="" readonly>
                            <label for="stockNameEnDel">Store in En </label>
                            <input class="form-control" type="text" name="stockNameEnDel" id="stockNameEnDel" value="" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End Delete Stocks -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('public/assets/js/table-data.js')}}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>
    <script>
        $('select[name="schStockTyp"]').on('change', function() {
            var schStockTyp = $(this).val();
            if(schStockTyp) {
                $.ajax({
                    url: 'stocks-search/'+schStockTyp,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        console.log("Hi from Ajax");
                        $('#tableSearch').empty();
                        $.each(data, function(key, value) {
                            $('#tableSearch').append('<tr><td>'+value["StockId"]+'</td><td>'+value["StockNameAr"]+'</td><td>'+value["StockNameEn"]+'</td></tr>');
                        });
                    } 
                });    
            }else{
                $('#tableSearch').empty();
            }
        });
    </script>
    <script>
        /* $('#add-stocks').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var emp_name = button.data('emp_name')
            var empid = button.data('empid')
            var salary = button.data('salary')
            var newpremium = button.data('newpremium')
            var contribute = button.data('contribute')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #emp_name').val(emp_name);
            modal.find('.modal-body #empid').val(empid);
            modal.find('.modal-body #salary').val(salary);
            modal.find('.modal-body #newpremium').val(newpremium);
            modal.find('.modal-body #contribute').val(contribute);

        }); */

        $('#edit-stocks').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var stockidedit = button.data('stockidedit');
            var stocknamearedit = button.data('stocknamearedit');
            var stocknameenedit = button.data('stocknameenedit');
            var modal = $(this);

            modal.find('.modal-body #stockIdEdit').val(stockidedit);
            modal.find('.modal-body #stockNameArEdit').val(stocknamearedit);
            modal.find('.modal-body #stockNameEnEdit').val(stocknameenedit);
        });

        $('#delete-stocks').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var stockiddel = button.data('stockiddel')
            var stocknameardel = button.data('stocknameardel')
            var stocknameendel = button.data('stocknameendel')
            var modal = $(this)

            modal.find('.modal-body #stockIdDel').val(stockiddel);
            modal.find('.modal-body #stockNameArDel').val(stocknameardel);
            modal.find('.modal-body #stockNameEnDel').val(stocknameendel);
        })
        /* $('#delete-stocks').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('stockiddel')
            var emp_name = button.data('stocknameardel')
            var empid = button.data('stocknameendel')
            var modal = $(this)

            modal.find('.modal-body #stockIdDel').val(id);
            modal.find('.modal-body #stockNameArDel').val(emp_name);
            modal.find('.modal-body #stockNameEnDel').val(empid);
        }) */
    </script>
@endsection
