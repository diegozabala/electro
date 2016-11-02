@include('admin.template.partials.nav')
<section class="section-login">

    <div class="panel-heading">

        <h3 class="panel-tittle">Lista de Prestamos</h3>
    </div>
    <div class="panel-registro-table">

        <div class="form-group col-md-3">
        <a href="{{route('admin.prestamos.create')}}" class="btn btn-success">Nuevo Prestamo</a>
        </div>
        <div class="form-group col-md-3">
            <label >Osciloscopios: {{$osciloscopios}}</label>

        </div>
        <div class="form-group col-md-3">
            <label >Bananas Caiman: {{$bananas}}</label>

        </div>
        <div class="form-group col-md-3">
            <label >Multimetros: {{$multimetros}}</label>
        </div>

        <table class="table table-responsive table-striped">
            <thead>
            <tr>

                <th class="active">Estudiante</th>
                <th class="active">Número De Documento</th>
                <th class="active">Auxiliar</th>
                <th class="active">Instrumento</th>
                <th class="active">Adicional</th>
                <th class="active">Observaciones</th>
                <th class="active">Hora y fecha</th>
                <th class="active">ACTION</th>

            </tr>
            </thead>
            <tbody>

            @foreach($prestamos as $prestamo)

                <tr class="table-info">

                    @if($prestamo->nombre == "EXTERNOS")
                        <td bgcolor=#f0ed64>{{$prestamo->nombre_estudiante ." ".$prestamo->apellido_estudiante}}</td>
                        <td bgcolor=#f0ed64>{{$prestamo->cedula}}</td>
                        <td bgcolor=#f0ed64>{{$prestamo->name . " ". $prestamo->apellido}}</td>
                        <td bgcolor=#f0ed64>{{$prestamo->nombre}}</td>
                        <td bgcolor=#f0ed64>{{$prestamo->adicion}}</td>
                        <td bgcolor=#f0ed64>{{$prestamo->observaciones}}</td>
                        <td bgcolor=#f0ed64>{{$prestamo->created_at}}</td>
                        <td bgcolor=#f0ed64><a href="{{ route('admin.prestamos.destroy',$prestamo->id) }}" class="btn btn-danger"
                               onclick="return confirm('¿Seguro desea eliminarlo?')">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                            <a href="{{route('admin.estudiantes.show',$prestamo->estudiante_id)}}" class="btn btn-success">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                            <a href="{{route('admin.prestamos.edit',$prestamo->id)}}" class="btn btn-warning">
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
                        </td>

                    @elseif($prestamo->nombre != "EXTERNOS")
                        <td>{{$prestamo->nombre_estudiante ." ".$prestamo->apellido_estudiante}}</td>
                        <td>{{$prestamo->cedula}}</td>
                        <td>{{$prestamo->name . " ". $prestamo->apellido}}</td>
                        <td>{{$prestamo->nombre}}</td>
                        <td>{{$prestamo->adicion}}</td>
                        <td>{{$prestamo->observaciones}}</td>
                        <td>{{$prestamo->created_at}}</td>
                        <td><a href="{{ route('admin.prestamos.destroy',$prestamo->id) }}" class="btn btn-danger"
                               onclick="return confirm('¿Seguro desea eliminarlo?')">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                            <a href="{{route('admin.estudiantes.show',$prestamo->estudiante_id)}}" class="btn btn-success">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                            <a href="{{route('admin.prestamos.edit',$prestamo->id)}}" class="btn btn-warning">
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
                        </td>
                    @endif



                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>

@include('admin.template.partials.footer')