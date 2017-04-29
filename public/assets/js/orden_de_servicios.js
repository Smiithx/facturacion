//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables =============================== //
    var orden_documento = $("#orden-documento");
    var orden_nombre = $("#orden-nombre");
    var orden_aseguradora = $("#orden-aseguradora");
    var orden_contrato = $("#orden-contrato");
    var orden_servicios_cups = $(".orden_servicios_cups");
    var orden_servicios_descripcion = $(".orden_servicios_descripcion");
    var orden_servicios_cantidad = $(".orden_servicios_cantidad");
    var orden_servicios_copago = $(".orden_servicios_copago");
    var orden_servicios_valor_unitario = $(".orden_servicios_valor_unitario");
    var orden_servicios_valor_total = $(".orden_servicios_valor_total");
    var temporizador_documento = 0;
    var temporizador_cups = 0;
    var orden_servicios_añadir = $("#orden_servicios_añadir");
    var orden_servicios_eliminar = $("#orden_servicios_eliminar");
    var orden_servicios_servicios = $("#orden_servicios_servicios");
    const orden_servicios_servicios_campos = '<tr><td><input required type="text" name="cups" class="form-control orden_servicios_cups"></td>' +
        '<td><input required type="text" name="descripcion" readonly class="form-control orden_servicios_descripcion"></td>' +
        '<td><input required type="number" name="cantidad" class="form-control orden_servicios_cantidad"></td>' +
        '<td><input required type="number" step="0.01" name="copago" class="form-control orden_servicios_copago"></td>' +
        '<td><input required type="number" step="0.01" name="valor_unitario" class="form-control orden_servicios_valor_unitario"></td>' +
        '<td><input required type="number" step="0.01" name="valor_total" readonly class="form-control orden_servicios_valor_total"></td></tr>';

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    orden_documento.on("keyup", function () {
        clearInterval(temporizador_documento)
        temporizador_documento = setTimeout(buscarPaciente, 1000);
    });

    agregarEventos();

    orden_servicios_añadir.on("click", function () {
        guardarValorAnterior();
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

    //-- declarar funciones auxiliares------------------------------------//

    function guardarValorAnterior() {

        var filas = $("#orden_servicios_servicios tr").length;

        var servicios = $("#orden_servicios_servicios tr");
        var fila = filas - 1;
        var inicio = "<tr>";
        var cups = '<td><input required type="text" name="cups" class="form-control orden_servicios_cups" value="' + servicios[fila].children[0].children.cups.value + '"></td>';
        var descripcion = '<td><input required type="text" name="descripcion" readonly class="form-control orden_servicios_descripcion" value="' + servicios[fila].children[1].children.descripcion.value + '"></td>';
        var cantidad = '<td><input required type="number" name="cantidad" class="form-control orden_servicios_cantidad" value="' + servicios[fila].children[2].children.cantidad.value + '"></td>';
        var copago = '<td><input required type="number" step="0.01" name="copago" class="form-control orden_servicios_copago" value="' + servicios[fila].children[3].children.copago.value + '"></td>';
        var valor_unitario = '<td><input required type="number" step="0.01" name="valor_unitario" class="form-control orden_servicios_valor_unitario" value="' + servicios[fila].children[4].children.valor_unitario.value + '"></td>';
        var valor_total = '<td><input required type="number" step="0.01" name="valor_total" readonly class="form-control orden_servicios_valor_total" value="' + servicios[fila].children[5].children.valor_total.value + '"></td>';
        var fin = "</tr>";
        var servicio = inicio + cups + descripcion + cantidad + copago + valor_unitario + valor_total + fin;

        if(filas > 1){
            var contenido_anterior = "";
            for(var i = 0; i < filas -1;i++){
                contenido_anterior = contenido_anterior + servicios[i].outerHTML;
            }
            contenido_anterior = contenido_anterior + servicio;
            orden_servicios_servicios.html(contenido_anterior);
        }else{
            orden_servicios_servicios.html(servicio);
        }
    }

    function valorTotal(fila) {
        var cantidad = parseInt(fila[0].children[2].children[0].value);
        var valor_unitario = parseFloat(fila[0].children[3].children[0].value);
        var copago = parseFloat(fila[0].children[4].children[0].value);
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

        fila[0].children[5].children[0].value = valor_total.toFixed(2);
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
                    orden_contrato.val(respuesta.paciente.contrato);
                    var aseguradora_id = respuesta.paciente.aseguradora_id;
                    var url = "/Aseguradora/" + respuesta.paciente.aseguradora_id;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function (respuesta) {
                            if (respuesta.success) {
                                orden_aseguradora.html("<option value='" + aseguradora_id + "'>" + respuesta.aseguradora.nombre + "</option>");
                                // orden_aseguradora.html(respuesta.aseguradora.nombre);

                            } else {
                                orden_aseguradora.html("<option value=''></option>");
                            }
                        }, error: function (e) {
                            console.log(e);
                        }
                    });


                } else {
                    orden_nombre.val("");
                    orden_aseguradora.html("<option value=''></option>");
                    orden_contrato.val("");
                }
            }, error: function (e) {
                orden_nombre.val("");
                orden_aseguradora.html("<option value=''></option>");
                orden_contrato.val("");
            }
        });
    }

    function buscarCups(fila) {
        var url = "/servicios/cups/" + fila[0].value;
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    fila.parent().parent()[0].children[1].children[0].value = respuesta.servicio.descripcion;
                }
                else {
                    fila.parent().parent()[0].children[1].children[0].value = "";
                }
            }, error: function (e) {
                fila.parent().parent()[0].children[1].children[0].value = "";
            }
        });
    }

    function actualizarVariables() {
        orden_servicios_cups = $(".orden_servicios_cups");
        orden_servicios_descripcion = $(".orden_servicios_descripcion");
        orden_servicios_cantidad = $(".orden_servicios_cantidad");
        orden_servicios_copago = $(".orden_servicios_copago");
        orden_servicios_valor_unitario = $(".orden_servicios_valor_unitario");
        orden_servicios_valor_total = $(".orden_servicios_valor_total");
        orden_servicios_servicios = $("#orden_servicios_servicios");
        agregarEventos();
    }

    function eliminarEventos(){
        orden_servicios_cups.unbind("keyup");
        orden_servicios_cantidad.unbind("keyup");
        orden_servicios_copago.unbind("keyup");
        orden_servicios_valor_unitario.unbind("keyup");
    }

    function agregarEventos() {
        eliminarEventos();
        //-- Agregar eventos cups ================================= //
        orden_servicios_cups.on("keyup", function () {
            clearInterval(temporizador_cups)
            temporizador_cups = setTimeout(buscarCups, 1000, $(this));
        });
        orden_servicios_cantidad.on("keyup", function () {
            valorTotal($(this).parent().parent());
        });
        orden_servicios_copago.on("keyup", function () {
            valorTotal($(this).parent().parent());
        });
        orden_servicios_valor_unitario.on("keyup", function () {
            valorTotal($(this).parent().parent());
        });

    }

});