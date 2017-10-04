@extends('site.template1') 
@section('content')
    <!-- Page Header -->
    @component('site.page_header')
    	@slot('breadcrumb_title')
    		Erro
    	@endslot
    	<li class="current">Erro</li>
    @endcomponent

    <div class="container">
    	<div class="row">
    		<div class="message-box box-success full-message-box margin-top-40">
    			<div class="thumb">
    				<img alt="Carinha Triste" src="{{URL::asset('assets/site/images/sad.png')}}">
    			</div>
    			<div class="box-content">
    				<h4>
    					@if(session('error_title')) 
    						{{session('error_title')}} 
    					@else
    						{{"Erro"}}
    					@endif
    				</h4>
    				<p>
    					@if(session('error_message')) 
    						{{session('error_message')}} 
    					@else
    						{{"Ops, algo de errado aconteceu!"}}
    					@endif
    				</p>
    				<div class="divider divider-success">
    					<div class="pull-right">
    						<a
    							class="btn my-btn" href="@if(session('error_link')) 
    														{{session('error_link')}} 
    													@else {{url('/')}}
    													@endif">
    							<span class="left title">@if(session('error_messageButton')) 
    														{{session('error_messageButton')}} 
    													@else {{"Acessar a Home"}}
    													@endif
    							</span> <i class="right icon ti ti-arrow-circle-right"></i>
    						</a>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
@endsection
