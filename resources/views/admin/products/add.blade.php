@extends('admin.master')

@section('title', 'Agregar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products') }}"><i class="fas fa-mobile-alt"></i></i> Productos</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/product/add') }}"><i class="fas fa-plus"></i> Agregar producto</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fas fa-plus"></i> Agregar producto</h2>
		</div>

		<div class="inside">
			{!! Form::open(['url'=> '/admin/product/add', 'files' => 'true']) !!}
			<div class="row">
				<div class="col-md-6">
					<label for="name">Nombre del producto:</label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
					  {!! Form::text('name', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="col-md-3">
					<label for="category">Categoría:</label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1"><i class="fas fa-puzzle-piece"></i></span>
					  {!! Form::select('category', $cats, 0, ['class' => 'form-select']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="formFile">Imagen destacada:</label>
					{!! Form::file('img', ['class' => 'form-control', 'id' => 'img'] ) !!}
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label for="price">Precio:</label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
					  {!! Form::number('price', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="indiscount">¿En descuento?:</label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1"><i class="fas fa-hand-holding-usd"></i></span>
					  {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], 0, ['class' => 'form-select']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="discount">Descuento:</label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1"><i class="fas fa-percent"></i></span>
					  {!! Form::number('discount', 0.00, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
					</div>
				</div>

			<div class="row">
				<div class="col-md-12">
					<label for="content">Descripción:</label>
					{!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'editor']) !!}
				</div>
			</div>

			<div class="row mtop16">
				<div class="col-md-12">
					{!! Form::submit('guardar', ['class' => 'btn btn-success']) !!}
				</div>
			</div>



			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection






