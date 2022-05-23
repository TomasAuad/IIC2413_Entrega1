<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $reserva = $_POST["codigo_reserva"];
  $reserva = strtolower($reserva);


  #Se construye la consulta como un string
 	$query = " SELECT ticket.numero_ticket, pasajero.nombre_pasajero, costo.valor
   FROM ticket, pasajero, aeronave, vuelo, costo
   WHERE ticket.codigo_reserva = '$reserva'
   AND ticket.pasaporte_pasajero = pasajero.pasaporte_pasajero
   AND ticket.vuelo_id = vuelo.vuelo_id
   AND vuelo.codigo_aeronave = aeronave.codigo_aeronave
   AND vuelo.ruta_id = costo.ruta_id
   AND aeronave.pero = costo.peso;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$reservas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>TICKET</th>
      <th>PASAJERO</th>
      <th>COSTO</th>
    </tr>
  
      <?php
      
        // echo $pokemones;
        foreach ($reservas as $reserva) {
          echo "<tr><td>$reserva[0]</td><td>$reserva[1]</td><td>$reserva[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
