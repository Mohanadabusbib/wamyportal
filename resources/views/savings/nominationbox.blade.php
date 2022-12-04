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
                <h4 class="content-title mb-0 my-auto">{{ __('menu.savings') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.nominationbox') }}</span>
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


        @if($nomination != null)
            <div class="card w-100 bd-0 mg-b-20 bg-danger">
                <div class="card-body text-white">
                    <div class="main-error-wrapper">
                        <i class="si si-close mg-b-20 tx-50"></i>
                        <h4 class="mg-b-0">إستوفيت عدد مرات الترشح</h4>
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storenomination') }}" method="post" enctype="multipart/form-data"
                            autocomplete="off">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label">{{ __('lable.empId') }}</label>
                                    <input type="text" class="form-control" id="empid" name="empid" readonly value="{{ $data[0]['emp_no'] }}">
                                </div>
                                <div class="col">
                                    <label for="name" class="control-label">{{ __('lable.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" readonly
                                        value="{{ $data[0]['emp_nm'] }}">
                                </div>
                                <div class="col">
                                    <label for="mobile" class="control-label">{{ __('lable.mobile') }}</label>
                                    <input class="form-control" name="mobile" type="text"  value="{{ $data[0]['mobile_no'] }}" readonly>
                                    <input class="form-control" name="avatar" type="hidden"  value="{{ Str::after($avatar, 'http://srv.wamy.org/wamyportal/public/storage/Images/') }}" readonly>
                                </div>
                                
                                    
                                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="dept" class="control-label">{{ __('lable.department') }}</label>
                                    <input class="form-control" name="dept" type="text" value="{{ $data[0]['hirchy_prnt_nm'] }}" readonly>
                                </div>
                                <div class="col">
                                    <label for="sectn" class="control-label">{{ __('lable.section') }}</label>
                                    <input class="form-control" name="sectn" type="text" value="{{ $data[0]['hirch_nm'] }}" readonly>
                                </div>
                                

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="job" class="control-label">{{ __('lable.job') }}</label>
                                    <input class="form-control" name="job" type="text" readonly value="{{ $data[0]['emp_job_nm'] }}">
                                </div>
                                <div class="col">
                                    <label for="qualification" class="control-label">{{ __('lable.qualification') }}</label>
                                    <input class="form-control" name="qualification" type="text" readonly value="{{ $data[0]['qlfction_lst_nm'] }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="candidateposition" class="control-label">المنصب المرشح له</label>
                                    <select name="candidateposition" id="candidateposition" class="form-control">
                                        <option value="0">المنصب المرشح له</option>
                                        <option value="1">رئيس الجمعية العمومية</option>
                                        <option value="2"> رئيس مجلس إدارة الصندوق</option>
                                        <option value="3">نائب رئيس مجلس إدارة الصندوق</option>
                                        <option value="4">عضو مجلس إدارة الصندوق</option>

                                    </select>
                                </div>

                                <div class="col">
                                    <label class="control-label">السيرة الذاتية <span>(إختياري)</span></label>
                                    <p class="text-danger"> صيغة المرفق pdf </p>
                                    {{-- <p class="text-danger">في حالة لم ترفق توقيعك مسبقا يمكنك إرفاق الملف هنا بعد التوقيع</p> --}}
                                    <div class="col-sm-12 col-md-12">
                                        <input type="file" name="file" class="dropify" accept=".pdf"
                                            data-height="70" />
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col">
                                    <div class="card slate">
                                        <div class="card-header text-center">
                                            <h2>الأحكام والشروط العامة</h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="wpage-one" id="wpage-one">
                                                <h3 style="color:blue; font-weight:bold ">المناصب</h3>
                                                <p style="font-size: 16px; font-weight:bold">
                                                    1- رئيس الجمعية العمومية.
                                                    <br>
                                                    2- رئيس مجلس إدارة الصندوق.
                                                    <br>
                                                    3- نائب رئيس مجلس إدارة الصندوق.
                                                    <br>
                                                    4-عضو مجلس إدارة الصندوق. 
                                                </p>
                                                <h3 style="color:blue; font-weight:bold">الشروط</h3>
                                                <p style="font-size: 16px; font-weight:bold"> 
                                                    1- يشترط في المتقدم للترشح أن يكون مشتركاً في الصندوق.
                                                    <br>
                                                    2- مدة العضوية في مجلس إدارة الصندوق سنتان، مع التكليف بالعمل حتى انعقاد الجمعية العمومية.
                                                    <br>
                                                    3- يلتزم عضو مجلس إدارة الصندوق بحضور الاجتماعات والتوقيع على محاضرها.
                                                    <br>
                                                    4- لا يحق للعضو أن يرشح نفسه إلا في منصب واحد فقط .
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" id="savelink" class="btn btn-primary">{{ __('lable.savebtn') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="margin-bottom: 180px"></div>
            </div>
        @endif
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
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();


    </script>
@endsection
