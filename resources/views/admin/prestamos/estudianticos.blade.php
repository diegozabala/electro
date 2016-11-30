@include ('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle"> Lista de Estudiantes</h3>

    </div>
    <div class="panel-registro-table">

        <table class="table table-responsive table-striped">
            <thead>
            <tr>
                <th class="active">Nombre</th>
                <th class="active">Apellido</th>
                <th class="active">Número De Documento</th>
                <th class="active">Programa</th>
                <th class="active">ACTION</th>
            </tr>
            </thead>

            <tbody>
            @foreach($estudiantes as $estudiante)
                <tr>
                    <td>{{$estudiante->nombre_estudiante}}</td>
                    <td>{{$estudiante->apellido_estudiante}}</td>
                    <td>{{$estudiante->numero_documento}}</td>
                    <td>
                        <a href="{{route('admin.estudiantes.show',$estudiante->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
        <div class="form-group">
            <a href="{{ url()->previous() }}" class="btn btn-info btn-lg">Volver atras</a>
        </div>

    </div>
</section>
@include ('admin.template.partials.footer')