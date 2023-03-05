<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>



<?php
  include("conexion.php");
//  paginacion---------------------------------------
$tamano_paginas=3;

  if (isset($_GET["pagina"])){

    if ($_GET["pagina"]==1){
      header("Location:indexInicial.php");

    }else{
      $pagina=$_GET["pagina"];

    }
  }else{
    $pagina=1;
  }

  $empezar_desde=($pagina-1)*$tamano_paginas;

  $sql_total="SELECT * FROM datos_usuarios";

  $resultado=$base->prepare($sql_total);

  $resultado->execute(array());

  $num_filas=$resultado->rowCount();

  $total_paginas=ceil($num_filas/$tamano_paginas);






// paginacion-----------------------------------------

  $conexion=$base->query("SELECT * FROM datos_usuarios LIMIT $empezar_desde,$tamano_paginas");
  $registros=$conexion->fetchAll(PDO::FETCH_OBJ);
?>

<h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>

  <table width="50%" border="0" align="center">
    <tr >
      <td class="primera_fila">Id</td>
      <td class="primera_fila">Nombre</td>
      <td class="primera_fila">Apellido</td>
      <td class="primera_fila">Direccion</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
    </tr> 
  
    <?php
      foreach($registros as $persona):
    ?>

   	<tr>
      <td><?php echo $persona->Id?> </td>
      <td><?php echo $persona->Nombre?></td>
      <td><?php echo $persona->Apellido?></td>
      <td><?php echo $persona->Direccion?></td>
 
      <td class="bot"><a href="borrar.php?Id=<?php echo $persona->Id?>"><input type='button' name='del' id='del' value='Borrar'></a></td>

      <td class='bot'><a href="editarInicial.php?Id=<?php echo $persona->Id?> & nom=<?php echo $persona->Nombre?> & ape=<?php echo $persona->Apellido?> & dir=<?php echo $persona->Direccion?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr>  
    
    <?php
      endforeach;
    ?>

	<tr>
	<td></td>
      <form method="get" action="insertar.php">
        <td><input type='text' name='Nom' size='10' class='centrado'></td>
        <td><input type='text' name='Ape' size='10' class='centrado'></td>
        <td><input type='text' name=' Dir' size='10' class='centrado'></td>
        <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr>    
      </form>
  </table>
<div style="display: flex; text-align:center; justify-content:center;">
  <?php
  	for ($i=1; $i<=$total_paginas; $i++){
      		echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";
          // echo "<a href='index.php?pagina=" . $i . "'>" . $i . "</a>  ";
        }
  
  ?>
</div>
<p>&nbsp;</p>
</body>
</html>