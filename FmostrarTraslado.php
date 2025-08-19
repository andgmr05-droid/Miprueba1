<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqltraslado = "SELECT * FROM traslado $whereClause";
    $querytraslado = mysqli_query($con, $sqltraslado);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM traslado WHERE Codigo_Traslado = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar el traslado: " . mysqli_error($con);
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
    <title>MOSTRAR EL TRASLADO</title>
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

       <th> <button onclick="window.location.href='FinsertarTraslado.php'"> Insertar el Traslado</button></th>
    <h1>TABLA DE TRASLADO</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo  </th>
          <th>Fecha de traslado</th>
       
          
         
      
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($querytraslado)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Traslado']; ?></td>
                <td><?php echo $row['Fecha_Traslado']; ?></td>
            
             
               
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Traslado']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>