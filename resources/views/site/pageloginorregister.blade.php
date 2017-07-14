@extends('site.template1')

@section('content')
	<!-- Page Header -->
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="breadcrumb-wrapper">
						<h2 class="product-title">Login</h2>
						<ol class="breadcrumb">
							<li><a href="#"><i class="ti-home"></i> Home</a></li>
							<li class="current">Login</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Forms Login and Register -->
	<section id="content" class="my-account">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-6 cd-user-modal">
					<div class="my-account-form">
						<ul class="cd-switcher">
							<li><a class="@if( !session('tabNameSelected') || session('tabNameSelected') == 'login' || session('tabNameSelected') == 'password-reset') selected @endif" href="#0">LOGIN</a></li>
							<li><a class="{{ ( (session('tabNameSelected')) && (session('tabNameSelected') == 'register')) ? 'selected' : ''}}" href="#0">REGISTRAR</a></li>
						</ul>
						 
						<div id="cd-login" class="{{ (!session('tabNameSelected') || (session('tabNameSelected') == 'login')) ? 'is-selected' : '' }}">
							<div class="page-login-form">
								@if(session('error'))
									<p class="alert alert-danger">{{ session('error') }}</p>
								@elseif( session('success') )
									<p class="alert alert-success">{{ session('success') }}</p>
								@endif
								<form role="form" class="login-form" method="POST" action="{{url('/login')}}">
									{!!csrf_field()!!}
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-at" aria-hidden="true"></i>
											<input type="text" id="email" class="form-control" name="email_username" placeholder="E-mail ou Usuário">
										</div>
									</div>
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-lock" aria-hidden="true"></i>
											<input type="password" class="form-control" name="password" placeholder="Password">
										</div>
									</div>
									<div class="button-align-center">
										<button class="btn my-btn">
								        	<span class="left title">Login</span>
								         	<i class="right icon ti ti-arrow-circle-right"></i>
								      	</button>
									</div>
									
									<div class="checkbox-item">
										<div class="checkbox">
											<input type="checkbox" id="remember" name="remember" />
											<label for="remember"></label>
										</div>
										<div>Lembrar-me</div>
										<p class="cd-form-bottom-message"><a href="#0">Esqueceu sua senha?</a></p>
									</div>
								</form>
							</div>
						</div>
						 
						<div id="cd-signup" class="{{ ( (session('tabNameSelected')) && (session('tabNameSelected') == 'register')) ? 'is-selected' : ''}}">
							<div class="page-login-form register">
								<form role="form" id="register-form" class="login-form" method="POST" action="{{url('/perfil/registrar')}}">
									{!!csrf_field()!!}
									<div class="form-group @if ($errors->has('name')) has-error @endif">
										<div class="input-icon">
											<i class="fa fa-user" aria-hidden="true"></i>
											<input type="text" id="name" class="form-control" name="name" placeholder="Nome" value="{{old('name')}}">
											@if ($errors->has('name')) 
												<p class="alert-danger">{{ $errors->first('name') }}</p> 
											@endif
										</div>
									</div>
									<div class="form-group @if ($errors->has('user_name')) has-error @endif">
										<div class="input-icon">
											<i class="fa fa-user-circle-o" aria-hidden="true"></i>
											<input type="text" id="user_name" class="form-control" name="user_name" placeholder="Nome de usuário" value="{{old('user_name')}}">
											@if ($errors->has('user_name')) 
												<p class="alert-danger">{{ $errors->first('user_name') }}</p> 
											@endif
										</div>
									</div>
									<div class="form-group @if ($errors->has('email')) has-error @endif">
										<div class="input-icon">
											<i class="fa fa-at" aria-hidden="true"></i>
											<input type="text" id="sender-email" class="form-control" name="email" placeholder="E-mail" value="{{old('email')}}">
											@if ($errors->has('email')) 
												<p class="alert-danger">{{ $errors->first('email') }}</p> 
											@endif
										</div>
									</div>
									<div class="form-group @if ($errors->has('password')) has-error @endif">
										<div class="input-icon">
											<i class="fa fa-lock" aria-hidden="true"></i>
											<input type="password" class="form-control" id="password" name="password" placeholder="Senha">
											@if ($errors->has('password')) 
												<p class="alert-danger">{{ $errors->first('password') }}</p> 
											@endif
										</div>
									</div>
									<div class="form-group @if ($errors->has('confirm-password')) has-error @endif">
										<div class="input-icon">
											<i class="fa fa-lock" aria-hidden="true"></i>
											<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Repetir Senha">
											@if ($errors->has('confirm-password')) 
												<p class="alert-danger">{{ $errors->first('confirm-password') }}</p> 
											@endif
										</div>
									</div>
									<div class="button-align-center">
										<button class="btn my-btn" onclick="validatePassword('#register-form','#password','#confirm-password');">
								        	<span class="left title">Registrar</span>
								         	<i class="right icon ti ti-arrow-circle-right"></i>
								      	</button>
									</div>
								</form>
							</div>
						</div>
						<div class="page-login-form {{ ( (session('tabNameSelected')) && (session('tabNameSelected') == 'password-reset')) ? 'is-selected' : ''}}" id="cd-reset-password">
							@if(session('error-reset-password'))
								<p class="alert alert-danger">{{ session('error-reset-password') }}</p>
							@elseif( session('success-reset-password') )
								<p class="alert alert-success">{{ session('success-reset-password') }}</p>
							@endif
							<p class="cd-form-message">Esqueceu sua senha? Por favor digite seu e-mail. Você irá receber um link para criar uma nova senha.</p>
							<form class="cd-form" action="{{url('/perfil/resetar/senha')}}" method="POST">
								{!!csrf_field()!!}
								<div class="form-group">
									<div class="input-icon">
										<i class="ti-email"></i>
										<input type="text" id="sender-email" class="form-control" name="email-reset" placeholder="Email">
										@if ($errors->has('email-reset')) 
											<p class="alert-danger">{{ $errors->first('email-reset') }}</p> 
										@endif
									</div>
								</div>
								<p class="fieldset">
									<div class="button-align-center">
										<button class="btn my-btn" type="submit">
								        	<span class="left title">Trocar senha</span>
								         	<i class="right icon ti ti-arrow-circle-right"></i>
								      	</button>
									</div>	
								</p>
							</form>
							<p class="cd-form-bottom-message"><a href="#0">Voltar para login</a></p>
							<div class="clear"> </div>
						</div>  
					</div>
				</div>
			</div>
		</div>
	</section><!-- #content -->
@endsection
@push('scripts_js')
	<script type="text/javascript" src="{{url('assets/site/js/login-register.js')}}"></script>
@endpush
