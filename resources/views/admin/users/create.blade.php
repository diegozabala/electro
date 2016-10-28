
@include ('admin.template.partials.nav')


	<section class="section-login">

		<div class="panel-heading">
			<h3 class="panel-tittle">Insertar Usuarios</h3>
		</div>

			<div class="panel-registro">
				<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                      action="{{ route('admin.users.store') }}" >
                    {!! csrf_field() !!}

						<div class="form-group" >
							<label for="nombre">Correo electrónico</label>
							<input type="email" class="form-control" name="email" placeholder="Introduce tu correo" required>
						</div>


						<div class="form-group" >
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" name="name" placeholder="Introduce el Nombre" required>
						</div>


  				<div class="form-group">
  				    <label for="apellido">Apellido</label>
    				<input type="text" class="form-control" name="apellido" placeholder="Introduce el Apellido"required>
  				</div>
					<div class="form-group">
						<select name="rol" class="form-control">
							<option value="admin"> Admin</option>
							<option value="auxiliar">Auxiliar</option>
						</select>
					</div>

  				<div class="form-group">
  				    <label for="cedula">Cédula</label>
    				<input type="text" class="form-control" name="cedula" placeholder="Introduce la Cédula" required>
  				</div>
  				<div class="form-group">
    				<label for="contrasena">Contraseña</label>
    				<input type="password" class="form-control" name="password" placeholder="Introduce la Contraseña"required>
  				</div>
					<div class="form-group">
						<label for="Imagen">Imágen</label>
						<input type="file" class="form-control" name="imagen" placeholder="Introduce la imágen" required>
					</div>

  				<div class="form-group">
					<button type="submit" class="btn btn-primary  has-spinner" class="btn btn-success">Insertar</button>
					<a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
				</div>
			</form>
			</div>


	</section>
@include('admin.template.partials.footer')