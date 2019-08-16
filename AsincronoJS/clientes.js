alertify.set('notifier', 'position', 'top-right');
listClientes();
$(function () {
    $('#btnModalAgregarCliente').on('click', ModalAgregarCliente);
    $('#btnRegistrarCliente').on('click', registrarCliente);
    $('#btnActualizarCliente').on('click', updateCliente);
});
function VN(texto) {
    if (texto==null){texto="..."}
    return texto;
}
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
function listClientes()     {
    $.get('/adm/clientes/store').done(function (data) {
        listClientes1(data);
    }).fail(function () {
        console.log("ERROR SERVER LIST CLIENTES")
    });
}
function ModalAgregarCliente() {
    $('#ModalCreateCliente').modal('show');
}
function registrarCliente() {
    var ciNitV = document.getElementById('ci_nit').checkValidity();
    var nomV = document.getElementById('nombre').checkValidity();
    var apeV = document.getElementById('apellido').checkValidity();
    var ape2V = document.getElementById('apellido2').checkValidity();
    var fechNacV = document.getElementById('apellido').checkValidity();
    var telfV = document.getElementById('apellido').checkValidity();

    var ciNit = $("#ci_nit").val();
    var nom = $('#nombre').val();
    var ape = $('#apellido').val();
    var ape2 = $('#apellido2').val();
    var fechNac = $('#fechaNacimiento').val();
    var telf = $('#TelfCel').val();
    if (ciNitV && nomV && apeV &&fechNacV&&telfV&&ape2V) {
        var url = '/adm/clientes/create';
        var datos = {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'ciNit': ciNit, 'nombre': nom, 'apellido': ape,'apellido2': ape2,'fechNac':fechNac,'telf':telf};
        $.post(url, datos).done(function (data) {
            if (data == "creado") {
                // console.log("usu creado");
                $('#ModalCreateCliente').modal('hide');
                listClientes();
                document.getElementById('ci_nit').value = "";
                document.getElementById('nombre').value = "";
                document.getElementById('apellido').value = "";
                alertify.success("Cliente registrado exitosamente");

            } else if (data == "creadoError") {
                // console.log("creado de usu error")
                alertify.error("Error, vuela a intentarlo");
            } else if (data == "duplicado") {
                console.log("ci nit duplicado");
                alertify.error("CI o NIT ya registrado!");
            }
        }).fail(function () {
            alertify.error("ERROR SERVER CREATE CLIENTE");
        });
    }else{
        alertify.error("Verificar formulario");
    }
}
function editarCliente(id) {
    $('#formUpdate-cliente').trigger("reset");
    $.get('/adm/clientes/edit/'+id+'').done(function (data) {
        $("#id_updater_clie").val(data.id);
        $("#ci_update").val(data.vent_clienteNit);
        $("#nombre_update").val(data.vent_clienteNombre);
        $("#apellido_update").val(data.vent_clienteApellido);
        $("#apellido2_update").val(data.vent_clienteApellido2);
        $("#fechaNacimiento_update").val(data.clie_fechNac);
        $("#TelfCel_update").val(data.clie_telf);
        $("#ModalUpdateCliente").modal('show');
    }).fail(function () {
        alertify.error("ERROR SERVER STORE CLIENTE");
    });
}
function updateCliente() {
    var idV = document.getElementById('id_updater_clie').checkValidity();
    var ciV = document.getElementById('ci_update').checkValidity();
    var nomV = document.getElementById('nombre_update').checkValidity();
    var apeV = document.getElementById('apellido_update').checkValidity();
    var ape2V = document.getElementById('apellido2_update').checkValidity();
    var fechNacV = document.getElementById('fechaNacimiento_update').checkValidity();
    var telfV = document.getElementById('TelfCel_update').checkValidity();

    var id = document.getElementById('id_updater_clie').value;
    var ci = document.getElementById('ci_update').value;
    var nom = document.getElementById('nombre_update').value;
    var ape = document.getElementById('apellido_update').value;
    var ape2 = document.getElementById('apellido2_update').value;
    var fechNac = document.getElementById('fechaNacimiento_update').value;
    var telf = document.getElementById('TelfCel_update').value;
    if (idV && ciV && nomV && apeV&&ape2V&&fechNacV&&telfV)
    {
        var url = "/adm/clientes/update";
        var datos= {'_token': $('meta[name=csrf-token]').attr('content'),
            'id':id,'ci':ci,'nombre':nom,'apellido':ape,'apellido2':ape2,'fechNac':fechNac,'telf':telf};
        $.post(url,datos).done(function (data) {
            console.log(data);
            if (data == "creado"){
                // console.log("usu creado");
                $('#ModalUpdateCliente').modal('hide');
                listClientes();
                document.getElementById('ci_update').value="";
                document.getElementById('id_updater_clie').value="";
                document.getElementById('nombre_update').value="";
                document.getElementById('apellido_update').value="";
                alertify.success("Datos actualizados");

            } else if (data == "creadoError"){
                // console.log("creado de usu error")
                alertify.error("Error, vuela a intentarlo");
            } else if (data == "duplicado"){
                alertify.error("CI o Nit ya registrado!");
            }

        }).fail(function () {
            alertify.error("ERROR SERVER UPDATE CLIENTE");
        });
    }else{
        alertify.error("Error en formulario");
    }
}
function eliminarCliente(id) {
    var resul = confirm("Desea eliminar al Cliente?");
    if (resul){
        $.get('/adm/clientes/destroy/'+id+'').done(function (data) {
            if (data == "success"){
                listClientes();
                alertify.success("Cliente eliminado exitosamente");
            }else{
                alertify.err("Error vuelva a intentarlo");
            }
        }).fail(function () {
            alertify.success("ERROR SERVER! DELETE CLIENTE");
        });
    }
}
//------- v2
function listClientes1(data) {
    var html=data.map(function (elem,index) {
        return(`<tr>
                        <th scope="row">Clie-` + elem.id + `</th>
                        <td>`+elem.vent_clienteNombre+` ${VN(elem.vent_clienteApellido)} ${VN(elem.vent_clienteApellido2) }</td>
                        <td>`+elem.vent_clienteNit+`</td>
                        <td>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="showhistoriaCliente(`+elem.id+`)"><i class="zmdi zmdi-tablet"></i></button>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="editarCliente(`+elem.id+`)"><i class="zmdi zmdi-library"></i></button>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-red" onclick="eliminarCliente(`+elem.id+`)"><i class="zmdi zmdi-delete"></i></button>
                        </td>
		   	        </tr>`);
    }).join(" ");
    document.getElementById('listclie').innerHTML=html;
}
function showhistoriaCliente(clie) {
    $.get('/adm/clientes/historiClie/'+clie+'').done(function (data) {
        console.log(data);
        if (data=="sinDatos"){
            alertify.warning("No se encontraron datos!");
        } else {
            $('#tableHistClie').html("");
            for (var i = data.length - 1; i >= 0; i--) {
                var fecha1 = moment(data[i].aten_fecha1, "YYYY/MM/DD HH:mm:ss").format('DD/MM/YYYY HH:mm');
                if (data[i].aten_estadoPago == 1) {
                    var pagoestado = `<span class="col-green">Pagado</span>`;
                } else if (data[i].aten_estadoPago == 0) {
                    var pagoestado = `<span class="col-red">Pendiente</span>`;
                } else {
                    var pagoestado = `<span class="col-amber">No comprovado</span>`;
                }
                var tr = `<tr>
                            <th scope="row">CV -` + data[i].id + `</th>
                            <td>` + fecha1 + `</td>
                            <td>` + data[i].aten_precio + `</td>
                            <td>` + pagoestado + `</td>
                            <td>
                                <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="ModalHistoriaClienteDetalle(` + data[i].id + `)"><i class="zmdi zmdi-tablet"></i></button>
                            </td>
                        </tr>`;
                $("#tableHistClie").append(tr)
            }
            $("#ModalHistoriaCliente").modal('show');
        }
    }).fail(function () {
        alertify.error("ERROR SERVER HISTORIAL DEL CLIENTE");
    });
}
function ModalHistoriaClienteDetalle(codVenta) {
    var aten_precio = $("#aten_precio");    var aten_aCuenta = $("#aten_aCuenta");
    var aten_Saldo = $("#aten_Saldo");        var aten_fecha2 = $("#aten_fecha2");
    var da_cristales = $("#da_cristales");  var da_armazon = $("#da_armazon");      var da_organicos = $("#da_organicos");
    var da_tinte = $("#da_tinte");          var da_uv = $("#da_uv");                var da_pcr = $("#da_pcr");
    var da_lejosODest = $("#da_lejosODest");var da_lejosODCil = $("#da_lejosODCil");var da_lejosODEje = $("#da_lejosODEje");
    var da_lejosODDip = $("#da_lejosODDip");var da_lejosOLest = $("#da_lejosOLest");var da_lejosOLCil = $("#da_lejosOLCil");
    var da_lejosOLEje = $("#da_lejosOLEje");var da_lejosOLDip = $("#da_lejosOLDip");
    var da_cercaODest= $("#da_cercaODest"); var da_cercaODCil = $("#da_cercaODCil");var da_cercaODEje = $("#da_cercaODEje");
    var da_cercaODDip = $("#da_cercaODDip");var da_cercaOLest = $("#da_cercaOLest");var da_cercaOLCil = $("#da_cercaOLCil");
    var da_cercaOLEje = $("#da_cercaOLEje");var da_cercaOLDip = $("#da_cercaOLDip");
    var da_focales = $("#da_focales");      var da_otros = $("#da_otros");          var da_alt = $("#da_alt");
    var da_ad = $("#da_ad");                var da_doctor = $("#da_doctor");        var da_estuche = $("#da_estuche");
    var da_observaciones = $("#da_observaciones");
    $.get('/adm/clientes/historiClieDetalle/'+codVenta+'').done(function (data) {
            console.log(data);
            var fecha=moment(data.aten_fecha2,"YYYY/MM/DD HH:mm:ss").format('DD/MM/YYYY HH:mm');
            aten_precio.text(VN(data.aten_precio));        aten_aCuenta.text(VN(data.aten_aCuenta));
            aten_Saldo.text(VN(data.aten_Saldo));          aten_fecha2.text(VN(fecha));
            da_cristales.text(VN(data.da_cristales));      da_armazon.text(VN(data.da_armazon));            da_organicos.text(VN(data.da_organicos));
            da_tinte.text(VN(data.da_tinte));              da_uv.text(VN(data.da_uv));                      da_pcr.text(VN(data.da_pcr));
            da_lejosODest.text(VN(data.da_lejosODest));    da_lejosODCil.text(VN(data.da_lejosODCil));      da_lejosODEje.text(VN(data.da_lejosODEje));
            da_lejosODDip.text(VN(data.da_lejosODDip));    da_lejosOLest.text(VN(data.da_lejosOLest));      da_lejosOLCil.text(VN(data.da_lejosOLCil));
            da_lejosOLEje.text(VN(data.da_lejosOLEje));    da_lejosOLDip.text(VN(data.da_lejosOLDip));
            da_cercaODest.text(VN(data.da_cercaODest));    da_cercaODCil.text(VN(data.da_cercaODCil));      da_cercaODEje.text(VN(data.da_cercaODEje));
            da_cercaODDip.text(VN(data.da_cercaODDip));    da_cercaOLest.text(VN(data.da_cercaOLest));      da_cercaOLCil.text(VN(data.da_cercaOLCil));
            da_cercaOLEje.text(VN(data.da_cercaOLEje));    da_cercaOLDip.text(VN(data.da_cercaOLDip));
            da_focales.text(VN(data.da_focales));          da_otros.text(VN(data.da_otros));                da_alt.text(VN(data.da_alt));
            da_ad.text(VN(data.da_ad));                    da_doctor.text(VN(data.da_doctor));              da_estuche.text(VN(data.da_estuche));
            da_observaciones.text(VN(data.da_observaciones));
            $("#ModalHistoriaClienteDetalle").modal("show");

    }).fail(function () {
        alertify.error("ERROR SERVER DETALLE VENTA");
    });
}

function buscarCI(id) {
    var elem=document.getElementById(id);
    if (elem.value != ""){
        $.get('/adm/Atencion/busc1/'+elem.value+'').done(function (data) {
            listClientes1(data);
        }).fail();
    } else{
        console.log("no se buscara");
        $('#listclie').html("");
    }
}
function buscartext(id) {
    var elem=document.getElementById(id);
    if (elem.value != ""){
        var nombres = elem.value.replace(/[ ]/gi,'-');
        $.get('/adm/Atencion/busc2/'+nombres+'').done(function (data) {
            listClientes1(data);
        }).fail();



    } else{
        console.log("no se buscara");
        $('#listclie').html("");
    }
}