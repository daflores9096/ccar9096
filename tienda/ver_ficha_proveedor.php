<html> 
<head> 
<title>PROVEEDORES</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head> 
<?php
include("../lib/conexion.php");
include("../lib/lib_consulta.php");
include("../lib/lib_formato.php");
$link=Conectarse("carioca"); 
$cod_pro=$_GET['cod_pro'];
$result=mysql_query("SELECT * FROM proveedor WHERE cod_pro='$cod_pro'",$link);
$row=mysql_fetch_array($result);
?>
<?=body_container_ini("","770","0")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>PROVEEDORES > Ficha Proveedor</b></font></td>
<td align="right" width="15%">
<form method="post" action="showall_proveedores.php">
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
<table width="30%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<?php
    echo"<td bgcolor='#5E8CB5' width='50%'><font color='ffffff' size='2' face='Courier New, Courier, mono'><b>INFO GENERAL</td>";
    echo"<td width='50%' bgcolor='#FFFFFF'><A href='modificar_datos_proveedor.php?cod_pro=$cod_pro' class='linktab2' title=''>MODIFICAR</A></td>";
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
<br>
<!-- form inicio -->
<FORM ACTION="mod_proveedor.php" method="get"> 
<TABLE border="0" align="center" cellpadding="1" cellspacing="2" width="90%"> 
<TR> 
   <TD bgcolor="#FFFFFF" width="30%"><B><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="cod_pro" SIZE="15" MAXLENGTH="10" value="<? echo"$cod_pro"; ?>" readonly></TD> 
</TR>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">NOMBRE PROVEEDOR:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="nom_pro" SIZE="40" MAXLENGTH="50" value="<? echo"$row[1]"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CONTACTO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="contacto_sec" SIZE="40" MAXLENGTH="50" value="<? echo"$row[2]"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">DIRECCION:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="dire_pro" SIZE="40" MAXLENGTH="50" value="<? echo"$row[3]"; ?>" readonly></TD> 
</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CIUDAD:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="ciudad_pro" SIZE="40" MAXLENGTH="40" value="<? echo"$row[4]"; ?>" readonly></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">TELEFONO:</TD> 
   <TD><INPUT TYPE="text" NAME="tel_pro" SIZE="15" MAXLENGTH="20" value="<? echo"$row[5]"; ?>" readonly></TD> 
</TR>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">TELEFONO SEC:</TD> 
   <TD><INPUT TYPE="text" NAME="tel_sec" SIZE="15" MAXLENGTH="20" value="<? echo"$row[6]"; ?>" readonly></TD> 
</TR>
<TR>
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">E-MAIL:</TD> 
   <TD><INPUT TYPE="text" NAME="email_pro" SIZE="40" MAXLENGTH="40" value="<? echo"$row[7]"; ?>" readonly></TD> 

</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF" valign="top"><b><font size="2" color="#5e8cb5">MAS INFORMACION:</TD> 
   <TD colspan="2"><TEXTAREA COLS=30 ROWS=5 NAME="desc_pro" readonly><? echo"$row[8]"; ?></TEXTAREA> </TD> 
</TR> 
</TABLE>
<!-- form fin -->
<br>
<br> 
<br>
</td>
</tr>
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>
</table>
<br><br><br><br><br>
<?=body_container_fin()?>