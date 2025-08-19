<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Codigo_Proveedor = $_POST['Codigo_Proveedor'];
    $Fecha_Compra = $_POST['Fecha_Compra'];
    

    // Insertar datos en la base de datos

    $sqlInsert = "INSERT INTO compra(Codigo_Proveedor, Fecha_Compra) 
                  VALUES ('$Codigo_Proveedor', '$Fecha_Compra')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar la compra: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <button onclick="window.location.href='index.php'"> Inicio </button>

    <button onclick="window.location.href='FmostrarCompra.php'"> Datos de la Compra </button> 

    <title>INSERTAR COMPRA</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <h1>INSERTAR LA COMPRA</h1>
            </div>
            <form onsubmit="redirigirDespues(event)" method="POST"> 
    

                <label for="Codigo_Proveedor"><b>Proveedor</b></label><br>
                <input type="text" placeholder="Inserte el Nombre" name="Codigo_Proveedor" required><br>

                <label for="Fecha_Compra"><b>Fecha de la compra </b></label><br>
                <input type="date" placeholder="Inserte la direccion" name="Fecha_Compra" required><br>

        

                <input class="bttn-crud bttn-Rol" type="submit" name="compra" value="Insertar la compra" onclick="window.location.href='FMostrarCompra.php';">

               
            </form>
        </div>
    </main>

    <!--SCRIPT MENSAJE -->
    <?php if ($insercion_exitosa): ?>
        <script>
            function redirigirDespues(event) {
  event.preventDefault(); // evita el envío normal
  const formulario = document.getElementById('compra');
  
  // Envía los datos usando fetch (puedes cambiarlo a AJAX si prefieres)
  fetch(formulario.action, {
    method: formulario.method,
    body: new FormData(formulario)
  }).then(respuesta => {
    if (respuesta.ok) {
      window.location.href = "FMostrarCompra"; // redirecciona
    } else {
      alert("Error al insertar.");
    }
  });
}
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cliente insertado con éxito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'FMostrarCompra.php'; 
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