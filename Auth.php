<?php

session_start();

function authenticate($email) {
    return ($email === '11012842849b1007fbaefc4ee8940d47f9ee554212441b2a66b96769ad596313');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["correo"];

    if (authenticate($email)) {
        if (!isset($_SESSION['token'])) {
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
        }
        header("Location: registro.php");
        exit();
    } else {
        echo "Datos incorrectos, revise de nuevo porfavor";
    }
}


?>