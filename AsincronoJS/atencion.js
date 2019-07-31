alertify.set('notifier', 'position', 'top-right');
$(function () {
    $('#btnModalAgregarCliente').on('click', ModalAgregarCliente);
    $('#btnRegistrarCliente').on('click', registrarCliente);
    $('#btnActualizarCliente').on('click', updateCliente);
    $('#btnRegistrarAtencion').on('click', registrarAten);
});
function validar(id) {
    var elemento = document.getElementById(id);
    if (elemento.checkValidity()) {
        elemento.style.borderColor = "green";
        elemento.style.backgroundColor = "";
    }else if (elemento.value == ""){
        elemento.style.borderColor = "";
        elemento.style.backgroundColor = "";
    } else {
        elemento.style.borderColor = "red";
        elemento.style.backgroundColor = "#ffd3d3";
    }
}
function listClientes(data) {
        var html=data.map(function (elem,index) {
            return(`<tr>
                        <th scope="row">Clie- ${elem.id}</th>
                        <td>${elem.vent_clienteNombre} ${VN(elem.vent_clienteApellido)} </td>
                        <td>${elem.vent_clienteNit}</td>
                        <td>
                            <button onclick="showModalAten(${elem.id})" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-shopping-cart-add"></i></button>
                        </td>
		   	        </tr>`)
        }).join(" ");
        document.getElementById('listclie').innerHTML=html;

}
function listClien(data) {
    $.get('/adm/clientes/store').done(function (data) {
        var html=data.map(function (elem,index) {
            return(`<tr>
                        <th scope="row">Clie- ${elem.id}</th>
                        <td>${elem.vent_clienteNombre} ${VN(elem.vent_clienteApellido)} </td>
                        <td>${elem.vent_clienteNit}</td>
                        <td>
                            <button onclick="showModalAten(${elem.id})" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-shopping-cart-add"></i></button>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="editarCliente(${elem.id})"><i class="zmdi zmdi-edit"></i></button>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-red" onclick="eliminarCliente(${elem.id})"><i class="zmdi zmdi-delete"></i></button>
                        </td>
		   	        </tr>`)
        }).join(" ");
        document.getElementById('listclie').innerHTML=html;
    }).fail(function () {
        console.log("ERROR SERVER LIST CLIENTES")
    });
}
function ModalAgregarCliente() {
    document.getElementById('ci_nit').value = "";
    document.getElementById('nombre').value = "";
    document.getElementById('apellido').value = "";
    document.getElementById('ci_nit').style.borderColor = "";
    document.getElementById('nombre').style.borderColor = "";
    document.getElementById('apellido').style.borderColor = "";
    $("#ci_nit").val($("#atenCI").val());
    $('#ModalCreateCliente').modal('show');
}
function registrarCliente() {
    var ciNitV = document.getElementById('ci_nit').checkValidity();
    var nomV = document.getElementById('nombre').checkValidity();
    var apeV = document.getElementById('apellido').checkValidity();

    var ciNit = $("#ci_nit").val();
    var nom = $('#nombre').val();
    var ape = $('#apellido').val();
    if (ciNitV && nomV && apeV) {
        var url = '/adm/clientes/create';
        var datos = {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'ciNit': ciNit, 'nombre': nom, 'apellido': ape};
        $.post(url, datos).done(function (data) {
            if (data == "creado") {
                // console.log("usu creado");
                $('#ModalCreateCliente').modal('hide');
                // listClientes();
                $("#atenCI").val(ciNit);
                buscarCI("atenCI");
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
    $.get('/adm/clientes/edit/'+id+'').done(function (data) {
        $("#id_updater_clie").val(data.id);
        $("#ci_update").val(data.vent_clienteNit);
        $("#nombre_update").val(data.vent_clienteNombre);
        $("#apellido_update").val(data.vent_clienteApellido);
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

    var id = document.getElementById('id_updater_clie').value;
    var ci = document.getElementById('ci_update').value;
    var nom = document.getElementById('nombre_update').value;
    var ape = document.getElementById('apellido_update').value;
    if (idV && ciV && nomV && apeV)
    {
        var url = "/adm/clientes/update";
        var datos= {'_token': $('meta[name=csrf-token]').attr('content'),
            'id':id,'ci':ci,'nombre':nom,'apellido':ape};
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
function buscarCI(id) {
    var elem=document.getElementById(id);
    if (elem.value != ""){
        $.get('/adm/Atencion/busc1/'+elem.value+'').done(function (cliente) {
            // console.log(cliente);
            listClientes(cliente)
            // $('#listclie').html("");
            // for (var i = 0; i <= cliente.length - 1; i++) {
            //     // console.log(cliente[i]);
            //     var tr = `<tr>
			// 	          <td>` + cliente[i].id + `</td>
			// 	          <td>` + cliente[i].vent_clienteNombre + `</td>
			// 	          <td>` + cliente[i].vent_clienteApellido + `</td>
			// 	          <td>` + cliente[i].vent_clienteApellido2 + ` </td>
			// 	         <td>
            //                 <button onclick="showModalAten(`+cliente[i].id+`)" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-shopping-cart-add"></i></button>
	        //             </td>
		   	//         </tr>`;
            //     $("#listclie").append(tr);
            // }
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
        $.get('/adm/Atencion/busc2/'+nombres+'').done(function (cliente) {
            // console.log(cliente);
            listClientes(cliente);

        }).fail();
    } else{
        console.log("no se buscara");
        $('#listclie').html("");
    }
}
function calcularSaldo() {
    var precio = $("#aten_precio");
    var aCuenta=$("#aten_aCuenta");
    if (precio.val()==null && aCuenta.val()==null){
        alertify.warning("Ingrese el precio!");
    }else if (precio.val()-aCuenta.val() < 0){
        alertify.warning("Monto a cuenta Supera el precio Total");
        document.getElementById('saldoAtencion').innerHTML="";
        document.getElementById('saldoAte').value="";
    }else if (precio.val() == null) {
        alertify.error("Ingrese el precio total!");
    } else{
        console.log(precio.val()-aCuenta.val());
        document.getElementById('saldoAtencion').innerHTML=precio.val()-aCuenta.val() + " Bs.-";
        document.getElementById('saldoAte').value=precio.val()-aCuenta.val();
    }
}
function showModalAten(id) {
    $("#cod_clie").val(id);
    document.getElementById('saldoAtencion').innerHTML="";
    document.getElementById('saldoAte').value="";
    document.getElementById('aten_precio').value="";
    document.getElementById('aten_aCuenta').value="";
    document.getElementById('aten_fecha2').value="";
    $("#ModalCreateAtencion").modal('show');
}
function registrarAten() {
    var cod_clie = $("#cod_clie");          var aten_precio = $("#aten_precio");    var aten_aCuenta = $("#aten_aCuenta");
    var aten_Saldo = $("#saldoAte");        var aten_fecha2 = $("#aten_fecha2");
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
     var clieV = document.getElementById('cod_clie').checkValidity();
     var precioV = document.getElementById('aten_precio').checkValidity();
     var aCuentaV = document.getElementById('aten_aCuenta').checkValidity();
     var fechaV = document.getElementById('aten_fecha2').checkValidity();

     var verFechaEntrega =dateRegEx(aten_fecha2.val());

    if  (clieV&&precioV&&aCuentaV&&fechaV&&verFechaEntrega==true){

        var url='/adm/Atencion/create';
        var data= { '_token':$('meta[name=csrf-token]').attr('content'),
            /*datos en general de la atencion*/
            'cod_clie':cod_clie.val(),'aten_precio':aten_precio.val(),'aten_aCuenta':aten_aCuenta.val(),'aten_Saldo':aten_Saldo.val(),
            'aten_fecha2':aten_fecha2.val(),
            /*datos para descripcion de atencion*/
            'da_cristales':da_cristales.val(),'da_armazon':da_armazon.val(),'da_organicos':da_organicos.val(),'da_tinte':da_tinte.val(),'da_uv':da_uv.val(),'da_pcr':da_pcr.val(),
            'da_lejosODest':da_lejosODest.val(),'da_lejosODCil':da_lejosODCil.val(),'da_lejosODEje':da_lejosODEje.val(),'da_lejosODDip':da_lejosODDip.val(),
            'da_lejosOLest':da_lejosOLest.val(),'da_lejosOLCil':da_lejosOLCil.val(),'da_lejosOLEje':da_lejosOLEje.val(),'da_lejosOLDip':da_lejosOLDip.val(),
            'da_cercaODest':da_cercaODest.val(),'da_cercaODCil':da_cercaODCil.val(),'da_cercaODEje':da_cercaODEje.val(),'da_cercaODDip':da_cercaODDip.val(),
            'da_cercaOLest':da_cercaOLest.val(),'da_cercaOLCil':da_cercaOLCil.val(),'da_cercaOLEje':da_cercaOLEje.val(),'da_cercaOLDip':da_cercaOLDip.val(),
            /*sector C*/
            'da_focales':da_focales.val(),'da_otros':da_otros.val(),'da_alt':da_alt.val(),'da_ad':da_ad.val(),
            'da_doctor':da_doctor.val(),'da_estuche':da_estuche.val(),'da_observaciones':da_observaciones.val()
        };
        console.log(document.getElementById('saldoAte').value);
        $.post(url,data).done(function (dato) {
            console.log(dato);
            if (dato=="success"){
                alertify.success("Atencion registrada exitosamente");
                $("#ModalCreateAtencion").modal('hide');
            }else{
                alertify.error("Error vuelva a intentarlo");
            }
        }).fail(function () {
            alertify.error("ERROR SERVER CREATE ATENCION");
        });

    }else {
        alertify.error("Verificar datos en formulario");
    }
}
function dateRegEx(date){
    var pattern = new RegExp("^(3[01]|[12][0-9]|0[1-9])/(1[0-2]|0[1-9])/[0-9]{4} (2[0-3]|[01]?[0-9]):([0-5]?[0-9])$");
    if (date.search(pattern)===0) { return true;}
    else {return false;}
}
/*sector de funciones vista de historial de atencion*/
function f() {
    
}
