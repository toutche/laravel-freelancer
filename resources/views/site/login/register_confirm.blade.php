@extends('site.template1') @section('content')
<!-- Page Header -->

@component('site.page_header')
	@slot('breadcrumb_title')
		Registro
	@endslot
	<li class="current">Registrado</li>
@endcomponent

<div class="container">
	<div class="row">
		<div class="message-box box-success full-message-box margin-top-40">
			<div class="thumb">
				<img alt="" src="{{URL::asset('assets/site/images/happy.png')}}">
			</div>
			<div class="box-content">
				<h4>Registro efetuado com sucesso</h4>
				<p>
					Seu cadastro foi efetuado com sucesso, basta apenas acessar seu
					e-mail <strong>({{$email}})</strong> clicando no botão abaixo para
					confirma-lo.
				</p>
				<div class="divider divider-success">
					<div class="pull-right">
						@php $email = explode("@", $email)[1]; @endphp <a
							class="btn my-btn" href="http://www.{{$email}}" target="_blank">
							<span class="left title">Acessar e-mail</span> <i
							class="right icon ti ti-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
