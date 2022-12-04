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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.savings-forms') }}</span>
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

            @if(is_null($oldBox) xor $oldBox == 2 xor $oldBox == 3 )
                {{-- <h1 style="color: red">طلب جديد </h1> --}}
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="addSavings" action="{{ route('boxOrders.store') }}"
                                method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                {{ csrf_field() }}
                                    <input type="hidden" id="typeEnter" name="typeEnter" value="0">
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
                                                <label for="department" class="control-label">{{ __('lable.department') }}</label>
                                                <input type="text" class="form-control" id="department" name="department" disabled
                                                    value="{{ $item->hirchy_prnt_nm }}">
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="section" class="control-label">{{ __('lable.section') }}</label>
                                                <input type="text" class="form-control" id="section" name="section" disabled
                                                    value="{{ $item->hirch_nm }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm col-md">
                                                <label for="" class="control-label">{{ __('lable.mobile') }}</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                                    value="{{ $item->mobile_no }}">
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="nationalty" class="control-label">{{ __('lable.nationalty') }}</label>
                                                <input type="text" class="form-control" id="nationalty" name="nationalty" disabled
                                                    value="{{ $item->nat_nm }}">
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="cardno" class="control-label">{{ __('lable.gid') }}</label>
                                                <input type="text" class="form-control" id="cardno" name="cardno" readonly
                                                    value="{{ $item->card_no }}"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="salary" class="control-label">{{ __('lable.salary') }}</label>
                                                <input type="text" class="form-control" id="salary" name="salary" readonly
                                                    value="{{ $item->total_sal }}"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-sm col-md">
                                            <label for="deductionsHr" class="control-label">إجمالي الإستقطاعات (شؤون الموظفين)</label>
                                            @if (count($hr) != 0)
                                                @foreach ($hr as $item)
                                                    <input type="text" class="form-control form-control-lg" id="deductionsHr"  name="deductionsHr" value="{{ $item->amt }}" readonly>    
                                                @endforeach
                                            @else
                                                <input type="text" class="form-control form-control-lg" id="deductionsHr"  name="deductionsHr" value="0" readonly>    
                                            @endif
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="deductionsBox" class="control-label"> إستقطاعات الصندوق</label>
                                            @foreach ($box as $item)
                                                <input type="text" class="form-control form-control-lg" id="deductionsBox" name="deductionsBox" value="{{ $item->amt }}" readonly>    
                                            @endforeach
                                            
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="deductionsBox" class="control-label"> النسبة </label>
                                            <input type="text" class="form-control form-control-lg" id="finalRate" name="finalRate" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm col-md">
                                            <label for="reqType" class="control-label"> نوع الطلب </label>
                                            <select class="form-control" id="typeorderselect" name="reqType" onchange="changetypeorder()" required>
                                                <option>الرجاء إختيار نوع الطلب</option>
                                                @foreach ($boxorderstype as $item)
                                                <option value="{{$item->id}}"> {{$item->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm col-md">
                                            <label for="installmentPeriod" class="control-label"> مدة التقسيط </label>
                                            <select class="form-control" id="installmentPeriod" name="installmentPeriod" onchange="changePeriod()" required>
                                                <option value="0">الرجاء إختيار مدة التقسيط</option>
                                                <option value="1" id="rdo1" style="display: none"> سنة </option>
                                                <option value="2"id="rdo2" style="display: none"> سنتان </option>
                                                <option value="3" id="rdo3" style="display: none"> ثلاث سنوات  </option>
                                                <option value="4" id="rdo4" style="display: none"> أربع سنوات </option>
                                                <option value="5" id="rdo5" style="display: none"> خمس سنوات </option>
                                            </select>
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="purchasingValue" class="control-label">القيمة الشرائية</label>
                                            <input type="text" class="form-control" id="purchasingValue" name="purchasingValue"
                                            onfocusout ="checkAmount()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            required>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm col-md" id="sponsor" >
                                            <label for="sponsor" class="control-label"> الكافل </label>
                                            <select class="form-control" id="sponsorId" name="sponsor">
                                                <option value="0" >الرجاء إختيار الكافل</option>
                                                @foreach ($savings as $item)
                                                    <option value="{{ $item->empid }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" id="device" style="display: none">
                                        <div class="col" >
                                            <label for="descDevice" class="control-label">وصف الأجهزة</label>
                                            <input type="text" class="form-control" id="descDevice" name="descDevice"
                                            oninput="checkInput()"
                                                placeholder="نأمل كتابة مواصفات الجهاز بشكل دقيق مثال: ايفون 12 بروماكس 256 لون ازرق">
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="qtyDevice" class="control-label">الكمية</label>
                                            <input type="text" class="form-control" id="qtyDevice" name="qtyDevice"
                                                onkeypress="checkInput()"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                    <div class="row" id="furniture" style="display: none">
                                        <div class="col">
                                            <label for="descFurniture" class="control-label">وصف الأثاث</label>
                                            <input type="text" class="form-control" id="descFurniture" name="descFurniture"
                                            oninput="checkInput()"
                                            placeholder="نأمل كتابة مواصفات الأثاث بشكل دقيق ">
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="qtyFurniture" class="control-label">الكمية</label>
                                            <input type="text" class="form-control" id="qtyFurniture" name="qtyFurniture" onkeypress="checkInput()"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                    </div>
                                    <div class="row" id="car" style="display: none">
                                        <div class="col">
                                            <label for="descCar" class="control-label">وصف السيارة</label>
                                            <input type="text" class="form-control" id="descCar" name="descCar"
                                                oninput="checkInput()"
                                                placeholder="نأمل كتابة مواصفات السيارة بشكل دقيق">
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="qtyCar" class="control-label">الكمية</label>
                                            <input type="text" class="form-control" id="qtyCar" name="qtyCar"
                                            onkeypress="checkInput()"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-sm col-md">
                                            <h5 class="card-title">التوقيع</h5>
                                            {{-- @if ($signature->signature == 'defualt.png') --}}
                                            @if ($signature[0] == 'defualt.png')
                                                <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="file" name="signature" class="dropify"
                                                        accept=".jpg, .png, image/jpeg, image/png" data-height="70" required/>
                                                </div>
                                            @else
                                                <img name="signature" style="width: 10%" src="{{ asset('public/storage/Signature/'.$signature[0]/* ->signature */) }}" alt="Sign">
                                            @endif
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <label style="font-size: 16px">
                                            <input type="checkbox" id="agree" onchange="showlink()">
                                            <strong>
                                                أنا الموقع أدناه أتقدم لصندوق الادخار بالندوة العالمية للشباب الإسلامي بطلب <span id="typeorder"></span> (وفق البيانات أعلاه والعقد المرفق.
                                                أقر بموجب هذا الطلب أن المعلومات صحيحة وأن لصندوق الادخار الحق في التأكد والتحقق من صحة هذه المعلومات وتبادلها مع الغير. وأفوضهم بأن يحصلوا على ما يلزمهم أو يحتاجون إليه من معلومات تخصني. كما أعلن التزامي بجميع الشروط والأحكام التي سيتم اطلاعي عليها في العقد المبرم بيني وبين صندوق الادخار. وأوافق على أن تتم تسوية أي نزاع قد ينشأ فيما يتعلق بوضع هذا الطلب عن طريق الجهات الرسمية، ويحق للصندوق أن يحتفظ بالمستندات التي أقدمها، وفي حال ثبوت عدم صحة المعلومات أعلاه فإنني أتحمل كافة الإجراءات القانونية المترتبة على ذلك.
                                                لا يحق سحب الرصيد المتوفر في الصندوق إلا بعد سداد الأقساط كاملة.

                                            </strong>
                                        </label>
                                    </div>
                                    <br>
                                    <span id="attention" style="font-weight: bold; font-size: 16px; color:red; display: none; text-align: center">
                                        * تقديم الطلب لا يعني الموافقة عليه، سيتم الإعتماد بعد مراجعة البيانات المالية لمقدم الطلب والكافل إن وجد
                                    </span>
                                    <br>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" id="savelink" class="btn btn-primary"
                                            {{-- style="display: none;" --}}>تقديم الطلب
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div style="margin-bottom: 180px"></div>
                </div>
            @elseif ($oldBox == 1)
                {{-- <h1 style="color: red">لا يمكن</h1> --}}
                <div class="col-lg-12 col-md-12">
                    <div class="card bd-0 mg-b-20 bg-danger">
                        <div class="card-body text-white">
                            <div class="main-error-wrapper">
                                <i class="si si-close mg-b-20 tx-50"></i>
                                <h4 class="mg-b-0">لديك طلب سابق لم يتم إعتماده بعد</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($oldBox == 0)
                {{-- <h1 style="color: red">للتعديل </h1>  --}}
                <div class="col-lg-12 col-md-12">            
                    <div class="card">
                        <div class="card-body">
                            <form id="addSavings" name="myForm" action="{{ route('boxOrders.update',$id) }}"
                                method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                {{ csrf_field() }}
                                @method('PATCH')
                                <input type="hidden" id="typeEnter" name="typeEnter" value="1">
                                <input type="hidden" id="orderId" name="orderId" value="{{$id}}">
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
                                            <label for="department" class="control-label">{{ __('lable.department') }}</label>
                                            <input type="text" class="form-control" id="department" name="department" disabled
                                                value="{{ $item->hirchy_prnt_nm }}">
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="section" class="control-label">{{ __('lable.section') }}</label>
                                            <input type="text" class="form-control" id="section" name="section" disabled
                                                value="{{ $item->hirch_nm }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm col-md">
                                            <label for="mobile" class="control-label">{{ __('lable.mobile') }}</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                                value="{{ $item->mobile_no }}">
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="nationalty" class="control-label">{{ __('lable.nationalty') }}</label>
                                            <input type="text" class="form-control" id="nationalty" name="nationalty" disabled
                                                value="{{ $item->nat_nm }}">
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="cardno" class="control-label">{{ __('lable.gid') }}</label>
                                            <input type="text" class="form-control" id="cardno" name="cardno" readonly
                                                value="{{ $item->card_no }}"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="salary" class="control-label">{{ __('lable.salary') }}</label>
                                            <input type="text" class="form-control" id="salary" name="salary" readonly
                                                value="{{ $item->total_sal }}"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="deductionsHr" class="control-label">إجمالي الإستقطاعات (شؤون الموظفين)</label>
                                        @if (count($hr) != 0)
                                            @foreach ($hr as $item)
                                                <input type="text" class="form-control form-control-lg" id="deductionsHr"  name="deductionsHr" value="{{ $item->amt }}" readonly>    
                                            @endforeach
                                        @else
                                            <input type="text" class="form-control form-control-lg" id="deductionsHr"  name="deductionsHr" value="0" readonly>    
                                        @endif
                                        
                                        
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="deductionsBox" class="control-label"> إستقطاعات الصندوق</label>
                                        @foreach ($box as $item)
                                        <input type="text" class="form-control form-control-lg" id="deductionsBox" name="deductionsBox" value="{{ $item->amt }}" readonly>    
                                        {{-- <input type="text" class="form-control form-control-lg" id="deductionsBox" name="deductionsBox" value="{{ $box[0]['amt'] }}" readonly>     --}}
                                        @endforeach
                                        
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="deductionsBox" class="control-label"> النسبة </label>
                                        <input type="text" class="form-control form-control-lg" id="finalRate" name="finalRate" readonly>
                                        {{-- <span id="attentionRate"> لا بد ان تكون النسبة أقل من 50%</span> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="reqType" class="control-label"> نوع الطلب </label>
                                        <select class="form-control" id="typeorderselect" name="reqType" onchange="changetypeorder()" required>
                                            <option>الرجاء إختيار نوع الطلب</option>
                                            @foreach ($boxorderstype as $item)
                                            <option value="{{$item->id}}"> {{$item->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="installmentPeriod" class="control-label"> مدة التقسيط </label>
                                        <select class="form-control" id="installmentPeriod" name="installmentPeriod" onchange="changePeriod()" required>
                                            <option value="0">الرجاء إختيار مدة التقسيط</option>
                                            <option value="1" id="rdo1" style="display: none"> سنة </option>
                                            <option value="2"id="rdo2" style="display: none"> سنتان </option>
                                            <option value="3" id="rdo3" style="display: none"> ثلاث سنوات  </option>
                                            <option value="4" id="rdo4" style="display: none"> أربع سنوات </option>
                                            <option value="5" id="rdo5" style="display: none"> خمس سنوات </option>
                                        </select>
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="purchasingValue" class="control-label">القيمة الشرائية</label>
                                        <input type="text" class="form-control" id="purchasingValue" name="purchasingValue"
                                        {{-- placeholder="يجيب ان لايزيد المبلغ عن 15000 ريال" --}}
                                        onfocusout ="checkAmount()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        required>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm col-md" id="sponsor" {{-- style="display: none" --}}>
                                        <label for="sponsor" class="control-label"> الكافل </label>
                                        <select class="form-control" id="sponsorId" name="sponsor">
                                            <option value="0" >الرجاء إختيار الكافل</option>
                                            @foreach ($savings as $item)
                                                <option value="{{ $item->empid }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row" id="device" style="display: none">
                                    <div class="col" >
                                        <label for="descDevice" class="control-label">وصف الأجهزة</label>
                                        <input type="text" class="form-control" id="descDevice" name="descDevice"
                                        oninput="checkInput()"
                                            placeholder="نأمل كتابة مواصفات الجهاز بشكل دقيق مثال: ايفون 12 بروماكس 256 لون ازرق">
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="qtyDevice" class="control-label">الكمية</label>
                                        <input type="text" class="form-control" id="qtyDevice" name="qtyDevice"
                                            onkeypress="checkInput()"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                                <div class="row" id="furniture" style="display: none">
                                    <div class="col">
                                        <label for="descFurniture" class="control-label">وصف الأثاث</label>
                                        <input type="text" class="form-control" id="descFurniture" name="descFurniture"
                                        oninput="checkInput()"
                                        placeholder="نأمل كتابة مواصفات الأثاث بشكل دقيق ">
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="qtyFurniture" class="control-label">الكمية</label>
                                        <input type="text" class="form-control" id="qtyFurniture" name="qtyFurniture" onkeypress="checkInput()"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                                    </div>
                                </div>
                                <div class="row" id="car" style="display: none">
                                    <div class="col">
                                        <label for="descCar" class="control-label">وصف السيارة</label>
                                        <input type="text" class="form-control" id="descCar" name="descCar"
                                            oninput="checkInput()"
                                            placeholder="نأمل كتابة مواصفات السيارة بشكل دقيق" required>
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="qtyCar" class="control-label">الكمية</label>
                                        <input type="text" class="form-control" id="qtyCar" name="qtyCar"
                                        onkeypress="checkInput()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <h5 class="card-title">التوقيع</h5>
                                        @if ($signature[0] /* ->signature */ == 'defualt.png')

                                            <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                            {{-- <p class="text-danger">الرجاء إرفاق صورة من توقيعك</p> --}}
                                            <div class="col-sm-12 col-md-12">
                                                <input type="file" name="signature" class="dropify"
                                                    accept=".jpg, .png, image/jpeg, image/png" data-height="70" required/>
                                            </div>
                                        @else
                                            <img name="signature" style="width: 10%" src="{{ asset('public/storage/Signature/'.$signature[0] /* ->signature */) }}" alt="Sign">
                                        @endif
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <label style="font-size: 16px">
                                        <input type="checkbox" id="agree" onchange="showlink()">
                                        <strong>
                                            أنا الموقع أدناه أتقدم لصندوق الادخار بالندوة العالمية للشباب الإسلامي بطلب <span id="typeorder"></span> (وفق البيانات أعلاه والعقد المرفق.
                                            أقر بموجب هذا الطلب أن المعلومات صحيحة وأن لصندوق الادخار الحق في التأكد والتحقق من صحة هذه المعلومات وتبادلها مع الغير. وأفوضهم بأن يحصلوا على ما يلزمهم أو يحتاجون إليه من معلومات تخصني. كما أعلن التزامي بجميع الشروط والأحكام التي سيتم اطلاعي عليها في العقد المبرم بيني وبين صندوق الادخار. وأوافق على أن تتم تسوية أي نزاع قد ينشأ فيما يتعلق بوضع هذا الطلب عن طريق الجهات الرسمية، ويحق للصندوق أن يحتفظ بالمستندات التي أقدمها، وفي حال ثبوت عدم صحة المعلومات أعلاه فإنني أتحمل كافة الإجراءات القانونية المترتبة على ذلك.
                                            لا يحق سحب الرصيد المتوفر في الصندوق إلا بعد سداد الأقساط كاملة.

                                        </strong>
                                    </label>
                                </div>
                                <br>
                                <span id="attention" style="font-weight: bold; font-size: 16px; color:red; display: none; text-align: center">
                                    * تقديم الطلب لا يعني الموافقة عليه، سيتم الإعتماد بعد مراجعة البيانات المالية لمقدم الطلب والكافل إن وجد
                                </span>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" id="savelink" class="btn btn-primary" style="display: none;">تقديم الطلب</button>
                                    {{-- <button type="button" onclick="mySubmit()" id="savelink" class="btn btn-primary" style="display: none;">تقديم الطلب</button> --}}
                                    
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
    {{-- <script src="sweetalert2/dist/sweetalert2.all.min.js"></script> --}}
    

    <script src="{{URL::asset('public/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/sweet-alert.js')}}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

        function changetypeorder() {
            let typeorderselect = document.getElementById('typeorderselect').value,
            device = document.getElementById('device'),
            furniture = document.getElementById('furniture'),
            car = document.getElementById('car'),
            typeorder = document.getElementById('typeorder'),

            rdo1 = document.getElementById('rdo1'),
            rdo2 = document.getElementById('rdo2'),
            rdo3 = document.getElementById('rdo3'),
            rdo4 = document.getElementById('rdo4'),
            rdo5 = document.getElementById('rdo5');

            
            if (typeorderselect == 1) {

                rdo1.style.display = "block";
                rdo2.style.display = "block";
                device.style.display = "flex";
                furniture.style.display = "flex";
                typeorder.innerHTML = "أجهزة وأثاث منزلي";
                rdo3.style.display = "none";
                rdo4.style.display = "none";
                rdo5.style.display = "none";
                car.style.display = "none";

            }else if(typeorderselect == 2){

                rdo1.style.display = "block";
                rdo2.style.display = "block";
                rdo3.style.display = "block";
                rdo4.style.display = "block";
                rdo5.style.display = "block";
                car.style.display = "flex";
                typeorder.innerHTML = "سيارة";
                device.style.display = "none";
                furniture.style.display = "none";
            }else{

                rdo1.style.display = "none";
                rdo2.style.display = "none";
                rdo3.style.display = "none";
                rdo4.style.display = "none";
                rdo5.style.display = "none";
                device.style.display = "none";
                car.style.display = "none";
            }
        }

        function showlink() {
            let check = document.getElementById('agree').checked,
                typeorderselect = document.getElementById('typeorderselect').value,
                amount = document.getElementById('purchasingValue'),
                savebtn = document.getElementById('savelink'),
                attention = document.getElementById('attention'),
                sponsor = document.getElementById('sponsorId').value,
                deductionsBox = document.getElementById('deductionsBox').value,
                finalRate = document.getElementById('finalRate').value;
                
                if (deductionsBox == 0) {
                    alert('الرجاء مراجعة شئون الموظفين');
                    return false;
                }else{
                    if (check === true) {
                        if (typeorderselect == 1) {
                            if (amount.value > 30000) {
                                alert('يجيب ان لايزيد المبلغ عن 30000 ريال ');
                                amount.focus();
                                return false;
                            }
                        }
                        if (finalRate > 60) {
                            /* alert('إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية او إختيار كافل'); */
                            alert('إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية ');
                            check = false;
                        }else{
                            savebtn.style.display = "block";
                            attention.style.display = "block";
                        }
                    } else {
                        savebtn.style.display = "none";
                        attention.style.display = "none";

                        /* alert(check); */
                    }
                }
            
        }

        function changePeriod() {
            let typeorderselect = document.getElementById('typeorderselect').value,
            amount = document.getElementById('purchasingValue').value,
            installmentPeriod = document.getElementById('installmentPeriod');

            if (amount != null && installmentPeriod != null) {
                checkAmount();
            }
            /* if (typeorderselect == 1) {
                if (installmentPeriod.value == 3 && installmentPeriod.value == 4 && installmentPeriod.value == 5) {
                    alert("عفواً مدة الاقساط للاجهزة والاثاث المنزلي اقصى  حد سنتين");
                    installmentPeriod.focus();
                    return false;
                }
            } */
        }

        function checkAmount() {
            let amount = document.getElementById('purchasingValue'),  /* القيمة الشرائية */
            deductionsBox = document.getElementById('deductionsBox').value, /* الصندوق */
            deductionsHr = document.getElementById('deductionsHr').value,  /* شئون الموظفين */
            salary = document.getElementById('salary').value,  /* الراتب */
            typeorderselect = document.getElementById('typeorderselect').value, /* نوع الطلب */
            installmentPeriod = document.getElementById('installmentPeriod').value,  /* مدة التقسيط */
            finalRate =  document.getElementById('finalRate'), /* الناتج */
            /* attentionRate =  document.getElementById('attentionRate'), */  /* تنبيه الناتج */
            sponsor = document.getElementById('sponsor'),
            sumHrBox,sumDeductions , sumAmout , rate,rate2;

            sumHrBox = parseInt(deductionsBox) + parseInt(deductionsHr);
            if (deductionsBox == 0) {
                alert('الرجاء مراجعة شئون الموظفين');
                return false;
            }else{
                if (typeorderselect == 1) {
                    if (amount.value > 30000) {
                        alert('يجيب ان لايزيد المبلغ عن 30000 ريال ');
                        amount.focus();
                        return false;
                    }else{
                        if (installmentPeriod == 1) {
                        rate = parseInt(amount.value) * 0.1 ;
                        rate2 = (parseInt(amount.value) + rate)  /12;
                        sumDeductions = sumHrBox + rate2;
                        sumAmout = sumDeductions / salary * 100;
                        } else if (installmentPeriod == 2) {
                            rate = parseInt(amount.value) * 0.2 ;
                            rate2 = (parseInt(amount.value) + rate)  /24;
                            sumDeductions = sumHrBox + rate2;
                            sumAmout = sumDeductions / salary * 100;
                        }
                    }
                    
                } else if (typeorderselect == 2){
                    if (installmentPeriod == 1) {
                        rate = parseInt(amount.value) * 0.5 ;
                        rate2 = (parseInt(amount.value) + rate)  /12;
                        sumDeductions = sumHrBox + rate2;
                        sumAmout = sumDeductions / salary * 100;
                    } else if (installmentPeriod == 2) {
                        rate = parseInt(amount.value) * 0.10 ;
                        rate2 = (parseInt(amount.value) + rate)  /24;
                        sumDeductions = sumHrBox + rate2;
                        sumAmout = sumDeductions / salary * 100;
                    }else if (installmentPeriod == 3) {
                        rate = parseInt(amount.value) * 0.15 ;
                        rate2 = (parseInt(amount.value) + rate)  /36;
                        sumDeductions = sumHrBox + rate2;
                        sumAmout = sumDeductions / salary * 100;
                    }else if (installmentPeriod == 4) {
                        rate = parseInt(amount.value) * 0.25 ;
                        rate2 = (parseInt(amount.value) + rate)  /48;
                        sumDeductions = sumHrBox + rate2;
                        sumAmout = sumDeductions / salary * 100;
                    }else if (installmentPeriod == 5) {
                        rate = parseInt(amount.value) * 0.25 ;
                        rate2 = (parseInt(amount.value) + rate)  /60;
                        sumDeductions = sumHrBox + rate2;
                        sumAmout = sumDeductions / salary * 100;

                    }
                }
                    finalRate.value = Math.round(sumAmout);
                    if (Math.round(sumAmout) > 60) {
                        /* attentionRate.innerHTML = "عفواً هذه النسبة إعلى من 50%"; */
                        /* attentionRate.style.color =  "red"; */
                        /* sponsor.style.display= "block"; */
                        return false;
                        amount.focus();
                    }
            }
        }

        function checkInput() {
            var sponsor = document.getElementById('sponsorId').value,
                finalRate = document.getElementById('finalRate').value;
                if (finalRate > 60) {
                    alert('النسبة إعلى من المحدد إما تخفيض القيمة الشرائية');
            }
        }
        function validateForm() {
            let typeEnter = document.getElementById('typeEnter').value;

            if (typeEnter == 1) {
                alert('لديك طلب سابق سيتم التعديل عليه');
            }
            checkInput();
        }
    </script>
@endsection
