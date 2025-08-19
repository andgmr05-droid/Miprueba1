<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqlbodega = "SELECT * FROM bodega $whereClause";
    $querybodega = mysqli_query($con, $sqlbodega);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM bodega WHERE Codigo_Bodega = ?";
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
    <title>MOSTRAR BODEGA</title>

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

      <th> <button onclick="window.location.href='FinsertarBodega.php'"> Insertar datos de Bodega </button> </th>
    <h1>TABLA BODEGA</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo</th>
          <th>Nombre</th>
          <th>Direccion</th>
          <th>Telefono</th>
  
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($querybodega)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Bodega']; ?></td>
                <td><?php echo $row['Nombre_Bodega']; ?></td>
                <td><?php echo $row['Direccion_Bodega']; ?></td>
                <td><?php echo $row['Telefono_Bodega']; ?></td>
               
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Bodega']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>