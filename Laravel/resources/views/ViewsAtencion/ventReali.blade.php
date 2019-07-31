@extends('layouts.appSystem')
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Registro de ventas</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i>Atencion</a></li>
                        <li class="breadcrumb-item active">registro ventas</li>
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
                            <h2><strong>Buscar</strong> Ventas pasadas</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                    <button class="btn  btn-default btn-sm" id="btnModalFS" >Filtrar por una fecha especifica</button>
                                    <button class="btn  btn-default btn-sm" id="btnModalFC">Filtrar por rango de fechas</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        {{--<th>Cod</th>--}}
                                        <th>Nombre Apellido</th>
                                        <th>CI / NIT</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Encargado</th>
                                        <th>Ci Encargado</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableVentasPasadas">
                                    </tbody>
                                </table>
                            </div>
                            {{--<div>
                                <form action="#" id="formpeliculas">
                                    <input type="text" id="addPelicula" required>
                                    <button type="submit">agregar</button>
                                </form>
                                <h2>Peliculas</h2>
                                <div id="Peliculas">
                                    <ul id="peliculasList">

                                    </ul>
                                </div>
                                <h1>borrar tu pelicula</h1>
                                <form action="#" id="formpeliculasBorrar">
                                    <input type="text" id="borrrarPelicula" required>
                                    <button type="submit">borrar</button>
                                </form>
                            </div>
                            <div id="lugar">
                            </div>
                            <div id="sector2">
                                <h2 id="lec2"></h2>
                            </div>
                            <button id="btnPru" onclick="cargarLugar()">click aca</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dialogs ====== -->
    <!-- Modal fecha simple ====== -->
    <div class="modal fade" id="ModalFilFechSimple" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Seleccionar fecha</h4>
                </div>
                <div class="modal-body">
                    <form id="formFechaSimple">
                        <label>Date</label>
                        <div class="input-group masked-input">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control date" placeholder="dd/mm/YYY" id="fecha1Simple" >
                        </div>
                    </form>
                </div>
                <div >
                    <label id="text"></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-round waves-effect" onclick="filtrarFS()">Buscar</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal fecha compleja ====== -->
    <div class="modal fade" id="ModalFilFechCompleja" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">seleccionar rango de fechas</h4>
                </div>
                <div class="modal-body">
                    <form id="formFechaRango">
                        <label>Date</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group masked-input">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control date" id="fecha1C" placeholder="dd/mm/yyyy">
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="input-group masked-input">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control date" id="fecha2C" placeholder="dd/mm/yyyy">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-round waves-effect" onclick="filtrarFC()">Buscar</button>
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
    <script src="{{asset('AsincronoJS/ventasRealizadas.js')}}"></script>
@endsection