<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $nombre_compania = $_POST["aerolinea"];
  $nombre_compania = strtolower($nombre_compania);



 	$query = "SELECT vuelo.estado, count(estado)
   FROM vuelo, compania
   WHERE compania.codigo_compania = (SELECT codigo_compania from compania where nombre_compania LIKE '%$nombre_compania%')
   AND vuelo.codigo_compania = compania.codigo_compania
   GROUP BY vuelo.estado";
	$result = $db -> prepare($query);
	$result -> execute();
	$vuelos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ESTADO</th>
      <th>CANTIDAD</th>
    </tr>
  <?php
  echo $nombre_compania;
  
  
	foreach ($vuelos as $vuelo) {
  		echo "<tr><td>$vuelo[0]</td><td>$vuelo[1]</td></tr>";
      
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
