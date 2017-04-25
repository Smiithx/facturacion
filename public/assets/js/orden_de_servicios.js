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
    var temporizador_documento = 0;
    var temporizador_cups = 0;

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    orden_documento.on("keyup",function(){
        clearInterval(temporizador_documento)
        temporizador_documento = setTimeout(buscarPaciente,1000);

    }); 
    //-- Agregar eventos cups ================================= //
    orden_servicios_cups.on("keyup",function(){
        clearInterval(temporizador_cups)
        temporizador_cups = setTimeout(buscarCups,1000);
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
    function interval(){
        t=1;
        setInterval(function(){
            document.getElementById("testdiv").innerHTML=t++;
        },1000,"JavaScript");
    }
    function timeout(){
        setTimeout(function(){
            document.getElementById("testdiv").innerHTML="Pasaron 2 segundos antes de que pudieras ver esto.";
        },2000,"JavaScript");
    }

    function buscarPaciente(){
        var url = "/pacientes/documento/"+orden_documento.val();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(respuesta){
                if(respuesta.success){
                    orden_nombre.val(respuesta.paciente.nombre);
                    orden_contrato.val(respuesta.paciente.contrato);
                    var aseguradora_id = respuesta.paciente.aseguradora_id;
                    var url= "/Aseguradora/"+respuesta.paciente.aseguradora_id;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function(respuesta){
                            if(respuesta.success){
                                orden_aseguradora.html("<option value='"+aseguradora_id+"'>"+respuesta.aseguradora.nombre+"</option>");
                                // orden_aseguradora.html(respuesta.aseguradora.nombre);

                            }else{
                                orden_aseguradora.html("<option value=''></option>");
                            }
                        },error: function(e){
                            console.log(e);
                        }
                    });


                }else{
                    orden_nombre.val("");
                    orden_aseguradora.html("<option value=''></option>");
                    orden_contrato.val("");
                }
            },error: function(e){
                orden_nombre.val("");
                orden_aseguradora.html("<option value=''></option>");
                orden_contrato.val("");
            }
        });
    }

    function buscarCups(){
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
                orden_servicios_descripcion.val("");
            }
        });
    }

});