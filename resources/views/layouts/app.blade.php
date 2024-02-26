<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>BGF | IPR</title>
	<link rel="icon" type="img/ico" href="{{asset('/storage/images/logo.png')}}" />

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<style>
		body {
			color: #A9A9A9;
			background: #f5f5f5;
			font-family: 'Varela Round', sans-serif;
		}

		.form-control {
			box-shadow: none;
			border-color: #ddd;
		}

		.form-control:focus {
			border-color: #4aba70;
		}

		.login-form {
			width: 350px;
			margin: 0 auto;
			padding: 30px 0;
		}

		.login-form form {
			color: #434343;
			border-radius: 1px;
			margin-bottom: 15px;
			background: #fff;
			border: 1px solid #f3f3f3;
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			padding: 30px;
		}

		.login-form h4 {
			text-align: center;
			font-size: 22px;
			margin-bottom: 20px;
		}

		.login-form .avatar {
			color: #fff;
			margin: 0 auto 30px;
			text-align: center;
			width: 100px;
			height: 100px;
			border-radius: 50%;
			z-index: 9;
			background: #4aba70;
			padding: 15px;
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
		}

		.login-form .avatar i {
			font-size: 62px;
		}

		.login-form .form-group {
			margin-bottom: 20px;
		}

		.login-form .form-control,
		.login-form .btn {
			min-height: 40px;
			border-radius: 2px;
			transition: all 0.5s;
		}

		.login-form .close {
			position: absolute;
			top: 15px;
			right: 15px;
		}

		.login-form .btn,
		.login-form .btn:active {
			background: #4aba70 !important;
			border: none;
			line-height: normal;
		}

		.login-form .btn:hover,
		.login-form .btn:focus {
			background: #42ae68 !important;
		}

		.login-form .checkbox-inline {
			float: left;
		}

		.login-form input[type="checkbox"] {
			position: relative;
			top: 2px;
		}

		.login-form .forgot-link {
			float: right;
		}

		.login-form .small {
			font-size: 13px;
		}

		.login-form a {
			color: #4aba70;
		}
	</style>
</head>

<body class="bg-gray-400">
	<div class="bg-gray-200 font-sans flex flex-col items-center">
		<header class="bg-green-800 w-full px-4 py-3 flex justify-center border-b-4 border-blue-500">
			<div class="max-w-4xl w-full">
				<div class="flex items-center justify-between text-pink-500">

					<img class="h-8 fill-current" src="{{asset('/storage/miti.png')}}" />

					<button type="button" class="text-gray-500 sm:hidden">
						<svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
							<path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
						</svg>
					</button>

				</div>

				<div class="my-4">
					<h1 class="text-2xl text-indigo-100">Better Globe Forestry LTD.</h1>
					<p class="text-sm text-indigo-200 font-mono ">“Prosperity with purpose”</p>

					<div class="relative mt-4 flex">
						<div>
							<a href="#" class="bg-blue-500 text-indigo-100 font-bold mt-2 px-4 py-2 rounded-full text-xs uppercase">IPR System</a>
						</div>


					</div>

				</div>

			</div>
		</header>
	</div>
	<main class="">
		@yield('content')


	</main>
	<div>
		<footer class="text-center text-blue-500 pt-4">
			<p>Copyright © 2020 Better Globe Forestry</p>
		</footer>
	</div>
</body>

</html>