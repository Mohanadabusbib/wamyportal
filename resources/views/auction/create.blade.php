@extends('layouts.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--- Internal Sweet-Alert css-->
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('public/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('public/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <style>
        .centerized{
            margin: 20px auto;
        }
    </style>
    
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">مزاد بيع السيارات</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة سيارة</span>
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
            <div class="col-lg-9 col-md-6 centerized">
                <div class="card">
                    <div class="card-body">
                        <form id="addSavings" action="{{ route('boxOrders.store') }}"
                            method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                                <input type="hidden" id="typeEnter" name="typeEnter" value="0">
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="empid" class="control-label">النوع</label>
                                        {{-- <input type="text"  id="empid" name="empid"> --}}
                                        <select name="" id="" class="form-control">
                                            <option value="">Item-1</option>
                                            <option value="">Item-2</option>
                                            <option value="">Item-3</option>
                                            <option value="">Item-4</option>
                                            <option value="">Item-5</option>
                                        </select>
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="name" class="control-label">اللون</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Item-1</option>
                                            <option value="">Item-2</option>
                                            <option value="">Item-3</option>
                                            <option value="">Item-4</option>
                                            <option value="">Item-5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">الصور</label>
                                        <input type="file" class="form-control" id="nationalty" name="nationalty" multiple>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">الموديل</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">2011</option>
                                            <option value="">2012</option>
                                            <option value="">2013</option>
                                            <option value="">2014</option>
                                            <option value="">2015</option>
                                        </select>
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">الكيلوميترات</label>
                                        <input type="number" class="form-control" id="numberEl" name="nationalty">
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">سعر البيع</label>
                                        <input type="number" class="form-control" id="numberEl" name="nationalty">
                                    </div>
                                </div>
                                
                                <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" id="savelink" class="btn btn-primary">
                                        إضافة سيارة
                                    </button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('public/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    {{-- <script src="sweetalert2/dist/sweetalert2.all.min.js"></script> --}}
    

    <script src="{{URL::asset('public/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/sweet-alert.js')}}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>
    <script>
       /* $("[type='number']").keypress(function (evt) {
            evt.preventDefault();
            
        }); */
        
            
    </script>

@endsection
