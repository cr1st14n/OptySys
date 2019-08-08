alertify.set('notifier', 'position', 'top-right');
$(function() {
    $('#btnAgregarUsuario').on('click', openModalCreateUser);
    $('#btnRegistrarUsuario').on('click', registrarUsuario);
    $('#btnActualizarrUsuario').on('click', updateUser);
});
// listUser();
setTimeout(() => {listUser();}, 500);
function validar(id) {
    var elemento = document.getElementById(id);
    if (elemento.checkValidity()) {
        elemento.style.borderColor = "green";
        elemento.style.backgroundColor = "";

    } else if (elemento.value == "") {
        elemento.style.borderColor = "";
        elemento.style.backgroundColor = "";
    } else {
        elemento.style.borderColor = "red";
        elemento.style.backgroundColor = "#ffd3d3";
    }
}

function showListUser(data) {
    var html = data.map(function(elem, index) {
        if (elem.usu_acceso == 1) { acceso = '<span class="col-green">Permitido</span>' } else { acceso = '<span class="col-red">Denegado</span>' }
        if (elem.usu_acceso == 1) { accesobut = '<i class="zmdi zmdi-lock-open"></i>' } else { accesobut = '<i class="zmdi zmdi-lock"></i>' }
        return (`<tr>
                      <th scope="row">Usu-${elem.id}</th>
			          <td>${elem.usu_nombre}  ${ VN(elem.usu_appaterno)}  ${VN(elem.usu_apmaterno)}</td>
			          <td>${elem.usu_ci}</td>
			          <td>${elem.usu_cargo}</td>
			          <td>${acceso}</td>
			          <td>
			            <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="accesoUser(${elem.id});">${accesobut}</i></button>
                        <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="actualizarUser(${elem.id});"><i class="zmdi zmdi-edit"></i></button>
                        <button class="btn btn-default waves-effect waves-float btn-sm waves-red" onclick="eliminarUsuario(${elem.id});"><i class="zmdi zmdi-delete"></i></button>
                      </td>
		   	        </tr>`);
    }).join(" ");
    document.getElementById('listUser').innerHTML = html;
}

function listUser() {
    $.get('/adm/usuarios/store').done(function(data) {
        showListUser(data);
        // $('#listUser').html("");
        // for (var i = data.length - 1; i >= 0; i--) {
        //     if (data[i].usu_acceso == 1){acceso='<span class="col-green">Permitido</span>'}else {acceso='<span class="col-red">Denegado</span>'}
        //     if (data[i].usu_acceso == 1){accesobut='<i class="zmdi zmdi-lock-open"></i>'}else {accesobut='<i class="zmdi zmdi-lock"></i>'}
        //     var tr = `<tr>
        //               <th scope="row">Usu-`+data[i].id+`</th>
        // 	          <td>`+data[i].usu_nombre+'  '+data[i].usu_appaterno+'  '+data[i].usu_apmaterno+`</td>
        // 	          <td>`+data[i].usu_ci+`</td>
        // 	          <td>`+data[i].usu_cargo+`</td>
        // 	          <td>`+acceso+`</td>
        // 	          <td>
        // 	            <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="accesoUser(`+data[i].id+`);">`+accesobut+`</i></button>
        //                 <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="actualizarUser(`+data[i].id+`);"><i class="zmdi zmdi-edit"></i></button>
        //                 <button class="btn btn-default waves-effect waves-float btn-sm waves-red" onclick="eliminarUsuario(`+data[i].id+`);"><i class="zmdi zmdi-delete"></i></button>
        //               </td>
        //    	        </tr>`;
        //     $("#listUser").append(tr)
        //
        // }
    }).fail(function() {
        console.log("error server list user")
    });
}

