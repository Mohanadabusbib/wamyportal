@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ نقل البيانات</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                {{-- {{$year}} --}}
				<div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                               <h3>بيانات الموظفين</h3>
                               <a href="{{ route('storeEmp') }}" class="btn btn-dark" style="font-weight: bold"><i class="fas fa-database"></i> نقل البيانات</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                               <h3>الإستقطاعات ونهاية الخدمة</h3>
                               <a href="{{ route('storeBox') }}" class="btn btn-dark" style="font-weight: bold"><i class="fas fa-database"></i> نقل البيانات</a>
                            </div>
                        </div>
                    </div>
				</div>
				<!-- row closed -->
			
@endsection
@section('js')
@endsection