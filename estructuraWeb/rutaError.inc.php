<?php
echo "<h1 id='avisoError404'>Error 404. Esta dirección no existe.Serás redirigido en unos segundos.</h1>";
echo "<br>";
echo "<div class= 'spinner'>
     <div></div>
     <div></div>
     <div></div>
     <div></div>
     <div></div>
     <div></div>
     </div>";

if (!isset($_SESSION ["usuario"])) {
header("refresh:2;url=".$_SERVER["PHP_SELF"]);
} else {
header("refresh:2;url=" . $_SERVER["PHP_SELF"] . "?ruta=principal");
}
?>