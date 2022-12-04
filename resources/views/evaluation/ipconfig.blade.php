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
                <h4 class="content-title mb-0 my-auto">{{__('menu.magar')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.ipconfig')}}</span>
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
                        <div class="d-flex justify-content-between mb-2">
                            <a data-toggle="modal" href="#addipmodal" class="modal-effect btn btn-outline-primary">
                                <i class="fas fa-plus">&nbsp; إضافة عنوان</i>
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap" style="font-size: 16px">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">العنوان</th>
                                        <th class="border-bottom-0">مفعل</th>
                                        <th class="border-bottom-0">المدخل</th>
                                        <th class="border-bottom-0">التفعيل</th>
                                        <th class="border-bottom-0">التعديل</th>
                                        <th class="border-bottom-0">الخذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($ipconfig as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $item->ip }}</td>
                                        <td>
                                            {{ $item->active ? "نعم": "لا" }}
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        
                                        <td>
                                            @if ($item->active)
                                                <button class="btn btn-warning" data-toggle="modal"
                                                data-id="{{ $item->id }}"
                                                data-empid="{{ $item->empid }}"
                                                data-ip="{{ $item->ip }}"
                                                data-active="{{ $item->active }}"
                                                data-target="#active_file">
                                                إلغاء    
                                                </button>
                                            @else
                                                <button class="btn btn-success" data-toggle="modal"
                                                data-id="{{ $item->id }}"
                                                data-empid="{{ $item->empid }}"
                                                data-ip="{{ $item->ip }}"
                                                data-active="{{ $item->active }}"
                                                data-target="#active_file">
                                                تفعيل    
                                                
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-dark" data-toggle="modal"
                                                data-id="{{ $item->id }}"
                                                data-empid="{{ $item->empid }}"
                                                data-ip="{{ $item->ip }}"
                                                data-target="#edit_file">
                                                تعديل
                                                </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-id="{{ $item->id }}"
                                                data-ip="{{ $item->ip }}"
                                                data-empid="{{ $item->empid }}"
                                                data-target="#delete_file">
                                                حذف
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
        <!-- row closed -->

        <!-- add -->
            <div class="modal" id="addipmodal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">إضافة عنوان</h6>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <form action="{{ route('Ipconfig.store')}}" method="post">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <label for="department_id">العنوان</label>
                                    <input class="form-control" type="text" name="ipAdd" id="ipAdd" placeholder="10.1.10.53" required>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" type="submit">{{__('lable.savebtn')}}</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('lable.closebtn')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <!-- add -->

        <!-- active -->
            <div class="modal fade" id="active_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تفعيل العنوان</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('Ipconfig.update',2)}}" method="post">
                            @method('patch')
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p class="text-center">
                                {{-- <h4 style="color:red">
                                    هل أنت متاكد من عملية الغاء العنوان ادناه؟
                                </h4> --}}
                                </p>
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="empid" id="empid" value="">
                                <input type="hidden" name="active" id="active" value="">
                                <input type="text" name="ipAdd" id="ipAdd" value="" readonly>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- active -->
        
        <!-- edit -->
            <div class="modal fade" id="edit_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل عنوان</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('Ipconfig.update',1)}}" method="post">
                            @method('patch')
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p class="text-center">
                                {{-- <h4 style="color:red">
                                    هل أنت متاكد من عملية الغاء العنوان ادناه؟
                                </h4> --}}
                                </p>
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="empid" id="empid" value="">
                                <input type="text" name="ipAdd" id="ipAdd" value="">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- edit -->

        <!-- delete -->
            <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إلغاء عنوان</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('Ipconfig.destroy',10)}}" method="post">
                            @method('delete')
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p class="text-center">
                                <h4 style="color:red">
                                    هل أنت متاكد من عملية الغاء العنوان ادناه؟
                                </h4>
                                </p>
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="empid" id="empid" value="">
                                <input type="text" name="ipAdd" id="ipAdd" value="" readonly>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- delete -->
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
        var ip = button.data('ip')
        var empid = button.data('empid')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #ipAdd').val(ip);
        modal.find('.modal-body #empid').val(empid);
    })
    $('#edit_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var ip = button.data('ip')
        var empid = button.data('empid')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #ipAdd').val(ip);
        modal.find('.modal-body #empid').val(empid);
    })
    $('#active_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var ip = button.data('ip')
        var empid = button.data('empid')
        var active = button.data('active')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #ipAdd').val(ip);
        modal.find('.modal-body #empid').val(empid);
        modal.find('.modal-body #active').val(active);
    })
</script>
@endsection
