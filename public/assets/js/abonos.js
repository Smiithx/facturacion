//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables abonos=============================== //
    var abonos_factura = $("#abonos_factura");
    var btn_abonos_buscar = $("#btn_abonos_buscar");
    var abonos_tbody = $("#abonos_tbody");

    //-- Agregar evento Buscar Factura en la Vista abonos ================================= //
    btn_abonos_buscar.on("click", function () {
        var url = "/abonos/" + abonos_factura.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    abonos_tbody.html(respuesta.abonos_tbody);
                }
                else {
                    abonos_tbody.html("");
                    swal('Cancelled', respuesta.error, 'error');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });
});