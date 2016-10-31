@include ('admin.template.partials.nav')

	<section class="section-login">

			<div class="panel-heading">
			<h3 class="panel-tittle"> Lista de Estudiantes</h3>
				
		</div>
		<div class="panel-registro-table">
		<a href="{{route('admin.estudiantes.create')}}" class="btn btn-success">Registrar un Docente</a>

			<!--<form  role="form" method="get" class="navbar-form pull-right"
			action="{{route('admin.profesores.find')}}">

                <div class="input-group">
                    <span class="input-group-addon  glyphicon glyphicon-search" id="basic-addon1"></span>
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar" aria-describedby="basic-addon1">
                </div>
                <button type="submit" class="hidden"></button>

			</form>
			-->
		<table class="table table-responsive table-striped">
			<thead>
      			<tr>
        			<th class="active">Nombre</th>
        			<th class="active">Apellido</th>
        			<th class="active">Número de Documento</th>
                    <th class="active">Programa</th>
					@if(Auth::user()->rol=='admin')
        				<th class="active">ACTION</th>
					@endif
      			</tr>
    		</thead>

    		<tbody>
    			@foreach($estudiantes as $estudiante)
    				<tr>
    					<td>{{$estudiante->nombre_estudiante}}</td>
    					<td>{{$estudiante->apellido_estudiante}}</td>
    					<td>{{$estudiante->numero_documento}}</td>
                        <td>{{$estudiante->nombre}}</td>
						@if(Auth::user()->rol=='admin')
    					<td>
    						<a href="{{ route('admin.estudiantes.destroy',$estudiante->id) }}" class="btn btn-danger"
                            onclick="return confirm('¿Seguro desea eliminarlo?')">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>

							<a href="{{route('admin.estudiantes.show',$profesor->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							<a href="{{route('admin.estudiantes.edit',$profesor->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>

    					</td>
							@endif
    				</tr>
    			@endforeach

    		</tbody>

		</table>

		</div>
	</section>
@include ('admin.template.partials.footer')