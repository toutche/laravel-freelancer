@extends('site.template1')

@push('scripts_css')
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
					<form class="form-ad" id="complement_register_company" method="POST" action="{{url('/perfil/complemento-empresa/envio')}}" enctype="multipart/form-data">
						{!!csrf_field()!!}
						
						<div class="divider"><h3>Informações Básicas</h3></div>
                    	<div class="form-group @if ($errors->has('social_name')) has-error @endif">
                    		<label class="control-label" for="social_name">Razão Social</label>
                    		<input type="text" class="form-control" name="name" placeholder="Razão Social">
                    		@if ($errors->has('social_name')) 
                    			<p class="alert-danger">{{ $errors->first('social_name') }}</p> 
                    		@endif	
                    	</div>
                    	<div class="form-group @if ($errors->has('cnpj')) has-error @endif">
                    		<label class="control-label" for="cnpj">CNPJ</label>
                    		<input type="text" class="form-control" name="cnpj" placeholder="CNPJ">
                    		@if ($errors->has('cnpj')) 
                    			<p class="alert-danger">{{ $errors->first('cnpj') }}</p> 
                    		@endif	
                    	</div>
                    	<div class="form-group">
                		<div class="button-group">
                			<div class="action-buttons">
                				<div class="upload-button">
                					<input type="file" name="logo_company" id="logo_company" class="inputfile" />
                					<label for="logo_company">Escolha o logo da empresa</label>
                					@if ($errors->has('logo_company')) 
                						<p class="alert-danger">{{ $errors->first('logo_company') }}</p> 
                					@endif
                				</div>
                			</div>
                		</div>
                		<div class="form-group">
            				<label>Sou empresa de engenharia?</label>
            				<div class="form-group" id="div-radio-is-company-engineer">
            					<ul>
            						<li>
            							<input type="radio" name="is_company_engineer" id="isCompanyEngineerYes" value="1">
            							<label for="isCompanyEngineerYes"> Sim</label>
            							<div class="check"></div>
            						</li>
            						<li>
            							<input type="radio" name="is_company_engineer" id="isCompanyEngineerNo" value="0" checked>
            							<label for="isCompanyEngineerNo"> Não</label>
            							<div class="check"><div class="inside"></div></div>
            						</li>
            					</ul>
            				</div>
            			</div>
            			<div id="div-responsible-engineer-informations">
                        	<div class="form-group @if ($errors->has('responsible_engineer')) has-error @endif">
                        		<label class="control-label" for="responsible_engineer">Engenheiro responsável</label>
                        		<input type="text" class="form-control" name="responsible_engineer" placeholder="Engenheiro responsável">
                        		@if ($errors->has('responsible_engineer')) 
                        			<p class="alert-danger">{{ $errors->first('responsible_engineer') }}</p> 
                        		@endif	
                        	</div>
                        	<div class="add-post-btn crea" id="">
                				<div class="pull-left">
                					<div class="form-group @if ($errors->has('crea_state')) has-error @endif">
                						<label class="control-label">Estado</label>
                						<div class="search-category-container" id="crea_state">
                							<label class="styled-select state">
                								<select class="dropdown-product selectpicker ed_crea_state" name="crea_state">
                									<option value="">Selecione o Estado</option> 
                									@foreach($brazilianStates as $key => $value)
                										<option value="{{$key}}" {{ (old('crea_state') == $key ? "selected" : " ")}}>{{$value}}</option>
                									@endforeach 
                								</select>
                								@if ($errors->has('crea_state')) 
                									<p class="alert-danger">{{ $errors->first('crea_state') }}</p> 
                								@endif
                							</label>
                						</div>
                					</div>
                				</div>
                				<div class="pull-left" id="crea-number">
                					<div class="form-group @if ($errors->has('crea_number')) has-error @endif">
                						<label class="control-label" for="textarea">Número do CREA</label>
                						<input type="number" class="form-control crea_number" name="crea_number" placeholder="Ex: 123456" value="{{old('crea_number')}}">
                						@if ($errors->has('crea_number')) 
                							<p class="alert-danger">{{ $errors->first('crea_number') }}</p> 
                						@endif
                					</div>
                				</div>
                				<div class="clear"> </div>
                			</div>
                        </div>
						<div class="button-save-form">
							<div class="pull-right">
								<button id="save" class="btn my-btn-default" type="submit">Salvar</button>
							</div>
						</div>
						<dir class="clearfix"></dir>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
	
@push('scripts_js')
	<script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{url('assets/site/js/bootstrap-select.min.js')}}"></script>
	<script type="text/javascript" src="{{url('assets/site/js/perfil-complement-company.js')}}"></script>
@endpush