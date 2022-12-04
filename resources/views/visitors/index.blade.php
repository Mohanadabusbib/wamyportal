@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('menu.wamyVisitors')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0 tx-md-16-f">/ {{__('menu.visitRequest')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
        <!-- row -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-justify">
                        <h6 class="tx-md-16-f">{{__('menu.visitRequest')}}</h6>
                    </div>
                    <div class="card-body tx-md-bold">
                        @if (session('status'))
                            <div class="alert alert-success text-justify">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(session('success'))
                            {{-- @includeWhen(!count($surveys), 'alerts.error', ['msg' => 'لا يوجد لديك طلب']) --}}
                            @include('alerts.success')
                            {{-- <div class="alert alert-success text-justify" role="alert">
                                {{ __('msgmsgSave') }}
                            </div> --}}
                        @endif

                        <form method="POST" action="{{route('visitors.store')}}" onkeydown="return event.key != 'Enter'">
                            {{ csrf_field() }}
                            <div class="form-group row text-right">
                                <label for="department_id">{{__('lable.department')}}</label>
                                <select class="form-control" name="department_id" id="department_id" required>
                                    <option>الرجاء إختيار الإدارة</option>
                                    @foreach ($departments as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row text-right">
                                <label for="section_id">{{__('lable.section')}}</label>
                                <select class="form-control" name="section_id" required>
                                    {{-- <option>الرجاء إختيار القسم</option> --}}
                                </select>

                            </div>
                            <div class="form-group row text-right">
                                <label for="vname">{{__('lable.visitName')}}</label>
                                <input type="text" class="form-control" name="vname" required>
                            </div>
                            <div class="form-group row text-right">
                                <label for="vpurpose">{{__('lable.visitpurpose')}}</label>
                                <input type="text" class="form-control" name="vpurpose" required>
                            </div>
                            <div class="form-group row text-right">
                                <label for="vdate">{{__('lable.visitDate')}}</label>
                                <input type="date" class="form-control" name="vdate" required>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{__('lable.savebtn')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- row closed -->
    </div>
    <!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
    <script src="{{asset('public/assets/js/jquery-3.4.1.js')}}"></script>
    <script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('public/assets/js/main.js')}}"></script>
@endsection
