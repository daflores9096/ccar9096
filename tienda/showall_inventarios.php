<?php
session_start();
include('../shield/acceso_db.php');
if(isset($_SESSION['usuario_nombre'])) {
?>
<html> 
<head> 
<title>INVENTARIOS FISICOS</title> 
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
<td width="80%"><font color="#5E8CB5" size="2"><b>INVENTARIO FISICO > Lista de Inventarios</b></font></td>
<td align="right" width="10%">
<script type="text/javascript" language="JavaScript1.2">
<!--
stm_bm(["menu7ad9",430,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",0],this);
stm_bp("p0",[0,4,0,0,3,4,0,0,100,"",-2,"",-2,90,0,0,"#000000","#cccccc","",3,0,0,"#000000"]);
stm_ai("p0i0",[0,"      INICIO      ","","",-1,-1,0,"../index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","bold 8pt 'Tahoma','Arial'","bold 8pt 'Tahoma','Arial'",0,0]);
stm_aix("p0i1","p0i0",[0,"NUEVO INVENTARIO","","",-1,-1,0,"nuevo_inventario.php"]);
stm_ep();
stm_em();
//-->
</script>

</td>
</tr>
</table>
<br><br><br>
<table width="45%" bgcolor="#5E8CB5">
<tr>
<?php
    echo"<td bgcolor='#5e8cb5' width='50%' colspan='3'><font color='ffffff' size='2' face='Courier New, Courier, mono'><b>&nbsp;Mostrar Inventarios</td>";
    echo"<td bgcolor='#ffffff' width='50%' colspan='3'><A href='anular_inventarios.php' class='linktab'><font color='5E8CB5' size='2' face='Courier New, Courier, mono'><b>&nbsp;Anular Inventarios</a></td>";
?>
</tr>
</table>
<table border="0" width="100%" bgcolor="#5E8CB5">
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>

<tr>
<td bgcolor="e1e4f2">
<br>

<!-- inicio -->
<?php
$db="carioca";
$tabla="inventario";
$orderby="fecha_lev";
$arr_campos=array("id_inv","fecha_lev","descripcion","fecha_ap","estado");
$arr_titulos=array("CODIGO","FECHA LEVANTAMIENTO","DESCRIPCION","FECHA APLICACION","ESTADO");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="id_inv";
$pag_proceso="ver_inventario.php";
$icono="../img/b_detalle.png";
$funcion="";
$pag_ini="showall_inventarios.php";
$tam_pag=50;

$link=Conectarse("$db");
$get=mysqli_query($link,"SELECT * FROM $tabla");
$num=count($arr_campos);
$total=mysqli_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
if (isset($_GET['orderby'])){
    $orderby= $_GET['orderby'];
} else {
    $orderby= "fecha_lev";
}

if (isset($_GET['orden'])){
    $orde = $_GET['orden'];
} else {
    $orden = "DESC";
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
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='Ver Inventario'></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
   	     echo"</tr>";
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
</td>
</tr>
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>

</table>
<br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>
<?php
} else {
    include "../shield/acceso.php";
}
?> 