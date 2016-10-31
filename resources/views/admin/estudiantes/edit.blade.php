

@include ('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Editar Estudiantes</h3>
    </div>

    <div class="panel-registro">
        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.estudiantes.update',$estudiante->id) }}" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{$estudiante->nombre_estudiante}}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="{{$estudiante->apellido_estudiante}}" required>
            </div>
            <div class="form-group">
                <label for="numero_documento">Número de Documento</label>
                <input type="text" class="form-control" name="numero_documento" value="{{$estudiante->numero_documento}}" required>
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