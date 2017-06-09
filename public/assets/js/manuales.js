/**
 * Created by smiit on 7/6/2017.
 */
//función que se ejecuta al cargar la pagina
$(function () {

    //-- Variables =============================== //

    // manual
    var btn_manuales_servicios = $(".btn_manuales_servicios");
    var manual_show = $(".manual_show");

    // manuales_servicios
    var manuales_servicios_cups = $("#manuales_servicios_cups");
    var manuales_servicios_buscar = $("#manuales_servicios_buscar");
    var manuales_servicios_tbody = $("#manuales_servicios_tbody");
    var manuales_servicios_paginacion = $("#manuales_servicios_paginacion");
    var manuales_servicios_paginacion_item = $(".manuales_servicios_paginacion_item");

    // manuales servicios create
    var modal_manual_servicios_create = $("#modal_manual_servicios_create");
    var manual_servicios_agregar = $("#manual_servicios_agregar");
    var form_manuales_servicios_agregar = $("#form_manuales_servicios_agregar");
    var manuales_servicios_page = 1;
    var manuales_servicios_limit_results = 8;

    // manuales servicios editar
    var btn_manual_servicio_editar = $(".btn_manual_servicio_editar");
    var manual_servicio_editar_id_servicio = $("#manual_servicio_editar_id_servicio");
    var manual_servicio_editar_costo = $("#manual_servicio_editar_costo");
    var manual_servicio_editar_estado = $("#manual_servicio_editar_estado");
    var manual_servicios_editar_actualizar = $("#manual_servicios_editar_actualizar");
    var modal_manual_servicios_editar = $("#modal_manual_servicios_editar");
    var form_manuales_servicios_editar = $("#form_manuales_servicios_editar");

    // manual servicio eliminar
    var form_manual_servicio_eliminar = $("#form_manual_servicio_eliminar");
    var btn_manual_servicio_eliminar = $(".btn_manual_servicio_eliminar");

    //-- Fin de variables ======================= //

    //-- Agregar eventos ================================= //
    btn_manuales_servicios.on("click", function () {
        var id = $(this).data("id");
        manual_show.data("id", id);
        manuales_servicios_page = 1;
        buscarManual();
    });

    manuales_servicios_buscar.on("click", function () {
        manuales_servicios_page = 1;
        buscarManual();
    });

    manual_servicios_agregar.on("click", function (e) {
        e.preventDefault();
        var url = "/manuales/" + manual_show.data("id") + "/servicios";
        var datos = form_manuales_servicios_agregar.serialize();
        $.ajax({
            url: url,
            type: "POST",
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    swal({
                        title: 'Success!',
                        html: respuesta.mensaje,
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).then(function () {
                        form_manuales_servicios_agregar[0].reset();
                        modal_manual_servicios_create.modal("hide");
                        buscarManual();
                    });
                } else {
                    swal('Error!', respuesta.error, 'error');
                }
            }, error: function (e) {

            }
        });
    });

    manual_servicios_editar_actualizar.on("click", function (e) {
        e.preventDefault();
        var url = "/manuales/" + manual_show.data("id") + "/servicios/" + modal_manual_servicios_editar.data("id");
        var datos = form_manuales_servicios_editar.serialize();
        $.ajax({
            url: url,
            type: "POST",
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    swal({
                        title: 'Success!',
                        html: respuesta.mensaje,
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).then(function () {
                        form_manuales_servicios_editar[0].reset();
                        modal_manual_servicios_editar.modal("hide");
                        buscarManual();
                        buscarServicio();
                    });
                } else {
                    swal('Error!', respuesta.error, 'error');
                }
            }, error: function (e) {

            }
        });
    });

    //-- Funciones auxiliares------------------------------------//

    function buscarManual() {
        var url = "/manuales/" + manual_show.data("id");

        var datos = {
            cup: manuales_servicios_cups.val(),
            page: manuales_servicios_page,
            limit_results: manuales_servicios_limit_results
        };
        $.ajax({
            url: url,
            type: "GET",
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    rellenarManualesServiciosTbody(respuesta.servicios);
                    rellenarPaginacion(respuesta.total_results);
                    actualizarVariables();
                } else {
                    manuales_servicios_tbody.html("<tr><td colspan='7'><p class='text-info'>" + respuesta.error + ".</p></td></tr>");
                    manuales_servicios_paginacion.html("");
                }
            }, error: function (e) {
                manuales_servicios_tbody.html("");
                manuales_servicios_paginacion.html("");
            }
        });
    }

    function buscarServicio() {
        var url = "/manuales/" + manual_show.data("id") + "/servicios/" + modal_manual_servicios_editar.data("id") + "/edit";
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    manual_servicio_editar_id_servicio.val(respuesta.manual_servicio.id_servicio.id);
                    manual_servicio_editar_costo.val(respuesta.manual_servicio.costo);
                    manual_servicio_editar_estado.val(respuesta.manual_servicio.estado);
                } else {
                    manual_servicio_editar_costo.val(0);
                }
            }, error: function (e) {
                manual_servicio_editar_costo.val(0);
            }
        });
    }

    function eliminarServicio(id_manual,id_servicio){
        var url = "/manuales/" + id_manual + "/servicios/" + id_servicio;
        var datos = form_manual_servicio_eliminar.serialize();
        $.ajax({
            url: url,
            type: "POST",
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.success) {
                    swal({
                        title: 'Success!',
                        html: respuesta.mensaje,
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).then(function () {
                        buscarManual();
                    });
                } else {
                    swal('Error!', respuesta.error, 'error');
                }
            }, error: function (e) {

            }
        });
    }

    function actualizarVariables() {
        manuales_servicios_paginacion_item = $(".manuales_servicios_paginacion_item");
        btn_manual_servicio_editar = $(".btn_manual_servicio_editar");
        btn_manual_servicio_eliminar = $(".btn_manual_servicio_eliminar");
        agregarEventos();
    }

    function eliminarEventos() {
        manuales_servicios_paginacion_item.unbind("click");
        btn_manual_servicio_editar.unbind("click");
        btn_manual_servicio_eliminar.unbind("click");
    }

    function agregarEventos() {
        eliminarEventos();
        //-- Agregar eventos cups ================================= //
        manuales_servicios_paginacion_item.on("click", function (e) {
            //e.preventDefault();
            var boton_page = $(this).data("page");
            if (boton_page != "disabled" && boton_page != manuales_servicios_page) {
                manuales_servicios_page = boton_page;
                buscarManual();
            }
        });

        btn_manual_servicio_editar.on("click", function () {
            var id = $(this).data("id");
            modal_manual_servicios_editar.data("id",id);
            buscarServicio();
        });

        btn_manual_servicio_eliminar.on("click", function () {
            var id_servicio = $(this).data("id");
            var id_manual = manual_show.data("id");
            eliminarServicio(id_manual,id_servicio);
        });
    }

    function rellenarManualesServiciosTbody(servicios) {
        var tbody = "";
        var id = manual_show.data("id", id);
        $.each(servicios, function (index, servicio) {
            tbody += "<tr>";
            tbody += "<td class='text-center'>" + servicio.id + "</td>";
            tbody += "<td class='text-center'>" + servicio.cups + "</td>";
            tbody += "<td class='text-center'>" + servicio.estado + "</td>";
            tbody += "<td>" + servicio.descripcion + "</td>";
            tbody += "<td class='text-right'>" + $.number(servicio.costo, 2) + "</td>";
            tbody += "<td class='text-center'>" + servicio.estado + "</td>";
            tbody += "<td class='acciones'>";
            tbody += "<button  class='btn btn-success btn_manual_servicio_editar' data-toggle='modal' data-target='#modal_manual_servicios_editar' data-id='" + servicio.id + "'>";
            tbody += "<i class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></i>";
            tbody += "</button>";
            tbody += "<button class='btn btn-danger btn_manual_servicio_eliminar' data-toggle='tooltip' title='Eliminar' data-id='" + servicio.id + "'>" +
                "<i class='glyphicon glyphicon-remove'></i>" +
                "</button>";
            tbody += "</td>";
            tbody += "</tr>";
        });
        manuales_servicios_tbody.html(tbody);
    }

    function rellenarPaginacion(total_results) {
        var total_paginas = Math.ceil(total_results / manuales_servicios_limit_results);
        var paginacion = "";

        if (total_paginas > 1) {
            if (manuales_servicios_page != 1) {
                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + (manuales_servicios_page - 1) + "' aria-label=\"Previous\">";
                paginacion += "<span aria-hidden=\"true\">&laquo;</span></a></li>";
            }
            if (manuales_servicios_page < 7) {
                if (total_paginas < 11) {
                    for (var i = 1; i <= total_paginas; i++) {
                        if (manuales_servicios_page == i) {
                            //si muestro el índice de la página actual, no coloco enlace
                            paginacion += "<li class='active'><a href=\"#\" data-page='" + i + "' class='manuales_servicios_paginacion_item'>" + i + " <span class=\"sr-only\">(current)</span></a></li>";
                        }
                        else {
                            paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + i + "'>" + i + "</a></li>";
                        }
                    }
                } else {
                    for (var i = 1; i <= total_paginas; i++) {
                        if (manuales_servicios_page == i)
                        //si muestro el índice de la página actual, no coloco enlace
                            paginacion += "<li class='active'><a href=\"#\" data-page='" + i + "' class='manuales_servicios_paginacion_item'>" + i + " <span class=\"sr-only\">(current)</span></a></li>";
                        else {
                            if (i == 9) {
                                paginacion += "<li class='disabled'><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='disabled'>...</a></li>";
                                next = total_paginas - 1;
                                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + next + "'>" + next + "</a></li>";
                                next += 1;
                                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + next + "'>" + next + "</a></li>";
                                break;
                            } else {
                                //si el índice no corresponde con la página mostrada actualmente,
                                //coloco el enlace para ir a esa página
                                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + i + "'>" + i + "</a></li>";
                            }
                        }
                    }
                }
            }
            if (manuales_servicios_page >= 7 && total_paginas >= 11 && manuales_servicios_page <= total_paginas - 6) {

                // botones anteriores
                preview = 1;
                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='preview'>" + preview + "</a></li>";
                preview += 1;
                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='preview'>" + preview + "</a></li>";
                paginacion += "<li class='disabled'><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='disabled'>...</a></li>";

                for (var i = manuales_servicios_page - 3; i <= manuales_servicios_page; i++) {
                    if (manuales_servicios_page == i) {
                        //si muestro el índice de la página actual, no coloco enlace
                        paginacion += "<li class='active'><a href=\"#\" data-page='" + i + "' class='manuales_servicios_paginacion_item'>" + i + " <span class=\"sr-only\">(current)</span></a></li>";
                    } else {
                        paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + i + "'>" + i + "</a></li>";
                    }
                }

                for (var i = manuales_servicios_page + 1; i <= manuales_servicios_page + 3; i++) {
                    paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + i + "'>" + i + "</a></li>";
                }

                // next
                paginacion += "<li class='disabled'><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='disabled'>...</a></li>";
                next = total_paginas - 1;
                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + next + "'>" + next + "</a></li>";
                next += 1;
                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + next + "'>" + next + "</a></li>";

            }
            if (manuales_servicios_page > total_paginas - 6 && total_paginas >= 11 && manuales_servicios_page <= total_paginas) {
                // botones anteriores
                preview = 1;
                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='preview'>" + preview + "</a></li>";
                preview += 1;
                paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='preview'>" + preview + "</a></li>";
                paginacion += "<li class='disabled'><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='disabled'>...</a></li>";

                for (var i = total_paginas - 8; i <= total_paginas; i++) {
                    if (manuales_servicios_page == i) {
                        //si muestro el índice de la página actual, no coloco enlace
                        paginacion += "<li class='active'><a href=\"#\" data-page='" + i + "' class='manuales_servicios_paginacion_item'>" + i + " <span class=\"sr-only\">(current)</span></a></li>";
                    } else {
                        paginacion += "<li><a href=\"#\" class='manuales_servicios_paginacion_item' data-page='" + i + "'>" + i + "</a></li>";
                    }
                }

            }
            if (manuales_servicios_page != total_paginas) {
                paginacion += "<li><a href =\"#\" class='manuales_servicios_paginacion_item' data-page='" + (manuales_servicios_page + 1) + "' aria-label=\"Next\">";
                paginacion += "<span aria-hidden =\"true\">&raquo;</span></a></li>";
            }
        }

        manuales_servicios_paginacion.html(paginacion);
    }

    /**
     {!! Form::open(['route' => ['manuales.servicios.destroy',$manual->"+ i + "d, $servicio->"+ i + "d], 'method' => 'delete']) !!}
     <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar'>
     <i class='glyphicon glyphicon-remove'></i>
     </button>
     {!! Form::close() !!}
     </td>
     </tr>
     href='/manuales/" + id + "/servicios/" + servicio.id + "/edit'
     */

});