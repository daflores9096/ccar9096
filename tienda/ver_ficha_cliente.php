<head>
<title>CLIENTES - Registro Nuevo cliente</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head> 
<?php
include("../lib/conexion.php");
include("../lib/lib_consulta.php");
include("../lib/lib_formato.php");
$link=Conectarse("carioca"); 
$cod_cli=$_GET['cod_cli'];
$result=mysqli_query($link,"SELECT * FROM cliente WHERE cod_cli='$cod_cli'");
$row=mysqli_fetch_array($result);
?>
<?=body_container_ini("","770","0")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%" align="left"><font color="#5E8CB5" size="2"><b>DETALLE CLIENTE</b></font></td>
<td align="right" width="15%">
<form method="post" action="showall_clientes.php">
<input type="submit" name="enviar" value="Volver a lista clientes" class="boton">
</form>
</td>
<td align="right" width="15%">
<form method="post" action="../index.php">
<input type="submit" name="enviar" value="INICIO" class="boton">
</form>
</td>
</tr>
</table>
<br><br>
<table width="50%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<td bgcolor="#5E8CB5" width="50%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>DATOS CLIENTE</td>
<?php
    echo"<td width='50%' bgcolor='#FFFFFF'><A href='ver_movimiento_cli.php?cod_cli=$cod_cli' class='linktab2' title=''>MOVIMIENTO CLIENTE</A></td>";
?>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#e1e4f2">
<br>
<br>
<!-- form inicio -->
<FORM ACTION="mod_cliente.php" method="get"> 
<TABLE border="0" align="center" cellpadding="1" cellspacing="2" width="90%"> 
<TR> 
   <TD bgcolor="#FFFFFF" width="30%"><B><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="cod_cli" SIZE="15" MAXLENGTH="10" value="<?php echo"$cod_cli"; ?>"></TD>
</TR>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">NOMBRE CLIENTE:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="nom_cli" SIZE="40" MAXLENGTH="50" value="<?php echo"$row[1]"; ?>"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CONTACTO SECUNDARIO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="contacto_sec" SIZE="40" MAXLENGTH="50" value="<?php echo"$row[2]"; ?>"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">DIRECCION:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="dire_cli" SIZE="40" MAXLENGTH="50" value="<?php echo"$row[3]"; ?>"></TD>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">DIRECCION SEC:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="dire_sec" SIZE="40" MAXLENGTH="50" value="<?php echo"$row[4]"; ?>"></TD>
</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CIUDAD:</TD> 
   <TD colspan="2"><INPUT TYPE="text" NAME="ciudad_cli" SIZE="40" MAXLENGTH="40" value="<?php echo"$row[5]"; ?>"></TD>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">TELEFONO:</TD> 
   <TD><INPUT TYPE="text" NAME="tel_cli" SIZE="15" MAXLENGTH="20" value="<?php echo"$row[6]"; ?>"></TD>
</TR>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">TELEFONO SEC:</TD> 
   <TD><INPUT TYPE="text" NAME="tel_sec" SIZE="15" MAXLENGTH="20" value="<?php echo"$row[7]"; ?>"></TD>
</TR>
<TR>
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">E-MAIL:</TD> 
   <TD><INPUT TYPE="text" NAME="email_cli" SIZE="40" MAXLENGTH="40" value="<?php echo"$row[8]"; ?>"></TD>

</TR> 
<TR> 
   <TD colspan="3" align="right"><hr color="FFFFFF"></TD> 
</TR> 
<TR> 
   <TD bgcolor="#ffffff" valign="top"><b><font size="2" color="#5e8cb5">MAS INFORMACION:</TD> 
   <TD colspan="2"><TEXTAREA COLS=30 ROWS=5 NAME="desc_cli"><?php echo"$row[9]"; ?></TEXTAREA> </TD>
</TR> 
</TABLE>
<!-- form fin -->
<br>
<br> 
<table align="center">
	<INPUT TYPE="hidden" NAME="ide" VALUE="<?php echo"$cod_cli"; ?>">
<TR >
	<TD align="center"><INPUT TYPE="submit" NAME="accion" VALUE="Guardar" class="boton"> </TD>
	</form>
	<td width="10%">&nbsp;</td>
	<form action="showall_clientes.php" method="post">
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
