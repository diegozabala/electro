@include ('admin.template.partials.nav')

	<section class="section-login">

			<div class="panel-heading">
			<h3 class="panel-tittle"> Lista de Equipos</h3>
				
		</div>

		<div class="panel-registro-table">
        <div class="form-group col-md-3">
		<a href="{{route('admin.equipos.create')}}" class="btn btn-success">Registrar un nuevo Equipo</a>
        </div>

			<table class="table table-responsive table-striped">
			<thead>
      			<tr>
        			<th class="active">Nombre</th>
        			<th class="active">Placa</th>
        			<th class="active">Descripcion</th>
        			<th class="active">ACTION</th>
      			</tr>
    		</thead>

    		<tbody>
    			@foreach($equipos as $equipo)
    				<tr>
    					<td>{{$equipo->nombre}}</td>
    					<td>{{$equipo->placa}}</td>
    					<td>{{$equipo->descripcion}}</td>
    					<td>
    						<a href="{{ route('admin.equipos.destroy',$equipo->id) }}" class="btn btn-danger"
                            onclick="return confirm('¿Seguro desea eliminarlo?')">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>

							<a href="{{route('admin.equipos.show',$equipo->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							<a href="{{route('admin.equipos.edit',$equipo->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
    					</td>				
    				</tr>
    			@endforeach
    		</tbody>
		</table>
			{{ $equipos->fragment('foo')->links() }}
		</div>
	</section>
@include ('admin.template.partials.footer')