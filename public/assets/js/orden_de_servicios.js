//función que se ejecuta al cargar la pagina
$(function(){
    //-- Declarar variables =============================== //
    var orden_documento = $("#orden-documento");
    var orden_nombre = $("#orden-nombre");
    var orden_aseguradora = $("#orden-aseguradora");
    var orden_contrato = $("#orden-contrato");
    var orden_servicios_cups = $("#orden_servicios_cups");
    var orden_servicios_descripcion = $("#orden_servicios_descripcion");
    var orden_servicios_cantidad = $("#orden_servicios_cantidad");
    var orden_servicios_copago = $("#orden_servicios_copago");
    var orden_servicios_valor_unitario = $("#orden_servicios_valor_unitario");
    var orden_servicios_valor_total = $("#orden_servicios_valor_total");


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
    //-- Agregar eventos cups ================================= //
    orden_servicios_cups.on("keyup",function(){    
        var url = "/procedimientos/cups/"+orden_servicios_cups.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(respuesta){
                if(respuesta.success){
                    orden_servicios_descripcion.val(respuesta.procedimiento.descripcion);
                }
                else{
                    orden_servicios_descripcion.val("");
                }
            },error: function(e){
                console.log(e);
            }
        });
    }); 

    orden_servicios_cantidad.on("keyup",function(){
     valorTotal();
    });
    orden_servicios_copago.on("keyup",function(){
     valorTotal();
    });
    orden_servicios_valor_unitario.on("keyup",function(){
     valorTotal();
    });
    //-- declarar funciones auxiliares------------------------------------//
    
    function valorTotal(){
        var cantidad= parseInt(orden_servicios_cantidad.val());
        var valor_unitario = parseFloat(orden_servicios_valor_unitario.val());
        var copago = parseFloat(orden_servicios_copago.val());
        var valor_total = 0;
        if(Number.isNaN(cantidad)){    
        cantidad = 0;
        }
         if(Number.isNaN(copago)){    
        copago = 0;
        }
         if(Number.isNaN(valor_unitario)){    
        valor_unitario= 0;
        }
         if(Number.isNaN(valor_total)){    
        valor_total = 0;
        }
        
        valor_total=(valor_unitario * cantidad) - copago;
        
        orden_servicios_valor_total.val(valor_total);
    }
});