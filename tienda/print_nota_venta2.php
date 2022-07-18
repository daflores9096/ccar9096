<html> 
<head> 
<title>IMPRIMIR NOTA VENTA</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript1.2" src="stm31.js"></script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");
$arr_color_tabla=array("000000","ffffff","ffffff","000000");
$arr_color_texto=array("ffffff","000000","000000");
$total=1000;

echo"
<table align=center rules=rows frame=box bordercolor=#000000 align=left width=89%>
<tr>
<td><img src=../img/carioca_logo_bn.jpg width=250 height=90>
</td>

<td>

<table cellpadding=0 cellspacing=0 width=100%>
<tr><td align=right><FONT SIZE=4><b>CASA CARIOCA Ltda.&nbsp;&nbsp;&nbsp;</b></FONT></td></tr>
<tr><td align=right><FONT SIZE=2>Manzana 6, Galp&oacute;n 30&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</FONT></td></tr>
<tr><td align=right><FONT SIZE=2>Zona Franca - Iquique&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</FONT></td></tr>
<tr><td align=right><FONT SIZE=2>Tel: 00 - 56 - 57 - 2473515&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</FONT></td></tr>
<!-- <tr><td align=right><FONT SIZE=2>Fax: 00 - 56 - 57 - 475525&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</FONT></td></tr> -->
</table>

</td></tr>
</table>
";


$link=Conectarse("carioca");
$cod_fac = $_GET['cod_fac'];

$get=mysqli_query($link,"SELECT * FROM venta WHERE cod_fac='$cod_fac'");
$row=mysqli_fetch_array($get);
$fecha_fac=$row[1];
$cod_cli=$row[2];
$nom_cli=$row[3];
$dire_cli=$row[4];
$traspaso=$row[5];
$total_fac=$row[6];
$total_bul=$row[7];

///////////////////funcion para redondeo/////////////////
function redondeado ($numero, $decimales) {
   $factor = pow(10, $decimales);
   return (round($numero*$factor)/$factor); } 
/////////////////////////////////////////////////////////

$get1=mysqli_query($link,"SELECT cod_item FROM venta_aux WHERE cod_fac='$cod_fac'");
while($row1=mysqli_fetch_array($get1)){
$arr_cod[]=$row1[0];
}

   $limit=count($arr_cod);

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT nom_item FROM item WHERE cod_item='$tmp'");
   $row=mysqli_fetch_array($get);
   $arr_item[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT unid_item FROM item WHERE cod_item='$tmp'");
   $row=mysqli_fetch_array($get);
   $arr_unid[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT bultos FROM venta_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   $row=mysqli_fetch_array($get);
   $arr_bul[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT cant_fac FROM venta_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   $row=mysqli_fetch_array($get);
   $arr_cant[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT importe_fac FROM venta_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   $row=mysqli_fetch_array($get);
   $arr_imp[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT precio_uni FROM venta_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   $row=mysqli_fetch_array($get);
   $arr_precio[]=$row[0];
   }
?> 
<table rules="rows" frame="box" bordercolor="#000000" align="center" width="89%">
<tr>
<td bgcolor="#ffffff">
<form method="get" name="form1" action="">
<TABLE border="0" cellpadding="0" cellspacing="0" width="70%"> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">&nbsp;&nbsp;&nbsp;Nº NOTA:</TD> 
   <td colspan="2"><?php echo"$cod_fac"; ?></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">&nbsp;&nbsp;&nbsp;FECHA:</TD> 
   <td colspan="2"><?php echo"$fecha_fac"; ?></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">&nbsp;&nbsp;&nbsp;CLIENTE:</TD> 
   <td colspan="2"><?php echo"$nom_cli"; ?></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">&nbsp;&nbsp;&nbsp;DIRECCION:</TD> 
   <td colspan="2"><?php echo"$dire_cli"; ?></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">&nbsp;&nbsp;&nbsp;TRASPASO:</TD> 
   <td colspan="2"><?php echo"$traspaso"; ?></td>
</TR> 
</TABLE>
<br>
<!-- inicio -->
<table align="center" width="98%">
<tr>
<td bgcolor="#ffffff"><font color="#000000" size="2" face="Courier New, Courier, mono"><b><?php echo"$limit"; ?> ARTICULOS</td>
</tr>
</table>
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
	   echo"<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0 align=center width=98% bgcolor=$arr_color_tabla[2] rules=cols frame=box bordercolor=#000000>
            <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left width=10%><font color=FFFFFF size=2><b>&nbsp;&nbsp;CODIGO</a></font></td>";	 
	   echo"<td align=left width=35%><font color=FFFFFF size=2><b>&nbsp;&nbsp;ARTICULO</a></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>&nbsp;BULTOS&nbsp;&nbsp;</a></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>&nbsp;CANTIDAD&nbsp;&nbsp;</a></font></td>";	 	   	   
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>PRECIO U.&nbsp;&nbsp;</a></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>IMPORTE&nbsp;&nbsp;</a></font></td>";	 
	   echo"</tr>";
	   $c=0;
	   echo"<tr><td>&nbsp;</td></tr>";//linea en blanco superior
	   for($c=0;$c<$limit;$c++){
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td align=left><font size=1 color=$arr_color_texto[1]>&nbsp;&nbsp;$arr_cod[$c]<INPUT TYPE=hidden NAME=cod$c VALUE=$arr_cod[$c]></font></td>";		 
         echo"<td align=left><font size=1 color=$arr_color_texto[1]>&nbsp;&nbsp;$arr_item[$c]</font></td>";		 
         echo"<td align=right><font size=1 color=$arr_color_texto[1]>$arr_bul[$c]&nbsp;&nbsp;</font></td>";		 
         echo"<td align=right><font size=1 color=$arr_color_texto[1]>$arr_cant[$c]&nbsp;&nbsp;</font></td>";		 
		 $pr=$arr_precio[$c]*0.6;
		 $pr=redondeado($pr,2);
         echo"<td align=right><font size=1 color=$arr_color_texto[1]>$pr&nbsp;&nbsp;</font></td>";		 
		 $im=$arr_imp[$c]*0.6;
         echo"<td align=right><font size=1 color=$arr_color_texto[1]>$im&nbsp;&nbsp;</font></td>";		 		 		 		 
   	     echo"</tr>";
	   }
       mysqli_close($link);
  	   echo"<tr><td>&nbsp;</td></tr>";//linea en blanco inferior
       echo"</table>";
	   
	   echo"
	   <br>
	   <table border=0 width=100% cellspacing=0>
	   <tr bgcolor=#ffffff>
       <td align=right width=22%>&nbsp;</td>		 
       <td align=right width=15%><font size=3 color=#000000><b>Total bultos:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> $total_bul&nbsp;&nbsp;</font></td>
	   ";
	   $tf=$total_fac*0.6;
	   echo"
       <td align=right width=20%><font size=3 color=#000000><b>Importe total $ US:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> $tf&nbsp;&nbsp;&nbsp;</font></td>
	   </tr>
	   </table>
	   ";
echo"
<INPUT TYPE=hidden NAME=limit VALUE=$limit>
";

//echo"<center><INPUT TYPE=submit NAME=accion VALUE=Guardar class=boton></center>";
echo"</form>";

}

//////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<!-- fin -->
