<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
        body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: green;
}

    .container {
    text-align: center;
}

    .icono-ok img {
    width: 100px; /* ajusta el tamaño según sea necesario */
    height: auto; /* mantiene la proporción de la imagen */
}

    .texto {
        color: white;
        font-size: 50px;
    }

</style>
</head>
<body>
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



// Obtener el ID de la tarjeta del script anterior.
$idTarjeta = $_GET['idTarjeta'];

// Consulta SQL para obtener información de la tarjeta específica
$sql = "SELECT c.Nombre AS NombreCliente, t.idTarjetas, t.Activo, t.tipo, t.tipo1, t.tipo2, t.tipo3
        FROM tarjetas t
        LEFT JOIN Clientes c ON t.idClientes = c.idClientes
        WHERE t.idTarjetas = $idTarjeta";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos de la tarjeta
    while($row = $result->fetch_assoc()) {



        // Lineas de control de prueba, desmarcar para ver los datos que se pasan
      //  echo "Nombre del Cliente: " . $row["NombreCliente"] . "<br>";
      //  echo "ID de la Tarjeta: " . $row["idTarjetas"] . "<br>";
      //  echo "Activo de la Tarjeta: " . $row["Activo"] . "<br>";
      //  echo "Tipo de la Tarjeta: " . $row["tipo"] . "<br>";

        if ($result->num_rows > 0) {

                //Mostrar cuantos viajes quedan
            $tipo = $row["tipo"];
            if ($tipo == 1) {
                $tipo1 = $row["tipo1"] - 1;
                

                // Actualizar el valor de tipo1 en la base de datos
                $updateSql = "UPDATE tarjetas SET tipo1 = $tipo1 WHERE idTarjetas = $idTarjeta";
                if ($conn->query($updateSql) === TRUE) {
                   $mensaje = "Te quedan " . $tipo1 . " viajes";
                } else {
                    echo "Error al actualizar el valor de tipo1: " . $conn->error;
                }

                 
            } elseif ($tipo == 2) {


                // Devolver lo que queda de tiempo
                $horaTipo2 = strtotime($row["tipo2"]);
                $horaActual = strtotime(date("H:i:s"));
                $diferencia = $horaTipo2 - $horaActual;

                // Convertir el resultado a formato hora minuto
                $horas = floor($diferencia / 3600); 
                $minutos = floor(($diferencia % 3600) / 60); 
                $mensaje = "Te queda " . $horas . ":" . $minutos . "h"; 

            } elseif ($tipo == 3) {


            
                //devolver los dias que quedan  
                $fechaTipo3 = strtotime($row["tipo3"]);
                $fechaHoy = strtotime(date("Y-m-d"));
                
                // Convertir la diferencia de segundos a días
                $diferencia = round(($fechaTipo3 - $fechaHoy) / (60 * 60 * 24));
                $mensaje = "Te quedan " . $diferencia . " días";
            }
        
    }
    }
} else {
    echo "No se encontraron resultados para la tarjeta con ID: $idTarjeta";
}

// Cerrar la conexión
$conn->close();

//imprimir pantalla

?>


<div class="container">
        <div class="icono-ok">
            <img src="icono-ok.png" alt="Icono OK">
        </div>
        <div class="texto">
            <p>Accepted </p>
            <?php echo $mensaje?>
        </div>
    </div>
    

    <!-- script para redirigir al principio -->
    <script>
        setTimeout(function() {
            window.location.href = "torno.html";
        }, 3000); 
    </script>

</body>
</html>