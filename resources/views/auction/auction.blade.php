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
    <link rel="stylesheet" href="{{ URL::asset('public/assets/css/countdown-timer.css') }}">
    
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
        .range{
            color: #045cd6;
/*             border: 2px solid; */
            width: 160px;
            margin: 4px 99px;
            display: flex;
            justify-content: space-evenly;
        }
        .range a{
            font-size: 50px;
        }
        
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">مزاد بيع السيارات</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المزاد</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @if ($error != null)
        <div class="card bd-0 mg-b-20 bg-danger">
            <div class="card-body text-white">
                <div class="main-error-wrapper">
                    <i class="si si-close mg-b-20 tx-50"></i>
                    <h4 class="mg-b-0">{{$error}}</h4>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-4">
                
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
                <label style="font-size: 18px; font-weight: bold; margin-right: 10px" >تحديث الصفحة تلقائياُ</label>
            </div>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @foreach ($auctions as $item)
                <div class="col-sm-4">
                    <div class="card" style="width: 22rem;" id="carCard">
                        @if (count($item->images) >=1)
                        <div id="carouselExampleControls-{{$item->id}}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach( $item->images as $im)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ $im->image }}" class="d-block w-100" alt="..." style="width: 350px; height: 300px;">
                                    </div>
                                @endforeach
                                {{-- <div class="carousel-item active">
                                <img src="https://i.ytimg.com/vi/dip_8dmrcaU/maxresdefault.jpg" class="d-block w-100" alt="...">
                                </div> --}}
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
                            {{--<input type="text" readonly value="{{$dateNow}}"  id="dateNow{{$item->id}}">--}}
                            @if ($dateNow > $item->endDate )
                                <div id="winnerInfo{{$item->id}}" >
                                    <h3 class="card-title" style="text-align: center">{{$item->type}} - {{$item->color}} - {{$item->model}} - {{$item->numberboard}}</h3>
                                    <br>
                                    <h1 style="color: red;text-align: center; border: 1px solid red; margin: 10px auto;">مباعة</h1>
                                    <h2>صاحب السيارة هو : {{$item->auctionUser}}</h2>
                                    <h2 style="text-align: center">السعر : {{number_format($item->lastprice,2)}}</h2>   
                                    @if (Auth()->user()->empid == 11829 && $item->ord <= 15)
                                        <form action="{{route('auctions.store')}}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="itemId" value="{{$item->id}}">
                                            <input type="hidden" name="itemOrd" value="{{$item->ord}}">
                                            <button type="submit" class="btn btn-danger carBtn">نقل</button>
                                        </form>
                                    @endif                             
                                </div>
                            @else
                                <div id="carInfo{{$item->id}}">
                                    <h3 class="card-title" style="text-align: center">{{$item->type}} - {{$item->color}} - {{$item->model}}</h3>
                                    <br>
                                    <ul>
                                        <li>
                                            <label class="title">النوع :</label>
                                            <label class="carData">{{$item->type}}</label>
                                        </li>
                                        <li>
                                            <label class="title">اللوحة :</label>
                                            <label class="carData">{{$item->numberboard}}</label>
                                        </li>
                                        <li>
                                            <label class="title">اللون :</label>
                                            <label class="carData">{{$item->color}}</label>
                                        </li>
                                        <li>
                                            <label class="title">الموديل :</label>
                                            <label class="carData">{{$item->model}}</label>
                                        </li>
                                        <li>
                                            <label class="title">الكيلوميترات :</label>
                                            <label class="carData">{{$item->klms}}</label>
                                        </li>
                                        <li>
                                        @if ($item->lastprice == null)
                                                <label class="title">السعر :</label>
                                                <label class="carData">{{number_format($item->price,2)}}</label>
                                            @else
                                                <label class="title">آخر سعر :</label>
                                                <label class="carData">{{number_format($item->lastprice,2)}}</label> 
                                                &nbsp;&nbsp;&nbsp; ->
                                                <label class="carData">{{$item->auctionUser}}</label> 
                                            @endif
                                        </li>
                                        
                                        <li>
                                            <label class="title">وقت الإنتهاء :</label>
        
                                            <input type="hidden" id="endDate{{$item->id}}" value="{{$item->endDate}}">
                                            <br>
                                            <div class="countdown-container">
                                                <div class="countdown-el days-c">
                                                    <p class="number-time" id="edays{{$item->id}}">0</p>
                                                    <span class="text-time">يوم</span>
                                                </div>
                                                <div class="countdown-el hours-c">
                                                    <p class="number-time" id="ehours{{$item->id}}">0</p>
                                                    <span class="text-time">ساعة</span>
                                                </div>
                                                <div class="countdown-el mins-c">
                                                    <p class="number-time" id="emins{{$item->id}}">0</p>
                                                    <span class="text-time">دقيقة</span>
                                                </div>
                                                <div class="countdown-el seconds-c">
                                                    <p class="number-time" id="eseconds{{$item->id}}">0</p>
                                                    <span class="text-time">ثانية</span>
                                                </div>
                                                <br>
                                                
                                            </div>
                                            
                                            
                                        </li>
                                        <li><input type="hidden" value="{{$item->id}}"></li>
        
                                    </ul>
                                    @if ($status === 1)
                                        <button id="saveBtn{{$item->id}}" class="btn btn-primary carBtn" data-toggle="modal"
                                            data-id="{{ $item->id }}"
                                            data-finesh="{{ $item->endDate }}"
                                            data-ord="{{$item->ord}}"
                                            data-price="{{ $item->price }}"
                                            data-lastprice="{{ $item->lastprice }}"
                                            data-target="#delete_file">
                                            المبلغ
                                        </button>
                                        {{--@if (Auth()->user()->empid == 11829)
                                            
                                        @endif--}}
                                    @endif
                                    
                                    
                                </div>
                            @endif
                        </div>
                    </div>
                </div>   
            @endforeach
        </div>    
    @endif     
        
    <!-- row closed -->

    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">المزايده علي المبلغ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('auctions.update','mma')}}" method="post"  onsubmit="return validateForm()">
                    @method('patch')
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h4 style="color:red">
                            هل تريد فعلاً إضافة المبلغ علي السيارة ؟
                        </h4>
                        </p>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="fDate" id="fDate">
                        <input type="hidden" name="ord" id="ord">
                        <br>
                        <label for="" style="font-weight: bold">آخر مبلغ مرصود</label> &nbsp;&nbsp;&nbsp;
                        <input type="text" name="price" id="priceModel" value="" readonly>
                        <br>
                        <label for="" style="font-weight: bold">المبلغ المراد إضافته</label>
                        <input type="text" name="" id="number" value="" readonly>
                        
                        <br>
                        <label for="" style="font-weight: bold">مجموع المبلغ</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="amount" id="amountModel" value="" readonly>
                                                
                        <br>
                        <div class="range">
                            <a onclick="incrementValue()" class="plus"><i class="fas fa-plus-circle"></i></a>
                            <a onclick="decreaseValue()" class="minus"><i class="fas fa-minus-circle"></i></a>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    <script src="{{ URL::asset('public/assets/js/Auction/auction-timer.js') }}"></script>
    {{--<script src="{{ URL::asset('public/assets/js/Auction/countdown-timer.js') }}"></script>--}}
    
    <script>
       /*  const imgCards = document.querySelectorAll('#imgCard'),
        cardInner = document.getElementById('flip-card-inner');

        imgCards.forEach(imgCard => {
            cardInner.addEventListener('dblclick',()=>{
                cardInner.classList.toggle('rotatedCard');
                });
        }); */
        function validateForm() {
            const price = document.getElementById('priceModel').value,
                amount = document.getElementById('amountModel').value;
            if (amount <= price) {
                alert("يجب ان يكون المبلغ أكبر من المبلغ الموجود مسبقاً");
                return false;
            }
        }
            
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var fDate = button.data('finesh')
            var ord = button.data('ord')
            var price = button.data('price')
            var lastprice = button.data('lastprice')
            
            
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #fDate').val(fDate);
            modal.find('.modal-body #ord').val(ord);
            if (lastprice > price) {
                modal.find('.modal-body #priceModel').val(lastprice);    
            } else {
                modal.find('.modal-body #priceModel').val(price);    
            }
        })
        
        function incrementValue()
        {
            let value = parseInt(document.getElementById('number').value, 10),
            i;
            value = isNaN(value) ? 0 : value;
            value = value + 100;
            i++;
            document.getElementById('number').value = value;
            document.getElementById('amountModel').value = parseInt(document.getElementById('priceModel').value) + parseInt(value);
        }
        function decreaseValue()
        {
            let value = parseInt(document.getElementById('number').value, 10),
            i;
            value = isNaN(value) ? 0 : value;
            value = value - 100;
            if (value <= 0) {
                alert('هذه العملية غير صحيحة');
                return false;
            }
            i--;
            document.getElementById('number').value = value;
            document.getElementById('amountModel').value = parseInt(document.getElementById('priceModel').value) + parseInt(value);
        }

        
        $( document ).ready(function() {
            const refreshBtn = document.querySelector("input[type=checkbox]");
            if (localStorage.getItem("refreshBtn") == 1) {
                refreshBtn.checked = true;
                setInterval(() => {
                    location.reload(true);
                }, 10000); 
            }else{refreshBtn.checked = false;}
        });
        const refreshBtn = document.querySelector("input[type=checkbox]");
        refreshBtn.addEventListener('change', function(){
            if (this.checked) {
                setInterval(() => {
                    location.reload(true);
                }, 10000); 
                localStorage.setItem("refreshBtn", 1);
            } else {
                localStorage.setItem("refreshBtn",0);
                console.log("Checkbox is not checked..");
            }
        })
        

    </script>

@endsection
