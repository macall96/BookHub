<section>

<?php
$arrayDatos = RecuperaDatosUsuario($_SESSION["usuario"]);

// Mapeo de nombres de campo a textos personalizados
$campoAMensaje = array(
    "nombre" => "Nombre:",
    "apellido1" => "Primer Apellido:",
    "apellido2" => "Segundo Apellido:",
    "usuario" => "Nombre de Usuario:",
    "correo" => "Correo Electrónico:"
);

//Creamos la tabla con datos obtenidos de la tabla Usuarios como array asociativo
echo "<table id='tablaDatosUsuario'>";
foreach ($arrayDatos as $campo => $val) {
    if (isset($campoAMensaje[$campo])) {
        $mensaje = $campoAMensaje[$campo];
        echo "<tr><td>".$mensaje."</td>
              <td>".$val."</td></tr>";
    }
}
echo "</table>";
?>

<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=principal";?>" class="btnesPerfil">Atrás</a>
<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=logout";?>" class="btnesPerfil">Cerrar Sesión</a>
</section>
