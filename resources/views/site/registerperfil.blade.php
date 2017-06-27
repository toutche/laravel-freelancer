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
				<div class="page-ads box">
					<form class="form-ad">
						<div class="divider"><h3>Informações Básicas</h3></div>
						<div class="form-group">
							<label class="control-label" for="textarea">Nome</label>
							<input type="text" class="form-control" placeholder="Nome">
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea"></label>
							<label class="control-label" for="textarea">E-mail</label>
							<input type="text" class="form-control" placeholder="seu@dominio.com.br">
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Título profissional</label>
							<input type="text" class="form-control" placeholder="Ex: Engenheiro...">
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Telefone</label>
							<input type="text" class="form-control" placeholder="(51) xxxxxxxxx">
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Site</label>
							<input type="text" class="form-control" placeholder="www.exemplo.com.br">
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Data de Nascimento</label>
							<input type="text" class="form-control" placeholder="dd/mm/aaaa">
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Sobre mim</label>
						</div>
						<section class="editor">
							<div class="edit">
								
							</div>
						</section>
						<div class="form-group">
							<div class="button-group">
								<div class="action-buttons">
									<div class="upload-button">
										<!--button class="btn btn-common">Choose a cover image</button-->
										<input type="file" name="file" id="file" class="inputfile" />
										<label for="file">Escolha imagem de perfil</label>
									</div>
								</div>
							</div>
						</div>
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
						<div class="form-group">
							<label class="control-label" for="textarea">Nome da empresa</label>
							<input type="text" class="form-control" placeholder="Nome da empresa">
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Cargo</label>
							<input type="text" class="form-control" placeholder="Cargo">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label class="control-label" for="textarea">Data de início</label>
									<input type="text" class="form-control" placeholder="e.g 2014">
								</div>
								<div class="col-md-6">
									<label class="control-label" for="textarea">Data de término</label>
									<input type="text" class="form-control" placeholder="e.g 2018">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="textarea">Descrição</label>
						</div>
						<section class="editor">
							<div class='edit'>
								
							</div>
						</section>
						<div class="add-post-btn">
							<div class="pull-left">
								<a href="#" class="btn-added"><i class="ti-plus"></i> Adicionar</a>
							</div>
							<div class="pull-right">
								<a href="#" class="btn-delete"><i class="ti-trash"></i> Deletar este</a>
							</div>
						</div>
						<div class="button-save-form">
							<div class="pull-right">
								<button class="btn my-btn-default">Salvar</button>
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