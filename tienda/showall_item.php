<?php
session_start();
include('../shield/acceso_db.php');
if(isset($_SESSION['usuario_nombre'])) {
?>
<html> 
<head> 
<title>LISTA DE ARTICULOS</title> 
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
<table border="0" align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="65%" align="left"><font color="#5E8CB5" size="2"><b>LISTA DE ITEMS</b></font></td>
<td align="center">
<script type="text/javascript" language="JavaScript1.2">
<!--
stm_bm(["menu7ad9",430,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",0],this);
stm_bp("p0",[0,4,0,0,3,4,0,7,100,"",-2,"",-2,90,0,0,"#000000","#cccccc","",3,0,0,"#000000"]);
stm_ai("p0i0",[0,"     INICIO     ","","",-1,-1,0,"../index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","bold 8pt 'Tahoma','Arial'","bold 8pt 'Tahoma','Arial'",0,0]);
<?php 
if ($_SESSION['nivel_acceso'] == '1'){
?>
stm_aix("p0i1","p0i0",[0,"NUEVO ITEM","","",-1,-1,0,"nuevo_item.php"]);
<?php 
} 
?>
stm_aix("p0i2","p0i0",[0,"IMPRIMIR","","",-1,-1,0,"","_self","","","","",0,0,0,"arrow_r.gif","arrow_r.gif",7,7]);
stm_bpx("p1","p0",[1,4,0,0,3,4,0,0,100,"",-2,"",-2,90,0,0,"#000000","#F1F2EE"]);
stm_aix("p1i0","p0i0",[0,"Lista de existencia","","",-1,-1,0,"print_lista_item.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
stm_aix("p1i0","p0i0",[0,"Lista de precios","","",-1,-1,0,"print_lista_precio.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
stm_aix("p1i0","p0i0",[0,"Articulos disponibles","","",-1,-1,0,"print_lista_item_disp.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
stm_aix("p1i0","p0i0",[0,"Articulos disponibles sin precio","","",-1,-1,0,"print_lista_item_disp2.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
//stm_aix("p1i1","p1i0",[0,"Lista de Precios","","",-1,-1,0,"print_lista_precio.php"]);
//stm_aix("p1i2","p1i0",[0,"Insumos Escasos","","",-1,-1,0,"show_insum_escasos.php"]);
//stm_aix("p1i3","p1i0",[0,"Insumos Excedentes","","",-1,-1,0,"show_insum_exced.php"]);
stm_ep();
stm_ep();
stm_em();
//-->
</script>
</td>
 
 </tr>
</table>

<br><br><br>
<table width="35%" bgcolor="#5E8CB5">
<tr align="center">
<?php
    echo"<td bgcolor='#5E8CB5' width='50%'><font color='ffffff' size='2' face='Courier New, Courier, mono'><b>Mostrar ITEMS</td>";
    
    if ($_SESSION['nivel_acceso'] == '1'){
    echo"<td width='50%' bgcolor='#FFFFFF'><A href='anular_item.php' class='linktab2' title=''>Anular ITEMS</A></td>";
    }
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
$orden = "DESC";
$arr_campos=array("cod_item","nom_item","unid_item","precio_item","existencia");
$arr_titulos=array("CODIGO","ITEM","UNIDAD","PRECIO","EXISTENCIA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_item";
$pag_proceso="mod_item.php";
$icono="../img/b_detalle.png";
$funcion="";
$pag_ini="showall_item.php";
$tam_pag=1000;

$link=Conectarse("$db");
$get=mysqli_query($link,"SELECT * FROM $tabla");
$num=count($arr_campos);
$total=mysqli_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;

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
	$get = mysqli_query($link, 'select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);

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
		   if($cam=="existencia" && $row['existencia']<=$row[7]){
	       echo"<td align=$lado><font size=2 color=red>$row[$cam]</font></td>";
		   }else if(($cam=="existencia") && ($row['existencia']>=$row['exi_max'])){
	       echo"<td align=$lado><font size=2 color=green>$row[$cam]</font></td>";
		   }else  echo"<td align=$lado><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
	     }
/////////////////////icono de funcion////////////////////////
		 $id=$var_envio;
                 if ($_SESSION['nivel_acceso'] == '1'){
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='Ver Ficha ITEM'></a></td>
			  ", $row[$id], $row[$id]);
                 }
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
		   if($cam=="existencia" && $row['existencia']<=$row[7]){
	       echo"<td align=$lado><font size=2 color=red>$row[$cam]</font></td>";
		   }else if(($cam=="existencia") && ($row['existencia']>=$row['exi_max'])){
	       echo"<td align=$lado><font size=2 color=green>$row[$cam]</font></td>";
		   }else  echo"<td align=$lado><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
	     }
//////////////////////icono de funcion///////////////////////
		 $id=$var_envio;
                 if ($_SESSION['nivel_acceso'] == '1'){
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='Ver Ficha ITEM'></a></td>
			  ", $row[$id], $row[$id]);
                 }
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($get);
       mysqli_close($link);
       echo"</table><br>";

///////////////PAGINACION INFERIOR/////////////////
echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center><br>";  
/////////////////////////////////////////////////////
   }

?>
<!-- fin -->
<br><br>
</td>
</tr>
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>

</table>
<br><br><br><br><br>
<?=body_container_fin()?>
<?php
} else {
    include "../shield/acceso.php";
}
?> 
