<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $nombre_compania = $_POST["nombre_compania"];
  $nombre_compania = strtolower($nombre_compania);
  $id_icao_llegada = $_POST["icao_llegada"];
  $id_icao_llegada = strtolower($id_icao_llegada);

 	$query = "SELECT  distinct vuelo_id
   FROM vuelo, compania, aerodromo
   WHERE aerodromo_llegada_id = (select aerodromo.aerodromo_id from aerodromo where aerodromo.codigo_ICAO = '$id_icao_llegada' LIMIT 1)
   and aerodromo.aerodromo_id = vuelo.aerodromo_llegada_id
   AND compania.codigo_compania = (select compania.codigo_compania from compania where compania.nombre_compania = '$nombre_compania' LIMIT 1)
   AND vuelo.codigo_compania = compania.codigo_compania

   and vuelo.estado = 'aceptado';";
	$result = $db -> prepare($query);
	$result -> execute();
	$vuelos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      
    </tr>
  <?php

  
  
	foreach ($vuelos as $vuelo) {
  		echo "<tr><td>$vuelo[0]</td></tr>";
      
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
