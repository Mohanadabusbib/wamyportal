@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">{{__('menu.disclosureForm')}}</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0 tx-md-16-f">/ {{__('menu.entryRequest')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                <!-- row -->
                @if (!count($corona))
                    @if (Session::has('success'))
                        @include('alerts.success')
                    @else
                        {{ session()->put('error',__('msg.afterOrder'))}}
                        @include('alerts.error')
                        {{Session::forget('error')}}
                    @endif
                @endif
                @foreach ($corona as $item)
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card text-justify">
                                <div class="card-header"><h6 class="tx-md-bold"> {{__('lable.surveyDay')}} <span>{{$item->created}}</span></h6></div>
                                @if ($item->mixtures == 1 || $item->fever == 1 || $item->cough == 1 || $item->breathing == 1)
                                    <div class="card-body">
                                        <form method="POST" action="">
                                            {{ csrf_field() }}
                                            <h3>{{__('msg.dontEntry')}}</h3>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    {{-- <button type="submit" class="btn btn-primary">
                                                        تقديم طلب
                                                    </button> --}}
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <form method="POST" action="{{route('disclosure.update',$item->id)}}">
                                            {{ csrf_field() }}
                                            @method('patch')
                                            <input type="hidden" name="user_id" value="{{$item->user_id}}">
                                            @if (!session('success'))
                                            <h3 class="text-justify">{{__('msg.checkFever')}}</h3>
                                            @endif
                                            <div class="form-group row mb-0 text-center">
                                                <div class="col-md-8 offset-md-4">
                                                    @if (!session('success'))
                                                        <button type="submit" class="btn btn-primary">
                                                            {{__('lable.orderBtn')}}
                                                        </button>
                                                    @endif


                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
