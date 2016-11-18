

@include ('admin.template.partials.nav')

	<section class="section-login">

		<div class="panel-heading">
			<h3 class="panel-tittle">Registrar Instrumento</h3>
		</div>

			<div class="panel-registro">
				<form class="form-horizontal" role="form" method="POST"
                      action="{{ route('admin.instrumentos.store') }}">
                    {!! csrf_field() !!}

  				<div class="form-group">
    				<label for="nombre">Nombre</label>
    				<input type="text" class="form-control" name="nombre" placeholder="Introduce el Nombre" required>
  				</div>
  				<div class="form-group">
  				    <label for="cantidad">Cantidad</label>
    				<input type="text" class="form-control" name="cantidad" placeholder="Introduce la Cantidad" required>
  				</div>
				<div class="form-group">
					<select name="tipo" class="form-control">
						<option value="pc">Analógico</option>
						<option value="apuntador">Digital</option>						
					</select>
				</div>
  				<div class="form-group">
  				    <label for="descripcion">Descripción</label>
    				<textarea class="form-control" rows="5" name="descripcion" required></textarea>
  				</div>
  				<div class="form-group">
					<button type="submit" class="btn btn-primary  has-spinner" class="btn btn-success">Insertar</button>
					<a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
				</div>

				</form>
			</div>


	</section>



