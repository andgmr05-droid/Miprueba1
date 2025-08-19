<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqlcompra = "SELECT * FROM compra $whereClause";
    $querycompra = mysqli_query($con, $sqlcompra);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM compra WHERE Codigo_Compra = ?";
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
    <title>MOSTRAR COMPRAS</title>
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

             <th>  <button onclick="window.location.href='FinsertarCompra.php'"> Insertar datos de la compra </button> </th>
    <h1>TABLA COMPRAS</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo </th>
          <th>Proveedor </th>
          <th>Fecha de compra</th>
       
  
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($querycompra)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Compra']; ?></td>
                <td><?php echo $row['Codigo_Proveedor']; ?></td>
                <td><?php echo $row['Fecha_Compra']; ?></td>
            
               
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Compra']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>