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
					@if( isset($errors) && count($errors) > 0)
						<div class="alert alert-danger">
							@foreach($errors->all() as $error)
								<p>{{$error}}</p>
							@endforeach
						</div>
					@endif
					<div class="my-account-form">
						<ul class="cd-switcher">
							<li><a class="{{ !session('tabNameSelected') ? 'selected' : '' }}" href="#0">LOGIN</a></li>
							<li><a class="{{ ( (session('tabNameSelected')) && (session('tabNameSelected') == 'register')) ? 'selected' : ''}}" href="#0">REGISTRAR</a></li>
						</ul>
						 
						<div id="cd-login" class="{{ !session('tabNameSelected') ? 'is-selected' : '' }}">
							<div class="page-login-form">
								<form role="form" class="login-form" method="POST" action="{{url('/perfil/registrar')}}">
									{!!csrf_field()!!}
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-at" aria-hidden="true"></i>
											<input type="text" id="email" class="form-control" name="email" placeholder="E-mail">
										</div>
									</div>
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-lock" aria-hidden="true"></i>
											<input type="password" class="form-control" placeholder="Password">
										</div>
									</div>
									<div class="button-login-register">
										<button class="btn my-btn">
								        	<span class="left title">Login</span>
								         	<i class="right icon ti ti-arrow-circle-right"></i>
								      	</button>
									</div>
									
									<div class="checkbox-item">
										<div class="checkbox">
											<input type="checkbox" id="cb" name="cb" />
											<label for="cb"></label>
										</div>
										<div>Lembrar-me</div>
										<p class="cd-form-bottom-message"><a href="#0">Esqueceu sua senha?</a></p>
									</div>
								</form>
							</div>
						</div>
						 
						<div id="cd-signup" class="{{ ( (session('tabNameSelected')) && (session('tabNameSelected') == 'register')) ? 'is-selected' : ''}}">
							<div class="page-login-form register">
								<form role="form" class="login-form" method="POST" action="{{url('/perfil/registrar')}}">
									{!!csrf_field()!!}
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-user" aria-hidden="true"></i>
											<input type="text" id="name" class="form-control" name="name" placeholder="Nome" value="{{old('name')}}">
										</div>
									</div>
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-user-circle-o" aria-hidden="true"></i>
											<input type="text" id="user_name" class="form-control" name="user_name" placeholder="Nome de usuário" value="{{old('user_name')}}">
										</div>
									</div>
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-at" aria-hidden="true"></i>
											<input type="text" id="sender-email" class="form-control" name="email" placeholder="E-mail" value="{{old('email')}}">
										</div>
									</div>
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-lock" aria-hidden="true"></i>
											<input type="password" class="form-control" name="password" placeholder="Senha">
										</div>
									</div>
									<div class="form-group">
										<div class="input-icon">
											<i class="fa fa-lock" aria-hidden="true"></i>
											<input type="password" class="form-control" placeholder="Repetir Senha">
										</div>
									</div>
									<div class="button-login-register">
										<button class="btn my-btn">
								        	<span class="left title">Registrar</span>
								         	<i class="right icon ti ti-arrow-circle-right"></i>
								      	</button>
									</div>
								</form>
							</div>
						</div>
						<div class="page-login-form" id="cd-reset-password">  
							<p class="cd-form-message">Esqueceu sua senha? Por favor digite seu e-mail. Você irá receber um link para criar uma nova senha.</p>
							<form class="cd-form">
								<div class="form-group">
									<div class="input-icon">
										<i class="ti-email"></i>
										<input type="text" id="sender-email" class="form-control" name="email" placeholder="Email">
									</div>
								</div>
								<p class="fieldset">
									<button class="btn btn-common log-btn" type="submit">Trocar senha</button>
								</p>
							</form>
							<p class="cd-form-bottom-message"><a href="#0">Voltar para login</a></p>
						</div>  
					</div>
				</div>
			</div>
		</div>
	</section><!-- #content -->
@endsection
