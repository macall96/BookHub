<?php 

/**
 * EstablecerConexion function: establecer conexion con la BBDD
 * 
 * @return bool|object
 */
function EstablecerConexion():bool|object {

    (string)$host = "localhost";
    (string)$usuarioBD = "biblioteca";
    (string)$passwordBD = "biblioteca";
    (string)$nombreBD = "biblioteca";
    
     //establece conexion y la guarda en la variable conexion
     (object)$conexion = mysqli_connect($host, $usuarioBD, $passwordBD, $nombreBD);
     
     // Manejo de errores de MySQL
     mysqli_report(MYSQLI_REPORT_ERROR);

     // Establecer el conjunto de caracteres
     mysqli_set_charset($conexion, "utf8");

     if (!$conexion) {
     // Terminar el script en caso de un error de conexión
     die("Fallo al conectar a MySQL: " . mysqli_connect_error());
    }

    return $conexion;
}

/**
 * CerrarConexion function: cerrar conexion con la BBDD
 * 
 */
function CerrarConexion($conexion) {
    mysqli_close($conexion);
}

/**
 * comprobarCorreo function: efectúa la comprobación del formato del correo electrónico
 * 
 * @param string $correo Correo introducido por el usuario que se registra
 * @return bool Retorna true si el correo tiene un formato válido, false en caso contrario
 */
function comprobarCorreo($correo):bool {
    //verifica si el correo introducido tiene un formato válido
       if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
           return true;
       } else {
           return false;
       }
   }
   
   /**
    * comprobarContrasena function: efectúa la comprobación del formato de la contraseña
    * 
    * @param string $contrasena Contraseña introducida por el usuario
    * @return bool Retorna true si la contraseña tiene un formato válido, false en caso contrario
    */
   function comprobarContrasena($contrasena): bool {
       // Verifica si la contraseña tiene entre 8 y 16 caracteres
       $longitudValida = strlen($contrasena) >= 8 && strlen($contrasena) <= 16;
   
       // Verifica si hay al menos una mayúscula y un número en la contraseña
       $tieneMayuscula = preg_match('/[A-Z]/', $contrasena) === 1;
       $tieneNumero = preg_match('/[0-9]/', $contrasena) === 1;
   
       // Retorna true si la contraseña cumple con los requisitos, false en caso contrario
       if($longitudValida && $tieneMayuscula && $tieneNumero) {
           return true;
       } else {
           return false;
       }
   
   }


/**
 * RegistroUsuario function: inserta usuario en la BBDD
 * 
 * @param string $nombre nombre usuario
 * @param string $apellido1 primer apellido usuario
 * @param string $apellido2 segundo apellido usuario
 * @param string $usuario nombre para la aplicacion 
 * @param string $password contraseña usuario
 * @param string $correo correo electrónico usuario
 * 
 */
function RegistroUsuario($nombre,$apellido1,$apellido2,$usuario,$password,$correo) {
    
    $conexion = EstablecerConexion();

    if (comprobarCorreo($correo) && comprobarContrasena($password)) {
        
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        try {
       mysqli_query($conexion, "INSERT INTO usuarios (`nombre`, `apellido1`, `apellido2`, `usuario`, `password`,
       `correo`, `fecha_registro`, `rol`) VALUES ('".$nombre."','".$apellido1."','".$apellido2."','".$usuario."',
       '".$passwordHash."','".$correo."', NOW(), 'usuario');");
       return true;
    
       }catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    }
  
    CerrarConexion($conexion);
}


/**
 * borrarUsuario function: borra usuario de la BBDD
 * 
 * @param string $idUsuario id del usuario en la BBDD
 * @return bool
 * 
 */

