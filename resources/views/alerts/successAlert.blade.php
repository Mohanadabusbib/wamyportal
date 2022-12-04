{{-- <input type='button' class="btn btn-warning mt-2" value='With timer' id='but4'> --}}
<div class="card bd-0 mg-b-20 bg-success" id="successmsg">
    <div class="card-body text-white">
        <div class="main-error-wrapper">
            <i class="si si-check mg-b-20 tx-50"></i>
            <h4 class="mg-b-0" id="message">{{Session::get('success')}}</h4>
        </div>
    </div>
</div>

{{-- <script>
    $("#successmsg").load(function(){
    var message = $("#message").val();
    $('body').addClass('timer-alert');
    var title = $("#title").val();
    if(message == ""){
        message  = "Your message";
    }
    if(title == ""){
        title = "Your message";
    }
    message += "(close after 2 seconds)";
    swal({
        title: title,
        text: message,
        timer: 2000,
        showConfirmButton: false
    });
});
</script>
 --}}

