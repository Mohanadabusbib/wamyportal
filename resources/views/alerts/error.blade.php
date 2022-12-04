<div class="card bd-0 mg-b-20 bg-danger">
	<div class="card-body text-white">
		<div class="main-error-wrapper">
			<i class="si si-close mg-b-20 tx-50"></i>
			<h4 class="mg-b-0">{{Session::get('error')}}</h4>
		</div>
	</div>
</div>
{{-- < class="alert alert-danger mg-b-0" role="alert">
	<button aria-label="Close" class="close" data-dismiss="alert" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
    <strong>Oh snap!</strong> Change a few things up and try submitting again.
    <h4>{{Session::get('error')}}</h4>
</> --}}
