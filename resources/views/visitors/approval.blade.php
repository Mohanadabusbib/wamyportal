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
                <h4 class="content-title mb-0 my-auto">{{__('menu.wamyVisitors')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.visitApprovel')}}</span>
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
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">{{__('lable.visitDate')}}</th>
                                        <th class="border-bottom-0">{{__('lable.visitName')}}</th>
                                        <th class="border-bottom-0">{{__('lable.department')}}</th>
                                        <th class="border-bottom-0">{{__('lable.section')}}</th>
                                        <th class="border-bottom-0">{{__('lable.visitpurpose')}}</th>
                                        <th class="border-bottom-0">{{__('lable.procedure')}}</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitors as $item)
                                    <tr>
                                        <td>{{$item->vdate}}</td>
                                        <td>{{ $item->vname }}</td>
                                        <td>{{$item->department->name}}</td>
                                        <td>{{$item->section->name}}</td>
                                        <td>{{ $item->vpurpose }}</td>
                                        <td>
                                            @if ($item->approved == 1)
                                                <label class="btn btn-success">تم قبول الطلب</label>
                                            @elseif ($item->approved == 2)
                                                <label class="btn btn-danger">تم رفض الطلب</label>
                                            @else
                                            @can('proc-approval-visit')
                                                    <div style="display: flex; justify-content: space-around;">
                                                        <form action="{{route('visitors.update',[$item->id])}}" method="post">
                                                            {{ csrf_field() }}
                                                            @method('patch')
                                                            <input type="hidden" name="approved" value="1">
                                                            <button type="submit"  class="btn btn-success">قبول</button>
                                                        </form>
                                                        <form action="{{route('visitors.update',[$item->id])}}" method="post">
                                                            {{ csrf_field() }}
                                                            @method('patch')
                                                            <input type="hidden" name="approved" value="2">
                                                            <button type="submit"  class="btn btn-danger">رفض</button>
                                                        </form>
                                                    </div>                                            
                                                    
                                                @endcan
                                                @cannot('proc-approval-visit')
                                                    <label class="btn btn-primary">جديد</label>    
                                                @endcannot
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

        <!-- row closed -->
    </div>
    <!-- Container closed -->
</div>
<!-- main-content closed -->
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
