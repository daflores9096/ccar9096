<html> 
<head> 
<title>Entradas por Compra</title> 
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
?> 
<?=body_container_ini("","770","0")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>ANULAR COMPRAS</b></font></td>
<td align="right" width="10%">
<form method="post" action="../index.php">
<input type="submit" name="enviar" value="INICIO" class="boton">
</form>
</td>
<td align="right" width="10%">
<form method="post" action="nueva_compra2.php">
<input type="submit" name="enviar" value="NUEVA COMPRA" class="boton">
</form>
</td>
</td>
</tr>
</table>
<br><br><br>
<table width="40%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<?php
    echo"<td width='33%'><A href='showall_compras.php' class='linktab2' title='Muestra todas las Salidas registradas'>MOSTRAR COMPRAS</A></td>";
    echo"<td bgcolor='#5E8CB5' width='33%'><font color='ffffff' size='2' face='Courier New, Courier, mono'><b>ANULAR COMPRAS</td>";
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
<table width="97%" align=center>
<tr>
<td bgcolor="#ffffff" width="30%" colspan="3"><font color="5E8CB5" size="2" face="Courier New, Courier, mono"><b>&nbsp;LISTA DE COMPRAS:</td>
<td width=70%>&nbsp;</td>
</tr>
</table>
<!-- inicio -->
<?php
$db="carioca";
$tabla="compra";
$orderby="fecha_fac";
$arr_campos=array("cod_fac","fecha_fac","nom_pro","total_fac");
$arr_titulos=array("Nº COMPRA","FECHA","PROVEEDOR","TOTAL");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_fac";
$pag_proceso="eliminar_compra.php";
$icono="../img/boton_borrar.png";
$funcion="";
$pag_ini="anular_compra.php";
$tam_pag=30;

$link=Conectarse("$db");
$get=mysqli_query($link,"SELECT * FROM $tabla");
$num=count($arr_campos);
$total=mysqli_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orden = "DESC";
if (isset($_GET['orderby'])){
    $orderby= $_GET['orderby'];
}
if (isset($_GET['orden'])){
    $orden = $_GET['orden'];
}

$lado = "left";
$cont = 0;
$row=mysqli_fetch_array($get);
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
		 $orden="DESC";
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
	$get = mysqli_query($link,'select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);
	echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=97% bgcolor=$arr_color_tabla[2] rules=cols frame=vsides bordercolor=#c1cdd8>
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
	   
	   while($row = mysqli_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];

//////reconocer cantidades decimales//////
		 $tmp=$row[$cam];
		 $t=strlen($tmp);
		 $tmpos=strpos($tmp,".");
		   if(($t - $tmpos)!=3){
		   $lado='left';
		   }else $lado='right';

//////reconocer insumos escasos///////
		   if($cam=="existencia" && $row['existencia']<=$row[6]){
	       echo"<td align=$lado><font size=2 color=red>$row[$cam]</font></td>";
		   }else if(($cam=="existencia") && ($row['existencia']>=$row['exi_max'])){
	       echo"<td align=$lado><font size=2 color=green>$row[$cam]</font></td>";
		   }else  echo"<td align=$lado><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
	     }
/////////////////////icono de funcion////////////////////////
		 $id=$var_envio;
		 printf("<td align=center bgcolor=FBD9D9><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='Anular compra'></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];

//reconocer cantidades decimales
		 $tmp=$row[$cam];
		 $t=strlen($tmp);
		 $tmpos=strpos($tmp,".");
		   if(($t - $tmpos)!=3){
		   $lado='left';
		   }else $lado='right';
//////reconocer insumos escasos///////
		   if($cam=="existencia" && $row['existencia']<=$row[6]){
	       echo"<td align=$lado><font size=2 color=red>$row[$cam]</font></td>";
		   }else if(($cam=="existencia") && ($row['existencia']>=$row['exi_max'])){
	       echo"<td align=$lado><font size=2 color=green>$row[$cam]</font></td>";
		   }else  echo"<td align=$lado><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
	     }
//////////////////////icono de funcion///////////////////////
		 $id=$var_envio;
		 printf("<td align=center bgcolor=FBD9D9><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='Anular compra'></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($get);
       mysqli_close($link);
       echo"</table><br>";

echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center><br>";  

   }

?>
<!-- fin -->
<br>
<br>
</td>
</tr>
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>
</table>
<br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>