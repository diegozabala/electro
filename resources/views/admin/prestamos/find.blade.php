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


                    <select multiple class="selectpicker col-lg-4" name="prestamos[]" size="12" >
                        @foreach($instrumentos as $instrumento)
                            @if($instrumento->tipo=="O")
                            <option>{{$instrumento->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                    <select multiple class="selectpicker col-lg-4" name="prestamos[]" size="12">
                        @foreach($instrumentos as $instrumento)
                            @if($instrumento->tipo=="M")
                                <option>{{$instrumento->nombre}}</option>
                                @endif
                        @endforeach
                    </select>
                    <select multiple class="selectpicker col-lg-4 " name="prestamos[]" size="12" >
                        @foreach($instrumentos as $instrumento)
                            @if($instrumento->tipo=="Caiman"  || $instrumento->tipo=="O")
                                <option>{{$instrumento->nombre}}</option>
                                @endif
                        @endforeach
                    </select>

                    <div class="col-lg-12">
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Osciloscopio">Osciloscopio</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Multimetro">Multimetro</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Bananas Caiman">Bananas Caiman</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Bananas Macho 4MM">Bananas Macho 4MM</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Bananas Hembra 2MM">Bananas Hembra 2MM</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Generador de Señales">Generador de Señales</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Fuente">Fuente</label>

                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="codigo"
                               value="{{$estudiante[0]->id}}" >
                    </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="form-group">
    <div class="row col-list">
        <div class="col-md-4 t1">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>
                <h2>Equipos</h2>
            </div>
            <ul class="list-unstyled">
                @foreach($instrumentos as $instrumento)
                    <li>
                        <p class="servicio">
                            <span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="1"></span>{{$instrumento->nombre}}
                            <select name="cantidad_equipos" class="selectpicker" data-style="btn-primary" data-width="auto">
                                <?php
                                    for ($i = 0;$i< $instrumento->cantidad; $i ++){
                                        $cantidades[$i] = $i+1;
                                    }  
                                ?>
                                @foreach($cantidades as $num)
                                    <option>{{$num}}</option>
                                @endforeach
                            </select>
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4 t2">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span>
                <h2>Componentes</h2>
            </div>
            <ul class="list-unstyled">
                @foreach($componentes as $componente)
                    <li>
                        <p class="servicio">
                            <?php
                                for ($i = 0;$i< $componente->cantidad; $i ++){
                                    $cantidades[$i] = $i+1;
                                }  
                            ?>
                            <span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="1" ></span>{{$componente->nombre}}
                            <select name="cantidad_componentes" class="selectpicker" data-style="btn-primary" data-width="auto">
                                @foreach($cantidades as $num)
                                    <option>{{$num}}</option>
                                @endforeach
                            </select>
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4 t3">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
                <h2>Paquetes</h2>
            </div>
            <ul class="list-unstyled">
             <li>
                <p class="servicio"><span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="1"></span>OGF</p>
             </li>
             <li>
                <p class="servicio"><span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="1"></span>OFM</p>
             </li>
             <li>
                <p class="servicio"><span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="1"></span>DMA</p>
             </li>
             <li>
                <p class="servicio"><span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="1"></span>ACD</p>
             </li>
            </ul>
        </div>
    </div>
    <hr />
    <div class="text-right">
        <h4 class="pull-left">Total: <span id="uym-price">0</span></h4>
        <!-- Button trigger modal -->
        <button type="button" id="btn-reset" class="btn btn-default btn-lg">
          Desmarcar Todo
        </button>
        <!-- Button trigger modal -->
        <button type="button" id="btn-modal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
          Crear Prestamo
        </button>
    </div>  
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <!--textarea id="textarea-list" class="col-md-12"></textarea-->
        <ul id="summary-list">
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" name="observaciones" cols="7"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit"  class="btn btn-success">Insertar</button>
                        <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
                    </div>
                    <div class="form-group">
                        <input type="hidden"  name="nombre"
                               value="{{ Auth::user()->id }}" >
                    </div>
                </form>
    </div>
</section>
@include('admin.template.partials.footer')