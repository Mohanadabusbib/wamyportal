<!-- Title -->
<title> البوابة الداخلية - الندوة العالمية للشباب الإسلامي </title>
<!-- Favicon -->
<link rel="icon" href="{{asset('public/assets/img/brand/logo.jpg')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{asset('public/assets/css/icons.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">

<!--  Custom Scroll bar-->
<link href="{{asset('public/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{asset('public/assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{asset('public/assets/css-rtl/sidemenu.css')}}">
@yield('css')
{{-- <!--- Dark-mode css -->
<link href="{{asset('public/assets/css-rtl/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{asset('public/assets/css-rtl/skin-modes.css')}}" rel="stylesheet"> --}}
<!--- Style css -->
@if (app()->getLocale() == 'ar')
    <link href="{{asset('public/assets/css-rtl/style.css')}}" rel="stylesheet">
@else
    <link href="{{asset('public/assets/css/ganeralChange.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet">
@endif

    <link href="{{asset('public/assets/css/MMA.css')}}" rel="stylesheet">



