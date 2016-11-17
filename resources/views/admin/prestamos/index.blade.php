@include('admin.template.partials.nav')
<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Lista de Prestamos</h3>
    </div>

    <div class="panel-registro-table">
        <div class="form-group">
            <a href="{{route('admin.prestamos.create')}}" class="btn btn-success">Nuevo Prestamo</a>
        </div>
        <div class="form-group">
            <div class="form-group col-md-3">
                <label >Osciloscopios: {{$osciloscopios}}</label>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group col-md-3">
                <label>Generadores: {{$bananas}}</label>
            </div>
        </div>
        <div class="form-group">
                <label >Fuentes: {{$multimetros}}</label>
        </div>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Equipos</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Estudiante" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Auxiliar" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Equipo" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Cantidad" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Observaciones" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Hora y fecha" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Acción" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestamosEquipos as $prestamo)
                        @if($prestamo->estado != "NO DISPONIBLE")
                            <tr class="table-info">
                                <td>{{$prestamo->nombre_estudiante ." ".$prestamo->apellido_estudiante}}</td>
                                <td>{{$prestamo->name . " ". $prestamo->apellido}}</td>
                                <td>{{$prestamo->nombre_instrumento . " " . $prestamo->tipo_instrumento}}</td>
                                <td>{{$prestamo->cantidad_equipo}}</td>
                                <td>{{$prestamo->observaciones}}</td>
                                <td>{{$prestamo->created_at}}</td>
                                <td>
                                    <a href="{{ route('admin.prestamos.destroy',$prestamo->id) }}" class="btn btn-danger"
                                       onclick="return confirm('¿Seguro desea eliminarlo?')">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Componentes</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Estudiante" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Auxiliar" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Componente" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Cantidad" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Observaciones" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Hora y fecha" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Acción" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestamosComponentes as $prestamo)
                        @if($prestamo->estado != "NO DISPONIBLE")
                            <tr class="table-info">
                                <td>{{$prestamo->nombre_estudiante ." ".$prestamo->apellido_estudiante}}</td>
                                <td>{{$prestamo->name . " ". $prestamo->apellido}}</td>
                                <td>{{$prestamo->nombre_componente . " " . $prestamo->referencia_componente}}</td>
                                <td>{{$prestamo->cantidad_componente}}</td>
                                <td>{{$prestamo->observaciones}}</td>
                                <td>{{$prestamo->created_at}}</td>
                                <td>
                                    <a href="{{ route('admin.prestamos.destroy',$prestamo->id) }}" class="btn btn-danger"
                                       onclick="return confirm('¿Seguro desea eliminarlo?')">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Paquetes</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Estudiante" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Auxiliar" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Paquete" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Observaciones" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Hora y fecha" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Acción" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestamosPaquetes as $prestamo)
                        @if (($prestamo->paquetes != '') && ($prestamo->estado != 'NO DISPONIBLE'))
                            <tr class="table-info">
                                <td>{{$prestamo->nombre_estudiante ." ".$prestamo->apellido_estudiante}}</td>
                                <td>{{$prestamo->name . " ". $prestamo->apellido}}</td>
                                <td>{{$prestamo->paquetes}}</td>
                                <td>{{$prestamo->observaciones}}</td>
                                <td>{{$prestamo->created_at}}</td>
                                <td>
                                    <a href="{{ route('admin.prestamos.destroy',$prestamo->id) }}" class="btn btn-danger"
                                       onclick="return confirm('¿Seguro desea eliminarlo?')">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

    </div>
</section>

@include('admin.template.partials.footer')