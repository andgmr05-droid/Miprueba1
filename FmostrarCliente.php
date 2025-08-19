<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Cliente
  $sqlcliente = "SELECT * FROM cliente $whereClause";
    $querycliente = mysqli_query($con, $sqlcliente);

     //Eliminar Cliente
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM cliente WHERE Cedula_Cliente = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar el cliente: " . mysqli_error($con);
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
    <title>MOSTRAR CLIENTES</title>
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

      <th> <button onclick="window.location.href='FinsertarCliente.php'"> Insertar datos del Cliente </button> </th>

      
    <h1>TABLA CLIENTES</h1>


    <table>

      <thead>
        <tr>

          <th>Cedula </th>
          <th>Apellidos </th>
          <th>Nombres </th>
          <th>Telefono</th>
          <th>Direccion</th>
          <th>Fecha Nacimiento</th>
  
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($querycliente)) {
          ?>

        <tr>
                <td><?php echo $row['Cedula_Cliente']; ?></td>
                <td><?php echo $row['Apellidos_Cliente']; ?></td>
                <td><?php echo $row['Nombres_Cliente']; ?></td>
                <td><?php echo $row['Telefono_Cliente']; ?></td>
                <td><?php echo $row['Direccion_Cliente']; ?></td>
                <td><?php echo $row['Fecha_Nac_Cliente']; ?></td>
               
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Cedula_Cliente']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>