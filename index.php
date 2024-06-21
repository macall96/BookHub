<?php 
include_once "./BBDD/bibliotecaFunciones.php";
/**
*Aquí vamos a realizar la lógica de la página del login
*
***/

session_start();

//En la página del login, funcionalidad del botón "Iniciar sesión"

if (isset ($_POST["enviar"])) {

//Comprobamos que el usuario y la contraseña son válidas y, de ser así, le asignamos una sesión con usuario y rol

if (isset($_POST["usuario"]) && !empty ($_POST["usuario"] && isset($_POST["password"]) && !empty ($_POST["password"]))) {

if (ComprobarLogin($_POST["usuario"],$_POST["password"])){

   $_SESSION ["usuario"] = $_POST["usuario"];

   $array = RecuperaDatosUsuario($_POST["usuario"]);

   $_SESSION ["rol"] = $array ["rol"];

   header ("Location: ". $_SERVER["PHP_SELF"] ."?ruta=principal");

   exit;

} else {
$errValidacion = true;
}
}
}

//Funcionalidad del botón Registrarme de la página de Registro de Usuario
if (isset ($_POST["btnRegistro"])) {

   if (empty ($_POST["nombre"]) || empty ($_POST["apellido1"]) || empty ($_POST["apellido2"]) ||
   empty ($_POST["username"]) || empty ($_POST["correo"]) || empty ($_POST["password"])) {
        $errorDatos = "Faltan datos por introducir";
   } 

   else if ((isset($_POST["nombre"]) && !empty ($_POST["nombre"])) && (isset($_POST["apellido1"]) && !empty ($_POST["apellido1"])) 
   && (isset($_POST["apellido2"]) && !empty ($_POST["apellido2"])) && (isset($_POST["username"]) && !empty ($_POST["username"]))
   && (isset($_POST["correo"]) && !empty ($_POST["correo"])) && (isset($_POST["password"]) && !empty ($_POST["password"]))) {

      if(RegistroUsuario($_POST["nombre"],$_POST["apellido1"],$_POST["apellido2"],$_POST["username"],$_POST["password"],$_POST["correo"])){
            $errorDatos = false;
            ?> <script>alert("Usuario registrado satisfactoriamente.")</script> <?php
            header("refresh:0.1;url=" . $_SERVER["PHP_SELF"]);
            exit;
      }else{
            $errorDatos = "La contraseña debe contener entre 8 y 16 caracteres e incluir al menos una mayúscula";
      } 
    
}
}
//Funcionalidad del botón Volver de la página de Registro de Usuario
if (isset ($_POST["volverInicio"])) {
   header ("Location: ". $_SERVER["PHP_SELF"]); 
}

?>

<!DOCTYPE html>

<html lang="es">

<head>
   <link rel="stylesheet" href="css/estilo.css?v=<?php echo time();?>" />
   <style>
   @import url('https://fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,100;0,300;0,400;0,600;1,100;1,200;1,400&display=swap');
   </style>
   <title>BookHub</title>

</head>

<body>
<!--La cabecera siempre se va a ver-->
<?php include_once "estructuraWeb/cabecera.inc.php";?>

<?php 

//Cargamos las vistas de la aplicación, en función de la ruta

//Si no existen sesión ni ruta...
if (!isset($_SESSION ["usuario"]) && !isset($_GET["ruta"])){
   include_once "estructuraWeb/menuSuperior.inc.php";
   include_once "estructuraWeb/login.inc.php";
}

//Si no existe la sesión pero existe la ruta...
if (!isset($_SESSION ["usuario"]) && isset($_GET["ruta"])) {

   //Caso de introducir una ruta inventada
   if ($_GET["ruta"] != "agregarLibros" && $_GET["ruta"] != "alquileres" &&
       $_GET["ruta"] != "cabecera" && $_GET["ruta"] != "catalogo" &&
       $_GET["ruta"] != "gestionUsuarios"  && $_GET["ruta"] != "info" &&
       $_GET["ruta"] != "login" && $_GET["ruta"] != "logout" &&
       $_GET["ruta"] != "perfil" && $_GET["ruta"] != "prestamos" &&
       $_GET["ruta"] != "principal" && $_GET["ruta"] != "registro") {

     include_once "estructuraWeb/rutaError.inc.php";
   }

   if ($_GET["ruta"] == "principal" || $_GET["ruta"] == "perfil" || 
       $_GET["ruta"] == "catalogo"  || $_GET["ruta"] == "alquileres" || 
       $_GET["ruta"] == "prestamos" || $_GET["ruta"] == "gestionUsuarios") {

         ?> <script>alert("Acceso restringido.");</script> <?php
         header("refresh:0.1;url=" . $_SERVER["PHP_SELF"] . "?ruta=login");
   }

   if ($_GET["ruta"] == "registro"){
      include_once "estructuraWeb/registro.inc.php";
   }

   if ($_GET["ruta"] == "info"){
      include_once "estructuraWeb/info.inc.php";
   }

   if ($_GET["ruta"] == "login"){
      include_once "estructuraWeb/menuSuperior.inc.php";
      include_once "estructuraWeb/login.inc.php";
   }
} 

