<?php 
/**
 * Este archivo nos permite configurar nuestra conexion a la base de datos
 * @param hostname: Especifica la ubicación o ip donde esta la BD
 * @param user: Especifica el nombre de usuario
 * @param password: Especifica la contraseña del usuario de BD
 * @param db: Especifica el nombre de la base de datos a utilizar
 */

    $hostname = "localhost";
    $user = "root";
    $password = "";
    $db = "socialtec";

    $conn = mysqli_connect($hostname,$user,$password,$db);

    // if ($conn -> ping()) {
    //     echo "OK";
    // }

?>