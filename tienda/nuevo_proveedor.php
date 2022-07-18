<head>
<title>CREAR NUEVO PROVEEDOR</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head> 
<?php
include("../lib/conexion.php");
include("../lib/lib_consulta.php");
include("../lib/lib_formato.php");

$link=Conectarse("carioca"); 
$result=mysqli_query($link,"SELECT max(cod_pro) AS elmax FROM proveedor");
$last_id_inv=mysqli_fetch_array($result);
$cod_pro=$last_id_inv[0] + 1;

?>
<?=body_container_ini("","770","0")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>NUEVO PROVEEDOR</b></font></td>
<td align="right" width="15%">
<form method="post" action="showall_proveedores.php">
<input type="submit" name="enviar" value="Volver a lista proveedores" class="boton">
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
<td bgcolor="#5E8CB5" width="33%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>DATOS PROVEEDOR</td>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#e1e4f2">
<br>
<br>
<!-- form inicio -->
<FORM ACTION="chk_nuevo_proveedor.php" method="get"> 
<TABLE border="0" align="center" cellpadding="1" cellspacing="2" width="90%"> 
<TR> 
   <TD bgcolor="#FFFFFF" width="30%"><B><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="cod_pro" SIZE="15" MAXLENGTH="10" value="<?php echo"$cod_pro"; ?>"></TD>
</TR>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">NOMBRE PROVEEDOR:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="nom_pro" SIZE="40" MAXLENGTH="50"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CONTACTO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="contacto_sec" SIZE="40" MAXLENGTH="50"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">DIRECCION:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="dire_pro" SIZE="40" MAXLENGTH="50"></TD> 
</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CIUDAD:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="ciudad_pro" SIZE="40" MAXLENGTH="40"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">TELEFONO:</TD> 
   <TD><INPUT TYPE="text" NAME="tel_pro" SIZE="15" MAXLENGTH="20"></TD> 
</TR>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">TELEFONO SEC:</TD> 
   <TD><INPUT TYPE="text" NAME="tel_sec" SIZE="15" MAXLENGTH="20"></TD> 
</TR>
<TR>
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">E-MAIL:</TD> 
   <TD><INPUT TYPE="text" NAME="email_pro" SIZE="40" MAXLENGTH="40"></TD> 

</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#ffffff" valign="top"><b><font size="2" color="#5e8cb5">MAS INFORMACION:</TD> 
   <TD colspan="2"><TEXTAREA COLS=30 ROWS=5 NAME="desc_pro">Ninguna...</TEXTAREA> </TD> 
</TR> 
</TABLE>
<!-- form fin -->
<br>
<br> 
<table align="center">
<TR >
	<TD align="center"><INPUT TYPE="submit" NAME="accion" VALUE="Guardar" class="boton"> </TD>
	</form>
	<td width="10%">&nbsp;</td>
	<form action="showall_proveedores.php" method="post">
	<TD align="center"><INPUT TYPE="submit" NAME="accion" VALUE="Cancelar" class="boton"> </TD>
	</form>
</TR>
</table>
<br>
</td>
</tr>
</table>
<br><br><br><br><br>
<?=body_container_fin()?>