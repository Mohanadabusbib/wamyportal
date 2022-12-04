<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='home') }}">
                    {{-- <img src="{{URL::asset('public/assets/img/brand/logo.png')}}" class="main-logo" alt="logo"> --}}
                    {{-- <img src="{{ URL::asset('/public/assets/img/brand/logo2.jpg' )}}" class="main-logo" alt="logo"> --}}
                    <img src="{{ URL::asset('/public/assets/img/brand/logo.png' )}}" class="main-logo" alt="logo">
                    
                    
                    {{-- <img src="{{ URL::asset('public/assets/img/brand/logo.png' )}}" class="main-logo" alt="logo"> --}}
                              {{-- {{ URL::asset('public/assets/img/media/login.jpg') }} --}}
                </a>
				{{-- <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='home') }}"><img src="{{URL::asset('public/assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a> --}}
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='home') }}"><img src="{{URL::asset('public/assets/img/brand/logo.jpg')}}" class="logo-icon" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
                            <img alt="user-img" class="avatar avatar-xl brround" src="{{ Auth::user()->avatar ?  Auth::user()->avatar : asset('public/storage/images/avatar.png') }}">
                            <span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0 tx-md-18-f">{{auth::user()->name}}</h4>
							<span class="mb-0 text-muted">{{auth::user()->email}}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
                    @can('mm-callcenter')
					<li class="slide side-item-category ">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            {{-- <i class="fas fa-people-carry side-menu__icon"></i> --}}
                            <i class="fas fa-headset side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{ __('menu.callCneter')}}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
                            @can('ms-callcenter-search')
                                <li><a class="slide-item  tx-md-16-f" href="{{ route('callcenterSearch') }}">{{__('menu.search')}}</a></li>
                            @endcan

                            <li><a class="slide-item  tx-md-16-f" href="{{ route('incomingticket',auth()->user()->name) }}">{{__('menu.incomingtransaction')}}</a></li>
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('alltickets') }}">{{__('menu.alltikets')}}</a></li>
                            {{-- <li><a class="slide-item  tx-md-16-f" href="{{ route('callcenter.index') }}">{{__('menu.ticketCallCenter')}}</a></li> --}}
						</ul>
                    </li>
                    @endcan                       
                    @can('mm-auction')
                            <li class="slide side-item-category ">
                                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                                    <i class="fas fa-car side-menu__icon"></i>
                                    <span class="side-menu__label  tx-md-16-f">مزاد بيع السيارات</span>
                                    <i class="angle fe fe-chevron-down"></i>
                                </a>
                                <ul class="slide-menu">
                                    
                                    @if (Auth()->user()->empid == 11829)
                                    <li><a class="slide-item  tx-md-16-f" href="{{ route('registrAuction.index')}}">تسجيل</a></li>    
                                    @endif
                                    
                                    <li><a class="slide-item  tx-md-16-f" href="{{ route('registrAuction.show','receipt')}}">إيصال الإستلام</a></li>
                                    @if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11175)
                                        <li><a class="slide-item  tx-md-16-f" href="{{ route('registrAuction.create')}}">الإعتماد</a></li>                       
                                    @endif
                                    <li><a class="slide-item  tx-md-16-f" href="{{ route('auctions.index')}}">المزاد</a></li>      
                                    @if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11175 || Auth()->user()->empid == 11693 || Auth()->user()->empid == 11939 || Auth()->user()->empid == 11803)

                                    <li><a class="slide-item  tx-md-16-f" href="{{ route('auctions.show',2)}}">نتيجة المزاد</a></li>
                                    <li><a class="slide-item  tx-md-16-f" href="{{ route('fReport')}}">تقرير المزاد</a></li>
                                    @endif                                       
                                </ul>
                            </li>
                        
                    @endcan
                    
                    @can('mm-inventory')
					<li class="slide side-item-category">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            {{-- <i class="far fa-building side-menu__icon"></i> --}}
                            
                            <i class="fas fa-boxes side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{__('menu.inventory')}}</span>
                            <i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('sm-inventory')
                                @if (auth()->user()->empid == 11829)
                                    <li><a class="slide-item  tx-md-16-f" href="{{route('truncateData')}}">Truncate-Data</a></li>
                                @endif
                                <li><a class="slide-item  tx-md-16-f" href="{{route('Inventory.index')}}">Inventory</a></li>
                                <li><a class="slide-item  tx-md-16-f" href="{{route('Stocks.index')}}">Stores</a></li>
                                <li><a class="slide-item  tx-md-16-f" href="{{route('Hardware.index')}}">Hardwares</a></li>
                                <li><a class="slide-item  tx-md-16-f" href="{{route('Manufacturers.index')}}">Manufacturers</a></li>    
                            @endcan
                            
                            @can('sm-myCustody')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('Inventory-printEmp',Auth()->user()->empid)}}">{{__('menu.myCustody')}}</a></li>
                            @endcan
                            {{-- @can('sm-displayLoc-property')
                            <li><a class="slide-item  tx-md-16-f" href="#">{{__('menu.displayProperty')}}</a></li>
                            @endcan --}}

						</ul>
                    </li>
                    @endcan
                    @can('mm-box-savings')
					<li class="slide side-item-category ">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="fas fa-people-carry side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{ __('menu.savings')}}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
                            {{-- @if (Auth()->user()->empid == 11723 )
                                <li><a class="slide-item  tx-md-16-f" href="{{ route('savings.index') }}">{{__('menu.reqsavings')}}</a></li>
                            @endif --}}
                            @can('sm-box-registr')
                            @if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11402 )
                                <li><a class="slide-item  tx-md-16-f" href="{{ route('savings.index') }}">{{__('menu.reqsavings')}}</a></li>                                    
                            @endif
                            @endcan
                            @can('sm-contract-box')
                                <li><a class="slide-item  tx-md-16-f" href="{{ route('savings.show',auth::user()->empid)}}">{{__('menu.contractbox')}}</a></li>
                                @if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11402)
                                    <li><a class="slide-item  tx-md-16-f" href="{{ route('contractAll')}}">عقود الموظفين</a></li>
                                @endif
                            @endcan
                            @can('sm-alldata-box')
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('openreports') }}">تقرير بجميع المشتركين</a></li>
                            @endcan

                            @can('sm-box-pull')
                            <li><a class="slide-item  tx-md-16-f" href="">السحب</a></li>
                            @endcan
                            @can('sm-box-orders')
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('boxOrders.index') }}">الطلبات</a></li>
                            @endcan
                            @can('sm-box-sponsor')
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('sponsor.index') }}">الكفالة</a></li>
                            @endcan
                            {{-- @can('sm-box-analysis') --}}
                                @if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11402)
                                    <li><a class="slide-item  tx-md-16-f" href="{{ route('financial.index') }}">التحليل المالي</a></li>    
                                @endif
                            {{-- @endcan --}}
                            @can('sm-box-report')
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('showReport') }}">تقرير اللجنة</a></li>
                            @endcan

                            @can('sm-nomination-box')
                            <li><a class="slide-item  tx-md-16-f" href="">=========</a></li>
                            <li><a class="slide-item  tx-md-16-f" href="{{route('savings.nomination')}}">{{__('menu.nominationbox')}}</a></li>
                            @endcan
                            @can('sm-disnomination-box')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('displaynomination')}}">{{__('menu.displaynomination')}}</a></li>
                            @endcan
                            @can('sm-vote-box')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('vote')}}">{{__('menu.vote')}}</a></li>
                            @endcan
                            @can('sm-approvalvote-box')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('savings.edit',1)}}">إعتماد الأصوات</a></li>
                            @endcan
                            @can('sm-voteresualt-box')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('voteresualt')}}">{{__('menu.voteresualt')}}</a></li>
                            @endcan
                            @can('sm-voteresualt2-box')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('resualtAllData')}}">تقرير خاص</a></li>
                            @endcan

							{{-- <li><a class="slide-item  tx-md-16-f" href="{{  route('disclosure.show',Auth::user()->id) }}">{{__('menu.entryRequest')}}</a></li>
							<li><a class="slide-item  tx-md-16-f" href="{{ route('disclosure.allData') }}">{{__('menu.allData')}}</a></li> --}}

						</ul>
                    </li>
                    @endcan
                    @can('mm-evaluation')
					<li class="slide side-item-category ">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="fas fa-hand-holding-heart side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{ __('menu.magar')}}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
                            @can('sm-evaluation-registr')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('evaluation.index')}}">{{__('menu.evaluation')}}</a></li>
                            @endcan
                            @can('sm-evaluation-ip')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('Ipconfig.index')}}">{{__('menu.ipconfig')}}</a></li>
                            @endcan
                            @can('sm-evaluation-report')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('evaluation.create')}}">{{__('menu.report')}}</a></li>
                            @endcan
						</ul>
                    </li>
                    @endcan
                    @can('mm-disclosure-form')
					<li class="slide side-item-category ">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            {{-- <i class="bx bx-health side-menu__icon" ></i> --}}
                            <i class="fas fa-head-side-mask side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{ __('menu.disclosureForm')}}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
                            @can('sm-disclosure')
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('disclosure.index') }}">{{__('menu.fillForm')}}</a></li>
                            @endcan

                            @can('sm-order-disclosure')
                            <li><a class="slide-item  tx-md-16-f" href="{{  route('disclosure.show',Auth::user()->id) }}">{{__('menu.entryRequest')}}</a></li>
                            @endcan

                            @can('sm-alldata-disclosure')
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('disclosure.allData') }}">{{__('menu.allData')}}</a></li>
                            @endcan


						</ul>
                    </li>
                    @endcan
                    @can('mm-wamy-visitors')
					<li class="slide side-item-category">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="bx bx-happy side-menu__icon" ></i>
                            <span class="side-menu__label  tx-md-16-f">{{__('menu.wamyVisitors')}}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('sm-order-visit')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('visitors.index')}}">{{__('menu.visitRequest')}}</a></li>
                            @endcan
                            @can('sm-approval-visit')
                            <li>
                                <a class="slide-item  tx-md-16-f" href="{{route('visitors.approvals')}}">{{__('menu.visitApprovel')}}

                                {{-- @if ($visitors->approval == 1)
                                <span class="badge badge-success">New</span>
                                @else
                                <span class="badge badge-danger">New</span>
                                @endif --}}
                            </a></li>
                            @endcan
							{{-- <li><a class="slide-item" href="#">{{__('menu.displayData')}}</a></li> --}}
						</ul>
                    </li>
                    @endcan
                    @can('mm-property')
					<li class="slide side-item-category">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="far fa-building side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{__('menu.property')}}</span>
                            <i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('sm-addLoc-property')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('properties.create')}}">{{__('menu.addProperty')}}</a></li>
                            @endcan
                            @can('sm-displayLoc-property')
                            <li><a class="slide-item  tx-md-16-f" href="#">{{__('menu.displayProperty')}}</a></li>
                            @endcan

						</ul>
                    </li>
                    @endcan 
                    <li class="slide side-item-category ">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            {{-- <i class="fas fa-people-carry side-menu__icon"></i> --}}
                            <i class="fas fa-headset side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">دليل الهاتف</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('TB.index') }}">دليل الهاتف</a></li>
                            @can('ms-add-telephnoeBook')        
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('TB.create') }}">إضافة لدليل الهاتف</a></li>    
                            @endcan
						</ul>
                    </li>
                    
                    @can('mm-security')
					<li class="slide side-item-category">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="fas fa-user-secret side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{__('menu.security')}}</span>
                            <i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('sm-displayEmp-security')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('security',1)}}">{{__('menu.displayEmp')}}</a></li>
                            @endcan
                            @can('sm-displayVisitor-security')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('security',2)}}">{{__('menu.displayVisitors')}}</a></li>
                            @endcan

						</ul>
                    </li>
                    @endcan
                    @can('mm-users')
					<li class="slide side-item-category">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="fas fa-users side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{__('menu.users')}}</span>
                            <i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('sm-sctn')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('users.index')}}">{{__('menu.users')}}</a></li>
                            @endcan
                            @can('sm-permission')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('permissions.index')}}">{{__('lable.permissions')}}</a></li>
                            @endcan
							{{-- <li><a class="slide-item" href="{{ url('/' . $page='product-details') }}">{{__('menu.visitApprovel')}}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='product-cart') }}">{{__('menu.displayData')}}</a></li> --}}
						</ul>
                    </li>
                    @endcan                    
                    @can('mm-setting')
					<li class="slide side-item-category">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="fas fa-cogs side-menu__icon"></i>
                            <span class="side-menu__label  tx-md-16-f">{{__('menu.setting')}}</span>
                            <i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('sm-TransferData')
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('transfer-data') }}">نقل البيانات</a></li>    
                            @endcan
                            
                            @can('sm-profile')
                            <li><a class="slide-item  tx-md-16-f" href="{{ route('showprofile') }}">{{__('lable.profile')}}</a></li>
                            @endcan
                            @can('sm-dept')
                            <li><a class="slide-item  tx-md-16-f" href="#">{{__('lable.dept')}}</a></li>
                            @endcan
                            @can('sm-sctn')
                            <li><a class="slide-item  tx-md-16-f" href="#">{{__('lable.sctn')}}</a></li>
                            @endcan
                            {{-- @can('sm-permission')
                            <li><a class="slide-item  tx-md-16-f" href="{{route('permissions.index')}}">{{__('lable.permissions')}}</a></li>
                            @endcan --}}
							{{-- <li><a class="slide-item" href="{{ url('/' . $page='product-details') }}">{{__('menu.visitApprovel')}}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='product-cart') }}">{{__('menu.displayData')}}</a></li> --}}
						</ul>
                    </li>
                    @endcan
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
