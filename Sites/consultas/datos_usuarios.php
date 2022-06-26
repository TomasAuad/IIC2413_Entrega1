<?php
	session_start();
	
?>

<?php include('../templates/header.html');
      require("../config/conection.php"); ?>

<body>
	<h3> DATOS DE USUARIOS </h3>
	<br>
    <?php
    $query = "SELECT * FROM Usuarios"; // Crear la consulta
    $result = $db -> prepare($query);
    $result -> execute();

        $data = $result -> fetchAll();
    ?>

    <table>
        <tr>
            <th> id </th>
            <th> Usuario </th>
            <th> Contraseña </th>
            <th> Tipo </th>
            
        </tr>

        <?php
            foreach ($data as $d) {
                echo "<tr>
                        <td>$d[0]</td>
                        <td>$d[1]</td>
                        <td>$d[2]</td>
                        <td>$d[3]</td>
                        
                      </tr>";
            }
        ?>

    </table>

</body>
<?php include('../templates/footer.html'); ?>