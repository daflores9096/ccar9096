<?php
$host_db = "localhost";
$usuario_db = "root";
$clave_db = "";
$nombre_db = "carioca";
$link = mysqli_connect($host_db, $usuario_db, $clave_db);
mysqli_select_db($link, $nombre_db);
?>
