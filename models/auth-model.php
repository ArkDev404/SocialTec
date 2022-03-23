<?php

// Se incluye la conexion a la BD
include "../config/db.php";
include "../config/vars.php";

//Se incluye la libreria de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Datos para conectar a mailtrap.io mediante PHPMailer
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Port = 2525;
$mail->Username = $mailtrap_user; // Tu usuario de mailtrap
$mail->Password = $mailtrap_password; // Tu pass de mailtrap

$mail->setFrom("soporte@socialtec.com", "SocialTec");


if ($_POST["operation"] == "register") {
    $name = $_POST["nameu"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["password"]; //Recibimos contraseña 
    $token = bin2hex(random_bytes((12 - (12 % 2)) / 2));
    $active = "0";

    $options = array(
        'cost' => 12
    );

    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, $options);


    $mail->addAddress($email);
    $mail->Subject = "Confirmacion de cuenta";
    $mail->Body = "Para poder activar tu cuenta accede al siguiente enlace: <a href='http://localhost/socialtec/verify-account.php?token=$token'>Click Aqui</a>";
    $mail->AltBody = "Para poder activar tu cuenta accede al siguiente enlace: http://localhost/socialtec/verify-account.php?token=$token";

    try {
        $stmt = $conn->prepare("Insert into users
                                    (name,lastname,userName,email,pass,token,active)
                                    values(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $name, $lastname, $username, $email, $passwordHash, $token, $active);
        $stmt->execute();

        $is_inserted = $stmt->insert_id;

        if ($is_inserted > 0) {
            if (!$mail->send()) {
                $response = array(
                    'response' => 'error',
                    'message' => $mail->ErrorInfo
                );
                // echo $mail->ErrorInfo;
            } else {
                $response = array(
                    'response' => 'Ok',
                    'message' => 'Se ha enviado un mensaje a tu correo!'
                );
                // echo "Se envio un correo de verificacion";
            }
        }
    } catch (Exception $e) {
        echo $e;
    }

    die(json_encode($response));
}

if ($_POST["operation"] == "login") {

    $email     = $_POST["email"];
    $password  = $_POST["password"];

    try {
        $stmt = $conn->prepare(" SELECT username, pass, active FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($name, $pass, $active);

        if ($stmt->affected_rows) {
            $exists = $stmt->fetch();

            if ($exists) {
                if (password_verify($password, $pass)) {

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
}

if ($_POST["operation"] == "forgot") {
    
    $email     = $_POST["email"];
    $pass      = bin2hex(random_bytes((8 - (8 % 2)) / 2));

    $hash = array(
        'cost' => 12
    );

    $passHash = password_hash($pass, PASSWORD_BCRYPT, $hash);

    $mail->addAddress($email);
    $mail->Subject = "Nuevo password";
    $mail->Body    = "Ha solicitado restablecer su contraseña. <br> Su nuevo password es: <b>$pass</b> ";
    $mail->AltBody    = "Su nueva contraseña es: $pass";


    try {
        $stmt = $conn->prepare("UPDATE users
            SET pass = ?
            WHERE email = ?");

        $stmt->bind_param("ss", $passHash, $email);
        $stmt->execute();

        if ($stmt->affected_rows) {
            if (!$mail->send()) {
                $response = array(
                    'response' => 'Error',
                    'message' => "Lo sentimos ha ocurrido un error al enviar el correo!"
                );
                //echo $mail->ErrorInfo;
            } else {
                $response = array(
                    'response' => 'Ok',
                    'message' => "Se ha enviado un correo para restablecer tu contraseña!",
                    'url' => 'login.php'
                );
            }
        } else {
            $response = array(
                'response' => 'Error',
                'message' => "No se encuentra registrado el correo!"
            );
        }
    } catch (Exception $e) {
        $response = array(
            'response' => 'Error',
            'message' => $e
        );
    }

    die(json_encode($response));
}
