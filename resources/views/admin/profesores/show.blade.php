@include('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Visualizar Profesor</h3>
    </div>

    <div class="panel-registro">
        <?php
        $dire="images/profesores/".$profe[0]->imagen;
        ?>
        <div class="imagen">
            <div class="form-group" >
                <img src="{{asset($dire)}}" class="img-responsive center-block">
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item text-center">{{$profe[0]->nombre_profesor}}</li>
            <li class="list-group-item text-center">{{$profe[0]->apellido_profesor}}</li>
            <li class="list-group-item text-center">{{$profe[0]->cedula}}</li>
            <li class="list-group-item text-center">{{$profe[0]->nombre}}</li>
            <li class="list-group-item text-center">{{$profe[0]->numero}}</li>

        </ul>
        <div class="form-group">
            <a type="submit" href="{{asset('admin/profesores')}}" class="btn-success btn-lg center-block">Volver</a>
        </div>
        <br>


    </div>
</section>

@include('admin.template.partials.footer')