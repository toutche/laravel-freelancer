@extends('site.template1')

@push('scripts_css')
	<link rel="stylesheet" href="{{url('assets/site/css/summernote.css')}}" type="text/css">
	<link rel="stylesheet" href="{{url('assets/site/css/bootstrap-select.min.css')}}" type="text/css">
@endpush

@section('content')
<section id="content">
	<div class="container">
		<div class="row">

			<div class="col-md-9 col-md-offset-2">
				@if( isset($errors) && count($errors) > 0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $error)
							<p>{{$error}}</p>
						@endforeach
					</div>
				@endif
				<div class="page-ads box">
					<form class="form-ad" method="POST" action="{{url('/perfil/complemento-perfil/envio')}}">
						{!!csrf_field()!!}
						
						@include('site.user.basic_informations.basic_informations')

						<div class="divider"><h3>Educação</h3></div>
						<div class="form-group">
							<label class="control-label" for="textarea">Grau</label>
							<div>
								<label class="styled-select degree">
									<select id="options-degree" class="dropdown-product selectpicker">
										<option value="select-degree">Selecione uma opção</option>
										<option value="graduating">Graduando</option>
										<option value="graduate">Graduado</option>
									</select>
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Curso</label>
							<input type="text" class="form-control" placeholder="Curso">
						</div>
						<div class="form-group" id="semestre">
							<label class="control-label" for="textarea">Semestre</label>
							<input type="text" class="form-control" placeholder="Ex: 6°">
						</div>
						<div class="add-post-btn" id="crea">
							<div class="pull-left" id="crea-numero">
								<div class="form-group">
									<label class="control-label" for="textarea">Estado</label>
									<div class="search-category-container">
										<label class="styled-select state">
											<select class="dropdown-product selectpicker">
												<option value="estado">Selecione o Estado</option> 
												<option value="ac">Acre</option> 
												<option value="al">Alagoas</option> 
												<option value="am">Amazonas</option> 
												<option value="ap">Amapá</option> 
												<option value="ba">Bahia</option> 
												<option value="ce">Ceará</option> 
												<option value="df">Distrito Federal</option> 
												<option value="es">Espírito Santo</option> 
												<option value="go">Goiás</option> 
												<option value="ma">Maranhão</option> 
												<option value="mt">Mato Grosso</option> 
												<option value="ms">Mato Grosso do Sul</option> 
												<option value="mg">Minas Gerais</option> 
												<option value="pa">Pará</option> 
												<option value="pb">Paraíba</option> 
												<option value="pr">Paraná</option> 
												<option value="pe">Pernambuco</option> 
												<option value="pi">Piauí</option> 
												<option value="rj">Rio de Janeiro</option> 
												<option value="rn">Rio Grande do Norte</option> 
												<option value="ro">Rondônia</option> 
												<option value="rs">Rio Grande do Sul</option> 
												<option value="rr">Roraima</option> 
												<option value="sc">Santa Catarina</option> 
												<option value="se">Sergipe</option> 
												<option value="sp">São Paulo</option> 
												<option value="to">Tocantins</option> 
											</select>
										</label>
									</div>
								</div>
							</div>
							<div class="pull-left" id="crea-estado">
								<div class="form-group">
									<label class="control-label" for="textarea">Número do CREA</label>
									<input type="text" class="form-control" placeholder="Ex: 123456">
								</div>
							</div>
							<div class="clear"> </div>
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Instituição de ensino</label>
							<input type="text" class="form-control" placeholder="Ex: UniRitter">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label class="control-label" for="textarea">Inicio</label>
									<input type="text" class="form-control" placeholder="Ex: 2014">
								</div>
								<div class="col-md-6">
									<label class="control-label" for="textarea">Término</label>
									<input type="text" class="form-control" placeholder="Ex: 2018">
								</div>
							</div>
						</div>
						<div class="add-post-btn">
							<div class="pull-left">
								<a href="#" class="btn-added"><i class="ti-plus"></i> Adicionar</a>
							</div>
							<div class="pull-right">
								<a href="#" class="btn-delete"><i class="ti-trash"></i> Deletar este</a>
							</div>
						</div>
						<div class="divider"><h3>Experiências profissionais</h3></div>
						
						<div id="experiences">
						
							@if(session('number_of_experiences'))
								@php
									$number_of_experiences = session('number_of_experiences');
								@endphp
							@else
								@php
								    $number_of_experiences = 1;
								@endphp
							@endif
							<input type="hidden" name="number_of_experiences" value="{{$number_of_experiences}}">
							@for($i = 1; $i <= $number_of_experiences; $i++)

								<div class="experience" data-experience="{{$i}}">
									<div class="form-group @if ($errors->has('ex_company_name_'.$i)) has-error @endif">
										<label class="control-label" for="textarea">Nome da empresa</label>
										<input type="text" class="form-control" name="ex_company_name_{{$i}}" placeholder="Nome da empresa" value="{{old('ex_company_name_'.$i)}}">
										@if ($errors->has('ex_company_name_'.$i)) 
											<p class="alert-danger">{{ $errors->first('ex_company_name_'.$i) }}</p> 
										@endif										
									</div>
									<div class="form-group @if ($errors->has('ex_responsibility_name_'.$i)) has-error @endif">
										<label class="control-label" for="textarea">Cargo</label>
										<input type="text" class="form-control" name="ex_responsibility_name_{{$i}}" placeholder="Cargo" value="{{old('ex_responsibility_name_'.$i)}}">
										@if ($errors->has('ex_responsibility_name_'.$i)) 
											<p class="alert-danger">{{ $errors->first('ex_responsibility_name_'.$i) }}</p> 
										@endif
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6 @if ($errors->has('ex_start_date_'.$i)) has-error @endif">
												<label class="control-label" for="textarea">Data de início</label>
												<input type="text" class="form-control" name="ex_start_date_{{$i}}" placeholder="Ex: 2014" value="{{old('ex_start_date_'.$i)}}">
												@if ($errors->has('ex_start_date_'.$i)) 
													<p class="alert-danger">{{ $errors->first('ex_start_date_'.$i) }}</p> 
												@endif
											</div>
											<div class="col-md-6 @if ($errors->has('ex_end_date_'.$i)) has-error @endif">
												<label class="control-label" for="textarea">Data de término</label>
												<input type="text" class="form-control" name="ex_end_date_{{$i}}" placeholder="Ex: 2018" value="{{old('ex_end_date_'.$i)}}">
												@if ($errors->has('ex_end_date_'.$i)) 
													<p class="alert-danger">{{ $errors->first('ex_end_date_'.$i) }}</p> 
												@endif
											</div>
										</div>
									</div>
									<div class="form-group has-error">
										<label class="control-label" for="textarea">Descrição</label>
									</div>
									<section class="editor has-error">
										<textarea class="edit" name="ex_description_{{$i}}">
											@php 
												echo htmlspecialchars(old('ex_description_'.$i));
											@endphp
										</textarea>
									</section>
									<div class="add-post-btn">
										<div class="pull-left">
											@if($number_of_experiences == $i)
												<a href="#" id="add-experience" class="btn-added"><i class="ti-plus"></i> Adicionar</a>
											@endif
										</div>
										<div class="pull-right">
											<a href="#" id="delete-experience" class="btn-delete"><i class="ti-trash"></i> Deletar este</a>
										</div>
									</div>
								</div>
							@endfor
						</div>
						<div class="button-save-form">
							<div class="pull-right">
								<button id="save" class="btn my-btn-default" type="submit">Salvar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('scripts_js')
	<script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{url('assets/site/js/summernote.min.js')}}"></script>
	<script type="text/javascript" src="{{url('assets/site/js/summernote-pt-BR.min.js')}}"></script>
	<script type="text/javascript" src="{{url('assets/site/js/bootstrap-select.min.js')}}"></script>
	<script type="text/javascript" src="{{url('assets/site/js/perfil-complement.js')}}"></script>
	<script>
		
	    	$('.edit').summernote({
	    		height: 150,
	    		lang: 'pt-BR',
	    		toolbar: [
				    // [groupName, [list of button]]
				    ['style', ['bold', 'italic', 'underline', 'clear']],
				    ['font', ['strikethrough', 'superscript', 'subscript']],
				    ['fontsize', ['fontsize']],
				    ['color', ['color']],
				    ['para', ['ul', 'ol', 'paragraph']],
				    ['height', ['height']]
				  ]
	    	});

	</script>
@endpush