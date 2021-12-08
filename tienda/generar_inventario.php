<html> 
<head> 
<title>Inventario Fisico</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script language="JavaScript" src="calendario/javascripts.js"></script>
<script> 
function uno(src,color_entrada) { 
    src.bgColor=color_entrada;src.style.cursor="";
} 
function dos(src,color_default) { 
    src.bgColor=color_default;src.style.cursor="default"; 
} 
</script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");

$link=Conectarse("carioca");
$id_inv = $_GET['id_inv'];
$fecha_lev = $_GET['fecha_lev'];
$descripcion = $_GET['descripcion'];
$numreg=$_GET['total'];
$total=$numreg;

$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");


$limit=0;

   for($i=0;$i<$numreg;$i++){
   $tmp="id$i";
   $cod=$_GET[$tmp];
     if($cod!=""){
      $arr_cod[]=$cod;
	  $limit=$limit+1;
     }else {}
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT nom_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_item[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT unid_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_unid[]=$row[0];
   }

?> 
<?=body_container_ini("","770","0")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>INVENTARIO FISICO > Generar Inventario</b></font></td>
<td align="right" width="10%">
<form method="post" action="nuevo_inventario.php">
<input type="button" value="<< ATRAS" onClick="history.go(-1)" class="boton">
</form>
</td>
<td align="right" width="10%">
<form method="post" action="../index.php">
<input type="submit" name="enviar" value="INICIO" class="boton">
</form>
</td>
</tr>
</table>
<br><br><br>
<table width="25%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<td bgcolor="#5E8CB5" width="33%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>INVENTARIO FISICO</td>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="e1e4f2">
<br>
<form method="get" name="inventario" action="chk_inventario.php">
<br>
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="id_inv" SIZE="10" MAXLENGTH="10" value="<? echo"$id_inv"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA LEVANTAMIENTO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_lev" SIZE="10" MAXLENGTH="10" value="<? echo"$fecha_lev"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">DESCRIPCION:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="descripcion" SIZE="40" MAXLENGTH="40" value="<? echo"$descripcion"; ?>" readonly></td>
</TR> 

</TABLE>
<br>
<!-- inicio -->
<?php
/////////////////////////////////////////ini/////////////////////////////////////////

   if (!$total){
   echo"
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td><font size=2 color=ffffff><b>NO EXISTE NINGUN REGISTRO</font></td></tr>
   </table>
   ";
   }
   else{
	   echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=ROWs frame=hsides bordercolor=#c1cdd8>
            <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>CODIGO</a></font></td>";	 
	   echo"<td align=left width=55%><font color=FFFFFF size=2><b>ITEM</a></font></td>";	 
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>UNIDAD</a></font></td>";	 
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>EXISTENCIA</a></font></td>";	 	   	   
	   echo"</tr>";
	   $c=0;

	   for($c=0;$c<$limit;$c++){
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_cod[$c] <INPUT TYPE=hidden NAME=cod$c VALUE=$arr_cod[$c]></font></td>";		 
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_item[$c]</font></td>";		 
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_unid[$c]</font></td>";		 
	     echo"<td><INPUT TYPE=text NAME=cant$c SIZE=15 MAXLENGTH=10 value=0.00 align=right></td>";
   	     echo"</tr>";
	   }
       mysql_close($link);
       echo"</table><br>";
echo"
<INPUT TYPE=hidden NAME=id_inv VALUE=$id_inv>
<INPUT TYPE=hidden NAME=fecha_lev VALUE=$fecha_lev>
<INPUT TYPE=hidden NAME=descripcion VALUE='$descripcion'>
<INPUT TYPE=hidden NAME=numreg VALUE=$limit>
";

echo"<center><INPUT TYPE=submit NAME=accion VALUE=Guardar class=boton></center>";
echo"</form>";

/*echo"<form method=get name=inventario action=showall_inventarios.php>";
echo"<INPUT TYPE=submit NAME=accion VALUE=Cancelar class=boton>";
echo"</form>";*/
echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
echo"</font></center>";  

   }

//////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<!-- fin -->
<br>
<br>
</td>
</tr>
</table>
<br><br><br><br>
<?=body_container_fin()?>