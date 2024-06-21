<section id="sectionAlquileres">

<?php
$arrayDatos = RecuperarAlquilerUsuario($_SESSION["usuario"]);

if ($arrayDatos == []) {
echo "<h1 id='txtNoAlquiler'> En estos momentos no tienes ningún libro alquilado. </h1>";
} else{
//Creamos la tabla con datos obtenidos de la tabla Usuarios como array asociativo
echo "<table id='tablaAlquileres'>";
echo "<tr>
            <td>Libro alquilado </td>
            <td>Fecha fin de préstamo</td>
     </tr>";
foreach ($arrayDatos as $alquiler) {
  echo "<tr>.
        <td>".$alquiler['nombre_libro']."</td>
        <td>".$alquiler['fin_prestamo']."</td>
        </tr>";
}
echo "</table>";
}
?>


<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=principal";?>" id="btnAtrasAlquileres">Atrás</a>
</section>
