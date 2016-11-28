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

        <ul class="list-group">
            <li class="list-group-item text-center">{{$estudiante[0]->nombre_estudiante . " ". $estudiante[0]->apellido_estudiante }}</li>
        </ul>

        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.prestamos.store') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

    <div class="rowPrestamos col-list">

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
                    <br />
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
                    for ($i = 0;$i<20; $i ++){
                        $cantidad[$i] = $i+1;
                    }  
                ?>

                <label><input type="checkbox" name="RESISTENCIA OHMIOS" value="">
                    <label>RESISTENCIA </label>
                    <label>Ω </label>
                    <input type="text" placeholder="Ejemplo: 2.2x4; 2x4; 1.5x2" style="width:250px;height:20.5px" name="cantidad_ohmios">
<!--
                    <input type="text" style="width:35px;height:20.5px" name="cantidad_ohmios">
                    <select id="sel2resistenciasohmios1" type="number" name="cantidad_de_la_resistencia_ohmios1" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_ohmios2">
                    <select id="sel2resistenciasohmios2" type="number" name="cantidad_de_la_resistencia_ohmios2" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_ohmios3">
                    <select id="sel2resistenciasohmios3" type="number" name="cantidad_de_la_resistencia_ohmios3" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
-->
                </label>


                <label><input type="checkbox" name="RESISTENCIA KILOOHMIOS" value="">
                    <label>RESISTENCIA </label>
                    <label>kΩ </label>
                    <input type="text" placeholder="Ejemplo: 2.2x4; 2x4; 1.5x2" style="width:250px;height:20.5px" name="cantidad_kiloohmios">
<!--
                    <input type="text" style="width:35px;height:20.5px" name="cantidad_kiloohmios">         
                    <select id="sel2resistenciaskiloohmios1" type="number" name="cantidad_de_la_resistencia_kiloohmios1" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_kiloohmios2">                    

                    <select id="sel2resistenciaskiloohmios2" type="number" name="cantidad_de_la_resistencia_kiloohmios2" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_kiloohmios3">                    

                    <select id="sel2resistenciaskiloohmios3" type="number" name="cantidad_de_la_resistencia_kiloohmios3" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
-->
                </label>

                <label><input type="checkbox" name="RESISTENCIA MILIOHMIOS" value="" >
                    <label>RESISTENCIA </label>
                    <label>mΩ </label>
                    <input type="text" placeholder="Ejemplo: 2.2x4; 2x4; 1.5x2" style="width:250px;height:20.5px" name="cantidad_miliohmios">

<!--
                    <input type="text" style="width:35px;height:20.5px" name="cantidad_megaohmios">         
                    <select id="sel2resistenciasmegaohmios1" type="number" name="cantidad_de_la_resistencia_megaohmios1" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_megaohmios2">                    

                    <select id="sel2resistenciasmegaohmios2" type="number" name="cantidad_de_la_resistencia_megaohmios2" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_megaohmios3">                    

                    <select id="sel2resistenciasmegaohmios3" type="number" name="cantidad_de_la_resistencia_megaohmios3" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
-->
                </label>

                <label><input type="checkbox" name="CONDENSADOR NANOFARADIOS" value="">
                    <label>CONDENSADOR </label>
                    <label>nF </label>
                    <input type="text" placeholder="Ejemplo: 2.2x4; 2x4; 1.5x2" style="width:250px;height:20.5px" name="cantidad_nanofaradios">
<!--
                    <input type="text" style="width:35px;height:20.5px" name="cantidad_nanofaradios">
                    <select id="sel2condensadoresnanofaradios1" type="number" name="cantidad_de_la_condensadores_nanofaradios1" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_nanofaradios2">                   

                    <select id="sel2condensadoresnanofaradios2" type="number" name="cantidad_de_la_condensadores_nanofaradios2" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_nanofaradios3">                   

                    <select id="sel2condensadoresnanofaradios3" type="number" name="cantidad_de_la_condensadores_nanofaradios3" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
-->
                </label>

                <label><input type="checkbox" name="CONDENSADOR PICOFARADIOS" value="">
                    <label>CONDENSADOR </label>
                    <label>pF </label>
                    <input type="text" placeholder="Ejemplo: 2.2x4; 2x4; 1.5x2" style="width:250px;height:20.5px" name="cantidad_picofaradios">
<!--
                    <input type="text" style="width:35px;height:20.5px" name="cantidad_picofaradios">
                    <select id="sel2condensadorespicofaradios1" type="number" name="cantidad_del_condensador_picofaradios1" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_picofaradios2">                    
                    <select id="sel2condensadorespicofaradios2" type="number" name="cantidad_del_condensador_picofaradios2" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_picofaradios3">                    
                    <select id="sel2condensadorespicofaradios3" type="number" name="cantidad_del_condensador_picofaradios3" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
-->
                </label>

                <label><input type="checkbox" name="CONDENSADOR MICROFARADIOS" value="">
                    <label>CONDENSADOR </label>
                    <label>uF </label>
                    <input type="text" placeholder="Ejemplo: 2.2x4; 2x4; 1.5x2" style="width:250px;height:20.5px" name="cantidad_microfaradios">                  
<!--
                    <input type="text" style="width:35px;height:20.5px" name="cantidad_microfaradios">
                    <select id="sel2condensadoresmicrofaradios1" type="number" name="cantidad_del_condensador_microfaradios1" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_microfaradios2">                    
                    <select id="sel2condensadoresmicrofaradios2" type="number" name="cantidad_del_condensador_microfaradios2" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>

                    <input type="text" style="width:35px;height:20.5px" name="capacidad_microfaradios3">                    
                    <select id="sel2condensadoresmicrofaradios3" type="number" name="cantidad_del_condensador_microfaradios3" disabled="disabled">
                        <option value="0">0</option>
                        @foreach($cantidad as $num)
                            <option value="{{$num}}">{{$num}}</option>
                        @endforeach 
                    </select>
-->
                </label>

                <label><input type="checkbox" name="INDUCTOR" value="">
                    <label>INDUCTOR </label>
                    <label>uH </label>
                    <input type="text" placeholder="Ejemplo: 2.2x4; 2x4; 1.5x2" style="width:250px;height:20.5px" name="cantidad_inductor"> 
                </label>


                <label><input type="checkbox" name="POTENCIOMETRO" value="">
                    <label>POTENCIÓMETRO </label>
                    <label>kΩ </label>
                    <input type="text" placeholder="Ejemplo: 2.2x4; 2x4; 1.5x2" style="width:250px;height:20.5px" name="cantidad_potenciometro"> 
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
                        <br />
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
                <h2>Combo </h2>
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