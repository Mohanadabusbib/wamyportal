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
                <h4 class="content-title mb-0 my-auto">{{__('menu.callCneter')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.alltikets')}}</span>
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
                                    <tr class="text-dark">
                                        <th>رقم الطلب</th>
                                        <th>تاريخ الطلب</th>
                                        <th>صاحب الطلب</th>
                                        <th>الغرض من الإتصال</th>
                                        <th>الإجراء</th>
                                        <th>تحويل الطلب </th>
                                        <th>حالة الطلب</th>
                                        <th>مستفبل الطلب</th>
                                    </tr>
                                </thead>
                                <tbody id="databody">
                                    <?php $i = 0; ?>
                                    @foreach ($tickets as $x)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>
                                                <a href="{{route('ticketdetails',$x->id)}}">{{ $x->id }}</a>
                                            </td>
                                            <td>{{ $x->created_at }}</td>
                                            <td>{{ $x->callername }}</td>
                                            <td>{{ $x->purposecal }}</td>
                                            <td>{{ $x->procedure }}</td>
                                            <td>
                                                @if ($x->transftransctn == 1)
                                                {{ $x->transferto }}
                                                @else
                                                    لم تحول
                                                @endif
                                            </td>
                                            @if ($x->status == 1)
                                                <td><span
                                                        class="badge badge-pill badge-success">مفتوحة</span>
                                                </td>
                                            @elseif($x->status ==2)
                                                <td><span
                                                        class="badge badge-pill badge-warning">تحت الإجراء</span>
                                                </td>
                                            @else
                                                <td><span
                                                        class="badge badge-pill badge-danger">مغلقة</span>
                                                </td>
                                            @endif
                                            <td>
                                                {{$x->recivecall}}
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

@endsection
