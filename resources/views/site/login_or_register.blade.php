@extends('site.template1')

@section('content')
	@component('site.page_header')
		@slot('breadcrumb_title')
			Login
		@endslot
		<li class="current">Login</li>
	@endcomponent
	
	<!-- Forms Login and Register -->
	<section id="content" class="my-account">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-6 cd-user-modal">
					<div class="my-account-form">
						<ul class="cd-switcher">
							<li><a class="@if( !session('tabNameSelected') || session('tabNameSelected') == 'login' || session('tabNameSelected') == 'password-reset') selected @endif" href="#0">LOGIN</a></li>
							<li><a class="{{ ( (session('tabNameSelected')) && (session('tabNameSelected') == 'register')) ? 'selected' : ''}}" href="#0">REGISTRAR</a></li>
						</ul>
						 
						@include('site.login.login')
						 
						@include('site.login.register')

						@include('site.login.reset_password')
						  
					</div>
				</div>
			</div>
		</div>
	</section><!-- #content -->
@endsection
@push('scripts_js')
	<script type="text/javascript" src="{{url('js/validation/jquery.validate.min.js')}}"></script>
	<script type="text/javascript" src="{{url('assets/site/js/login-register.js')}}"></script>
@endpush
