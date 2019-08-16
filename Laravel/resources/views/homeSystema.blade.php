@extends('layouts.appSystem')

@section('content')
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Inicio</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item active">Dashboard 1</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                @if(Auth::User()->usu_cargo=="Administrador")
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon zmdi-account">
                        <div class="body">
                            <h6>Usuarios</h6>
                            <h2>{{$user}} <small class="info">Usuarios registrados</small></h2>
                            {{--<small>2% higher than last month</small>--}}
                            <div class="progress">
                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon zmdi-account-box-mail">
                        <div class="body">
                            <h6>Clientes</h6>
                            <h2>{{$clientes}} <small class="info">Registrados</small></h2>
                            {{--<small>6% higher than last month</small>--}}
                            <div class="progress">
                                <div class="progress-bar l-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width: 18%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon zmdi-shopping-cart">
                        <div class="body">
                            <h6>Ventas</h6>
                            <h2>{{$ventas}} <small class="info">Ventas realizadas</small></h2>
                            {{--<small>Total Registered email</small>--}}
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100" style="width: 39%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12" >
                    <div class="card widget_2 big_icon zmdi-shopping-cart-plus">
                        <div class="body">
                            <h6>pendientes</h6>
                            <h2>{{$pendientes}} <small class="info">Ventas pendientes</small></h2>
                            {{--<small>Total Registered Domain</small>--}}
                            <div class="progress">
                                <div class="progress-bar l-green" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12" id="clientesDescuento">
                    <div class="card widget_2 big_icon zmdi-shopping-cart-plus">
                        <div class="body">
                            <h6>Descuentos</h6>
                            <h2>{{$userDescuento}} <small class="info">Clientes</small></h2>
                            <button class="btn btn-block btn-info btn-sm">Clientes con Descuento</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card mcard_4">
                        <div class="body">
                            <ul class="header-dropdown list-unstyled">

                            </ul>
                            <div class="img">
                                <img src="{{asset('Plantilla/assets/images/optica33.png')}}" class="rounded-circle" alt="profile-image">
                            </div>
                            <div class="user">
                                <h5 class="mt-3 mb-1">Sistema</h5>
                                <small class="text-muted">OptySys</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-clienteDescuento" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">      
            <div class="modal-body"> 
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Clientes</strong> Con descuento por su cumpleaños <small>Estos clientes cuentan con 20% descuento</small></h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table m-b-0">
                                        <thead class="thead-light">
                                            <tr>
                                            <th scope="col"># Carnet</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellidos</th>
                                            <th scope="col">Motivo descuento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($clieDescuentoNombre as $clie)
                                            <tr>
                                                <th scope="row">{{$clie->vent_clienteNit}}</th>
                                                <td>{{$clie->vent_clienteNombre}}</td>
                                                <td>{{$clie->vent_clienteApellido}} {{$clie->vent_clienteApellido2}}</td>
                                                <td>Cumpleaños</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scrypt')
@endsection


