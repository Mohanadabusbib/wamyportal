<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('public/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('public/assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('public/assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('public/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('public/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('public/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('public/assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('public/assets/js/eva-icons.min.js')}}"></script>
@include('sweetalert::alert')
@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('public/assets/js/sticky.js')}}"></script>
<!-- tawkChat js -->
<script src="{{URL::asset('public/assets/js/tawkChat.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('public/assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('public/assets/plugins/side-menu/sidemenu.js')}}"></script>
<script src="{{URL::asset('public/assets/js/pusherNotification.js')}}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('0a3b2185abec8c83966e', {
        cluster: 'mt1'
    });
</script>


