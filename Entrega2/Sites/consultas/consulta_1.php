<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	

 	$query = "SELECT vuelo_id, codigo_vuelo FROM vuelo WHERE estado = 'pendiente'";
	$result = $db -> prepare($query);
	$result -> execute();
	$pendientes = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Codigo</th>
      
    </tr>
  <?php
	foreach ($pendientes as $dato) {
  		echo "<tr> <td>$dato[0]</td> <td>$dato[1]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
