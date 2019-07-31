alertify.set('notifier', 'position', 'top-right');
function validar(id) {
    var elemento = document.getElementById(id);
    if (elemento.checkValidity()) {
        elemento.style.borderColor = "green";
        elemento.style.backgroundColor = "";

    }else if (elemento.value==""){
        elemento.style.borderColor = "";
        elemento.style.backgroundColor = "";
    }
    else {
        elemento.style.borderColor = "red";
        elemento.style.backgroundColor = "#ffd3d3";
    }
}

function showEditUsu() {
    $("#ModaleditUsu").modal('show');
}
function updateUsu() {
var id=$("#usu_id");
var ci=$("#usu_ci");
var nombre=$("#usu_nombre");
var appaterno=$("#usu_appaterno");
var apmaterno=$("#usu_appaterno");
url='/adm/perfil-user/update';
dataUser={'_token': $('meta[name=csrf-token]').attr('content'),
    'ci':ci.val(),'id':id.val(),'nombre':nombre.val(),'appaterno':appaterno.val(),'apmaterno':apmaterno.val()};
console.log(dataUser);
$.post(url,dataUser).done(function (data) {
    console.log(data);
    if (data=="creado"){
        refreshPerfil();
        $("#ModaleditUsu").modal('hide');
    }else if (data=="duplicado"){
        alertify.warning("El Ci ya esta registrado");
    } else if (data=="creadoError"){
        alertify.warning("Error. vuelva a intentarlo");
    }else {
        alertify.warning("Error. vuelva a intentarlo");
    }
}).fail(function () {
    console.log("ERROR SERVER UPDATE PERFIL USER!");
});
}
function showResetkey() {
    $("#ModalResetKey").modal('show');
}
function updateKey() {

}
function refreshPerfil() {
    $("#perfiluserDiv").load("/adm/perfil-user/refreshPerfil",function () {
        alertify.success("perfil actualizado");
    });
    /*var refrescarid = setInterval(function() {
        $("#perfiluserDiv").load("/adm/perfil-user/refreshPerfil")
            .error(function() { alert("Error"); });
    }, 1000);*/ // Tiempo
    $.ajaxSetup({ cache: false });
}
/*$(document).ready(function() {
    var refrescarid = setInterval(function() {
        $("#div1").load("url que quieres cargar")
            .error(function() { alert("Error"); });
    }, 1000); // Tiempo
    $.ajaxSetup({ cache: false });
});*/
