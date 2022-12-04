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
                <h4 class="content-title mb-0 my-auto">{{__('menu.savings')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ لجنة الصندوق</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
        <!-- row -->
        
            @if (!count($orders))
                <div class="card bd-0 mg-b-20 bg-danger">
                    <div class="card-body text-white">
                        <div class="main-error-wrapper">
                            <i class="si si-close mg-b-20 tx-50"></i>
                            <h4 class="mg-b-0">لا يوجد طلبات</h4>
                        </div>
                    </div>
                </div>
            @else
                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table key-buttons text-md-nowrap" style="font-size: 16px">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">رقم الطلب</th>
                                                <th class="border-bottom-0">مقدم الطلب</th>
                                                
                                                <th class="border-bottom-0"> الطلب</th>
                                                
                                                <th class="border-bottom-0">التحليل</th>
                                                <th class="border-bottom-0">القيمة الشرائية</th>
                                                @if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11547 || Auth()->user()->empid == 11099)
                                                <th class="border-bottom-0">حالة الطلب</th>
                                                @endif
                                                <th class="border-bottom-0">العقد</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $item)
                                                @if ($item->evaluation == 1 && $item->fStatus == 1)
                                                    <tr style="background-color: lightgreen">
                                                        <td>
                                                            <a href="{{route('contractOrder',$item->id)}}"> {{$item->id}} </a>  
                                                        </td>
                                                @elseif ($item->evaluation == 2)
                                                    <tr style="background-color: lightcoral">
                                                        <td> {{$item->id}} </td>
                                                @elseif($item->evaluation == 1 && $item->fStatus == 2)
                                                    <tr style="background-color: #e3d4b1">
                                                        <td> {{$item->id}} </td>
                                                @endif
                                                
                                                    
                                                    <td>{{ $item->emp }}</td>
                                                    <td>{{ $item->Order }}</td>
                                                    <td>{{ $item->reson }}</td>
                                                    <td>{{ number_format($item->purchasingValue, 2) }}</td> 
                                                    <td>
                                                        @if ($item->evaluation == 1 && $item->fStatus == 1)
                                                            @can('proc-delete-savings')
                                                                @if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11547 || Auth()->user()->empid == 11099)
                                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                                        data-emp_name="{{ $item->emp }}" data-id="{{ $item->id }}"
                                                                        data-empid="{{ $item->empid }}"
                                                                        data-target="#delete_file">
                                                                        رفض الطلب
                                                                    </button>
                                                                @endif
                                                            @endcan    
                                                        @elseif ($item->evaluation == 2)
                                                            تم رفض الطلب 
                                                        @elseif($item->evaluation == 1 && $item->fStatus == 2)
                                                            تم طباعة عقد
                                                        @endif
                                                    </td>          
                                                    <td>
                                                        @if($item->evaluation == 1 && $item->fStatus == 2)
                                                              
                                                            <button type="button" class="btn btn-warning">
                                                                <a href="{{route('printcontractOrder',$item->id)}}"> طباعة العقد </a>
                                                            </button>
                                                        @endif
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
            @endif
            
            <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">رفض الطلب</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('boxOrders.destroy',1)}}" method="post">
                            {{ csrf_field() }}
                            @method('delete')
                            <div class="modal-body">
                                <p class="text-center">
                                <h4 style="color:red">
                                    هل أنت متاكد من عملية رفض الطلب للموظف ادناه؟
                                </h4>
                                </p>
                                <input type="hidden" name="id" id="id" value="">
                                <input type="text" name="emp_name" id="emp_name" value="" disabled>
                                <input type="hidden" name="emp_name" id="emp_name" value="">
                                <input type="hidden" name="empid" id="empid" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- row closed -->
        
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

<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var emp_name = button.data('emp_name')
        var empid = button.data('empid')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #emp_name').val(emp_name);
        modal.find('.modal-body #empid').val(empid);
        

    })
</script>

@endsection
