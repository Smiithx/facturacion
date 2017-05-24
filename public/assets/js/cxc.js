//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables =============================== //
    
//-- Declarar variables cxc=============================== //
    var cxc_factura = $("#cxc_factura");   	

    var btn_cxc_buscar = $("#btn_cxc_buscar");
    var cxc_tbody = $("#cxc_tbody");
    var total_facturado_cxc = $("#total_facturado_cxc");
    var saldo_cxc = $("#saldo_cxc");


    //-- Fin de declarar variables ======================= //
         
       
  
     //-- Agregar evento Buscar Factura  ================================= //

    btn_cxc_buscar.on("click", function () {
        var url = "/facturas/cuentacobro/buscar/" + cxc_factura.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                  cxc_tbody.html(respuesta.cxc_tbody);
                  total_facturado_cxc.html(respuesta.total_facturado_cxc);
                  saldo_cxc.html(respuesta.saldo_cxc);


                }
                else {
                    cxc_tbody.html("");
                   total_facturado_cxc.html("");
                   saldo_cxc.html("");

                    swal('Cancelled', respuesta.error, 'error');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });

});
