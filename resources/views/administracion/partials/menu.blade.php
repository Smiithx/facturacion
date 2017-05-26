<h2 class="text-center">{{$pagina}}</h2>
<hr>
<div class="col-xs-3">
    <!-- required for floating -->
    <!-- Nav tabs -->
    <ul class="nav nav-pills nav-stacked">
        <li class="{{ $seccion == 'empresa' ? 'active' : ''}}">
            <a href="/administracion">Datos de la empresa</a>
        </li>
        <li class="{{ $seccion == 'usuario' ? 'active' : ''}}">
            <a href="{{route("usuarios.index")}}">Usuarios</a>
        </li>
        <li class="{{ $seccion == 'servicio' ? 'active' : ''}}">
            <a href="/servicios">Servicios</a>
        </li>
        <li class="{{ $seccion == 'aseguradora' ? 'active' : ''}}">
            <a href="/aseguradoras">Aseguradoras</a>
        </li>
        <li class="{{ $seccion == 'contrato' ? 'active' : ''}}">
            <a href="/contratos">Contratos</a>
        </li>
        <li class="{{ $seccion == 'manual' ?  'active' : ''}}">
            <a href="/manuales">Manuales</a>
        </li>	
        <li class="{{ $seccion == 'diagnostico' ? 'active' : ''}}">
            <a href="/diagnosticos">Diagnosticos</a>
        </li>
    </ul>
</div>