<html> 
<head> 
<title>SELECCIONAR CLIENTE</title> 
<script> 
function uno(src,color_entrada) { 
    src.bgColor=color_entrada;src.style.cursor="";
} 
function dos(src,color_default) { 
    src.bgColor=color_default;src.style.cursor="default"; 
} 
</script>
<script language="JavaScript" type="text/javascript">

</script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");
$db="carioca";
$tabla="cliente";
$order_by="nom_cli";
$arr_campos=array("cod_cli","nom_cli");
$arr_titulos=array("CODIGO","CLIENTE");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_cli";
$var_envio1="nom_cli";
$var_envio2="dire_cli";
$pag_proceso="nueva_venta.php";
$icono="../img/ingreso.png";
$funcion="";
$pag_ini="lista_cli_aux2.php";
$tam_pag=100;
?> 
<!-- inicio -->
<?php
$link=Conectarse("$db");
$get=mysqli_query($link, "SELECT * FROM $tabla");
$num=count($arr_campos);
$total=mysqli_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orden = 'ASC';

if (isset($_GET['orderby'])){
    $orderby= $_GET['orderby'];
} else {
    $orderby= "nom_cli";
}

if (isset($_GET['orden'])){
    $orde = $_GET['orden'];
} else {
    $orden = "ASC";
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
	     $orderby=$order_by;
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

	$get1 = mysqli_query($link, 'select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);
	echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=vsides bordercolor=#5e8cb5>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=$lado><font color=FFFFFF size=2><b>&nbsp;$campo_titulo</a></font></td>";	 
	 }else{
	   echo"<td align='$lado'><font color=$arr_color_texto[0] size=2><b>&nbsp;$campo_titulo</a></font></td>";
      }

	 }
     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	 echo"</tr>";
	   
	   while($row = mysqli_fetch_array($get1)) {
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
		 $id1=$var_envio1;
		 $id2=$var_envio2;
		 $aux=str_replace(" ", "&nbsp;", $row[$id1]);
		 $aux1=str_replace(" ", "&nbsp;", $row[$id2]);
		 echo"<td><a href=JavaScript:close(); title=pasar_valor onClick=window.opener.document.form1.cod_cli.value=$row[$id];window.opener.document.form1.nom_cli.value='$aux';window.opener.document.form1.dire_cli.value='$aux1';><IMG SRC=$icono BORDER=0 title='Seleccionar Cliente' width=15 height=15></a></td>";
/////////////////////////////////////////////
   	     echo"</tr>";
	   }
       mysqli_free_result($get1);
       mysqli_close($link);
       echo"</table><br>";

echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center><br>";  

   }
?>
<!-- fin -->
