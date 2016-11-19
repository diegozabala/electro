@extends('layouts.app')

@section('content')
    @if(Auth::check())
       @include('admin.template.partials.navi')
    @endif
    <div class="container">
        <div class="jumbotron">
            <h1>SIPFI!</h1>
            <h3>Bienvenido al Sistema Integrado de Prestamos de la Facultad de Ingeniería.</h3>
            <style>
                h1{
                    color:#EAEFC4;
                }
            </style>

        </div>
    </div>
    @include('admin.template.partials.footer')
@endsection
