@include('admin.template.partials.nav')
<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Lista de Prestamos</h3>
    </div>

    <div class="panel-registro-table">
        <div class="form-group">
            <a href="{{route('admin.prestamos.create')}}" class="btn btn-success">Nuevo Prestamo</a>
        </div>
<!--
        <div class="form-group">
            <div class="form-group col-md-2">
                <label >Osciloscopios: {{$osciloscopios}}</label>
            </div>
            <div class="form-group col-md-2">
                <label>Generadores: {{$generadores}}</label>
            </div>
            <div class="form-group ol-md-2">
                <label >Fuentes: {{$fuentes}}</label>
            </div>
        </div>
-->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Equipos</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
            <table class="table table-responsive table-striped">
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
                        @if($prestamo->estado != "INACTIVO")
                            <tr class="table-info">
                                <td>{{$prestamo->nombre_estudiante ." ".$prestamo->apellido_estudiante}}</td>
                                <td>{{$prestamo->name . " ". $prestamo->apellido}}</td>
                                <td>{{$prestamo->nombre_instrumento . " " . $prestamo->tipo_instrumento}}</td>
                                <td>{{$prestamo->cantidad_equipo}}</td>
                                <td>{{$prestamo->observaciones}}</td>
                                <td>{{$prestamo->created_at}}</td>
                                <td>
                                    <a href="{{ route('admin.prestamos.destroy',$prestamo->id) }}" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Componentes</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
            <table class="table table-responsive table-striped">
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
                        @if($prestamo->estado != "INACTIVO")
                            <tr class="table-info">
                                <td>{{$prestamo->nombre_estudiante ." ".$prestamo->apellido_estudiante}}</td>
                                <td>{{$prestamo->name . " ". $prestamo->apellido}}</td>
                                <td>{{$prestamo->nombre_componente . " " . $prestamo->referencia_componente}}</td>
                                <td>{{$prestamo->cantidad_componente}}</td>
                                <td>{{$prestamo->observaciones}}</td>
                                <td>{{$prestamo->created_at}}</td>
                                <td>
                                    <a href="{{ route('admin.prestamos.destroy',$prestamo->id) }}" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
-->

        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Prestamos</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
            <table class="table table-responsive table-striped">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Estudiante" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Auxiliar" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Elementos" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Observaciones" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Hora y fecha" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Acción" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestamos as $prestamo)
                        @if($prestamo->estado != "INACTIVO")
                            <tr class="table-info">
                                <td>{{$prestamo->nombre_estudiante ." ".$prestamo->apellido_estudiante}}</td>
                                <td>{{$prestamo->name . " ". $prestamo->apellido}}</td>
                                <td>
                                    <?php
                                        $contadorPosiciones = 0;
                                        $cadena = '';
                                        $datosElementos = new SplFixedArray(strlen($prestamo->elementos));

                                        for($i=0;$i<strlen($prestamo->elementos);$i++){

                                            if($prestamo->elementos[$i] == '=' && $prestamo->elementos[$i+1] == '='){
                                                $datosElementos[$contadorPosiciones] = $cadena;
                                                $cadena = '';
                                                $contadorPosiciones = $contadorPosiciones + 1;
                                                $i = $i + 2;

                                            }else{
                                                $cadena = $cadena . $prestamo->elementos[$i];
                                            }
                                        }
                                    ?>

                                    @foreach($datosElementos as $dato)
                                        <label style="font-size: 13px;">{{$dato}}</label><br>
                                    @endforeach 
                                </td>
                                <td>{{$prestamo->observaciones}}</td>
                                <td>{{$prestamo->created_at}}</td>
                                <td>
                                    <a href="{{ route('admin.prestamos.destroy',$prestamo->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro desea eliminarlo?')">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@include('admin.template.partials.footer')