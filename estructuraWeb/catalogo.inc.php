<?php
include_once "./BBDD/bibliotecaFunciones.php";

// Funcionalidad del botón "Alquilar"
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $arrayLibros = ListarLibros(); // Cargar los libros nuevamente
    foreach ($arrayLibros as $libro) {
        if (isset($_POST[$libro['id']])) {
            alquilar($libro['id'], $_SESSION["usuario"]);
            echo "<h1 id='avisoAlquilado'>Procesando alquiler del libro. Serás redirigido en unos segundos.</h1>";
            echo "<br>";
            echo "<div class= 'spinner'>
                 <div></div>
                 <div></div>
                 <div></div>
                 <div></div>
                 <div></div>
                 <div></div>
                 </div>";
            header("refresh:2;url=" . $_SERVER["PHP_SELF"] . "?ruta=principal");
            exit();
        }
    }
}

// Funcionalidad del botón "Buscar por filtro"
if (isset($_POST["btnBuscarFiltro"]) && !empty($_POST['valorFiltro'])) {
    $campo = $_POST['select'];
    $valor = $_POST['valorFiltro'];
    $arrayLibros = LibrosFiltrados($campo, $valor);
} else {
    // Si no se ha pulsado el botón de filtro, mostrar todos los libros
    $arrayLibros = ListarLibros();
}
?>

<section id="sectionCatalogo">
    <form id="formCatalogo" action="<?php echo $_SERVER["PHP_SELF"] . "?ruta=catalogo"; ?>" method="post">
    <div id="divFiltro">
        <form id="formFiltro" action="<?php echo $_SERVER["PHP_SELF"] . "?ruta=catalogo"; ?>" method="post">
            <label for="select">Buscar por:</label>
            <select name="select" id="select">
                <option value="titulo" selected>Título</option>
                <option value="autor">Autor</option>
                <option value="isbn">ISBN</option>
                <option value="editorial">Editorial</option>
            </select>
            <input type="text" name="valorFiltro" id="valorFiltro">
            <input type="submit" name="btnBuscarFiltro" value="Buscar">
            <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=principal"; ?>">Volver</a>
    </div>
        <table id='tablaCatalogo'>
            <tr>
                <td>ISBN</td>
                <td>Título</td>
                <td>Autor</td>
                <td>Editorial</td>
                <td>Disponibilidad</td>
            </tr>
            <?php foreach ($arrayLibros as $libro) { ?>
                <tr>
                    <td><?php echo $libro["isbn"]; ?></td>
                    <td><?php echo $libro["titulo"]; ?></td>
                    <td><?php echo $libro["autor"]; ?></td>
                    <td><?php echo $libro["editorial"]; ?></td>
                    <td>
                        <?php
                        if ($libro["alquilado"] == TRUE) {
                            echo "No disponible";
                        } else { ?>
                            <input type="submit" name="<?php echo $libro['id']; ?>" value="Alquilar">
                        <?php }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </form>
</section>