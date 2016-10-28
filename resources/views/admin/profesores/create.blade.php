

@include ('admin.template.partials.nav')

	<section class="section-login">

		<div class="panel-heading">
			<h3 class="panel-tittle">Registrar Docentes</h3>
		</div>

			<div class="panel-registro">
				<form class="form-horizontal" role="form" method="POST"
                      action="{{ route('admin.profesores.store') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}

  				<div class="form-group">
    				<label for="nombre">Nombre</label>
    				<input type="text" class="form-control" name="nombre" placeholder="Introduce el Nombre" required>
  				</div>
  				<div class="form-group">
  				    <label for="apellido">Apellido</label>
    				<input type="text" class="form-control" name="apellido" placeholder="Introduce el Apellido"required>
  				</div>
  				<div class="form-group">
  				    <label for="cedula">Cédula</label>
    				<input type="text" class="form-control" name="cedula" placeholder="Introduce la Cédula" required>
  				</div>
                    <div class="form-group">
                        <label for="numero">Número Celular</label>
                        <input type="text" class="form-control" name="numero" placeholder="Introduce el número de celular"
                        required>
                    </div>
					<div class="form-group">
						<label for="sel1">Seleccione el Programa</label>
						<select class="form-control" name="programa">

							@foreach($programas as $programa)
								<option value="{{$programa->nombre}}">{{$programa->nombre}}</option>

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