<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqldetalletraslado = "SELECT * FROM detalletraslado $whereClause";
    $querydetalletraslado = mysqli_query($con, $sqldetalletraslado);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM detalletraslado WHERE Codigo_Det_Traslado = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar el detalletraslado: " . mysqli_error($con);
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
    <title>MOSTRAR EL DETALLE DE TRASLADO</title>
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

  

       <th> <button onclick="window.location.href='FinsertarDetalleTraslado.php'"> Insertar  Detalle de Traslado</button> </th>
    <h1>TABLA DETALLE DE TRASLADO</h1>

    <table>

      <thead>
        <tr>

          <th>Detalle del traslado</th>
          <th>ID del Traslado</th>
          <th>ID del producto</th>
          <th>ID de entreda a la bodega</th>
          <th>ID de salida a la bodega</th>
          <th>Cantidad de entrada</th>
          <th>Cantidad de salida</th>
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($querydetalletraslado)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Det_Traslado']; ?></td>
                <td><?php echo $row['Codigo_Traslado']; ?></td>
                <td><?php echo $row['Codigo_Producto']; ?></td>
                <td><?php echo $row['Codigo_Entrada_Bodega']; ?></td>
                <td><?php echo $row['Codigo_Salida_Bodega']; ?></td>
                <td><?php echo $row['Cantidad_Entrada_Bodega']; ?></td>
                <td><?php echo $row['Cantidad_Salida_Bodega']; ?></td>
             }
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Det_Traslado']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>