function borrarUsuario($idUsuario): bool {
    
    $conexion = EstablecerConexion();
    
    //Actualizamos en la tabla USUARIOS poniendo a TRUE la columna borrado del usuario correspondiente
    $borradoUsuario = mysqli_query($conexion, "UPDATE usuarios SET borrado = 1 WHERE id = '$idUsuario';");

    if (!$borradoUsuario) {
        echo "Error al actualizar la tabla de usuarios: " . mysqli_error($conexion);
        CerrarConexion($conexion);
        return false;
    }
    
    //Actualizamos la tabla PRESTAMOS poniendo a NULL la fecha de los libros que tuviese alquilados ese usuario
    $borradoAlquileres = mysqli_query($conexion, "UPDATE prestamos SET fin_prestamo = NULL WHERE id_usuario = '$idUsuario';");
   
    if (!$borradoAlquileres) {
        echo "Error al actualizar la tabla de usuarios: " . mysqli_error($conexion);
        CerrarConexion($conexion);
        return false;
    }

    //Seleccionamos desde la tabla PRESTAMOS los id de los libros que tuviese alquilados el usuario borrado y los guardamos en un array
    $arrayIdLibrosDevueltos = array ();
    
    if ($idsLibrosDevueltos = mysqli_query($conexion, "SELECT id_libro FROM prestamos WHERE id_usuario = '$idUsuario';")) {
        // Recorremos  $idsLibrosDevueltos  y vamos guardando cada resultado (id) en el array vacío $arrayIdLibrosDevueltos
        while ($fila = mysqli_fetch_array($idsLibrosDevueltos)) {
            $arrayIdLibrosDevueltos[] = $fila['id_libro'];
        }
    }

    //Recorremos $arrayIdLibrosDevueltos y por cada id de los libros actualizamos la tabla LIBROS poniendo a FALSE la columna alquilado
    foreach ($arrayIdLibrosDevueltos as $id) {
      mysqli_query($conexion, "UPDATE libros SET alquilado=0 WHERE id = '$id';");
    }
    CerrarConexion($conexion);
    return true;
   
}

/**
 * RecuperaTotalUsuarios function: devuelve array con todos los usuarios de la aplicación
 * @return array|bool
 * 
 */

function RecuperaTotalUsuarios ():array|bool {

    $conexion = EstablecerConexion();
        $arrayUsuarios = array(); // Array vacío para almacenar resultados
        
        //en la variable $totalUsuarios guardamos todo lo que contiene la tabla libros
        if ($totalUsuarios = mysqli_query($conexion,"SELECT * FROM usuarios")) {
            // Recorremos $totalUsuarios y vamos guardando cada resultado como array asociativo, que vamos añadiendo
            //al array original
            while ($fila = mysqli_fetch_assoc($totalUsuarios)) {
                $arrayUsuarios[] = $fila;
            }
            // Liberamos el conjunto de resultados
            mysqli_free_result($totalUsuarios);
            return $arrayUsuarios;

        } else {
            // Si la consulta falla
            return false;
        }
//Cerramos la conexión con la base de datos
CerrarConexion($conexion);

}


/**
 * RecuperaDatosUsuario function: devuelve un array con todos los datos de un usuario concreto
 * 
 * @param string $nombreUser nombre del usuario
 * @return array|bool
 * 
 */
function RecuperaDatosUsuario ($nombreUser):array|bool {

    $conexion = EstablecerConexion();

    if ($datos = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$nombreUser';")){
        //Guardamos cada uno de los resultados en un array asociativo llamado $arrayDatos con la funcion mysqli_fetch_assoc
        $arrayDatos = mysqli_fetch_assoc($datos);
    if ($arrayDatos){
        return $arrayDatos;  
    }
              
    }
    mysqli_free_result ($datos);
    CerrarConexion($conexion);
}


/**
 *RegistroLibro function: registra un libro en la base de datos
 * 
 * @param string $isbn campo ISBN del libro
 * @param string $titulo campo titulo del libro
 * @param string $autor campo autor del libro
 * @param string $editorial campo editorial del libro
 */
