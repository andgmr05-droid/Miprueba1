<?php
include('Connection/connection.php');
$con = connection();
$categoriaQuery = mysqli_query($con, "SELECT Codigo_Categoria, Nombre_Categoria FROM categoria ORDER BY Nombre_Categoria");

$insercion_exitosa = false; // Añadido para controlar la alerta de éxito

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Descripcion_Producto = $_POST['Descripcion_Producto'];
    $Precio_Venta_Producto = $_POST['Precio_Venta_Producto'];
    $Precio_Compra_Producto = $_POST['Precio_Compra_Producto'];
    $Descuento_Producto = $_POST['Descuento_Producto'];

    // Insertar datos en la base de datos

   $sqlInsert = "INSERT INTO producto( Descripcion_Producto, Precio_Venta_Producto, Precio_Compra_Producto, Descuento_Producto) 
                  VALUES ('$Descuento_Producto', '$Precio_Venta_Producto', '$Precio_Compra_Producto', '$Descuento_Producto')";
    
    
    if (mysqli_query($con, $sqlInsert)) {
        $insercion_exitosa = true;  // Inserción exitosa
    } else {
        $mensaje_error = "Error al insertar el producto: " . mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>INSERTAR EL PRODUCTO</title>
    
</head>

<body>

    <main class="main-insert">
     
        <div class="panel-Container">
            
            <div class="header-container">
                <button onclick="window.location.href='index.php'"> Inicio </button>
                <button onclick="window.location.href='FmostrarProducto.php'"> Datos del Producto </button> 
                <h1>INSERTAR EL PRODUCTO</h1>
            </div>
            <form method="POST">
                

                <label for="Descripcion_Producto"><b>Descripcion:</b></label><br>
                <input type="text" placeholder="Inserte la descripcion" name="Descripcion_Producto" required><br>


                <label><b>Seleccionar Categoria:</b></label></br>
                    <select name="Codigo_Categoria" required>
                        <?php
                        while ($categoria = $categoriaQuery->fetch_assoc()) {
                            echo "<option value='{$categoria['Codigo_Categoria']}'>{$categoria['Nombre_Categoria']}</option>";
                        }
                        ?>
                    </select><br>



                <label for="Precio_Venta_Producto"><b>Precio:</b></label><br>
                <input type="number" name="Precio_Venta_Producto" placeholder="Inserte el precio" required><br>

                <label for="Precio_Compra_Producto"><b>Precio de compra:</b></label><br>
                <input type="number" name="Precio_Compra_Producto" placeholder="Inserte la compra" required><br>

                <label for="Descuento_Producto"><b>Descuento:</b></label><br>
                <input type="number" name="Descuento_Producto" placeholder="Inserte el descuento" required><br>

               


                <input class="bttn-crud bttn-Rol" type="submit" name="producto" value="Insertar datos del producto" onclick="window.location.href='FMostrarProducto.php';">
               
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
                        window.location.href = 'FMostrarProducto.php'; 
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