<html> 
<head> 
<title>LISTA DE ARTICULOS</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript1.2" src="stm31.js"></script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");
?> 

<!-- inicio -->
<?php
$db="carioca";
$tabla="item";
$orderby="cod_item";
$arr_campos=array("cod_item","nom_item","unid_item","precio_item","caja_item","existencia");
$arr_titulos=array("CODIGO","ITEM","UNIDAD","PRECIO UNIT.","CANT. CAJA","EXISTENCIA");
$arr_color_tabla=array("000000","ffffff","ffffff","000000");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_item";
$pag_proceso="mod_item.php";
$icono="../img/b_detalle.png";
$funcion="";
$pag_ini="print_lista_item.php";
$tam_pag=1000;

echo"
<table cellpadding=0 cellspacing=0 rules=rows frame=box bordercolor=#000000 align=center width=90%>
<tr>
<td><img src=../img/carioca_logo.jpg width=160 height=90>
</td>

<td>

<table cellpadding=0 cellspacing=0 width=100%>
<tr><td align=right><FONT SIZE=4><b>CASA CARIOCA Ltda.</b>&nbsp;&nbsp;</FONT></td></tr>
<tr><td align=right><FONT SIZE=2><b>Manzana 4, Galp&oacute;n28</b>&nbsp;&nbsp;</FONT></td></tr>
<tr><td align=right><FONT SIZE=2><b>Zona Franca Iquique</b>&nbsp;&nbsp;</FONT></td></tr>
<tr><td align=right><FONT SIZE=2><b>Tel: 00-56-57-473515</b>&nbsp;&nbsp;</FONT></td></tr>
<tr><td align=right><FONT SIZE=2><b>Tel: 00-56-57-475525</b>&nbsp;&nbsp;</FONT></td></tr>
</table>

</td></tr>
</table>
<br>
<table align=center width=90%>
<tr><td><b>LISTA GENERAL DE ARTICULOS</b></td></tr>
</table>
";


$link=Conectarse("$db");
$get=mysqli_query($link,"SELECT * FROM $tabla");
$num=count($arr_campos);
$total=mysqli_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orden = "ASC";
if (isset($_GET['orderby'])){
    $orderby= $_GET['orderby'];
}
if (isset($_GET['orden'])){
    $orden = $_GET['orden'];
}
$lado="left";
$cont=0;
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
	$get = mysqli_query($link,'select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);
	echo"<TABLE border=1 CELLSPACING=0 CELLPADDING=0 align=center width=90% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#000000>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	   if(($arr_campos[$c]=='existencia')||($arr_campos[$c]=='caja_item')||($arr_campos[$c]=='precio_item')){
	   echo"<td align=right><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c]' class=linktitulo>&nbsp;$campo_titulo</a></font></td>";
	   }else echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c]' class=linktitulo>&nbsp;$campo_titulo</a></font></td>";

	 }
//     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
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
		   if((($t - $tmpos)!=3)||(!$tmpos)){
		   $lado='left';
		   }else $lado='right';

//////reconocer insumos escasos///////
		   if($cam=="existencia" && $row['existencia']<=$row[6]){
	       echo"<td align=$lado><font size=2 color=red>$row[$cam]</font></td>";
		   }else if(($cam=="existencia") && ($row['existencia']>=$row['exi_max'])){
	       echo"<td align=$lado><font size=2 color=green>$row[$cam]</font></td>";
		   }else  echo"<td align=$lado><font size=1 color=$arr_color_texto[1]>&nbsp;&nbsp;$row[$cam]&nbsp;&nbsp;</font></td>";
	     }
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
		   if((($t - $tmpos)!=3)||(!$tmpos)){
		   $lado='left';
		   }else $lado='right';
//////reconocer insumos escasos///////
		   if($cam=="existencia" && $row['existencia']<=$row[6]){
	       echo"<td align=$lado><font size=2 color=red>$row[$cam]</font></td>";
		   }else if(($cam=="existencia") && ($row['existencia']>=$row['exi_max'])){
	       echo"<td align=$lado><font size=2 color=green>$row[$cam]</font></td>";
		   }else  echo"<td align=$lado><font size=1 color=$arr_color_texto[1]>&nbsp;&nbsp;$row[$cam]&nbsp;&nbsp;</font></td>";
	     }
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
<br><br>
