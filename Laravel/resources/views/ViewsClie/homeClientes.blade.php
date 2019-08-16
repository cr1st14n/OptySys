@extends('layouts.appSystem')
 @section('head')
     <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
 @endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Clientes registrados</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i>Clientes</a></li>
                        <li class="breadcrumb-item active">Registro</li>
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
                            <h2><strong>Usuarios</strong> registrados</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="setting">
                                        <a class="btn  btn-info" id="btnModalAgregarCliente"><i class="zmdi zmdi-account-add"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="input-group ">
                                        <input id="atenCI" type="text" name="antenCI" class="form-control" value="" placeholder="CI / NIT" oninput="validar('atenCI')" onkeyup="buscarCI('atenCI')" required="" pattern="[0-9]{1,10}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="input-group-addon"> <i class="">#</i> </span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="input-group ">
                                        <input type="text" class="form-control" value="" placeholder="nombres / apellidos" id="atenText" oninput="validar('atenText')" onkeyup="buscartext('atenText')" required="" pattern="[0A-Za-z\s]+">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listClie1">
                                    <thead>
                                    <tr>
                                        <th>Cod</th>
                                        <th>Nombre Apellido</th>
                                        <th>CI / NIT</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="listclie">
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
                                <label for="apPaterno">Apellidos Paterno</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="apellido" class="form-control " placeholder="..." required pattern="[A-Za-z\s]+" oninput="validar('apellido')">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="apPaterno">Apellidos Materno</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="apellido2" class="form-control " placeholder="..."  pattern="[A-Za-z\s]+" oninput="validar('apellido2')">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-2 col-sm-4 form-control-label">
                                <label for="apPaterno">Fecha nacimiento</label>
                            </div>
                            <div class="col-lg-9 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="date" id="fechaNacimiento" class="form-control " placeholder="..." required oninput="validar('fechaNacimiento')">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="apPaterno">Telefono  Celular </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="TelfCel" class="form-control " placeholder="..." required pattern="[0-9]+" oninput="validar('TelfCel')">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-round waves-effect" id="btnRegistrarCliente">Registrar</button>
                        </div>
                    </form>
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
                    <form class="form-horizontal" id="formUpdate-cliente">
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
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="apPaterno">Apellidos Materno</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="apellido2_update" class="form-control " placeholder="..."  pattern="[A-Za-z\s]+" oninput="validar('apellido2_update')">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-2 col-sm-4 form-control-label">
                                <label for="apPaterno">Fecha nacimiento</label>
                            </div>
                            <div class="col-lg-9 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="date" id="fechaNacimiento_update" class="form-control " placeholder="..." required oninput="validar('fechaNacimiento_update')">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="apPaterno">Telefono  Celular </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="TelfCel_update" class="form-control " placeholder="..." required pattern="[0-9]+" oninput="validar('TelfCel_update')" maxlength="15">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-round waves-effect" id="btnActualizarCliente">Actualizar Datos</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal historiaCliente cliente====== -->
    <div class="modal fade " id="ModalHistoriaCliente" tabindex="-1" role="document">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Regsitro de Atencion del cliente</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tableHistClie">
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>--}}
                    {{--<button type="button" class="btn btn-success btn-round waves-effect" id="btnActualizarCliente">Actualizar Datos</button>--}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal historiaClienteDetalle cliente====== -->
    <div class="modal fade " id="ModalHistoriaClienteDetalle" tabindex="-1" role="document">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Detalle ORDEN DE TRABAJO</h4>
                </div>
                <div class="modal-body">
                    <p>Fecha entreg: <text id="aten_fecha2" style="font-family: 'Arial Black';">...</text>, Precio: <text id="aten_precio" style="font-family: 'Arial Black';">...</text>, A cuenta: <text id="aten_aCuenta" style="font-family: 'Arial Black';">...</text>, Saldo: <text id="aten_Saldo" style="font-family: 'Arial Black';">...</text><br>
                    Cristales: <text id="da_cristales" style="font-family: 'Arial Black';">...</text>, Armazon: <text id="da_armazon" style="font-family: 'Arial Black';">...</text>, Organicos: <text id="da_organicos" style="font-family: 'Arial Black';">...</text>, Tinte: <text id="da_tinte" style="font-family: 'Arial Black';">...</text>, U.V. : <text id="da_uv" style="font-family: 'Arial Black';">...</text>, PCR: <text  id="da_pcr" style="font-family: 'Arial Black';">...</text> <br>
                    <hr>
                    Lejos <br>
                    O.D. Est: <text id="da_lejosODest" style="font-family: 'Arial Black';">...</text>, Cil: <text id="da_lejosODCil" style="font-family: 'Arial Black';">...</text>, Eje: <text id="da_lejosODEje" style="font-family: 'Arial Black';">...</text>, Dip:<text id="da_lejosODDip" style="font-family: 'Arial Black';">...</text>mm <br>
                    O.L. Est: <text id="da_lejosOLest" style="font-family: 'Arial Black';">...</text>, Cil: <text id="da_lejosOLCil" style="font-family: 'Arial Black';">...</text>, Eje: <text id="da_lejosOLEje" style="font-family: 'Arial Black';">...</text>, Dip:<text id="da_lejosOLDip" style="font-family: 'Arial Black';">...</text>mm <br>
                    <hr>
                    Cerca <br>
                    O.D. Est: <text id="da_cercaODest" style="font-family: 'Arial Black';">...</text>, Cil: <text id="da_cercaODCil" style="font-family: 'Arial Black';">...</text>, Eje: <text id="da_cercaODEje" style="font-family: 'Arial Black';">...</text>, Dip:<text id="da_cercaODDip" style="font-family: 'Arial Black';">...</text>mm <br>
                    O.L. Est: <text id="da_cercaOLest" style="font-family: 'Arial Black';">...</text>, Cil: <text id="da_cercaOLCil" style="font-family: 'Arial Black';">...</text>, Eje: <text id="da_cercaOLEje" style="font-family: 'Arial Black';">...</text>, Dip:<text id="da_cercaOLDip" style="font-family: 'Arial Black';">...</text>mm <br>
                    <hr>
                    Vifocales: <text id="da_focales" style="font-family: 'Arial Black';">...</text>, otros: <text id="da_otros" style="font-family: 'Arial Black';">...</text>, Alt: <text id="da_alt" style="font-family: 'Arial Black';">...</text>mm, Ad+: <text id="da_ad" style="font-family: 'Arial Black';">...</text> <br>
                    Doctor: <text id="da_doctor" style="font-family: 'Arial Black';">...</text>, Estuche: <text id="da_estuche" style="font-family: 'Arial Black';">...</text>, Observaciones: <text id="da_observaciones" style="font-family: 'Arial Black';">...</text>
                    </p>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>--}}
                    {{--<button type="button" class="btn btn-success btn-round waves-effect" id="btnActualizarCliente">Actualizar Datos</button>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scrypt')
    <link rel="stylesheet" href="{{ asset('Plantilla/assets/bundles/datatablescripts.bundle.js') }}">
    <script src="{{asset('AsincronoJS/clientes.js')}}"></script>
    <!-- <script>
        $(document).ready(function () {

            $('#listClie1').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : true,
                "scrollY":        "30vh",
                "scrollCollapse": true,
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "Nothing found - sorry",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script> -->
@endsection