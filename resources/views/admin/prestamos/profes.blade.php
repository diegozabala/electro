@include ('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle"> Lista de Profesores</h3>

    </div>
    <div class="panel-registro-table">

        <table class="table table-responsive table-striped">
            <thead>
            <tr>
                <th class="active">Nombre</th>
                <th class="active">Apellido</th>
                <th class="active">Cedula</th>
                <th class="active">Número Celular</th>
                <th class="active">Facultad</th>
                <th class="active">ACTION</th>
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
                    <td>
                        <a href="{{route('admin.profesores.show',$profesor->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
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