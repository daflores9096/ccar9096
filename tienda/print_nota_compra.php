<html>
<head>
<title>IMPRIMIR NOTA COMPRA</title> 
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
<table rules=rows frame=box bordercolor=#000000 align=left width=90%>
<tr><td>

<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr><td><FONT SIZE=5><b>CASA CARIOCA Ltda.</b></FONT></td></tr>
<tr><td><FONT SIZE=3><b>Manzana 4, Galpón28</b></FONT></td></tr>
<tr><td align=center><FONT SIZE=4><b>EN EFECTIVO</b></FONT></td></tr>
<tr><td align=center><b>(En dólares)</b></td></tr>
</table>

</td></tr>
</table>
<br>
";


$link=Conectarse("carioca");
$cod_fac = $_GET['cod_fac'];

$get=mysqli_query($link,"SELECT * FROM compra WHERE cod_fac='$cod_fac'");
$row=mysqli_fetch_array($get);
$fecha_fac=$row[1];
$cod_pro=$row[2];
$nom_pro=$row[3];
$total_fac=$row[4];

$get1=mysqli_query($link,"SELECT cod_item FROM compra_aux WHERE cod_fac='$cod_fac'");
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
   $get=mysqli_query($link,"SELECT cant_fac FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   $row=mysqli_fetch_array($get);
   $arr_cant[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT importe_fac FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   $row=mysqli_fetch_array($get);
   $arr_imp[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT precio_uni FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   $row=mysqli_fetch_array($get);
   $arr_precio[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT precio_ven FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   $row=mysqli_fetch_array($get);
   $arr_precio_ven[]=$row[0];
   }

?> 
<table align="left" border="1" width="90%" bgcolor="#000000" rules="rows" frame="box">
<tr>
<td bgcolor="#ffffff">

<form method="get" name="form1" action="chk_formula.php">
<TABLE border="0" cellpadding="0" cellspacing="0" width="70%"> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">&nbsp;Nº COMPRA:</TD> 
   <td colspan="2"><?php echo"$cod_fac"; ?></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">&nbsp;FECHA:</TD> 
   <td colspan="2"><?php echo"$fecha_fac"; ?></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">&nbsp;PROVEEDOR:</TD> 
   <td colspan="2"><?php echo"$nom_pro"; ?></td>
</TR> 

</TABLE>
<br>
<!-- inicio -->
<table width="20%">
<tr>
<td bgcolor="#ffffff" width="33%" colspan="3"><font color="#000000" size="2" face="Courier New, Courier, mono"><b><?php echo"$limit"; ?> ARTICULOS</td>
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
	   echo"<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=box bordercolor=#000000>
            <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left width=10%><font color=FFFFFF size=2><b>&nbsp;CODIGO</a></font></td>";	 
	   echo"<td align=left width=35%><font color=FFFFFF size=2><b>&nbsp;ARTICULO</a></font></td>";	 
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>&nbsp;UNIDAD</a></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>&nbsp;CANTIDAD</a></font></td>";	 	   	   
//	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>P.COSTO&nbsp;</a></font></td>";	 
	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>P.VENTA&nbsp;</a></font></td>";	 
	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>IMPORTE&nbsp; </a></font></td>";	 
	   echo"</tr>";
	   $c=0;
	   echo"<tr><td>&nbsp;</td></tr>";//linea en blanco superior
	   for($c=0;$c<$limit;$c++){
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td align=left><font size=1 color=$arr_color_texto[1]>&nbsp;&nbsp;$arr_cod[$c]<INPUT TYPE=hidden NAME=cod$c VALUE=$arr_cod[$c]></font></td>";		 
         echo"<td align=left><font size=1 color=$arr_color_texto[1]>&nbsp;&nbsp;$arr_item[$c]</font></td>";		 
         echo"<td align=left><font size=1 color=$arr_color_texto[1]>&nbsp;&nbsp;$arr_unid[$c]</font></td>";		 
         echo"<td align=right><font size=1 color=$arr_color_texto[1]>$arr_cant[$c]&nbsp;&nbsp;</font></td>";		 
//         echo"<td align=right><font size=1 color=$arr_color_texto[1]>$arr_precio[$c]&nbsp;&nbsp;</font></td>";		 
         echo"<td align=right><font size=1 color=$arr_color_texto[1]>$arr_precio_ven[$c]&nbsp;&nbsp;</font></td>";		 
         echo"<td align=right><font size=1 color=$arr_color_texto[1]>$arr_imp[$c]&nbsp;&nbsp;</font></td>";		 		 		 		 
   	     echo"</tr>";
	   }
       mysqli_close($link);
  	   echo"<tr><td>&nbsp;</td></tr>";//linea en blanco inferior
       echo"</table>";
	   
	   echo"
	   <table border=0 cellspacing=0 width=100%>
	   <tr>
       <td align=left width=80% bgcolor=ffffff><font size=4 color=000000><b>Importe Total:</font></td>		 
	   <td align=right width=20% bgcolor=ffffff>$ US <B>$total_fac</b></td>
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
