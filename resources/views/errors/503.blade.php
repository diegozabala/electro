<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/main.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css')}}">
        <div class="container">
            <div class="row">
                <div class="alert alert-danger-alt alert-dismissable">
                    <span class="glyphicon glyphicon-certificate"></span>
                    <a href="{{ url()->previous() }}" class="btn btn-default"><strong>Regresar</strong></a>
                    <strong>ERROR!</strong> Esta tratando de acceder a un dato que <a target="_blank"><strong>NO EXISTE</strong></a> en la <a target="_blank"><strong>BASE DE DATOS</strong></a>
                </div>   
            </div>
        </div>
    </body>
</html>
