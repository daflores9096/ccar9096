<html> 
<head> 
<title>Listado para inventario</title> 
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
$id_inv = $_GET['id_inv'];
$fecha_lev = $_GET['fecha_lev'];
$descripcion = $_GET['descripcion'];


$db="carioca";
$tabla="item";
$orderby="nom_item";
$arr_campos=array("cod_item","nom_item","unid_item","existencia");
$arr_titulos=array("CODIGO","ARTICULO","UNIDAD","EXISTENCIA_REAL","EXISTENCIA_SIS","DIFERENCIA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_item";
$pag_proceso="ver_ficha_insum.php";
$icono="../img/b_detalle.png";
$funcion="Info Extendida";
$pag_ini="inventario_fisico.php";
$tam_pag=100;
$link=Conectarse("$db");

$get1=mysql_query("SELECT * FROM inventario WHERE id_inv=$id_inv",$link);
$r=mysql_fetch_array($get1);
?> 
<?
$cod=$r[0];
$fecha_lev=$r[1];
$descripcion=$r[2];
$fecha_ap=$r[3];
$estado=$r[4];
?>
<FONT SIZE=5><B>CARIOCA </B></FONT>
<BR>
<B>REPORTE PARA INVENTARIO FISICO</B>
<form method="get" name="inventario" action="chkinventario.php">
<br>
<TABLE cellpadding="0" cellspacing="0" width="70%"> 
<TR> 
   <TD bgcolor="#FFFFFF" width="25%"><b><font size="2" color="000000">CODIGO:</TD> 
   <td colspan="2"><? echo"$id_inv"; ?></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">DESCRIPCION:</TD> 
   <td colspan="2"><? echo"$descripcion"; ?></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#000000">FECHA LEVANTAMIENTO:</TD> 
   <td colspan="2"><? echo"$fecha_lev"; ?></td>
</TR> 
</TABLE>
<br>
<!-- inicio -->
<?php
/////////////////////////////////////////ini/////////////////////////////////////////
$get1=mysql_query("SELECT * FROM inventario WHERE id_inv=$id_inv",$link);
$get2=mysql_query("SELECT item.cod_item, item.nom_item, inventario_aux.existencia_inv 
				   FROM item,inventario_aux 
				   WHERE inventario_aux.id_inv=$id_inv && item.cod_item=inventario_aux.cod_item
 				   ORDER BY item.nom_item"
				   ,$link);
$num=count($arr_campos);
$total1=mysql_num_rows($get1);
$total2=mysql_num_rows($get2);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orderby= $_GET['orderby'];
$orden = $_GET['orden'];

   if (!$total2){
   echo"
   <table align=left bgcolor=$arr_color_tabla[2] width=70%>
   <tr bgcolor=000000 align=center><td><font size=2 color=ffffff><b>NO EXISTE NINGUN REGISTRO</font></td></tr>
   </table>
   <br><br><br>
   ";
   }
   else{
    // obtener el valor de $st
		if(isset($_GET['st'])) {
		$st = $_GET['st'];
		} else {
		$st = 0;
		}

	// la llamada a base de datos
	$get = mysql_query("SELECT item.cod_item, item.nom_item, item.unid_item, inventario_aux.existencia_sis, 
							   inventario_aux.existencia_inv , inventario_aux.diferencia
						FROM item,inventario_aux 
						WHERE inventario_aux.id_inv=$id_inv && item.cod_item=inventario_aux.cod_item
						ORDER BY item.nom_item limit $st,$pp");
	$numreg=mysql_num_rows($get);

	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 width=90% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#000000>
     <tr bgcolor=000000>";
	   echo"<td align=left width=15%><font color=$arr_color_texto[0] size=2><b>&nbsp;CODIGO</a></font></td>";
	   echo"<td align=left width=45%><font color=$arr_color_texto[0] size=2><b>&nbsp;ARTICULO</a></font></td>";
	   echo"<td align=left width=20%><font color=$arr_color_texto[0] size=2><b>&nbsp;UNIDAD</a></font></td>";
	   echo"<td align=left width=20%><font color=$arr_color_texto[0] size=2><b>&nbsp;EXISTENCIA</a></font></td>";
	 echo"</tr>";
	   $c=0;
	   echo"<FORM name=form1 ACTION=chk_inventario.php method=get>";
	   while($row = mysql_fetch_array($get)) {
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td align=left width=10%><font size=2 color=$arr_color_texto[1]>
		         <font size=2 color=$arr_color_texto[1]>&nbsp;$row[cod_item]</font>
				 <INPUT TYPE=hidden NAME=cod$c VALUE=$row[cod_item]>
		      </td>";		 
         echo"<td align=left width=10%><font size=2 color=$arr_color_texto[1]>
		         <font size=2 color=$arr_color_texto[1]>&nbsp;$row[nom_item]</font>
				 <INPUT TYPE=hidden NAME=nom$c VALUE=$row[nom_item]>
		      </td>";		 
         echo"<td align=left width=10%><font size=2 color=$arr_color_texto[1]>
		         <font size=2 color=$arr_color_texto[1]>&nbsp;$row[unid_item]</font>
				 <INPUT TYPE=hidden NAME=unid$c VALUE=$row[unid_item]>
		      </td>";		

   	     echo"</tr>";
		 $c=$c+1;
	   }
       mysql_free_result($get);
       mysql_close($link);
       echo"</table><br>";
echo"
<INPUT TYPE=hidden NAME=id_inv VALUE=$id_inv>
<INPUT TYPE=hidden NAME=fecha_lev VALUE=$fecha_lev>
<INPUT TYPE=hidden NAME=descripcion VALUE='$descripcion'>
";
echo"<INPUT TYPE=hidden NAME=numreg VALUE=$numreg>";
//echo"<INPUT TYPE=submit NAME=accion VALUE=Guardar class=boton>";
echo"</form>";
echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
//echo paginacion($total, $pp, $st,$pag);
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

   }

//////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<!-- fin -->

