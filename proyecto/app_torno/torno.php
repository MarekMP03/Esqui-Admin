<?php
//Conexion a la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = "root"; 
$database = "skidb"; 
$port = 3307;

$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// Obtener el ID de la tarjeta del formulario
$idTarjeta = $_POST["idTarjeta"];

// Consulta SQL para obtener información de la tarjeta específica
$sql = "SELECT c.Nombre AS NombreCliente, t.idTarjetas, t.Activo, t.tipo, t.tipo1, t.tipo2, t.tipo3
        FROM tarjetas t
        LEFT JOIN Clientes c ON t.idClientes = c.idClientes
        WHERE t.idTarjetas = $idTarjeta";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos de la tarjeta
    while($row = $result->fetch_assoc()) {
        echo "Nombre del Cliente: " . $row["NombreCliente"] . "<br>";
        echo "ID de la Tarjeta: " . $row["idTarjetas"] . "<br>";
        echo "Activo de la Tarjeta: " . $row["Activo"] . "<br>";
        echo "Tipo de la Tarjeta: " . $row["tipo"] . "<br>";
     // Comprobar si la tarjeta esta activa.
        $activo = $row["Activo"];
       if ($activo == 1) {
        // Comprobar el tipo de la tarjeta y realizar acciones específicas
        $tipo = $row["tipo"];
        if ($tipo == 1) {

            // Si es tipo1
            if ($row["tipo1"] > 0) {
                header("Location: torno_accepted.php?idTarjeta=$idTarjeta");
                exit;
            } else {
                header("Location: torno_denied.php?idTarjeta=$idTarjeta");
                exit;
            }
              // Si es tipo2
        } elseif ($tipo == 2) {
            $horaTipo2 = date("H:i:s", strtotime($row["tipo2"]));
            $horaActual = date("H:i:s");
            if ($horaTipo2 > $horaActual) {
                header("Location: torno_accepted.php?idTarjeta=$idTarjeta");
                exit;
            } else {
                header("Location: torno_denied.php?idTarjeta=$idTarjeta");
                exit;
            }
              // Si es tipo3
        } elseif ($tipo == 3) {
            $fechaTipo3 = strtotime($row["tipo3"]);
            $fechaHoy = strtotime(date("Y-m-d"));
            if ($fechaTipo3 > $fechaHoy) {
                header("Location: torno_accepted.php?idTarjeta=$idTarjeta");
                exit;
            } else {
                header("Location: torno_denied.php?idTarjeta=$idTarjeta");
                exit;
            }
        }
    } else { echo "No activada";
    }} 
} else {
    echo "No se encontraron resultados para la tarjeta con ID: $idTarjeta";
}
// Cerrar la conexión
$conn->close();
?>
