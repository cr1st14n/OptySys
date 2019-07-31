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
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" title="App" data-toggle="dropdown" role="button"><i class="zmdi zmdi-apps"></i></a>
            <ul class="dropdown-menu slideUp2">
                <li class="header">App Sortcute</li>
                <li class="body">
                    <ul class="menu app_sortcut list-unstyled">
                        <li>
                            <a href="image-gallery.html">
                                <div class="icon-circle mb-2 bg-blue"><i class="zmdi zmdi-camera"></i></div>
                                <p class="mb-0">Photos</p>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle mb-2 bg-amber"><i class="zmdi zmdi-translate"></i></div>
                                <p class="mb-0">Translate</p>
                            </a>
                        </li>
                        <li>
                            <a href="events.html">
                                <div class="icon-circle mb-2 bg-green"><i class="zmdi zmdi-calendar"></i></div>
                                <p class="mb-0">Calendar</p>
                            </a>
                        </li>
                        <li>
                            <a href="contact.html">
                                <div class="icon-circle mb-2 bg-purple"><i class="zmdi zmdi-account-calendar"></i></div>
                                <p class="mb-0">Contacts</p>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle mb-2 bg-red"><i class="zmdi zmdi-tag"></i></div>
                                <p class="mb-0">News</p>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle mb-2 bg-grey"><i class="zmdi zmdi-map"></i></div>
                                <p class="mb-0">Maps</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" title="Notifications" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
            </a>
            <ul class="dropdown-menu slideUp2">
                <li class="header">Notifications</li>
                <li class="body">
                    <ul class="menu list-unstyled">
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                                <div class="menu-info">
                                    <h4>8 New Members joined</h4>
                                    <p><i class="zmdi zmdi-time"></i> 14 mins ago </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle bg-amber"><i class="zmdi zmdi-shopping-cart"></i></div>
                                <div class="menu-info">
                                    <h4>4 Sales made</h4>
                                    <p><i class="zmdi zmdi-time"></i> 22 mins ago </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>
                                <div class="menu-info">
                                    <h4><b>Nancy Doe</b> Deleted account</h4>
                                    <p><i class="zmdi zmdi-time"></i> 3 hours ago </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle bg-green"><i class="zmdi zmdi-edit"></i></div>
                                <div class="menu-info">
                                    <h4><b>Nancy</b> Changed name</h4>
                                    <p><i class="zmdi zmdi-time"></i> 2 hours ago </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle bg-grey"><i class="zmdi zmdi-comment-text"></i></div>
                                <div class="menu-info">
                                    <h4><b>John</b> Commented your post</h4>
                                    <p><i class="zmdi zmdi-time"></i> 4 hours ago </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle bg-purple"><i class="zmdi zmdi-refresh"></i></div>
                                <div class="menu-info">
                                    <h4><b>John</b> Updated status</h4>
                                    <p><i class="zmdi zmdi-time"></i> 3 hours ago </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="icon-circle bg-light-blue"><i class="zmdi zmdi-settings"></i></div>
                                <div class="menu-info">
                                    <h4>Settings Updated</h4>
                                    <p><i class="zmdi zmdi-time"></i> Yesterday </p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="footer"> <a href="javascript:void(0);">View All Notifications</a> </li>
            </ul>
        </li>

        <li><a href="javascript:void(0);" class="app_calendar" title="Calendar"><i class="zmdi zmdi-calendar"></i></a></li>
        <li><a href="javascript:void(0);" class="app_google_drive" title="Google Drive"><i class="zmdi zmdi-google-drive"></i></a></li>
        <li><a href="javascript:void(0);" class="app_group_work" title="Group Work"><i class="zmdi zmdi-group-work"></i></a></li>
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
            <li><a  class="menu-toggle"><i class="zmdi zmdi-assignment-account"></i><span>Clientes</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('clientes_home')}}" id="keyAss">Gestionar Clientes</a></li>
                    <li><a href="chat.html">Actividad de CLientes</a></li> 
                </ul>
            </li>
            @endif
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Atencion</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('atencion_home')}}">Registrar atencion</a></li>
                    <li><a href="{{route('AtenPendientes_home')}}">Pendintes</a></li>
                    <li><a href="{{route('ventasPasadas_home')}}">Ventas realizadas</a></li>
                </ul>
            </li>
            <a href="{{route('reportes_home')}}" class=><i class="zmdi zmdi-tablet"></i><span>Reportes</span></a>
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-chart"></i><span>Reportes</span></a>
                <ul class="ml-menu">
                    <li><a href="file-dashboard.html"></a></li>
                    <li><a href="file-documents.html">Documents</a></li>
                    <li><a href="file-images.html">Images</a></li>
                    <li><a href="file-media.html">Media</a></li>
                </ul>
            </li>


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
                    <h6>Theme Option</h6>
                    <div class="light_dark">
                        <div class="radio">
                            <input type="radio" name="radio1" id="lighttheme" value="light" checked="">
                            <label for="lighttheme">Light Mode</label>
                        </div>
                        <div class="radio mb-0">
                            <input type="radio" name="radio1" id="darktheme" value="dark">
                            <label for="darktheme">Dark Mode</label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h6>Color Skins</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple"><div class="purple"></div></li>
                        <li data-theme="blue"><div class="blue"></div></li>
                        <li data-theme="cyan" id="btnthemeHome" ><div class="cyan"></div></li>
                        <li data-theme="green"><div class="green"></div></li>
                        <li data-theme="orange"><div class="orange"></div></li>
                        <li data-theme="blush" class="active"><div class="blush"></div></li>
                    </ul>
                </div>
                <div class="card">
                    <h6>General Settings</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">Report Panel Usage</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox2" type="checkbox" checked="">
                                <label for="checkbox2">Email Redirect</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox3" type="checkbox" checked="">
                                <label for="checkbox3">Notifications</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox4" type="checkbox">
                                <label for="checkbox4">Auto Updates</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox5" type="checkbox" checked="">
                                <label for="checkbox5">Offline</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox6" type="checkbox" checked="">
                                <label for="checkbox6">Location Permission</label>
                            </div>
                        </li>
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