@include('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Visualizar Estudiante</h3>
    </div>

    <div class="panel-registro">
        <?php
            $direccion_imagen="images/estudiantes /".$estudiante[0]->imagen;
        ?>
        <div class="imagen">
        <div class="form-group container-fluid" >
            <img src="{{asset($direccion_imagen)}}" height="200" class="img-rounded img-rounded  d-block">

        </div>
        </div>

        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.prestamos.store') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <ul class="list-group">
                <li class="list-group-item text-center">{{$estudiante[0]->nombre_estudiante . " ". $estudiante[0]->apellido_estudiante }}</li>
            </ul>
  
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="form-group">
    <div class="row col-list">

        <div class="col-md-5 t1">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>
                <h2>Equipos</h2>
            </div>

            <ul class="list-unstyle">

                @foreach($instrumentos as $instrumento)
                    <?php
                        for ($i = 0;$i< $instrumento->cantidad; $i ++){
                            $cantidades[$i] = $i+1;
                        }
                    ?> 
                    <label><input type="checkbox" name="prestamo_equipos[]" value="{{$instrumento->nombre . ' ' . $instrumento->tipo}}">
                        <label>{{$instrumento->nombre . ' ' . $instrumento->tipo}}</label>

                        <select id="cantidad_del_equipo" type="number" name="cantidad_del_equipo[]">
                            <option value="0">0</option>
                            @foreach($cantidades as $num)
                                <option value="{{$num}}">{{$num}}</option>
                            @endforeach 
                        </select>
                    </label>
                @endforeach
            </ul>
        </div>

        <div class="col-md-5 t2">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span>
                <h2>Componentes</h2>
            </div>
            <ul class="list-unstyled">
                @foreach($componentes as $componente)
                    <label><input type="checkbox" value="" name="prestamo_compnentes[]">
                        <?php
                            for ($i = 0;$i< $componente->cantidad; $i ++){
                                $cantidades[$i] = $i+1;
                            }  
                        ?> 
                        <label name="nombre_Equipo" id="nombre_Equipo" for="nombre_Equipo">{{$componente->nombre . ' ' . $componente->referencia}}</label>

                        <select type="number">
                            @foreach($cantidades as $num)
                                <option>{{$num}}</option>
                            @endforeach 
                        </select>
                    </label>
                @endforeach
            </ul>
        </div>
        <div class="col-md-2 t3">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
                <h2>Paquete</h2>
            </div>
            <ul class="list-unstyled">
                <label><input type="checkbox" name="prestamo_paquetes[]" value="OGF">OGF</label>
                <label><input type="checkbox" name="prestamo_paquetes[]" value="OFM">OFM</label>
                <label><input type="checkbox" name="prestamo_paquetes[]" value="DMA">DMA</label>
                <label><input type="checkbox" name="prestamo_paquetes[]" value="ACD">ACD</label>
            </ul>
        </div>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" name="observaciones" cols="7"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit"  class="btn btn-success" id="btn-modal" data-toggle="modal" data-target="#myModal">Insertar</button>
                        <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
                    </div>
                    <div class="form-group">
                        <input type="hidden"  name="nombre" value="{{ Auth::user()->id }}" >
                    </div>
                </form>
    </div>
</section>
@include('admin.template.partials.footer')