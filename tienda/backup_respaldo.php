<?php
session_start();
include('../shield/acceso_db.php');
if(isset($_SESSION['usuario_nombre'])) {
?>
<html>
<head>
<title>Respaldo de base de datos</title>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript" src="calendario/calendar.js"></script>
</head>
<?php
include("../lib/lib_formato.php");
$fecha_back=date("20y-m-d");
?>
<?=body_container_ini("","770","0")?>
<?php
if(isset($restaura)){
echo"<br><br><br><br>";
?>
<?=container_mensaje(" Restaurar base de datos CARIOCA:
<br><br>
<table align=center cellpadding=0 cellspacing=0 width=100%>
	<FORM ENCTYPE='multipart/form-data' ACTION='backup_restaurar.php' METHOD='post'>
<tr>
	<td bgcolor='#ebf3f7'>
	<INPUT type='hidden' name='MAX_FILE_SIZE' value='10000'>
	<INPUT type='file' ACCEPT='text/html' name='archivo' size='55' value='<?php echo $archivo_name;?>'>
	</td>
</tr>
</table>
")?>
<?php
echo"
<br>
<table align=center cellpadding=0 cellspacing=0 width=20%>
<tr>
	<td bgcolor=#ffffff align=center>
	<INPUT TYPE=submit NAME=accion VALUE=Aceptar class=boton>
	</form>
	</td>
	<form action=../index.php method=POST>
	<td bgcolor=#ffffff align=center>
	<INPUT TYPE=submit NAME=accion VALUE=Cancelar class=boton>
	</td>
	</form>
</tr>
</table>
";
}else{
echo"<br><br><br><br>";
?>
<?=container_mensaje("Crear respaldo de CARIOCA en fecha $fecha_back
<br>
<table>
<tr>
	<td>
	<FORM NAME=form1 ACTION='backup_crear.php' METHOD='get'>
	</td>
</tr>
<tr>
<td><B><font size=2 color=#5e8cb5>Nombre: </b></font></td>
<td><INPUT TYPE=text NAME=dbname SIZE=30 MAXLENGTH=30></td>
</tr>
</table>

")?>
<?php 
echo"
<br>
<table align=center cellpadding=0 cellspacing=0 width=20%>
<tr>
<td bgcolor=#ffffff align=center>
<INPUT TYPE=submit NAME=accion VALUE=Aceptar class=boton>
</form>
</td>
<form action=../index.php method=POST>
<td align=center>
<INPUT TYPE=submit NAME=accion VALUE=Cancelar class=boton>
</td>
</form>
</tr>
</table>
";
} ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>
<?php
} else {
    include "../shield/acceso.php";
}
?> 