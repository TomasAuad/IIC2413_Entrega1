<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	

 	$query = "WITH grouped as (SELECT comprador.nombre_comprador as nombre_comprador, compania.nombre_compania as nombre_compania, count(*) as countX,
    count(*) OVER (PARTITION BY compania.nombre_compania) AS cat_cnt,
    ROW_NUMBER() OVER (PARTITION BY compania.nombre_compania ORDER BY COUNT(*) DESC) AS rn
    FROM compania, ticket as t1 , comprador, vuelo
    WHERE t1.vuelo_id = vuelo.vuelo_id
    AND compania.codigo_compania = vuelo.codigo_compania
    AND t1.pasaporte_comprador = comprador.pasaporte_comprador
    
    GROUP BY comprador.nombre_comprador, compania.nombre_compania
    ORDER BY countX DESC
    )
    SELECT nombre_comprador, nombre_compania, countX
    FROM grouped
    WHERE cat_cnt >= 1
      AND rn = 1
      
    ;";
	$result = $db -> prepare($query);
	$result -> execute();
	$mejores_compradores = $result -> fetchAll();
  ?>

<table>
    <tr>
      <th>Nombre comprador</th>
      <th>Nombre compania</th>
      <th>Numero tickets</th>
    </tr>
  
      <?php
        // echo $pokemones;
        foreach ($mejores_compradores as $mc) {
          echo "<tr><td>$mc[0]</td><td>$mc[1]</td><td>$mc[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