function RegistroLibro($isbn,$titulo,$autor,$editorial) {

    $conexion = EstablecerConexion();


    if (mysqli_query($conexion, "INSERT INTO libros (`isbn`,`titulo`,`autor`,`editorial`,`alquilado`) 
                                 VALUES ('".$isbn."','".$titulo."','".$autor."','".$editorial."',0);") === TRUE) {
         // La consulta se ejecutó con éxito, no mostramos nada
    } else {
        echo "Error al insertar el libro: " . mysqli_error($conexion);
    }

    CerrarConexion($conexion);
}

/**
 *ListarLibros function: devuelve un array con los datos de todos los libros de la BBDD
 * @return array|bool
 * 
 */
function ListarLibros ():array|bool {

        $conexion = EstablecerConexion();
        $arrayLibros = array(); // Array vacío para almacenar resultados
        
        //en la variable $totalLibros guardamos todo lo que contiene la tabla libros
        if ($totalLibros = mysqli_query($conexion, "SELECT * FROM libros;")) {
            // Recorremos $totallibros y vamos guardando cada resultado como array asociativo, que vamos añadiendo
            //al array original
            while ($fila = mysqli_fetch_assoc($totalLibros)) {
                $arrayLibros[] = $fila;
            }
            // Liberamos el conjunto de resultados
            mysqli_free_result($totalLibros);
            return $arrayLibros;

        } else {
            // Si la consulta falla
            return false;
        }
//Cerramos la conexión con la base de datos
CerrarConexion($conexion);

}


/**
 *LibrosFiltrados function: devuelve un array con los datos de libros filtrados por campo
 * @return array|bool
 * 
 */

function LibrosFiltrados ($campo, $valor):array|bool {
    $conexion = EstablecerConexion();
    $arrayLibrosFiltrados = array(); // Array vacío para almacenar resultados
    
    //en la variable $totalLibros guardamos todo lo que contiene la tabla libros
    if ($totalLibros = mysqli_query($conexion, "SELECT * FROM libros WHERE $campo LIKE '%$valor%'")) {
        // Recorremos $totallibros y vamos guardando cada resultado como array asociativo, que vamos añadiendo
        //al array original
        while ($fila = mysqli_fetch_assoc($totalLibros)) {
            $arrayLibrosFiltrados[] = $fila;
        }
        // Liberamos el conjunto de resultados
        mysqli_free_result($totalLibros);
        return $arrayLibrosFiltrados;

    } else {
        // Si la consulta falla
        return false;
    }
//Cerramos la conexión con la base de datos
CerrarConexion($conexion);


}


/**
 *RecuperarAlquileres function: devuelve todos los libros que están actualmente prestados de la tabla prestamos
 * 
 * @return array
 */
function RecuperarAlquileres():array {
    $conexion = EstablecerConexion();
   
    $LibrosAlquilados = mysqli_query($conexion, "SELECT * FROM prestamos WHERE fin_prestamo IS NOT NULL");
    
    $arrayLibrosAlquilados = array(); // Inicializamos un array para almacenar los resultados

    while ($fila = mysqli_fetch_assoc($LibrosAlquilados)) {
        $arrayLibrosAlquilados[] = $fila; // Agregamos cada registro al array
    }

    mysqli_free_result($LibrosAlquilados);
    CerrarConexion($conexion);

    return $arrayLibrosAlquilados; // Devolvemos el array de resultados
}



/**
 *RecuperarAlquileresUsuario function: devuelve los libros prestados actualmente a un usuario concreto de la tabla prestamos
 * 
 * @param string $usuario nombre del usuario
 * @return array
 * 
 */
function RecuperarAlquilerUsuario($usuario):array {
    $conexion = EstablecerConexion();
    $idUsuario = dameidUsuario($usuario);
    $LibrosAlquilados = mysqli_query($conexion, "SELECT nombre_libro, fin_prestamo FROM prestamos 
                                                 WHERE id_usuario='$idUsuario' AND fin_prestamo IS NOT NULL");
    
    $arrayLibrosAlquilados = array(); // Inicializamos un array para almacenar los resultados

    while ($fila = mysqli_fetch_assoc($LibrosAlquilados)) {
        $arrayLibrosAlquilados[] = $fila; // Agregamos cada registro al array
    }

    return $arrayLibrosAlquilados; // Devolvemos el array de resultados
    mysqli_free_result($LibrosAlquilados);
    CerrarConexion($conexion);

   
}


/**
 *ComprobarLogin function: comprueba si el usuario existe en la base de datos
 * 
 * @param string $usuario nombre del usuario
 * @param string $passwd contraseña del usuario
 * @return bool
 * 
 */
function ComprobarLogin ($usuario, $passwd):bool {
    
    $conexion = EstablecerConexion();
    
    $consulta = mysqli_query($conexion, "SELECT password FROM usuarios WHERE usuario='$usuario' AND borrado=0");

    if ($consulta && mysqli_num_rows($consulta) == 1) {
        $fila = mysqli_fetch_assoc($consulta);
        $passwordAlmacenado = $fila['password'];

        if (password_verify($passwd, $passwordAlmacenado)) {
            CerrarConexion($conexion);
            return true;
        }
    }

    CerrarConexion($conexion);
    return false;
}



/**
 *dameTitulo function: devuelve el título de un libro por su ID
 * 
 * @param string $idLibro id del libro en la BBDD
 * @return mixed
 * 
 */
function dameTitulo($idLibro):mixed {
    $conexion = EstablecerConexion();
    
    $query = "SELECT titulo FROM libros WHERE id='$idLibro'";
    $result = mysqli_query($conexion, $query);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $titulo = $row['titulo'];
    } 

    mysqli_free_result($result);
    CerrarConexion($conexion);

    return $titulo;
}


/**
 *dameidUsuario function: devuelve el id de un usuario por su nombre
 * 
 * @param string $nombreUser nombre del usuario
 * @return mixed
 * 
 */
function dameidUsuario($nombreUser):mixed {
    $conexion = EstablecerConexion();
    
    $query = "SELECT id FROM usuarios WHERE usuario='$nombreUser'";
    $result = mysqli_query($conexion, $query);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
    } 

    mysqli_free_result($result);
    CerrarConexion($conexion);

    return $id;
}


