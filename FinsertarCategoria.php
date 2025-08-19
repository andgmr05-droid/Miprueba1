<?php
include('Connection/connection.php');
$con = connection();

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombre_Categoria = $_POST['Nombre_Categoria'];

    // Insertar datos en la base de datos

    $sqlInsert = "INSERT INTO categoria(Nombre_Categoria) 
                  VALUES ('$Nombre_Categoria')";
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar la categoria: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <button onclick="window.location.href='index.php'"> Inicio </button>

    <button onclick="window.location.href='FmostrarCategoria.php'"> Mostrar Categoria </button> 
    <title>INSERTAR LA CATEGORIA</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <h1>INSERTAR CATEGORIA</h1>
            </div>
            <form onsubmit="redirigirDespues(event)" method="POST"> 

                <label for="Nombre_Categoria"><b>Nombre:</b></label><br>
                <input type="text" placeholder="Nombre de la categoria" name="Nombre_Categoria" required><br>
        

                <input class="bttn-crud bttn-Rol" type="submit" name="categoria" value="Insertar categoria" onclick="window.location.href='FMostrarCategoria.php';">

               
            </form>
        </div>
    </main>

    <!--SCRIPT MENSAJE -->
    <?php if ($insercion_exitosa): ?>
        <script>
            function redirigirDespues(event) {
  event.preventDefault(); // evita el envío normal
  const formulario = document.getElementById('categoria');
  
  // Envía los datos usando fetch (puedes cambiarlo a AJAX si prefieres)
  fetch(formulario.action, {
    method: formulario.method,
    body: new FormData(formulario)
  }).then(respuesta => {
    if (respuesta.ok) {
      window.location.href = "FMostrarCategoria"; // redirecciona
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
                        window.location.href = 'FMostrarCategoria.php'; 
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