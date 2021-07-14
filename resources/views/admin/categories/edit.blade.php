@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/categories/edit') }}"><i class="fas fa-folder-plus"></i> Categorias</a>
</li>
<li class="breadcrumb-item">
	<a href="#"><i class="fas fa-edit"></i> Editar categorias</a>
</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fas fa-edit"></i> Editar categoria</h2>
					</div>

					<div class="inside">
						{!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit']) !!}

							<label for="name">Nombre:</label>
							<div class="input-group mb-3">
							  <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
							  {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
							</div>

							<label for="module">Módulo:</label>
							<div class="input-group mb-3">
							  <span class="input-group-text" id="basic-addon1"><i class="fas fa-puzzle-piece"></i></span>
							  {!! Form::select('module', getModulesArray(), $cat->module, ['class' => 'form-select']) !!}
							</div>

							<label for="icon">Ícono:</label>
							<div class="input-group mb-3">
							  <span class="input-group-text" id="basic-addon1"><i class="fas fa-icons"></i></span>
							  {!! Form::text('icon', $cat->icono, ['class' => 'form-control']) !!}
							</div>

						{!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
						{!! Form::close() !!}
						</div>
					</div>
				</div>


				</div>
			</div>
		</div>
	</div>
@endsection