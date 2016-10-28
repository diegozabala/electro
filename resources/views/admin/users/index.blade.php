
@include ('admin.template.partials.nav')

	<section class="section-login">

		<div class="panel-heading">

			<h3 class="panel-tittle">Lista de Usuarios</h3>
		</div>
		<div class="panel-registro-table">


		<a href="{{route('admin.users.create')}}" class="btn btn-success">Registrar un nuevo auxiliar</a>

		<table class="table table-responsive table-striped">
    		<thead>
			<tr>

				<th class="active">Nombres</th>
				<th class="active">Cedula</th>
				<th class="active">Rol</th>
				<th class="active">ACTION</th>

      		</tr>
    		</thead>
    	<tbody>

    		@foreach($users as $estudiante)

    			<tr>

    				<td>{{$estudiante->name." ".$estudiante->apellido}}</td>
    				<td>{{$estudiante->cedula}}</td>
    				<td>{{$estudiante->rol}}</td>

					<td><a href="{{ route('admin.user.destroy',$estudiante->id) }}" class="btn btn-danger"
							   onclick="return confirm('¿Seguro desea eliminarlo?')">
				   		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				   </a>
                        <a href="{{route('admin.user.show',$estudiante->id)}}" class="btn btn-success">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
						</a>
						<a href="{{route('admin.users.edit',$estudiante->id)}}" class="btn btn-warning">
							<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
    			</tr>
    		@endforeach
         </tbody>
  </table>
			{{ $users->fragment('foo')->links() }}
		</div>
	</section>
@include ('admin.template.partials.footer')