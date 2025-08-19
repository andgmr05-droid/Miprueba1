<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombre_Bodega = $_POST['Nombre_Bodega'];
    $Direccion_Bodega = $_POST['Direccion_Bodega'];
    $Telefono_Bodega = $_POST['Telefono_Bodega'];

    // Insertar datos en la base de datos

    $sqlInsert = "INSERT INTO bodega(Nombre_Bodega, Direccion_Bodega, Telefono_Bodega) 
                  VALUES ('$Nombre_Bodega', '$Direccion_Bodega', '$Telefono_Bodega')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar la bodega: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<head>
    <title>INSERTAR BODEGA</title>
    
</head>

<body>
    <header style="position: fixed; z-index: 1000; margin-bottom: 100vh;" class="pta">
    <nav>
        <?php include 'menu.php';?>
    </nav>
</header>
    <main class="main-insert" >
     
        <div class="panel-Container container">
            
            <div class="header-container f">
                <h1>INSERTAR LA BODEGA</h1>
            </div>
            <form onsubmit="redirigirDespues(event)" method="POST"> 
                
                

                <label for="Nombre_Bodega"><b>Nombre de la bodega</b></label><br>
                <input type="text" placeholder="Inserte el Nombre" name="Nombre_Bodega" required><br>

                <label for="Direccion_Bodega"><b>Direccion </b></label><br>
                <input type="text" placeholder="Inserte la direccion" name="Direccion_Bodega" required><br>

                <label for="Telefono_Bodega"><b>Telefono</b></label><br>
                <input type="number" placeholder="Telefono" name="Telefono_Bodega" required><br>

        

                <input class="bttn-crud bttn-Rol" type="submit" name="bodega" value="Insertar datos de la bodega" onclick="window.location.href='FMostrarBodega.php';">

               
            </form>
        </div>
    </main>

    <!--SCRIPT MENSAJE -->
    <?php if ($insercion_exitosa): ?>
        <script>
            function redirigirDespues(event) {
  event.preventDefault(); // evita el envío normal
  const formulario = document.getElementById('bodega');
  
  // Envía los datos usando fetch (puedes cambiarlo a AJAX si prefieres)
  fetch(formulario.action, {
    method: formulario.method,
    body: new FormData(formulario)
  }).then(respuesta => {
    if (respuesta.ok) {
      window.location.href = "FMostrarBodega"; // redirecciona
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
                        window.location.href = 'FMostrarBodega.php'; 
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