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
		
	</head>
	<body>
		<!-- Forms Login and Register -->
		<section id="content" class="my-account">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-6 cd-user-modal">
						<div class="my-account-form">							
							<div class="page-login-form is-selected" id="cd-reset-password">
								@if(session('error'))
									<p class="alert alert-danger">{{ session('error') }}</p>
								@elseif( session('success') )
									<p class="alert alert-success">{{ session('success') }}</p>
								@endif
								<p class="cd-form-message">Digite sua nova senha.</p>
								<form class="cd-form" id="form-reset-password" action="{{url('/perfil/resetar/senha/'.$token)}}" method="POST">
									{!!csrf_field()!!}
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-lock"></i>
											<input type="password" class="form-control" id="password-reset" name="password-reset" placeholder="Nova senha">
											@if ($errors->has('password-reset')) 
												<p class="alert-danger">{{ $errors->first('password-reset') }}</p> 
											@endif
										</div>
									</div>
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-lock"></i>
											<input type="password"  class="form-control" id="password-reset-confirm" name="password-reset-confirm" placeholder="Repetir nova senha">
											@if ($errors->has('password-reset-confirm')) 
												<p class="alert-danger">{{ $errors->first('password-reset-confirm') }}</p> 
											@endif
										</div>
									</div>
									<div class="button-align-center">
										<button class="btn my-btn" type="submit" onclick="validatePassword('#form-reset-password','#password-reset','#password-reset-confirm');">
								        	<span class="left title">Trocar senha</span>
								         	<i class="right icon ti ti-arrow-circle-right"></i>
								      	</button>
									</div>
								</form>
							</div>  
						</div>
					</div>
				</div>
			</div>
		</section><!-- #content -->
		<script type="text/javascript" src="{{url('js/jquery-3.2.1.min.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/site/js/login-register.js')}}"></script>
	</body>
</html>