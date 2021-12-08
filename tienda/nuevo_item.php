<html> 
<head> 
<title>Registro Nuevo ITEM</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head> 
<?php
include("../lib/conexion.php");
include("../lib/lib_consulta.php");
include("../lib/lib_formato.php");
$link=Conectarse("carioca"); 
?>
<?=body_container_ini("","770","550")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%" align="left"><font color="#5E8CB5" size="2"><b>CREAR NUEVO ITEM</b></font></td>
<td align="right" width="15%">
<form method="post" action="showall_item.php">
<input type="submit" value="Volver a lista artículos" class="boton">
</form>
</td>
<td align="right" width="15%">
<form method="post" action="../index.php">
<input type="submit" name="enviar" value="INICIO" class="boton">
</form>
</td>
</tr>
</table>
<br><br><br>
<table width="22%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<td bgcolor="#5E8CB5" width="33%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>CREAR NUEVO ITEM</td>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="e1e4f2">
<br>
<!-- form inicio -->
<FORM ACTION="chk_nuevo_item.php" method="get"> 
<TABLE border="0" align="center" cellpadding="1" cellspacing="2" width="90%"> 
<TR> 
   <TD bgcolor="#FFFFFF" width="30%"><B><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="cod_item" SIZE="15" MAXLENGTH="10"></TD> 
</TR>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">NOMBRE ITEM:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="nom_item" SIZE="50" MAXLENGTH="50"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">UNIDAD:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="unid_item" SIZE="15" MAXLENGTH="20"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">PRECIO:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="precio_item" SIZE="15" MAXLENGTH="10" value="0.00" align="right"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CATIDAD POR CAJA:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="caja_item" SIZE="15" MAXLENGTH="10" value="0.00" align="right"></TD> 
</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">EXISTENCIA ACTUAL:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="existencia" SIZE="15" MAXLENGTH="10" value="0.00" align="right"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Existencia Maxima:</TD> 
   <TD><INPUT TYPE="text" NAME="exi_max" SIZE="15" MAXLENGTH="10" value="0.00" align="right"></TD> 
</TR>
<TR>
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Existencia Minima:</TD> 
   <TD><INPUT TYPE="text" NAME="exi_min" SIZE="15" MAXLENGTH="10" value="0.00" align="right"></TD> 

</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#ffffff" valign="top"><b><font size="2" color="#5e8cb5">DESCRIPCION:</TD> 
   <TD colspan="2"><TEXTAREA COLS=30 ROWS=5 NAME="deta_item">Ninguna...</TEXTAREA> </TD> 
</TR> 
</TABLE>
<!-- form fin -->
<br> 
<table align="center">
<TR >
	<TD align="center"><INPUT TYPE="submit" NAME="accion" VALUE="Guardar" class="boton"> </TD>
	</form>
	<td width="10%">&nbsp;</td>
<!-- 
	<form action="showallins.php" method="post">
	<TD align="center"><INPUT TYPE="submit" NAME="accion" VALUE="Cancelar" class="boton"> </TD>
	</form>
 -->
</TR>
</table>
<br>
</td>
</tr>
</table>
<br><br><br><br><br>
<?=body_container_fin()?>