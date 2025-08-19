<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Codigo_Traslado = $_POST['Codigo_Traslado'];
    $Fecha_Traslado = $_POST['Fecha_Traslado'];


    // Insertar datos en la base de datos
    $sqlInsert = "INSERT INTO traslado(Codigo_Traslado, Fecha_Traslado) 
                  VALUES ('$Codigo_Traslado', '$Fecha_Traslado')";
                  if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar el traslado: " . mysqli_error($con);
    }
    


}


?>
<!DOCTYPE html>
<html>

<head>
    <title>INSERTAR EL TRASLADO</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <button onclick="window.location.href='index.php'"> Inicio </button>

                <button onclick="window.location.href='FmostrarTraslado.php'"> Detalle de Traslado</button>

                <h1>INSERTAR TRASLADO</h1>
            </div>
            <form method="POST">
                
                <label for="Codigo_Traslado"><b>Codigo Traslado:</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Traslado" required><br>

                <label for="Fecha_Traslado"><b>Fecha del traslado:</b></label><br>
                <input type="date" placeholder="Inserte la fecha" name="Fecha_Traslado" required><br>



               <input class="bttn-crud bttn-Rol" type="submit" name="traslado" value="Insertar datos de traslado" onclick="window.location.href='FMostrarTraslado.php';">
               
            </form>
        </div>
    </main>

    <!--SCRIPT MENSAJE -->
    <?php if ($insercion_exitosa): ?>
        <script>

            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cliente insertado con éxito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'FMostrarTraslado.php'; 
                    }
                });
            });
        </script>
    <?php endif; ?>

    <!-- Si hubo un error -->
    <?php if (isset($mensaje_error)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: '<?php echo htmlspecialchars($mensaje_error); ?>',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                });
            });
        </script>
    <?php endif; ?>
</body>

</html>