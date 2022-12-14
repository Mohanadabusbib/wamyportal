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
                <h4 class="content-title mb-0 my-auto">{{ __('menu.savings') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.displaynomination') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row">
        
            <div class="card w-100">
                <div class="card-body">
                    
                {{--  @if (!count($corona))
                        {{ session()->put('error', __('msg.noDataToday')) }}
                        @include('alerts.error')
                    @endif --}}
                    <div class="row row-sm">
                        @foreach ($nomination as $item)
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="card text-center">
                                    <img class="card-img-top avatar-card" src="{{ $item->avatar }}" alt="">
                                    <div class="card-body">
                                        <h1 class="card-title mb-3">{{ $item->name }}</h1>
                                        <p class="card-text"><strong>?????????? ?????????????? :</strong> {{ $item->empid }}</p>
                                        <p class="card-text"><strong>?????????????? :</strong> {{ $item->dept ? $item->dept  : "?????????????? ????????????"}}</p>
                                        <p class="card-text"> <strong>?????????? :</strong> {{ $item->sectn ? $item->sectn : "?????????????? ????????????"}}</p>
                                        <p class="card-text"><strong>?????????????? ?????????????? :</strong> {{ $item->job ? $item->job : "?????????????? ????????????"}}</p>
                                        <p class="card-text"><strong>???????????? ???????????? :</strong> {{ $item->qualification ? $item->qualification : "?????????????? ????????????"}}</p>
                                        <p class="card-text">
                                            <strong>???????????? ???????????? ???? :</strong>
                                            @switch($item->candidateposition)
                                                @case(1)
                                                ???????? ?????????????? ????????????????
                                                    @break
                                                @case(2)
                                                ???????? ???????? ?????????? ??????????????
                                                    @break
                                                @case(3)
                                                ???????? ???????? ???????? ?????????? ??????????????
                                                    @break
                                                @case(4)
                                                ?????? ???????? ?????????? ??????????????
                                                    @break
                                                @default
                                                ?????????????? ????????????
                                            @endswitch
                                        </p>
                                        <p class="card-text"><strong>???????????? :</strong> {{ $item->mobile ? $item->mobile : "?????????????? ????????????"}}</p>
                                        @if ($item->file)
                                            <a href="{{route('getcvfile',$item->file)}}" class="btn btn-primary">???????????? ??????????????</a>    
                                        @else
                                            <a href="#" class="btn btn-primary">?????????????? ???????? ?????????? </a>
                                        @endif
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        

    </div>
    <!-- /row -->
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
