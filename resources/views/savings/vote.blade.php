@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('menu.savings') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.vote') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
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
            <div class="card w-100">
                <div class="card-body">
                    <div class="col">
                        <label for="candidateposition" class="control-label">المنصب المراد التصويت له</label>
                        <select name="candidateposition" id="candidateposition" class="form-control" onchange="vote()">
                            <option value="0">المنصب المراد التصويت له</option>
                            <option value="1">رئيس الجمعية العمومية</option>
                            <option value="2"> رئيس مجلس إدارة الصندوق</option>
                            <option value="3">نائب رئيس مجلس إدارة الصندوق</option>
                            <option value="4">عضو مجلس إدارة الصندوق</option>

                        </select>
                    </div>
                    <br><br>
                    <div class="row row-sm" id="v1" style="display: none">
                        @if (!count($v1))
                            <div class="card bd-0 mg-b-20 bg-danger">
                                <div class="card-body text-white">
                                    <div class="main-error-wrapper">
                                        <i class="si si-close mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-0">عفواً لايوجد مرشح لهذا المنصب</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (count($vote1))
                            <div class="card bd-0 mg-b-20 bg-danger">
                                <div class="card-body text-white">
                                    <div class="main-error-wrapper">
                                        <i class="si si-close mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-0">عفواً لقد قمت بالتصويت مسبقاً</h4>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="row">
                            <div id="lv1">
                                <h4> عدد المترشحين {{count($v1)}} يجب إختيار مترشح واحد</h4>            
                            </div>
                        </div>
                            @foreach ($v1 as $item)
                                <div class="col-xl-3 col-lg-3 col-md-12">
                                    <div class="card text-center">
                                        <img class="card-img-top avatar-card2" src="{{ $item->avatar }}" alt="">
                                        <div class="card-body">
                                            <h1 class="card-title mb-3">{{ $item->name }}</h1>
                                            <p class="card-text"><strong>الرقم الوظيفي :</strong> {{ $item->empid }}</p>
                                            <p class="card-text"><strong>الإدارة :</strong> {{ $item->dept ? $item->dept  : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"> <strong>القسم :</strong> {{ $item->sectn ? $item->sectn : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"><strong>الوظيفة الحالية :</strong> {{ $item->job ? $item->job : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"><strong>المؤهل العلمي :</strong> {{ $item->qualification ? $item->qualification : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text">
                                                <strong>المنصب المرشح له :</strong>
                                                رئيس الجمعية العمومية
                                                {{-- @switch($item->candidateposition)
                                                    @case(1)
                                                    رئيس الجمعية العمومية
                                                        @break
                                                    @case(2)
                                                    رئيس مجلس إدارة الصندوق
                                                        @break
                                                    @case(3)
                                                    نائب رئيس مجلس إدارة الصندوق
                                                        @break
                                                    @case(4)
                                                    عضو مجلس إدارة الصندوق
                                                        @break
                                                    @default
                                                    لاتتوفر بيانات
                                                @endswitch --}}
                                            </p>
                                            <p class="card-text"><strong>الجوال :</strong> {{ $item->mobile ? $item->mobile : "لاتتوفر بيانات"}}</p>
                                            <form action="{{route('savevote')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="candidatePosition" value="1">
                                                <input type="hidden" name="candidatePerson" value="{{$item->empid}}">
                                                <button class="btn btn-success" type="submit">تصويت</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row row-sm" id="v2" style="display: none">
                        @if (!count($v2))
                            <div class="card bd-0 mg-b-20 bg-danger">
                                <div class="card-body text-white">
                                    <div class="main-error-wrapper">
                                        <i class="si si-close mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-0">عفواً لايوجد مرشح لهذا المنصب</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (count($vote2))
                            <div class="card bd-0 mg-b-20 bg-danger">
                                <div class="card-body text-white">
                                    <div class="main-error-wrapper">
                                        <i class="si si-close mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-0">عفواً لقد قمت بالتصويت مسبقاً</h4>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div id="lv2">
                            <h4> عدد المترشحين {{count($v2)}} يجب إختيار مترشح واحد</h4>            
                        </div>
                        <br><br>
                            @foreach ($v2 as $item)
                                <div class="col-xl-3 col-lg-3 col-md-12">
                                    <div class="card text-center">
                                        <img class="card-img-top avatar-card2" src="{{ $item->avatar }}" alt="">
                                        <div class="card-body">
                                            <h1 class="card-title mb-3">{{ $item->name }}</h1>
                                            <p class="card-text"><strong>الرقم الوظيفي :</strong> {{ $item->empid }}</p>
                                            <p class="card-text"><strong>الإدارة :</strong> {{ $item->dept ? $item->dept  : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"> <strong>القسم :</strong> {{ $item->sectn ? $item->sectn : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"><strong>الوظيفة الحالية :</strong> {{ $item->job ? $item->job : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"><strong>المؤهل العلمي :</strong> {{ $item->qualification ? $item->qualification : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text">
                                                <strong>المنصب المرشح له :</strong>
                                                @switch($item->candidateposition)
                                                    @case(1)
                                                    رئيس الجمعية العمومية
                                                        @break
                                                    @case(2)
                                                    رئيس مجلس إدارة الصندوق
                                                        @break
                                                    @case(3)
                                                    نائب رئيس مجلس إدارة الصندوق
                                                        @break
                                                    @case(4)
                                                    عضو مجلس إدارة الصندوق
                                                        @break
                                                    @default
                                                    لاتتوفر بيانات
                                                @endswitch
                                            </p>
                                            <p class="card-text"><strong>الجوال :</strong> {{ $item->mobile ? $item->mobile : "لاتتوفر بيانات"}}</p>
                                            <form action="{{route('savevote')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="candidatePosition" value="2">
                                                <input type="hidden" name="candidatePerson" value="{{$item->empid}}">
                                                <button class="btn btn-success" type="submit">تصويت</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                    </div>
                    <div class="row row-sm" id="v3" style="display: none">
                        @if (!count($v3))
                            <div class="card bd-0 mg-b-20 bg-danger">
                                <div class="card-body text-white">
                                    <div class="main-error-wrapper">
                                        <i class="si si-close mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-0">عفواً لايوجد مرشح لهذا المنصب</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (count($vote3))
                            <div class="card bd-0 mg-b-20 bg-danger">
                                <div class="card-body text-white">
                                    <div class="main-error-wrapper">
                                        <i class="si si-close mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-0">عفواً لقد قمت بالتصويت مسبقاً</h4>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row" id="lv3">
                                <h4> عدد المترشحين {{count($v3)}} يجب إختيار مترشح واحد</h4>            
                            </div>
                            <br><br>
                            <div class="row">
                                @foreach ($v3 as $item)
                                    <div class="col-xl-3 col-lg-3 col-md-12">
                                        <div class="card text-center">
                                            <img class="card-img-top avatar-card2" src="{{ $item->avatar }}" alt="">
                                            <div class="card-body">
                                                <h1 class="card-title mb-3">{{ $item->name }}</h1>
                                                <p class="card-text"><strong>الرقم الوظيفي :</strong> {{ $item->empid }}</p>
                                                <p class="card-text"><strong>الإدارة :</strong> {{ $item->dept ? $item->dept  : "لاتتوفر بيانات"}}</p>
                                                <p class="card-text"> <strong>القسم :</strong> {{ $item->sectn ? $item->sectn : "لاتتوفر بيانات"}}</p>
                                                <p class="card-text"><strong>الوظيفة الحالية :</strong> {{ $item->job ? $item->job : "لاتتوفر بيانات"}}</p>
                                                <p class="card-text"><strong>المؤهل العلمي :</strong> {{ $item->qualification ? $item->qualification : "لاتتوفر بيانات"}}</p>
                                                <p class="card-text">
                                                    <strong>المنصب المرشح له :</strong>
                                                    @switch($item->candidateposition)
                                                        @case(1)
                                                        رئيس الجمعية العمومية
                                                            @break
                                                        @case(2)
                                                        رئيس مجلس إدارة الصندوق
                                                            @break
                                                        @case(3)
                                                        نائب رئيس مجلس إدارة الصندوق
                                                            @break
                                                        @case(4)
                                                        عضو مجلس إدارة الصندوق
                                                            @break
                                                        @default
                                                        لاتتوفر بيانات
                                                    @endswitch
                                                </p>
                                                <p class="card-text"><strong>الجوال :</strong> {{ $item->mobile ? $item->mobile : "لاتتوفر بيانات"}}</p>
                                                <form action="{{route('savevote')}}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="candidatePosition" value="3">
                                                    <input type="hidden" name="candidatePerson" value="{{$item->empid}}">
                                                    <button class="btn btn-success" type="submit">تصويت</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="row row-sm" id="v4" style="display: none">
                        
                        @if (!count($v4))
                            <div class="card bd-0 mg-b-20 bg-danger">
                                <div class="card-body text-white">
                                    <div class="main-error-wrapper">
                                        <i class="si si-close mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-0">عفواً لايوجد مرشح لهذا المنصب</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (count($vote4) >= 3)
                            <div class="card bd-0 mg-b-20 bg-danger">
                                <div class="card-body text-white">
                                    <div class="main-error-wrapper">
                                        <i class="si si-close mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-0">عفواً لقد قمت بالتصويت مسبقاً</h4>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row" id="lv4">
                                <h4> عدد المترشحين {{count($v4)}} يجب إختيار ثلاثة مترشحين</h4>
                            </div>
                            <div class="row">
                                @foreach ($v4 as $item)
                                <div class="col-xl-3 col-lg-3 col-md-12">
                                    <div class="card text-center">
                                        <img class="card-img-top avatar-card2" src="{{ $item->avatar }}" alt="">
                                        <div class="card-body">
                                            <h1 class="card-title mb-3">{{ $item->name }}</h1>
                                            <p class="card-text"><strong>الرقم الوظيفي :</strong> {{ $item->empid }}</p>
                                            <p class="card-text"><strong>الإدارة :</strong> {{ $item->dept ? $item->dept  : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"> <strong>القسم :</strong> {{ $item->sectn ? $item->sectn : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"><strong>الوظيفة الحالية :</strong> {{ $item->job ? $item->job : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text"><strong>المؤهل العلمي :</strong> {{ $item->qualification ? $item->qualification : "لاتتوفر بيانات"}}</p>
                                            <p class="card-text">
                                                <strong>المنصب المرشح له :</strong>
                                                
                                                @switch($item->candidateposition)
                                                    @case(1)
                                                    رئيس الجمعية العمومية
                                                        @break
                                                    @case(2)
                                                    رئيس مجلس إدارة الصندوق
                                                        @break
                                                    @case(3)
                                                    نائب رئيس مجلس إدارة الصندوق
                                                        @break
                                                    @case(4)
                                                    عضو مجلس إدارة الصندوق
                                                        @break
                                                    @default
                                                    لاتتوفر بيانات
                                                @endswitch
                                            </p>
                                            <p class="card-text"><strong>الجوال :</strong> {{ $item->mobile ? $item->mobile : "لاتتوفر بيانات"}}</p>
                                            <form action="{{route('savevote')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="candidatePosition" value="4">
                                                <input type="hidden" name="candidatePerson" value="{{$item->empid}}">
                                                <button class="btn btn-success" type="submit">تصويت</button> 
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
    <!-- /row -->
    
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('public/assets/js/table-data.js') }}"></script>

    <script>
        function vote(){
            var candidateposition = document.getElementById('candidateposition').value,
                v1 = document.getElementById('v1'),
                v2 = document.getElementById('v2'),
                v3 = document.getElementById('v3'),
                v4 = document.getElementById('v4'),

                lv1 = document.getElementById('lv1'),
                lv2 = document.getElementById('lv2'),
                lv3 = document.getElementById('lv3'),
                lv4 = document.getElementById('lv4');
                /* alert('يمكنك التصويت لعدد 3 أشخاص'); */
                if (candidateposition == 1) {
                    v1.style.display = "flex";
                    lv1.style.display = "flex";
                    v2.style.display = "none";
                    v3.style.display = "none";
                    v4.style.display = "none";
                } else if (candidateposition == 2) {
                    v1.style.display = "none";
                    v2.style.display = "flex";
                    lv2.style.display = "flex";
                    v3.style.display = "none";
                    v4.style.display = "none";
                } else if (candidateposition == 3) {
                    v1.style.display = "none";
                    v2.style.display = "none";
                    v3.style.display = "flex";
                    lv3.style.display = "flex";
                    v4.style.display = "none";
                } else if (candidateposition == 4) {
                    v1.style.display = "none";
                    v2.style.display = "none";
                    v3.style.display = "none";
                    v4.style.display = "flex";
                    lv4.style.display = "flex";
                }else {
                    v1.style.display = "none";
                    v2.style.display = "none";
                    v3.style.display = "none";
                    v4.style.display = "none";
                    lv1.style.display = "none";
                    lv2.style.display = "none";
                    lv3.style.display = "none";
                    lv4.style.display = "none";
                }
                
        }
    </script>
    
@endsection
