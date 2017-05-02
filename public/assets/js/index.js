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
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            language: "es",
            toggleActive: true,
            autoclose: true
        });
    }

    //-- Fin de agregar eventos ========================== //

    //-- Funciones auxiliares ============================ //



    //-- Fin de funciones auxiliares ======================= // 
});