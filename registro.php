<?php
session_start();

if (!isset($_SESSION['token'])) {
    header("Location: index.html");
    exit();
}

$token = $_SESSION['token'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correcto</title>
</head>
<body>
    <h2>Bienvenido de nuevo</h2>
    <p>token DE SESION: <?php echo $token; ?></p>
    <a href="salir.php">Salir</a>
</body>
</html>