//Si existe la sesión
if  (isset($_SESSION ["usuario"])) { 
   
    //Si se introduce una ruta inventada...
    if ($_GET["ruta"] != "agregarLibros" && $_GET["ruta"] != "alquileres" &&
        $_GET["ruta"] != "cabecera" && $_GET["ruta"] != "catalogo" &&
        $_GET["ruta"] != "gestionUsuarios"  && $_GET["ruta"] != "info" &&
        $_GET["ruta"] != "login" && $_GET["ruta"] != "logout" &&
        $_GET["ruta"] != "perfil" && $_GET["ruta"] != "prestamos" &&
        $_GET["ruta"] != "principal" && $_GET["ruta"] != "registro") {

     include_once "estructuraWeb/rutaError.inc.php";

    }

      //tratamos el acceso indebido a rutas

      //si el usuario es admin...

      if ($_SESSION ["rol"]=="admin") {

       if(isset($_GET["ruta"]) && $_GET["ruta"] == "prestamos") {
      
       include_once "estructuraWeb/prestamos.inc.php";
                     
      }

      else if (isset($_GET["ruta"]) && $_GET["ruta"] == "perfil") {
      
         include_once "estructuraWeb/perfil.inc.php";
                          
      }

      else if (isset($_GET["ruta"]) && $_GET["ruta"] == "logout") {
      
         include_once "estructuraWeb/logout.inc.php";
                          
      }

      else if (isset($_GET["ruta"]) && $_GET["ruta"] == "gestionUsuarios") {
      
       include_once "estructuraWeb/gestionUsuarios.inc.php";
                        
      }

      else if (isset($_GET["ruta"]) && $_GET["ruta"] == "agregarLibros") {
      
         include_once "estructuraWeb/agregarLibros.inc.php";
                          
      }

      else if (isset($_GET["ruta"]) && $_GET["ruta"] == "principal") {
      
         include_once "estructuraWeb/principal.inc.php";
                          
      }

      else if (isset($_GET["ruta"]) && $_GET["ruta"] == "catalogo") {
         ?> <script>alert("Acceso restringido.");</script> <?php
          header("refresh:0.1;url=" . $_SERVER["PHP_SELF"] . "?ruta=principal");
      }

      else if (isset($_GET["ruta"]) && $_GET["ruta"] == "alquileres") {
         ?> <script>alert("Acceso restringido.");</script> <?php
          header("refresh:0.1;url=" . $_SERVER["PHP_SELF"] . "?ruta=principal");
      }
   }

      //si el usuario es estándar...

      if ($_SESSION ["rol"]=="usuario") {

         if (isset($_GET["ruta"]) && $_GET["ruta"] == "perfil") {
      
            include_once "estructuraWeb/perfil.inc.php";
                             
         }

         else if (isset($_GET["ruta"]) && $_GET["ruta"] == "logout") {
      
            include_once "estructuraWeb/logout.inc.php";
                             
         }

         else if (isset($_GET["ruta"]) && $_GET["ruta"] == "principal") {
      
            include_once "estructuraWeb/principal.inc.php";
                             
         }

         else if (isset($_GET["ruta"]) && $_GET["ruta"] == "catalogo") {
      
            include_once "estructuraWeb/catalogo.inc.php";
                             
         }

         else if (isset($_GET["ruta"]) && $_GET["ruta"] == "alquileres") {
      
            include_once "estructuraWeb/alquileres.inc.php";
                             
         } 
         
         else if (isset($_GET["ruta"]) && $_GET["ruta"] == "gestionUsuarios") {

            ?> <script>alert("Acceso restringido.");</script> <?php
             header("refresh:0.1;url=" . $_SERVER["PHP_SELF"] . "?ruta=principal");
         }

         else if (isset($_GET["ruta"]) && $_GET["ruta"] == "prestamos") {

            ?> <script>alert("Acceso restringido.");</script> <?php
             header("refresh:0.1;url=" . $_SERVER["PHP_SELF"] . "?ruta=principal");
         }

         else if (isset($_GET["ruta"]) && $_GET["ruta"] == "agregarLibros") {
            
            ?> <script>alert("Acceso restringido.");</script> <?php
             header("refresh:0.1;url=" . $_SERVER["PHP_SELF"] . "?ruta=principal");
         }

                       
      }

}

?>

<!--El pie de página siempre se va a ver-->
<?php include_once "estructuraWeb/pie.inc.php";?>

</body>

</html>



