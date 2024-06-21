<section> 

<?php if (isset ($errValidacion) && $errValidacion == true) { ?>

 <p id="txtError"> Usuario y/o contraseña incorrectas </p>
 
<?php
}
?>


<form id="formValidacion" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">   
<br>
<label for="usuario">  Nombre de usuario: </label>
<input type="text" id="usuario" name="usuario" value="<?php if (isset($usuario)) echo $usuario; ?>"><br>
<br>

<label for="password"> Contraseña: </label>
<input type="password" id="password" name="password">
<br>
<br>
<input type="submit" id="enviar" name="enviar" value="Iniciar Sesión">
<br>
<p id="txtQuieroRegistrarme">¿Aún no tienes cuenta? <a href="index.php?ruta=registro" id="enlaceRegistro"> Regístrate </a> </p>
</form>

</section>
