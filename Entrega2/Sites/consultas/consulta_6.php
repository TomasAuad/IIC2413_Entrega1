<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	

 	$query = "SELECT tabla1.nombre_compania, cast((cast(tabla1.aceptados as decimal) / cast(tabla2.totales as decimal))*100 as integer) as porcentaje
   FROM (
       SELECT compania.nombre_compania, count(vuelo_id) as aceptados
       FROM vuelo, compania
       WHERE vuelo.estado = 'aceptado'
       and vuelo.codigo_compania = compania.codigo_compania
       GROUP BY nombre_compania
   ) as tabla1, (
       SELECT nombre_compania, count(vuelo_id) as totales
       FROM vuelo, compania
       WHERE vuelo.codigo_compania = compania.codigo_compania
       GROUP BY nombre_compania
   ) as tabla2
   WHERE tabla1.nombre_compania = tabla2.nombre_compania
   order by porcentaje desc
   FETCH FIRST 1 ROWS ONLY;";
	$result = $db -> prepare($query);
	$result -> execute();
	$aerolinea_aceptados = $result -> fetchAll();
  ?>

<table>
    <tr>
      <th>Nombre Aerolinea</th>
      <th>Porcentaje vuelos aceptados</th>
      
    </tr>
  
      <?php
        // echo $pokemones;
        foreach ($aerolinea_aceptados as $ac) {
          echo "<tr><td>$ac[0]</td><td>$ac[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
