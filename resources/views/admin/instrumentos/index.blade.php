@include ('admin.template.partials.nav')

	<section class="section-login">

			<div class="panel-heading">
			<h3 class="panel-tittle"> Lista de Instrumentos</h3>
				
		</div>

		<div class="panel-registro-table">
        <div class="form-group col-md-3">
		<a href="{{route('admin.instrumentos.create')}}" class="btn btn-success">Registrar un nuevo Instrumento</a>
        </div>

			<table class="table table-responsive table-striped">
			<thead>
      			<tr>
        			<th class="active">Nombre</th>
                    <th class="active">Tipo</th>
        			<th class="active">Cantidad</th>
        			<th class="active">Descripción</th>
        			<th class="active">ACTION</th>
      			</tr>
    		</thead>

    		<tbody>
    			@foreach($instrumentos as $instrumento)
    				<tr>
    					<td>{{$instrumento->nombre}}</td>
    					<td>{{$instrumento->tipo}}</td>
                        <td>{{$instrumento->cantidad}}</td>
    					<td>{{$instrumento->descripcion}}</td>
    					<td>
    						<a href="{{ route('admin.instrumentos.destroy',$instrumento->id) }}" class="btn btn-danger"
                            onclick="return confirm('¿Seguro desea eliminarlo?')">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>

							<a href="{{route('admin.instrumentos.show',$instrumento->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							<a href="{{route('admin.instrumentos.edit',$instrumento->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
    					</td>				
    				</tr>
    			@endforeach
    		</tbody>
		</table>
			{{ $instrumentos->fragment('foo')->links() }}
		</div>
	</section>
@include ('admin.template.partials.footer')