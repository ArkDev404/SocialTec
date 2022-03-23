<?php

include "../config/db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$email     = $_POST["email"];
$pass      = bin2hex(random_bytes((8 - (8 % 2)) / 2));

$hash = array(
    'cost' => 12
);

$passHash = password_hash($pass, PASSWORD_BCRYPT, $hash);

// PHPMailer Config
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Port = 2525;
$mail->Username = '1ee97a6d3140f2';
$mail->Password = 'ecc62d2f03edfb';

// PHP SendMail Data
$mail->setFrom('soporte@socialtec.com', 'SocialTec');
$mail->addAddress($email);
$mail->Subject = "Nuevo password";


try {
    $stmt = $conn->prepare("UPDATE users
            SET pass = ?
            WHERE email = ?");

    $stmt->bind_param("ss", $passHash, $email);
    $stmt->execute();
    $mail->Body    = "Ha solicitado restablecer su contraseña. <br> Su nuevo password es: <b>$pass</b> ";
    $mail->AltBody    = "Su nueva contraseña es: $pass";

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
