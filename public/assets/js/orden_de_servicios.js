//función que se ejecuta al cargar la pagina
$(function(){
    //-- Declarar variables =============================== //
    var orden_documento = $("#orden-documento");
    var orden_nombre = $("#orden-nombre");
    var orden_aseguradora = $("#orden-aseguradora");
    var orden_contrato = $("#orden-contrato");


    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
orden_documento.focusout(function(){    
        var url = "/pacientes/documento/"+orden_documento.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(respuesta){
                if(respuesta.success){
                    orden_nombre.val(respuesta.paciente.nombre);
                    orden_aseguradora.val(respuesta.paciente.aseguradora_id);
                    orden_contrato.val(respuesta.paciente.contrato);

                }else{
                    orden_nombre.val("");
                    orden_aseguradora.val("");
                    orden_contrato.val("");
                }
            },error: function(e){
                console.log(e);
            }
        });
    });   

});