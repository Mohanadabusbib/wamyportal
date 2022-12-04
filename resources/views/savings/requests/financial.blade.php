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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ التحليل المالي</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
        <!-- row -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @if (!count($orders))
                <div class="card bd-0 mg-b-20 bg-danger">
                    <div class="card-body text-white">
                        <div class="main-error-wrapper">
                            <i class="si si-close mg-b-20 tx-50"></i>
                            <h4 class="mg-b-0">لايوجد طلبات للتحليل المالي</h4>
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
                                                <th class="border-bottom-0">تاريخ الطلب</th>
                                                <th class="border-bottom-0">مقدم الطلب</th>
                                                <th class="border-bottom-0">نوع الطلب</th>
                                                <th class="border-bottom-0">الطلب</th>
                                                <th class="border-bottom-0">القيمة الشرائية</th>
                                                <th class="border-bottom-0">الكافل</th>
                                                <th class="border-bottom-0">الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($orders as $item)
                                            <tr>
                                                <td> 
                                                  {{-- fstatus =
                                                    0 => جديد   =>  
                                                    1 => تم إعتماد الطلب   => No Entry
                                                    2 => تم رفض الطلب   => New
                                                    3 => طباعة العقد - إغلاق الطلب   => New --}}
                                                
                                                    @if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11402)
                                                        @if($item->status == 'طباعة العقد')    
                                                            <a href="{{route('getOrderData',$item->id)}}"> {{$item->id}} </a>
                                                        @elseif ($item->fStatus == 2 || $item->bStatus == 3)
                                                            <a href="{{route('getOrderData',$item->id)}}"> {{$item->id}} </a>
                                                        @elseif ($item->status  ==='جديد' || $item->status  === 'تم إعتماد الطلب' || $item->status  === 'موافقة الكافل' || $item->status === 'رفض الكافل')  {{--  جديد / تعديل --}}
                                                            <a href="{{route('financial.show',$item->id)}}"> {{$item->id}} </a>
                                                        @else
                                                            {{$item->id}}
                                                        @endif  
                                                    @else
                                                    {{$item->id}} 
                                                    @endif
                                                    {{-- @if ($item->lastUser == NULL) --}}
                                                    
                                                    
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->emp }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->Order }}</td>
                                                <td>{{ number_format($item->purchasingValue, 2) }}</td>                                        
                                                <td> {{ $item->sponsor ? $item->sponsor : "بدون كافل"}} </td>
                                                <td>
                                                    @if ($item->status == "موافقة الكافل")
                                                        <label class="btn btn-info">موافقة الكافل</label>
                                                    @elseif($item->status == "رفض الكافل")
                                                        <label class="btn btn-warning">رفض الكافل</label>
                                                    @elseif($item->status == "جديد")
                                                        <label class="btn btn-primary">جــــديد</label>
                                                    @elseif($item->status == "تم إعتماد الطلب")
                                                        <label class="btn btn-success">تم إعتماد الطلب</label>
                                                    @elseif($item->status == "تم رفض الطلب")
                                                        <label class="btn btn-danger">تم رفض الطلب</label>
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
