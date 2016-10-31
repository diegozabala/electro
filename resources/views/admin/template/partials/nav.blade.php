
@include('layouts.app')
<div class="container">

    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('admin/prestamos')}}">Préstamos Facultad de Ingeniería</a>
        </div>


        <div class="collapse navbar-collapse js-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrar<span class="glyphicon glyphicon-chevron-down pull-right"></span></a>

                    <ul class="dropdown-menu mega-dropdown-menu row">
                        <li class="col-sm-3">
                            <ul>
                                @if(!Auth::guest())
                                <li class="dropdown-header">{{ Auth::user()->name }}</li>
                                @endif
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <?php
                                             $dire="images/users/".Auth::user()->imagen;
                                            ?>
                                            <a href="#"><img src="{{asset($dire)}}" class="img-responsive" alt="product 1"></a>
                                            <li class="divider"></li>
                                                <a href="{{route('admin.user.pass',Auth::user()->id)}}"
                                                   class="btn btn-primary">Cambiar Contraseña</a>

                                        </div>
                                        <!-- End Item -->
                                    </div>
                                    <!-- End Carousel Inner -->
                                </div>
                                <!-- /.carousel -->

                            </ul>
                        </li>

                        <li class="col-sm-4">
                            <ul>
                                @if(Auth::user()->rol=="admin")
                                    <li class="dropdown-header">Usuarios</li>
                                    <li><a href="{{ url('admin/users/create') }}">Crear Usuarios</a></li>
                                    <li><a href="{{ url('admin/users') }}">Listar Usuarios</a></li>
                                    <li><a href="{{ url('admin/users') }}">Eliminar Usuarios</a></li>
                                    <li class="divider"></li>
                                @endif
                                <li class="dropdown-header">Prestamos</li>
                                <li><a href="{{url('admin/prestamos/create')}}">Crear Préstamos</a></li>
                                <li><a href="{{url('admin/prestamos')}}">Listar Préstamos</a></li>
                                <li><a href="{{url('admin/prestamos')}}">Eliminar Préstamos</a></li>
                                @if(Auth::user()->rol=="auxiliar")
                                    <li><a href="{{url('admin/estudiantes')}}">Listar Estudiantes</a></li>
                                @endif

                            </ul>
                        </li>

                        @if(Auth::user()->rol=="admin")
                            <li class="col-sm-4">
                                <ul>
                                    <li class="dropdown-header">Profesores</li>
                                    <li><a href="{{url('admin/estudiantes/create')}}">Crear Estudiantes</a></li>
                                    <li><a href="{{url('admin/estudiantes')}}">Listar Estudiantes</a></li>
                                    <li><a href="{{url('admin/estudiantes')}}">Eliminar Estudiantes</a></li>
                                    <li class="divider"></li>
                                    @endif
                                    @if(Auth::user()->rol=="admin")
                                        <li class="dropdown-header">Equipos</li>
                                        <li><a href="{{url('admin/instrumentos/create')}}">Crear Instrumentos</a></li>
                                        <li><a href="{{url('admin/instrumentos')}}">Listar Instrumentos</a></li>
                                        <li><a href="{{url('admin/instrumentos')}}">Eliminar Instrumentos</a></li>
                                </ul>

                            </li>
                        @endif

                    </ul>

                </li>
            </ul>

        </div>

        <!-- /.nav-collapse -->
    </nav>

</div>



