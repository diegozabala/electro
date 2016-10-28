

@include ('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Editar Docentes</h3>
    </div>

    <div class="panel-registro">
        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.profesores.update',$profesor->id) }}" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{$profesor->nombre_profesor}}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="{{$profesor->apellido_profesor}}" required>
            </div>
            <div class="form-group">
                <label for="cedula">Cedula</label>
                <input type="text" class="form-control" name="cedula" value="{{$profesor->cedula}}" required>
            </div>
            <div class="form-group">
                <label for="numero">Número Celular</label>
                <input type="text" class="form-control" name="numero" value="{{$profesor->numero}}"
                       required>
            </div>
            <div class="form-group">
                <label for="Imagen">Imagen</label>
                <input type="file" class="form-control" name="imagen" placeholder="Inserte imagen" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary  has-spinner" class="btn btn-success">Insertar</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
            </div>


        </form>
    </div>


</section>
@include ('admin.template.partials.footer')