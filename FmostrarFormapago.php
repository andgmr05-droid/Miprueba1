<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqlformapago = "SELECT * FROM formapago $whereClause";
    $queryformapago = mysqli_query($con, $sqlformapago);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM formapago WHERE Codigo_Pago = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar el pago: " . mysqli_error($con);
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
    <title>MOSTRAR LA FORMA DE PAGO</title>
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

       <th> <button onclick="window.location.href='FinsertarFormaPago.php'"> Insertar la forma de pago</button></th>
    <h1>TABLA FORMA DE PAGO</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo  </th>
          <th>Forma de Pago</th>
          
         
      
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($queryformapago)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Pago']; ?></td>
                <td><?php echo $row['Forma_Pago']; ?></td>
            
             
               
          </td>
          <td>
<a href="?eliminar=<?php echo $row['Codigo_Pago']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>