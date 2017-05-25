<section id="menu">
    <ul class="nav">
        <li class="active"><a href="/">Home</a></li>
        <li>
            <a href="/pacientes">Pacientes</a>
            <ul>
                <li><a href="/pacientes/create" class="list-group-item">Crear</a></li>
            </ul>
        </li>
        <li><a href="">Facturas</a>
            <ul>
                <li><a class="list-group-item" href="/facturas/create">Facturar</a></li>
                <li><a class="list-group-item" href="/ordenservicio/create">Orden de servicio</a></li>
                <li class="submenu">
                    <a class="list-group-item" href="">Reportes</a>
                    <ul class="submenu-item">
                        <li><a class="list-group-item" href="/facturas/reporte/factura">Factura</a></li>
                        <li><a class="list-group-item" href="/facturas/reporte/contrato">Contrato</a></li>
                        <li><a href="/ordenservicio" class="list-group-item">Ordenes de servicio</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="">Radicación</a>
            <ul>
                <li><a class="list-group-item" href="/radicacion/create">Factura</a></li>
                <li><a class="list-group-item" href="/radicacion/contrato/create">Contrato</a></li>
            </ul>
        </li>
        <li>
            <a>Glosas</a>
            <ul>
                <li><a class="list-group-item" href="/glosas/create">Factura</a></li>
                <li><a class="list-group-item" href="/glosas/create/contrato">Contrato</a></li>
                <li class="submenu">
                    <a class="list-group-item" href="">Reportes</a>
                    <ul class="submenu-item">
                        <li><a class="list-group-item" href="/glosas/editar">Factura</a></li>
                    </ul>
                </li>


            </ul>
        </li>
        <li>
            <a>Cartera</a>
            <ul>
                <li><a class="list-group-item" href="/cartera/create">Factura</a></li>
                <li><a class="list-group-item" href="/cartera/create/contrato">Contrato</a></li>
                <li class="submenu">
                    <a class="list-group-item" href="">Reportes</a>
                    <ul class="submenu-item">
                        <li><a class="list-group-item" href="/cartera/editar">Factura</a></li>
                    </ul>
                </li>

            </ul>
        </li>
        <li>
            <a>Abonos</a>
            <ul>
                <li><a class="list-group-item" href="/abonos">Ver Abonos</a></li>

            </ul>
        </li>
        <li><a href="/reportes">Reportes</a></li>
        <li><a href="/administracion">Administración</a></li>
        <li><a href="{{route("logout")}}">Desconectar</a></li>
    </ul>
</section>
