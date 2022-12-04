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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.ticketCallCenter') }}</span>
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
                        <form action="{{ route('callcenter.store') }}" method="post" enctype="multipart/form-data"
                            autocomplete="off" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            <div class="row ">
                                <div class="col-sm col-md">
                                    <label for="purposecal" class="control-label">{{ __('lable.callerid') }}</label>
                                    <input type="text" name="callerid" class="form-control" disabled value="{{$dnr_no}}"></input>
                                    <input type="hidden" name="callerid" class="form-control" value="{{$dnr_no}}"></input>
                                </div>
                                <div class="col-sm col-md">
                                    <label for="callerating" class="control-label">{{ __('lable.callerating') }}</label>
                                    <input type="text" name="callerating" class="form-control" disabled value="{{$bgn_crspnd_lnm}}"></input>
                                    <input type="hidden" name="callerating" class="form-control"  value="{{$bgn_crspnd_lnm}}"></input>
                                </div>
                                <div class="col-sm col-md">
                                    <label for="callername" class="control-label">{{ __('lable.callername') }}</label>
                                    <input type="text" name="callername" class="form-control" disabled value="{{$dnrName}}"></input>
                                    <input type="hidden" name="callername" class="form-control" value="{{$dnrName}}"></input>
                                </div>

                                <div class="col-sm col-md">
                                    <label for="delegate" class="control-label">{{ __('lable.delegate') }}</label>
                                    <input type="text" name="delegate" class="form-control" disabled value="{{$agnt_name}}"></input>
                                    <input type="hidden" name="delegate" class="form-control" value="{{$agnt_name}}"></input>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm col-md">
                                    <label for="purposecal" class="control-label">{{ __('lable.purposecal') }}</label>
                                    <textarea name="purposecal" id="purposecal" class="form-control"></textarea>
                                </div>
                                <div class="col-sm col-md">
                                    <label for="procedure" class="control-label">{{ __('lable.procedure') }}</label>
                                    <textarea name="procedure" id="procedure" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm col-md">
                                    <label for="note" class="control-label">{{ __('lable.note') }}</label>
                                    <textarea name="note" id="note" class="form-control"></textarea>
                                </div>
                                <div class="col-sm col-md">
                                    <br><br>
                                    <label style="font-size: 16px">
                                        <input type="checkbox" id="transftransctn" name="transftransctn" onchange="showlink()">
                                        <strong>
                                            {{__('lable.transftransctn')}}
                                        </strong>
                                    </label>
                                </div>
                            </div>
                            <div class="row" id="message" style="display: none">
                                <div class="col-sm col-md">
                                    <label for="transferto" class="control-label">{{ __('lable.transftransctnto') }}</label>
                                    <select class="form-control" name="transferto">
                                        <option value="0">الرجاء إختيار الموظف المراد</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->empid}}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm col-md">
                                    <label for="transfermessage" class="control-label">{{ __('lable.message') }}</label>
                                    <textarea name="transfermessage" id="transfermessage" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-primary">{{ __('lable.savebtn') }}</button>
                            </div>
                        </form>
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

        function showlink() {
            var check = document.getElementById('transftransctn'),
            message = document.getElementById('message');
            if (check.checked) {
                message.style.display = "flex";
            } else {
                message.style.display = "none";
            }
        }

        
    </script>
@endsection
