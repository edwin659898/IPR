<!DOCTYPE html>
<html lang="en">

<head>
	<title>IPR | BGF</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="{{asset('storage/logo.png')}}" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<!-- fileupload-custom css -->
	<link rel="stylesheet" href="{{asset('assets/css/plugins/dropzone.min.css')}}">
	<!-- data tables css -->
	<link rel="stylesheet" href="{{asset('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="">
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div ">

				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>IPR System</label>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a class="nav-link cursor-pointer"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">My Dashboard</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{route('home')}}">My previous IPRs</a></li>
							@if(auth()->user()->op || auth()->user()->slm)
							<li><a href="{{route('sup.mysuppliers')}}">My Suppliers</a></li>
							<li><a href="{{route('sup.supplier')}}">Introduce Supplier</a></li>
							@endif
						</ul>
					</li>
					<li class="nav-item"><a href="{{route('user.create')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-edit"></i></span><span class="pcoded-mtext">Create IPR</span></a></li>
					<li class="nav-item pcoded-hasmenu">
						<a class="nav-link cursor-pointer"><span class="pcoded-micon"><i class="fas fa-user-check"></i></span><span class="pcoded-mtext">Site Review</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{route('site.nyongoro')}}">Nyongoro</a></li>
							<li><a href="{{route('site.kiambere')}}">Kiambere</a></li>
							<li><a href="{{route('site.forks')}}">7 Forks</a></li>
							<li><a href="{{route('site.dokolo')}}">Dokolo</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a class="nav-link cursor-pointer"><span class="pcoded-micon"><i class="fas fa-users"></i></span><span class="pcoded-mtext">Department Review</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{route('dept.account')}}">Accounts</a></li>
							<li><a href="{{route('dept.forestry')}}">Forestry</a></li>
							<li><a href="{{route('dept.it')}}">IT</a></li>
							<li><a href="{{route('dept.communication')}}">Communications</a></li>
							<li><a href="{{route('dept.hr')}}">Human Resources</a></li>
							<li><a href="{{route('dept.miti')}}">Miti Magazine</a></li>
							<li><a href="{{route('dept.operation')}}">Operations</a></li>
							<li><a href="{{route('dept.ME')}}">M&E</a></li>
						</ul>
					</li>
					<li class="nav-item"><a href="{{route('operation.op')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-friends"></i></span><span class="pcoded-mtext">Op review</span></a></li>
					<li class="nav-item pcoded-menu-caption">
						<label>Final Review & Approvals</label>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a class="nav-link cursor-pointer"><span class="pcoded-micon"><i class="fas fa-user-graduate"></i></span><span class="pcoded-mtext">Review & Approve</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{route('md.mdCapex')}}">Capex</a></li>
							<li><a href="{{route('md.mdOpex')}}">Opex</a></li>
							<li><a href="{{route('md.mdConstruction')}}">Building</a></li>
                            <li><a href="{{route('md.mdSoftware')}}">Software & Licenses</a></li>
							<li><a href="{{route('sup.viewSupplier')}}">Supplier Approval</a></li>
						</ul>
					</li>
					<li class="nav-item"><a href="{{route('approved.final')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-print"></i></span><span class="pcoded-mtext">Approved IPRs</span></a></li>
					<li class="nav-item"><a href="{{route('sup.approvedSupplier')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-shopping-cart"></i></span><span class="pcoded-mtext">Approved Suppliers</span></a></li>
					<li class="nav-item"><a href="{{route('todo.trace')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-search"></i></span><span class="pcoded-mtext">Track IPR</span></a></li>
				</ul>

			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">


		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			<a href="#!" class="b-brand">
				<!-- ========   change your logo hear   ============ -->
				<img src="{{asset('assets/images/logo.png')}}" alt="" class="logo" width="40" height="40">

			</a>
			<a href="#" class="mob-toggler">
				<i class="feather icon-more-vertical"></i>
			</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">
				<li>
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="feather icon-user"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<div class="pro-head">
								<span>{{auth()->user()->name}}</span>
								<a href="auth-signin.html" class="dud-logout" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
									<i class="feather icon-log-out"></i>
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
							<ul class="pro-body">
								<li><a href="{{ route('user.profile') }}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>


	</header>
	<!-- [ Header ] end -->



	<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-content">
			<!-- [ breadcrumb ] start -->
			<div class="page-header">
				<div class="page-block">
					<div class="row align-items-center">
						<div class="col-md-12">
							<div class="page-header-title">
								<h5 class="m-b-10">Sample Page</h5>
							</div>
							<ul class="breadcrumb">
								<li class="breadcrumb-item text-white">{{Request::segment(1)}}</li>
								<li class="breadcrumb-item"><a href="#!">{{Request::segment(2)}}</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- [ breadcrumb ] end -->
			<!-- [ Main Content ] start -->
			<div class="row">
				<!-- [ sample-page ] start -->
				<div class="col-sm-12">
					@yield('content')
				</div>
				<!-- [ sample-page ] end -->
			</div>
			<!-- [ Main Content ] end -->
		</div>
	</div>
	<!-- Required Js -->
	<script>
		function update_sum() {
			let sum = [...document.querySelectorAll('.txt')].reduce((acc, cur) => {
				return Number(cur.value) + acc
			}, 0);

			document.getElementById("sum-field").textContent = sum;
		}
		update_sum();
	</script>

	<script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
	<script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/ripple.js')}}"></script>
	<script src="{{asset('assets/js/pcoded.min.js')}}"></script>
	@include('sweetalert::alert')
	<script>
		$(document).ready(function() {
			$('#dtBasicExample').DataTable({
				"order": [
					[1, "desc"]
				]
			});
			$('.dataTables_length').addClass('bs-select');
		});
	</script>
	<!-- datatable Js -->
	<script src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('assets/js/pages/data-basic-custom.js')}}"></script>


</body>

</html>