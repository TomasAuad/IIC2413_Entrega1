<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">ENTREGA 2 </h1>
  

  <br>

  <h3 align="center"> ¿Quieres saber los vuelos pendientes de ser aprobados por la DGAC?</h3>

  <form align="center" action="consultas/consulta_1.php" method="post">
    
    <input type="submit" value="SI">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar los vuelos aceptados de cierta aerolinea con destino a cierto aerodromo?</h3>
  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT nombre_compania FROM compania;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>
  
    


  <form align="center" action="consultas/consulta_2.php" method="post">
    Seleccinar una compania:
    <select name="nombre_compania">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo '<option value="'.$d[0].'">'.$d[0].'</option>';
        #echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    
    Código ICAO aeródromo destino:
    <input type="text" name="icao_llegada">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>
  <h3 align="center"> ¿Quieres conocer los tickets y costos asociados a un numero de reserva?</h3>

<form align="center" action="consultas/consulta_3.php" method="post">
  Codigo de reserva:
  <input type="text" name="codigo_reserva">
  <br/><br/>
  <input type="submit" value="Buscar">
</form>
<br>
<br>
<br>

<h3 align="center"> ¿Quieres saber el cliente que ha comprado más tickets por aerolínea?</h3>

  <form align="center" action="consultas/consulta_4.php" method="post">
    
    <input type="submit" value="SI">
  </form>
  
  <br>
  <br>
  <br>
  <h3 align="center"> ¿Quieres conocer el numero de vuelos por estado de una aerolínea: ?</h3>

  <form align="center" action="consultas/consulta_5.php" method="post">
    Aerolínea:
    <input type="text" name="aerolinea">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Desea saber cual es la aerolínea con mayor porcentaje de vuelos aceptados?</h3>

  <form align="center" action="consultas/consulta_6.php" method="post">
    
    <input type="submit" value="SI">
  </form>
  <br>
  <br>
  <br>






  

  <br>
  <br>
  <br>
  <br>
</body>
</html>
