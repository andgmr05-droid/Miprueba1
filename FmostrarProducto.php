<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqlproducto = "SELECT * FROM producto $whereClause";
    $queryproducto = mysqli_query($con, $sqlproducto);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM producto WHERE Codigo_Producto = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar el producto: " . mysqli_error($con);
      }
      mysqli_stmt_close($stmt);
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOSTRAR PRODUCTO</title>
     <style>
       
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>


   </head>


    <body>

      <button onclick="window.location.href='index.php'"> Inicio </button>

         <th> <button onclick="window.location.href='FinsertarProducto.php'"> Insertar datos del Producto </button> </th>
    <h1>TABLA PRODUCTO</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Codigo categoria</th>
          <th>Precio Venta</th>
          <th>Precio Compra </th>
          <th>Descuento</th>
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($queryproducto)) {
          ?>
         

        <tr>
                <td><?php echo $row['Codigo_Producto']; ?></td>
                <td><?php echo $row['Descripcion_Producto']; ?></td>
                <td><?php echo $row['Precio_Venta_Producto']; ?></td>
                <td><?php echo $row['Precio_Compra_Producto']; ?></td>
                <td><?php echo $row['Descuento_Producto']; ?></td>
             
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Producto']; ?>">Eliminar</a></td>


        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>