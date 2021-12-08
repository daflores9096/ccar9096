<html> 
<head> 
<title>Aplicar Inventario</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript" src="calendario/calendar.js"></script>
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

$db="carioca";
$tabla="item";
$orderby="nom_item";
$arr_campos=array("cod_item","nom_item","unid_item","existencia");
$arr_titulos=array("CODIGO","ARTICULO","UNIDAD","EXISTENCIA_REAL","EXISTENCIA_SIS","DIFERENCIA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_item";
$pag_proceso="ver_ficha_item.php";
$icono="../img/b_detalle.png";
$funcion="Info Extendida";
$pag_ini="inventario_fisico.php";
$tam_pag=1000;
$link=Conectarse("$db");
$ultimafecha=date("20y-m-d");

$get1=mysql_query("SELECT * FROM inventario WHERE id_inv=$id_inv",$link);
$r=mysql_fetch_array($get1);
?> 
<?=body_container_ini("","770","0")?>
<?php
$cod=$r[0];
$fecha_lev=$r[1];
$descripcion=$r[2];
$fecha_ap=$r[3];
$estado=$r[4];
?>

<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>INVENTARIO FISICO > Aplicar Inventario</b></font></td>
<td align="right" width="10%">
<form method="post" action="showall_inventarios.php">
<input type="SUBMIT" value="<< Atras" class="boton">
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
<table width="45%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<td width="33%"><A href="inventario_pen.php?id_inv=<? echo"$id_inv";?>&fecha_lev=<? echo"$fecha_lev";?>&descripcion=<? echo"$descripcion";?>" class="linktab">INVENTARIO PENDIENTE</A></td>
<td bgcolor="#5E8CB5" width="33%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>APLICAR INVENTARIO</td>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>
<tr>
<td bgcolor="e1e4f2">
<br>
<br>
<form method="get" name="inventario" action="apl_inventario.php">
<br>
<TABLE border="0" bgcolor="ffffff" cellpadding="1" cellspacing="2" width="70%" align="center"> 
<TR> 
   <TD bgcolor="#FFFFFF" width="35%"><b><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="id_inv" SIZE="10" MAXLENGTH="10" value="<? echo"$id_inv"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA LEVANTAMIENTO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_lev" SIZE="10" MAXLENGTH="10" value="<? echo"$fecha_lev"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA APLICACION:</TD> 

   <td colspan="2"><INPUT TYPE="text" NAME="fecha_ap" SIZE="10" MAXLENGTH="10" value="<?php echo $ultimafecha; ?>"><img src="../img/b_calendar.png" onClick='showCalendar(this, inventario.fecha_ap, "yyyy-mm-dd","es",1)' title="Calendario"></td>
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
   <table align=left bgcolor=$arr_color_tabla[2] width=100%>
   <tr bgcolor=$arr_color_tabla[0] align=center><td><font size=2 color=ffffff><b>NO EXISTE NINGUN REGISTRO</font></td></tr>
   </table>
   <br><br><br><br><br><br><br><br>
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
	   $c=0;
	   echo"<FORM name=form1 ACTION=chk_inventario.php method=get>";
	   while($row = mysql_fetch_array($get)) {
	     echo"<INPUT TYPE=hidden NAME=cod$c VALUE=$row[cod_item]>
				 <INPUT TYPE=hidden NAME=cant$c VALUE=$row[existencia_inv]>
		      ";		 
		 $c=$c+1;
	   }
       mysql_free_result($get);
       mysql_close($link);
echo"
<INPUT TYPE=hidden NAME=id_inv VALUE=$id_inv>
<INPUT TYPE=hidden NAME=fecha_lev VALUE=$fecha_lev>
<INPUT TYPE=hidden NAME=descripcion VALUE='$descripcion'>
<INPUT TYPE=hidden NAME=estado VALUE='Aplicado'>
";
echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
//echo paginacion($total, $pp, $st,$pag);
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

   }

//////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<!-- fin -->

<br><center>
<INPUT TYPE="hidden" NAME="numreg" <? echo"VALUE=$numreg"; ?>>
<INPUT TYPE="submit" NAME="accion" VALUE="Aplicar" class="boton">
</form>
</center>
<br>
</td>
</tr>
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>

</table>
<br><br><br>
<?=body_container_fin()?>