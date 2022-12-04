@extends('layouts.master')
@section('css')
    <!--- Internal Sweet-Alert css-->
    <link href="{{ URL::asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('menu.savings') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.reqsavings') }}</span>
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
                    {{-- @if (count($savings) >= 1) --}}
                    
                    @if(count($savings) >= 1)
                        <form action="{{ route('savings.update', auth()->user()->empid) }}" method="post"
                            enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            @method('patch')
                            @foreach ($savings as $item)
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">{{ __('lable.empId') }}</label>
                                        <input type="text" class="form-control" id="empid" name="empid" disabled
                                            value="{{ $item->empid }}">
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">{{ __('lable.name') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" disabled
                                            value="{{ $item->name }}">
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">{{ __('lable.dateOfAppointment') }}</label>
                                        <input class="form-control fc-datepicker" name="dateOfAppointment"
                                            placeholder="YYYY-MM-DD" type="text" value="{{ $item->dateOfAppointment }}"
                                            disabled>
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="empid" class="control-label">{{ __('lable.salary') }}</label>
                                        <input type="text" class="form-control" id="salary" name="salary" disabled
                                            value="{{ $data[0]['total_sal'] }}{{-- {{ $item->salary }} --}}"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="inputName"
                                            class="control-label">{{ __('lable.participationType') }}</label>
                                        <select name="participationType" id="participationType" class="form-control"
                                            disabled>
                                            <option value="1">{{ __('lable.new') }}</option>
                                        </select>
                                        <input class="form-control fc-datepicker" name="datePremium"
                                            placeholder="YYYY-MM-DD" type="hidden"
                                            value="{{ $item->datePremium /* date('Y-m-d') */ }}" required>
                                    </div>
                                    <div class="col-sm col-md">
                                        <label for="newpremium" class="control-label"> {{ __('lable.newpremium') }}</label>
                                        <input type="text" class="form-control form-control-lg" id="newpremium"
                                            name="newpremium"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            value="{{ $item->newpremium }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    @if ($item->contribute)
                                        <div class="col-sm col-md">
                                            <label for="newpremium" class="control-label">{{ __('lable.contribute') }}</label>
                                            <select class="form-control" id="contributeselect" name="contributeselect"
                                                onchange="return contribut()">
                                                <option value="2">نعم</option>
                                                <option value="1">لا</option>
                                            </select>
                                        </div>
                                        <div class="col-sm col-md" id="contribute">
                                            <label for="newpremium" class="control-label"> المبلغ</label>
                                            <input type="text" class="form-control form-control-lg" id="amountmosahma" name="contribute"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                value={{ $item->contribute }} onfocusout="checkAmount()">
                                                <label style="color: red; font-weight: bold">يشترط ان لا يقل مبلغ المساهمة عن خمسة الآلآف ريال</label>
                                        </div>
                                    @else
                                        <div class="col-sm col-md">
                                            <label for="newpremium" class="control-label">
                                                {{ __('lable.contribute') }}</label>
                                            <select class="form-control" id="contributeselect" name="contributeselect"
                                                onchange="return contribut()">
                                                <option value="1">لا</option>
                                                <option value="2">نعم</option>
                                            </select>
                                        </div>
                                        <div class="col-sm col-md" id="contribute" style="display: none">
                                            <label for="newpremium" class="control-label"> المبلغ</label>
                                            <input type="text" class="form-control form-control-lg" id="amountmosahma" name="contribute"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                value=0 required onfocusout="checkAmount()">
                                                <label style="color: red; font-weight: bold">يشترط ان لا يقل مبلغ المساهمة عن خمسة الآلآف ريال</label>
                                        </div>
                                    @endif

                                </div>
                                <br><br>
                                <div class="row">
                                    @if (empty($item->signature) || $item->signature == 'defualt.png')
                                        <div class="col-sm col-md">
                                            <h5 class="card-title">التوقيع</h5>
                                            <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                            <p class="text-danger">الرجاء إرفاق صورة من توقيعك</p>
                                            <div class="col-sm-sm-12 col-md-12">
                                                <input type="file" name="signature" class="dropify"
                                                    accept=".jpg, .png, image/jpeg, image/png" data-height="70" />
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <br><br>
                                <div class="row">
                                    {{-- <label style="font-size: 16px; font-weight: bold; margin: 10px auto" for="">يوزع العائد السنوي على جميع الاعضاء في نهاية كل سنة مالية</label> --}}

                                    <label style="font-size: 16px">
                                        <input type="checkbox" id="agree" onchange="showlink()" checked disabled>
                                        <strong>
                                            أقر بأنني قد فوضت مجلس إدارة صندوق الادخار للعاملين في الندوة العالمية للشباب الإسلامي بأن يخصم قسطاً شهرياً بقيمة المبلغ
                                            المذكور أعلاه من الراتب بتاريخ 25 من كل شهر ميلادي ويحوله لحساب الصندوق لادخاره واستثماره باسمي وفقاً للائحة الصندوق.
                                            كما أقر بأني اطلعت على لائحة الصندوق وتفهمت جميع بنودها وقبلت التعامل
                                            بموجبها في جميع معاملاتي ومستحقاتي حالياً ومستقبلاً، وفي حال رغبتي الانسحاب من
                                            الصندوق فإني التزم بإبلاغ مجلس إدارة الصندوق كتابياً بذلك قبل شهرين من التاريخ
                                            المحدد لانسحابي من الصندوق. وفي حال وجود أي مستحقات مسجلة علي لصالح صندوق
                                            الادخار فإني أفوض الندوة بأن تخصم هذه المستحقات من مرتبي أو أية مستحقات أخرى.
                                        </strong>
                                        <br><br>
                                        <div id="iqrar" style="display: none; color:red">
                                            <h4 >* شروط المساهمة: </h4>
                                            <strong >
                                                    1-	آخر موعد لسداد مبلغ المساهمة يوم 2020/12/28 إما بشيك أو حوالة لحساب الندوة العالمية للشباب الإسلامي بمصرف الراجحي رقم الآيبان (SA1380000279608010666422) أو توريدها في صندوق المالية.  
                                                    <br>
                                                    2- لايحق للمساهم سحب مبلغ مساهمته حتى نهاية السنة المالية التي تبدأ في 2021/01/01 , ويجوز إستثناءاً بعد موافقة مجلس إدارة الصندوق سحب 50% من أصل المساهمة بعد مضي النصف الاول من السنة على أن يكون الصرف, خلال شهرين من تاريخ تقديم الطلب.
                                            </strong>
                                        </div>
                                        
                                    </label>
                                </div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" id="savelink" class="btn btn-primary">{{ __('lable.agreebtn') }}</button>
                                </div>
                            @endforeach
                        </form>
                    @else
                    
                        <form id="addSavings" action="{{ route('savings.store') }}"
                            method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col">
                                    <label for="empid" class="control-label">{{ __('lable.empId') }}</label>
                                    <input type="text" class="form-control" id="empid" name="empid" disabled
                                        value="{{ $data[0]['emp_no'] }}">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" disabled
                                        value="{{ $data[0]['emp_nm'] }}">
                                    <input type="hidden" class="form-control" id="name" name="name"
                                        value="{{ $data[0]['emp_nm'] }}">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.dateOfAppointment') }}</label>
                                    <input class="form-control fc-datepicker" name="dateOfAppointment"
                                        placeholder="YYYY-MM-DD" type="text"
                                        value="{{ $data[0]['start_date'] }}" disabled>
                                    <input class="form-control fc-datepicker" name="dateOfAppointment"
                                        placeholder="YYYY-MM-DD" type="hidden"
                                        value="{{ $data[0]['start_date'] }}">
                                </div>
                                <div class="col-sm col-md">
                                    <label for="empid" class="control-label">{{ __('lable.salary') }}</label>
                                    <input type="text" class="form-control" id="salary" name="salary" disabled
                                        value="{{ $data[0]['total_sal'] }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    <input type="hidden" class="form-control" id="salary" name="salary"
                                        value="{{ $data[0]['total_sal'] }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm col-md">
                                    <label for="inputName"
                                        class="control-label">{{ __('lable.participationType') }}</label>
                                    <select name="participationType" id="participationType" class="form-control">
                                        <option value="1">{{ __('lable.new') }}</option>
                                    </select>
                                    <input class="form-control fc-datepicker" name="datePremium"
                                        placeholder="YYYY-MM-DD" type="hidden" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-sm col-md">
                                    <label for="newpremium" class="control-label"> {{ __('lable.newpremium') }}</label>
                                    <input type="text" class="form-control form-control-lg" id="newpremium"
                                        name="newpremium" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm col-md">
                                    <label for="newpremium" class="control-label"> {{ __('lable.contribute') }}</label>
                                    <select class="form-control" id="contributeselect" onchange="return contribut()">
                                        <option value="1">لا</option>
                                        <option value="2">نعم</option>
                                    </select>
                                </div>
                                <div class="col-sm col-md" id="contribute" style="display: none">
                                    <label for="newpremium" class="control-label"> المبلغ</label>
                                    <input type="text" class="form-control form-control-lg" id="amountmosahma" name="contribute"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="0" onfocusout="checkAmount()">
                                        <label style="color: red; font-weight: bold">يشترط ان لا يقل مبلغ المساهمة عن خمسة الآلآف ريال</label>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-sm col-md">
                                    <h5 class="card-title">التوقيع</h5>
                                    <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                    <p class="text-danger">الرجاء إرفاق صورة من توقيعك</p>
                                    <div class="col-sm-12 col-md-12">
                                        <input type="file" name="signature" class="dropify"
                                            accept=".jpg, .png, image/jpeg, image/png" data-height="70" />
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <label style="font-size: 16px">
                                    <input type="checkbox" id="agree" onchange="showlink()" >
                                    <strong>
                                        أقر بأنني قد فوضت مجلس إدارة صندوق الادخار للعاملين في الندوة العالمية للشباب الإسلامي بأن يخصم قسطاً شهرياً بقيمة المبلغ
                                        المذكور أعلاه من الراتب بتاريخ 25 من كل شهر ميلادي ويحوله لحساب الصندوق لادخاره واستثماره باسمي وفقاً للائحة الصندوق.
                                        كما أقر بأني اطلعت على لائحة الصندوق وتفهمت جميع بنودها وقبلت التعامل
                                        بموجبها في جميع معاملاتي ومستحقاتي حالياً ومستقبلاً، وفي حال رغبتي الانسحاب من
                                        الصندوق فإني التزم بإبلاغ مجلس إدارة الصندوق كتابياً بذلك قبل شهرين من التاريخ
                                        المحدد لانسحابي من الصندوق. وفي حال وجود أي مستحقات مسجلة علي لصالح صندوق
                                        الادخار فإني أفوض الندوة بأن تخصم هذه المستحقات من مرتبي أو أية مستحقات أخرى.
                                    </strong>
                                    <br><br>
                                
                                    <div id="iqrar" style="display: none; color:red">
                                        <h4 >* شروط المساهمة: </h4>
                                        <strong >
                                                1-	آخر موعد لسداد مبلغ المساهمة يوم 2020/12/28 إما بشيك أو حوالة لحساب الندوة العالمية للشباب الإسلامي بمصرف الراجحي رقم الآيبان (SA1380000279608010666422) أو توريدها في صندوق المالية.  
                                                <br>
                                                2- لايحق للمساهم سحب مبلغ مساهمته حتى نهاية السنة المالية التي تبدأ في 2021/01/01 , ويجوز إستثناءاً بعد موافقة مجلس إدارة الصندوق سحب 50% من أصل المساهمة بعد مضي النصف الاول من السنة على أن يكون الصرف, خلال شهرين من تاريخ تقديم الطلب.
                                        </strong>
                                    </div>
                                </label>
                            </div>
                            
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" id="savelink" class="btn btn-primary" style="display: none;">{{ __('lable.agreebtn') }}</button>
                            </div>
                        </form>
                    @endif


                </div>
            </div>
            <div style="margin-bottom: 180px"></div>
        </div>

    </div>
    <!-- row closed -->

