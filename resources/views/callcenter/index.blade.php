@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('menu.callCneter') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.calls') }}</span>
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
                        <table id="example3" class="table key-buttons text-md-nowrap" style="font-size:16px">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">{{ __('lable.unit') }}</th>
                                    <th class="border-bottom-0">{{ __('lable.callerid') }}</th>
                                    <th class="border-bottom-0">{{ __('lable.callerating') }}</th>
                                    <th class="border-bottom-0">{{ __('lable.callername') }}</th>
                                    <th class="border-bottom-0">{{ __('lable.delegate') }}</th>
                                    <th class="border-bottom-0">{{ __('lable.receipts') }}</th>
                                    <th class="border-bottom-0">{{ __('lable.previousorder') }}</th>
                                    <th class="border-bottom-0">{{ __('lable.neworder') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($data); $i++)
                                    <tr>
                                        <td>{{$data[$i]['unt_sh_l_nm']}}</td>
                                        <td>{{$data[$i]['dnr_no']}}</td>
                                        <td>{{$data[$i]['bgn_crspnd_lnm']}}</td>
                                        <td>{{$data[$i]['dnr_lnm']}}</td>
                                        <td>{{$data[$i]['agnt_name']}}</td>
                                        <td>
                                            <a href="{{ route('benefactoreceipts',$data[$i]['dnr_no'])}}" class="btn btn-primary">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('callcenter.show',$data[$i]['dnr_no']) }}" class="btn btn-primary">
                                                <i class="fas fa-phone-slash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('callerInfo',[$data[$i]['dnr_no'],$data[$i]['dnr_lnm'],$data[$i]['agnt_name'],$data[$i]['bgn_crspnd_lnm']])}}" class="btn btn-primary">
                                                <i class="fas fa-phone-volume"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
    <div class="row row-sm" style="color: white; font-weight: bold">
        {{-- <button id="answer"> Answer </button> --}}
        {{-- <a id="answer" class="btn btn-primary"> Answer <i class="fas fa-file-invoice"></i></a> --}}
        {{-- <a id="answer" class="btn btn-primary"> الرد علي المكالمة <i class="fas fa-phone"></i></a> --}}
        {{-- @include('callcenter.answer') --}}
    </div>
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('public/assets/js/table-data.js') }}"></script>
    

    
@endsection
