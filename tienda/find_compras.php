<?php
session_start();
include('../shield/acceso_db.php');
if(isset($_SESSION['usuario_nombre'])) {
?>
<head> 
<title>Reporte de Compras</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript" src="./calendario/calendar.js"></script>
</head> 
<?php 
include("../lib/lib_formato.php");

if (!isset($_GET['fecha_min']) || !isset($_GET['fecha_max'])) {
    $fechamin=date("Y-m-01");
    $fechamax=date("Y-m-d");
} else {
    $fechamin=$_GET['fecha_min'];
    $fechamax=$_GET['fecha_max'];
}
?> 
<?=body_container_ini("","770","0")?>
<table align="center" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font size="2" color="5E8CB5"><b>REPORTE DE COMPRAS</font></td>
<td align="right" width="10%">
<form method="post" action="../index.php">
<input type="submit" name="enviar" value="<< INICIO" class="boton">
</form>
</td>
</tr>
</table>
<br><br><br><br><br>
<?=container_mensaje2_ini(); ?>
<FORM name="form2" ACTION="../tienda/reporte_compras.php" method="get"> 
<TABLE border="0" cellpadding="1" cellspacing="2" width="100%">
<tr>
   <td colspan="2" bgcolor="#ffffff" align="center"><font size="4" color="#5e8cb5"><B>Generar informe de Compras</td>
</TR> 
<tr>
   <td colspan="2" bgcolor="#ebf3f7" align="center">&nbsp;</td>
</TR> 
<TR> 
   <TD style="text-align: center"><b><font size="2" color="#5e8cb5">Desde el dia: <INPUT TYPE="text" NAME="fecha_min" SIZE="10" MAXLENGTH="10" value="<?php echo $fechamin; ?>"> <img src="../img/b_calendar.png" onClick='showCalendar(this, form2.fecha_min, "yyyy-mm-dd","es",1)' title="Calendario"></td>
</tr>
<tr>
   <TD style="text-align: center"><b><font size="2" color="#5e8cb5">Hasta el dia: <INPUT TYPE="text" NAME="fecha_max" SIZE="10" MAXLENGTH="10" value="<?php echo $fechamax; ?>"> <img src="../img/b_calendar.png" onClick='showCalendar(this, form2.fecha_max, "yyyy-mm-dd","es",1)' title="Calendario"></td>
</tr>
<tr>
   <td colspan="2" bgcolor="#ebf3f7" align="center">&nbsp;</td>
</TR> 
</TABLE>
<table>
<tr>
   <td align="center"><input type="submit" value="Aceptar" class="boton"> <a href="../index.php" type="button" class="boton" style="padding: 2px; border: 2px solid #000000; text-decoration: none">Cancelar</a>
   </form>
</TR> 
</table>
</form>
<?=container_mensaje2_fin(); ?>
<br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>
<?php
} else {
    include "../shield/acceso.php";
}
?> 