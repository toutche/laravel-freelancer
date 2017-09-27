@extends('site.template1')

@section('content')
	<!-- Page Header -->
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="breadcrumb-wrapper">
						<h2 class="product-title">500</h2>
						<ol class="breadcrumb">
							<li><a href="#"><i class="ti-home"></i> Home</a></li>
							<li class="current">500</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="text-center margin-top-40">
				<img src="{{ URL::to('/assets/site/images/500.jpg') }}" alt="Erro 500">
				
			</div>
		</div>
	</div>
@endsection