<section id="sectionRegistro">

<?php if (isset ( $errorDatos ) && $errorDatos  == true) { ?>
<p id="txtError"> <?php echo $errorDatos ?> </p>
<?php
}
?>


<form id="formularioRegistro" action="<?php echo $_SERVER["PHP_SELF"]."?ruta=registro";?>" method="post">

<h1 id="tituloRegistro"> NUEVO USUARIO </h1>
<br>
<label for="nombre"> Nombre: </label>
<input type="text" name="nombre"><br>
<br>

<label for="apellido1"> Primer apellido:  </label>
<input type="text"  name="apellido1">
<br>

<label for="apellido2"> Segundo apellido:  </label>
<input type="text"  name="apellido2">
<br>

<label for="username"> Nombre de usuario:  </label>
<input type="text"  name="username">
<br>

<label for="correo"> Correo electrónico:  </label>
<input type="email"  name="correo">
<br>

<label for="password"> Contraseña:  </label>
<input type="password"  name="password">
<br>

<br>
<input type="submit" id="btnRegistro" name="btnRegistro" value="Registrarme">
<br>
<br>
<input type="submit" id="volverInicio" name="volverInicio" value="Volver">
</form>

</section>