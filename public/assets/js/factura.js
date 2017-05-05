$(function () {

    //-- Declarar variables =============================== //
    var facturar_contrato = $("#facturar_contrato");
    var facturar_fecha_desde = $("#facturar_fecha_desde");
    var facturar_fecha_hasta = $("#facturar_fecha_hasta");
    var btn_facturar_buscar = $("#btn_facturar_buscar");
    var facturar_tbody = $("#facturar_tbody");
    var facturar_total = $("#facturar_total");
    var facturar_all = $("#facturar_all");
    var facturar = $(".facturar");
    var orden_id = $(".orden_id");

//-- Declarar variables REPORTE TOTAL FACTURADO=============================== //
    var totalfacturado_contrato = $("#totalfacturado_contrato");
    var totalfacturado_aseguradora = $("#totalfacturado_aseguradora");
    var totalfacturado_fecha_inicio = $("#totalfacturado_fecha_inicio");
    var totalfacturado_fecha_fin = $("#totalfacturado_fecha_fin");
    var btn_totalfacturado_buscar = $("#btn_totalfacturado_buscar");
    var totalfacturado_tbody = $("#totalfacturado_tbody");

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //

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
                    facturar_all.prop('checked',true);
                    checkear();
                }
                else {
                    facturar_tbody.html("");
                    facturar_total.html("");
                    swal('Cancelled', respuesta.error, 'error');
                    actualizarVariables();
                    facturar_all.prop('checked',false);
                    checkear();
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });
  facturar_all.on("change",function () {
        checkear();
    });

    //-- Agregar evento TOTAL FACTURADO ================================= //

    btn_totalfacturado_buscar.on("click", function () {
        var url = "/facturas/buscar/" + totalfacturado_aseguradora.val() + "/" + totalfacturado_contrato.val() + "/" + totalfacturado_fecha_inicio.val() +
            "/" + totalfacturado_fecha_fin.val(); //la ruta que se desea ir y pasando los parametros
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    totalfacturado_tbody.html(respuesta.facturar_tbody);
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

    //-- declarar funciones auxiliares------------------------------------//

    function actualizarVariables(){
        facturar = $(".facturar");
        orden_id = $(".orden_id");
        agregarEventos();
    }

    function checkear(){
        if(facturar_all.prop('checked')){
            facturar.prop('checked',true);
            orden_id.removeAttr("disabled");
        }else{
            facturar.prop('checked',false);
            orden_id.attr("disabled",true);
        }
        calcularValorTotal();
    }
    
    function calcularValorTotal() {
        var count = facturar.length;
        var total = 0;
        if (count > 0){
            for(var i = 0; i < count; i++ ){
                var orden = $(".facturar[data-id='"+i+"']");
                if(orden.prop('checked')){
                    total = total + parseFloat(orden.attr("data-value"));
                }
            }
            facturar_total.html($.number(total,2));
        }else{
            facturar_total.html("");
        }
    }

    function eliminarEventos(){
        facturar.unbind("change");
    }

    function agregarEventos() {
        eliminarEventos();
        //-- Agregar eventos ================================= //
        facturar.on("click",function () {
            calcularValorTotal();
            var checkbox = $(this);
            var hideen = checkbox.parent()[0].children[1];

            if(checkbox.prop('checked')){
                hideen.removeAttribute('disabled');
            }else{
                hideen.setAttribute('disabled','disabled');
            }
        });

    }

})