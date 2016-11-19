

@include ('admin.template.partials.nav')

	<section class="section-login">

		<div class="panel-heading">
			<h3 class="panel-tittle">Registrar Componente</h3>
		</div>

			<div class="panel-registro">
				<form class="form-horizontal" role="form" method="POST"
                      action="{{ route('admin.componentes.store') }}">
                    {!! csrf_field() !!}

  				<div class="form-group">
    				<label for="nombre">Nombre</label>
    				<input type="text" class="form-control" name="nombre" placeholder="Introduce el Nombre" required>
  				</div>
  				<div class="form-group">
  				    <label for="cantidad">Cantidad</label>
    				<input type="text" class="form-control" name="cantidad" placeholder="Introducir la Cantidad" required>
  				</div>
  				<div class="form-group">
  				    <label for="referencia">Referencia</label>
    				<input type="text" class="form-control" name="referencia" placeholder="Introducir el nombre de la referencia" required>
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



