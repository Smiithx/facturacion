//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables =============================== //
    
//-- Declarar variables cartera=============================== //
    var cartera_factura = $("#cartera_factura");
   	var cartera_desde = $("#cartera_desde");
    var cartera_hasta = $("#cartera_hasta");
    var btn_cartera_buscar = $("#btn_cartera_buscar");
    var cartera_tbody = $("#cartera_tbody");
   var cartera_factura_total  = $("#cartera_factura_total");
   var cartera_valor_abono  = $("#cartera_valor_abono");
   var cartera_retencion  = $("#cartera_retencion");
   var cartera_saldo  = $("#cartera_saldo");

    //-- Fin de declarar variables ======================= //


     //-- Agregar evento Buscar Factura en la Vista glosa ================================= //

    btn_cartera_buscar.on("click", function () {
        var url = "/cartera/buscar/" + cartera_factura.val() + "/" + cartera_desde.val() +
            "/" + cartera_hasta.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    cartera_tbody.html(respuesta.cartera_tbody);
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

cartera_valor_abono.change(function() {

    console.log("probando");

 });


   });

