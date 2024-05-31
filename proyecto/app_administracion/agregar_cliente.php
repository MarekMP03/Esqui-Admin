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

$nombre = $conn->real_escape_string($_POST['nombre']);
$apellido = $conn->real_escape_string($_POST['apellido']);


$sql = "INSERT INTO clientes (Nombre, Apellido) VALUES ('$nombre', '$apellido')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo cliente agregado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: clientes.php");