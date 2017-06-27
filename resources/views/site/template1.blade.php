<!DOCTYPE html>
<html lang="pt-br">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="author" content="Toutchê - Produtora Digital">
		<title>{{$title or 'JobBoard - Freelas'}}</title>
		 
		<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" type="text/css">
		<link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}" type="text/css">
		<link rel="stylesheet" href="{{url('css/themify-icons.css')}}" type="text/css">
		<link rel="stylesheet" href="{{url('assets/site/css/main.css')}}" type="text/css">
		<!-- Responsive Menu -->
		<link rel="stylesheet" href="{{url('assets/site/css/slicknav.css')}}" type="text/css">
		<link rel="stylesheet" href="{{url('assets/site/css/style.css')}}" type="text/css">
		@stack('scripts_css')
		
	</head>
	<body>
		<div class="header">
			<div class="logo-menu">
				<nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
					<div class="container">
					 
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand logo" href="index-2.html">Logo</a>
						</div>
						<div class="collapse navbar-collapse" id="navbar">
							<ul class="nav navbar-nav">
								<li>
									<a class="active" href="#">Home</a>
								</li>
								<li>
									<a class="" href="#">Menu 1 <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown">
										<li><a class="active" href="#">Submenu 1</a></li>
										<li><a href="#">Submenu 2</a></li>
										<li><a href="#">Submenu 3</a></li>
										<li><a href="#">Submenu 4</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Menu 2 <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown">
										<li><a href="#">Submenu 1</a></li>
										<li><a href="#">Submenu 2</a></li>
										<li><a href="#">Submenu 3</a></li>
									</ul>
								</li>
								<li><a href="#">Menu 3 <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown">
										<li><a href="#">Submenu 1</a></li>
										<li><a href="#">Submenu 2</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Menu 4</i></a>
								</li>
							</ul>
							<ul class="nav navbar-nav navbar-right float-right">
								<li class="left"><a href="#"><i class="ti-pencil-alt"></i> Postar Vaga</a></li>
								<li class="right"><a href="#"><i class="ti-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
					 
					<ul class="wpb-mobile-menu">
						<li>
							<a href="index-2.html">Home</a>
						</li>
						<li>
							<a href="about.html">Menu 1</a>
							<ul >
								<li><a class="active" href="#">Submenu 1</a></li>
								<li><a href="#">Submenu 2</a></li>
								<li><a href="#">Submenu 3</a></li>
								<li><a href="#">Submenu 4</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Menu 2</a>
							<ul>
								<li><a href="#">Submenu 1</a></li>
								<li><a href="#">Submenu 2</a></li>
								<li><a href="#">Submenu 3</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Menu 3</a>
							<ul>
								<li><a href="#">Submenu 1</a></li>
								<li><a href="#">Submenu 2</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Menu 4</a>
						</li>
						<li class="btn-m"><a href="#"><i class="ti-pencil-alt"></i> Postar Vaga</a></li>
						<li class="btn-m"><a class="active" href="#"><i class="ti-lock"></i> Login</a></li>
					</ul>
				</nav>
			</div>
		</div>
		
		@yield('content')

		<script type="text/javascript" src="{{url('js/jquery.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/site/js/slicknav.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/site/js/main.js')}}"></script>
		@stack('scripts_js')
	</body>
</html>