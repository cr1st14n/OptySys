<!doctype html>
<html class="no-js " lang="es">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- AlerttiFY -->
    <link rel="stylesheet" type="text/css" href="{{ asset('alertifyjs/alertifyjs/css/alertify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('alertifyjs/alertifyjs/css/themes/default.css') }}">
    <script src="{{ asset('alertifyjs/alertifyjs/alertify.js') }}"></script>

    <title>::OpticSys::</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('Plantilla/assets/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/css/style.min.css') }}">
    <!-- Morris Chart Css-->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/morrisjs/morris.css') }}" />
    <!-- Colorpicker Css -->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
    <!-- Multi Select Css -->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/multi-select/css/multi-select.css') }}">
    <!-- Bootstrap Spinner Css -->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/jquery-spinner/css/bootstrap-spinner.css') }}">
    <!-- Bootstrap Tagsinput Css -->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <!-- Bootstrap Select Css -->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <!-- noUISlider Css -->
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/nouislider/nouislider.min.css') }}" />
    <!-- Select2 -->
    <!-- <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/select2/select2.css') }}" /> -->
    <!-- animacion de carga -->
    <link rel="stylesheet" href="{{ asset('aniCarga/aniCarga.css') }}" />
    @yield('head')
</head>
<body class="theme-blush" >
{{--<!-- Page Loader -->--}}
{{--<div class="page-loader-wrapper">--}}
    {{--<div class="loader">--}}
        {{--<div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('Plantilla/assets/images/loader.svg') }}" width="48" height="48" alt="Aero"></div>--}}
        {{--<p>Cargando...</p>--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Right Icon menu Sidebar -->
<div class="navbar-right">
    <ul class="navbar-nav">
        <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <li><a href="" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="mega-menu" title="Cerrar Sesion"><i class="zmdi zmdi-power"></i></a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </ul>
</div>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><img src="{{ asset('Plantilla/assets/images/logo.svg') }}" width="25" alt="Aero"><span class="m-l-10">OtycSys</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="{{route('perfilUser')}}"><img src="{{ asset('Plantilla/assets/images/avatar5.png') }}" alt="User"></a>
                    <div class="detail">
                        <h4>{{Auth::user()->usu_nombre}}</h4>
                        <small> {{ Auth::user()->usu_cargo}}</small>
                    </div>
                </div>
            </li>
            <li><a href="{{route('indexSystema')}}"><i class="zmdi zmdi-home"></i><span>Inicio</span></a></li>
            @if(Auth::User()->usu_cargo=="Administrador")
            <li><a href="{{route('user_home')}}" ><i class="zmdi zmdi-account"></i><span>Usuarios</span></a></li>
            <li><a href="{{route('clientes_home')}}" id="keyAss"><i class="zmdi zmdi-assignment-account "></i> <span>Clientes</span></a></li>
            @endif
            <hr>
            @if(Auth::User()->usu_cargo=="Administrador")
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Atencion</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('atencion_home')}}">Registrar atencion</a></li>
                    <li><a href="{{route('AtenPendientes_home')}}">Pendintes</a></li>
                    <li><a href="{{route('ventasPasadas_home')}}">Ventas realizadas</a></li>
                </ul>
            </li>
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-chart"></i><span>Reportes</span></a>
                <ul class="ml-menu">
                    <li><a href="file-dashboard.html"></a></li>
                    <li><a href="file-documents.html">Documents</a></li>
                    <li><a href="file-images.html">Images</a></li>
                    <li><a href="file-media.html">Media</a></li>
                </ul>
            </li>
            @else
            <li><a href="{{route('atencion_home')}}"><i class="zmdi zmdi-home"></i><span>Registrar atencion</span></a></li>
            <li><a href="{{route('AtenPendientes_home')}}"><i class="zmdi zmdi-home"></i><span>Pendintes</span></a></li>
            <li><a href="{{route('ventasPasadas_home')}}"><i class="zmdi zmdi-home"></i><span>Ventas realizadas</span></a></li>
            <hr>
            <a href="{{route('reportes_home')}}" class=><i class="zmdi zmdi-tablet"></i><span>Reportes</span></a>
            @endif
            {{--<li>
                <div class="progress-container progress-primary m-t-10">
                    <span class="progress-badge">Traffic this Month</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%;">
                            <span class="progress-value">67%</span>
                        </div>
                    </div>
                </div>
                <div class="progress-container progress-info">
                    <span class="progress-badge">Server Load</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                            <span class="progress-value">86%</span>
                        </div>
                    </div>
                </div>
            </li>--}}
        </ul>
    </div>
</aside>

<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs sm">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="setting">
            <div class="slim_scroll">
                <div class="card">
                    <h6>Opciones de tema</h6>
                    <div class="light_dark">
                        <div class="radio">
                            <input type="radio" name="radio1" id="lighttheme" value="light" checked="">
                            <label for="lighttheme">Modo Claro</label>
                        </div>
                        <div class="radio mb-0">
                            <input type="radio" name="radio1" id="darktheme" value="dark">
                            <label for="darktheme">Modo Nocturno</label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h6>Color de Tema</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple"><div class="purple"></div></li>
                        <li data-theme="blue"><div class="blue"></div></li>
                        <li data-theme="cyan" id="btnthemeHome" ><div class="cyan"></div></li>
                        <li data-theme="green"><div class="green"></div></li>
                        <li data-theme="orange"><div class="orange"></div></li>
                        <li data-theme="blush" class="active"><div class="blush"></div></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</aside>

<!-- Main Content -->
<section class="content">
    @yield('content')
</section>

<!-- Jquery Core Js -->
<script src="{{asset('Plantilla/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('Plantilla/assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->

<script src="{{asset('Plantilla/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script> <!-- Bootstrap Colorpicker Js -->
<script src="{{asset('Plantilla/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script> <!-- Input Mask Plugin Js -->
<script src="{{asset('Plantilla/assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script> <!-- Multi Select Plugin Js -->
<script src="{{asset('Plantilla/assets/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script> <!-- Jquery Spinner Plugin Js -->
<script src="{{asset('Plantilla/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="{{asset('Plantilla/assets/plugins/nouislider/nouislider.js')}}"></script> <!-- noUISlider Plugin Js -->
<script src="{{asset('Plantilla/assets/plugins/select2/select2.min.js')}}"></script> <!-- Select2 Js -->
<script src="{{asset('Plantilla/assets/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->
<script src="{{asset('Plantilla/assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="{{asset('Plantilla/assets/js/pages/charts/morris.js')}}"></script>
<script src="{{asset('Plantilla/assets/bundles/morrisscripts.bundle.js')}}"></script>
{{--momentJS--}}
<script src="{{asset('moment/min/moment.min.js')}}"></script>
<script src="{{asset('AsincronoJS/home.js')}}"></script>
<script>
    {{--funcion para cambiar el tema por defecto--}}
    $(document).ready(function(){
        setTimeout(clickbutton,200);
        function clickbutton()
        {
            document.getElementById('btnthemeHome').click();
        }
    });
</script>
@yield('scrypt')
</body>
</html>