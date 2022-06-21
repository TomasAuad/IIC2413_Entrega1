<?php session_start();
    if (isset($_SESSION['username'])){
        echo "Bienvenido/a: ";
        echo $_SESSION['username'];
        echo "<br>";
        echo $_SESSION['tipo'];
    }
?>

<?php include('../templates/header.html'); ?>
<body>
    <h1> Pestaña DGAC</h1>
    <br>
    <?php
        if (!isset($_SESSION['username'])) {
    ?>
        <h1> Algo anda mal</h1>
    <?php } else { ?>
        <form align="center" action="../views/logout.php" method="post">
            <input type="submit" value="Cerrar sesión">
        </form>
        <h1> Todo bien</h1>
    <?php } ?>
    
</body>
<?php include('../templates/footer.html'); ?>
</html>