@extends('layouts.master')
@section('css')
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@1,400;1,700&family=Tajawal:wght@400;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        @media print {
            #print_Button {
                display: none;
            }
            .foz36{
                font-size: 36px;
            }
        }

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('menu.inventory')}}</h4>
                    <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.myCustody')}}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm" >
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice"  >
               {{--  @if (count($emp) <= 0)
                    <div class="card bd-0 mg-b-20 bg-danger">
                        <div class="card-body text-white">
                            <div class="main-error-wrapper">
                                <i class="si si-close mg-b-20 tx-50"></i>
                                <h4 class="mg-b-0">لا يوجد لديك عهدة مسجلة الرجاء مراجعة قسم تقنية المعلومات</h4>
                            </div>
                        </div>
                    </div>
                @else --}}
                    @foreach ($emp as $item)
                        <div class="card card-invoice" id="print">
                            <div class="card-body">
                                <div class="card-header" style="height: 200px;">
                                    <img style="width: 100%; height: 100%;" src="{{URL::asset('public/storage/Reports/1.jpg')}}" alt="header">
                                </div>
                                <div class="contract">
                                    <div class="contract-title">
                                        <h1>إدارة الإعلام والعلاقات العامة</h1>
                                        <h4 class="foz36">قسم تقنية المعلومات</h4>
                                        <h5><strong><u class="foz36">عهدة موظف</u></strong></h5>
                                    </div>
                                    <br><br><br>
                                    {{-- @foreach ($empInfo as $item) --}}
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h3>الرقم الوظيفي : <span>{{$item->StockIN}}</span></h3>
                                        </div>
                                        <div class="col-lg-4">
                                            <h3>الإسم : <span>{{$item->StockNameAr }}</span></h3>
                                        </div>
                                        <div class="col-lg-4">
                                            <h3>البريد الإلكتروني : <span>{{$item->e_mail}}</span></h3>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h3>الإدارة : <span>{{$item->hirchy_prnt_nm}}</span></h3>
                                        </div>
                                        <div class="col-lg-4">
                                            <h3>القسم : <span>{{$item->hirch_nm}}</span></h3>
                                        </div>
                                    </div>
                                    <br>
                                    {{-- @endforeach --}}
                                    
                                    <table class="table contractTable">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 16px; font-weight: bolder">الباركود</th>
                                                <th style="font-size: 16px; font-weight: bolder">الجهاز</th>
                                                <th style="font-size: 16px; font-weight: bolder">الموديل</th>
                                                <th style="font-size: 16px; font-weight: bolder">نوع العهدة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($emp as $item)
                                                    <tr>
                                                        <td>{{$item->HdwBarcode}}</td>
                                                        <td>{{$item->device}}</td>
                                                        <td>{{$item->HdwModel}}</td>
                                                        <td> {{ $item->HdwType == 101 ? $item->TypeNameAr . " من " .$item->stockName : $item->TypeNameAr }}</td>
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br><br>
                                    <div class="contractBox">
                                        <div>
                                            <table class="table">
                                                <tbody class="signbox">
                                                    
                                                        {{-- @foreach ($empInfo as $info) --}}
                                                            <tr>
                                                                <th scope="row">الإسم :</th>
                                                                <th>{{$item->StockNameAr}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">التاريخ :</th>
                                                                
                                                                <th>{{$day}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">التوقيع :</th>
                                                                
                                                                <td>{{-- <img src="{{ asset('public/storage/Signature/'. $item->signature)}}" alt="Sign"> --}}</td>
                                                                <td><button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                                                                    <i class="mdi mdi-printer ml-1"></i>طباعة</button></td>
                                                            </tr>
                                                        {{-- @endforeach --}}
                                                    
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <hr class="mg-b-40">
                                    
                                    
                                    
                                </div>
                                <div class="card-footer">
                                    <img style="width: 100%" src="{{URL::asset('public/storage/Reports/2.jpg')}}" alt="header">
                                </div>
                            </div>

                        </div>                        
                    @endforeach
                {{-- @endif --}}

            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('public/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>
@endsection
