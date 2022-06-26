<?php include('../templates/header.html');   ?>
<?php session_start();
    

?>
<body>

<h3> Cambio de contraseña </h3>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");
  require_once "contrasenas.php";
  
  ?>


  <form action="cambiar_clave.php" method = "get">
    
    <h4>Introduzca su antigua contraseña: <input type="password" name="contrasena_vieja"></h4>
    <br>
    <h4>Introduzca su nueva contraseña: <input type="password" name="contrasena_nueva"></h4>
    <br>
    <input type="submit">
  </form> 

  <br>

  <?php

  $usuario = strval($_SESSION['username']);
  if (isset($_GET['contrasena_vieja']))
{
  $c_vieja = strval($_GET["contrasena_vieja"]);
 
}
if (isset($_GET['contrasena_nueva']))
{
  $c_nueva = strval($_GET["contrasena_nueva"]);
 
}
  
  //echo $usuario;
  //echo $c_nueva;
  //echo $c_vieja;

  ?>

  <?php

  $confirmacion_usuario = "SELECT username FROM Usuarios WHERE username = $usuario";
  $result4 = $db -> prepare($confirmacion_usuario);
  $result4 -> execute();

  $contrasena = "SELECT contrasena FROM Usuarios WHERE username = $usuario";
  $result5 = $db -> prepare($contrasena);
  $result5 -> execute();
  $c_lista = $result5 -> fetchAll();

  //echo $c_lista;
  if (isset($_GET['contrasena_vieja']))
  {
  if ($c_lista[0][0] = $c_vieja) {
    $cambio_contrasena = "UPDATE Usuarios SET contrasena = '$c_nueva' WHERE username = '$usuario'";
    $result6 = $db -> prepare($cambio_contrasena);
    $result6 -> execute();
    echo "Modificacion exitosa";
  } else {
    echo "Contraseña invalida";
  }
  }
  ?>
<?php

$query_usuarios = "SELECT username, contrasena FROM Usuarios";
$result1 = $db -> prepare($query_usuarios);
$result1 -> execute();
$lista_usuarios = $result1 -> fetchAll();

?>
<?php
    include("../templates/footer.html");
?>


