@include('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Visualizar Estudiante</h3>
    </div>

    <div class="panel-registro">
        <?php
        $direccion_imagen="images/estudiantes /".$estudiante->imagen;
        ?>
        <div class="imagen">
            <div class="form-group container-fluid" >
                <img src="{{asset($direccion_imagen)}}" height="200" class="img-rounded img-rounded  d-block">
            </div>
        </div>

        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.prestamos.update',$prestamo->id) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <ul class="list-group">
                <li class="list-group-item text-center">{{$estudiante->nombre_estudiante . " ". $estudiante->apellido_estudiante }}</li>
            </ul>
            <div class="form-group" >
                <input class="form-control" name="adicion" placeholder="{{$prestamo->adicion}}" disabled>
            </div>
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
                       value="{{$estudiante->id}}" >
            </div>
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