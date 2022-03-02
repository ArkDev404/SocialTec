<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificacion de Correo</title>
</head>

<style>
    *{
        margin: 0;
    }

    .head {
        padding: 25px;
        font-weight: bold;
        font-size: x-large;
        background-color: darkblue;
        color: white;
        text-align: center;
    }

    .success{
        padding: 15px;
        margin: 20px;
        background-color: green;
        text-align: center;
        color:white
    }

    .error{
        padding: 15px;
        margin: 20px;
        background-color: orangered;
        text-align: center;
        color:white
    }

</style>

<body>
    <header class="head">
        Verificacion de Correo
    </header>

    <div>

        <?php 
            include "config/db.php";

            $token = $_GET["token"];
            $active = 1;

            try {
                $stmt = $conn -> prepare("UPDATE users
                                        SET active = ?
                                        WHERE token = ?");
                $stmt->bind_param("is",$active,$token);
                $stmt->execute();

                if ($stmt->affected_rows) {
                    echo "<h3 class='success'> Se ha activado tu cuenta </h3>";
                } else {
                    echo "<h3 class='error'> Hubo un error </h3>";
                }
            } catch (Exception $e) {
                echo $e;
            }
        ?>

    </div>
</body>
</html>