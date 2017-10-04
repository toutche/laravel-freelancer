<!-- Page Header -->
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="breadcrumb-wrapper">
						<h2 class="product-title">{{$breadcrumb_title}}</h2>
						<ol class="breadcrumb">
							<li><a href="{{url('/')}}"><i class="ti-home"></i> Home</a></li>
							{{$slot}}
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>