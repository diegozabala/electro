

@include ('admin.template.partials.nav')

	<section class="section-login">

		<div class="panel-heading">
			<h3 class="panel-tittle">Registrar Estudiantes</h3>
		</div>

			<div class="panel-registro">
				<form class="form-horizontal" role="form" method="POST"
                      action="{{ route('admin.estudiantes.store') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}

  				<div class="form-group">
    				<label for="nombre">Nombre</label>
    				<input type="text" class="form-control" name="nombre_estudiante" placeholder="Introduce el Nombre" required>
  				</div>
  				<div class="form-group">
  				    <label for="apellido">Apellido</label>
    				<input type="text" class="form-control" name="apellido_estudiante" placeholder="Introduce el Apellido"required>
  				</div>
  				<div class="form-group">
  				    <label for="numero_documento">Cédula</label>
    				<input type="text" class="form-control" name="numero_documento" placeholder="Introduce el Número de Documento" required>
  				</div>

				<div class="form-group">
					<label for="carrera">Seleccione el Programa</label>
					<select class="form-control" name="carrera">

						@foreach($carreras as $carrera)
							<option value="{{$carrera->nombre}}">{{$carrera->nombre}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="Imagen">Imágen</label>
					<input type="file" class="form-control" name="imagen" placeholder="Inserte imágen" required>
				</div>


  				<div class="form-group">
					<button type="submit" class="btn btn-primary  has-spinner" class="btn btn-success">Insertar</button>
					<a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
				</div>

				</form>
			</div>
	</section>
@include ('admin.template.partials.footer')