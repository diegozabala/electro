

@include ('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Registrar Equipo</h3>
    </div>

    <div class="panel-registro">
        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.equipos.update',$equipos->id) }}">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{$equipos->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Placa</label>
                <input type="text" class="form-control" name="placa" value="{{$equipos->placa}}" required>
            </div>

            <div class="form-group">
                <label for="cedula">Descripcion</label>
                <textarea class="form-control" rows="5" name="descripcion" required>{{$equipos->descripcion}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary  has-spinner" class="btn btn-success">Insertar</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
            </div>

        </form>
    </div>


</section>



