<div class="card bd-0 mg-b-20 bg-success" id="successmsg">
    <div class="card-body text-white">
        {{-- <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button> --}}
        <div class="main-error-wrapper">
            <i class="si si-check mg-b-20 tx-50"></i>
            <h4 class="mg-b-0" id="message">{{Session::get('success')}}</h4>
        </div>
    </div>
</div>

{{-- <div class="alert alert-success" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
	   <span aria-hidden="true">&times;</span>
  </button>
    <strong>Well done!</strong> You successfully read this important alert message.
    {{Session::get('success')}}
</div> --}}