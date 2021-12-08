<html>
<head>
<title>REPORTE DE VENTAS</title>
</head>
<?
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");
$fecha_max = $_GET['fecha_max'];
$fecha_min = $_GET['fecha_min'];
$fechamin=$_GET['fecha_min'];
$fechamax=$_GET['fecha_max'];
?>

<body>
<?
echo"
<table frame=box bordercolor=#000000 align=center width=80%>
<tr><td>

<table border=0 cellpadding=0 cellspacing=0>
<tr><td><FONT SIZE=5><b>CASA CARIOCA Ltda.</b></FONT></td></tr>
<tr><td><FONT SIZE=3><b>Manzana 4, Galpón28</b></FONT></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><b>REPORTE DE VENTAS</b></td></tr>
<tr><td><font color=000000 size=3>Desde el dia <b>$fechamin</b> al dia <b>$fechamax</b></b></font></td></tr>
</table>

</td></tr>
</table>
";
?>
<?
$db="carioca";
$tabla="venta";
$orderby="cod_fac";
$arr_campos=array("cod_fac","fecha_fac","nom_cli","total_fac");
$arr_titulos=array("Nº VENTA","FECHA","CLIENTE","TOTAL VENTA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_en";
$pag_proceso="ver_ficha_entrada_aux.php";
$icono="../img/b_detalle.png";
$funcion="";
$pag_ini="reporte_entradas.php";
$tam_pag=10000;
$link=Conectarse("$db");
//////////////total ventas////////////////
$gt=mysql_query("SELECT * FROM $tabla WHERE fecha_fac>='$fechamin' AND fecha_fac<='$fechamax'",$link);
$total_ventas=0;
while($rw=mysql_fetch_array($gt)){
  $total_ventas=$total_ventas + $rw['total_fac'];
}
//////////////////////////////////////////
?>

<!-- Inicio  -->
<?
echo"<br>";

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
	$get = mysql_query("SELECT * FROM $tabla WHERE fecha_fac>='$fechamin' AND fecha_fac<='$fechamax' ORDER BY '$orderby' $orden");
	echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=80% bgcolor=000000 rules=rows frame=hsides bordercolor=#000000>
     <tr bgcolor=000000>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo=='total_fac'){
	   echo"<td align=right><font color=ffffff size=2><b>&nbsp;$campo_titulo</font></td>";	 
	 }else{
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b>&nbsp;$campo_titulo</font></td>";
      }

	 }
	 echo"</tr>";
	   
	   while($row = mysql_fetch_array($get)) {
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
/////////////////////imprimir registro////////////////////////
          echo"<td align=$lado><font size=2 color=$arr_color_texto[1]>&nbsp;&nbsp;$row[$cam]&nbsp;&nbsp;</font></td>";
	     }
/////////////////////icono de funcion////////////////////////
/////////////////////////////////////////////
   	     echo"</tr>";
	   }
       mysql_free_result($get);
       mysql_close($link);
       echo"</table><br>";

echo"
<table align=center width=80% bgcolor=#ffffff frame=box>
<tr>
<td><font color=#000000 size=3><b>Total ventas realizadas:</b></font></td>
<td align=right><font color=#000000 size=3>$ US <b>$total_ventas</b></font></td>
</tr>
</table>
<br>
";

echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
//echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center><br>";  
   }
?>
<!-- Fin -->
</body>
</html>
