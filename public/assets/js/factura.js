$(function () {

    //-- Declarar variables =============================== //

    // facturar
    var facturar_contrato = $("#facturar_contrato");
    var facturar_fecha_desde = $("#facturar_fecha_desde");
    var facturar_fecha_hasta = $("#facturar_fecha_hasta");
    var btn_facturar_buscar = $("#btn_facturar_buscar");
    var facturar_tbody = $("#facturar_tbody");
    var facturar_total = $("#facturar_total");
    var facturar_all = $("#facturar_all");
    var facturar = $(".facturar");
    var orden_id = $(".orden_id");

    // REPORTE TOTAL FACTURADO
    var totalfacturado_contrato = $("#totalfacturado_contrato");
    var totalfacturado_aseguradora = $("#totalfacturado_aseguradora");
    var totalfacturado_fecha_inicio = $("#totalfacturado_fecha_inicio");
    var totalfacturado_fecha_fin = $("#totalfacturado_fecha_fin");
    var btn_totalfacturado_buscar = $("#btn_totalfacturado_buscar");
    var totalfacturado_tbody = $("#totalfacturado_tbody");
    var total_facturado = $("#total_facturado");

    // reporte factura
    var reporte_factura_numero_factura = $("#reporte_factura_numero_factura");
    var reporte_factura_temporizador_numero_factura = 0;
    var reporte_factura_tbody = $("#reporte_factura_tbody");
    var reporte_factura_total = $("#reporte_factura_total");
    var reporte_factura_btn_imprimir = $("#reporte_factura_btn_imprimir");
    var reporte_factura_contrato = $("#reporte_factura_contrato");
    var reporte_factura_fecha_facturacion = $("#reporte_factura_fecha_facturacion");
    var reporte_factura_fecha_radicacion = $("#reporte_factura_fecha_radicacion");

    // reporte factura por contrato
    var reporte_factura_contrato_id_contrato = $("#reporte_factura_contrato_id_contrato");
    var reporte_factura_contrato_desde = $("#reporte_factura_contrato_desde");
    var reporte_factura_contrato_hasta = $("#reporte_factura_contrato_hasta");
    var reporte_factura_contrato_buscar = $("#reporte_factura_contrato_buscar");
    var reporte_factura_contrato_tbody = $("#reporte_factura_contrato_tbody");
    var reporte_factura_contrato_total = $("#reporte_factura_contrato_total");

    // reporte imprimir factura
    var imprimirfactura_fecha_desde = $("#imprimirfactura_fecha_desde");
    var imprimirfactura_fecha_hasta = $("#imprimirfactura_fecha_hasta");
    var btn_imprimirfactura_buscar = $("#btn_imprimirfactura_buscar");
    var imprimirfactura_tbody = $("#imprimirfactura_tbody");

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //

    // factjurar
    btn_facturar_buscar.on("click", function () {
        var url = "/ordenservicio/buscar/" + facturar_contrato.val() + "/" + facturar_fecha_desde.val() +
            "/" + facturar_fecha_hasta.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    facturar_tbody.html(respuesta.facturar_tbody);
                    facturar_total.html(respuesta.facturar_total);
                    actualizarVariables();
                    facturar_all.prop('checked', true);
                    checkear();
                }
                else {
                    facturar_tbody.html("");
                    facturar_total.html("");
                    swal('Cancelled', respuesta.error, 'error');
                    actualizarVariables();
                    facturar_all.prop('checked', false);
                    checkear();
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });
    facturar_all.on("change", function () {
        checkear();
    });

    // TOTAL FACTURADO

    btn_totalfacturado_buscar.on("click", function () {
        var url = "/facturas/buscar/" + totalfacturado_aseguradora.val() + "/" + totalfacturado_contrato.val() + "/" + totalfacturado_fecha_inicio.val() +
            "/" + totalfacturado_fecha_fin.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    totalfacturado_tbody.html(respuesta.totalfacturado_tbody);
                    total_facturado.html(respuesta.total_facturado);
                }
                else {
                    totalfacturado_tbody.html("");
                    swal('Cancelled', respuesta.error, 'error');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });



// Imprimir Factura

    btn_imprimirfactura_buscar.on("click", function () {
        var url = "/facturas/imprimir/"  + imprimirfactura_fecha_desde.val() +
            "/" + imprimirfactura_fecha_hasta.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    imprimirfactura_tbody.html(respuesta.imprimirfactura_tbody);
                }
                else {
                    imprimirfactura_tbody.html("");
                    swal('Cancelled', respuesta.error, 'error');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });
    // reporte factura

    reporte_factura_numero_factura.on("keyup", function () {
        clearInterval(reporte_factura_temporizador_numero_factura)
        reporte_factura_temporizador_numero_factura = setTimeout(buscarFactura, 600);
    });

    // reporte factura por contrato
    reporte_factura_contrato_buscar.on("click",function(){
        var url = "/facturas/reporte/contrato/" + reporte_factura_contrato_id_contrato.val() + "/";
        url += reporte_factura_contrato_desde.val() +"/" +reporte_factura_contrato_hasta.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    rellenarReporteContrato(respuesta.facturas);
                }
                else {
                    swal('Error', respuesta.error, 'error');
                    reporte_factura_contrato_tbody.html("");
                    reporte_factura_contrato_total.html("");
                }
            }, error: function (e) {
                console.log(e);
                reporte_factura_contrato_tbody.html("");
                reporte_factura_contrato_total.html("");
            }
        });
    });

    //-- declarar funciones auxiliares------------------------------------//

    // facturar
    function actualizarVariables() {
        facturar = $(".facturar");
        orden_id = $(".orden_id");
        agregarEventos();
    }

    function checkear() {
        if (facturar_all.prop('checked')) {
            facturar.prop('checked', true);
            orden_id.removeAttr("disabled");
        } else {
            facturar.prop('checked', false);
            orden_id.attr("disabled", true);
        }
        calcularValorTotal();
    }

    function calcularValorTotal() {
        var count = facturar.length;
        var total = 0;
        if (count > 0) {
            for (var i = 0; i < count; i++) {
                var orden = $(".facturar[data-id='" + i + "']");
                if (orden.prop('checked')) {
                    total = total + parseFloat(orden.attr("data-value"));
                }
            }
            facturar_total.html($.number(total, 2));
        } else {
            facturar_total.html("");
        }
    }

    function eliminarEventos() {
        facturar.unbind("change");
    }

    function agregarEventos() {
        eliminarEventos();
        //-- Agregar eventos ================================= //
        facturar.on("click", function () {
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

    // reporte factura
    function buscarFactura() {
        var url = "/facturas/reporte/factura/" + reporte_factura_numero_factura.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    rellenarReporteFactura(respuesta.factura_items);
                    reporte_factura_contrato.val(respuesta.factura.id_contrato.nombre);
                    reporte_factura_fecha_facturacion.val(respuesta.factura.created_at);
                    if(respuesta.factura.radicada){
                        reporte_factura_fecha_radicacion.val(respuesta.factura.fecha_radicacion);
                    }else{
                        reporte_factura_fecha_radicacion.val("");
                    }
                    reporte_factura_btn_imprimir.removeClass("hidden");
                }
                else {
                    reporte_factura_tbody.html("");
                    reporte_factura_total.html("");
                    reporte_factura_contrato.val("");
                    reporte_factura_fecha_facturacion.val("");
                    reporte_factura_fecha_radicacion.val("");
                    reporte_factura_btn_imprimir.addClass("hidden");
                }
            }, error: function (e) {
                console.log(e);
                reporte_factura_tbody.html("");
                reporte_factura_total.html("");
                reporte_factura_contrato.val("");
                reporte_factura_fecha_facturacion.val("");
                reporte_factura_fecha_radicacion.val("");
                reporte_factura_btn_imprimir.addClass("hidden");
            }
        });
    }

    function rellenarReporteFactura(facturaItems) {
        var tbody = ""
        var total = 0;

        $.each(facturaItems, function (ind, item) {
            tbody += "<tr>";
            tbody += "<td>" + item.cups + "</td>";
            tbody += "<td>" + item.descripcion + "</td>";
            tbody += "<td class='text-right'>" + $.number(item.cantidad, 2) + "</td>";
            tbody += "<td class='text-right'>" + $.number(item.valor_unitario, 2) + "</td>";
            tbody += "<td class='text-right'>" + $.number(item.copago, 2) + "</td>";
            tbody += "<td class='text-right'>" + $.number(item.valor_total, 2) + "</td>";
            tbody += "</tr>";
            total += parseFloat(item.valor_total);
        });

        reporte_factura_tbody.html(tbody);
        reporte_factura_total.html($.number(total,2));

    }

    function rellenarReporteContrato(facturas) {
        var tbody = ""
        var total = 0;

        $.each(facturas, function (ind, factura) {
            tbody += "<tr>";
            tbody += "<td class='text-center'><a href='/facturas/" + factura.id + "' target='_blank'>"+ factura.id+"</a></td>";
            tbody += "<td class='text-center'>" + factura.created_at + "</td>";
            tbody += "<td class='text-center'>" + (factura.radicada == 1 ? factura.fecha_radicacion : "") + "</td>";
            tbody += "<td class='text-right'>" + $.number(factura.factura_total, 2) + "</td>";
            tbody += "</tr>";
            total += parseFloat(factura.factura_total);
        });
        reporte_factura_contrato_tbody.html(tbody);
        reporte_factura_contrato_total.html($.number(total,2));

    }

});