<div id="cd-signup" class="{{ ( (session('tabNameSelected')) && (session('tabNameSelected') == 'register')) ? 'is-selected' : ''}}">
	<div class="page-login-form register">
		@if(session('error-register'))
			<p class="alert alert-danger">{{ session('error-register') }}</p>
		@elseif( session('success-register') )
			<p class="alert alert-success">{{ session('success-register') }}</p>
		@endif
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
					<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Repetir Senha">
					@if ($errors->has('confirm-password')) 
						<p class="alert-danger">{{ $errors->first('confirm-password') }}</p> 
					@endif
				</div>
			</div>
			<div class="form-group">
				<label>Sou empresa?</label>
				<div class="form-group" id="div-radio-is-company">
					<ul>
						<li>
							<input type="radio" name="is_company" id="isCompanyYes" value="1">
							<label for="isCompanyYes"> Sim</label>
							<div class="check"></div>
						</li>
						<li>
							<input type="radio" name="is_company" id="isCompanyNo" value="0" checked>
							<label for="isCompanyNo"> Não</label>
							<div class="check"><div class="inside"></div></div>
						</li>
					</ul>
				</div>
				
			</div>
			<div class="button-align-center">
				<button class="btn my-btn" >
		        	<span class="left title">Registrar</span>
		         	<i class="right icon ti ti-arrow-circle-right"></i>
		      	</button>
			</div>
		</form>
	</div>
</div>