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
					{{-- <div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div> --}}
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
                            <form action="{{route('permissionrole')}}" method="post">
                                @csrf
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <a data-toggle="modal" href="#permissionsmodal" class="modal-effect btn btn-outline-primary">
                                            <i class="fas fa-plus">&nbsp; {{__('lable.addpermissions')}}</i>
                                        </a>
                                    </div>
                                    <div>
                                        <label for="user_id">{{__('lable.employee')}}</label>
                                        <select class="form-control" name="role_id" id="role_id" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body row">
                                    @foreach ($permissions as $item)
                                    <div class="col-md-4">
                                        <label for="" id="permsnName">
                                            <input type="checkbox" name="permission[]" value="{{$item->id}}"
                                            {{$item->roles()->find(1) ? 'checked' : '' }}>
                                            {{$item->desc}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <button class="btn ripple btn-primary" type="submit">تحديث</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!--/div-->
                    <!-- Modal effects -->
                    <div class="modal" id="permissionsmodal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">{{__('lable.addpermissions')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            {{-- <form action="{{route('permissions.store')}}" method="post"> --}}
                            <form id="permissionsForm">
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

<script>
    $("#permissionsForm").submit(function(e){
        e.preventDefault();
        let type_id = $("#type_id").val();
        let name = $("#name").val();
        let desc = $("#desc").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('permissions.store')}}",
            type:"POST",
            data:{
                type_id:type_id,
                name:name,
                desc:desc,
                _token:_token
            },
            success:function(response)
            {
                if(response){
                    $("#permsnName").prepend('<input type="checkbox" name="permission[]" value="response->id">response->desc');
                    $("#permissionsForm")[0].reset();
                    $("#permissionsmodal").modal('hide');
                }
            }
        });

    });
</script>
@endsection
