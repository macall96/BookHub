<?php
include_once "./BBDD/bibliotecaFunciones.php";

// Verificar si se ha enviado el formulario antes de mostrar cualquier contenido
//Funcionalidad del botón "Borrar usuario"
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $arrayUsuarios = RecuperaTotalUsuarios(); // Cargar los usuarios nuevamente

    foreach ($arrayUsuarios as $usuario) {
        if (isset($_POST[$usuario['id']])) {
            borrarUsuario($usuario['id']);
            echo "<h1 id='avisoUserBorrado'>Eliminando usuario de la base de datos. Serás redirigido en unos segundos.</h1>";
            echo "<br>";
            echo "<div class= 'spinner'>
                 <div></div>
                 <div></div>
                 <div></div>
                 <div></div>
                 <div></div>
                 <div></div>
                 </div>";
            header("refresh:2;url=".$_SERVER["PHP_SELF"]."?ruta=principal");
            exit; 
        }
    }
}
?>

<section>
<form id="formUsuarios" action="<?php echo $_SERVER["PHP_SELF"] . "?ruta=gestionUsuarios";?>" method="post">
    <?php
    $arrayUsuarios = RecuperaTotalUsuarios();
    ?>
    <table id='tablaUsuarios'>
        <tr>
            <td>Nombre</td>
            <td>Primer apellido</td>
            <td>Segundo apellido</td>
            <td>Nombre de usuario</td>
            <td>Correo Electrónico</td>
            <td>Fecha de registro</td>
            <td>Borrar usuario</td>
        </tr>
        <?php foreach ($arrayUsuarios as $usuario) {
               if ($usuario["borrado"] == 0 && $usuario["rol"] == "usuario") { ?>
            <tr>
                <td><?php echo $usuario["nombre"]; ?></td>
                <td><?php echo $usuario["apellido1"]; ?></td>
                <td><?php echo $usuario["apellido2"]; ?></td>
                <td><?php echo $usuario["usuario"]; ?></td>
                <td><?php echo $usuario["correo"]; ?></td>
                <td><?php echo $usuario["fecha_registro"]; ?></td>
                <td>   
                 <input type="submit" name="<?php echo $usuario['id']; ?>" value="Dar de baja">
                </td>
            </tr>
        <?php }} ?>
    </table>
    <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=principal";?>" id="btnVolverUsu">Volver</a>
</form>
</section>