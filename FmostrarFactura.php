<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqlfactura = "SELECT * FROM factura $whereClause";
    $queryfactura = mysqli_query($con, $sqlfactura);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM factura WHERE Codigo_Factura = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar la factura: " . mysqli_error($con);
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
    <title>MOSTRAR El DETALLE DE FACTURA</title>
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

      <th> <button onclick="window.location.href='FinsertarFactura.php'"> Insertar la Factura </button> </th>
    <h1>TABLA DE FACTURA</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo  </th>
          <th>Cedula</th>
          <th>Fecha de factura</th>
          <th>Pago</th>
          
      
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($queryfactura)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Factura']; ?></td>
                <td><?php echo $row['Cedula_Cliente']; ?></td>
                <td><?php echo $row['Fecha_Factura']; ?></td>
                <td><?php echo $row['Codigo_Pago']; ?></td>
               
               
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