function openModalCreateUser() {
    var form = `<form class="form-horizontal">
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
                            <select name="" id="" class="form-control show-tick">
                                <option value="">-- Seleccionar --</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Operador">Operador</option>
                                <option value="Atencion">Atencion</option>
                            </select>
                        </div>
                    </div>
                </form>`;
    var aniLoad= `<div class="loader-container" align="center">
                    <div class="loader"></div>
                    <div class="loader2"></div>
                </div>`;
    
    document.getElementById('formCreateUser').innerHTML=aniLoad;
    $('#ModalCreateUsuario').modal('show');
    setTimeout(() => {
        document.getElementById('formCreateUser').innerHTML=form;                        
    }, 1000);                

}

function registrarUsuario() {
    var ciV = document.getElementById('ci').checkValidity();
    var nombreV = document.getElementById('nombre').checkValidity();
    var appaternoV = document.getElementById('apPaterno').checkValidity();
    var apmaternoV = document.getElementById('apMaterno').checkValidity();
    var cargoV = document.getElementById('nombre').checkValidity();

    var ci = document.getElementById('ci').value;
    var nombre = document.getElementById('nombre').value;
    var appaterno = document.getElementById('apPaterno').value;
    var apmaterno = document.getElementById('apMaterno').value;
    var cargo = document.getElementById('cargo').value;
    var acceso = $('input[name="acceso"]:checked').val();
    if (ciV && nombreV && appaternoV && apmaternoV && cargoV) {
        // alert("success");
        // console.log(ci+nombre+appaterno+apmaterno+cargo);
        var url = '/adm/usuarios/create';
        DatosPost = {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'ci': ci,
            'nombre': nombre,
            'appaterno': appaterno,
            'apmaterno': apmaterno,
            'cargo': cargo,
            'acceso': acceso
        };
        $.post(url, DatosPost).done(function(data) {
            // console.log(data);
            if (data == "creado") {
                // console.log("usu creado");
                $('#ModalCreateUsuario').modal('hide');
                listUser();
                document.getElementById('ci').value = "";
                document.getElementById('nombre').value = "";
                document.getElementById('apPaterno').value = "";
                document.getElementById('apMaterno').value = "";
                alertify.success("Usuario creado exitosamente");

            } else if (data == "creadoError") {
                // console.log("creado de usu error")
                alertify.error("Error, vuela a intentarlo");
            } else if (data == "duplicado") {
                console.log("usu duplicado");
                alertify.error("CI ya registrado!");
            }


        }).fail(function() {
            console.log("error de server CREATE USER");
        });


    } else {
        alert("error en formulario");
    }
}

function actualizarUser(id) {
    $.get('/adm/usuarios/show/' + id + '').done(function(data) {
        // $('input:radio[name:"acceso"]').filter('[value=1]').attr('checked',true);
        document.getElementById('ci_update').value = data.usu_ci;
        document.getElementById('nombre_update').value = data.usu_nombre;
        document.getElementById('apPaterno_update').value = data.usu_appaterno;
        document.getElementById('apMaterno_update').value = data.usu_apmaterno;
        document.getElementById('id_updater_user').value = data.id;
        /*if (data.usu_acceso == 1){
            $("#radio22").prop("checked",true);
        } else {
            $("#radio11").prop("checked",true);
        }*/
        $('#ModalUpdateUsuario').modal('show');

        var carg = data.usu_cargo;
        switch (carg) {
            case "Administrador":
                var html_select = '<select id="cargoUpdate" class=" show-tick ms select2" style="width: 250px"  required >' +
                    '<option value="Administrador" selected>Administrador</option>' +
                    '<option value="Operador">Operador</option>' +
                    '<option value="Atencion">Atencion</option>' +
                    '</select>';
                $('#selectUpdate').html(html_select);
                break;
            case "Operador":
                var html_select = '<select id="cargoUpdate" class=" show-tick ms select2" style="width: 250px"  required >' +
                    '<option value="Administrador">Administrador</option>' +
                    '<option value="Operador" selected>Operador</option>' +
                    '<option value="Atencion">Atencion</option>' +
                    '</select>';
                $('#selectUpdate').html(html_select);
                break;
            case "Atencion":
                var html_select = '<select id="cargoUpdate" class=" show-tick ms select2" style="width: 250px"  required >' +
                    '<option value="Administrador">Administrador</option>' +
                    '<option value="Operador">Operador</option>' +
                    '<option value="Atencion" selected>Atencion</option>' +
                    '</select>';
                $('#selectUpdate').html(html_select);
                break;
        }

    }).fail(function() {
        // console.log("ERROR SERVER SHOW EDIT USER");
        alertify.error("ERROR SERVER SHOW EDIT USER");
    });

}

