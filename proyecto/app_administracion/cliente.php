<?php
//clientes.php
session_start();
//Conexion a la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = "root"; 
$database = "skidb"; 
$port = 3307;
$idClientes = $_GET['idClientes'];
// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener usuarios de la base de datos
$sql = "SELECT idTarjetas, tipo, Activo FROM tarjetas WHERE $idClientes = idClientes";
$result = $conn->query($sql);

// Cerrar conexión
$conn->close();

if (!isset($_SESSION['nombre']) || !isset($_SESSION['apellido'])) {
    // Redirigir a login.php si no hay sesión
    header("Location: login.php");
    exit();
}

$NombreCliente = $_GET['Nombre'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="ss.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="half-left2">
    <div class="top-menu">
    <div class="user-info" ><i class="fas fa-user fa-lg white-icon"></i> <?php echo htmlspecialchars($nombre); ?> <?php echo htmlspecialchars($apellido); ?></div>
    </div>

    <div class="content">
    <div class="left-menu">  
        <ul class="no-list">
        <li><a href="menu.php" class="ml-3"><i class="fas fa-home fa-lg white-icon"></i></a></i></li>
        <li><a href="logout.php" class="ml-3"><i class="fas fa-sign-out-alt fa-lg white-icon"></i></a></li>
        </ul>
    </div>

    <!--contenido de esta página-->
    <div class="half-right2">
    <div class="container mt-5">
    <!-- Botón para agregar usuario -->
    <div class="mb-3">
        <a href="clientes.php" class="btn btn-primary">Volver a clientes</a>
    </div>

    <!-- Cuadro centrado -->
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header">Lista de <?php echo htmlspecialchars($NombreCliente ); ?></div>
        <div class="card-body">
            <ul class="list-group">
                <?php
                // Mostrar usuarios
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                        echo $row["idTarjetas"] . " | Tipo: " . $row["tipo"] . " | Activo: " . $row["Activo"];
                        echo '<a href="eliminar_tarjeta.php?idTarjetas=' . $row["idTarjetas"] . '" class="btn btn-danger btn-sm ml-auto">Eliminar</a>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>





</div> 
</div>
</div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>