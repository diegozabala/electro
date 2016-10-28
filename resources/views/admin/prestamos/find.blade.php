@include('admin.template.partials.nav')

<section class="section-login">

    <div class="panel-heading">
        <h3 class="panel-tittle">Visualizar Usuario</h3>
    </div>

    <div class="panel-registro">
        <?php
        $dire="images/profesores /".$profesor[0]->imagen;
        ?>
        <div class="imagen">
        <div class="form-group container-fluid" >
            <img src="{{asset($dire)}}" height="200" class="img-rounded img-rounded  d-block">

        </div>
        </div>

                <form class="form-horizontal" role="form" method="POST"
                      action="{{ route('admin.prestamos.store') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <ul class="list-group">
                        <li class="list-group-item text-center">{{$profesor[0]->nombre_profesor . " ". $profesor[0]->apellido_profesor }}</li>
                    </ul>


                    <select multiple class="selectpicker col-lg-4" name="prestamos[]" size="12" >
                        @foreach($equipos as $equipo)
                            @if($equipo->tipo=="pc")
                            <option>{{$equipo->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                    <select multiple class="selectpicker col-lg-4" name="prestamos[]" size="12">
                        @foreach($equipos as $equipo)
                            @if($equipo->tipo=="VB")
                                <option>{{$equipo->nombre}}</option>
                                @endif
                        @endforeach
                    </select>
                    <select multiple class="selectpicker col-lg-4 " name="prestamos[]" size="12" >
                        @foreach($equipos as $equipo)
                            @if($equipo->tipo=="apuntador"  || $equipo->tipo=="EX")
                                <option>{{$equipo->nombre}}</option>
                                @endif
                        @endforeach
                    </select>

                    <div class="col-lg-12">
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Amplificador">Amplificador</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Cable VGA">Cable VGA</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Cable USB-B">Cable USB-B</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Cable HDMI">Cable HDMI</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Cable Red">Cable Red</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Camara">Cámara</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Cargador">Cargador</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Control VB">Control VB</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Conversor">Conversor</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Extension">Extensión</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Microfono">Micrófono</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Parlantes">Parlantes</label>
                        <label class="checkbox-inline"><input type="checkbox" name="adicion[]" value="Tripode">Trípode</label>

                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="codigo"
                               value="{{$profesor[0]->id}}" >
                    </div>
                    <div class="form-group">
                        <label for="nombre">Observaciones</label>
                        <textarea class="form-control" name="observaciones" cols="7"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit"  class="btn btn-success">Insertar</button>
                        <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
                    </div>
                    <div class="form-group">
                        <input type="hidden"  name="nombre"
                               value="{{ Auth::user()->id }}" >
                    </div>
                </form>
    </div>

</section>
@include('admin.template.partials.footer')