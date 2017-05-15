//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables =============================== //
    var orden_documento_id_paciente = $("#orden-documento-id-paciente");
    var orden_documento = $("#orden-documento");
    var orden_nombre = $("#orden-nombre");
    var orden_aseguradora = $("#orden-aseguradora");
    var orden_contrato = $("#orden-contrato");
    var orden_servicios_cups = $(".orden_servicios_cups");
    var orden_servicios_descripcion = $(".orden_servicios_descripcion");
    var orden_servicios_cantidad = $(".orden_servicios_cantidad");
    var orden_servicios_copago = $(".orden_servicios_copago");
    var orden_servicios_valor_unitario = $(".orden_servicios_valor_unitario");
    var orden_servicios_valor_unitario_vista = $(".orden_servicios_valor_unitario_vista");
    var orden_servicios_valor_total = $(".orden_servicios_valor_total");
    var temporizador_documento = 0;
    var temporizador_cups = 0;
    var orden_servicios_añadir = $("#orden_servicios_añadir");
    var orden_servicios_eliminar = $("#orden_servicios_eliminar");
    var orden_servicios_servicios = $("#orden_servicios_servicios");

    const orden_servicios_servicios_campos = '<tr><td><input required type="text" name="cups[]" class="form-control orden_servicios_cups"></td>' +
        '<td><input required type="text" name="descripcion[]" readonly class="form-control orden_servicios_descripcion"></td>' +
        '<td><input required type="number" name="cantidad[]" class="form-control orden_servicios_cantidad"></td>' +
        '<td><input required type="number" step="0.01" name="copago[]" class="form-control orden_servicios_copago"></td>' +
        '<td><input required readonly class="form-control orden_servicios_valor_unitario_vista"></td>' +
        '<input type="hidden" name="valor_unitario[]" class="orden_servicios_valor_unitario">' +
        '<td><input required type="text" readonly class="form-control orden_servicios_valor_total"></td></tr>';

