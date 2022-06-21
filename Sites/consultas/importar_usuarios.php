<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");
  require_once "../consultas/contrasenas.php";
	

 	
  $crear_tabla_usuarios = "CREATE TABLE IF NOT EXISTS Usuarios (
    id serial PRIMARY KEY,
    username varchar UNIQUE NOT NULL,
    contrasena varchar NOT NULL,
    tipo varchar NOT NULL
    
    )";
    $result = $db -> prepare($crear_tabla_usuarios);
    $result -> execute();

    $query_pasajeros = "SELECT nombre_pasajero, pasaporte_pasajero FROM pasajero";
    $result1 = $db -> prepare($query_pasajeros);
    $result1 -> execute();
    $lista_pasajeros = $result1 -> fetchAll();

    $query_aerolineas = "SELECT codigo_compania FROM compania";
    $result2 = $db -> prepare($query_aerolineas);
    $result2 -> execute();
    $lista_aerolineas = $result2 -> fetchAll();
   
  ?>

	<table>
    <tr>
      <th>Codigo Aerolinea</th>
      <th>Contraseña</th>
      <th>Tipo Usuario</th>
      
    </tr>
  <?php
  
	foreach ($lista_pasajeros as $dato) {
      $dato[2] = crear_contrasena_usuario($dato[0], $dato[1]);
      $dato[3] = 'Pasajero';
      $insertar_dato = "INSERT INTO Usuarios (username, contrasena, tipo) 
        VALUES ('$dato[1]', '$dato[2]', '$dato[3]') ON CONFLICT (username) DO NOTHING;";
      $result3 = $db -> prepare($insertar_dato);
      $result3 -> execute();
  		

	}
  foreach ($lista_aerolineas as $aerolinea) {
    $aerolinea[1] = crear_contrasena_aerolinea();
    $aerolinea[2] = 'Aerolinea';
    $insertar_dato = "INSERT INTO Usuarios (username, contrasena, tipo) 
      VALUES ('$aerolinea[0]', '$aerolinea[1]', '$aerolinea[2]') ON CONFLICT (username) DO NOTHING;";
    $result4 = $db -> prepare($insertar_dato);
    $result4 -> execute();
    
  $insertar_dato = "INSERT INTO Usuarios (username, contrasena, tipo) 
  VALUES ('DGAC', 'admin', 'DGAC') ON CONFLICT (username) DO NOTHING;";
  $result5 = $db -> prepare($insertar_dato);
  $result5 -> execute();
}
  ?>
	</table>

<?php echo"importacion exitosa";
include('../templates/footer.html'); ?>
