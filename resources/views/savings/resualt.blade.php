@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    {{-- <meta http-equiv="refresh" content="30"/> --}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('menu.savings') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.voteresualt') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card  bg-danger-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div>
                            <h2 class="tx-white-8 mb-3">عدد المشتركين بالصندوق</h2>
                            <h3 class="counter mb-0 text-white">{{$countsaving}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-md-6">
            <div class="card  bg-danger-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div>
                            {{-- <h5 class="tx-13 tx-white-8 mb-3">إجمالي المصويتين</h5> --}}
                            <h2 class="tx-white-8 mb-3">عدد المصوتين</h2>
                            <h3 class="counter mb-0 text-white">
                                {{-- @foreach ($countvote as $item)
                                    {{$item->votes}}
                                @endforeach --}}
                                @foreach ($totleote as $item)
                                    @if ($item->candidatePosition == 1)
                                        {{$item->vote}}
                                    @endif
                                @endforeach
                               {{--  @foreach ($test as $item)
                                @if ($item->candidatePosition == 1)
                                    <h5 class="counter mb-1 text-white">{{$item->vote}}</h5>
                                @endif
                            @endforeach --}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">       
        <div class="col-lg-6 col-md-6">
            <div class="card  bg-primary-gradient">
                <h2 class="tx-white-8 m-3">رئيس الجمعية العمومية</h2>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">المرشح</th>
                                <th scope="col">عدد الاصوات</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($test as $item)
                                @if ($item->candidatePosition == 1)
                                <tr>
                                    <td>
                                        <h5 class="counter mb-1 text-white">{{$item->name}}</h5>
                                    </td>
                                    <td>
                                        <h5 class="counter mb-1 text-white">
                                            <h5 class="counter mb-1 text-white">{{$item->vote}}</h5>
                                        </h5>
                                    </td>
                                    
                                </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td><h5 class="counter mb-1 ">إجمالي الأصوات</h5></td>
                                <td>
                                    <h5 class="counter mb-1">
                                        @foreach ($totleote as $item)
                                            @if ($item->candidatePosition == 1)
                                                {{$item->vote}}
                                            @endif
                                        @endforeach
                                    </h5>
                                </td>
                            </tr>
                            
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card  bg-primary-gradient">
                <h2 class="tx-white-8 m-3">رئيس مجلس إدارة الصندوق</h2>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">المرشح</th>
                                <th scope="col">عدد الاصوات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($test as $item)
                                @if ($item->candidatePosition == 2)
                                <tr>
                                <td>
                                    <h5 class="counter mb-1 text-white">{{$item->name}}</h5>
                                </td>
                                <td>
                                    <h5 class="counter mb-1 text-white">{{$item->vote}}</h5>
                                </td>
                                <td>
                                    {{-- @foreach ($approval as $item)
                                        @if ($item->candidatePosition == 2)
                                        <h5 class="counter mb-1 text-white">{{$item->vote}}</h5>    
                                        @endif
                                    @endforeach --}}
                                    
                                </td>
                                </tr>   
                                @endif
                            @endforeach
                            <tr>
                                <td><h5 class="counter mb-1 ">إجمالي الأصوات</h5></td>
                                <td>
                                    <h5 class="counter mb-1">
                                        @foreach ($totleote as $item)
                                            @if ($item->candidatePosition == 2)
                                                {{$item->vote}}
                                            @endif
                                        @endforeach
                                    </h5>
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card  bg-primary-gradient">
                <h2 class="tx-white-8 m-3">نائب رئيس مجلس إدارة الصندوق</h2>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">المرشح</th>
                                <th scope="col">عدد الاصوات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($test as $item)
                            <tr>
                                @if ($item->candidatePosition == 3)
                                <td>
                                    <h5 class="counter mb-1 text-white">{{$item->name}}</h5>
                                </td>
                                <td>
                                    <h5 class="counter mb-1 text-white">{{$item->vote}}</h5>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td><h5 class="counter mb-1 ">إجمالي الأصوات</h5></td>
                                <td>
                                    <h5 class="counter mb-1">
                                        @foreach ($totleote as $item)
                                            @if ($item->candidatePosition == 3)
                                                {{$item->vote}}
                                            @endif
                                        @endforeach
                                    </h5>
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card  bg-primary-gradient">
                <h2 class="tx-white-8 m-3">عضو مجلس إدارة الصندوق</h2>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">المرشح</th>
                                <th scope="col">عدد الاصوات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($test as $item)
                                @if ($item->candidatePosition == 4)
                                    <tr>
                                        <td>
                                            <h5 class="counter mb-1 text-white">{{$item->name}}</h5>
                                        </td>
                                        <td>
                                            <h5 class="counter mb-1 text-white">{{$item->vote}}</h5>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td><h5 class="counter mb-1 ">إجمالي الأصوات</h5></td>
                                <td>
                                    <h5 class="counter mb-1">
                                        @foreach ($totleote as $item)
                                            @if ($item->candidatePosition == 4)
                                                {{$item->vote}}
                                            @endif
                                        @endforeach
                                    </h5>
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    <br><br>
    <hr>

    <div class="row">
        <h2>إعادة التصويت</h2> 
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card  bg-danger-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div>
                            <h2 class="tx-white-8 mb-3">عدد المصوتين</h2>
                            <h3 class="counter mb-0 text-white">
                                <h5 class="counter mb-1 text-white">{{$countNewvoter}}</h5>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card  bg-primary-gradient">
                <h2 class="tx-white-8 m-3">عضو مجلس إدارة الصندوق</h2>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">المرشح</th>
                                <th scope="col">عدد الاصوات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($test2 as $item)
                                @if ($item->candidatePosition == 4)
                                    <tr>
                                        <td>
                                            <h5 class="counter mb-1 text-white">{{$item->name}}</h5>
                                        </td>
                                        <td>
                                            <h5 class="counter mb-1 text-white">{{$item->vote}}</h5>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td><h5 class="counter mb-1 ">إجمالي الأصوات</h5></td>
                                <td>
                                    <h5 class="counter mb-1">
                                        {{$countNewvoter}}
                                        {{-- @foreach ($totleote as $item)
                                            @if ($item->candidatePosition == 4)
                                                {{$item->vote}}
                                            @endif
                                        @endforeach --}}
                                    </h5>
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
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

    {{-- <script>
        setTimeout(function() {
            location.reload();
        }, 20000);
    </script> --}}
    
    
@endsection
