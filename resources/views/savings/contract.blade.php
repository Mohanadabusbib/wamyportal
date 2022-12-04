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
        }

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('menu.savings') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    عقد</span>
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
                @if (count($savings) <= 0)
                <div class="card bd-0 mg-b-20 bg-danger">
                    <div class="card-body text-white">
                        <div class="main-error-wrapper">
                            <i class="si si-close mg-b-20 tx-50"></i>
                            <h4 class="mg-b-0">تكرماً قم بتسجيل بيناتك اولاَ</h4>
                        </div>
                    </div>
                </div>
                @else
                    <div class="card card-invoice" id="print">
                        <div class="card-body">
                            {{-- <div class="invoice-header">
                                <div class="billed-from">
                                    <img src="{{ asset('assets\img\contract\header.jpg') }}" alt="">
                                </div>
                            </div> --}}
                            <div class="contract">
                                <div class="contract-title">
                                    <h1>صندوق الإدخـــــار</h1>
                                    <h4>نموذج إشتراك</h4>
                                </div>

                                <table class="table contractTable">
                                    <tbody>
                                        @foreach ($savings as $item)
                                            {{-- @foreach ($user as $us) --}}
                                                <tr>
                                                    <td class="tit">رقم العضوية</td>
                                                    <td>{{ $item->empid }}</td>
                                                    <td class="tit">الإسم</td>
                                                    <td>{{ $item->name }}</td>
                                                    {{-- <td>{{ $us->name }}</td> --}}
                                                </tr>
                                                <tr>
                                                    <td class="tit">تاريخ التعين</td>
                                                    <td>{{ $item->dateOfAppointment }}</td>
                                                    <td class="tit">الراتب</td>
                                                    <td>{{ $item->salary }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tit">تاريخ الإشتراك</td>
                                                    <td>{{ $item->datePremium }}</td>
                                                    <td class="tit">قسط الاشتراك </td>
                                                    <td>{{ $item->newpremium }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tit">المساهمة</td>
                                                    <td>{{ $item->contribute ? $item->contribute : 'لاتوجد'  }}</td>
                                                </tr>

                                            {{-- @endforeach --}}

                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="contractBox">
                                    <div>
                                        <label>إقرار</label>
                                        <p>
                                            أقر بأنني قد فوضت مجلس إدارة صندوق الادخار بأن تخصم قسطاً شهرياً بقيمة المبلغ
                                            المذكور إعلاه من الراتب وتحوله لحساب صندوق الادخار في الندوة العالمية للشباب
                                            الإسلامي لادخاره واستثماره باسمي وفقاً للائحة الصندوق. كما أقر بأني اطلعت على لائحة
                                            صندوق الادخار وتفهمت جميع بنودها وقبلت التعامل بموجبها في جميع معاملاتي ومستحقاتي
                                            حالياً ومستقبلاً، وفي حال رغبتي الانسحاب من الصندوق فإني التزم بإبلاغ مجلس إدارة
                                            الصندوق كتابياً بذلك قبل شهرين من التاريخ المحدد لانسحابي من الصندوق. وفي حال وجود
                                            أي مستحقات مسجلة علي لصالح صندوق الادخار فإني أفوض الندوة بأن تخصم هذه المستحقات من
                                            مرتبي أو أية مستحقات أخرى.
                                        </p>
                                    </div>
                                    <br><br>
                                    <div>
                                        <table class="table">
                                            <tbody class="signbox">
                                                @foreach ($savings as $item)
                                                    {{-- @foreach ($user as $us) --}}
                                                        <tr>
                                                            <th scope="row">الإسم :</th>
                                                            <th>{{ $item->name }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">التوقيع :</th>
                                                            
                                                            <td><img src="{{ asset('public/storage/Signature/'. $item->signature)}}" alt="Sign"></td>
                                                        </tr>
                                                    {{-- @endforeach --}}
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr class="mg-b-40">
                                {{-- <a class="btn btn-purple float-left mt-3 mr-2" href="">
                                    <i class="mdi mdi-currency-usd ml-1"></i>Pay Now
                                </a>
                                <a href="#" class="btn btn-danger float-left mt-3 mr-2">
                                    <i class="mdi mdi-printer ml-1"></i>Print
                                </a> --}}
                                <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                        class="mdi mdi-printer ml-1"></i>طباعة</button>
                                {{-- <a href="#" class="btn btn-success float-left mt-3">
                                    <i class="mdi mdi-telegram ml-1"></i>Send Invoice
                                </a> --}}
                            </div>
                           {{--  <div class="contract-footer">
                                <img style="width: 100%" src="{{ asset('assets\img\contract\footer.jpg') }}" alt="">
                            </div> --}}
                        </div>

                    </div>
                @endif

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
