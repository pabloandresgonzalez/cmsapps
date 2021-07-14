<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') - CMSApps</title>
	<meta name="csrf-token" content="{{ 'csrf_token' }}">
	<meta name="routerName" content="{{ Route::currentRouteName() }}">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link rel="stylesheet" href="{{ url('/static/css/admin.css?v=' .time()) }}">
	<link rel = "preconnect" href = "https://fonts.googleapis.com">
	<link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
	<link href = "https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel ="stylesheet">

	<script src="https://kit.fontawesome.com/c32444200d.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

	<!--
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

	<script>
      tinymce.init({
        selector: '#editor'
      });
    </script>
    -->


	<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>


	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip();
		});
	</script>

	<script type="text/javascript">

        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  	</script>


</head>
<body>

	<div class="wrapper">
		<div class="col1">@include('admin.sidebar')</div>
		<div class="col2">
			<nav class="navbar navbar-expand-lg shadow">
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="{{ url('/admin') }}" class="nav-link">
								<i class="fas fa-home"></i> Dashboard
							</a>
						</li>
					</ul>
				</div>
			</nav>

			<div class="page">

				<div class="container-fluid">
					<nav aria-label="breadcrumb shadow">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{ url('/admin') }}"><i class="fas fa-home"></i> Dashboard</a>
							</li>
							@section('breadcrumb')
							@show
						</ol>
					</nav>
				</div>

				@if(Session::has('message'))
				<div class="container">
					<div class="mtop16 alert alert alert-{{ Session::get('typealert') }}" style="display:none;">
						{{ Session::get('message') }}
						@if ($errors->any())
						<ul>
							@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
						@endif
						<script>
							$('.alert').slideDown();
							setTimeout(function(){ $('.alert').slideUp(); }, 10000);
						</script>
						</div>
					</div>
				@endif

				@section('content')
				@show

			</div>
		</div>
	</div>

</body>
</html>