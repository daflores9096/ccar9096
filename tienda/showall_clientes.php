<?php
session_start();
include('shield/acceso_db.php');
if(isset($_SESSION['usuario_nombre'])) {
?>
<html> 
<head> 
<title>CLIENTES</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
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
$db="carioca";
$tabla="cliente";
$orderby="nom_cli";
$arr_campos=array("cod_cli","nom_cli","tel_cli","dire_cli");
$arr_titulos=array("CODIGO","NOMBRE","TELEFONO","DIRECCION");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_cli";
$pag_proceso="ver_ficha_cliente.php";
$icono="../img/b_detalle.png";
$funcion="";
$pag_ini="showall_clientes.php";
$tam_pag=50;
?> 
<?=body_container_ini("","770","0")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>LISTA DE CLIENTES</b></font></td>
<td align="right" width="10%">
<form method="post" action="../index.php">
<input type="submit" name="enviar" value="INICIO" class="boton">
</form>
</td>
<td align="right" width="10%">
<form method="post" action="nuevo_cliente.php">
<input type="submit" name="enviar" value="NUEVO CLIENTE" class="boton">
</form>
</td>
</tr>
</table>
<br><br>
<table width="40%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#5e8cb5" width="50%" colspan="3"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>&nbsp;Mostrar Clientes</td>
<td bgcolor="#ffffff" width="50%" colspan="3"><A href="anular_clientes.php" class="linktab"><font color="5E8CB5" size="2" face="Courier New, Courier, mono"><b>&nbsp;Anular Clientes</a></td>
</tr>
</table>
<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#e1e4f2">
<br>
<br>
<!-- inicio -->
<?php
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla",$link);
$num=count($arr_campos);
$total=mysql_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orderby= $_GET['orderby'];
$orden = $_GET['orden'];
$row=mysql_fetch_array($get);
   if (!$total){
   echo"
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td><font size=2 color=ffffff><b>NO EXISTE NINGUN REGISTRO</font></td></tr>
   </table>
   ";
   }
   else{
    // obtener el valor de $st
		if(isset($_GET['st'])) {
		$st = $_GET['st'];
		} else {
		$st = 0;
		}
    if(!$orderby&&!$orden){
	     $orderby=$arr_campos[1];
		 $orden="ASC";
	    }

	  if($orden=="ASC"){
	  $ord="DESC";
	  }else $ord="ASC";
	  
	  if($orden=="ASC"){
	  $dir='<img src=../img/asc.gif border=0 valign=bottom title=Ascendente>';
	  }else{
	  $dir='<img src=../img/desc.gif border=0 valign=bottom title=Descendente>';
	  }	  
	  
//llamada a base de datos
	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);
	echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=vsides bordercolor=#5e8cb5>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=$lado><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c]' class=linkcampo>&nbsp;$campo_titulo $dir</a></font></td>";	 
	 }else{
	   echo"<td align='$lado'><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c]' class=linktitulo>&nbsp;$campo_titulo</a></font></td>";
      }

	 }
     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	 echo"</tr>";
	   
	   while($row = mysql_fetch_array($get)) {
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
//////reconocer insumos escasos///////
		   if($cam=="estado" && $row['estado']=="Pendiente"){
	       echo"<td><font size=2 color=red><a href=inventario_pen.php?id_inv=$row[id_inv] title='Aplicar Inventario' class=linktab3>$row[$cam]</a></font></td>";
		   }else { echo"<td><font size=2 color=5e8cb5>$row[$cam]</font></td>";}
	     }
/////////////////////icono de funcion////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='Ver Ficha Cliente'></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
   	     echo"</tr>";
	   }
       mysql_free_result($get);
       mysql_close($link);
       echo"</table><br>";

echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center><br>";  

   }

?>
<!-- fin -->
<br><br>
</td>
</tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>
<?php
} else {
    include "../shield/acceso.php";
}
?> 