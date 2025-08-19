<?php
  include("connection/connection.php");
  $con = connection();
    $whereClause = "";

    
    
    //Mostrar Producto
  $sqlcategoria = "SELECT * FROM categoria $whereClause";
    $querycategoria = mysqli_query($con, $sqlcategoria);

     //Eliminar Producto
    if (isset($_GET['eliminar'])) {
      $idEliminar = $_GET['eliminar'];
      $sqlEliminar = "DELETE FROM categoria WHERE Codigo_Categoria = ?";
      $stmt = mysqli_prepare($con, $sqlEliminar);
      mysqli_stmt_bind_param($stmt, "s", $idEliminar);
      if (mysqli_stmt_execute($stmt)) {
        // No mostrar mensaje aquí
      } else {
        echo "Error al eliminar la categoria: " . mysqli_error($con);
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
    <title>MOSTRAR CATEGORIA</title>
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

      
      <th> <button onclick="window.location.href='FinsertarCategoria.php'"> Insertar datos de la Categoria </button> </th>
    <h1>TABLA CATEGORIA</h1>

    <table>

      <thead>
        <tr>

          <th>Codigo</th>
          <th>Nombre Categoria</th>
          
  
      
        </tr>
      </thead>



      <tbody>

        <?php
          while ($row = mysqli_fetch_array($querycategoria)) {
          ?>

        <tr>
                <td><?php echo $row['Codigo_Categoria']; ?></td>
                <td><?php echo $row['Nombre_Categoria']; ?></td>
            
               
          </td>
          <td>

              <a href="?eliminar=<?php echo $row['Codigo_Categoria']; ?>">Eliminar</a></td>

        </tr>
        <?php
           }
          ?>

    




      </tbody>


             </table>
        </body>

</html>