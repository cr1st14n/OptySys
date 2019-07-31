@extends('layouts.appSystem')
@section('head')
     <link rel="stylesheet" href="{{ asset('Plantilla/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
 @endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Registro de usuarios</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i>Usuarios</a></li>
                        <li class="breadcrumb-item active">Registro</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="row" id="aniLoader">
            
        </div>
                
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Usuarios</strong> registrados</h2>
                        </div>
                        <div class="body">
                            <div class="setting">
                                <a class="btn  btn-info" id="btnAgregarUsuario"><i class="zmdi zmdi-account-add"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Cod</th>
                                        <th>Nombre Apellido</th>
                                        <th>CI</th>
                                        <th>Cargo</th>
                                        <th>Acceso</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="listUser">
                                   <!--  {{--@foreach($listUsers as $user)--}}
                                        {{--<tr>--}}
                                            {{--<th scope="row">Usu-{{$user->id}}</th>--}}
                                            {{--<td>{{$user->usu_nombre}} {{$user->usu_appaterno}} {{$user->usu_apmaterno}}</td>--}}
                                            {{--<td>{{$user->usu_ci}}</td>--}}
                                            {{--<td>{{$user->usu_cargo}}</td>--}}
                                            {{--@if($user->usu_acceso == 1)--}}
                                            {{--<td><span class="col-green">Permitido</span></td>--}}
                                            {{--@else--}}
                                            {{--<td><span class="col-red">Denegado</span></td>--}}
                                            {{--@endif--}}
                                            {{--<td>--}}
                                                {{--@if($user->usu_acceso == 1)--}}
                                                    {{--<button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="accesoUser({{$user->id}});"><i class="zmdi zmdi-lock-open"></i></button>--}}
                                                {{--@else--}}
                                                    {{--<button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="accesoUser({{$user->id}});"><i class="zmdi zmdi-lock"></i></button>--}}
                                                {{--@endif--}}
                                                {{--<button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="actualizarUser({{$user->id}});"><i class="zmdi zmdi-edit"></i></button>--}}
                                                {{--<button class="btn btn-default waves-effect waves-float btn-sm waves-red" onclick="eliminarUsuario({{$user->id}});"><i class="zmdi zmdi-delete"></i></button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}} -->
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
    <!-- Modal create usuario====== -->
    <div class="modal fade" id="ModalCreateUsuario" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Datos del nuevo usuario</h4>
                </div>
                <div class="modal-body" id="formCreateUser">
                    <!-- <form class="form-horizontal">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="ci">Numero CI</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="number" id="ci" class="form-control " placeholder="# de carnet de identidad" oninput="validar('ci')" minlength="4" maxlength="10" required>
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
                                <label for="apPaterno">Apellido Paterno</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="apPaterno" class="form-control " placeholder="..." required pattern="[A-Za-z\s]+" oninput="validar('nombre')">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="apMaterno">Apellido Materno</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="apMaterno" class="form-control " placeholder="..." pattern="[A-Za-z\s]+" oninput="validar('nombre')">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="radio">
                            <input type="radio" name="acceso" id="radio2" value="1" checked="">
                            <label for="radio2">
                                Permitir acceso al sistema
                            </label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="acceso" id="radio1" value="0">
                            <label for="radio1">
                                Denegar Acceso al sistema
                            </label>
                        </div>
                        <hr>
                        <div class="row clearfix">
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <label for="cargo">Seleccionar cargo</label>
                            </div>    
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <select name="" id="">
                                    <option value="">-- Please select --</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Operador">Operador</option>
                                    <option value="Atencion">Atencion</option>
                                </select>
                            </div>
                        </div>
                    </form> -->
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button> -->
                    <button type="button" class="btn btn-success btn-round waves-effect" id="btnRegistrarUsuario">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal actualizar usuario====== -->
    <div class="modal fade" id="ModalUpdateUsuario" tabindex="-1" role="dialog">
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
                                    <input type="number" id="ci_update" class="form-control " placeholder="# de carnet de identidad" oninput="validar('ci_update')" minlength="4" maxlength="10" required>
                                    <input type="number" id="id_updater_user" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="nombre_update">Nombre</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="nombre_update" class="form-control " placeholder=".." required minlength="3" pattern="[A-Za-z\s]+" oninput="validar('nombre_update')">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="apPaterno_update">Apellido Paterno</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="apPaterno_update" class="form-control " placeholder="..." required pattern="[A-Za-z\s]+" oninput="validar('apPaterno_update')">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                <label for="apMaterno_update">Apellido Materno</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <input type="text" id="apMaterno_update" class="form-control " placeholder="..." pattern="[A-Za-z\s]+" oninput="validar('apMaterno_update')">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <p> <b>Seleccionar Cargo</b> </p>
                                <div id="selectUpdate">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button> -->
                    <button type="button" class="btn btn-success btn-round waves-effect" id="btnActualizarrUsuario">Actualizar Datos</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scrypt')
    <script src="{{asset('AsincronoJS/usuarios.js')}}"></script>
@endsection