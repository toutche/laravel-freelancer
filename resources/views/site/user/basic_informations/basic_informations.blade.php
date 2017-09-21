<div class="divider"><h3>Informações Básicas</h3></div>
	<div class="form-group @if ($errors->has('name')) has-error @endif">
		<label class="control-label" for="name">Nome</label>
		<input type="text" class="form-control" name="name" placeholder="Nome" value="{{Auth::User()->name}}" disabled="disabled">
		@if ($errors->has('name')) 
			<p class="alert-danger">{{ $errors->first('name') }}</p> 
		@endif	
	</div>
	<div class="form-group @if ($errors->has('cpf')) has-error @endif">
		<label class="control-label" for="cpf">CPF</label>
		<input type="text" class="form-control" name="cpf" placeholder="000.000.000-00" value="{{old('cpf')}}">
		@if ($errors->has('cpf')) 
			<p class="alert-danger">{{ $errors->first('cpf') }}</p> 
		@endif
	</div>
	<div class="form-group @if ($errors->has('email')) has-error @endif">
		<label class="control-label" for="email">E-mail</label>
		<input type="text" class="form-control" name="email" placeholder="seu@dominio.com.br" value="{{Auth::User()->email}}" disabled="disabled">
		@if ($errors->has('email')) 
			<p class="alert-danger">{{ $errors->first('email') }}</p> 
		@endif
	</div>
	<div class="form-group @if ($errors->has('professional_title')) has-error @endif">
		<label class="control-label" for="professional_title">Título profissional</label>
		<input type="text" class="form-control" name="professional_title" placeholder="Ex: Engenheiro..." value="{{old('professional_title')}}">
		@if ($errors->has('professional_title')) 
			<p class="alert-danger">{{ $errors->first('professional_title') }}</p> 
		@endif
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-md-6 @if ($errors->has('phone')) has-error @endif">
				<label class="control-label" for="phone">Telefone</label>
				<input type="text" class="form-control" name="phone" placeholder="(00) 0000-0000" value="{{old('phone')}}">
				@if ($errors->has('phone')) 
					<p class="alert-danger">{{ $errors->first('phone') }}</p> 
				@endif
			</div>
			<div class="col-md-6 @if ($errors->has('cell_phone')) has-error @endif">
				<label class="control-label" for="cell_phone">Celular</label>
				<input type="text" class="form-control" name="cell_phone" placeholder="(00) 00000-0000" value="{{old('cell_phone')}}">
				@if ($errors->has('cell_phone')) 
					<p class="alert-danger">{{ $errors->first('cell_phone') }}</p> 
				@endif
			</div>
		</div>
	</div>
	<div class="form-group @if ($errors->has('site')) has-error @endif">
		<label class="control-label" for="site">Site</label>
		<input type="text" class="form-control" name="site" placeholder="http://www.exemplo.com.br" value="{{old('site')}}">
		@if ($errors->has('site')) 
			<p class="alert-danger">{{ $errors->first('site') }}</p> 
		@endif
	</div>
	<div class="form-group @if ($errors->has('date_birth')) has-error @endif">
		<label class="control-label" for="date_birth">Data de Nascimento</label>
		<input type="text" class="form-control" name="date_birth" placeholder="DD/MM/AAAA" value="{{old('date_birth')}}">
		@if ($errors->has('date_birth')) 
			<p class="alert-danger">{{ $errors->first('date_birth') }}</p> 
		@endif
	</div>
	<div class="form-group @if ($errors->has('about_me')) has-error @endif">
		<label class="control-label" for="about_me">Sobre mim</label>
	</div>
	<section class="editor @if ($errors->has('about_me')) has-error @endif">
		<textarea class="edit" name="about_me">
			@php 
				echo htmlspecialchars(old('about_me'));
			@endphp
		</textarea>
		@if ($errors->has('about_me')) 
			<p class="alert-danger">{{ $errors->first('about_me') }}</p> 
		@endif
	</section>
	<div class="form-group">
		<div class="button-group">
			<div class="action-buttons">
				<div class="upload-button">
					<input type="file" name="image_perfil" id="image_perfil" class="inputfile" />
					<label for="image_perfil">Escolha imagem de perfil</label>
					@if ($errors->has('image_perfil')) 
						<p class="alert-danger">{{ $errors->first('image_perfil') }}</p> 
					@endif
				</div>
			</div>
		</div>
	</div>