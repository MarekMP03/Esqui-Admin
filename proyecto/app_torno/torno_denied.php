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
    background-color: red;
}

    .container {
    text-align: center;
}

    .icono-ok img {
    width: 100px; 
    height: auto; 
}

    .texto {
        color: white;
        font-size: 50px;
    }
</style>
</head>
<div class="container">
        <div class="icono-ok">
            <img src="icono-no.png" alt="Icono NO">
        </div>
        <div class="texto">
            <p>Denied</p>
            <?php echo "Porfavor recargar tarjeta"?>
        </div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "torno.html"; 
        }, 3000); 
    </script>
</body>
</html>
<?php

?>