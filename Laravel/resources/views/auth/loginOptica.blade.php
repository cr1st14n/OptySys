<!doctype html>
<html class="no-js " lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    {{--{{ asset('') }} Ejemplo para complementos del public  --}}
    <title>OpticSys :: Ingreso</title>
<!-- Favicon-->
    <link rel="icon" href="{{ asset('Plantilla/assets/favicon.ico') }}" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/css/style.min.css') }}">
</head>
<body class="theme-blush" style="background-color: #f5f5f5">
@if(Session()->has('flash_login'))
    <div class="col-lg-4" style="position: absolute;  right: 0%">
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
            <strong>Advertencia! </strong> {{ Session('flash_login')}}
        </div>
    </div>
@endif
<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="{{ asset('Plantilla/assets/images/optica4.png') }}" alt="Sign In"/>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form" action="{{ route('loginSys') }}" method="post">
                    @csrf
                    <div class="header">
                        <img class="logo" src="{{ asset('Plantilla/assets/images/logo.svg') }}" alt="">
                        <h5>Iniciar Seccion</h5>
                    </div>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Usuario" name="usu_ci" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Contraseña" name="password">
                            <div class="input-group-append">
                                <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>
                        </div>
                        {{--<a href="index.html" class="btn btn-primary btn-block waves-effect waves-light">INGRESAR</a>--}}
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">INGRESAR</button>
                        <div class="signin_with mt-3">
                            <p class="mb-0">{{-- O UTILIZA OTRO METODO DE INGRESO--}}</p>
                            {{--<button class="btn btn-primary btn-icon btn-icon-mini btn-round facebook"><i class="zmdi zmdi-facebook"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round twitter"><i class="zmdi zmdi-twitter"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round google"><i class="zmdi zmdi-google-plus"></i></button>--}}
                        </div>
                    </div>
                </form>
                <div class="copyright text-center">
                    <script>document.write(new Date().getFullYear())</script>,
                    <span><a href="#">BrainSoft</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="{{ asset('Plantilla/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('Plantilla/assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
</body>
</html>