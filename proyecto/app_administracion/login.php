<?php
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

    //variables necesarias 
    $error = "";

    //envio de formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cod = $_POST['codice'];
    $pass = $_POST['password'];

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("SELECT idUsuarios, Nombre, Apellido FROM usuarios WHERE codice = ? AND password = ?");
    $stmt->bind_param("ss", $cod, $pass);
    $stmt->execute();
    $stmt->store_result();


    if ($stmt->num_rows > 0) {
        //Pasar datos si es correcto
        $stmt->bind_result($idUsuarios, $nombre, $apellido);
        $stmt->fetch();
        $_SESSION['codice'] = $cod;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        header("Location: menu.php");
        exit();
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="ss.css" rel="stylesheet">
    <style>
    
    </style>
</head>
<body>
<div class="half-left">
    <div class="col-md-6 half-right">
        <div class="form-container">
                <h2 class="text-center">Login</h2>
                <?php 
                
                if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="login.php">
                    <div class="form-group">
                        <label for="codice">Código de usuario:</label>
                        <input type="text" class="form-control" id="codice" name="codice" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <div class="attribution">
                    Imagen de <a href="https://pixabay.com/es/users/locuig-2144769/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=1273379">locuig</a> en <a href="https://pixabay.com/es//?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=1273379">Pixabay</a>

                </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>