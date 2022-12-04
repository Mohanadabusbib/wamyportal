@extends('layouts.master2')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
			{{-- 	<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                {{--     <audio controls autoplay>
                        <source src="https://tunein.com/embed/player/s37232">
                        Your browser does not support the audio element.
                    </audio> --}}
                    {{-- <audio controls autoplay>
                        <source src="http://tun.in/sesMA" />
                    </audio> --}}
                    <iframe src="https://www.youtube.com/watch?v=u1xZ4pWK7a8" allow="autoplay" style="width:100%; height:100px;" scrolling="no" frameborder="no"></iframe>
                    
                    {{-- <audio controls>
                        <source src="https://tunein.com/embed/player/s37232" />
                    </audio> --}}
                    {{-- <iframe id="video1" src="https://tunein.com/embed/player/s37232/" style="width:100%; height:100px;" scrolling="no" frameborder="no" allow="autoplay"></iframe> --}}
				</div>
				<!-- row closed -->
			
@endsection
@section('js')
<script>
    $( document ).ready(function() {
        var element = document.getElementsByClassName("play-button");
        element.classList.add("playing");
    });
    
</script>
@endsection