@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">{{ __('menu.savings') }}</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ رسالة خطأ</span>
                        </div>
                    </div>
                </div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                    <div class="row justify-content-center">
                        <div class="col-md-8" style="margin-bottom: 455px">
                            <div class="card">
                                <div class="card-body">
                                    @if ($er)
                                        <div class="card bd-0 mg-b-20 bg-danger">
                                            <div class="card-body text-white">
                                                <div class="main-error-wrapper">
                                                    <i class="si si-close mg-b-20 tx-50"></i>
                                                    <h4 class="mg-b-0">{{$er}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

				<!-- row closed -->
			{{-- </div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed --> --}}
@endsection
@section('js')
@endsection
