<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Codigo_Proveedor = $_POST['Codigo_Proveedor'];
    $Razon_Social_Proveedor = $_POST['Razon_Social_Proveedor'];
    $Direccion_Proveedor = $_POST['Direccion_Proveedor'];
    $Telefono_Proveedor = $_POST['Telefono_Proveedor'];
    $Email_Proveedor = $_POST['Email_Proveedor'];

    // Insertar datos en la base de datos

    $sqlInsert = "INSERT INTO proveedor(Codigo_Proveedor, Razon_Social_Proveedor, Direccion_Proveedor, Telefono_Proveedor, Email_Proveedor) 
                  VALUES ('$Codigo_Proveedor', '$Razon_Social_Proveedor','$Direccion_Proveedor','$Telefono_Proveedor','$Email_Proveedor')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar el proveedor: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>INSERTAR PROVEEDOR</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <button onclick="window.location.href='index.php'"> Inicio </button>

                <button onclick="window.location.href='FmostrarProveedor.php'"> Datos del Proveedor </button> 
                <h1>INSERTAR PROVEEDOR</h1>
            </div>
            <form method="POST">
                
                <label for="Codigo_Proveedor"><b>Proveedor:</b></label><br>
                <input type="text" placeholder="Nombre del proveedor" name="Codigo_Proveedor" required><br>

                <label for="Razon_Social_Proveedor"><b>Razon Social:</b></label><br>
                <input type="text" placeholder="Inserte la razon social" name="Razon_Social_Proveedor" required><br>

                <label for="Direccion_Proveedor"><b>Direccion</b></label><br>
                <input type="text" name="Direccion_Proveedor" placeholder="Direccion del proveedor" required><br>

                <label for="Telefono_Proveedor"><b>Telefono</b></label><br>
                <input type="number" name="Telefono_Proveedor" placeholder="Telefono del proveedor" required><br>

                <label for="Email_Proveedor"><b>Email:</b></label><br>
                <input type="text" name="Email_Proveedor" placeholder="Email del proveedor" required><br>


                <input class="bttn-crud bttn-Rol" type="submit" name="proveedor" value="Insertar datos del proveedor" onclick="window.location.href='FMostrarProveedor.php';">
               
            </form>
        </div>
    </main>

    <!--SCRIPT MENSAJE -->
    <?php if ($insercion_exitosa): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Proveedor insertado con éxito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'FMostrarProveedor.php'; 
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