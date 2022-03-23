# SocialTec - Red Social

Este proyecto, es un desarrollo realizado en conjunto con Alumnos de Ingeniera en Sistemas Computacionales del ITMH

## ¿Que vamos a ver?

El proposito de este proyecto es aplicar lo aprendido durante el transcurso educativo en el ITMH. En este curso vamos a tratar las siguientes tecnologías aplicando diferentes paradigmas de Programación.

- HTML5
- CSS3 
- JavaScript ES6
- Bootstrap 4/5
- Fetch API
- MySQL

Ademas utilizaremos dos herramientas utiles de apoyo en el proceso realizar código

- Visual Studio Code
- Laragon
- HeidiSQL
- Mailtrap.io
- Git

## Lo que aprenderemos

Este proyectp tiene el proposito que como estudiante tengas buenas practicas de desarrollo, domines las nuevas tecnologías Web, apliques lo aprendido y que apliques buenas practicas.

Entre ellas:
- Creación de Codigo Limpio
- Manejo de Sesiones
- Organización de Proyectos
- Agilización al momento de programar código en VSC
- Maquetación correcta de Bases de Datos
- Diseño Responsivo
- Aplicar UX y UI a un sitio web
- Envio de Correos
- Entre otras mas habilidades dentro del desarrollo

## Extras

Para agilizar mas rapido el proceso de programación en este curso, se recomienda instalar las siguientes extensiones en VSC

- PHP Server
- Live Server
- Format HTML in PHP
- Bracket Pair Colorizer
- JavaScript (ES6) code snippets
- PHP Intellisense
- Snapcode

## Cambios para hacer funcionar el proyecto

Es importante que cambies 2 archivos fundamentales hasta el momento: Estos Archivos son:
- db.php
- vars.php
Ambos archivos ubicados en la carpeta config

### db.php

```php
<?php 
/**
 * Este archivo nos permite configurar nuestra conexion a la base de datos
 * @param hostname: Especifica la ubicación o ip donde esta la BD
 * @param user: Especifica el nombre de usuario
 * @param password: Especifica la contraseña del usuario de BD
 * @param db: Especifica el nombre de la base de datos a utilizar
 */

    $hostname = "";
    $user = "";
    $password = "";
    $db = "";

    $conn = mysqli_connect($hostname,$user,$password,$db);

    // if ($conn -> ping()) {
    //     echo "OK";
    // }

?>
```
### vars.php

```php
<?php
    // Mailtrap Auth
    $mailtrap_user = "";
    $mailtrap_password = "";

    
?>
```