<?php
include("../lib/lib_formato.php");
include("../lib/conexion.php");

$archivo=$archivo_name;
$dbhost = 'localhost';  // Servidor base de datos
$dbuname = '';          // Usuario base de datos
$dbpass = '';           // Contraseña base de datos
$llamada='"C:\wamp\mysql\bin\mysql.exe"';
$salida='a://';
$pos=strpos($archivo,".sql");
if($pos!=0)
{
	$pos=strpos($archivo,"-");
//	$dbname=substr($archivo,0,$pos);
	$dbname="carioca";
	$link = @mysql_connect($dbhost,$dbuname,$dbpass);
	mysql_query("DROP DATABASE $dbname", $link);
	mysql_query("CREATE DATABASE $dbname", $link);
	exec("$llamada $dbname < $salida$archivo");
}
else
	$error="si";
?>
<html>
<head>
<title>Restaurar base de datos</title>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>
<?=body_container_ini("","770","0")?>
<br><br><br><br>
<?php
if($error)
	container_mensaje("El archivo Seleccionado no es Válido");
else
	container_mensaje("Se restauró la copia de respaldo de CARIOCA");
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
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
body_container_fin();
?>