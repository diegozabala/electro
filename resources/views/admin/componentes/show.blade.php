@include('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Visualizar Componente</h3>
    </div>

    <div class="panel-registro">
        <ul class="list-group">
            <li class="list-group-item text-center">{{$componente->nombre}}</li>
            <li class="list-group-item text-center">{{$componente->referencia}}</li>
            <li class="list-group-item text-center">{{$componente->cantidad}}</li>
            <li class="list-group-item text-center">{{$componente->descripcion}}</li>
        </ul>
        <div class="form-group">
            <a type="submit" href="{{asset('admin/componentes')}}" class="btn-success btn-lg center-block">Volver</a>
        </div>
        <br>
    </div>
</section>

@include('admin.template.partials.footer')