@extends('layouts.master2')

@section('title')
    تسجيل دخول - الندوة العالمية للشباب الإسلامي
@stop
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('public/assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content') 
{{-- <h1 style="margin:150px auto ">الموقع تحت الصيانة</h1> --}}

    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>{{ __('lableauth.login') }}</h2>
                                            <form method="POST" action="{{ route('login') }}">
                                                {{-- @csrf --}}
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label>{{ __('lableauth.identify') }}</label>
                                                    <input id="identify" type="text" class="form-control
                                                        @error('identify') is-invalid @enderror" name="identify"
                                                        value="{{ old('identify') }}" required autocomplete="identify"
                                                        autofocus>
                                                    @error('identify')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('lableauth.password') }}</label>
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <div class="form-group row">
                                                        <div class="col-md-6 offset-md-4 mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="remember" id="remember"
                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label class="form-check-label" for="remember">
                                                                    {{ __('lableauth.remember') }}
                                                                </label>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-main-primary btn-block mt-2">
                                                    {{ __('lableauth.login') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="col-md-6">
                                       {{--  <div class="form-check">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-primary btn-rounded"
                                                    href="{{ route('password.request') }}">
                                                    <i class="typcn typcn-arrow-repeat"></i>
                                                    
                                                </a>
                                            @endif
                                        </div>
                                        <br><br> --}}
                                         <button class="btn btn-primary btn-rounded" data-toggle="modal"
                                                    data-target="#UpdatePassword">
                                                    {{ __('lableauth.forget') }}
                                                    </button>
                                        <div class="form-check">
                                            {{-- @if (Route::has('password.request'))
                                                <a class=""
                                                    href="{{ route('password.request') }}">
                                                    <i class="typcn typcn-arrow-repeat"></i>
                                                    {{ __('lableauth.forget') }}
                                                </a>
                                            @endif --}}
                                            {{-- <button class="btn btn-primary btn-rounded" 
                                                    data-toggle="modal"
                                                    data-emp_name="{{ $item->name }}" data-id="{{ $item->id }}"
                                                    data-empid="{{ $item->empid }}"
                                                    data-salary="{{ $item->salary }}"
                                                    data-newpremium="{{ $item->newpremium }}"
                                                    data-contribute="{{ $item->contribute }}"
                                                    data-target="#UpdatePassword">
                                                    <i class="typcn typcn-arrow-repeat"></i>
                                                    {{ __('lableauth.forget') }}
                                            </button> --}}
                                        </div>
                                        <br><br>
                                        
                                        <div class="form-check">
                                            
                                            <a class="btn btn-primary btn-rounded" href="{{ route('register') }}">
                                                <i class="typcn typcn-edit"></i>  
                                                {{ __('lableauth.createAccount') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('public/assets/img/media/login.jpg') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="UpdatePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تحديث كلمة المرور</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('changePassword')}}" method="post">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h4 style="color:red">
                            هل تريد تعديل كلمة المرور؟
                        </h4>
                        </p>
                        <div class="row">
                            <div class="col-6">
                                <label for="">الرقم الوظيفي</label>
                                <input class="form-control" type="text" name="empid" id="empid" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for=""> كلمة المرور الجديدة</label>
                                <input class="form-control" type="password" name="pass" id="pass" required >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('#UpdatePassword').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var emp_name = button.data('emp_name')
        var empid = button.data('empid')
        var salary = button.data('salary')
        var newpremium = button.data('newpremium')
        var contribute = button.data('contribute')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #emp_name').val(emp_name);
        modal.find('.modal-body #empid').val(empid);
        modal.find('.modal-body #salary').val(salary);
        modal.find('.modal-body #newpremium').val(newpremium);
        modal.find('.modal-body #contribute').val(contribute);

    })
</script>
@endsection
