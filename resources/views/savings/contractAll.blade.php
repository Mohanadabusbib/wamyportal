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
                    <div class="col-md-12 col-xl-12">
                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>طباعة
                        </button>
                    </div>
                    
                    <br><br>
                    @foreach ($savings as $item)
                        <div class="card card-invoice" id="print" class="print">
                            <div class="card-body">
                                <div class="contract">
                                    <div class="contract-title">
                                        <h1>صندوق الإدخـــــار</h1>
                                        <h4>نموذج إشتراك</h4>
                                        <h6 id="test"></h6>
                                    </div>
                                    <table class="table contractTable">
                                        <tbody>
                                            
                                                    <tr>
                                                        <td class="tit">رقم العضوية</td>
                                                        <td>{{ $item->empid }}</td>
                                                        <td class="tit">الإسم</td>
                                                        <td>{{ $item->name }}</td>
                                                        
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
                                                    
                                                            <tr>
                                                                <th scope="row">الإسم :</th>
                                                                <th>{{ $item->name }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">التوقيع :</th>
                                                                
                                                                <td><img src="{{ asset('public/storage/Signature/'. $item->signature)}}" alt="Sign"></td>
                                                            </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr class="mg-b-40">
                                
                                </div>
                            </div>

                        </div>
                        <br clear="all" style="page-break-before:always" />
                    @endforeach
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
            let printContents = document.querySelectorAll('#print'),
            originalContents = document.body.innerHTML;              
            for (let n = 0; n < printContents.length; n++) {
                document.body.innerHTML = printContents[n].innerHTML;
                 window.print();
            }
            /* let printContents = document.querySelectorAll('#print'),
            originalContents = document.body.innerHTML;              
            for (let n = 0; n < printContents.length; n++) {
                document.body.innerHTML = printContents[n].innerHTML;
                window.print();
            } */
            /* let printContents = document.getElementById('print'); */
            /* let printContents = document.querySelectorAll('#print');
            for (let index = 0; index < printContents.length; index++) {
                document.body.innerHTML = printContents[index].innerHTML;
                    
                window.print();
            }
             */
           
            
        }
    </script>

    
@endsection
