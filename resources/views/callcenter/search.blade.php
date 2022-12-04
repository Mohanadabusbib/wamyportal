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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.search') }}</span>
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
                        <form action="{{ route('benefactor.search') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-sm col-md">
                                    <label for="searchtype" class="control-label">{{ __('lable.searchtype') }}</label>
                                    <select name="searchtype" id="searchtype"class="form-control" onchange="return changelable()">
                                            <option value="1">جوال</option>
                                            {{-- <option value="2">محسن</option> --}}
                                        </select>
                                </div>
                                <div class="col-sm col-md">
                                    <label for="mobile" id="searchlable" class="control-label">{{ __('lable.mobile') }}</label>
                                    <input name="mobile" id="mobile" class="form-control"  required ></input>
                                    
                                </div>
                            </div>
                            <div class="d-flex justify-content-center" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-primary">{{ __('menu.search') }}</button>
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

    <script>
        function changelable(){
            var searchtypeselect = document.getElementById('searchtype').value,
            searchlable = document.getElementById('searchlable');
                if (searchtypeselect == 2) {
                    searchlable.innerHTML = "محسن"
                } else {
                    searchlable.innerHTML = "جوال"
                }
        }
        /* function checkphone() {
            var mobile = document.getElementById('mobile').value,
                mobile2 = document.getElementById('mobile2');
                /* alert(mobile.length); */
                if (mobile.length == 9) {
                    mobile2.value  = "0" + mobile;
                }else{
                    mobile2.value  =  mobile;
                }
        } */
    </script>
@endsection
