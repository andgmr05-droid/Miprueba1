<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Cedula_Cliente= $_POST['Cedula_Cliente'];
    $Fecha_Factura = $_POST['Fecha_Factura'];
    $Codigo_Pago = $_POST['Codigo_Pago'];

    // Insertar datos en la base de datos

    $sqlInsert = "INSERT INTO factura(Cedula_Cliente, Fecha_Factura, Codigo_Pago) 
                  VALUES ('$Cedula_Cliente', '$Fecha_Factura', '$Codigo_Pago')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar la factura: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <button onclick="window.location.href='index.php'"> Inicio </button>

    <button onclick="window.location.href='FmostrarFactura.php'"> Datos de facturas </button>
    <title>INSERTAR LA FACTURA</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <h1>INSERTAR LA FACTURA</h1>
            </div>
            <form onsubmit="redirigirDespues(event)" method="POST"> 

                
                <label for="Cedula_Cliente"><b>Cedula </b></label><br>
                <input type="number" placeholder="Inserte su cedula" name="Cedula_Cliente" required><br>

                <label for="Fecha_Factura"><b>Fecha de la factura</b></label><br>
                <input type="date" placeholder="Inserte el codigo" name="Fecha_Factura" required><br>

               <label for="Codigo_Pago"><b>Pago:</b></label><br>
                <input type="number" placeholder="Inserte el codigo" name="Codigo_Pago" required><br>

              
            

        

                <input class="bttn-crud bttn-Rol" type="submit" name="factura" value="Insertar la factura" onclick="window.location.href='FMostrarDetallefactura.php';">

               
            </form>
        </div>
    </main>

    <!--SCRIPT MENSAJE -->
    <?php if ($insercion_exitosa): ?>
        <script>
            function redirigirDespues(event) {
  event.preventDefault(); // evita el envío normal
  const formulario = document.getElementById('factura');
  
  // Envía los datos usando fetch (puedes cambiarlo a AJAX si prefieres)
  fetch(formulario.action, {
    method: formulario.method,
    body: new FormData(formulario)
  }).then(respuesta => {
    if (respuesta.ok) {
      window.location.href = "FMostrarFactura"; // redirecciona
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
                        window.location.href = 'FMostrarFactura.php'; 
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