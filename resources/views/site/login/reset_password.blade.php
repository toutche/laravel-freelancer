<div class="page-login-form {{ ( (session('tabNameSelected')) && (session('tabNameSelected') == 'password-reset')) ? 'is-selected' : ''}}" id="cd-reset-password">
	@if(session('error-reset-password'))
		<p class="alert alert-danger">{{ session('error-reset-password') }}</p>
	@elseif( session('success-reset-password') )
		<p class="alert alert-success">{{ session('success-reset-password') }}</p>
	@endif
	<p class="cd-form-message">Esqueceu sua senha? Por favor digite seu e-mail. Você irá receber um link para criar uma nova senha.</p>
	<form class="cd-form" action="{{url('/perfil/resetar/senha')}}" id="form_password_reset_request" method="POST">
		{!!csrf_field()!!}
		<div class="form-group @if ($errors->has('email_reset')) has-error @endif">
			<div class="input-icon">
				<i class="ti-email"></i>
				<input type="text" id="sender_email" class="form-control" name="email_reset" placeholder="Email">
				@if ($errors->has('email_reset')) 
					<p class="alert-danger">{{ $errors->first('email_reset') }}</p> 
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