@include ('admin.template.partials.nav')

	<section class="section-login">

			<div class="panel-heading">
			<h3 class="panel-tittle"> Lista de Profesores</h3>
				
		</div>
		<div class="panel-registro-table">
		<a href="{{route('admin.profesores.create')}}" class="btn btn-success">Registrar un Docente</a>

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
        			<th class="active">Cedula</th>
					<th class="active">Número Celular</th>
                    <th class="active">Facultad</th>
					@if(Auth::user()->rol=='admin')
        				<th class="active">ACTION</th>
					@endif
      			</tr>
    		</thead>

    		<tbody>
    			@foreach($profesores as $profesor)
    				<tr>
    					<td>{{$profesor->nombre_profesor}}</td>
    					<td>{{$profesor->apellido_profesor}}</td>
    					<td>{{$profesor->cedula}}</td>
                        <td>{{$profesor->numero}}</td>
                        <td>{{$profesor->nombre}}</td>
						@if(Auth::user()->rol=='admin')
    					<td>
    						<a href="{{ route('admin.profesores.destroy',$profesor->id) }}" class="btn btn-danger"
                            onclick="return confirm('¿Seguro desea eliminarlo?')">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>

							<a href="{{route('admin.profesores.show',$profesor->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							<a href="{{route('admin.profesores.edit',$profesor->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>

    					</td>
							@endif
    				</tr>
    			@endforeach

    		</tbody>

		</table>

		</div>
	</section>
@include ('admin.template.partials.footer')