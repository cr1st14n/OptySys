@extends('layouts.appSystem')

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Registro de Pagos</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i>Clientes</a></li>
                        <li class="breadcrumb-item active">Pagos</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Pagos</strong> pendientes</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>CI / NIT</th>
                                        <th>Nombre Apellido</th>
                                        <th>Fecha entrega</th>
                                        <th>Precio</th>
                                        <th>A Cuenta</th>
                                        <th>Saldo</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="listPenAten" >

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dialogs ====== -->
    <!-- Modal edit atencion ====== -->
    <div class="modal fade" id="ModalEditAtencion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">ORDEN DE TRABAJO</h4>
                    <input type="text" id="cod_clie" required  hidden>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6">
                            <label>Fecha de entrega</label>
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="zmdi zmdi-calendar-note"></i></span>
                                </div>
                                <input type="text" class="form-control datetime" id="aten_fecha2" required oninput="validar(this.id)">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Precio:</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="aten_precio" onkeyup="validar(this.id)" oninput="calcularSaldo()" pattern="[0-9]+" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Bs.-</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label>A cuenta:</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="aten_aCuenta" onkeyup="validar(this.id)" pattern="[0-9]+" required oninput="calcularSaldo()">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Bs.-</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label>Saldo:</label>
                            <p id="saldoAtencion"></p>
                            <input type="number" id="saldoAte" hidden>
                            {{--<div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="aten_Saldo" oninput="validar(this.id)" pattern="[0-9]+" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Bs.-</span>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                    <hr>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6">
                            <label>Cristales</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="da_cristales">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <label>Armazon</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="da_armazon">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6">
                            <label>Organicos</label>
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="zmdi zmdi-usb"></i></span>
                                </div>
                                <input type="text" class="form-control" id="da_organicos">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label>Tinte</label>
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="zmdi zmdi-key"></i></span>
                                </div>
                                <input type="text" class="form-control" id="da_tinte">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label>U.V.</label>
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="zmdi zmdi-key"></i></span>
                                </div>
                                <input type="text" class="form-control" id="da_uv">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label>PCR</label>
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="zmdi zmdi-key"></i></span>
                                </div>
                                <input type="text" class="form-control" id="da_pcr">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p>LEJOS</p>
                    <div class="row clearfix ">
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">O.D. Est </span>
                                </div>
                                <input type="text" class="form-control"id="da_lejosODest" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">CIL</span>
                                </div>
                                <input type="text" class="form-control" id="da_lejosODCil" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">EJE</span>
                                </div>
                                <input type="text" class="form-control" id="da_lejosODEje" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">DIP</span>
                                </div>
                                <input type="text" class="form-control" id="da_lejosODDip" oninput="validar(this.id)" pattern="[0-9+-]+">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">mm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">O.D. Est </span>
                                </div>
                                <input type="text" class="form-control" id="da_lejosOLest" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">CIL</span>
                                </div>
                                <input type="text" class="form-control" id="da_lejosOLCil" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">EJE</span>
                                </div>
                                <input type="text" class="form-control" id="da_lejosOLEje" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">DIP</span>
                                </div>
                                <input type="text" class="form-control" id="da_lejosOLDip" oninput="validar(this.id)" pattern="[0-9+-]+">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">mm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>CERCA</p>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">O.D. Est </span>
                                </div>
                                <input type="text" class="form-control" id="da_cercaODest" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">CIL</span>
                                </div>
                                <input type="text" class="form-control" id="da_cercaODCil" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">EJE</span>
                                </div>
                                <input type="text" class="form-control" id="da_cercaODEje" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">DIP</span>
                                </div>
                                <input type="text" class="form-control" id="da_cercaODDip" oninput="validar(this.id)" pattern="[0-9+-]+">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">mm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">O.D. Est </span>
                                </div>
                                <input type="text" class="form-control" id="da_cercaOLest" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">CIL</span>
                                </div>
                                <input type="text" class="form-control" id="da_cercaOLCil" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">EJE</span>
                                </div>
                                <input type="text" class="form-control" id="da_cercaOLEje" oninput="validar(this.id)" pattern="[0-9+-]+">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">DIP</span>
                                </div>
                                <input type="text" class="form-control" id="da_cercaOLDip" oninput="validar(this.id)" pattern="[0-9+-]+">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">mm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6">
                            <label>Vifocales</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="da_focales">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label>Otros</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="da_otros">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label>Alt</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="da_alt">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">mm</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label>Ad+</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control" id="da_ad">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6">
                            <label>Doctor</label>
                            <div class="input-group masked-input mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Dr.</span>
                                </div>
                                <input type="text" class="form-control" id="da_doctor">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label>Estuche</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control " id="da_estuche" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label>Observaciones</label>
                            <div class="input-group masked-input mb-3">
                                <input type="text" class="form-control"  id="da_observaciones">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>--}}
                    <button type="button" class="btn btn-danger btn-round waves-effect" id="btnEditClie" name="" onclick="updatePedido(this.name)">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create cliente====== -->
    <div class="modal fade" id="ModalCreateCliente" tabindex="-1" role="dialog">
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
    <script src="{{asset('AsincronoJS/penAtencion.js')}}"></script>
@endsection