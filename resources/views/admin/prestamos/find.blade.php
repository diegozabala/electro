@include('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Visualizar Prestamo</h3>
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
                        if($instrumento->cantidad > 0){
                            for ($i = 0;$i< $instrumento->cantidad; $i++){
                                $cantidades[$i] = $i+1;
                            }
                        }else{
                            $cantidades[0] = 0;
                        }
                    ?> 
                    <label><input type="checkbox" name="prestamo_equipos[]" value="{{$instrumento->id}}" onclick="sel<?php echo $instrumento->id;?>.disabled=!this.checked" >
                        <label>{{$instrumento->nombre . ' ' . $instrumento->tipo}}</label>

                        <select  id="sel<?php echo $instrumento->id;?>" type="number" name="cantidad_del_equipo[]" disabled="disabled">
                            <option value="0">0</option>
                            @foreach($cantidades as $num)
                                <option value="{{$num}}">{{$num}}</option>
                            @endforeach 
                        </select>
                    </label>
                    <?php
                        unset($cantidades);
                        $cantidades = array(); 
                    ?>
                @endforeach
            </ul>
        </div>

        <div class="col-md-5 t2">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span>
                <h2>Componentes</h2>
            </div>
            <ul class="list-unstyled">

                <?php
                    for ($i = 0;$i<30; $i ++){
                        $cantidad[$i] = $i+1;
                    }  
                ?>

                <label><input type="checkbox" name="RESISTENCIA OHMIOS" value="" onclick="sel2resistenciasohmios.disabled=!this.checked">
                    <label>RESISTENCIA</label>
                    <input type="text" size="3" name="capacidad_ohmios">
                    <label>Ω</label>

                    <select id="sel2resistenciasohmios" type="number" name="cantidad_de_la_resistencia_ohmios" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
                </label>

                <label><input type="checkbox" name="RESISTENCIA KILOOHMIOS" value="" onclick="sel2resistenciaskiloohmios.disabled=!this.checked">
                    <label>RESISTENCIA</label>
                    <input type="text" size="3" name="capacidad_kiloohmios">
                    <label>KΩ</label>

                    <select id="sel2resistenciaskiloohmios" type="number" name="cantidad_de_la_resistencia_kiloohmios" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
                </label>

                <label><input type="checkbox" name="RESISTENCIA MEGAOHMIOS" value="" onclick="sel2resistenciasmegaohmios.disabled=!this.checked">
                    <label>RESISTENCIA</label>
                    <input type="text" size="3" name="capacidad_megaohmios">
                    <label>MΩ</label>

                    <select id="sel2resistenciasmegaohmios" type="number" name="cantidad_de_la_resistencia_megaohmios" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
                </label>

                <label><input type="checkbox" name="CONDENSADOR NANOFARADIOS" value="" onclick="sel2condensadoresnanofaradios.disabled=!this.checked">
                    <label>CONDENSADOR</label>
                    <input type="text" size="3" name="capacidad_nanofaradios">
                    <label>nF</label>

                    <select id="sel2condensadoresnanofaradios" type="number" name="cantidad_de_la_condensadores_nanofaradios" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
                </label>

                <label><input type="checkbox" name="CONDENSADOR PICOFARADIOS" value="" onclick="sel2condensadorespicofaradios.disabled=!this.checked">
                    <label>CONDENSADOR</label>
                    <input type="text" size="3" name="capacidad_picofaradios">
                    <label>pF</label>

                    <select id="sel2condensadorespicofaradios" type="number" name="cantidad_del_condensador_picofaradios" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
                </label>

                <label><input type="checkbox" name="CONDENSADOR MICROFARADIOS" value="" onclick="sel2condensadoresmicrofaradios.disabled=!this.checked">
                    <label>CONDENSADOR</label>
                    <input type="text" size="3" name="capacidad_microfaradios">
                    <label>uF</label>

                    <select id="sel2condensadoresmicrofaradios" type="number" name="cantidad_del_condensador_microfaradios" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
                </label>

                <?php
                    unset($cantidad);
                    $cantidad = array(); 
                ?>

                @foreach($componentes as $componente)
                    @if($componente->nombre != "RESISTENCIA")
                        <?php
                            if($componente->cantidad > 0){
                                for ($i = 0;$i< $componente->cantidad; $i ++){
                                    $cantidades[$i] = $i+1;
                                }
                            }else{
                                $cantidades[0] = 0;
                            }  
                        ?> 
                        <label><input type="checkbox" name="prestamo_componentes[]" value="{{$componente->id}}" onclick="sel2<?php echo $componente->id;?>.disabled=!this.checked">
                            <label>{{$componente->nombre . ' ' . $componente->referencia}}</label>

                            <select id="sel2<?php echo $componente->id;?>" type="number" name="cantidad_del_componente[]" disabled="disabled">
                                <option value="0">0</option>
                                @foreach($cantidades as $num)
                                    <option value="{{$num}}">{{$num}}</option>
                                @endforeach 
                            </select>
                        </label>
                        <?php
                            unset($cantidades);
                            $cantidades = array(); 
                        ?>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-md-2 t3">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
                <h2>Paquete</h2>
            </div>
            <ul class="list-unstyled">
                <select class="selectpicker" data-style="btn-primary" name="prestamo_paquetes">
                    <option></option>
                    <option>FOG</option>
                    <option>FO</option>
                    <option>FG</option>
                    <option>OG</option>
                </select>
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
                        <input type="hidden"  name="usuario_id" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="form-group">
                        <input type="hidden"  name="estudiante_actual_id" value="{{$estudiante[0]->id}}">
                    </div>
                </form>
    </div>
</section>
@include('admin.template.partials.footer')