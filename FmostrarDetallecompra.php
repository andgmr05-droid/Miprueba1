<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqldetallecompra = "SELECT * FROM detallecompra $whereClause";
    $querydetallecompra = mysqli_query($con, $sqldetallecompra);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM detallefactura WHERE Codigo_Det_Compra = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar el detalle de compra: " . mysqli_error($con);
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
    <title>MOSTRAR EL DETALLE DE COMPRA</title>
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

       <th> <button onclick="window.location.href='FinsertarDetallecompra.php'"> Insertar Detalle de Compra </button> </th>
    <h1>TABLA DETALLE DE COMPRA</h1>

    <table>

      <thead>
        <tr>

          <th>Detalle de la compra</th>
          <th>Compra</th>
          <th>ID del producto</th>
          <th>ID bodega</th>
          <th>Cantidad </th>
          <th>Valor unitario</th>
          <th>Descuento de la compra</th>
          <th>Sub total</th>
          <th>IVA</th>
          <th>Valor total </th>
      
        </tr>
      </thead>



      <tbody>

       
        <?php
          while ($row = mysqli_fetch_array($querydetallecompra)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Det_Compra']; ?></td>
                <td><?php echo $row['Codigo_Compra']; ?></td>
                <td><?php echo $row['Codigo_Producto']; ?></td>
                <td><?php echo $row['Codigo_Bodega']; ?></td>
                <td><?php echo $row['Cantidad_Det_Compra']; ?></td>
                <td><?php echo $row['Valor_Unitario_Det_Compra']; ?></td>
                <td><?php echo $row['Descuento_Det_Compra']; ?></td>
                <td><?php echo $row['Sub_Total_Det_Compra']; ?></td>
                 <td><?php echo $row['IVA_Det_Compra']; ?></td>
                  <td><?php echo $row['Valor_Total_Det_Compra']; ?></td>
             }
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Det_Compra']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>