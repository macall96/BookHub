<?php
if (isset ($_POST["btnAnadirLibro"])) {
   if ((isset($_POST["isbn"]) && !empty ($_POST["isbn"])) && (isset($_POST["titulo"]) 
                              && !empty ($_POST["titulo"])) && (isset($_POST["autor"]) 
                              && !empty ($_POST["autor"])) && (isset($_POST["editorial"]) && !empty ($_POST["editorial"]))){
       RegistroLibro($_POST["isbn"],$_POST["titulo"],$_POST["autor"],$_POST["editorial"]);
       echo "<h1 id='avisoAñadeLibro'>Añadiendo libro a la base de datos. Serás redirigido en unos segundos.</h1>";
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
   } else if (empty ($_POST["nombre"]) || empty ($_POST["apellido1"]) || empty ($_POST["apellido2"]) 
             || empty ($_POST["username"]) || empty ($_POST["correo"]) || empty ($_POST["password"])) {
   $errorDatos = true;
   } 
}
?>


<section id="sectionAgregarLibro">

<form id="formularioAgregarLibro" action="<?php echo $_SERVER["PHP_SELF"] ."?ruta=agregarLibros"; ?>" method="post">

<?php if (isset ($errorDatos) && $errorDatos == true) { ?>
<p id="txtError"> Faltan datos por introducir </p>
<?php
}
?> 

<h1 id="tituloLibro"> NUEVO LIBRO </h1>
<br>
<label for="isbn"> ISBN: </label>
<input type="text" name="isbn" value=""><br>
<br>

<label for="titulo"> Título del libro:  </label>
<input type="text"  name="titulo">
<br>

<label for="autor"> Autor/a:  </label>
<input type="text"  name="autor">
<br>

<label for="editorial"> Editorial:  </label>
<input type="text"  name="editorial">
<br>
<br>
<input type="submit" id="btnRegistro" name="btnAnadirLibro" value="Añadir Libro">
<br>
<br>
<a href="<?php echo $_SERVER["PHP_SELF"] ."?ruta=principal";?>" id="btnVolverAgregLibros">Volver</a>

</form>

</section>