<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Cedula_Cliente = $_POST['Cedula_Cliente'];
    $Apellidos_Cliente = $_POST['Apellidos_Cliente'];
    $Nombres_Cliente = $_POST['Nombres_Cliente'];
    $Direccion_Cliente = $_POST['Direccion_Cliente'];
    $Telefono_Cliente = $_POST['Telefono_Cliente'];
    $Fecha_Nac_Cliente = $_POST['Fecha_Nac_Cliente'];

    // Insertar datos en la base de datos

    $sqlInsert = "INSERT INTO cliente(Cedula_Cliente, Apellidos_Cliente, Nombres_Cliente, Direccion_Cliente, Telefono_Cliente, Fecha_Nac_Cliente) 
                  VALUES ('$Cedula_Cliente', '$Apellidos_Cliente','$Nombres_Cliente','$Direccion_Cliente','$Telefono_Cliente','$Fecha_Nac_Cliente')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar el cliente: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>INSERTAR CLIENTE</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <button onclick="window.location.href='index.php'"> Inicio </button>

                <button onclick="window.location.href='FmostrarCliente.php'"> Mostrar Clientes </button>
                <h1>INSERTAR CLIENTE</h1>
            </div>
            <form method="POST">
                
                <label for="Cedula_Cliente"><b>Cedula:</b></label><br>
                <input type="number" placeholder="Inserte su Cedula" name="Cedula_Cliente" required><br>

                <label for="Apellidos_Cliente"><b>Apellidos:</b></label><br>
                <input type="text" placeholder="Inserte sus Apellidos" name="Apellidos_Cliente" required><br>

                <label for="Nombres_Cliente"><b>Nombres:</b></label><br>
                <input type="text" name="Nombres_Cliente" placeholder="Inserte sus Nombres" required><br>

                <label for="Direccion_Cliente"><b>Direccion:</b></label><br><input type="text" name="Direccion_Cliente" placeholder="Inserte su Direccion" required><br>

                <label for="Telefono_Cliente"><b>Telefono:</b></label><br>
                <input type="number" name="Telefono_Cliente" placeholder="Inserte su Telefono" required><br>

                <label for="Fecha_Nac_Cliente"><b>Fecha de Nacimiento:</b></label><br>
                <input type="date" name="Fecha_Nac_Cliente" placeholder="Inserte su fecha de Nacimiento" required><br>


               <input class="bttn-crud bttn-Rol" type="submit" name="Insertar" value="Insertar cliente" onclick="window.location.href='FmostrarCliente.php';">
               
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
                        window.location.href = 'FMostrarCliente.php'; 
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