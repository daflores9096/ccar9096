<html> 
<head> 
<title>FICHA ARTICULO</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head> 
<?php
include("../lib/conexion.php"); 
include("../lib/lib_formato.php");
$link=Conectarse("carioca");
$indcom=$_GET['cod_item'];
$result=mysql_query("SELECT * FROM item WHERE cod_item='$indcom'",$link);
$row=mysql_fetch_array($result);
$numcam=mysql_num_fields($result);
$field=mysql_field_name($result,0);
?>
<?=body_container_ini("","770","550")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%" align="left"><font color="#5E8CB5" size="2"><b>FICHA ARTICULO</b></font></td>
<td align="right" width="15%">
<form method="post" action="showall_item.php">
<input type="submit" name="enviar" value="<< ATRAS" class="boton">
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
<table width="50%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<?php
    echo"<td bgcolor='#5E8CB5' width='20%'><font color='ffffff' size='2' face='Courier New, Courier, mono'><b>GENERAL</td>";
    echo"<td width='20%'><A href='mod_item.php?cod_item=$indcom' class='linktab'>MODIFICAR</A></td>";
    echo"<td width='20%'><A href='ver_movimiento_item.php?cod_item=$indcom' class='linktab'>MOVIMIENTO</A></td>";
?>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr bgcolor="#5E8CB5">
<td></td>
</tr>

<tr>
<td bgcolor="e1e4f2">
<br>
<? echo"<center><font size=6 color=#5e8cb5><b> ($row[0]) $row[1] </b></font></center>"?>
<br><br>

<!-- form inicio -->
<FORM ACTION="editar_ficha_item.php" method="get"> 

<TABLE border="0" align="center" cellpadding="1" cellspacing="2" width="90%"> 
<TR> 
   <TD bgcolor="#FFFFFF" width="30%"><B><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="cod_item" SIZE="15" MAXLENGTH="10" <? echo"value=$row[0]" ?> readonly></TD> 
</TR>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">NOMBRE ARTICULO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="nom_item" SIZE="40" MAXLENGTH="30" <? echo"value='$row[1]'" ?> readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">UNIDAD:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="unid_item" SIZE="15" MAXLENGTH="20" <? echo"value=$row[2]" ?> readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">PRECIO:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="precio_item" SIZE="15" MAXLENGTH="10" <? echo"value=$row[3]" ?> align="right" readonly></TD> 
</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">EXISTENCIA ACTUAL:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="existencia" SIZE="15" MAXLENGTH="10" <? echo"value=$row[5]" ?> align="right" readonly></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Existencia Maxima:</TD> 
   <TD><INPUT TYPE="text" NAME="exi_max" SIZE="15" MAXLENGTH="10" <? echo"value=$row[4]" ?> align="right" readonly></TD> 
</TR>
<TR>
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Existencia Minima:</TD> 
   <TD><INPUT TYPE="text" NAME="exi_min" SIZE="15" MAXLENGTH="10" <? echo"value=$row[6]" ?> align="right" readonly></TD> 

</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#ffffff" valign="top"><b><font size="2" color="#5e8cb5">DESCRIPCION:</TD> 
   <TD colspan="2"><TEXTAREA COLS=30 ROWS=5 NAME="deta_item" readonly><? echo"$row[7]" ?></TEXTAREA> </TD> 
</TR> 
</TABLE>
<!-- form fin -->
<br>
<br> 
<br>
</td>
</tr>

<tr bgcolor="#5E8CB5">
<td></td>
</tr>
</table>
<br><br><br><br><br>
<?=body_container_fin()?>