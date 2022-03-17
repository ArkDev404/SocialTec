<?php 

include "../config/db.php";

    $email     = $_POST["email"];
    $password  = $_POST["password"];

    try {
        $stmt = $conn -> prepare(" SELECT username, pass, active FROM users WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $stmt->bind_result($name, $pass, $active);

        if ($stmt -> affected_rows) {
            $exists = $stmt -> fetch();

            if ($exists) {
                if (password_verify($password,$pass)) {

                    if ($active == "1") {
                     
                       // session_start();

                      //  $_SESSION["username"] = $name;

                      $response = array(
                        'response' => 'Ok',
                        'message' => "Bienvenid@ $name....",
                        'url' => ''
                    );
                    } else {
                        $response = array(
                            'response' => 'Error',
                            'message' => "Hemos detectado que tu cuenta no ha sido habilitada, por favor de verificar tu correo!"
                        );
                    }
                } else {
                    $response = array(
                        'response' => 'Error',
                        'message' => "La contraseña ingresada no es correcta!"
                    );
                }
            } else {
                $response = array(
                    'response' => 'Error',
                    'message' => "Tu correo o contraseña son incorrectos!"
                );
            }

        } else {
            $response = array(
                'response' => 'Error',
                'message' => "No se encuentran registros en el sistema!"
            );
        }
    } catch (Exception $e) {
        $response = array(
            'response' => 'Error',
            'message' => $e
        );
    }

    die(json_encode($response));

