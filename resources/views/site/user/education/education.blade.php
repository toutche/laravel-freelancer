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
			<div class="form-group">
				<label class="control-label" for="select_degree">Grau</label>
				<div>
					<label class="styled-select degree">
						<select id="ed_select_degree" name="ed_select_degree_[{{$i}}]" class="dropdown-product selectpicker">
							<option value="">Selecione uma opção</option>
							<option value="graduating">Graduando</option>
							<option value="graduate">Graduado</option>
						</select>
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label" for="textarea">Curso</label>
				<input type="text" class="form-control" name="ed_course_[{{$i}}]" placeholder="Curso">
			</div>
			<div class="form-group" id="semestre">
				<label class="control-label" for="textarea">Semestre</label>
				<input type="text" class="form-control" name="ed_semester_[{{$i}}]" placeholder="Ex: 6°">
			</div>
			<div class="add-post-btn" id="crea">
				<div class="pull-left" id="crea-numero">
					<div class="form-group">
						<label class="control-label" for="textarea">Estado</label>
						<div class="search-category-container">
							<label class="styled-select state">
								<select class="dropdown-product selectpicker" name="ed_crea_state_[{{$i}}]">
									<option value="state">Selecione o Estado</option> 
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
						<input type="text" class="form-control" name="ed_crea_number_[{{$i}}]" placeholder="Ex: 123456">
					</div>
				</div>
				<div class="clear"> </div>
			</div>
			<div class="form-group">
				<label class="control-label" for="textarea">Instituição de ensino</label>
				<input type="text" class="form-control" name="ed_college_[{{$i}}]" placeholder="Ex: UniRitter">
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label class="control-label" for="textarea">Inicio</label>
						<input type="text" class="form-control" name="ed_start_date_[{{$i}}]" placeholder="Ex: 2014">
					</div>
					<div class="col-md-6">
						<label class="control-label" for="textarea">Término</label>
						<input type="text" class="form-control" name="ed_end_date_[{{$i}}]" placeholder="Ex: 2018">
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