function updateUser() {
    var ciV = document.getElementById('ci_update').checkValidity();
    var nombreV = document.getElementById('nombre_update').checkValidity();
    var appaternoV = document.getElementById('apPaterno_update').checkValidity();
    var apmaternoV = document.getElementById('apMaterno_update').checkValidity();
    var cargoV = document.getElementById('cargoUpdate').checkValidity();

    var id = document.getElementById('id_updater_user').value;
    var ci = document.getElementById('ci_update').value;
    var nombre = document.getElementById('nombre_update').value;
    var appaterno = document.getElementById('apPaterno_update').value;
    var apmaterno = document.getElementById('apMaterno_update').value;
    var cargo = document.getElementById('cargoUpdate').value;
    // var acceso = $('input[name="acceso_update"]:checked').val();
    if (ciV && nombreV && appaternoV && apmaternoV && cargoV) {
        // alert("success");
        // console.log(ci+nombre+appaterno+apmaterno+cargo);
        var url = '/adm/usuarios/update';
        DatosPost = {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'id': id,
            'ci': ci,
            'nombre': nombre,
            'appaterno': appaterno,
            'apmaterno': apmaterno,
            'cargo': cargo
        };
        $.post(url, DatosPost).done(function(data) {
            console.log(data);
            if (data == "creado") {
                // console.log("usu creado");
                $('#ModalUpdateUsuario').modal('hide');
                listUser();
                document.getElementById('ci_update').value = "";
                document.getElementById('nombre_update').value = "";
                document.getElementById('apPaterno_update').value = "";
                document.getElementById('apMaterno_update').value = "";
                alertify.success("Datos actualizados");

            } else if (data == "creadoError") {
                // console.log("creado de usu error")
                alertify.error("Error, vuela a intentarlo");
            } else if (data == "duplicado") {
                console.log("usu duplicado");
                alertify.error("CI ya registrado!");
            }


        }).fail(function() {
            console.log("error de server update USER");
        });


    } else {
        alert("error en formulario");
    }



}

function eliminarUsuario(id) {
    var a = confirm("Desea eliminar al usuario");
    if (a) {
        $.get('/adm/usuarios/destroy/' + id + '').done(function(data) {
            if (data == 1) {
                // console.log("eliminacion correcta");
                alertify.success("Se elimino correctamente");
                listUser();
            } else {
                // console.log("error buela a intentarlo");
                alertify.error("Error, Vuelva a intentarlo!.")
            }
        });
    } else {
        console.log("no se eliminara");
    }
}

function accesoUser(id) {
    $.get('/adm/usuarios/gestAcceso/' + id + '').done(function(data) {
        if (data == "correcto") {
            listUser();
        } else if (data == "errror") {
            // console.log("error en cambiar acceso vualva a intentarlo")
            alertify.error("Error, vualva intentarlo!.");
        } else {
            console.log(data);
        }
    }).fail(function() {
        // console.log("ERROR SERVER ACCESO AL SISTEMA");
        alertify.error("ERROR SERVER GESTIONDE ACCESO AL SISTEMA");
    });
}
function tian(par) {
    const casa = `<div> que tal como estas</div> `;
    console.log(casa);
}
const tian1 = (title = 'submit')=>html`
<button title="${title}"> </button>`

function mostrar(params) {
    var a = `<div class="loader-container" style="text-align: center;">
                <div class="loader"></div>
                <div class="loader2"></div>
            </div>`;
    document.getElementById('aniLoader').innerHTML=a;
    setTimeout(() => {borrar();}, 2000);

}
function borrar(params) {
    document.getElementById('aniLoader').innerHTML="";
    setTimeout(() => {mostrar();}, 2000);

}



