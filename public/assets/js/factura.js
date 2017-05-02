$(function () {

	var facturar_contrato = $("#facturar_contrato");
    var facturar_fecha_desde = $("#facturar_fecha_desde");
    var facturar_fecha_hasta = $("#facturar_fecha_hasta");
    var btn_facturar_buscar = $("#btn_facturar_buscar");
    var facturar_tbody = $("#facturar_tbody");

//-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //

    btn_facturar_buscar.on("click",function(){
    	 var url = "ordenservicio/buscar/"+ facturar_contrato.val() +"/"+ facturar_fecha_desde.val()+"/"+facturar_fecha_hasta; //la ruta que se desea ir y pasando los parametros
             $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.success){
                    	facturar_tbody.html(repuesta.ordenes);                   	
                       
                    }
                    else{
                        swal(
                            'Cancelled',
                            respuesta.error,
                            'errors'
                        );
                    }
                },error: function(e){
                    console.log(e);
                }
            });


    });
    

})