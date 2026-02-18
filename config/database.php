<?php

$host = "localhost";
$dbname = "gymdb";
$user = "root";
$pass = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
