//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables =============================== //

    // radicar factura
    var radicacion_factura = $("#radicacion_factura");
    var radicacion_factura_temporizador = 0;
    var radicacion_factura_tbody = $("#radicacion_factura_tbody");
    var radicacion_factura_id = $("#radicacion_factura_id");
    var radicacion_fecha_radicacion = $("#radicacion_fecha_radicacion");

    // radicar contrato
    var radicacion_contrato = $("#radicacion_contrato");
    var radicaciopn_contrato_desde = $("#radicaciopn_contrato_desde");
    var radicaciopn_contrato_hasta = $("#radicaciopn_contrato_hasta");
    var radicacion_contrato_fecha = $("#radicacion_contrato_fecha");
    var radicacion_contrato_buscar = $("#radicacion_contrato_buscar");

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    radicacion_factura.on("keyup", function () {
        clearInterval(radicacion_factura_temporizador)
        radicacion_factura_temporizador = setTimeout(buscarFactura, 800);
    });

    radicacion_contrato_buscar.on("click",function(){
        buscarFacturas();
    });

    //-- declarar funciones auxiliares------------------------------------//

    function buscarFactura() {
        var url = "/facturas/" + radicacion_factura.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    if (respuesta.factura.radicada == 0) {
                        radicacion_factura_tbody.html(respuesta.radicacion_factura_tbody);
                        radicacion_factura_id.val(respuesta.factura.id);
                        radicacion_fecha_radicacion.removeAttr('disabled');
                    } else {
                        radicacion_factura_tbody.html("<tr><td colspan='4'><p class='text-info'>La factura ya fue radicada.</p></td></tr>");
                        radicacion_factura_id.val("");
                        radicacion_fecha_radicacion.attr('disabled','disabled');
                    }
                } else {
                    radicacion_factura_tbody.html("<tr><td colspan='4'><p class='text-danger'>" + respuesta.error + "</p></td></tr>");
                    radicacion_factura_id.val("");
                    radicacion_fecha_radicacion.attr('disabled','disabled');
                }
            }, error: function (e) {
                radicacion_factura_tbody.html(e);
                radicacion_factura_id.val("");
                radicacion_fecha_radicacion.attr('disabled','disabled');
            }
        });
    }

    function buscarFacturas() {
        var url = "/facturas/radicar/" + radicacion_contrato.val()+"/"+radicaciopn_contrato_desde.val()+"/"+radicaciopn_contrato_hasta.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {

                } else {

                }
            }, error: function (e) {
                
            }
        });
    }

});