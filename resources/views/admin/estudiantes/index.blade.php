@include ('admin.template.partials.nav')

	<section class="section-login">

			<div class="panel-heading">
			<h3 class="panel-tittle"> Lista de Estudiantes</h3>
				
		</div>
		<div class="panel-registro-table">
		<a href="{{route('admin.estudiantes.create')}}" class="btn btn-success">Registrar un Estudiante</a>
        
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
                            @foreach($carreras as $carrera)
                                @if($estudiante->carrera_id == $carrera->id)
                                    <td>{{$carrera->nombre}}</td>
                                @endif
                            @endforeach
						@if(Auth::user()->rol=='admin')
    					<td>
    						<a href="{{ route('admin.estudiantes.destroy',$estudiante->id) }}" class="btn btn-danger"
                            onclick="return confirm('¿Seguro desea eliminarlo?')">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>

							<a href="{{route('admin.estudiantes.show',$estudiante->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							<a href="{{route('admin.estudiantes.edit',$estudiante->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>

    					</td>
							@endif
    				</tr>
    			@endforeach

    		</tbody>

		</table>

		</div>
	</section>
@include ('admin.template.partials.footer')