
@include ('admin.template.partials.nav')


<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Editar Usuarios</h3>
    </div>

    <div class="panel-registro">
        <form class="form-horizontal" role="form" method="POST"
              enctype="multipart/form-data" action="{{ route('admin.user.pass1',$user->id) }}" >
            {!! csrf_field() !!}
                <h3 class="text-center">Hola {{ $user->name }} puedes cambiar tu contaseña</h3>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Introduce la Contraseña"required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary  has-spinner" class="btn btn-success">Insertar</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div>


</section>
@include('admin.template.partials.footer')