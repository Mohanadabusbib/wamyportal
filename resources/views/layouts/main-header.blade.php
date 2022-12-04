<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('public/assets/img/brand/logo.jpg')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('public/assets/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('public/assets/img/brand/logo.jpg')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('public/assets/img/brand/logo.jpg')}}" class="dark-logo-2" alt="logo"></a>
							{{-- {{ URL::asset("images/users/{$follower->id}/profilePictures/50thumb-{$follower->profilePicture->url}") }} --}}
						</div>

						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						{{-- <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="Search for anything..." type="search">
							<button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div> --}}
					</div>
					<div class="main-header-right">
						
					{{-- language --}}
					
                        {{-- <div class="nav" id="navbarSupportedContent">
                            <ul class="nav nav-item  navbar-nav-right ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('changeLang', 'ar') }}"> <img
                                        src="{{ asset('assets\img\lang\ar.png') }}" alt="ar"> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('changeLang', 'en') }}"> <img
                                        src="{{ asset('assets\img\lang\en.png') }}" alt="en"> </a>
                                </li>
                            </ul>
                        </div> --}}
						<div class="nav nav-item  navbar-nav-right ml-auto">
							{{-- <div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                    <span class="pulse" data-count="9"></span>
                                </a>
								<div class="dropdown-menu" data-toggle="dropdown">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">التنبيهات</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12" data-count="9">You have 4 unread Notifications</p>
                                    </div>
									<div class="main-notification-list Notification-scroll">
										<a class="d-flex p-3 border-bottom" href="#">
                                            <h5>Test</h5>
											<div class="notifyimg bg-pink">
                                                <i class="la la-file-alt text-white"></i>
                                            </div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
									</div>
									<div class="dropdown-footer">
										<a href="">VIEW ALL</a>
									</div>
								</div>
							</div> --}}
							<div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none"
										stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
										class="feather feather-bell">
										<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
										<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
									</svg>
									@if (auth()->user()->unreadNotifications->count() > 0)
										<span class="pulse-danger"></span>
									@else
										<span class="pulse"></span>	
									@endif
									
								</a>
								<div class="dropdown-menu" style="overflow: scroll;">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h2 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الاشعارات</h2>
											@if (auth()->user()->unreadNotifications->count() > 0)
												<span class="badge badge-pill badge-warning mr-auto my-auto float-left">
													<a href="{{route('mark')}}">تعين قراءة الكل</a>
												</span>	
											@endif
											
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
										<h6 style="color: yellow" id="notifications_count">
											لديك عدد {{ auth()->user()->unreadNotifications->count() }} إشعارات غير مقروءة
										</h6>
										</p>
									</div>
									<div id="unreadNotifications" >
										@foreach (auth()->user()->unreadNotifications as $notification)
											<div class="main-notification-list Notification-scroll">
												@if ($notification->type == "App\Notifications\CallcenterTickets")
												<a class="d-flex p-3 border-bottom"
												href="{{ route('ticketdetails', $notification->data['id']) }}">
												<div class="notifyimg bg-pink">
													<i class="la la-file-alt text-white"></i>
												</div>
												<div class="mr-3">
													<h1 class="notification-label mb-1">{{ $notification->data['title'] }} 
														<br>
														{{ $notification->data['user'] }}
													</h1>
													{{-- <div class="notification-subtext">{{ $notification->created_at }}</div> --}}
												</div>
											</a>
												@elseif($notification->type == "App\Notifications\RegisterBox")
												<a class="d-flex p-3 border-bottom"
												href="{{ route('savings.show', $notification->data['empid']) }}">
												<div class="notifyimg bg-pink">
													<i class="la la-file-alt text-white"></i>
												</div>
												<div class="mr-3">
													<h1 class="notification-label mb-1">{{ $notification->data['title'] }} <br>
														{{ $notification->data['user'] }}
														

													</h1>
													{{-- <div class="notification-subtext">{{ $notification->created_at }}</div> --}}
												</div>
											</a>
												@endif
												
											</div>
										@endforeach
									</div>
								</div>
							</div>
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
                            </div>

							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{ auth::user()->avatar }}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
                                            <div class="main-img-user"><img alt="" src="{{ auth::user()->avatar}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{auth::user()->name}}</h6><span>{{auth::user()->email}}</span>
											</div>
										</div>
									</div>
									<a class="dropdown-item  tx-md-16-f" href="{{route('showprofile')}}"><i class="bx bx-user-circle"></i>{{__('lable.profile')}}</a>
                                    <a class="dropdown-item  tx-md-16-f" href="{{route('logout')}}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        <i class="bx bx-log-out"></i> {{__('lable.signOut')}}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
