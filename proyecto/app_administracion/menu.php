<?php
// menu.php
session_start();

if (!isset($_SESSION['nombre']) || !isset($_SESSION['apellido'])) {
    // Redirigir a login.php si no hay sesión
    header("Location: login.php");
    exit();
}

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
        <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 text-center">
                <h2>Clientes</h2>
                <a href="clientes.php" class="btn btn-primary btn-lg mt-3 d-block">Clientes</a>
            </div>
            <div class="col-md-6 text-center">
                <h2>Pases</h2>
                <a href="pases.php" class="btn btn-primary btn-lg mt-3 d-block">Pases</a>
            </div>
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