@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('public/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('menu.setting')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('lable.permissions')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    @if (session()->has('Add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('Add') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <!--div-->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="d-flex justify-content-between">
                                <a data-toggle="modal" href="#modaldemo8" class="modal-effect btn btn-outline-primary">
                                    <i class="fas fa-plus">&nbsp; {{__('lable.addpermissions')}}</i>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">الرقم الوظيفي</th>
                                                <th class="border-bottom-0">الموظف</th>
                                                <th class="border-bottom-0">القسم </th>
                                                <th class="border-bottom-0">الإدارة</th>
                                                <th class="border-bottom-0">التحويلة</th>
                                                <th class="border-bottom-0">منفذ الشبكة</th>
                                                <th class="border-bottom-0">الهاتف</th>
                                                <th class="border-bottom-0">{{ __('lable.neworder') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td>Item 1</td>
                                                    <td>Item 2</td>
                                                    <td>Item 3</td>
                                                    <td>Item 4</td>
                                                    <td>Item 5</td>
                                                    <td>
                                                        <a href="" class="btn btn-primary">الإطلاع علي السندات</i></a>
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-primary">الإطلاع</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('callcenter.index')}}" class="btn btn-primary">رفع طلب جديد</a>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/div-->

                    <!-- Modal effects -->
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{__('lable.addpermissions')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{route('permissions.store')}}" method="post">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <label for="department_id">{{__('lable.typepermission')}}</label>
                                            {{-- <input class="form-control" type="text" name="type_id" id="type_id"> --}}
                                            <select class="form-control" name="type_id" id="type_id" required>
                                                <option value="1">قائمة رئيسية</option>
                                                <option value="2">قائمة فرعية</option>
                                                <option value="3">إجراء</option>
                                            </select>
                                            <label for="department_id">{{__('lable.permission')}}</label>
                                            <input class="form-control" type="text" name="name" id="name">
                                            <label for="department_id">{{__('lable.desc')}}</label>
                                            <input class="form-control" type="text" name="desc" id="desc">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn ripple btn-primary" type="submit">{{__('lable.savebtn')}}</button>
                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('lable.closebtn')}}</button>
                                        </div>
                                    </div>
                            </form>

                            </div>
                        </div>
                    </div>
                    <!-- End Modal effects-->
                </div>
				<!-- row closed -->

@endsection
@section('js')
<!-- Internal Select2.min js -->
<script src="{{asset('public/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('public/assets/js/myJs.js')}}"></script>
@endsection
