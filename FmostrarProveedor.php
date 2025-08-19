<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqlproveedor = "SELECT * FROM proveedor $whereClause";
    $queryproveedor = mysqli_query($con, $sqlproveedor);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM proveedor WHERE Codigo_Proveedor = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar el proveedor: " . mysqli_error($con);
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
    <title>MOSTRAR PROVEEDOR</title>

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

       <th> <button onclick="window.location.href='FinsertarProveedor.php'"> Insertar datos del Proveedor </button> </th>
    <h1>TABLA PROVEEDOR</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo</th>
          <th>Razon social</th>
          <th>Direccion</th>
          <th>Telefono</th>
          <th>Email </th>
          
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($queryproveedor)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Proveedor']; ?></td>
                <td><?php echo $row['Razon_Social_Proveedor']; ?></td>
                <td><?php echo $row['Direccion_Proveedor']; ?></td>
                <td><?php echo $row['Telefono_Proveedor']; ?></td>
                <td><?php echo $row['Email_Proveedor']; ?></td>
                
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Proveedor']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>