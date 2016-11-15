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
        <div class="col-md-4 t1">
            <div class="col-head text-center">
                <span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>
                <h2>Equipos</h2>
            </div>
            <ul class="list-unstyled">
                @foreach($instrumentos as $instrumento)
                    <li>
                        <p class="servicio">
                            <span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="1"></span>
                            <label name="nombre_Equipo" id="nombre_Equipo" for="nombre_Equipo">{{$instrumento->nombre . ' ' . $instrumento->tipo}}</label>
                            <input type="number" class="form-control" id="cantidad_Equipos" name="cantidad_Equipos" placeholder="--->">
                        </p>
                        <label >Max: {{$instrumento->cantidad}}</label>
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
                            <span id="nombre_componente" class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="1" ></span>
                            <label name="nombre_Componente" id="nombre_Componente" for="nombre_Componente">{{$componente->nombre . ' ' .$componente->referencia}}</label>
                            <input type="number" class="form-control" name="cantidad_componentes" placeholder="--->">
                        </p>
                        <label >Max: {{$componente->cantidad}}</label>
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
                <p class="servicio"><span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="3"></span>
                    <label name="nombre_Componente" id="nombre_Componente" for="nombre_Componente">OGF</label></p>
             </li>
             <li>
                <p class="servicio"><span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="3"></span>
                    <label name="nombre_Componente" id="nombre_Componente" for="nombre_Componente">OFM</label></p>
             </li>
             <li>
                <p class="servicio"><span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="3"></span>
                    <label name="nombre_Componente" id="nombre_Componente" for="nombre_Componente">DMA</label></p>
             </li>
             <li>
                <p class="servicio"><span class="glyphicon glyphicon-ok inactivo" aria-hidden="true" data-price="3"></span>
                    <label name="nombre_Componente" id="nombre_Componente" for="nombre_Componente">ACD</label></p>
             </li>
            </ul>
        </div>
    </div>
    <hr />
    <div class="text-right">
        <h4 class="pull-left">Total: <span id="uym-price">0</span></h4>
    </div>  
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">EQUIPOS SELECCIONADOS</h4>
      </div>
      <div class="modal-body">
        <!--textarea id="textarea-list" class="col-md-12"></textarea-->
        <ul id="summary-list">
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar Cambios</button>
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