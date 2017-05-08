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
    var radicacion_contrato_tbody = $("#radicacion_contrato_tbody");
    var radicacion_contrato_all = $("#radicacion_contrato_all");
    var radicacion_contrato_id_factura = $(".radicacion_contrato_id_factura");
    var radicacion_contrato_radicar = $(".radicacion_contrato_radicar");
    var radicacion_contrato_total = $("#radicacion_contrato_total");

    //REPORTE Radicacion
    var radicacion_fecha_inicio = $("#radicacion_fecha_inicio");
    var radicacion_fecha_fin = $("#radicacion_fecha_fin");
    var btn_radicacion_buscar = $("#btn_radicacion_buscar");
    var radicacion_tbody = $("#radicacion_tbody");

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    radicacion_factura.on("keyup", function () {
        clearInterval(radicacion_factura_temporizador)
        radicacion_factura_temporizador = setTimeout(buscarFactura, 800);
    });

    radicacion_contrato_buscar.on("click", function () {
        buscarFacturas();
    });

    radicacion_contrato_all.on("change", function () {
        checkear();
    });


    btn_radicacion_buscar.on("click", function () {
        var url = "/radicacion/buscar/" + radicacion_fecha_inicio.val() +
            "/" + radicacion_fecha_fin.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    radicacion_tbody.html(respuesta.radicacion_tbody);
                }
                else {
                    radicacion_tbody.html("");
                    swal('Cancelled', respuesta.error, 'error');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
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
                        radicacion_fecha_radicacion.attr('disabled', 'disabled');
                    }
                } else {
                    radicacion_factura_tbody.html("<tr><td colspan='4'><p class='text-danger'>" + respuesta.error + "</p></td></tr>");
                    radicacion_factura_id.val("");
                    radicacion_fecha_radicacion.attr('disabled', 'disabled');
                }
            }, error: function (e) {
                radicacion_factura_tbody.html(e);
                radicacion_factura_id.val("");
                radicacion_fecha_radicacion.attr('disabled', 'disabled');
            }
        });
    }

    function buscarFacturas() {
        var url = "/facturas/radicar/" + radicacion_contrato.val() + "/" + radicaciopn_contrato_desde.val() + "/" + radicaciopn_contrato_hasta.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    radicacion_contrato_tbody.html(rellenarTabla(respuesta.facturas));
                    actualizarVariables();
                    radicacion_contrato_all.prop('checked', true);
                    checkear();
                    radicacion_contrato_fecha.removeAttr('disabled');
                    radicacion_contrato_fecha.focus();
                } else {
                    radicacion_contrato_tbody.html("");
                    actualizarVariables();
                    radicacion_contrato_all.prop('checked', false);
                    checkear();
                    radicacion_contrato_fecha.attr('disabled','disabled');
                }
            }, error: function (e) {
                console.log(e);
                radicacion_contrato_tbody.html("");
                actualizarVariables();
                radicacion_contrato_all.prop('checked', false);
                checkear();
                radicacion_contrato_fecha.attr('disabled','disabled');
            }
        });
    }

    function rellenarTabla(facturas) {
        var tbody = "";
        var fila = 0;

        $.each(facturas, function (ind, factura) {
            tbody += "<tr>";
            tbody += "<td class='text-center'><a  target='_blank' href='/facturas/" + factura.id + "'>" + factura.id + "</a></td>";
            tbody += "<td>" + factura.contrato + "</td>";
            tbody += "<td class='text-center'>" + factura.created_at + "</td>";
            tbody += "<td class='text-right'>" + $.number(factura.factura_total, 2) + "</td>";
            tbody += "<td class='text-center'>";
            tbody += "<input type='checkbox' data-value='" + factura.factura_total + "' data-id='" + fila + "' class='radicacion_contrato_radicar'>";
            tbody += "<input type='hidden' name='facturas[]' class='radicacion_contrato_id_factura' value='" + factura.id + "'>";
            tbody += "</td>";
            tbody += "</tr>";
            fila += 1;
        });

        return tbody;
    }

    function checkear() {
        if (radicacion_contrato_all.prop('checked')) {
            radicacion_contrato_radicar.prop('checked', true);
            radicacion_contrato_id_factura.removeAttr("disabled");
        } else {
            radicacion_contrato_radicar.prop('checked', false);
            radicacion_contrato_id_factura.attr("disabled", true);
        }
        calcularValorTotal();
    }

    function actualizarVariables() {
        radicacion_contrato_radicar = $(".radicacion_contrato_radicar");
        radicacion_contrato_id_factura = $(".radicacion_contrato_id_factura");
        agregarEventos();
    }

    function eliminarEventos() {
        radicacion_contrato_radicar.unbind("change");
    }

    function agregarEventos() {
        eliminarEventos();
        //-- Agregar eventos ================================= //
        radicacion_contrato_radicar.on("click", function () {
            calcularValorTotal();
            var checkbox = $(this);
            var hidden = checkbox.parent()[0].children[1];

            if (checkbox.prop('checked')) {
                hidden.removeAttribute('disabled');
            } else {
                hidden.setAttribute('disabled', 'disabled');
            }
        });

    }

    function calcularValorTotal() {
        var count = radicacion_contrato_radicar.length;
        var total = 0;
        if (count > 0) {
            for (var i = 0; i < count; i++) {
                var factura = $(".radicacion_contrato_radicar[data-id='" + i + "']");
                if (factura.prop('checked')) {
                    total += parseFloat(factura.attr("data-value"));
                }
            }
            radicacion_contrato_total.html($.number(total, 2));
        } else {
            radicacion_contrato_total.html("");
        }
    }

});