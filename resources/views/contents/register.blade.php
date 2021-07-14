@extends('contents.master')

@section('title', 'Login')

@section('content')

		<div class="box box_login shadow  rounded">
			<div class="header shadow-none  rounded">
				<a href="{{ url('login') }}">
					<img src="{{ url('/static/images/logo.png') }}">
				</a>
			</div>
		<div class="inside">
		{!! Form::open(['url' => '/register']) !!}

		<label for="name" class="mtop16">Nombre:</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text" ><div><i class="far fa-user"></i></i></div></a></span>
			</div>
		{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
		</div>

		<label for="lastname" class="mtop16">Apellido:</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text" ><div><i class="fas fa-user"></i></div></a></span>
			</div>
		{!! Form::text('lastname', null, ['class' => 'form-control', 'required']) !!}
		</div>


		<label for="email" class="mtop16">Correo Electrónico:</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text" ><div><i class="fas fa-envelope-open"></i></div></a></span>
			</div>
		{!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
		</div>

		<label for="password" class="mtop16">Contraseña:</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1"><div><i class="fas fa-unlock-alt"></i></div></a></span>
			</div>
				{!! Form::password('password', ['class' => 'form-control', 'required']) !!}
		</div>

		<label for="cpassword" class="mtop16">Confirmar contraseña:</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1"><div><i class="fas fa-lock"></i></div></a></span>
			</div>
				{!! Form::password('cpassword', ['class' => 'form-control', 'required']) !!}
		</div>

		{!! Form::submit('Registrarse', ['class' => 'btn btn-success mtop16']) !!}
		{!! Form::close() !!}

		@if(Session::has('message'))
		<div class="container">
			<div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
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

		<div class="footer mtop16">
			<a href="{{ url('postregister') }}">¿No tienes una cuenta?, Registrate</a>
			<a href="{{ url('recover') }}">Recuperar contraseña</a>
		</div>
		</div>


	</div>
@stop