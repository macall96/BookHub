<?php
include_once "./BBDD/bibliotecaFunciones.php";

// Verificar si se ha enviado el formulario antes de mostrar cualquier contenido
//Funcionalidad del botón devolver
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $arrayDatos = RecuperarAlquileres(); // Cargar los prestamos nuevamente
 
    foreach ($arrayDatos as $alquiler) {
        if (isset($_POST[$alquiler['id_libro']])) {
            devolver($alquiler['id_libro']);
            echo "<h1 id='avisoDevuelto'>Devolviendo libro a la biblioteca. Serás redirigido en unos segundos.</h1>";
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


<section id="sectionPrestamos">
<form id="formPrestamos" action="<?php echo $_SERVER["PHP_SELF"] ."?ruta=prestamos";?>" method="post">
    <?php
    $arrayDatos = RecuperarAlquileres();
    if ($arrayDatos===[]){
        echo "<h1 id='txtNoPrestamos'> En estos momentos hay ningún libro prestado. </h1>";
    } else {
    ?>
    <table id='tablaPrestamos'>
        <tr>
            <td>ID Usuario</td>
            <td>ID Libro </td>
            <td>Nombre Libro </td>
            <td>Fecha fin de préstamo</td>
            <td>Devolución</td>
        </tr>
        <?php foreach ($arrayDatos as $alquiler) { ?>
            <tr>
                <td><?php echo $alquiler['id_usuario']; ?></td>
                <td><?php echo $alquiler['id_libro']; ?></td>
                <td><?php echo $alquiler['nombre_libro']; ?></td>
                <td><?php echo $alquiler['fin_prestamo']; ?></td>
                <td><input type="submit" name="<?php echo $alquiler['id_libro']; ?>" value="Devolver"></td>
            </tr>
        <?php }}?>
    </table>
    <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=principal";?>" id="btnVolverPres">Volver</a>
</form>

</section>