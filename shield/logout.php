<?php
session_start();
include('acceso_db.php'); // incluimos los datos de acceso a la BD
if(isset($_SESSION['usuario_nombre'])) {
    session_destroy();
    header("Location: ../index.php");
}else {
    echo "Operaci&oacute;n incorrecta.";
}
?> 