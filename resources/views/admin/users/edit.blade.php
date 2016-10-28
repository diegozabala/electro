
@include ('admin.template.partials.nav')


<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Editar Usuarios</h3>
    </div>

    <div class="panel-registro">
        <form class="form-horizontal" role="form" method="POST"
              enctype="multipart/form-data" action="{{ route('admin.users.update',$user->id) }}" >
            {!! csrf_field() !!}

            <div class="form-group" >
                <label for="nombre">Correo electrónico</label>
                <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
            </div>

            <div class="form-group" >
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="{{$user->apellido}}" required>
            </div>

            <div class="form-group">
                <label for="cedula">Cedula</label>
                <input type="text" class="form-control" name="cedula" value="{{$user->cedula}}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary  has-spinner" class="btn btn-success">Insertar</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div>


</section>
@include('admin.template.partials.footer')