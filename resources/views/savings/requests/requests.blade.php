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
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="addSavings" action="{{ route('box-requests.store') }}"
                        method="post" enctype="multipart/form-data" autocomplete="off" {{-- onsubmit="return validateForm()" --}}>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col">
                                <label for="empid" class="control-label">{{ __('lable.empId') }}</label>
                                <input type="text" class="form-control" id="empid" name="empid" readonly
                                    value="{{ $data[0]['emp_no'] }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="name" class="control-label">{{ __('lable.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" readonly
                                    value="{{ $data[0]['emp_nm'] }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">{{ __('lable.department') }}</label>
                                <input type="text" class="form-control" id="department" name="department" disabled
                                    value="{{ $data[0]['hirchy_prnt_nm'] }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">{{ __('lable.section') }}</label>
                                <input type="text" class="form-control" id="section" name="section" disabled
                                    value="{{ $data[0]['hirch_nm'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">{{ __('lable.mobile') }}</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                    value="{{ $data[0]['mobile_no'] }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">{{ __('lable.nationalty') }}</label>
                                <input type="text" class="form-control" id="nationalty" name="nationalty" disabled
                                    value="{{ $data[0]['nat_nm'] }}">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">{{ __('lable.gid') }}</label>
                                <input type="text" class="form-control" id="cardno" name="cardno" readonly
                                    value="{{ $data[0]['card_no'] }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">{{ __('lable.salary') }}</label>
                                <input type="text" class="form-control" id="salary" name="salary" readonly
                                    value="{{ $data[0]['total_sal'] }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm col-md">
                                <label for="deductionsHr" class="control-label">إجمالي الإستقطاعات</label>
                                <input type="text" class="form-control form-control-lg" name="deductionsHr" readonly>
                            </div>
                            <div class="col-sm col-md">
                                <label for="deductionsBox" class="control-label"> إستقطاعات الصندوق</label>
                                <input type="text" class="form-control form-control-lg" name="deductionsBox" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm col-md">
                                <label for="deductionsHr" class="control-label">إجمالي الإستقطاعات</label>
                                <input type="text" class="form-control form-control-lg" name="deductionsHr" readonly>
                            </div>
                            <div class="col-sm col-md">
                                <label for="deductionsBox" class="control-label"> إستقطاعات الصندوق</label>
                                <input type="text" class="form-control form-control-lg" name="deductionsBox" readonly>
                            </div>
                            {{-- <div class="col-sm col-md">
                                <label for="prvsInstallmentQ" class="control-label">هل يوجد لديك أقساط سابقة للصندوق</label>
                                <select class="form-control" id="oldboxselect" name="prvsInstallmentQ" onchange="return contribut()">
                                    
                                    <option value="1">لا</option>
                                    <option value="2">نعم</option>
                                </select>
                            </div>
                            <div class="col-sm col-md" id="oldboxtype" style="display: none">
                                <label for="prvsInstallmenType" class="control-label"> نوع القسط </label>
                                <select class="form-control" id="oldboxtypeselect" name="prvsInstallmenType">
                                    <option>الرجاء إختيار نوع القسط</option>
                                    @foreach ($boxrequeststype as $item)
                                    <option value="{{$item->id}}"> {{$item->name}} </option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-sm col-md">
                                <label for="reqType" class="control-label"> نوع الطلب </label>
                                <select class="form-control" id="typeorderselect" name="reqType" onchange="changetypeorder()" required>
                                    <option>الرجاء إختيار نوع الطلب</option>
                                    @foreach ($boxrequeststype as $item)
                                    <option value="{{$item->id}}"> {{$item->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">القيمة الشرائية</label>
                                <input type="text" class="form-control" id="purchasingValue" name="purchasingValue" placeholder="يجيب ان لايزيد المبلغ عن 15000 ريال"
                                onfocusout ="checkAmount()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <div class="col-sm col-md" >
                                <label id="durationlable" style="display: none" class="control-label"> مدة التقسيط </label>
                                <br><br>
                                <div class="rado" style="display: flex; justify-content: space-evenly;">
                                    <div id="rdo1"  style="display: none; margin-top: -14px">
                                        <input class="form-check-input" type="radio" name="installmentPeriod" id="candidatePerson4" value="1" required>
                                        <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson">
                                            سنة
                                        </label>
                                    </div>
                                    <div id="rdo2"  style="display: none; margin-top: -14px">
                                        <input class="form-check-input" type="radio" name="installmentPeriod" id="candidatePerson4" value="2" required>
                                        <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson">
                                            سنتان
                                        </label>
                                    </div>
                                    <div id="rdo3" style="display: none; margin-top: -14px">
                                        <input class="form-check-input" type="radio" name="installmentPeriod" id="candidatePerson4" value="3" required>
                                        <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson">
                                            ثلاث سنوات
                                        </label>
                                    </div>
                                    <div id="rdo4" style="display: none; margin-top: -14px">
                                        <input class="form-check-input" type="radio" name="installmentPeriod" id="candidatePerson4" value="4" required>
                                        <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson">
                                            أربع سنوات
                                        </label>
                                        
                                    </div>
                                    <div id="rdo5" style="display: none; margin-top: -14px">
                                        <input class="form-check-input" type="radio" name="installmentPeriod" id="candidatePerson4" value="5" required>
                                        <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson">
                                            خمس سنوات
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" id="device" style="display: none">
                            {{-- <table class="table" id="products_table">
                                <thead>
                                    <tr>
                                        <th><label for="empid" class="control-label" id="typeofdivc">وصف الطلب</label></th>
                                        <th><label for="empid" class="control-label">الكمية</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="product0">
                                        <td>
                                            <input type="text" class="form-control" name="deviceType[]" 
                                            placeholder="نأمل كتابة مواصفات الطلب بشكل دقيق مثال: ايفون 12 بروماكس 256 لون ازرق">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="deviceQty[]"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" 
                                            >
                                        </td>
                                    </tr>
                                    <tr id="product1"></tr>
                                </tbody>
                            </table> --}}
                            <div class="col" >
                                <label for="empid" class="control-label">وصف الأجهزة</label>
                                <input type="text" class="form-control" name="descDevice" placeholder="نأمل كتابة مواصفات الجهاز بشكل دقيق مثال: ايفون 12 بروماكس 256 لون ازرق">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">الكمية</label>
                                <input type="text" class="form-control" name="qtyDevice" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                        <div class="row" id="furniture" style="display: none">
                            <div class="col">
                                <label for="empid" class="control-label">وصف الأثاث</label>
                                <input type="text" class="form-control" name="descFurniture" placeholder="نأمل كتابة مواصفات الأثاث بشكل دقيق ">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">الكمية</label>
                                <input type="text" class="form-control" name="qtyFurniture" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                        <div class="row" id="car" style="display: none">
                            <div class="col">
                                <label for="empid" class="control-label">وصف السيارة</label>
                                <input type="text" class="form-control" name="descCar" placeholder="نأمل كتابة مواصفات السيارة بشكل دقيق">
                            </div>
                            <div class="col-sm col-md">
                                <label for="empid" class="control-label">الكمية</label>
                                <input type="text" class="form-control" name="qtyCar" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <button id="add_row" class="btn btn-default pull-left">+ إضافة وصف</button>
                                <button id='delete_row' class="pull-right btn btn-danger">- حذف وصف</button>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-sm col-md" id="sponsor" {{-- style="display: none" --}}>
                                <label for="sponsor" class="control-label"> الكافل </label>
                                <select class="form-control" name="sponsor">
                                    <option value="0" >الرجاء إختيار الكافل</option>
                                    @foreach ($savings as $item)
                                        <option value="{{ $item->empid }}">{{ $item->name }}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm col-md">
                                <h5 class="card-title">التوقيع</h5>
                                <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                {{-- <p class="text-danger">الرجاء إرفاق صورة من توقيعك</p> --}}
                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="signature" class="dropify"
                                        accept=".jpg, .png, image/jpeg, image/png" data-height="70" />
                                </div>
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
                        <div class="d-flex justify-content-center">
                            <button type="submit" id="savelink" class="btn btn-primary"
                                style="display: none;">تقديم الطلب</button>
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
    <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ URL::asset('public/assets/js/sweet-alert.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>
    
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

        function changetypeorder() {
            var typeorderselect = document.getElementById('typeorderselect').value,
            durationlable = document.getElementById('durationlable'),
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
                durationlable.style.display = "block";
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
                durationlable.style.display = "block";
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
                durationlable.style.display = "none";
                rdo1.style.display = "none";
                rdo2.style.display = "none";
                rdo3.style.display = "none";
                rdo4.style.display = "none";
                rdo5.style.display = "none";
                device.style.display = "none";
                car.style.display = "none";
            }
        }
        /* $(document).ready(function(){
            let row_number = 1;
            $("#add_row").click(function(e){
                e.preventDefault();
                let new_row_number = row_number - 1;
                $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
                $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
                row_number++;
            });

            $("#delete_row").click(function(e){
                e.preventDefault();
                if(row_number > 1){
                $("#product" + (row_number - 1)).html('');
                row_number--;
                }
            });
        }); */

        function showlink() {
            var check = document.getElementById('agree').checked,
                savebtn = document.getElementById('savelink');
            if (check === true) {
                savebtn.style.display = "block";
                /* alert(check); */
            } else {
                savebtn.style.display = "none";
                /* alert(check); */
            }
        }

        function checkAmount() {
            var amount = document.getElementById('purchasingValue').value,
                amount2 = document.getElementById('purchasingValue');
            if (amount > 15000)
            {
                alert('يجيب ان لايزيد المبلغ عن 15000 ريال');
                amount = "0" ;
                amount2.focus();
                return false;
            }
        }
        /* function contribut() {
            var oldboxselect = document.getElementById('oldboxselect').value,
            oldboxtype = document.getElementById('oldboxtype'),
            oldboxamount = document.getElementById('oldboxamount');
            if (oldboxselect == 2) {
                oldboxtype.style.display = "block";
                oldboxamount.style.display = "block";

            } else {
                oldboxtype.style.display = "none";
                oldboxamount.style.display = "none";
            }
        } */
        /* function installmenType()
        {
            var oldboxselect = document.getElementById('oldboxselect').value,
                oldboxtypeselect = document.getElementById('oldboxtypeselect').value,
                typeorderselect = document.getElementById("typeorderselect");

            if (oldboxselect == 2) {
                if (oldboxtypeselect == 1) {
                    typeorderselect.remove(1);
                } else if (oldboxtypeselect == 2) {
                    typeorderselect.remove(2);
                }
            }
        } */

        
        
    </script>
    <script>
        /* $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#addSavings").submit(function(e) {
            e.preventDefault();
            var formData = $("#addSavings").serialize();
            $.ajax({
                url: {
                    {
                        route('savings.store')
                    }
                },
                type: "POST",
                data: formData,
                success: function(dataBack) {

                },
                error: function(xhr, status, error) {

                }
            })
        }) */

    </script>
@endsection
