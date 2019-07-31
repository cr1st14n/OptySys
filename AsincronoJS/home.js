function VN(texto) {
    if (texto == null) { texto = "" }
    return texto;
}
// alert("hola");
$('#clientesDescuento').click(function (e) { 
    e.preventDefault();
    $('#modal-clienteDescuento').modal('show');
    
});