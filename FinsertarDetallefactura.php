<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Codigo_Factura = $_POST['Codigo_Factura'];
    $Codigo_Det_Factura = $_POST['Codigo_Det_Factura'];
    $Codigo_Produto = $_POST['Codigo_Producto'];
    $Codigo_Bodega = $_POST['Codigo_Bodega'];
    $Cantidad_Det_Factura = $_POST['Cantidad_Det_Factura'];
    $Valor_Unitario_Det_Factura = $_POST['Valor_Unitario_Det_Factura'];
    $Descuento_Det_Factura = $_POST['Descuento_Det_Factura'];
    $Sub_Total_Det_Factura = $_POST['Sub_Total_Det_Factura'];
    $IVA_Det_Factura = $_POST['IVA_Det_Factura'];
    $Valor_Total_Det_Factura = $_POST['Valor_Total_Det_Factura'];

    

    // Insertar datos en la base de datos

    $sqlInsert = "INSERT INTO detallefactura(Codigo_Factura, Codigo_Det_Factura, Codigo_Producto, Codigo_Bodega, Cantidad_Det_Factura, Valor_Unitario_Det_Factura, Descuento_Det_Factura, Sub_Total_Det_Factura, IVA_Det_Factura, Valor_Total_Det_Factura) 
                  VALUES ('$Codigo_Factura', '$Codigo_Det_Factura', '$Codigo_Producto', '$Codigo_Bodega', '$Cantidad_Det_Factura', '$Valor_Unitario_Det_Factura', '$Descuento_Det_Factura', '$Sub_Total_Det_Factura', '$IVA_Det_Factura', '$Valor_Total_Det_Factura')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar el detalle de factura: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <button onclick="window.location.href='index.php'"> Inicio </button>

    <button onclick="window.location.href='FmostrarDetallefactura.php'"> Datos de Detalle de factura </button> 
    <title>INSERTAR DETALLE DE FACTURA</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <h1>INSERTAR EL DETALLE DE FACTURA</h1>
            </div>
            <form onsubmit="redirigirDespues(event)" method="POST"> 

                <label for="Codigo_Factura"><b>Codigo de la factura</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Factura" required><br>
                
                <label for="Codigo_Det_Factura"><b>Detalle de la factura</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Det_Factura" required><br>

                <label for="Codigo_Producto"><b>Producto</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Producto" required><br>

               <label for="Codigo_Bodega"><b>Bodega:</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Bodega" required><br>

                <label for="Cantidad_Det_Factura"><b> Cantidad de factura</b></label><br>
                <input type="number" placeholder="Inserte la cantidad" name="Cantidad_Det_Factura" required><br>

                <label for="Valor_Unitario_Det_Factura"><b>Valor unitario:</b></label><br>
                <input type="number" name="Valor_Unitario_Det_Factura" placeholder="Inserte valor unitario" required><br>

                <label for="Descuento_Det_Compra"><b>Descuento de la compra</b></label><br><input type="number" name="Descuento_Det_Compra" placeholder="Inserte el Descuento" required><br>

                <label for="Sub_Total_Det_Factura"><b>Sub total:</b></label><br>
                <input type="number" name="Sub_Total_Det_Factura" placeholder="Inserte el sub total" required><br>

                <label for="IVA_Det_Factura"><b>IVA de la factura:</b></label><br>
                <input type="number" name="IVA_Det_Factura" placeholder="Inserte el IVA" required><br>

                <label for="Valor_Total_Det_Factura"><b>Valor total:</b></label><br>
                <input type="number" name="Valor_Total_Det_Factura" placeholder="Inserte el Total" required><br>

            

        

                <input class="bttn-crud bttn-Rol" type="submit" name="detallefactura" value="Insertar el detalle" onclick="window.location.href='FMostrarDetallefactura.php';">

               
            </form>
        </div>
    </main>

    <!--SCRIPT MENSAJE -->
    <?php if ($insercion_exitosa): ?>
        <script>
            function redirigirDespues(event) {
  event.preventDefault(); // evita el envío normal
  const formulario = document.getElementById('detallefactura');
  
  // Envía los datos usando fetch (puedes cambiarlo a AJAX si prefieres)
  fetch(formulario.action, {
    method: formulario.method,
    body: new FormData(formulario)
  }).then(respuesta => {
    if (respuesta.ok) {
      window.location.href = "FMostrarDetallefactura"; // redirecciona
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
                        window.location.href = 'FMostrarDetallefactura.php'; 
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