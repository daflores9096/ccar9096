<html> 
<head> 
<title>REPORTE DE VENTAS</title> 
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
<script type="text/javascript" language="JavaScript1.2" src="stm31.js"></script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");
if (isset($_GET['fecha_min']) && isset($_GET['fecha_max'])){
    $fechamin=$_GET['fecha_min'];
    $fechamax=$_GET['fecha_max'];
} else {
    $fechamin=date("Y-m-01");
    $fechamax=date("Y-m-d");
}
$ultimafecha=date("20y-m-d");
?> 
<?php
$db="carioca";
$tabla="venta";
$orderby="cod_fac";
$arr_campos=array("cod_fac","fecha_fac","nom_cli","total_fac");
$arr_titulos=array("Nº VENTA","FECHA","CLIENTE","TOTAL VENTA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_fac";
$pag_proceso=".php";
$icono="../img/b_detalle.png";
$funcion="";
$pag_ini="reporte_ventas.php";
$tam_pag=100;
$link=Conectarse($db);
?>
<?=body_container_ini("","770","0")?>
<table border="0" align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="65%" align="left"><font color="#5E8CB5" size="2"><b>REPORTE DE VENTAS</b></font></td>
<td align="right">
<script type="text/javascript" language="JavaScript1.2">
<!--
stm_bm(["menu7ad9",430,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",0],this);
stm_bp("p0",[0,4,0,0,3,4,0,7,100,"",-2,"",-2,90,0,0,"#000000","#cccccc","",3,0,0,"#000000"]);
stm_ai("p0i0",[0,"    << INICIO    ","","",-1,-1,0,"../index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","bold 8pt 'Tahoma','Arial'","bold 8pt 'Tahoma','Arial'",0,0]);
//stm_aix("p0i1","p0i0",[0,"     INICIO     ","","",-1,-1,0,"../index.php"]);
stm_aix("p0i2","p0i0",[0,"IMPRIMIR","","",-1,-1,0,"","_self","","","","",0,0,0,"arrow_r.gif","arrow_r.gif",7,7]);
stm_bpx("p1","p0",[1,4,0,0,3,4,0,0,100,"",-2,"",-2,90,0,0,"#000000","#F1F2EE"]);
stm_aix("p1i0","p0i0",[0,"Reporte de ventas","","",-1,-1,0,"print_rep_ventas.php?fecha_min=<?php echo $fechamin; ?>&fecha_max=<?php echo $fechamax; ?>","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
stm_ep();
stm_ep();
stm_em();
//-->
</script>
</td>
 
 </tr>
</table>
<br><BR><br>
<FORM name="form2" ACTION="reporte_ventas.php" method="get"> 
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
<TR bgcolor="#e1e4f2"> 
   <TD bgcolor="#e1e4f2"><b><font size="2" color="#5e8cb5">Desde el dia:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_min" SIZE="10" MAXLENGTH="10" value="<?php echo $fechamin; ?>"><img src="../img/b_calendar.png" onClick='showCalendar(this, form2.fecha_min, "yyyy-mm-dd","es",1)' title="Calendario"></td>
   <TD bgcolor="#e1e4f2"><b><font size="2" color="#5e8cb5">Hasta el dia:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_max" SIZE="10" MAXLENGTH="10" value="<?php echo $fechamax; ?>"><img src="../img/b_calendar.png" onClick='showCalendar(this, form2.fecha_max, "yyyy-mm-dd","es",1)' title="Calendario"></td>
   <td colspan="2" bgcolor="#e1e4f2"><input type="submit" value="Aceptar" class="boton"></td>
</TR> 
</TABLE>
</form>

<?php
$get1 = mysqli_query($link,"SELECT * FROM $tabla WHERE fecha_fac>='$fechamin' AND fecha_fac<='$fechamax'");
$row1=mysqli_fetch_array($get1);
?>
<table width="22%" bgcolor="#5E8CB5">
<tr bgcolor="#FFFFFF">
<td bgcolor="#5E8CB5" width="33%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>&nbsp;VENTAS REALIZADAS</td>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#e1e4f2">
<br>
<!-- inicio -->
<table width="97%" align=center>
<tr>
<td bgcolor="#ffffff" width="60%" colspan="3">&nbsp<?php echo"<font color=5e8cb5 size=2>REPORTE DE VENTAS del dia <b>$fechamin</b> al dia <b>$fechamax</b></b></font>"; ?></td>
<td width=40%>&nbsp;</td>
</tr>
</table>
<br>
<?php
$link=Conectarse("$db");
$get=mysqli_query($link,"SELECT * FROM $tabla WHERE fecha_fac>='$fechamin' AND fecha_fac<='$fechamax' ORDER BY 'cod_fac'");
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
	$get = mysqli_query($link,"SELECT * FROM $tabla WHERE fecha_fac>='$fechamin' AND fecha_fac<='$fechamax' ORDER BY '$orderby' $orden");
	echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=97% bgcolor=$arr_color_tabla[2] rules=cols frame=vsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=$lado><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord&fecha_min=$fechamin&fecha_max=$fechamax title='Ordenar por $arr_titulos[$c]' class=linkcampo>&nbsp;$campo_titulo $dir</a></font></td>";	 
	 }else{
	   echo"<td align='$lado'><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord&fecha_min=$fechamin&fecha_max=$fechamax title='Ordenar por $arr_titulos[$c]' class=linktitulo>&nbsp;$campo_titulo</a></font></td>";
      }

	 }
//	     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	 echo"</tr>";
	   
	   while($row = mysqli_fetch_array($get)) {
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
/////////////////////imprimir registro////////////////////////
          echo"<td align=$lado><font size=2 color=$arr_color_texto[1]>&nbsp;&nbsp;$row[$cam]&nbsp;&nbsp;</font></td>";
	     }
/*/////////////////////icono de funcion////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='$funcion'></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////*/
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
<br>
</td>
</tr>
</table>
<br><br><br><br><br><br><br><br>
<?=body_container_fin()?>