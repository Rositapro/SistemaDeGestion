<?php
$host = "db";
$user = "root";
$pass = "admin";
$db   = "sistema_web";

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>