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
		<link rel="stylesheet" href="{{url('css/menu-navigation.css')}}" type="text/css">
		@stack('scripts_css')
		
	</head>
	<body>
		<div class="menu-wrapper">

			<a href="#menu" class="menu-link">Menu<span class="ti-menu" aria-hidden="true"></span>
			</a>
			<nav id="menu" role="navigation">
				<div class="menu">
					<ul  class="menu">
						<li>
							<a href="#">Home</a>
						</li>
						<li  class=" current-menu-item">
							<a href="#">Menu 1</a>
						</li>
						<li  class="has-subnav">
							<a href="#">Áreas<span class="caret"></span></a>

							<ul class="sub-menu">
								<li>
									<a href="#">Área 1</a>
								</li>
								<li>
									<a href="#">Área 2</a>
								</li>
								<li>
									<a href="#">Área 3</a>
								</li>
								<li>
									<a href="#">Área 4</a>
								</li>
								<li>
									<a href="#">Área 5</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">Menu 2</a>
						</li>
						<li>
							<a href="#">Contato</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		
		@yield('content')

		<script type="text/javascript" src="{{url('js/jquery-3.2.1.min.js')}}"></script>
		<script type="text/javascript" src="{{url('js/menu-navgation.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/site/js/main.js')}}"></script>
		@stack('scripts_js')
	</body>
</html>