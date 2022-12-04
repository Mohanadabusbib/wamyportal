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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الكفالة</span>
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
                        <h4 class="mg-b-0">عفوا ليس لديك طلب كفالة</h4>
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
                                        <th class="border-bottom-0">طالب الكفالة</th>
                                        <th class="border-bottom-0">نوع الطلب</th>
                                        <th class="border-bottom-0">القيمة الشرائية</th>
                                        <th class="border-bottom-0">الحالة</th>
                                        <th class="border-bottom-0">العمليات</th>

                                        {{-- <th class="border-bottom-0">إلغاء إشتراك</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{ $item->emp }}</td>
                                        <td>{{ $item->name }}</td>

                                        <td>{{ $item->purchasingValue }}</td>
                                        {{-- <td>{{ $item->salary }}</td>
                                        <td>{{ $item->deductionsHr }}</td>
                                        <td>{{ $item->deductionsBox }}</td>
                                        <td>{{ $item->sponsors }}</td> --}}
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-id="{{ $item->id }}"
                                            data-empid="{{ $item->empid }}"
                                            data-name="{{ $item->emp }}"
                                            data-value="1"
                                            data-target="#approval">
                                                إعتماد
                                            </button>
                                            ||
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-id="{{ $item->id }}"
                                            data-empid="{{ $item->empid }}"
                                            data-name="{{ $item->emp }}"
                                            data-value="2"
                                            data-target="#approval">
                                                رفض
                                            </button>
                                            
                                        </td>
                                        {{-- <td>{{ number_format($item->, 2) }}</td>
                                        <td>{{number_format($item->contribute, 2)}}</td>
                                        --}}
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
        <!-- row closed -->
        
        <!-- approval -->
        <div class="modal fade" id="approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إعتماد الكافل</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('sponsor.update',1) }}" method="POST">
                        @method('PATCH')
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label for="">التوقيع</label>
                            @if ($signaturefile == 'defualt.png')
                                <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="signature" class="dropify"
                                        accept=".jpg, .png, image/jpeg, image/png" data-height="70" required/>
                                </div>
                            @else
                                <img name="signature" style="width: 10%" src="{{ asset('public/storage/Signature/'.$signaturefile) }}" alt="Sign">
                            @endif
                            <input type="hidden" name="id" id="id" value="" placeholder="id">
                            <input type="hidden" name="empid" id="empid" value="" placeholder="empid">
                            <input type="hidden" name="emp_name" id="emp_name" value="" placeholder="emp_name">
                            <input type="hidden" name="value" id="value" value="" placeholder="value">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                            <button type="submit" id="btn" class="btn ">تاكيد</button> 
                            
                            
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
<script>

    $('#approval').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var empid = button.data('empid')
        var emp_name = button.data('name')
        var value = button.data('value')
        
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #emp_name').val(emp_name);
        modal.find('.modal-body #empid').val(empid);
        modal.find('.modal-body #value').val(value);

        var btn = document.getElementById('btn');
        if (value == 1) {
            btn.innerHTML = "موافق";
            btn.classList.remove("btn-danger");
            btn.classList.add("btn-success");
            
            
        } else {
            btn.innerHTML = "رفض";
            btn.classList.remove("btn-success");
            btn.classList.add("btn-danger");
            
        }
        

    })
</script>
@endsection
