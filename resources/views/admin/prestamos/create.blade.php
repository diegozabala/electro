@include ('admin.template.partials.nav')

<section class="section-login">
    <div>


    </div>
    <div class="panel-heading">
        <h3 class="panel-tittle">Registrar Préstamo</h3>
    </div>

    <div class="panel-registro">
        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.prestamos.find') }}">
            {!! csrf_field() !!}
            <div class="form-group ">
                <label for="nombre">Código profesor</label>
                <input type="text" class="form-control" name="codigo" placeholder="Introduce el Código del profesor" required>
            </div>
            <div class="form-group">
                <button class="btn btn-success">Insertar</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
            </div>
        </form>
        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.prestamos.find1') }}">
            {!! csrf_field() !!}
            <div class="form-group ">
                <label for="nombre">Nombre profesor</label>
                <input type="text" class="form-control" name="nombre" placeholder="Introduce el Nombre del profesor" required>
            </div>
            <div class="form-group">
                <button class="btn btn-success">Insertar</button>
                <a href="{{ url()->previous() }}" class="btn btn-default ">Cancelar</a>
            </div>
        </form>
    </div>


</section>

@include ('admin.template.partials.footer')