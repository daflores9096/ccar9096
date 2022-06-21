<html> 
<head> 
<title>MOVIMIENTO PROVEEDOR</title> 
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
include("../lib/lib_formato.php");
include("../lib/lib_consulta.php");
$db="carioca";
$link=conectarse($db);
$tabla="compra";
$orderby="fecha_fac";
$arr_campos=array("cod_fac","fecha_fac","total_fac");
$arr_titulos=array("Nº COMPRA","FECHA","MONTO");
$arr_color_tabla=array("000000","ffffff","ffffff","000000");
$arr_color_texto=array("ffffff","000000","000000");
$var_envio1="cod_mov";
$var_envio2="tipo_mov";
//$var_envio3="cod_cli_pro";
$pag_proceso="ver_detalle_nota.php";
$icono="../img/b_detalle.png";
$funcion="";
$pag_ini="ver_movimiento_pro.php";
$tam_pag=1000;

$indcom=$_GET['cod_pro'];

$result=mysqli_query($link,"SELECT * FROM proveedor WHERE cod_pro='$indcom'");
$row=mysqli_fetch_array($result);
$numcam=mysqli_num_fields($result);
$field=mysqli_fetch_field_direct($result,0);
$extra_dat="no";

//////////////total compras////////////////
$gt=mysqli_query($link,"SELECT * FROM compra WHERE cod_pro='$indcom'");
$total_compras=0;
while($rw=mysqli_fetch_array($gt)){
  $total_compras=$total_compras + $rw['total_fac'];
}
//////////////////////////////////////////
?>
<?php
echo"
<table frame=box bordercolor=#000000 align=center width=80%>
<tr><td>

<table border=0 cellpadding=0 cellspacing=0>
<tr><td><FONT SIZE=5><b>CASA CARIOCA Ltda.</b></FONT></td></tr>
<tr><td><FONT SIZE=3><b>Manzana 4, Galpón28</b></FONT></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><FONT SIZE=3><b>Movimiento del proveedor: $row[1]</b></FONT></td></tr>
</table>
</td></tr>
</table>
<br>
";
?>
<?php
echo"
<table align=center width=80% bgcolor=#ffffff rules=rows frame=hsides bordercolor=#000000>
<tr>
<td><font color=#000000 size=3><b>Total compras realizadas:</b></font></td>
<td align=right><font color=#000000 size=3><b>$total_compras</b></font></td>
</tr>
</table>
";
?>
<br>
<!-- form inicio -->
<?php
$link=Conectarse("carioca");
$get=mysqli_query($link,"SELECT * FROM compra WHERE cod_pro=$indcom");
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
//echo"codigo: $indcom";
   if (!$total){
   echo"
   <br>
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td><font size=2 color=ffffff><b>NO EXISTE NINGUN REGISTRO</font></td></tr>
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
    if(!$orderby&&!$orden){
	     $orderby=$arr_campos[1];
		 $orden="DESC";//Aqui modificar el orden inicial ASC o DESC
	    }

	  if($orden=="ASC"){
	  $ord="DESC";
	  }else $ord="ASC";
	  
	  if($orden=="ASC"){
	  $dir='<img src=../img/asc.gif border=0 valign=bottom>';
	  }else{
	  $dir='<img src=../img/desc.gif border=0 valign=bottom>';
	  }
	// la llamada a base de datos
//	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);
	$get = mysqli_query($link,"SELECT * FROM $tabla WHERE cod_pro='$indcom' order by $orderby $orden limit $st,$pp");

	echo"<TABLE CELLSPACING=1 CELLPADDING=2 align=center width=80% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#000000>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	  if($arr_campos[$c]=='total_fac'){
	   echo"<td align=right><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord&cod_item=$indcom title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>&nbsp;$campo_titulo</a></font></td>";
	   } else echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord&cod_item=$indcom title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>&nbsp;$campo_titulo</a></font></td>";
	 }
	 echo"</tr>";
	   
	   while($row = mysqli_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
		 $tmp=$row[$cam];
		 $t=strlen($tmp);
		 $tmpos=strpos($tmp,".");
		   if((($t - $tmpos)!=3)||(!$tmpos)){
		   echo"<td align=left><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		   }else echo"<td align=right><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";

		 }
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
		 $tmp=$row[$cam];
		 $t=strlen($tmp);
		 $tmpos=strpos($tmp,".");
		   if((($t - $tmpos)!=3)||(!$tmpos)){
		   echo"<td align=left><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		   }else echo"<td align=right><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";

		 }

		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($get);
       mysqli_close($link);
       echo"</table><br>";

	if ($extra_dat=="si"){
    echo"	
	<table CELLSPACING=0 CELLPADDING=0  width=100% frame=void rules=rows bordercolor=5e8cb5>
	<tr bgcolor=ffffff>
	<td align=right><font size=2 color=5e8cb5>Total <b>$total</b> Registros, ordenados por el campo <b>$orderby</b> en orden <b>$orden</b></font></td>
	</tr>
	</table>
	<br>
	";
	}
echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

//   }

}

?>
