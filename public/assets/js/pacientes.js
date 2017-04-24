/**
 * Created by smiit on 22/4/2017.
 */
//función que se ejecuta al cargar la pagina
$(function(){
    //-- Declarar variables =============================== //
    var btn_eliminar_paciente = $("#btn-eliminar-paciente");
     var form_eliminar_paciente = $("#form-eliminar-paciente");

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    btn_eliminar_paciente.on("click",function(e){
        e.preventDefault();
        swal({
            title: '¿Desea eliminar este paciente?',
            text: "¡No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si ',
            cancelButtonText: 'No ',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            buttonsStyling: true
        }).then(function () {
            var url = "";
            var datos = form_eliminar_paciente.serialize();
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
            swal(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    });

});