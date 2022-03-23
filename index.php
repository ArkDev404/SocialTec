<?php 
    if (isset($_SESSION["username"])) {
        header("");
    } else {
        header("Location: login.php");
    }
?>