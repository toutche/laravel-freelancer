<div class="divider"><h3>Educação</h3></div>
<div id="educations">
	@php
		$number_of_educations = 0;
	@endphp

	@if(!session()->has('errors_educations'))
		@php
			session()->forget('number_of_educations');
		@endphp
	@endif
	
	@if(!session()->has('number_of_educations'))
		@php
			$number_of_educations = 1;
			session()->put('number_of_educations', $number_of_educations);
		@endphp
	@else
		@php
			$number_of_educations = session()->get('number_of_educations');
		@endphp
	@endif

	@for($i = 1; $i <= $number_of_educations; $i++)

		<div class="education" data-education="{{$i}}">
			<div class="form-group @if ($errors->has('ed_select_degree_.'.$i)) has-error @endif">
				<label class="control-label" for="ed_select_degree_[{{$i}}]">Grau</label>
				<div id="ed_select_degree_[{{$i}}]">
					<label class="styled-select degree">
						<select id="ed_select_degree_[{{$i}}]" name="ed_select_degree_[{{$i}}]" data-id="{{$i}}" class="dropdown-product selectpicker ed_select_degree">
							<option value="">Selecione uma opção</option>
							<option value="graduating" 
							{{ (old('ed_select_degree_.'.$i) == "graduating" ? "selected" : " ")}}>Graduando</option>
							<option value="graduate" {{ (old('ed_select_degree_.'.$i) == "graduate" ? "selected" : " ")}}>Graduado</option>
						</select>
						@if ($errors->has('ed_select_degree_.'.$i)) 
							<p class="alert-danger">{{ $errors->first('ed_select_degree_.'.$i) }}</p> 
						@endif
					</label>
				</div>
			</div>
			<div class="form-group @if ($errors->has('ed_course_.'.$i)) has-error @endif">
				<label class="control-label" for="textarea">Curso</label>
				<input type="text" class="form-control ed_course" name="ed_course_[{{$i}}]" placeholder="Curso" value="{{old('ed_course_.'.$i)}}">
				@if ($errors->has('ed_course_.'.$i)) 
					<p class="alert-danger">{{ $errors->first('ed_course_.'.$i) }}</p> 
				@endif
			</div>
			<div class="form-group semester @if ($errors->has('ed_semester_.'.$i)) has-error @endif" id="semester_{{$i}}">
				<label class="control-label" for="textarea">Semestre</label>
				<input type="number" class="form-control ed_semester" name="ed_semester_[{{$i}}]" placeholder="Ex: 6" value="{{old('ed_semester_.'.$i)}}">
				@if ($errors->has('ed_semester_.'.$i)) 
					<p class="alert-danger">{{ $errors->first('ed_semester_.'.$i) }}</p> 
				@endif
			</div>
			<div class="add-post-btn crea" id="crea_{{$i}}">
				<div class="pull-left">
					<div class="form-group @if ($errors->has('ed_crea_state_.'.$i)) has-error @endif">
						<label class="control-label">Estado</label>
						<div class="search-category-container" id="ed_crea_state_[{{$i}}]">
							<label class="styled-select state">
								<select class="dropdown-product selectpicker ed_crea_state" data-id="{{$i}}" name="ed_crea_state_[{{$i}}]">
									<option value="">Selecione o Estado</option> 
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
								@if ($errors->has('ed_crea_state_.'.$i)) 
									<p class="alert-danger">{{ $errors->first('ed_crea_state_.'.$i) }}</p> 
								@endif
							</label>
						</div>
					</div>
				</div>
				<div class="pull-left" id="crea-number">
					<div class="form-group @if ($errors->has('ed_crea_number_.'.$i)) has-error @endif">
						<label class="control-label" for="textarea">Número do CREA</label>
						<input type="number" class="form-control ed_crea_number" name="ed_crea_number_[{{$i}}]" placeholder="Ex: 123456" value="{{old('ed_crea_number_.'.$i)}}">
						@if ($errors->has('ed_crea_number_.'.$i)) 
							<p class="alert-danger">{{ $errors->first('ed_crea_number_.'.$i) }}</p> 
						@endif
					</div>
				</div>
				<div class="clear"> </div>
			</div>
			<div class="form-group @if ($errors->has('ed_college_.'.$i)) has-error @endif">
				<label class="control-label" for="textarea">Instituição de ensino</label>
				<input type="text" class="form-control ed_college" name="ed_college_[{{$i}}]" placeholder="Ex: UniRitter" value="{{old('ed_college_.'.$i)}}">
				@if ($errors->has('ed_college_.'.$i)) 
					<p class="alert-danger">{{ $errors->first('ed_college_.'.$i) }}</p> 
				@endif
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6 @if ($errors->has('ed_start_date_.'.$i)) has-error @endif">
						<label class="control-label" for="textarea">Ano de Início</label>
						<input type="text" class="form-control ed_start_date" name="ed_start_date_[{{$i}}]" placeholder="Ex: 2014" value="{{old('ed_start_date_.'.$i)}}">
						@if ($errors->has('ed_start_date_.'.$i)) 
							<p class="alert-danger">{{ $errors->first('ed_start_date_.'.$i) }}</p> 
						@endif
					</div>
					<div class="col-md-6 @if ($errors->has('ed_end_date_.'.$i)) has-error @endif">
						<label class="control-label" for="textarea">Ano de término</label>
						<input type="number" class="form-control ed_end_date" name="ed_end_date_[{{$i}}]" placeholder="Ex: 2018" value="{{old('ed_end_date_.'.$i)}}">
						@if ($errors->has('ed_end_date_.'.$i)) 
							<p class="alert-danger">{{ $errors->first('ed_end_date_.'.$i) }}</p> 
						@endif
					</div>
				</div>
			</div>
			<div class="add-post-btn">
				<div class="pull-left">
					@if($number_of_educations == $i)
						<a href="#" id="add-education" class="btn-added"><i class="ti-plus"></i> Adicionar</a>
					@endif
				</div>
				<div class="pull-right">
					<a href="#" id="delete-education" class="btn-delete"><i class="ti-trash"></i> Deletar este</a>
				</div>
			</div>
		</div>
	@endfor
</div>
