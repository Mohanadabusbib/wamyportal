@extends('layouts.master')
@section('css')
    <!--- Internal Sweet-Alert css-->
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('public/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('public/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/sumoselect/sumoselect-rtl.css') }}">

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('menu.callCneter') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.transaction') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    @foreach ($tickets as $item)
                        <form action="{{ route('callcenter.update',$item->id) }}" method="post" enctype="multipart/form-data"
                            autocomplete="off" onsubmit="return validateForm()">
                            @method('PATCH')
                            {{ csrf_field() }}
                            
                            <div class="row ">
                                <div class="col-sm col-md">
                                    <label for="purposecal" class="control-label">{{ __('lable.callerid') }}</label>
                                    <input type="text" name="callerid" class="form-control" readonly  value="{{ $item->callerid }}"></input>
                                </div>
                                <div class="col-sm col-md">
                                    <label for="callername" class="control-label">{{ __('lable.callername') }}</label>
                                    <input type="text" name="callername" class="form-control"  readonly value="{{ $item->callername }}"></input>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm col-md">
                                    <label for="purposecal" class="control-label">{{ __('lable.purposecal') }}</label>
                                    <textarea name="purposecal" id="purposecal" class="form-control" readonly>{{ $item->purposecal }}</textarea>
                                </div>
                                <div class="col-sm col-md">
                                    <label for="note" class="control-label">{{ __('lable.note') }}</label>
                                    <textarea name="note" id="note" class="form-control" readonly>{{ $item->note }}</textarea>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm col-md">
                                    <label for="procedure" class="control-label">{{ __('lable.procedure') }}</label>
                                    <textarea name="procedure" id="procedure" class="form-control"></textarea>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm col-md">
                                    <br><br>
                                    <label style="font-size: 16px">
                                        <input type="checkbox" id="transactionclose" name="transactionclose">
                                        <strong>
                                            {{__('lable.transactionclose')}}
                                        </strong>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-primary">{{ __('lable.savebtn') }}</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
            <div style="margin-bottom: 180px"></div>
        </div>

    </div>
    <!-- row closed -->

@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('public/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ URL::asset('public/assets/js/sweet-alert.js') }}"></script>
    <script src="{{URL::asset('public/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>

    
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();        
    </script>
@endsection
