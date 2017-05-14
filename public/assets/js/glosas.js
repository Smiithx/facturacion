//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables =============================== //
    
//-- Declarar variables Glosas=============================== //
    var glosas_factura = $("#glosas_factura");   	
   	var glosas_desde = $("#glosas_desde");
    var glosas_hasta = $("#glosas_hasta");
    var btn_glosas_buscar = $("#btn_glosas_buscar");
    var glosas_tbody = $("#glosas_tbody");

    //-- Fin de declarar variables ======================= //


     //-- Agregar evento Buscar Factura en la Vista glosa ================================= //

    btn_glosas_buscar.on("click", function () {
        var url = "/glosas/buscar/" + glosas_factura.val() + "/" + glosas_desde.val() +
            "/" + glosas_hasta.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    glosas_tbody.html(respuesta.glosas_tbody);
                }
                else {
                    glosas_tbody.html("");
                    swal('Cancelled', respuesta.error, 'error');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });

});