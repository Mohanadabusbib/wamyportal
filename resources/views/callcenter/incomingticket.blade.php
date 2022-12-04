@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('public/assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('public/assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('public/assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('menu.callCneter')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.incomingtransaction')}}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                {{-- <div class="card-header">
                    <a class="btn btn-primary">الطلبات</a>                    
                </div> --}}
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">{{__('menu.incomingtransaction')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>رقم الطلب</th>
                                                            <th>تاريخ الطلب</th>
                                                            <th>صاحب الطلب</th>
                                                            <th>الغرض من الإتصال</th>
                                                            <th>الإجراء</th>
                                                            <th>تحويل من </th>
                                                            <th>حالة الطلب </th>
                                                            <th>العمليات</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($tickets as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $x->id }}</td>
                                                                <td>{{ $x->created_at }}</td>
                                                                <td>{{ $x->callername }}</td>
                                                                <td>{{ $x->purposecal }}</td>
                                                                <td>{{ $x->procedure }}</td>
                                                                <td>
                                                                    
                                                                    {{ $x->recivecall }}
                                                                </td>
                                                                @if ($x->status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">مفتوحة</span>
                                                                    </td>
                                                                @elseif($x->status ==2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">تحت الإجراء</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">مغلقة</span>
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                                                        data-toggle="dropdown" id="dropdownMenuButton" type="button">العمليات <i class="fas fa-caret-down ml-1"></i></button>
                                                                        <div  class="dropdown-menu tx-13">
                                                                            {{-- <a class="" data-toggle="modal" href="#">التحويل</a> --}}
                                                                            <button class="dropdown-item" data-toggle="modal"
                                                                                data-id="{{ $x->id }}" data-callername="{{ $x->callername }}"
                                                                                data-target="#transfer_trans">
                                                                                التحويل
                                                                            </button>
                                                                            <a class="dropdown-item" href="{{ route('procticket',$x->id)}}">فتح المعاملة</a>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- /div -->
    </div>
    <!-- /row -->
    <div class="modal fade" id="transfer_trans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تحويل المعاملة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('updateticket',24) }}" method="post" onsubmit="return validateForm()>
                    {{-- {{ method_field('PUT') }} --}}
                    @method('PATCH')
                    
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row" id="message">
                            <div class="col-sm col-md">
                                <label for="transferto" class="control-label">{{ __('lable.transftransctnto') }}</label>
                                <select class="form-control" name="transferto" id="transferto">
                                    <option value="0">الرجاء إختيار الموظف المراد</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->name}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm col-md">
                                <label for="transfermessage" class="control-label">{{ __('lable.message') }}</label>
                                <textarea name="transfermessage" id="transfermessage" class="form-control"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="callername" id="callername" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تحويل</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('public/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('public/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('public/assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('public/assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('public/assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('public/assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('public/assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#transfer_trans').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var callername = button.data('callername')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #callername').val(callername);
            
        })
    </script>
    <script>
        function validateForm() {
            var transferto = document.getElementById('transferto').value;
            if (transferto == 0) {
                alert("يجب إختيار موظف من القائمة");
                return false;
            }
        }
    </script>

@endsection
