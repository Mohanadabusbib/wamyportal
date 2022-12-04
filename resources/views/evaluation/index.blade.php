
@extends('layouts.evaluation')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('public/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">{{__('menu.magar')}}</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('menu.evaluation')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                <!-- row -->
                <div class="eval">
                    <div>
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('public/storage/emojis/Smiling.png') }}">
                                <input type="hidden" name="typevaluation_id" value="1">
                            </button>
                        </form>
                    </div>
                    <div>
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('public/storage/emojis/Smiling2.png') }}">
                                <input type="hidden" name="typevaluation_id" value="2">
                            </button>
                        </form>
                    </div>
                    <div>
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('public/storage/emojis/Sad.png') }}">
                                <input type="hidden" name="typevaluation_id" value="3">
                            </button>
                        </form>
                    </div>
                    <div>
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('public/storage/emojis/VerySad.png') }}">
                                <input type="hidden" name="typevaluation_id" value="4">
                            </button>
                        </form>
                    </div>
                    <div>
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('public/storage/emojis/VeryAngry.png') }}">
                                <input type="hidden" name="typevaluation_id" value="5">
                            </button>
                        </form>
                    </div>
                </div>
				{{-- <div class="row row-sm" style="margin:150px auto;">
					<div class="col-lg-2">
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('storage/emojis/Smiling.png') }}">
                                <input type="hidden" name="typevaluation_id" value="1">
                            </button>
                        </form>
					</div>
					<div class="col-lg-2">
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('storage/emojis/Smiling2.png') }}">
                                <input type="hidden" name="typevaluation_id" value="2">
                            </button>
                        </form>
					</div>
					<div class="col-lg-2">
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('storage/emojis/Sad.png') }}">
                                <input type="hidden" name="typevaluation_id" value="3">
                            </button>
                        </form>
						
					</div>
					<div class="col-lg-2">
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('storage/emojis/VerySad.png') }}">
                                <input type="hidden" name="typevaluation_id" value="4">
                            </button>
                        </form>
					</div>
					<div class="col-lg-2">
                        <form action="{{route('evaluation.store')}}" method="post">
                            @csrf
                            <button type="submit" style="border: none">
                                <img src="{{asset('storage/emojis/VeryAngry.png') }}">
                                <input type="hidden" name="typevaluation_id" value="5">
                            </button>
                        </form>
						
					</div>
                </div> --}}
                
                <div class="row">
                    <a href="{{route('home')}}" class="btn btn-primary">خروج</a>
                </div>
				<!-- row closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('public/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('public/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('public/assets/js/select2.js')}}"></script>
@endsection
