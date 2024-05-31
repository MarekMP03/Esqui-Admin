<?php
//clientes.php
session_start();
//Conexion a la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = "root"; 
$database = "skidb"; 
$port = 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $idTarjetas = $_GET['idTarjetas'];
    // Eliminar usuario de la base de datos
    $stmt = $conn->prepare("DELETE FROM tarjetas WHERE idTarjetas = ?");
    $stmt->bind_param("i", $idTarjetas);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: clientes.php");