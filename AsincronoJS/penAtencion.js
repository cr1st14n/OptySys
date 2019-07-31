alertify.set('notifier', 'position', 'top-right');
// listPendientes();
setTimeout("listPendientes()",1000);
$(function () {
    // $('#btnActualizarCliente').on('click', updateCliente);
    // $('#btnRegistrarAtencion').on('click', registrarAten);
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
function buscarCI(id) {
    var elem=document.getElementById(id);
    if (elem.value != ""){
        $.get('/adm/Atencion/busc1/'+elem.value+'').done(function (cliente) {
            console.log(cliente);
            $('#listclie').html("");
            for (var i = 0; i <= cliente.length - 1; i++) {
                console.log(cliente[i]);
                var tr = `<tr>
				          <td>` + cliente[i].id + `</td>
				          <td>` + cliente[i].vent_clienteNombre + `</td>
				          <td>` + cliente[i].vent_clienteApellido + `</td>
				          <td>` + cliente[i].vent_clienteApellido2 + ` </td>
				         <td>
                            <button onclick="showModalAten(`+cliente[i].id+`)" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-shopping-cart-add"></i></button>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-red"><i class="zmdi zmdi-delete"></i></button>
	                    </td>  
		   	        </tr>`;
                $("#listclie").append(tr);
            }
        }).fail();
    } else{
        console.log("no se buscara");
    }
}
function buscartext(id) {
    var elem=document.getElementById(id);
    if (elem.value != ""){
        var nombres = elem.value.replace(/[ ]/gi,'-');
        $.get('/adm/Atencion/busc2/'+nombres+'').done(function (cliente) {
            console.log(cliente);
            $('#listclie').html("");
            for (var i = 0; i <= cliente.length - 1; i++) {
                console.log(cliente[i]);
                var tr = `<tr>
				          <td>` + cliente[i].id + `</td>
				          <td>` + cliente[i].vent_clienteNombre + `</td>
				          <td>` + cliente[i].vent_clienteApellido + `</td>
				          <td>` + cliente[i].vent_clienteApellido2 + ` </td>
				         <td>
                            <button onclick="showModalAten(`+cliente[i].id+`)" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-shopping-cart-add"></i></button>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-red"><i class="zmdi zmdi-delete"></i></button>
	                    </td>  
		   	        </tr>`;
                $("#listclie").append(tr);
            }
        }).fail();



    } else{
        console.log("no se buscara");
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
function listPendientes() {
    $.get('/adm/AtenPendientes/storePendientes').done(function (data) {
        console.log(data);
        $('#listPenAten').html("");
        for (var i = 0; i <= data.length - 1; i++) {
            var fecha2=moment(data[i].aten_fecha2,"YYYY/MM/DD HH:mm:ss").format('DD/MM/YYYY HH:mm');
            var tr = `<tr>
                        <th scope="row">` + data[i].vent_clienteNit + `</th>
                        <td>`+data[i].vent_clienteNombre+` `+data[i].vent_clienteApellido+` </td>
                        <td>`+fecha2+`</td>
                        <td>`+data[i].aten_precio+`</td>
                        <td>`+VerNull(data[i].aten_aCuenta)+`</td>
                        <td>`+VerNull(data[i].aten_Saldo)+`</td>
                        <td>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-red" onclick="conluirAten(`+data[i].id+`)"><i class="zmdi zmdi-shopping-cart"></i></button>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-green" onclick="editarPedido(`+data[i].id+`)"><i class="zmdi zmdi-view-comfy"></i></button>
                            <button class="btn btn-default waves-effect waves-float btn-sm waves-red" onclick="deleteAten(`+data[i].id+`)"><i class="zmdi zmdi-delete"></i></button>
                        </td>
		   	        </tr>`;
            $("#listPenAten").append(tr)

        }
    }).fail(function () {
        alertify.error("ERROR PROCESO LIST PENDIENTES");
    });
}
function VerNull(data) {
    if (data!=null){return data;}else{return "...";}
}
function editarPedido(id) {
    var btnUpdateClie=$("#btnEditClie");
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
    $.get('/adm/AtenPendientes/store/'+id+'').done(function (data) {console.log(data);
        var fechaEntrega=moment(data.aten_fecha2,"YYYY/MM/DD HH:mm:ss").format('DD/MM/YYYY HH:mm');
        aten_fecha2.val(fechaEntrega);
        aten_precio.val(data.aten_precio);
        aten_aCuenta.val(data.aten_aCuenta);
        aten_Saldo.val(data.aten_Saldo);
        document.getElementById('saldoAtencion').innerHTML=data.aten_Saldo+"Bs.-";

         cod_clie.val(data.cod_clie);
         btnUpdateClie.attr("name",data.id);

         da_cristales.val(data.da_cristales);   da_armazon.val(data.da_armazon);       da_organicos.val(data.da_organicos);
         da_tinte.val(data.da_tinte);           da_uv.val(data.da_uv);                 da_pcr.val(data.da_pcr);
         da_lejosODest.val(data.da_lejosODest); da_lejosODCil.val(data.da_lejosODCil); da_lejosODEje.val(data.da_lejosODEje);
         da_lejosODDip.val(data.da_lejosODDip); da_lejosOLest.val(data.da_lejosOLest); da_lejosOLCil.val(data.da_lejosOLCil);
         da_lejosOLEje.val(data.da_lejosOLEje); da_lejosOLDip.val(data.da_lejosOLDip);
        da_cercaODest.val(data.da_cercaODest);  da_cercaODCil.val(data.da_cercaODCil); da_cercaODEje.val(data.da_cercaODEje);
         da_cercaODDip.val(data.da_cercaODDip); da_cercaOLest.val(data.da_cercaOLest); da_cercaOLCil.val(data.da_cercaOLCil);
         da_cercaOLEje.val(data.da_cercaOLEje); da_cercaOLDip.val(data.da_cercaOLDip);
         da_focales.val(data.da_focales);       da_otros.val(data.da_otros);           da_alt.val(data.da_alt);
         da_ad.val(data.da_ad);                 da_doctor.val(data.da_doctor);         da_estuche.val(data.da_estuche);
         da_observaciones.val(data.da_observaciones);


        $("#ModalEditAtencion").modal('show');
    }).fail(function () {
        alertify.error("ERROR SERVER");
    });
}
function updatePedido(id) {
    console.log(id);
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

    var verFechaEntregaV = document.getElementById('aten_fecha2').checkValidity();

    if  (clieV&&precioV&&aCuentaV&&fechaV&&verFechaEntregaV){

        var url='/adm/AtenPendientes/update/'+id+'';
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
        // console.log(document.getElementById('saldoAte').value);
        $.post(url,data).done(function (dato) {
            console.log(dato);
            if (dato=="success"){
                alertify.success("Atencion actualizada exitosamente");
                $("#ModalEditAtencion").modal('hide');
                listPendientes();
            }else{
                alertify.error("Error vuelva a intentarlo");
            }
        }).fail(function () {
            alertify.error("ERROR SERVER UPDATE ATENCION");
        });

    }else {
        alertify.error("Verificar datos en formulario");
    }
}
function deleteAten(id) {
    var conf=confirm("Desea eliminar atencion?");
    if (conf){
        $.get('/adm/AtenPendientes/destroy/'+id+'').done(function (data) {
            console.log(data);
            if (data=="success"){
                listPendientes();
                alertify.success("Atencion eliminada exitosamente");
            } else if (data=="success1") {
                listPendientes();
                alertify.warning("Preceso incompleto consultar con desarrollador");
            }else{
                alertify.error("Error Vuelva a intentarlo");
            }

        }).fail(function () {
            alertify.error("ERROR SERVER DESTROY ATEN");
        });
    }
}
function conluirAten(id) {
    $.get('/adm/AtenPendientes/atenPagada/'+id+'').done(function (data) {
        if (data=="success"){
            alertify.success("Atencion concluida  ! ");
            listPendientes();
        } else{
            alertify.error("Error! Vuelva a intentarlo");
        }
    }).fail();
}