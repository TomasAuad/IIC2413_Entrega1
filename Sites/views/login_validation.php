<?php
	ob_start();
	session_start();
    require("../config/conection.php");
?>

<?php
    $usuario = $_POST['username'];
    $clave = $_POST['password'];

    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
    {
        $query_login = "SELECT * FROM usuarios WHERE username='$usuario' and contrasena='$clave'";
        $result1 = $db -> prepare($query_login);
        $result1 -> execute();
        
        $resultado = $result1 -> fetchAll();
        
        //$usuarios = $result2 -> fetchColumn();
        //$cantidad = $usuarios -> rowCount();
        

        if (count($resultado)>0){
        
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['tipo'] = $resultado[0][3];
            
        $msg = "Sesión iniciada correctamente";
        if ($_SESSION['tipo'] == 'Pasajero'){
            header("Location: ../views/pasajero.php");
        }
        elseif($_SESSION['tipo'] == 'Aerolinea'){
            header("Location: ../views/aerolinea.php");
        }
        elseif($_SESSION['tipo'] == 'DGAC'){
            header("Location: ../views/DGAC.php");
        }
        
        }
        else{
            echo"Datos incorrectos!";
        }
    }
?>