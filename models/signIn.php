<?php 

    include "../config/db.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $name = $_POST["nameU"];
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

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '1ee97a6d3140f2';
    $mail->Password = 'ecc62d2f03edfb';

    $mail->setFrom("soporte@socialtec.com", "SocialTec");
    $mail->addAddress($email);

    $mail->Subject = "Confirmacion de cuenta";
    $mail->Body = "Para poder activar tu cuenta accede al siguiente enlace: <a href='http://localhost/socialtec/verify-account.php?token=$token'>Click Aqui</a>";
    $mail->AltBody = "Para poder activar tu cuenta accede al siguiente enlace: http://localhost/socialtec/verify-account.php?token=$token";

    try {
        $stmt = $conn->prepare("Insert into users
                                (name,lastname,userName,email,pass,token,active)
                                values(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss",$name,$lastname,$username,$email,$passwordHash,$token,$active);
        $stmt->execute();

        $is_inserted = $stmt->insert_id;

        if ($is_inserted>0) {
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