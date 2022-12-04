@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">{{__('menu.inventory')}}</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0 tx-md-16-f">/ {{__('menu.addDevice')}}</span>
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
                                {{-- <div class="card-header text-justify">
                                    <?php use Carbon\Carbon; $day = Carbon::now();?>
                                    <h6 class=" tx-md-bold">{{__('lable.dayInputData')}} <span><?php echo $day->toDateString() ?></span></h6>
                                </div> --}}
                                <div class="card-body">
                                    {{-- @if(count($corona))
                                        {{ session()->put('error',__('msg.formError'))}}
                                        @include('alerts.error')
                                        {{Session::forget('error')}}

                                    @endif --}}
                                    @if (Session::has('success'))
                                        @include('alerts.success')
                                    @elseif (Session::has('error'))
                                        @include('alerts.error')
                                        {{Session::forget('error')}}
                                    @endif
                                    {{-- @includewhen(session('error'),'alerts.empty',['msg'=>'عفواً']) --}}
                                    <form method="POST" action="{{route('disclosure.store')}}">
                                        {{ csrf_field() }}
                                        <div class="form-group row text-right">
                                            <label for="email" class="col-md-12 col-form-label text-md-right  tx-md-bold">
                                                {{__('lable.directCloseContact')}}
                                            </label>
                                            <div class="col-md-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mixtures" id="mixtures" value="0" required>
                                                    <label class="form-check-label mr-3  tx-md-bold" for="mixtures">
                                                        {{__('lable.no')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mixtures" id="mixtures" value="1" required>
                                                    <label class="form-check-label mr-3 tx-md-bold" for="mixtures">
                                                        {{__('lable.yes')}}
                                                    </label>
                                                </div>
                                                @error('mixtures')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <label for="email" class="col-md-12 col-form-label text-md-right tx-md-bold">
                                                {{__('lable.feverQ')}}
                                            </label>

                                            <div class="col-md-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="fever" id="fever" value="0" required>
                                                    <label class="form-check-label mr-3 tx-md-bold" for="fever">
                                                        {{__('lable.no')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="fever" id="fever" value="1" required>
                                                    <label class="form-check-label mr-3 tx-md-bold" for="fever">
                                                        {{__('lable.yes')}}
                                                    </label>
                                                </div>
                                                @error('fever')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <label for="email" class="col-md-12 col-form-label text-md-right tx-md-bold">
                                                {{__('lable.coughQ')}}
                                            </label>

                                            <div class="col-md-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="cough" id="cough" value="0" required>
                                                    <label class="form-check-label mr-3 tx-md-bold" for="cough">
                                                        {{__('lable.no')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="cough" id="cough" value="1" required>
                                                    <label class="form-check-label mr-3 tx-md-bold" for="cough">
                                                        {{__('lable.yes')}}
                                                    </label>
                                                </div>
                                                @error('cough')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <label for="email" class="col-md-12 col-form-label text-md-right tx-md-bold">
                                                {{__('lable.breathingQ')}}
                                            </label>

                                            <div class="col-md-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="breathing" id="breathing" value="0" required>
                                                    <label class="form-check-label mr-3 tx-md-bold" for="breathing">
                                                        {{__('lable.no')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="breathing" id="breathing" value="1" required>
                                                    <label class="form-check-label mr-3 tx-md-bold" for="breathing">
                                                        {{__('lable.yes')}}
                                                    </label>
                                                </div>
                                                @error('breathing')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
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
			{{-- </div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed --> --}}
@endsection
@section('js')
@endsection
