@extends('layouts.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--- Internal Sweet-Alert css-->
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('public/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('public/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <style>
        .title{
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
        }
        .carData{
            /* font-size: 16px; */
            font-weight: bold;
            margin-right: 15px;
        }
        ul{
            list-style-type: none;
        }
        .carBtn{
            width: 100% !important;
            /* margin: auto 100px; */
            /* margin-bottom: -15px; */
            
        }
        .flip-card {
            background-color: transparent;
            /* width: 300px;
            height: 300px; */
            width: 385px;
            height: 218px;
            
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            border-radius: 15px; 
        }

        .rotatedCard{
            transform: rotateY(180deg);
        }
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 15px; 
        }

        .flip-card-front {
            background-color: #bbb;
            color: black;
        }
        #imgCard{
            height: 100%;
            border-radius: 15px; 
        }

        .flip-card-back {
            background-color: white;
            /* color: white; */
            transform: rotateY(180deg);
        }
        .countDown{
            position: fixed;
            left: 15px;
            background-color: rgb(54, 41, 235);
            width: 50px;
            height: 25px;
            border-radius: 10px;
        }
        .countDown span{
            color: #fff;
            margin: auto 15px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">مزاد بيع السيارات</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ النتيجة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="countDown">
        <span id="countDown"></span>
    </div>
        <div class="row">
            {{--@foreach ($auctions as $item)
                    <div class="col-4"> 
                        <div class="flip-card" id="flip-card">
                            <div class="flip-card-inner" id="flip-card-inner">
                                <div class="flip-card-front">
                                    <div id="carouselExampleControls1" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                            <img id="imgCard" src="https://i.ytimg.com/vi/dip_8dmrcaU/maxresdefault.jpg" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                            <img id="imgCard" src="data:image/jpeg;base64,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" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                            <img id="imgCard" src="https://www.renault.com.sa/CountriesData/Saudi_Arabia_EN/images/conceptcars/renault-concept-car-014_ig_w800_h450.jpg" class="d-block w-100" alt="...">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls1" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls1" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="flip-card-back">
                                    <ul>
                                        <li>
                                            <label class="title">النوع :</label>
                                            <label class="carData">{{$item->type}}</label>
                                        </li>
                                        <li>
                                            <label class="title">اللون :</label>
                                            <label class="carData">أحمر</label>
                                        </li>
                                        <li>
                                            <label class="title">الموديل :</label>
                                            <label class="carData">2010</label>
                                        </li>
                                        <li>
                                            <label class="title">الكيلوميترات :</label>
                                            <label class="carData">3000000</label>
                                        </li>
                                        <li>
                                            <label class="title">سعر البيع :</label>
                                            <label class="carData">3000000</label>
                                        </li>
                                        <li>
                                            <label class="title">آخر سعر :</label>
                                            <label class="carData">3000000</label>
                                        </li>
                                    </ul>
                                    
                                    <button class="btn btn-primary carBtn" data-toggle="modal"
                                        data-target="#delete_file">
                                        مبلغ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            @foreach ($auctions as $item)
                <div class="col-sm-4">
                    <div class="card" style="width: 22rem;">
                        @if (count($item->images) >=1)
                        <div id="carouselExampleControls-{{$item->id}}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach( $item->images as $im)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ $im->image }}" class="d-block w-100" alt="..." style="width: 350px; height: 300px;">
                                    </div>
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls-{{$item->id}}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls-{{$item->id}}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        @else
                            <img class="card-img-top" src="{{$item->image}}" alt="Card image cap">    
                        @endif

                        <div class="card-body">
                            <h3 class="card-title" style="text-align: center">{{$item->type}} - {{$item->color}} - {{$item->model}} - {{$item->numberboard}}</h3>
                            <br>
                            @if ($item->lastprice == null)
                                <h1 style="text-align: center">{{number_format($item->price,2)}}</h1>
                            @else
                            <h1 style="text-align: center">{{number_format($item->lastprice,2)}}</h1>
                            @endif
                            <br>
                            <h3 style="text-align: center">{{$item->auctionUser}}</h3>
                        </div>
                    </div>
                </div>   
            @endforeach
        </div>    
      
        
    <!-- row closed -->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('public/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    {{-- <script src="sweetalert2/dist/sweetalert2.all.min.js"></script> --}}
    

    <script src="{{URL::asset('public/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/sweet-alert.js')}}"></script>
    <script src="{{ URL::asset('public/assets/js/enterButton.js') }}"></script>
    <script>
        
        const countDown = document.getElementById('countDown');
        let timeleft = 10,
            downloadTimer = setInterval(function(){
                if(timeleft <= 0){
                    clearInterval(downloadTimer);
                }
                let counter = 10 - timeleft;
                countDown.innerText = counter < 10 ? "0" + counter : counter;
                timeleft -= 1;
        }, 1000);
        setInterval(() => {
            location.reload(true);
        }, 10000); 
    </script>
@endsection
