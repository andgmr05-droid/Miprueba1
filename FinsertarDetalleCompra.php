<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Codigo_Det_Compra = $_POST['Codigo_Det_Compra'];
    $Codigo_Compra = $_POST['Codigo_Compra'];
    $Codigo_Producto = $_POST['Codigo_Producto'];
    $Codigo_Bodega = $_POST['Codigo_Bodega'];
    $Cantidad_Det_Compra = $_POST['Cantidad_Det_Compra'];
    $Valor_Unitario_Det_Compra = $_POST['Valor_Unitario_Det_Compra'];
    $Descuento_Det_Compra = $_POST['Descuento_Det_Compra'];
    $Sub_Total_Det_Compra = $_POST['Sub_Total_Det_Compra'];
    $IVA_Det_Compra = $_POST['IVA_Det_Compra'];
    $Valor_Total_Det_Compra = $_POST['Valor_Total_Det_Compra'];

    

    // Insertar datos en la base de datos

    $sqlInsert = "INSERT INTO detallecompra(Codigo_Det_Compra, Codigo_Compra, Codigo_Producto, Codigo_Bodega, Cantidad_Det_Compra, Valor_Unitario_Det_Compra, Descuento_Det_Compra, Sub_Total_Det_Compra, IVA_Det_Compra, Valor_Total_Det_Compra) 
                  VALUES ('$Codigo_Det_Compra', '$Codigo_Compra', '$Codigo_Producto', '$Codigo_Bodega', '$Cantidad_Det_Compra', '$Valor_Unitario_Det_Compra', '$Descuento_Det_Compra', '$Sub_Total_Det_Compra', '$IVA_Det_Compra', '$Valor_Total_Det_Compra')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar el detalle de compra: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <button onclick="window.location.href='index.php'"> Inicio </button>

    <button onclick="window.location.href='FmostrarDetallecompra.php'"> Detalle de la Compra </button>
    <title>INSERTAR DETALLE DE COMPRA</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <h1>INSERTAR EL DETALLE DE COMPRA</h1>
            </div>
            <form onsubmit="redirigirDespues(event)" method="POST"> 

                <label for="Codigo_Det_Compra"><b>Detalle de compra</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Det_Compra" required><br>
                
                <label for="Codigo_Compra"><b>Compra</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Compra" required><br>

                <label for="Codigo_Producto"><b>Producto</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Producto" required><br>

               <label for="Codigo_Bodega"><b>Bodega:</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Bodega" required><br>

                <label for="Cantidad_Det_Compra"><b> Cantidad de compra</b></label><br>
                <input type="number" placeholder="Inserte la cantidad" name="Cantidad_Det_Compra" required><br>

                <label for="Valor_Unitario_Det_Compra"><b>Valor unitario:</b></label><br>
                <input type="number" name="Valor_Unitario_Det_Compra" placeholder="Inserte valor unitario" required><br>

                <label for="Descuento_Det_Compra"><b>Descuento de la compra</b></label><br><input type="number" name="Descuento_Det_Compra" placeholder="Inserte el Descuento" required><br>

                <label for="Sub_Total_Det_Compra"><b>Sub total:</b></label><br>
                <input type="number" name="Sub_Total_Det_Compra" placeholder="Inserte el sub total" required><br>

                <label for="IVA_Det_Compra"><b>IVA de la compra:</b></label><br>
                <input type="number" name="IVA_Det_Compra" placeholder="Inserte el IVA" required><br>

                <label for="Valor_Total_Det_Compra"><b>Cantidad de entrada:</b></label><br>
                <input type="number" name="Valor_Total_Det_Compra" placeholder="Inserte el Total" required><br>

            

        

                <input class="bttn-crud bttn-Rol" type="submit" name="detallecompra" value="Insertar el detalle" onclick="window.location.href='FMostrarDetallecompra.php';">

               
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
      window.location.href = "FMostrarDetalleCompra"; // redirecciona
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
                        window.location.href = 'FMostrarDetallecompra.php'; 
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