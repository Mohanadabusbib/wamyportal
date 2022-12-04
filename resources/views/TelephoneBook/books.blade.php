@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<style>
    .name-header{
        font-size: 25px;
        font-weight: bolder;
        text-decoration: underline;
        text-align: center;
    }
    .ava-border{
        border: 5px solid #0162E8;
    }
    
    .img-cov{
        /* border: 0.5px solid #0162E8;
        border-radius: 20px;
        height: 110px;
        width: 80px; */
        margin: -11% 36% 2% 0%;
    }
    .hvr-bounce-in {
    display: block;
    vertical-align: middle;
    -webkit-transform: perspective(1px) translateZ(0);
    transform: perspective(1px) translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
    -webkit-transition-duration: 0.5s;
    transition-duration: 0.5s;
    text-align: center;
    }
    .hvr-bounce-in span{
        color: #000;
        font-weight: bolder
    }
    .hvr-bounce-in:hover, .hvr-bounce-in:focus, .hvr-bounce-in:active {
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        -webkit-transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
        transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
        border-bottom: 2px solid #0162E8;
    }
    .hvr-float-shadow {
        display: inline-block;
        vertical-align: middle;
        -webkit-transform: perspective(1px) translateZ(0);
        transform: perspective(1px) translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        position: relative;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: transform;
        transition-property: transform;
    }
    .hvr-float-shadow:before {
        pointer-events: none;
        position: absolute;
        z-index: -1;
        content: '';
        top: 100%;
        left: 5%;
        height: 10px;
        width: 90%;
        opacity: 0;
        background: -webkit-radial-gradient(center, ellipse, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0) 80%);
        background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0) 80%);
        /* W3C */
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: transform, opacity;
        transition-property: transform, opacity;
    }
    .hvr-float-shadow:hover, .hvr-float-shadow:focus, .hvr-float-shadow:active {
        -webkit-transform: translateY(-5px);
        transform: translateY(-5px);
    /* move the element up by 5px */
    }
    .hvr-float-shadow:hover:before, .hvr-float-shadow:focus:before, .hvr-float-shadow:active:before {
        opacity: 1;
        -webkit-transform: translateY(5px);
        transform: translateY(5px);
        /* move the element down by 5px (it will stay in place because it's attached to the element that also moves up 5px) */
    }
    .search{
        display: flex;
        justify-content:space-around
    }
    .search-item label{
        font-weight: bold;
    }
    .search-item .item{
        font-size: 16px;
        border:1px solid #0162E8;
        width: 100%;
        padding: 12px 5px;
        
    }

</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex"><h4 class="content-title mb-0 my-auto">دليل الهاتف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الموظفين</span></div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    @include('TelephoneBook.test')
    <div class="row" id="dataList">
        @foreach ($employees as $item)
            <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                <div class="card card-primary">
                    <div class="card-header pb-0 hvr-float-shadow">
                        <p class="name-header ">{{$item->name}}</p>
                    </div>
                    <div class="card-body text-primary">
                        <div>
                            @if ($item->avatar)
                            <img alt="img" class="avatar avatar-xl brround img-cov" src="{{ asset('public/storage/images/'.$item->avatar)  }}">
                            @else
                            <img alt="img" class="avatar avatar-xl brround img-cov" src="{{asset('public/storage/images/avatar.png')}}">
                            {{-- <img alt="img" class="avatar avatar-xl ava-border" src="{{asset('public/storage/images/avatar.png')}}"> --}}
                            {{-- <img alt="img" class="avatar avatar-xl brround" src="{{asset('public/storage/images/avatar.png')}}"> --}}
                            @endif
                            
                        </div>
                        <div >
                            <p class="hvr-bounce-in">
                                <strong>الإدارة :</strong>
                                <span>{{$item->Dept}}</span>
                            </p>
                            <p class="hvr-bounce-in">
                                @if ($item->sectnId != 0)
                                    <strong>القسم :</strong>
                                    <span>{{$item->Sectn}}</span>
                                @endif
                            </p>
                            <p class="hvr-bounce-in">
                                <strong>الوظيفة :</strong>
                                <span>{{$item->job}}</span>
                            </p>
                            <p class="hvr-bounce-in">
                                <strong>الجوال :</strong>
                                <span>{{$item->Mobile ? $item->Mobile : "غير مسجل"}}</span>
                            </p>
                            <p class="hvr-bounce-in">
                                <strong>التحويلة :</strong>
                                <span>{{$item->extn}}</span>
                            </p>
                            <p class="hvr-bounce-in">
                                <strong>البريد الإلكتروني :</strong>
                                <span>{{$item->email}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>            
        @endforeach
    </div>	
@endsection

@section('js')
    <script src="{{asset('public/assets/js/jquery-3.4.1.js')}}"></script>
    <script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('public/assets/js/main.js')}}"></script>
@endsection