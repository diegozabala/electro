@include ('admin.template.partials.nav')

	<section class="section-login">

			<div class="panel-heading">
			<h3 class="panel-tittle"> Lista de Componentes</h3>
				
		</div>

		<div class="panel-registro-table">
        <div class="form-group col-md-3">
		<a href="{{route('admin.componentes.create')}}" class="btn btn-success">Registrar un nuevo Componente</a>
        </div>

			<table class="table table-responsive table-striped">
			<thead>
      			<tr>
        			<th class="active">Nombre</th>
                    <th class="active">Referencia</th>
        			<th class="active">Cantidad</th>
        			<th class="active">Descripción</th>
        			<th class="active">ACTION</th>
      			</tr>
    		</thead>

    		<tbody>
    			@foreach($componentes as $componente)
    				<tr>
    					<td>{{$componente->nombre}}</td>
    					<td>{{$componente->referencia}}</td>
                        <td>{{$componente->cantidad}}</td>
    					<td>{{$componente->descripcion}}</td>
    					<td>
    						<a href="{{ route('admin.componentes.destroy',$componente->id) }}" class="btn btn-danger"
                            onclick="return confirm('¿Seguro desea eliminarlo?')">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>

							<a href="{{route('admin.componentes.show',$componente->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							<a href="{{route('admin.componentes.edit',$componente->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
    					</td>				
    				</tr>
    			@endforeach
    		</tbody>
		</table>
			{{ $componentes->fragment('foo')->links() }}
		</div>
	</section>
@include ('admin.template.partials.footer')