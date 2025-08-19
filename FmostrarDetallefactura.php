<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqldetallefactura = "SELECT * FROM detallefactura $whereClause";
    $querydetallefactura = mysqli_query($con, $sqldetallefactura);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM detallefactura WHERE Codigo_Factura = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar el detalle de factura: " . mysqli_error($con);
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
    <title>MOSTRAR EL DETALLE DE FACTURA</title>
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

      <th> <button onclick="window.location.href='FinsertarDetalleFactura.php'"> Insertar el Detalle de factura </button> </th>
    <h1>TABLA DETALLE DE FACTURA</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo de la factura</th>
          <th>Detalle de la factura</th>
          <th>ID del producto</th>
          <th>ID bodega</th>
          <th>Cantidad </th>
          <th>Descuento</th>
          <th>Sub total de la factura</th>
          <th>IVA</th>
          <th>Valor total </th>
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($querydetallefactura)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Factura']; ?></td>
                <td><?php echo $row['Codigo_Det_Factura']; ?></td>
                <td><?php echo $row['Codigo_Producto']; ?></td>
                <td><?php echo $row['Codigo_Bodega']; ?></td>
                <td><?php echo $row['Cantidad_Det_Factura']; ?></td>
                <td><?php echo $row['Valor_Unitario_Det_Factura']; ?></td>
                <td><?php echo $row['IVA_Det_Factura']; ?></td>
                <td><?php echo $row['Valor_Total_Det_Factura']; ?></td>
             }
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Det_Factura']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>