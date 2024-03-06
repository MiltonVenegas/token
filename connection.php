<?php

$server = "localhost";
$dbname =  "rec";
$username = "root";
$password = "root";

try{
    $pdo = new PDO("mysql:server=$server;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "conexion exitosa";
}catch(PDOException $e){
    die("Conexion fallida:". $e->getMessage());
}
function validateLogin($username, $password, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM alumnos WHERE user = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $token = generateToken();
            $dateTime = date('Y-m-d H:i:s');
            $updateStmt = $pdo->prepare("UPDATE alumnos SET token = :token, date_time = :dateTime WHERE id = :userId");
            $updateStmt->execute(['token' => $token, 'dateTime' => $dateTime, 'userId' => $user['id']]);
            return $user; 
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}

function generateToken() {
    return bin2hex(random_bytes(16));
}

$username = $_POST['username'];
$password = $_POST['password'];

$user = validateLogin($username, $password, $pdo);

if ($user) {
    session_start();
    $_SESSION['user'] = $user;
    echo "Login successful!";
} else {
    echo "Invalid username or password.";
}