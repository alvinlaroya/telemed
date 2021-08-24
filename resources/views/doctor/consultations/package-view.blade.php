<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Package Preview</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<style>
		.b-example-divider {
		    height: 10vh;
		    background-color: rgba(0, 0, 0, .1);
		    border: solid rgba(0, 0, 0, .15);
	        border-top-width: medium;
	        border-right-width: medium;
	        border-bottom-width: medium;
	        border-left-width: medium;
		    border-width: 1px 0;
		    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="px-4 py-5 my-5 text-center">
			<img class="d-block mx-auto mb-4" src="{{ asset('img/card-logo.png') }}" alt="" width="57" height="auto">
			<h1 class="display-5 fw-bold">{{ $package->name }}</h1>
			<div class="col-lg-6 mx-auto">
				<p class="lead mb-4">
					<div class="table-reponsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Inclusions</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								@foreach($package->services as $service)
									<tr>
										<td>
											{{ $service->name }}
										</td>
										@if(in_array($service->name, ['Covid Primary Package', 'Covid Secondary Package']))
											<td>
												&#8369;{{ number_format($service->price, 2) }}
											</td>
										@else
											<td>
												&#8369;0.00
											</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</p>
				<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
					<button type="button" class="btn btn-primary btn-lg px-4 mt-4" onclick="window.close()">
						<i class="bi bi-x-circle"></i> Close
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="b-example-divider"></div>
</body>
</html>