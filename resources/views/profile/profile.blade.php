@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('public/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">{{__('menu.setting')}}</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('lable.profile')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<!-- Col -->
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
                                            <img alt="" src="{{ Auth::user()->avatar ?? asset('public/storage/images/avatar.png') }}">
                                            {{--  <a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a> --}}
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{auth::user()->name}}</h5>
												<p class="main-profile-name-text">{{auth::user()->email}}</p>
											</div>
										</div>
										
										<hr class="mg-y-30">
										{{-- <label class="main-content-label tx-13 mg-b-20">{{__('lable.social')}}</label>
										<div class="main-profile-social-list">
											<div class="media">
												<div class="media-icon bg-primary-transparent text-primary">
													<i class="icon ion-logo-github"></i>
												</div>
												<div class="media-body">
													<span>Github</span> <a href="">github.com/spruko</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-success-transparent text-success">
													<i class="icon ion-logo-twitter"></i>
												</div>
												<div class="media-body">
													<span>Twitter</span> <a href="">twitter.com/spruko.me</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-info-transparent text-info">
													<i class="icon ion-logo-linkedin"></i>
												</div>
												<div class="media-body">
													<span>Linkedin</span> <a href="">linkedin.com/in/spruko</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-danger-transparent text-danger">
													<i class="icon ion-md-link"></i>
												</div>
												<div class="media-body">
													<span>My Portfolio</span> <a href="">spruko.com/</a>
												</div>
											</div>
										</div>
										<hr class="mg-y-30"> --}}
										{{-- <h6>Skills</h6>
										<div class="skill-bar mb-4 clearfix mt-3">
											<span>HTML5 / CSS3</span>
											<div class="progress mt-2">
												<div class="progress-bar bg-primary-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%"></div>
											</div>
										</div>
										<!--skill bar-->
										<div class="skill-bar mb-4 clearfix">
											<span>Javascript</span>
											<div class="progress mt-2">
												<div class="progress-bar bg-danger-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 89%"></div>
											</div>
										</div>
										<!--skill bar-->
										<div class="skill-bar mb-4 clearfix">
											<span>Bootstrap</span>
											<div class="progress mt-2">
												<div class="progress-bar bg-success-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
											</div>
										</div>
										<!--skill bar-->
										<div class="skill-bar clearfix">
											<span>Coffee</span>
											<div class="progress mt-2">
												<div class="progress-bar bg-info-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
											</div>
										</div> --}}
										<!--skill bar-->
									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label tx-13 mg-b-25">
									{{__('lable.conatct')}}
								</div>
								<div class="main-profile-contact-list">
									<div class="media">
										<div class="media-icon bg-primary-transparent text-primary">
											<i class="icon ion-md-phone-portrait"></i>
										</div>
										<div class="media-body">
											<span>{{__('lable.mobile')}}</span>
											<div>
												{{auth::user()->mobile}}
											</div>
										</div>
									</div>
									{{-- <div class="media">
										<div class="media-icon bg-success-transparent text-success">
											<i class="icon ion-logo-slack"></i>
										</div>
										<div class="media-body">
											<span>Slack</span>
											<div>
												@spruko.w
											</div>
										</div>
									</div>
									<div class="media">
										<div class="media-icon bg-info-transparent text-info">
											<i class="icon ion-md-locate"></i>
										</div>
										<div class="media-body">
											<span>Current Address</span>
											<div>
												San Francisco, CA
											</div>
										</div>
									</div> --}}
								</div><!-- main-profile-contact-list -->
							</div>
						</div>
					</div>

					<!-- Col -->
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="mb-4 main-content-label">{{__('lable.personalInformation')}}</div>
                                <form class="form-horizontal" action="{{route('profile')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('lable.name')}}</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="name" value="{{auth::user()->name}}" required>
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('lable.avatar')}}</label>
											</div>
											<div class="col-md-9">
												<input type="file" class="form-control" name="avatar">
											</div>
										</div>
                                    </div>
                                    <div class="mb-4 main-content-label">{{__('lable.contactInfo')}}</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('lable.email')}}{{-- <i>(required)</i> --}}</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" value="{{auth::user()->email}}" disabled>
											</div>
										</div>
                                    </div>
                                    <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('lable.mobile')}}</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="mobile"  value="{{auth::user()->mobile}}">
											</div>
										</div>
									</div>
									{{-- <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Language</label>
											</div>
											<div class="col-md-9">
												<select class="form-control select2">
													<option>Us English</option>
													<option>Arabic</option>
													<option>Korean</option>
												</select>
											</div>
										</div>
									</div> --}}
									{{-- <div class="mb-4 main-content-label">Name</div> --}}

									{{-- <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">First Name</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="First Name" value="Petey">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">last Name</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="Last Name" value="Pechon">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Nick Name</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="Nick Name" value="Petey">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Designation</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="Designation" value="Web Designer">
											</div>
										</div>
									</div> --}}

									{{-- <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Website</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="Website" value="@spruko.w">
											</div>
										</div>
									</div> --}}

									{{-- <div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Address</label>
											</div>
											<div class="col-md-9">
												<textarea class="form-control" name="example-textarea-input" rows="2"  placeholder="Address">San Francisco, CA</textarea>
											</div>
										</div>
									</div> --}}
									{{-- <div class="mb-4 main-content-label">Social Info</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Twitter</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="twitter" value="twitter.com/spruko.me">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Facebook</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="facebook" value="https://www.facebook.com/Redash">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Google+</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="google" value="spruko.com">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Linked in</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="linkedin" value="linkedin.com/in/spruko">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Github</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" placeholder="github" value="github.com/sprukos">
											</div>
										</div>
									</div>
									<div class="mb-4 main-content-label">About Yourself</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Biographical Info</label>
											</div>
											<div class="col-md-9">
												<textarea class="form-control" name="example-textarea-input" rows="4" placeholder="">pleasure rationally encounter but because pursue consequences that are extremely painful.occur in which toil and pain can procure him some great pleasure..</textarea>
											</div>
										</div>
									</div>
									<div class="mb-4 main-content-label">Email Preferences</div>
									<div class="form-group mb-0">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Verified User</label>
											</div>
											<div class="col-md-9">
												<div class="custom-controls-stacked">
													<label class="ckbox mg-b-10"><input checked="" type="checkbox"><span> Accept to receive post or page notification emails</span></label>
													<label class="ckbox"><input checked="" type="checkbox"><span> Accept to receive email sent to multiple recipients</span></label>
												</div>
											</div>
										</div>
                                    </div> --}}
                                    <div class="card-footer text-left">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('lable.updateProfile')}}</button>
                                    </div>
                                </form>

							</div>

						</div>
					</div>
					<!-- /Col -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('public/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('public/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('public/assets/js/select2.js')}}"></script>
@endsection