/**
 *alquilar function: efectúa el alquiler de un libro por un usuario
 * 
 * @param string $idLibro id del libro
 * @param string $nombreUsuario nombre del usuario
 * 
 */
function alquilar ($idLibro, $nombreUsuario) {

//Establecemos conexión con la base de datos
$conexion = EstablecerConexion();

//Obtenemos el id del usuario que ha alquilado el libro con la función dameidUsuario()
$idUser = dameidUsuario($nombreUsuario);

//Obtenemos el titulo con el id del libro que está siendo alquilado (se lo hemos pasado a la función) usando la funcion dameTitulo()
$tituloLibro = dameTitulo($idLibro);

//Actualizamos en la tabla libros el campo "alquilado" a TRUE en el libro cuyo id es el que le hemos pasado a la función
mysqli_query($conexion, "UPDATE libros SET alquilado = TRUE WHERE id = '$idLibro';");

//Creamos una variable con la fecha del sistema más dos semanas 
$fechaDevolucion = date('Y-m-d', strtotime('+2 weeks'));

//Realizamos el insert en la tabla préstamos con los datos correspondientes
mysqli_query($conexion,"INSERT INTO prestamos (id_usuario, id_libro, nombre_libro, fin_prestamo) 
                        VALUES ('$idUser', '$idLibro', '$tituloLibro', '$fechaDevolucion');");


CerrarConexion($conexion);

}


/**
 *devolver function: efectúa la devolución de un libro
 * 
 * @param string $idLibro id del libro
 * @return bool
 * 
 */
function devolver($idLibro):bool {

    $conexion = EstablecerConexion();

    // Actualizar el campo "alquilado" en la tabla libros
    $resultLibro = mysqli_query($conexion,"UPDATE libros SET alquilado = 0 WHERE id = '$idLibro';" );

    if (!$resultLibro) {
        echo "Error al actualizar el estado del libro: " . mysqli_error($conexion);
        CerrarConexion($conexion);
        return false;
    }

    // Actualizar la tabla préstamos
    $resultPrestamos = mysqli_query($conexion, "UPDATE prestamos SET fin_prestamo = NULL WHERE id_libro = '$idLibro';");

    if (!$resultPrestamos) {
        echo "Error al actualizar la tabla de préstamos: " . mysqli_error($conexion);
        CerrarConexion($conexion);
        return false;
    }
    CerrarConexion($conexion);
    return true;
   
}

?>