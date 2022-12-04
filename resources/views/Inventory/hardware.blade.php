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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأجهزة</span>
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
                    <button class="btn btn-primary " data-toggle="modal"
                            data-id="{{ $hardwareId }}" data-target="#delete_file">
                        إضافة جهاز
                    </button>
                   {{--  <button class="btn btn-danger btn-sm" data-toggle="modal"
                    data-emp_name="{{ $item->name }}" data-id="{{ $item->id }}"
                    data-empid="{{ $item->empid }}"
                    data-salary="{{ $item->salary }}"
                    data-newpremium="{{ $item->newpremium }}"
                    data-contribute="{{ $item->contribute }}"
                    data-target="#delete_file">
                        إلغاء إشتراك
                    </button> --}}
                    <div class="table-responsive">                          
                        <thead>
                            <tr>
                                <th class="border-bottom-0">رقم</th>
                                <th class="border-bottom-0">الجهاز</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hardwares as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{ $item->name }}</td>
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
    <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة جهاز</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('Hardware.store')}}" method="post">
                    {{-- @method('delete') --}}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        {{-- <h4 style="color:red">
                            هل أنت متاكد من عملية الغاء الإشتراك للموظف ادناه؟
                        </h4> --}}
                        </p>
                        <label for="id">رقم الجهاز</label>
                        <input class="form-control" type="text" name="id" id="id" value="" readonly>
                        <label for="name">الجهاز</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
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
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            
        })
    </script>
@endsection
