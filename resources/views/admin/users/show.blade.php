@include('admin.template.partials.nav')

<section class="section-login">

        <div class="panel-heading">
            <h3 class="panel-tittle">Visualizar Usuario</h3>
        </div>

        <div class="panel-registro">
            <?php
            $dire="images/users/".$users->imagen;
            ?>
            <div class="imagen">
                <div class="form-group" >
                    <img src="{{asset($dire)}}" class="img-responsive center-block">
            </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-center">{{$users->name}}</li>
                    <li class="list-group-item text-center">{{$users->apellido}}</li>
                    <li class="list-group-item text-center">{{$users->cedula}}</li>
                    <li class="list-group-item text-center">{{$users->email}}</li>

                </ul>
                <div class="form-group">
                    <a type="submit" href="{{asset('admin/users')}}" class="btn-success btn-lg center-block">Volver</a>
                </div>


        </div>
</section>

@include('admin.template.partials.footer')