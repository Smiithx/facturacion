/**
 * Created by smiit on 29/5/2017.
 */
//función que se ejecuta al cargar la pagina
$(function () {
    //-- Declarar variables =============================== //

    // index
    var btn_eliminar_servicio = $(".btn_eliminar_servicio");
    var form_eliminar_servicio = $("#form_eliminar_servicio");

    //-- Fin de declarar variables ======================= //


    //-- Agregar eventos ================================= //

    //--  index ================================= //

    /*btn_eliminar_servicio.on("click",function(e){
        e.preventDefault();
        var parent = $(this).parent().parent().parent();
        var id = $(this).attr("data-id");
        swal({
            title: '¿Desea eliminar este usuario?',
            text: "¡No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si ',
            cancelButtonText: 'No ',
            buttonsStyling: true
        }).then(function () {
            var url = "usuarios/"+ id;
            var datos = form_eliminar_usuario.serialize();
            $.ajax({
                url: url,
                type: "delete",
                dataType: "json",
                data: datos,
                success: function(respuesta){
                    if(respuesta.success){
                        swal({
                            title: 'Deleted!',
                            html: respuesta.mensaje,
                            type: 'success',
                            confirmButtonText: 'Ok'
                        }).then(function () {
                            parent.remove();
                        });
                    }else{
                        swal(
                            'Cancelled',
                            respuesta.error,
                            'error'
                        );
                    }
                },error: function(e){
                    console.log(e);
                }
            });
        })
    });*/

    //-- declarar funciones auxiliares------------------------------------//



});