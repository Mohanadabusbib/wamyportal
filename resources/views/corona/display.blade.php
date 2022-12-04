@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">{{__('menu.disclosureForm')}}</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.displayData')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                <!-- row -->
                @if (!count($corona))
                    @if (Session::has('error'))
                        {{ session()->put('error',__('msg.noDataToday'))}}
                        @include('alerts.error')

                    @endif
                @endif

                <div class="row justify-content-center">
                    @foreach ($corona as $item)
                        <div class="col-md-3">
                            <div class="card mycard" >
                                <img src="{{ $item->user->avatar ?? asset('public/storage/Images/avatar.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">الإسم : {{$item->user->name}}</h5>
                                    <h5 class="card-title text-center">الرقم الوظيفي : {{$item->user->empid}}</h5>
                                    <a href="{{route('disclosure.edit',$item->id)}}" class="btn btn-primary">السماح بالدخول</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
				<!-- row closed -->

@endsection
