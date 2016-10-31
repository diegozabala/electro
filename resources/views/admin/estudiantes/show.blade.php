@include('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Visualizar Estudiante</h3>
    </div>

    <div class="panel-registro">
        <?php
        $direccion_imagen="images/estudiantes/".$estudiante[0]->imagen;
        ?>
        <div class="imagen">
            <div class="form-group" >
                <img src="{{asset($direccion_imagen)}}" class="img-responsive center-block">
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item text-center">{{$estudiante[0]->nombre_estudiante}}</li>
            <li class="list-group-item text-center">{{$estudiante[0]->apellido_estudiante}}</li>
            <li class="list-group-item text-center">{{$estudiante[0]->numero_documento}}</li>
            <li class="list-group-item text-center">{{$estudiante[0]->nombre}}</li>

        </ul>
        <div class="form-group">
            <a type="submit" href="{{asset('admin/estudiantes')}}" class="btn-success btn-lg center-block">Volver</a>
        </div>
        <br>

    </div>
</section>

@include('admin.template.partials.footer')