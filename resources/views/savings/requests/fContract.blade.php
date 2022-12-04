@extends('layouts.master')
@section('css')
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@1,400;1,700&family=Tajawal:wght@400;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .tit-padd{
            padding: 0 20px;
        }
        @media print {
            #print_Button {
                display: none;
            }
            #print{
                border: 1px solid black;
            }
            .spacess{
                /* margin-bottom: 350px; */
            }
            @page {
                /* size: auto; */
                margin: 0; 
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
                    عقد بيع</span>
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
                @if (count($data) <= 0)
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
                        <div class="card-header" style="height: 200px;">
                            <img style="width: 100%; height: 100%;" src="{{URL::asset('public/storage/Reports/1.jpg')}}" alt="header">
                            {{-- <img style="width: 100%; height: 100%;" src="{{ URL::asset('public/assets/img/media/login.jpg') }}" alt="header"> --}}
                        </div>
                        <div class="card-body" style="margin-top: -30px;">
                            <div class="contract">
                                <div class="contract-title">
                                    <h1>صندوق الإدخـــــار</h1>
                                    <h2>عقد بيع</h2>
                                </div>
                                <div class="contract-title text-center">
                                    <h3>
                                        رقم العقد
                                        ({{$id}})
                                    </h3>
                                </div>
                                <h4 class="tit-padd">1- بيانات الموظف</h4>
                                <table class="table contractTable">
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="tit" >الإسم رباعي</td>
                                                <td id="empName">{{ $item->emp_nm }}</td>
                                                <td class="tit">الجنسية</td>
                                                <td>{{ $item->nat_nm }}</td>
                                                <td class="tit">الرقم الوظيفي</td>
                                                <td>{{ $item->emp_no }}</td>
                                            </tr>
                                            <tr>
                                                <td class="tit">رقم بطاقة الاحوال / الإقامة</td>
                                                <td>{{ $item->card_no }}</td>
                                                <td class="tit">الإدارة</td>
                                                <td>{{ $item->hirchy_prnt_nm }}</td>
                                                <td class="tit">القسم</td>
                                                <td>{{ $item->hirch_nm }}</td>
                                            </tr>
                                            <tr>
                                                <td class="tit">الراتب</td>
                                                <td>{{ $item->total_sal }}</td>
                                                <td class="tit">جوال </td>
                                                <td>{{ $item->mobile_no }}</td>
                                            
                                        @endforeach
                                                @foreach ($orderData as $item)
                                                    {{-- <tr> --}}
                                                <td class="tit">اقساط سابقة للصندوق</td>
                                                <td>  @if ( $item->debtFurnitureEmp > 0 || $item->debtCarEmp > 0)
                                                    نعم @else لا @endif
                                                </td>
                                                {{-- <td class="tit">نوع القسط</td>
                                                <td>
                                                    @if ( $item->debtFurnitureEmp > 0) أجهزة وأثاث منزلي @elseif ($item->debtCarEmp > 0)سيارة @else لايوجد @endif
                                                </td>
                                                    </tr> --}}
                                                @endforeach
                                            </tr>
                                    </tbody>
                                </table>
                                <h4 class="tit-padd">2- التحليل المالي للموظف</h4>
                                <table class="table contractTable">
                                    <tbody>
                                        @foreach ($orderData as $item)
                                            
                                    </tbody>
                                </table>
                                <table class="table contractTable">
                                    <tbody>
                                            <tr>
                                                <td class="tit">النوع</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="tit">الكمية</td>
                                                <td>{{ $item->Qty }}</td>
                                                <td class="tit">وصف الصنف</td>
                                                <td>{{ $item->descDevice }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <table class="table contractTable">
                                    <tbody>
                                        <tr>
                                            
                                            <td class="tit">تاريخ العقد</td>
                                            <td>{{ date('Y/m/d', strtotime($item->updated_at)) }}</td>
                                            {{-- <td>{{$item->updated_at}}</td> --}}
                                        </tr>
                                        <tr>
                                            <td class="tit">الرصيد في الصندوق</td>
                                            <td>{{ $item->balanceboxEmp }}</td>
                                            <td class="tit">نهاية الخدمة</td>
                                            <td>{{ $item->endServiceEmp }}</td>
                                            <td class="tit">القيمة الشرائية</td>
                                            <td>{{ $item->lastPurchasingValue }}</td>
                                            <td class="tit">سعر البيع للموظف </td>
                                            <td>{{ $item->salesPrice }}</td>
                                        </tr>
                                        <tr>
                                            <td class="tit">مدة التقسيط</td>
                                            <td>{{ $item->period }}</td>
                                            <td class="tit">القسط الشهري</td>
                                            <td>{{ $item->monthlyInstallment }}</td>
                                            <td class="tit">القسط الأول </td>
                                            <td>{{ $item->dateFirstInstallment }}</td>
                                            <td class="tit">القسط الاخير </td>
                                            <td>{{ $item->dateLastInstallment }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="tit">إسم العضو</td>
                                            <td>
                                                @if ($item->name == "سيارة")
                                                <strong>أ.سلطان العتيبي</strong>
                                                @else
                                                <strong>أ.احمد اسماعيل</strong>
                                                @endif
                                            </td>
                                            <td class="tit">توقيع العضو</td>
                                            <td>...............................</td>
                                            <td class="tit">إسم المحاسب </td>
                                            <td><strong>أ.عبدالله الحريري</strong></td>
                                            <td class="tit">توقيع المحاسب </td>
                                            <td>...............................</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                {{-- Start from Here --}}
                                @if ($item->sprName != "لايوجد")
                                    <h4 class="tit-padd">3- التحليل المالي للكافل</h4>
                                    <table class="table contractTable">
                                        <tbody>
                                                <tr>
                                                    <td class="tit">الكافل</td>
                                                    <td>{{ $item->sprName }}</td>
                                                   
                                                    <td class="tit">الرصيد في الصندوق</td>
                                                    <td>{{ $item->balanceboxSpr }}</td>
                                                    <td class="tit">نهاية الخدمة</td>
                                                    <td>{{ $item->endServiceSpr }}</td>
                                                    <td class="tit">توقيع الكافل</td>
                                                    <td>...............................</td>
                                                </tr>
                                            
                                        </tbody>
                                    </table>
                                @endif
                                @if ($item->sprName != "لايوجد")
                                    <h4 class="tit-padd">4- التحليل المالي</h4>
                                    <table class="table contractTable">
                                        <tbody>
                                            <tr>
                                                <td class="tit">إجمالي الضمانات</td>
                                                <td>{{ number_format($item->GuaranteesEmp + $item->GuaranteesSpr,2)}}</td>
                                                <td class="tit">إجمالي الإلتزمات</td>
                                                <td>{{ number_format($item->CommitmentsEmp + $item->CommitmentsSpr,2) }}</td>
                                                <td class="tit">الضمانات المتاحة</td>
                                                <td>{{ number_format(($item->GuaranteesEmp + $item->GuaranteesSpr) - ($item->CommitmentsEmp + $item->CommitmentsSpr),2) }}</td>
                                            </tr>                                            
                                        </tbody>
                                    </table>
                                    <h4 class="tit-padd">5- إقرار</h4>
                                @else
                                    <h4 class="tit-padd">3- التحليل المالي</h4>
                                    <table class="table contractTable">
                                        <tbody>
                                            <tr>
                                                <td class="tit">إجمالي الضمانات</td>
                                                <td>{{ number_format($item->GuaranteesEmp + $item->GuaranteesSpr,2)}}</td>
                                                <td class="tit">إجمالي الإلتزمات</td>
                                                <td>{{ number_format($item->CommitmentsEmp + $item->CommitmentsSpr,2) }}</td>
                                                <td class="tit">الضمانات المتاحة</td>
                                                <td>{{ number_format(($item->GuaranteesEmp + $item->GuaranteesSpr) - ($item->CommitmentsEmp + $item->CommitmentsSpr),2) }}</td>
                                            </tr>                                            
                                        </tbody>
                                    </table>
                                    <h4 class="tit-padd">4- إقرار</h4>    
                                @endif
                                
                                
                                
                                {{-- End from Here --}}
                                @endforeach
                                <table class="table contractTable">
                                    <tbody>
                                        @foreach ($orderData as $item)
                                            <tr>
                                                <td class="tit">
                                                    أنا الموقع أدناه اتقدم لصندوق الإدخار بالندوة العالمية للشباب الإسلامي بطلب تقسيط ({{$item->monthlyInstallment}})  ريال وفق البيانات أعلاه
                                                    وأقر بموجب هذا الطلب ان المعلومات صحيحة وان لصندوق الادخار الحق في التأكد
                                                     والتحقق من صحة هذه المعلومات وافوضهم بان يحصلوا علي ما يلزمهم او يحتاجون اليه من معلومات تخصني. كما أعلن
                                                    التزامي بجميع الشروط والاحكام في الصندوق واوافق علي ان تتم تسوية اي نزاع قد ينشأ فيما يتعلق بوضع
                                                    هذا الطلب عن طريق الجهات الرسمية بالندوة، ويحق للصندوق ان يحتفظ بالمستندات التي اقدمها ، وفي حال
                                                    ثبوت عدم صحة المعلومات أعلاه فانني اتحمل كافة الإجراءات القانونية المترتبة علي ذلك.
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table contractTable">
                                    <tbody>
                                        <tr>
                                            <td class="tit">إسم الموظف</td>
                                            <td class="tit" id="empName2"></td>
                                            <td class="tit">التوقيع</td>
                                            <td class="tit">...............................</td>
                                            <td class="tit">التاريخ</td>
                                            <td class="tit">...../...../ ......</td>
                                        </tr>
                                        <tr>
                                            <td class="tit">رئيس صندوق الإدخار</td>
                                            <td class="tit">أ.حسين بن عبدالعزيز الحسيني</td>
                                            <td class="tit">التوقيع</td>
                                            <td class="tit">...............................</td>
                                            <td class="tit">التاريخ</td>
                                            <td class="tit">...../...../ ......</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <hr class="mg-b-40">
                                
                                <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                        class="mdi mdi-printer ml-1"></i>طباعة</button>
                                
                            </div>
                           
                        </div>
                        <div class="card-footer">
                            <img style="width: 100%" src="{{URL::asset('public/storage/Reports/2.jpg')}}" alt="header">
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
    <script>
        window.onload = function() {
            document.getElementById('empName2').innerHTML = document.getElementById('empName').innerHTML;
        };
    </script>
@endsection
