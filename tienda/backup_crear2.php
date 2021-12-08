<html>
<head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>
<?php
include("../lib/lib_formato.php");
include("../lib/conexion.php");
$id=$_GET['dbname'];
$fecha_back=date("20y-m-d");

$dbname="carioca";
$dbhost = 'localhost';  // Servidor base de datos
$dbuname = '';          // Usuario base de datos
$dbpass = '';           // Contraseña base de datos
$fecha=time();          // Fecha actual
$llamada='"C:\wamp\mysql\bin\mysqldump.exe"';
$salida='a://';

if(!$id){
$filename="carioca";
    $archivo=$filename.'-20'.gmstrftime("%y-%m-%d",$fecha).'.sql';// Formato de la fecha para dar nombre al fichero
    passthru("$llamada --host=$dbhost --user=$dbuname --password=$dbpass --opt --quick $dbname > $salida$archivo");
}else{
$filename=$id;
    $archivo=$filename.'.sql';// Formato de la fecha para dar nombre al fichero
    passthru("$llamada --host=$dbhost --user=$dbuname --password=$dbpass --opt --quick $dbname > $salida$archivo");
}


//	$dbname="carioca";

//    echo $salida.$archivo;
?>
<?=body_container_ini("","770","0")?>
<br><br><br><br>
<?php
	container_mensaje("Se creó la copia de respaldo de $dbname<br>
					   con el nombre: $archivo<br>
        	           en la ruta: $salida");
?>
<br>
  <table align=center>
   <tr>
    <td>
	   <form action="../index.php">
       <input type="submit" name="enviar" value="Continuar" class="boton">
       </form></center>
	</td>
   </tr>
   </table>
<br><br><br><br><br><br><br><br><br><br><br>
<?php
body_container_fin();
?>