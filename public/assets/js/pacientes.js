/**
 * Created by smiit on 22/4/2017.
 */
//función que se ejecuta al cargar la pagina
$(function(){
    //-- Declarar variables =============================== //
    var btn_eliminar_paciente = $("#btn-eliminar-paciente");

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //
    btn_eliminar_paciente.on("click",function(e){
        e.preventDefault();
        swal({
            title: '¿Esta seguro que desea eliminar este paciente?',
            text: "¡No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {
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