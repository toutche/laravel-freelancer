<div id="cd-login" class="{{ (!session('tabNameSelected') || (session('tabNameSelected') == 'login')) ? 'is-selected' : '' }}">
	<div class="page-login-form">
		@if(session('error'))
			<p class="alert alert-danger">@php echo htmlspecialchars_decode(session('error')); @endphp</p>
		@elseif( session('success') )
			<p class="alert alert-success">@php echo htmlspecialchars_decode(session('success')); @endphp</p>
		@elseif( session('warning') )
			<p class="alert alert-warning">@php echo htmlspecialchars_decode(session('warning')); @endphp</p>
		@endif
		<form role="form" class="login-form" id="login-form" method="POST" action="@php echo url('login',$parameters = ((!empty($token)) ? array('token' => $token) : array())); @endphp">
			{!!csrf_field()!!}
			<div class="form-group @if ($errors->has('email_username')) has-error @endif">
				<div class="input-icon">
					<i class="fa fa-at" aria-hidden="true"></i>
					<input type="text" id="email" class="form-control" name="email_username" placeholder="E-mail ou Usuário" value="{{old('email_username')}}">
					@if ($errors->has('email_username')) 
						<p class="alert-danger">{{ $errors->first('email_username') }}</p> 
					@endif
				</div>
			</div>
			<div class="form-group @if ($errors->has('password_login')) has-error @endif">
				<div class="input-icon">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input type="password" class="form-control" name="password_login" placeholder="Password">
					@if ($errors->has('password_login')) 
						<p class="alert-danger">{{ $errors->first('password_login') }}</p> 
					@endif
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
