

@include ('admin.template.partials.nav')

	<section class="section-login">

		<div class="panel-heading">
			<h3 class="panel-tittle">Registrar Equipo</h3>
		</div>

			<div class="panel-registro">
				<form class="form-horizontal" role="form" method="POST"
                      action="{{ route('admin.equipos.store') }}">
                    {!! csrf_field() !!}

  				<div class="form-group">
    				<label for="nombre">Nombre</label>
    				<input type="text" class="form-control" name="nombre" placeholder="Introduce el Nombre" required>
  				</div>
  				<div class="form-group">
  				    <label for="apellido">Placa</label>
    				<input type="text" class="form-control" name="placa" placeholder="Introduce la Placa" required>
  				</div>
					<div class="form-group">
						<select name="tipo" class="form-control">
							<option value="pc">PC</option>
							<option value="vb">VideoBeam</option>
							<option value="apuntador">Apuntador</option>
						</select>
					</div>
  				<div class="form-group">
  				    <label for="cedula">Descripcion</label>
    				<textarea class="form-control" rows="5" name="descripcion" required></textarea>
  				</div>
  				<div class="form-group">
					<button type="submit" class="btn btn-primary  has-spinner" class="btn btn-success">Insertar</button>
					<a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
				</div>

				</form>
			</div>


	</section>



