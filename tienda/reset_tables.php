<?php
session_start();
include('shield/acceso_db.php');
if(isset($_SESSION['usuario_nombre'])) {
?>
<html>
<head>
<title>Reiniciar tablas</title>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript" src="calendario/calendar.js"></script>
</head>
<?php
include("../lib/lib_formato.php");
?>
<?=body_container_ini("","770","0")?>
<?php
echo"
<br><br><br><br><br>
<center><font size=4 color=#5e8cb5><b>Seleccione las tablas que desea reiniciar</b></font></center>
<br>
<form action=reset.php method=get>
<table align=center width=50% frame=box>
<tr><td colspan=2>&nbsp;</td></tr>
<tr><td colspan=2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=articulos value=si>Articulos
</td></tr>
<tr><td colspan=2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=compras value=si>Compras
</td></tr>
<tr><td colspan=2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=ventas value=si>Ventas
</td></tr>
<tr><td colspan=2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=mov_compras value=si>Movimiento Compras
</td></tr>
<tr><td colspan=2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=mov_ventas value=si>Movimiento Ventas
</td></tr>
<tr><td colspan=2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=proveedores value=si>Proveedores
</td></tr>
<tr><td colspan=2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=clientes value=si>Clientes
</td></tr>
<tr><td colspan=2>&nbsp;</td></tr>
<tr><td align=right>
<INPUT TYPE=submit NAME=accion VALUE=Aceptar class=boton>&nbsp;
</td>
</form>
<form action=../index.php method=post>
<td align=left>
&nbsp;<INPUT TYPE=submit NAME=accion VALUE=Cancelar class=boton>
</td></tr>
</form>
<tr><td colspan=2>&nbsp;</td></tr>
</table>
";
?>
<br><br><br><br><br><br><br><br>
<?=body_container_fin()?>
<?php
} else {
    include "../shield/acceso.php";
}
?> 