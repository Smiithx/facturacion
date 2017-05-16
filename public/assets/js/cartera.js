//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables =============================== //

    //-- Declarar variables cartera=============================== //
    var cartera_factura = $("#cartera_factura");
    var cartera_contrato = $("#cartera_contrato");

    var cartera_desde = $("#cartera_desde");
    var cartera_hasta = $("#cartera_hasta");
    var btn_cartera_buscar = $("#btn_cartera_buscar");
    var cartera_tbody = $("#cartera_tbody");
    var cartera_factura_total  = $("#cartera_factura_total");
    var cartera_glosa  = $("#cartera_glosa");
    var cartera_valor_abono  = $("#cartera_valor_abono"); // este es input de abono
    var cartera_retencion  = $("#cartera_retencion"); // este es el de retencion
    var cartera_saldo  = $("#cartera_saldo"); // y este es donde lo tienq q mostrar

    //-- Fin de declarar variables ======================= //


    //-- Agregar evento Buscar Factura en la Vista glosa ================================= //

    btn_cartera_buscar.on("click", function () {
        var url = "/cartera/buscar/" + cartera_factura.val() + "/"+ cartera_contrato.val() + "/" + cartera_desde.val() +
            "/" + cartera_hasta.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    cartera_tbody.html(respuesta.cartera_tbody);
                    actualizarVariables();
                }
                else {
                    cartera_tbody.html("");
                    swal('Cancelled', respuesta.error, 'error');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });

 
    function eliminarEventos() {
        cartera_valor_abono.unbind("keyup");
        cartera_retencion.unbind("keyup");

    }


    function actualizarVariables() {  // lass variables luego de buscar
        cartera_valor_abono = $("#cartera_valor_abono"); 
        cartera_retencion  = $("#cartera_retencion");
        cartera_saldo  = $("#cartera_saldo");
          cartera_factura_total  = $("#cartera_factura_total");
          cartera_glosa  = $("#cartera_glosa");

        agregarEventos();


    }

    function agregarEventos() {
        eliminarEventos();
        //-- Agregar eventos ================================= //
        cartera_valor_abono.on("keyup", function () {
            sumar();
        });

        cartera_retencion.on("keyup", function () {
            sumar();

        });
    }

    function sumar(){

       
        var totalfactura =parseFloat(cartera_factura_total.attr('data-value'));
        var glosa =parseFloat(cartera_glosa.attr('data-value'));


        var saldo = parseFloat(cartera_valor_abono.val());
        var retencio = parseFloat(cartera_retencion.val());
        var total = 0;
        total = parseFloat(totalfactura - (saldo + retencio + glosa));
       cartera_saldo.val($.number(total,2));
        

    }



    });

