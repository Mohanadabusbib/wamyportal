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
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ التحليل المالي</span>
                <span class="text-muted mt-1 tx-13">/ </span>
                &nbsp;&nbsp;
                
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
        
        @foreach ($orders as $item)
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>صاحب الطلب :  {{$item->emp}}</h4>
                            <h6> الرقم الوظيفي: {{ $item->empid}}</h6>
                            <h5>إستعراض طلب رقم : {{$item->id}}</h5>
                            <h5>تاريخ الطلب : {{date('d-m-Y', strtotime($item->created_at))}}</h5>
                            <h5>حالة الطلب : {{$item->status}} في {{date('d-m-Y', strtotime($item->updated_at))}}</h5>
                            
                            
                            <hr>
                            <form action="{{-- {{ route('financial.update',$id) }} --}}" method="post">
                                {{ csrf_field() }}
                                @method('PATCH')
                                <input type="hidden" name="types" value="1">
                            <div class="row">
                                <div class="col">
                                    <label for="salary" class="control-label">نوع الطلب</label>
                                    <input type="text" class="form-control" id="salary" name="salary" value="{{ $item->name }}" readonly>
                                </div>
                                <div class="col">
                                    <label for="purchasingValue" class="control-label">القيمة الشرائية</label>
                                    <input type="text" class="form-control" id="purchasingValue" name="purchasingValue" value="{{ number_format($item->purchasingValue,2) }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="salary" class="control-label">الراتب</label>
                                    <input type="text" class="form-control" id="salary" name="salary" value="{{ $item->salaryEmp }}" readonly>
                                </div>
                                <div class="col">
                                    <label for="endService" class="control-label">قسط الإشتراك</label>
                                    <input type="text" class="form-control" id="endService" name="endService" value="{{ $item->deductionsBox }}" readonly>
                                </div>
                            </div>
                            <br>
                            <h5 class="text-center">الضمانات</h5>
                            <div class="row">
                                <div class="col">
                                    <label for="endService" class="control-label">رصيد نهاية الخدمة</label>
                                    <input type="text" class="form-control" id="endServiceEmp" name="endServiceEmp" value="{{$item->endServiceEmp}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="balancebox" class="control-label">رصيد اشتراك الصندوق</label>
                                    <input type="text" class="form-control" id="balanceboxEmp" name="balanceboxEmp" onfocusout="calc()" value="{{$item->balanceboxEmp}}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <label for="empid" class="control-label">إجمالي الضمانات</label>
                                <input type="text" class="form-control" id="totalGuaranteesEmp" name="totalGuaranteesEmp" value="{{$item->totalGuaranteesEmp}}"  readonly>
                            </div>
                            <br>
                            <h5 class="text-center">الإلتزمات</h5>
                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label">مديونية أجهزة واثاث</label>
                                    <input type="text" class="form-control" id="debtFurnitureEmp" name="debtFurnitureEmp" value="{{$item->debtFurnitureEmp}}" onfocusout="calc()" readonly>
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label"> مديونية سيارات</label>
                                    <input type="text" class="form-control" id="debtCarEmp" name="debtCarEmp"value="{{$item->debtCarEmp}}" onfocusout="calc()" readonly>   
                                </div>
                            </div>
                            <div class="col">
                                <label for="empid" class="control-label">مبلغ كفالة موظف آخر</label>
                                <input type="text" class="form-control" id="anothSponosrEmp" name="anothSponosrEmp" onfocusout="calc()" value="{{$item->anothSponosrEmp}}" readonly>
                            </div>
                            <div class="col">
                                <label for="empid" class="control-label">إجمالي الإلتزامات</label>
                                <input type="text" class="form-control" id="totalCommitmentEmp" name="totalCommitmentEmp" value="{{$item->totalCommitmentEmp}}" readonly >
                            </div>
                            <div class="col">
                                <label for="empid" class="control-label">الضمانات المتاحة</label>
                                <input type="text" class="form-control" id="guaranteesAvailableEmp" name="guaranteesAvailableEmp" value="{{$item->guaranteesAvailableEmp}}"   readonly >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    @if (!$sprId)
                        <input type="hidden" id="sprAvilb" name="sprAvilb" value="0">
                        <div class="card bd-0 mg-b-20 bg-danger">
                            <div class="card-body text-white">
                                <div class="main-error-wrapper">
                                    <i class="si si-close mg-b-20 tx-50"></i>
                                    <h4 class="mg-b-0">هذا الطلب ليس به كافل</h4>
                                </div>
                            </div>
                        </div>
                    @else
                        <input type="hidden" id="sprAvilb" name="sprAvilb" value="1">
                        <div class="card">
                            <div class="card-body">
                                <h4>الكافل :  {{$item->sponsor}}</h4>
                                <h6> الرقم الوظيفي: {{ $item->sprId}}</h6>
                                <hr>
                                <div class="row">
                                    <label class="control-label">حالة الكافل</label>
                                    @if ($item->approvalSponsor == 1)
                                        <input type="text" class="form-control" id="aprovalSponsor" value="موافقة الكافل" disabled style="color: green; font-weight: bold">
                                    @elseif ($item->approvalSponsor == 2)
                                        <input type="text" class="form-control" id="aprovalSponsor" value="رفض الكافل" disabled style="color: red; font-weight: bold">
                                    @else
                                        <input type="text" class="form-control" id="aprovalSponsor" value=" في إنتظار رد الكافل" disabled style="color: blue; font-weight: bold">
                                    @endif
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="sprId" class="form-control" value="{{ $item->sprId }}" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="salary" class="control-label">الراتب</label>
                                        <input type="text" class="form-control" id="salarySpr" name="salarySpr" value="{{ $item->salarySpr }}" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="sprDeductionsBox" class="control-label">قسط الإشتراك</label>
                                        <input type="text" class="form-control" id="sprDeductionsBox" name="sprDeductionsBox" value="{{$item->balanceboxSpr}}" readonly>
                                    </div>
                                </div>
                                <br>
                                <h5 class="text-center">الضمانات</h5>
                                <div class="row">
                                    <div class="col">
                                        <label for="endService" class="control-label">رصيد نهاية الخدمة</label>
                                        <input type="text" class="form-control" id="endServiceSpr" name="endServiceSpr" value="{{$item->endServiceSpr}}" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="balancebox" class="control-label">رصيد اشتراك الصندوق</label>
                                        <input type="text" class="form-control" id="balanceboxSpr" name="balanceboxSpr" onfocusout="calc()" value="{{$item->balanceboxSpr}}" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label">إجمالي الضمانات</label>
                                    <input type="text" class="form-control" id="totalGuaranteesSpr" name="totalGuaranteesSpr" value="{{$item->totalGuaranteesSpr}}" readonly >
                                </div>
                                <br>
                                <h5 class="text-center">الإلتزمات</h5>
                                <div class="row">
                                    <div class="col">
                                        <label for="empid" class="control-label">مديونية أجهزة واثاث</label>
                                        <input type="text" class="form-control" id="debtFurnitureSpr" name="debtFurnitureSpr" value="{{$item->debtFurnitureSpr}}" onfocusout="calc()">
                                    </div>
                                    <div class="col">
                                        <label for="empid" class="control-label"> مديونية سيارات</label>
                                        <input type="text" class="form-control" id="debtCarSpr" name="debtCarSpr"value="{{$item->debtCarSpr}}" onfocusout="calc()">   
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label">مبلغ كفالة موظف آخر</label>
                                    <input type="text" class="form-control" id="anothSponosrSpr" name="anothSponosrSpr" onfocusout="calc()" value="{{$item->anothSponosrSpr}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label">إجمالي الإلتزامات</label>
                                    <input type="text" class="form-control" id="totalCommitmentSpr" name="totalCommitmentSpr" value="{{$item->totalCommitmentSpr}}" readonly >
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label">الضمانات المتاحة</label>
                                    <input type="text" class="form-control" id="guaranteesAvailableSpr" name="guaranteesAvailableSpr"  readonly >
                                </div>                                      
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label">إجمالي الضمانات</label>
                                    <input type="text" class="form-control" id="totalGuaranteesAll" name="totalGuaranteesAll" value="{{$item->totalGuaranteesAll}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label">إجمالي الإلتزامات</label>
                                    <input type="text" class="form-control" id="totalCommitmentAll" name="totalCommitmentAll" value="{{$item->totalCommitmentAll}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label">الضمانات المتاحة</label>
                                    <input type="text" class="form-control" id="guaranteesAvailable" name="guaranteesAvailable" value="{{$item->guaranteesAvailable}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label">مبلغ الضمان المطلوب</label>
                                    <input type="text" class="form-control" id="purchasingValueGurnt" name="purchasingValueGurnt" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label"> تقييم الوضع المالي لمقدم الطلب</label>
                                    <select class="form-control" id="evaluation" name="evaluation" onchange="refusal()" disabled>
                                        @if ($item->evaluation == 1)
                                            <option value="1" >الضمانات  كافية</option>
                                            <option value="2" >الضمانات غير كافية</option> 
                                        @else
                                            <option value="2" >الضمانات غير كافية</option>    
                                            <option value="1" >الضمانات  كافية</option>
                                        @endif
                                        {{-- <option value="0" >الرجاء إختيار التقييم</option>
                                        <option value="1" >الضمانات  كافية</option>
                                        <option value="2" >الضمانات غير كافية</option> --}}
                                    </select>
                                </div>
                            </div>
                            <label for="empid" class="control-label"> الضمانات المعتمدة</label>
                            <div class="row">
                                
                                {{-- <div class="col-lg-3">
                                    <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية الخدمة صاحب الطلب"><span>نهاية الخدمة صاحب الطلب</span></label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد الاشتراك صاحب الطلب"><span>رصيد الاشتراك صاحب الطلب</span></label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية خدمة الكفيل"><span>نهاية خدمة الكفيل</span></label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد اشتراك الكفيل"><span>رصيد اشتراك الكفيل</span></label>
                                </div> --}}
                                {{-- @foreach ($approval as $app)
                                <div class="col-lg-3">
                                    <label class="ckbox"><input type="checkbox" checked name="approvedGuarantees[]" value="{{$app->approvedGuarantees}}"><span>{{$app->approvedGuarantees}}</span></label>
                                </div>
                                    @switch($app->approvedGuarantees)
                                        
                                        @case('نهاية الخدمة صاحب الطلب' || 'رصيد الاشتراك صاحب الطلب')
                                        <div class="col-lg-3">
                                            <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" checked value="نهاية الخدمة صاحب الطلب"><span>نهاية الخدمة صاحب الطلب</span></label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" checked value="رصيد الاشتراك صاحب الطلب"><span>رصيد الاشتراك صاحب الطلب</span></label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية خدمة الكفيل"><span>نهاية خدمة الكفيل</span></label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد اشتراك الكفيل"><span>رصيد اشتراك الكفيل</span></label>
                                        </div>
                                            @break
                                        @case('رصيد الاشتراك صاحب الطلب')
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية الخدمة صاحب الطلب"><span>نهاية الخدمة صاحب الطلب</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" checked value="رصيد الاشتراك صاحب الطلب"><span>رصيد الاشتراك صاحب الطلب</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية خدمة الكفيل"><span>نهاية خدمة الكفيل</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد اشتراك الكفيل"><span>رصيد اشتراك الكفيل</span></label>
                                            </div>
                                            @break
                                        @case('نهاية خدمة الكفيل')
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية الخدمة صاحب الطلب"><span>نهاية الخدمة صاحب الطلب</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد الاشتراك صاحب الطلب"><span>رصيد الاشتراك صاحب الطلب</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" checked value="نهاية خدمة الكفيل"><span>نهاية خدمة الكفيل</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد اشتراك الكفيل"><span>رصيد اشتراك الكفيل</span></label>
                                            </div>
                                            @break
                                        @case('رصيد اشتراك الكفيل')
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية الخدمة صاحب الطلب"><span>نهاية الخدمة صاحب الطلب</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد الاشتراك صاحب الطلب"><span>رصيد الاشتراك صاحب الطلب</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية خدمة الكفيل"><span>نهاية خدمة الكفيل</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" checked value="رصيد اشتراك الكفيل"><span>رصيد اشتراك الكفيل</span></label>
                                            </div>
                                            @break
                                        @default
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية الخدمة صاحب الطلب"><span>نهاية الخدمة صاحب الطلب</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد الاشتراك صاحب الطلب"><span>رصيد الاشتراك صاحب الطلب</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="نهاية خدمة الكفيل"><span>نهاية خدمة الكفيل</span></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="ckbox"><input type="checkbox" name="approvedGuarantees[]" value="رصيد اشتراك الكفيل"><span>رصيد اشتراك الكفيل</span></label>
                                            </div>
                                    @endswitch
                                @endforeach --}}
                                
                                
                            </div>
                            <br><br>
                            <div class="row" id="resonRefusal">
                                <div class="col-lg">
                                    <label for="">السبب</label>
                                    <textarea class="form-control" name="reson" rows="3" readonly>{{$item->reson}}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label">القيمة الشرائية الفعلية</label>
                                    <input type="text" class="form-control" id="guaranteesAvailable" name="guaranteesAvailable" value="{{$item->lastPurchasingValue}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label">سعر البيع للموظف</label>
                                    <input type="text" class="form-control" id="purchasingValueGurnt" name="purchasingValueGurnt" value="{{$item->salesPrice}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label">القسط الشهري</label>
                                    <input type="text" class="form-control" id="guaranteesAvailable" name="guaranteesAvailable" value="{{$item->monthlyInstallment}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="empid" class="control-label">تاريخ القسط الاخير</label>
                                    <input type="text" class="form-control" id="purchasingValueGurnt" name="purchasingValueGurnt" value="{{$item->dateLastInstallment}}" readonly>
                                </div>
                            </div>
                            {{-- <div class="d-flex justify-content-center">
                                <button type="submit" id="refusalBtn" class="btn btn-danger" style="display: none" >رفض الطلب</button>
                                <button type="submit" id="acceptBtn"  class="btn btn-primary" style="display: none">إعتماد الطلب</button>
                            </div> --}}
                        </form>
                        </div>
                    </div>
                    <div style="margin-bottom: 180px"></div>
                </div>
            
        @endforeach
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
    <script src="{{ URL::asset('public/assets/js/Saving/analysis2.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>

    <script>
   
        function refusal() {
            let  guaranteesAvailable = document.getElementById('guaranteesAvailable').value,
            purchasingValueGurnt = document.getElementById('purchasingValueGurnt').value,
            evaluation = document.getElementById('evaluation').value,
            refusalBtn = document.getElementById('refusalBtn'),
            acceptBtn = document.getElementById('acceptBtn'),
            resonRefusal = document.getElementById('resonRefusal');
            if (guaranteesAvailable || purchasingValueGurnt)
            {
                if (evaluation == 1) {
                    /* resonRefusal.style.display = "none"; */
                    acceptBtn.style.display = "block";
                    refusalBtn.style.display = "none"
                } else if(evaluation == 2) {
                    /* resonRefusal.style.display = "block"; */
                    acceptBtn.style.display = "none"
                    refusalBtn.style.display = "block";
                }else{
                    /* resonRefusal.style.display = "none"; */
                    acceptBtn.style.display = "none"
                    refusalBtn.style.display = "none";
                }    
            } else {
                alert('الرجاء مراجعة المدخلات');
            }
            
        }
        
    </script>
    
@endsection
