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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.report')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
        <!-- row -->
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
                                        <th class="border-bottom-0">الإعتماد</th>
                                        <th class="border-bottom-0">رفض</th>
                                        <th class="border-bottom-0">تاريخ التعين</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach ($orders as $item)
                                    <?php $i++ ?>
                                    <tr>
                                        <td style="font-size: 18px">{{$i}}</td>
                                        <td style="font-size: 18px">{{ $item->name }}</td>
                                        <td style="font-size: 18px">
                                            @if ($item->status == 1)
                                                معتمد
                                            @else
                                                {{-- @can('proc-delete-savings') --}}
                                                    <button class="btn btn-success " data-toggle="modal"
                                                    data-emp_name="{{ $item->name }}" data-id="{{ $item->id }}"
                                                    data-empid="{{ $item->empid }}"
                                                    data-target="#approval_file">
                                                    الإعتماد
                                                    </button>
                                                {{-- @endcan     --}}
                                            @endif
                                            
                                        </td>
                                        <td style="font-size: 18px">
                                            @if ($item->status != 1)
                                                {{-- @can('proc-delete-savings') --}}
                                                    <button class="btn btn-danger " data-toggle="modal"
                                                    data-emp_name="{{ $item->name }}" data-id="{{ $item->id }}"
                                                    data-empid="{{ $item->empid }}"
                                                    data-target="#delete_file">
                                                    رفض
                                                    </button>
                                                {{-- @endcan     --}}
                                            @endif
                                            
                                        </td>
                                        <td style="font-size: 18px">{{ $item->start_date }}</td>
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
        
        <!-- approval -->
        <div class="modal fade" id="approval_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إعتماد الإشتراك</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('registrAuction.update',1)}}" method="POST">
                        @method('PATCH')
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            <h4 style="color:red">
                                هل أنت متاكد من عملية إعتماد إشتراك للموظف ادناه؟
                            </h4>
                            </p>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="text" name="emp_name" id="emp_name" value="" readonly>
                            <input type="hidden" name="empid" id="empid" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-success">إعتماد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- delete -->
        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف الإشتراك</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('registrAuction.destroy',1)}}" method="POST">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            <h4 style="color:red">
                                هل أنت متاكد من عملية حذف إشتراك للموظف ادناه؟
                            </h4>
                            </p>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="text" name="emp_name" id="emp_name" value="" readonly>
                            <input type="hidden" name="empid" id="empid" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
    $('#approval_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var emp_name = button.data('emp_name')
        var empid = button.data('empid')
       
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #emp_name').val(emp_name);
        modal.find('.modal-body #empid').val(empid);

    })
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
