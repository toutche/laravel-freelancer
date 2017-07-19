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

						@include('site.user.education.education')

						@include('site.user.professionals_experiences.professional_experiences')

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