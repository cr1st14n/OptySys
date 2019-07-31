alertify.set('notifier', 'position', 'top-right');
$(function () {
$("#btnModalFS").on('click',showModalFS);
$("#btnModalFC").on('click',showModalFC);
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
function listVentas(data) {
    var html=data.map(function (elem,index) {
        if (elem.aten_estadoPago==1){var EP=`<span class="badge badge-success">Cancelado</span>`}
        else {var EP=`<span class="badge badge-warning">Pendiente</span>`}
        return(`<tr>
                        <!--<th scope="row">Clie- ${elem.id}</th>-->
                        <td>${elem.vent_clienteNombre} ${VN(elem.vent_clienteApellido)} </td>
                        <td>${elem.vent_clienteNit}</td>
                        <td>${elem.aten_precio}</td>
                        <td>${EP}</td>
                        <td>${moment(elem.aten_fecha1,"YYYY/MM/DD HH:mm:ss").format('DD/MM/YYYY HH:mm')}</td>
                        <td>${moment(elem.aten_fecha2,"YYYY/MM/DD HH:mm:ss").format('DD/MM/YYYY HH:mm')}</td>
                        <td>${elem.usu_nombre}</td>
                        <td>${elem.usu_ci}</td>
                        <td>
                            <button onclick="ModalHistoriaClienteDetalle(${elem.id})" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-shopping-cart-add"></i></button>
                        </td>
		   	        </tr>`)
    }).join(" ");
    document.getElementById('tableVentasPasadas').innerHTML=html;

}
function showModalFS() {
    $("#formFechaSimple")[0].reset();
    $("#ModalFilFechSimple").modal('show');
}
function showModalFC() {
    $("#formFechaRango")[0].reset();
    $("#ModalFilFechCompleja").modal('show');
}
function filtrarFS() {
data=document.getElementById('fecha1Simple');
    var vregexNaix = /^(0[1-9]|[1-2]\d|3[01])(\/)(0[1-9]|1[012])\2(\d{4})$/;
    fech=vregexNaix.test(data.value);
    if (fech){
        fecha=moment(data.value,"DD/MM/YYYY").format('YYYY-MM-DD');
        console.log(fecha);
        var url='/adm/Atencion/ventas-Anteriores1';
        var json={'_token': $('meta[name=csrf-token]').attr('content'),
                    'fecha1':fecha};
        $.post(url,json).done(function (data) {
            console.log(data);
            listVentas(data);
            $("#ModalFilFechSimple").modal('hide');
        }).fail(function () {
            alertify.error("ERROR SERVER FILTRO POR FECHA");
        });
    }else if(!fech) {
    console.log("verificar texto");
    alertify.warning("Verificar fecha ingresada!")
    }
}
function filtrarFC() {
data1=document.getElementById('fecha1C');
data2=document.getElementById('fecha2C');
    var vregexNaix = /^(0[1-9]|[1-2]\d|3[01])(\/)(0[1-9]|1[012])\2(\d{4})$/;
    fech1=vregexNaix.test(data1.value);
    fech2=vregexNaix.test(data2.value);
    if (fech1&&fech2){
        fecha1=moment(data1.value,"DD/MM/YYYY").format('YYYY-MM-DD');
        fecha2=moment(data2.value,"DD/MM/YYYY").format('YYYY-MM-DD');
        // console.log(fecha);
        if( (new Date(fecha1).getTime() < new Date(fecha2).getTime()))
        {
            var url='/adm/Atencion/ventas-Anteriores2';
            var json={'_token': $('meta[name=csrf-token]').attr('content'),
                'fecha1':fecha1,
                'fecha2':fecha2};
            $.post(url,json).done(function (data) {
                listVentas(data);
                $("#ModalFilFechCompleja").modal('hide');
            }).fail(function () {
                alertify.error("ERROR SERVER FILTRO POR FECHA COMPLEJA");
            });
        }else {
            alertify.error("Error, verificar logica de fechas a filtrar");
        }
    }else {
    console.log("verificar texto");
    alertify.warning("Verificar fechas ingresadas!");
    }
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

//--------sector de pruba
var formulario=document.querySelector("#formpeliculas");
formulario.addEventListener('submit',function () {
   console.log("entra");
   var titulo=document.querySelector('#addPelicula').value;
    if (titulo.length >= 1){
        localStorage.setItem(titulo,titulo)
    }
    var ul=document.querySelector('#peliculasList');
    ul.innerHTML="";
    for (var i in localStorage){
        if (typeof localStorage[i]=='string'){
            var li=document.createElement("li");
            li.append(localStorage[i]);
            ul.append(li);
        }

    }
});
var formulario=document.querySelector("#formpeliculasBorrar");
formulario.addEventListener('submit',function () {
   console.log("entra");
   var titulo=document.querySelector('#borrrarPelicula').value;
    if (titulo.length >= 1){
        localStorage.removeItem(titulo);
    }
    var ul=document.querySelector('#peliculasList');
    ul.innerHTML="";
    for (var i in localStorage){
        if (typeof localStorage[i]=='string'){
            var li=document.createElement("li");
            li.append(localStorage[i]);
            ul.append(li);
        }

    }
});


document.addEventListener("#sector1").onload = asas();
function asas() {
    alert("Hello World");
    document.getElementById("lec1").innerText="hola  que tal";
    function textoRapido() {
        document.getElementById('lec2').innerText="jua jua";
    }
}
function cargarLugar() {
    console.log("hoal");
    document.getElementById("lugar").innerHTML=`<div id="sector1">
                                <h2 id="lec1"></h2>
                                <h3>sector en linea</h3>
                                <button id="btnrudo" onclick="textoRapido()">clickclick</button>
                            </div>`;
    document.getElementById("sector1").onload = asas();

}
function textoRapido() {
    document.getElementById('lec2').innerText="jua jua";
}
function cool() {
    alert("hla")
}
