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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إعتماد المجلس</span>
                @if ( $order['status'] == "تم رفض الطلب")
                    <span class="mt-1 tx-13 mr-2 mb-0" style="font-weight: bolder; color: red">/  {{ $order['status'] }}</span>    
                @else
                <span class="mt-1 tx-13 mr-2 mb-0" style="font-weight: bolder; color: green">/  {{ $order['status'] }}</span>
                @endif
                
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
        <div class="row">
            @if ($errors->any())
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-danger text-center">
                    <ul style="list-style: none">
                        @foreach ($errors->all() as $error)
                            <li style="font-weight: bold">{{ $error }}</li>
                            <br>
                        @endforeach
                    </ul>
                </div>
            </div>
                
            @endif
        </div>
        <h4>بيانات الموظف</h4>
        <div class="row" >
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    {{-- <div class="card-header"><h3>بيانات الموظف</h3></div> --}}
                    <div class="card-body">
                        <form id="addSavings" action="{{route('updatecontractOrder')}}"
                            method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            @foreach ($data as $item)
                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label">{{ __('lable.empId') }}</label>
                                    <input type="text" class="form-control" id="empid" name="empid" readonly
                                        value="{{ $item->emp_no }}">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="name" class="control-label">{{ __('lable.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" readonly
                                        value="{{ $item->emp_nm }}">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.department') }}</label>
                                    <input type="text" class="form-control" id="department" name="department" disabled
                                        value="{{ $item->hirchy_prnt_nm }}">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.section') }}</label>
                                    <input type="text" class="form-control" id="section" name="section" disabled
                                        value="{{ $item->hirch_nm }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.mobile') }}</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" disabled
                                        value="{{ $item->mobile_no }}">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.nationalty') }}</label>
                                    <input type="text" class="form-control" id="nationalty" name="nationalty" disabled
                                        value="{{ $item->nat_nm }}">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.gid') }}</label>
                                    <input type="text" class="form-control" id="cardno" name="cardno" disabled
                                        value="{{ $item->card_no }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.salary') }}</label>
                                    <input type="text" class="form-control" id="salary" name="salary" disabled
                                        value="{{ $item->total_sal }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                            @endforeach
                            @foreach ($orderData as $item)
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">اقساط سابقة للصندوق</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                            value="
                                            @if ( $item->debtFurnitureEmp > 0 || $item->debtCarEmp > 0)
                                                نعم
                                            @else
                                                لا
                                            @endif
                                            ">
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">نوع القسط</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                            value="
                                            @if ( $item->debtFurnitureEmp > 0)
                                                أجهزة وأثاث منزلي
                                            @elseif ($item->debtCarEmp > 0)
                                                سيارة
                                            @endif
                                            ">
                                    </div>
                                </div>
                            @endforeach
                            {{-- <span id="attention" style="font-weight: bold; font-size: 16px; color:red; display: none; text-align: center">
                                * تقديم الطلب لا يعني الموافقة عليه، سيتم الإعتماد بعد مراجعة البيانات المالية لمقدم الطلب والكافل إن وجد
                            </span>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" id="savelink" class="btn btn-primary"
                                    style="display: none;">تقديم الطلب
                                </button>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <h4>التحليل المالي للموظف</h4>
        <div class="row" >
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        @foreach ($orderData as $item)
                        <div class="row">
                            <div class="col">
                                <label for="empid" class="control-label">الرصيد في الصندوق</label>
                                <input type="text" class="form-control" id="balanceboxEmp" name="balanceboxEmp" readonly
                                    value="{{ $item->balanceboxEmp }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="name" class="control-label">نهاية الخدمة</label>
                                <input type="text" class="form-control" id="endServiceEmp" name="endServiceEmp" readonly
                                    value="{{ $item->endServiceEmp }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">مدة التقسيط</label>
                                <input type="text" class="form-control" id="installmentPeriod" name="installmentPeriod" disabled
                                    value="{{ $item->period }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">نوع الطلب</label>
                                <input type="text" class="form-control" id="typeorder" name="typeorder" value="{{$item->name}}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">الكمية</label>
                                @if ($item->name == "سيارة")
                                <input type="text" class="form-control" id="qty" name="qty" readonly value="{{ $item->qtyCar }}">    
                                @else
                                <input type="text" class="form-control" id="qty" name="qty" readonly value="{{ $item->Qty }}">    
                                @endif
                                
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <label for="empid" class="control-label">الوصف</label>
                                <input type="text" class="form-control" id="descOrder" name="descOrder" value="{{ $item->descDevice." / ".$item->descFurniture }}">
                                <input type="hidden" class="form-control" id="descDevice" name="descDevice" value="{{ $item->descDevice}}">
                                <input type="hidden" class="form-control" id="descFurniture" name="descFurniture" value="{{ $item->descFurniture }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="empid" class="control-label">القيمة الشرائية</label>
                                <input type="text" class="form-control" id="purchasingValue" name="purchasingValue" readonly
                                    value="{{ $item->purchasingValue }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">القيمة الشرائية الفعلية</label>
                                <input type="text" class="form-control" id="lastPurchasingValue" name="lastPurchasingValue" onfocusout="calc()"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <div class="col-sm col-md">
                                <label for="name" class="control-label">سعر البيع للموظف</label>
                                <input type="text" class="form-control" id="salesPrice" name="salesPrice" readonly onfocus="calc2()"
                                    value="">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">القسط الشهري</label>
                                <input type="text" class="form-control" id="monthlyInstallment" name="monthlyInstallment" readonly
                                    value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="empid" class="control-label">تاريخ القسط الأول</label>
                                <input type="date" class="form-control" id="dateFirstInstallment" name="dateFirstInstallment" placeholder="dd/mm/yyyy"
                                onchange="changeDate()">
                            </div>
                            <div class="col">
                                <label for="empid" class="control-label">تاريخ القسط الاخير</label>
                                <input type="text" class="form-control" id="dateLastInstallment" name="dateLastInstallment" readonly>
                            </div>
                        </div>
                        @endforeach   
                            <br>
                            <input type="hidden" class="form-control" id="orderID" name="orderID" value="{{$id}}">
                            <input type="hidden" class="form-control" id="status" name="status" value="{{$order['status'] }}">
                            
                            <div class="d-flex justify-content-center">
                                @if ( $order['status'] == "تم رفض الطلب")
                                {{-- <span class="mt-1 tx-13 mr-2 mb-0" style="font-weight: bolder; color: red">/  {{ $order['status'] }}</span> --}}
                                    <button type="submit" id="savelink" class="btn btn-danger">رفض الطلب</button>
                                @else
                                {{-- <span class="mt-1 tx-13 mr-2 mb-0" style="font-weight: bolder; color: green">/  {{ $order['status'] }}</span> --}}
                                    <button type="submit" id="savelink" class="btn btn-success">إعتماد الطلب</button>
                                @endif
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
    {{-- <script src="sweetalert2/dist/sweetalert2.all.min.js"></script> --}}
    

    <script src="{{URL::asset('public/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/sweet-alert.js')}}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>
    
<script>
    function calc() {
        let purchasingValue = document.getElementById('purchasingValue').value,
        lastPurchasingValue = document.getElementById('lastPurchasingValue').value,
        
        salesPrice = document.getElementById('salesPrice'),
        monthlyInstallment = document.getElementById('monthlyInstallment'),
        installmentPeriod = document.getElementById('installmentPeriod').value,
        typeorder = document.getElementById('typeorder').value,
        year,monthValue;
        
        if (parseInt(lastPurchasingValue) <= parseInt(purchasingValue)) {

            if(installmentPeriod == 'سنة'){ year = 1; }else if(installmentPeriod == 'سنتان'){year = 2;}else if(installmentPeriod == 'ثلاث سنوات'){year = 3;}
            else if(installmentPeriod == 'أربع سنوات'){year = 4;}else if(installmentPeriod == 'خمس سنوات'){year = 5;}

            if (typeorder == 'أجهزة وأثاث منزلي') {
                if (year == 1) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.1 + parseFloat(lastPurchasingValue);
                    monthValue =  parseFloat(salesPrice.value) / 12;
                    monthlyInstallment.value = monthValue.toFixed(2);
                }else if (year == 2) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.2 + parseFloat(lastPurchasingValue);
                    monthValue =  parseFloat(salesPrice.value) / 24;
                    monthlyInstallment.value = monthValue.toFixed(2);                    
                }
            } else if (typeorder == 'سيارة') {
                if (year == 1) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.5 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 12;
                }else if (year == 2) {
                    salesPrice.value = parseFloat(lastPurchasingValue) *  0.10 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 24;
                }else if (year == 3) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.15 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 36;
                }else if (year == 4) {
                    salesPrice.value = parseFloat(lastPurchasingValue) *0.20 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 48;
                }else if (year == 5) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.25 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 60;
                }

            }    
        } else {
            alert('القيمة المدخلة أكير من القيمة الشرائية');
        }        
    }
    function calc2() {
        let purchasingValue = document.getElementById('purchasingValue').value,
        lastPurchasingValue = document.getElementById('lastPurchasingValue').value,
        lastPurchasingValue2 = document.getElementById('lastPurchasingValue');
        if (lastPurchasingValue2.value > purchasingValue) {
            lastPurchasingValue2.focus();
        }
    }

    function add_years(dt,n) 
    {
        return new Date(dt.setFullYear(dt.getFullYear() + n));      
    }
    
    function changeDate() {
        let dateFirstInstallment = document.getElementById('dateFirstInstallment').value,
        dateLastInstallment  = document.getElementById('dateLastInstallment'),
        installmentPeriod = document.getElementById('installmentPeriod').value,
        year;
        if(installmentPeriod == 'سنة'){ year = 1; }else if(installmentPeriod == 'سنتان'){year = 2;}else if(installmentPeriod == 'ثلاث سنوات'){year = 3;}
        else if(installmentPeriod == 'أربع سنوات'){year = 4;}
        else if(installmentPeriod == 'خمس سنوات'){year = 5;}
        dt = new Date(dateFirstInstallment);
        newDate =    add_years(dt, year).toLocaleDateString();
        dateLastInstallment.value = newDate;
    }
    
    
    /* dt = new Date(2014,10,2);

    console.log(add_years(dt, 10).toString()); */
    
</script>
    
@endsection
