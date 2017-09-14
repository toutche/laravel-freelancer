<div class="divider"><h3>Experiências profissionais</h3></div>
<div id="experiences">
	
	@php
		$number_of_experiences = 0;
	@endphp
	
	@if(!session()->has('errors_experiences'))
		@php
			session()->forget('number_of_experiences');
		@endphp
	@endif
	
	@if(!session()->has('number_of_experiences'))
		@php
			$number_of_experiences = 1;
			session()->put('number_of_experiences', $number_of_experiences);
		@endphp
	@else
		@php
			$number_of_experiences = session()->get('number_of_experiences');
		@endphp
	@endif

	@for($i = 1; $i <= $number_of_experiences; $i++)

		<div class="experience" data-experience="{{$i}}">
			<div class="form-group @if ($errors->has('ex_company_name_.'.$i)) has-error @endif">
				<label class="control-label" for="textarea">Nome da empresa</label>
				<input type="text" class="form-control ex_company_name" name="ex_company_name_[{{$i}}]" placeholder="Nome da empresa" value="{{old('ex_company_name_.'.$i)}}">
				@if ($errors->has('ex_company_name_.'.$i)) 
					<p class="alert-danger">{{ $errors->first('ex_company_name_.'.$i) }}</p> 
				@endif										
			</div>
			<div class="form-group @if ($errors->has('ex_responsibility_name_.'.$i)) has-error @endif">
				<label class="control-label" for="textarea">Cargo</label>
				<input type="text" class="form-control ex_responsibility_name" name="ex_responsibility_name_[{{$i}}]" placeholder="Cargo" value="{{old('ex_responsibility_name_.'.$i)}}">
				@if ($errors->has('ex_responsibility_name_.'.$i)) 
					<p class="alert-danger">{{ $errors->first('ex_responsibility_name_.'.$i) }}</p> 
				@endif
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6 @if ($errors->has('ex_start_date_.'.$i)) has-error @endif">
						<label class="control-label" for="textarea">Data de início</label>
						<input type="text" class="form-control ex_start_date" name="ex_start_date_[{{$i}}]" placeholder="Ex: 2014" value="{{old('ex_start_date_.'.$i)}}">
						@if ($errors->has('ex_start_date_.'.$i))
							<p class="alert-danger">{{ $errors->first('ex_start_date_.'.$i) }}</p> 
						@endif
					</div>
					<div class="col-md-6 @if ($errors->has('ex_end_date_.'.$i)) has-error @endif">
						<label class="control-label" for="textarea">Data de término</label>
						<input type="text" class="form-control ex_end_date" name="ex_end_date_[{{$i}}]" placeholder="Ex: 2018" value="{{old('ex_end_date_.'.$i)}}">
						@if ($errors->has('ex_end_date_.'.$i)) 
							<p class="alert-danger">{{ $errors->first('ex_end_date_.'.$i) }}</p> 
						@endif
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label" for="textarea">Descrição</label>
			</div>
			<section class="editor">
				<textarea class="edit" name="ex_description_[{{$i}}]">
					@php 
						echo htmlspecialchars(old('ex_description_.'.$i));
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
					@if($i != 1)
						<a href="#" id="delete-experience" class="btn-delete"><i class="ti-trash"></i> Deletar este</a>
					@endif
				</div>
			</div>
		</div>
	@endfor
</div>