$(function(){
    //-- Declarar variables =============================== //

    // global

    var campos_fecha = $( ".datepicker" );

    //-- Fin de declarar variables ======================= //

    //-- Agregar eventos ================================= //

    // global

    $('[data-toggle=tooltip]').tooltip();
    clearTimeout();

    if(campos_fecha.length > 0){
        campos_fecha.datepicker({
            changeMonth: true,
            changeYear: true,
        });
        campos_fecha.datepicker("option",$.datepicker.regional['es']);    
        campos_fecha.datepicker("option", "dateFormat", "yy-mm-dd");    
    }

    //-- Fin de agregar eventos ========================== //

    //-- Funciones auxiliares ============================ //



    //-- Fin de funciones auxiliares ======================= // 
});