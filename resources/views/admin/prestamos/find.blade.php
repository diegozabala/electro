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

<script src="~/plugins/jquery/js/jquery-3.1.0.js"></script>    
<script src="~/plugins/bootstrap/js/bootstrap.min.js"></script>

<div class="container">
    <div class="row">
        
        
        <div class="col-md-12">
        <h4>Bootstrap Snipp for Datatable</h4>
        <div class="table-responsive">

                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                
                    <th>Seleccionar</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Delete</th>
                   </thead>
    <tbody>
    
    <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    </tbody>
        
</table>
               
            </div>
            
        </div>
    </div>
</div>
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>




<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
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