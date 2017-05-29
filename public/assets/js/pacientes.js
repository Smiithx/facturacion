/**
 * Created by smiit on 22/4/2017.
 */
//función que se ejecuta al cargar la pagina
$(function(){
    //-- Declarar variables =============================== //
    var btn_eliminar_paciente = $(".btn-eliminar-paciente");
     var form_eliminar_paciente = $("#form-eliminar-paciente");

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    btn_eliminar_paciente.on("click",function(e){
        e.preventDefault();
        var parent = $(this).parent().parent().parent();
        var id = $(this).attr("data-id");
        swal({
            title: '¿Desea eliminar este paciente?',
            text: "¡No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si ',
            cancelButtonText: 'No ',
            /*confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',*/
            buttonsStyling: true
        }).then(function () {
            var url = "pacientes/"+ id;
            var datos = form_eliminar_paciente.serialize();
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
    });


});