//-- Declarar variables REPORTE TOTAL FACTURADO=============================== //
    var fecha_inicio_ordenes_facturar = $("#fecha_inicio_ordenes_facturar");
    var fecha_fin_ordenes_facturar = $("#fecha_fin_ordenes_facturar");
    var tbody_ordenes_facturar = $("#tbody_ordenes_facturar");
    var btn_ordenes_facturar_buscar = $("#btn_ordenes_facturar_buscar");

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    orden_documento.on("keyup", function () {
        clearInterval(temporizador_documento)
        temporizador_documento = setTimeout(buscarPaciente, 1000);
    });
    orden_documento.change(function () {
        clearInterval(temporizador_documento)
        temporizador_documento = setTimeout(buscarPaciente, 1000);
    });

    agregarEventos();

    orden_servicios_añadir.on("click", function () {
        orden_servicios_servicios.append(orden_servicios_servicios_campos);
        actualizarVariables();
    });

    orden_servicios_eliminar.on("click", function () {
        // Obtenemos el total de columnas (tr) del id "tabla"
        eliminarEventos();
        var trs = $("#orden_servicios_servicios tr").length;
        if (trs > 1) {
            // Eliminamos la ultima columna
            $("#orden_servicios_servicios tr:last").remove();
        }
        actualizarVariables();
    });

    //-- Agregar evento ORDENES POR FACTURAr================================= //

    btn_ordenes_facturar_buscar.on("click", function () {
        var url = "/ordenservicio/ordenes_facturar/" + fecha_inicio_ordenes_facturar.val() +
            "/" + fecha_fin_ordenes_facturar.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    tbody_ordenes_facturar.html(respuesta.tbody_ordenes_facturar);
                }
                else {
                    tbody_ordenes_facturar.html("");
                    swal('Cancelled', respuesta.error, 'error');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });


    //-- declarar funciones auxiliares------------------------------------//

    function valorTotal(fila) {
        console.log();
        var cantidad = parseInt(fila[0].children[2].children[0].value);
        var copago = parseFloat(fila[0].children[3].children[0].value);
        var valor_unitario = parseFloat(fila[0].children[4].children[1].value);
        if (Number.isNaN(cantidad)) {
            cantidad = 0;
        }
        if (Number.isNaN(copago)) {
            copago = 0;
        }
        if (Number.isNaN(valor_unitario)) {
            valor_unitario = 0;
        }

        var valor_total = (valor_unitario * cantidad) - copago;

        fila[0].children[5].children[0].value = $.number(valor_total,2);
    }

    function buscarPaciente() {
        var url = "/pacientes/documento/" + orden_documento.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    orden_nombre.val(respuesta.paciente.nombre);
                    orden_contrato.html("<option value='" + respuesta.paciente.id_contrato.id + "'>" + respuesta.paciente.id_contrato.nombre + "</option>");
                    orden_documento_id_paciente.val(respuesta.paciente.id);
                    var aseguradora = respuesta.paciente.aseguradora_id;
                    orden_aseguradora.html("<option value='" + aseguradora.id + "'>" + aseguradora.nombre + "</option>");
                } else {
                    orden_documento_id_paciente.val("");
                    orden_nombre.val("");
                    orden_aseguradora.html("<option value=''></option>");
                    orden_contrato.val("");
                }
            }, error: function (e) {
                orden_nombre.val("");
                orden_aseguradora.html("<option value=''></option>");
                orden_contrato.val("");
                orden_documento_id_paciente.val("");
            }
        });
    }

    function buscarCups(fila) {
        var url = "/servicios/cups/" + fila[0].value + "/" + orden_contrato.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    fila.parent().parent()[0].children[1].children[0].value = respuesta.servicio.descripcion;
                    fila.parent().parent()[0].children[4].children[0].value = $.number(respuesta.precio,2);
                    fila.parent().parent()[0].children[4].children[1].value = respuesta.precio
                }
                else {
                    fila.parent().parent()[0].children[1].children[0].value = "";
                    fila.parent().parent()[0].children[4].children[0].value = "";
                    fila.parent().parent()[0].children[4].children[1].value = 0;
                }
            }, error: function (e) {
                fila.parent().parent()[0].children[1].children[0].value = "";
                fila.parent().parent()[0].children[4].children[0].value = "";
                fila.parent().parent()[0].children[4].children[1].value = 0;
            }
        });
    }

    function actualizarVariables() {
        orden_servicios_cups = $(".orden_servicios_cups");
        orden_servicios_descripcion = $(".orden_servicios_descripcion");
        orden_servicios_cantidad = $(".orden_servicios_cantidad");
        orden_servicios_copago = $(".orden_servicios_copago");
        orden_servicios_valor_unitario = $(".orden_servicios_valor_unitario");
        orden_servicios_valor_unitario_vista = $(".orden_servicios_valor_unitario_vista");
        orden_servicios_valor_total = $(".orden_servicios_valor_total");
        orden_servicios_servicios = $("#orden_servicios_servicios");
        agregarEventos();
    }

    function eliminarEventos() {
        orden_servicios_cups.unbind("keyup");
        orden_servicios_cantidad.unbind("keyup");
        orden_servicios_copago.unbind("keyup");
        orden_servicios_valor_unitario_vista.unbind("keyup");
    }

    function agregarEventos() {
        eliminarEventos();
        //-- Agregar eventos cups ================================= //
        orden_servicios_cups.on("keyup", function () {
            clearInterval(temporizador_cups)
            temporizador_cups = setTimeout(buscarCups, 1000, $(this));
        });
        orden_servicios_cups.on("blur", function () {
            clearInterval(temporizador_cups)
            temporizador_cups = setTimeout(buscarCups, 500, $(this));
        });
        orden_servicios_cantidad.on("keyup", function () {
            valorTotal($(this).parent().parent());
        });
        orden_servicios_copago.on("keyup", function () {
            valorTotal($(this).parent().parent());
        });
        orden_servicios_valor_unitario_vista.on("keyup", function () {
            valorTotal($(this).parent().parent());
        });

    }

});