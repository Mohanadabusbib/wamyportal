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
        
            <div class="card w-100">
                <div class="card-body">
                    {{-- @if (count($votes)) --}}
                    @if (count($votes2))
                        <div class="card bd-0 mg-b-20 bg-danger">
                            <div class="card-body text-white">
                                <div class="main-error-wrapper">
                                    <i class="si si-close mg-b-20 tx-50"></i>
                                    <h4 class="mg-b-0">عفواً لقد قمت بالتصويت مسبقاً</h4>
                                </div>
                            </div>
                        </div>
                    @else
                        <form action="{{route('savevote')}}" method="post">
                            {{ csrf_field() }}
                            {{-- <div class="row row-sm">
                                <h4 style="font-weight: bold; color: blue"> رئيس الجمعية العمومية</h4>
                            </div>
                            <div class="row row-sm">
                                @foreach ($v1 as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="candidatePerson1" value="{{ $item->empid }}" required>
                                    <input type="hidden" name="candidatePosition1" value="1" required>
                                    <input type="hidden" name="persoName1" value="{{ $item->name }}" required>
                                    <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson1">
                                        {{ $item->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <br><br>
                            <div class="row row-sm" style="color:red">
                                <h4 style="font-weight: bold; color: blue">رئيس مجلس إدارة الصندوق</h4>
                                <div>
                                    <strong>
                                        (يجب إختيار مرشح واحد)
                                    </strong>
                                </div>
                                
                            </div>
                            <div class="row row-sm">
                                @foreach ($v2 as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="candidatePerson2" value="{{ $item->empid }}" required>
                                    <input type="hidden" name="candidatePosition2" value="2" required>
                                    <input type="hidden" name="persoName2" value="{{ $item->name }}" required>
                                    <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson2">
                                        {{ $item->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <br><br>
                            <div class="row row-sm" style="color:red">
                                <h4 style="font-weight: bold; color: blue">نائب رئيس مجلس إدارة الصندوق</h4>
                                <div>
                                    <strong>
                                        (يجب إختيار مرشح واحد)
                                    </strong>
                                </div>
                            </div>
                            <div class="row row-sm">
                                @foreach ($v3 as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="candidatePerson3" value="{{ $item->empid }}" required>
                                    <input type="hidden" name="candidatePosition3" value="3" required>
                                    <input type="hidden" name="persoName3" value="{{ $item->name }}" required>
                                    <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson3">
                                        {{ $item->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div> --}}
                            <br><br>
                            <div class="row row-sm" style="color:red">
                                <h4 style="font-weight: bold; color: blue">اعضاء مجلس إدارة الصندوق</h4>
                               {{--  <div>
                                    <strong>
                                        (يجب إختيار ثلاثة مرشحين)
                                    </strong>
                                </div> --}}
                            </div>
                            <div class="row row-sm">
                                @foreach ($v4 as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="candidatePerson" id="candidatePerson4" value="{{ $item->empid }}" {{-- onchange="check()" --}} >
                                    {{-- <input type="hidden" name="candidatePosition[]" value="4" required>--}}
                                    {{-- <input type="hidden" name="persoName" value="{{ $item->name }}">  --}}
                                    <label class="form-check-label mr-3  tx-md-bold" for="candidatePerson">
                                        {{ $item->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <br><br>
                            <div class="row row-sm">
                                <button id="select" class="btn btn-success" type="submit">تصويت</button>
                            </div>
                        </form>
                    @endif
                    
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
        function check() {
            var countChk = document.querySelectorAll('input[type="checkbox"]:checked').length,
            /* elvalue = document.getElementById("candidatePerson4").value, */
            chk = document.querySelectorAll('input[type="checkbox"]:checked');
            if (countChk > 3) {
                alert('عفواً لايمكنك التصويت لأكثر من ثلاثة إعضاء');
                for (let index = 0; index < countChk; index++) {
                    chk[index].checked = false;
                }
        }
    }
    </script>
    
@endsection
