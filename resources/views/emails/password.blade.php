<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Restablece contraseña</title>
</head>
<body>
<hr>
<p>Hola</p>
<p>Hemos recibido una solicitud para restablecer tu contraseña. Si usted no ha realizado esta solicitud, por favor ignore este correo.</p>
<p>Para restablecer la contraseña, aga click en el siguiente enlace:
<p>
    <a href="{{ url('password/reset/'.$token) }}"> Restablecer contraseña </a>
</p>
<hr>
</body>
</html>