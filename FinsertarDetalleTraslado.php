<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Codigo_Det_Traslado = $_POST['Codigo_Det_Traslado'];
    $Fecha_Traslado = $_POST['Codigo_Traslado'];
    $Codigo_Producto = $_POST['Codigo_Producto'];
    $Codigo_Entrada_Bodega = $_POST['Codigo_Entrada_Bodega'];
    $Codigo_Salida_Bodega = $_POST['Codigo_Salida_Bodega'];
    $Cantidad_Entrada_Bodega = $_POST['Cantidad_Entrada_Bodega'];
    $Cantidad_Salida_Bodega = $_POST['Cantidad_Salida_Bodega'];

    

    // Insertar datos en la base de datos

     $sqlInsert = "INSERT INTO detalletraslado(Codigo_Det_Traslado, Codigo_Traslado, Codigo_Producto, Codigo_Entrada_Bodega, Codigo_Salida_Bodega, Cantidad_Entrada_Bodega, Cantidad_Salida_Bodega) 
                  VALUES ('$Codigo_Det_Traslado', '$Codigo_Producto', '$Codigo_Producto','$Codigo_Entrada_Bodega','$Codigo_Salida_Bodega','$Cantidad_Entrada_Bodega','$Cantidad_Salida_Bodega')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar el detalle de traslado: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <button onclick="window.location.href='index.php'"> Inicio </button>

    <button onclick="window.location.href='FmostrarDetalletraslado.php'">  Datos de Detalle de Traslado </button>
    <title>INSERTAR DETALLE DE TRASLADO  </title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <h1>INSERTAR EL DETALLE DE TRASLADO</h1>
            </div>
            <form onsubmit="redirigirDespues(event)" method="POST"> 

                
                <label for="Codigo_Det_Traslado"><b>Detalle del traslado</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Det_Traslado" required><br>

                <label for="Codigo_Traslado"><b>Codigo del traslado</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Traslado" required><br>

               <label for="Codigo_Producto"><b>Codigo del Producto:</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Producto" required><br>

                <label for="Codigo_Entrada_Bodega"><b>Codigo de entrada</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Entrada_Bodega" required><br>

                <label for="Codigo_Salida_Bodega"><b> Codigo de salida</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Salida_Bodega" required><br>

                <label for="Cantidad_Entrada_Bodega"><b> Cantidad de entrada</b></label><br>
                <input type="number" placeholder="Inserte la cantidad" name="Cantidad_Entrada_Bodega" required><br>

                <label for="Cantidad_Salida_Bodega"><b> Cantidad de salida</b></label><br>
                <input type="number" placeholder="Inserte la cantidad" name="Cantidad_Salida_Bodega" required><br>
                
            

                <input class="bttn-crud bttn-Rol" type="submit" name="detalletraslado" value="Insertar detalle de traslado" onclick="window.location.href='FMostrarDetalletraslado.php';">

               
            </form>
        </div>
    </main>

    <!--SCRIPT MENSAJE -->
    <?php if ($insercion_exitosa): ?>
        <script>
            function redirigirDespues(event) {
  event.preventDefault(); // evita el envío normal
  const formulario = document.getElementById('detalletraslado');
  
  // Envía los datos usando fetch (puedes cambiarlo a AJAX si prefieres)
  fetch(formulario.action, {
    method: formulario.method,
    body: new FormData(formulario)
  }).then(respuesta => {
    if (respuesta.ok) {
      window.location.href = "FMostrarDetalletraslado"; // redirecciona
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
                        window.location.href = 'FMostrarDetalletraslado.php'; 
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