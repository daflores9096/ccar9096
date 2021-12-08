<html> 
<head> 
<title>ANULAR ITEM</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script> 
function uno(src,color_entrada) { 
    src.bgColor=color_entrada;src.style.cursor="";
} 
function dos(src,color_default) { 
    src.bgColor=color_default;src.style.cursor="default"; 
} 
</script>
<script type="text/javascript" language="JavaScript1.2" src="stm31.js"></script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");
?> 
<?=body_container_ini("","770","0")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>LISTA DE ITEMS</b></font></td>
<td align="right" width="10%">
<form method="post" action="../index.php">
<input type="submit" name="enviar" value="INICIO" class="boton">
</form>
</td>
<td align="right" width="10%">
<form method="post" action="nuevo_item.php">
<input type="submit" name="enviar" value="NUEVO ITEM" class="boton">
</form>
</td>
</tr>
</table>
<br><br><br>
<table width="35%" bgcolor="#5E8CB5">
<tr align="center">
<?php
    echo"<td width='50%' bgcolor='#FFFFFF'><A href='showall_item.php' class='linktab2' title=''>Mostrar ITEMS</A></td>";
    echo"<td bgcolor='#5E8CB5' width='50%'><font color='ffffff' size='2' face='Courier New, Courier, mono'><b>Anular ITEMS</td>";
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
<!-- inicio -->
<?php
$db="carioca";
$tabla="item";
$orderby="cod_item";
$arr_campos=array("cod_item","nom_item","unid_item","precio_item","existencia");
$arr_titulos=array("CODIGO","ITEM","UNIDAD","PRECIO","EXISTENCIA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_item";
$pag_proceso="eliminar_item.php";
$icono="../img/boton_borrar.png";
$funcion="";
$pag_ini="anular_item.php";
$tam_pag=1000;

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

///////////////////PAGINACION SUPERIOR//////////////////////
echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center><br>";  
///////////////////////////////////////////////////////////	
	
	echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=97% bgcolor=$arr_color_tabla[2] rules=cols frame=vsides bordercolor=#5e8cb5>
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
		   }else  echo"<td align=$lado><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
	     }
/////////////////////icono de funcion////////////////////////
		 $id=$var_envio;
		 printf("<td align=center bgcolor=FBD9D9><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='Eliminar ITEM'></a></td>
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
		   if((($t - $tmpos)!=3)||(!$tmpos)){
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
		 printf("<td align=center bgcolor=FBD9D9><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='Eliminar ITEM'></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($get);
       mysql_close($link);
       echo"</table><br>";

////////////////PAGINACION INFERIOR/////////////////
echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center><br>";  
////////////////////////////////////////////////////
   }

?>
<!-- fin -->
<?//=container_lista_fin()?>
<br><br>
</td>
</tr>
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>

</table>
<br><br><br><br><br>
<?=body_container_fin()?>