<section>
<form id="formPrincipal" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post"> 
<p id="txtBienvenida"> ¡ Hola <?php echo $_SESSION["usuario"]; ?> ! </p>
<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=perfil";?>" class="ruta" id="ruta1" > Mi perfil</a>
<br>

<!-- Si la persona registrada tiene rol de usuario, se mostrarán las siguientes opciones: -->
<?php if ($_SESSION["rol"]=="usuario"){
?>
<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=catalogo";?>" class="ruta">Catálogo</a>
<br>
<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=alquileres";?>" class="ruta">Mis libros alquilados</a>
<br>
<?php
}
?>

<!-- Si la persona registrada tiene rol de admin, se mostrarán las siguientes opciones: -->
<?php if ($_SESSION["rol"]=="admin"){
?>
<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=gestionUsuarios";?>" class="ruta">Gestión de usuarios</a>
<br>
<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=agregarLibros";?>" class="ruta">Agregar libro nuevo</a>
<br>
<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=prestamos";?>" class="ruta">Gestión de préstamos</a>
<?php
}
?>
<br>
<a href="<?php echo $_SERVER["PHP_SELF"]."?ruta=logout";?>" class="ruta" id="rutaCerrar">Cerrar Sesión</a>
</form>
</section>
