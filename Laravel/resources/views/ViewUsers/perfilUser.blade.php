@extends('layouts.appSystem')

@section('content')
<div class="body_scroll">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Perfil de usuario</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i>OptySys</a></li>
                    <li class="breadcrumb-item active">Datos de usuario</li>
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
            <div class="col-lg-4 col-md-12">
                <div class="card mcard_3">
                    <div class="body">
                        <a href="profile.html"><img src="{{ asset('Plantilla/assets/images/avatar5.png') }}" class="rounded-circle shadow " alt="profile-image"></a>
                        <h4 class="m-t-10">{{Auth::user()->usu_nombre}} {{Auth::user()->usu_appaterno}}</h4>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted">Datos de ventas generales</p>
                            </div>
                            <div class="col-4">
                                <small>Ventas Realizadas</small>
                                <h5>852</h5>
                            </div>
                            <div class="col-4">
                                <small>Ventas Pendientes</small>
                                <h5>13k</h5>
                            </div>
                            <div class="col-4">
                                <small>Clientes Registrados</small>
                                <h5>234</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="body" id="perfiluserDiv">
                        <small class="text-muted">Nombre: </small>
                        <p>{{Auth::user()->usu_nombre}} {{Auth::user()->usu_appaterno}} {{Auth::user()->usu_apmaterno}}</p>
                        <hr>
                        <small class="text-muted">C.I.: </small>
                        <p>{{Auth::user()->usu_ci}}</p>
                        <hr>
                        <small class="text-muted">Acceso al Modulo: </small>
                        <p>{{Auth::user()->usu_modulo}}</p>
                        <hr>
                        <small class="text-muted">Cargo: </small>
                        <p>{{Auth::user()->usu_cargo}}</p>
                        <hr>
                        <button class="btn " onclick="showEditUsu()">Actualizar datos</button>
                        <button class="btn " onclick="refreshPerfil()">Cambiar Contraseña</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dialogs ====== -->
<!-- Modal create atencion ====== -->
<div class="modal fade" id="ModaleditUsu" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Actualizar mis datos</h4>
                <input type="text" id="usu_id" required value="{{Auth::user()->id}}" hidden>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="">
                        <label># de C.I.</label>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="zmdi zmdi-cut"></i></span>
                            </div>
                            <input type="text" class="form-control" id="usu_ci" required oninput="validar(this.id)" autocomplete="off" value="{{Auth::user()->usu_ci}}">
                        </div>
                    </div>
                    <div class="">
                        <label>Nombre</label>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="zmdi zmdi-cut"></i></span>
                            </div>
                            <input type="text" class="form-control" id="usu_nombre" required oninput="validar(this.id)" autocomplete="off" value="{{Auth::user()->usu_nombre}}">
                        </div>
                    </div>
                    <div class="">
                        <label>Apellido Paterno:</label>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="zmdi zmdi-cut"></i></span>
                            </div>
                            <input type="text" class="form-control" id="usu_appaterno" required oninput="validar(this.id)" autocomplete="off" value="{{Auth::user()->usu_appaterno}}">
                        </div>
                    </div>
                    <div class="">
                        <label>Apellido Materno:</label>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="zmdi zmdi-cut"></i></span>
                            </div>
                            <input type="text" class="form-control" id="usu_apmaterno" required oninput="validar(this.id)" autocomplete="off" value="{{Auth::user()->usu_apmaterno}}">
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>--}}
                <button type="button" class="btn btn-success btn-round waves-effect"  onclick="updateUsu()">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal create cliente====== -->
<div class="modal fade" id="ModalResetKey" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Datos del nuevo usuario</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                            <label for="ci">Numero CI / NIT</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8">
                            <div class="form-group">
                                <input type="text" id="ci_nit" class="form-control " placeholder="# ### ###" oninput="validar('ci_nit')" minlength="4" maxlength="10" pattern="[0-9]+" required>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8">
                            <div class="form-group">
                                <input type="text" id="nombre" class="form-control " placeholder=".." required minlength="3" pattern="[A-Za-z\s]+" oninput="validar('nombre')">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                            <label for="apPaterno">Apellidos</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8">
                            <div class="form-group">
                                <input type="text" id="apellido" class="form-control " placeholder="..." required pattern="[A-Za-z\s]+" oninput="validar('apellido')">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                {{--<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>--}}
                <button type="button" class="btn btn-success btn-round waves-effect" id="btnRegistrarCliente">Registrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal actualizar cliente====== -->
<div class="modal fade" id="ModalUpdateCliente" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Actualizar datos</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                            <label for="ci">Numero CI</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8">
                            <div class="form-group">
                                <input type="text" id="ci_update" class="form-control " placeholder="# ### ###"  oninput="validar('ci_update')" minlength="4" maxlength="10" required>
                                <input type="number" id="id_updater_clie" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                            <label for="nombre_update">Nombre</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8">
                            <div class="form-group">
                                <input type="text" id="nombre_update" class="form-control " placeholder="..." required minlength="3" pattern="[A-Za-z\s]+" oninput="validar('nombre_update')">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                            <label for="apPaterno_update">Apellido Paterno</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8">
                            <div class="form-group">
                                <input type="text" id="apellido_update" class="form-control " placeholder="..."  pattern="[A-Za-z\s]+" oninput="validar('apPaterno_update')">
                            </div>
                        </div>
                    </div>
                    <hr>
                </form>
            </div>

            <div class="modal-footer">
                {{--<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>--}}
                <button type="button" class="btn btn-success btn-round waves-effect" id="btnActualizarCliente">Actualizar Datos</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scrypt')
    <script src="{{asset('AsincronoJS/perfilUsuario.js')}}"></script>
@endsection