@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ URL::asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

        $(document).ready(function() {
            var contributeselect = document.getElementById('contributeselect').value,
            iqrar = document.getElementById('iqrar');
            if (contributeselect == 2) {
                iqrar.style.display = "block";
            }else{
                iqrar.style.display = "none";
            }
        });
        function validateForm() {
            var premium = document.getElementById('newpremium').value,
                sal = document.getElementById('salary').value,
                contributeselect = document.getElementById('contributeselect').value, 
                agreem = document.getElementById('agree-m'), 
                amount = sal * 0.5,
                amount2 = sal * 0.05;
            if (premium < amount2) {
                alert("يجب ان يكون المبلغ أكبر من 5% من إجمالي الراتب");
                return false;
            }
            if (premium > amount) {
                alert("يجب ان يكون المبلغ أصغر من 50% من إجمالي الراتب");    
            }   
        }
        function checkAmount()
        {
            var amountmosahma = document.getElementById('amountmosahma').value,
            amount = document.getElementById('amountmosahma');
            if (amountmosahma < 4999) {
                alert('يشترط ان لا يقل مبلغ المساهمة عن خمسة الآلآف ريال');
                amountmosahma = "0";
                amount.focus();
                return false;
            }
        }
        function showlink() {
            var check = document.getElementById('agree').checked,
                savebtn = document.getElementById('savelink');
            if (check === true) {
                savebtn.style.display = "block";
            } else {
                savebtn.style.display = "none";
            }
        }

        function contribut() {
            var contributeselect = document.getElementById('contributeselect').value,
                contribute = document.getElementById('contribute'),
                iqrar = document.getElementById('iqrar');
                /* agreem = document.getElementById('agree-m'); */

            if (contributeselect == 2) {
                contribute.style.display = "block";
                /* agreem.style.display = "flex"; */
                iqrar.style.display = "block";

            } else {
                contribute.style.display = "none";
                /* agreem.style.display = "none"; */
                iqrar.style.display = "none";
            }
        }

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
