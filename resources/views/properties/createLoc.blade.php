@extends('layouts.master')
@section('css')
    <!--- Internal Sweet-Alert css-->
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('public/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('public/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/sumoselect/sumoselect-rtl.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('menu.property') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('menu.addProperty') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
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
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('properties.store')}}" method="POST" {{-- enctype="multipart/form-data" autocomplete="off" --}}>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col">
                                <label for="name" class="control-label">{{ __('lable.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-sm col-md">
                                <label for="address" class="control-label">{{ __('lable.address') }}</label>
                                <textarea class="form-control" name="address" id="address" required></textarea>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm col-md">
                                <label for="description" class="control-label">{{ __('lable.descriptionLoc') }}</label>
                                <textarea class="form-control" name="description" id="description" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="longitude" class="control-label">{{ __('lable.longitude') }}</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" required
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <div class="col">
                                <label for="nlatitudeame" class="control-label">{{ __('lable.latitude') }}</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" required
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                                <div class="col-sm col-md">
                                    <h5 class="card-title">صور المبني</h5>
                                    <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                    <p class="text-danger">الرجاء إرفاق صورة علي الأقل</p>
                                    <div class="col-sm-sm-12 col-md-12">
                                        <input type="file" name="pic" class="dropify" multiple="multiple"
                                            accept=".jpg, .png, image/jpeg, image/png" data-height="70" />
                                    </div>
                                </div>
                        </div>
                        <br><br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" id="savelink" class="btn btn-primary">{{ __('lable.savebtn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div style="margin-bottom: 180px"></div>
        </div>

    </div>
    <!-- row closed -->

@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('public/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ URL::asset('public/assets/js/sweet-alert.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

        /* function validateForm() {
            var premium = document.getElementById('newpremium').value,
                sal = document.getElementById('salary').value,
                amount = sal * 0.5;
            amount2 = sal * 0.05;
            if (premium < amount2) {
                alert("يجب ان يكون المبلغ أكبر من 5% من إجمالي الراتب");
                return false;
            }
            if (premium > amount) {
                alert("يجب ان يكون المبلغ أصغر من 50% من إجمالي الراتب");
                return false;
            }
        } */

    </script>

@endsection
