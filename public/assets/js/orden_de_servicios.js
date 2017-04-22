//función que se ejecuta al cargar la pagina
$(function(){
    //-- Declarar variables =============================== //
    var orden_documento = $("#orden-documento");
    var orden_nombre = $("#orden-nombre");
    var orden_aseguradora = $("#orden-aseguradora");
    var orden_contrato = $("#orden-contrato");


    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    orden_documento.on("keyup",function(){    
        var url = "/pacientes/documento/"+orden_documento.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(respuesta){
                if(respuesta.success){
                    orden_nombre.val(respuesta.paciente.nombre);
                    
                    orden_contrato.val(respuesta.paciente.contrato);
                    var url= "/Aseguradora/"+respuesta.paciente.aseguradora_id;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function(respuesta){
                            if(respuesta.success){
                               orden_aseguradora.val(respuesta.aseguradora.nombre); 
                                
                            }else{
                                orden_aseguradora.val("No se encantro la aseguradora");
                            }
                        },error: function(e){
                            console.log(e);
                        }
                    });


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