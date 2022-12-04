@extends('layouts.master')
@section('css')
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@1,400;1,700&family=Tajawal:wght@400;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .textArea{
            margin: 60px 60px 20px 60px;
            font-size: 25px;
        }
        .signbox{
            border: 2px dashed black;
            margin: auto 60px;
        }
        .signbox h2{
            margin: 10px auto;
        }
        .sign{
            margin: 0 50px 0 10px;
        }
        .attention{
            font-weight: bolder;
            color: red
        }
        @media print {
            #print_Button,.attention {
                display: none;
            }
        }

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">مزاد بيع السيارات</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/إيصال إستلام</span>
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
                    <div class="card card-invoice" id="print">
                        <div class="card-body">
                            <div class="contract">
                                <div class="contract-title">
                                    <h1>الندوة العالمية للشباب الإسلامي</h1>
                                    <h4>إيصال استلام عربون</h4>
                                </div>
                                <div class="contractBox">
                                    <div>
                                        {{-- <label>إقرار</label> --}}
                                        <p class="textArea">
                                            إستلمنا من الأخ/ <strong>{{Auth()->user()->name}}</strong> الموظف بالندوة العالمية للشباب الإسلامي مبلغاً وقدره <strong>500 ريال</strong>  عربون الدخول في مزاد بيع السيارات
                                            الخاصة بالامانة العامة للندوة العالمية للشباب الإسلامي .
                                            <br>
                                            وفي حالة رسو أحدى السيارات عليه يقوم بدفع باقي المبلغ مباشرة ولا يتم إعادة العربون المدفوع من قبل المشتري في حالة عدم البيع بسبب يرجع له ويتم إعادة العربون إذا لم ترسو عليه أي سيارة.
                                        </p>
                                    </div>
                                    <div class="signbox">
                                        <div class="row">
                                            <h2>توقيع الجهة المختصة بالإستلام</h2>    
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col sign">
                                                <strong>الإسم: ---------------------------------------------------------------------------</strong> 
                                            </div>
                                            <div class="col">
                                                <strong>التوقيع: ---------------------------------------------------------------------------</strong>
                                            </div>
                                        </div>
                                        {{-- <table class="table">
                                            <tbody class="signbox">
                                                        <tr>
                                                            <th scope="row">الإسم :</th>
                                                            <td>------------------------------------------------</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">التوقيع :</th>
                                                            
                                                            <td>------------------------------------------------</td>
                                                        </tr>
                                            </tbody>
                                        </table> --}}
                                    </div>
                                </div>
                                
                                    
                                
                                <hr class="mg-b-40">
                                <p class="attention float-right mt-3 mr-2">
                                    الرجاء طباعة الإيصال وتلسيمه للجهة المختصة
                                </p>
                                <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                                    <i class="mdi mdi-printer ml-1"></i>
                                    طباعة
                                </button>
                            </div>
                           {{--  <div class="contract-footer">
                                <img style="width: 100%" src="{{ asset('assets\img\contract\footer.jpg') }}" alt="">
                            </div> --}}
                        </div>

                    </div>
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
