<html> 
<head> 
<title>MOVIMIENTO ARTICULOS</title> 
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
include("../lib/lib_formato.php");
include("../lib/lib_consulta.php");
$db="carioca";
$link=conectarse($db);
$tabla="movimiento";
$orderby="fecha_mov";
$arr_campos=array("tipo_mov","fecha_mov","cod_mov","nom_cli_pro","entrada","salida");
$arr_titulos=array("TIPO","FECHA","Nº NOTA","CLIENTE/PROVEEDOR","ENTRADA","SALIDA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio1="cod_mov";
$var_envio2="tipo_mov";
//$var_envio3="cod_cli_pro";
$pag_proceso="ver_detalle_nota.php";
$icono="../img/b_detalle.png";
$funcion="";
$pag_ini="ver_movimiento_item.php";
$tam_pag=100000;

$indcom=$_GET['cod_item'];

$result=mysqli_query($link,"SELECT * FROM item WHERE cod_item='$indcom'");
$row=mysqli_fetch_array($result);
$numcam=mysqli_num_fields($result);
$field=mysqli_fetch_field_direct($result,0);

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
stm_ai("p0i0",[0,"Volver a lista artículos","","",-1,-1,0,"showall_item.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","bold 8pt 'Tahoma','Arial'","bold 8pt 'Tahoma','Arial'",0,0]);
stm_aix("p0i1","p0i0",[0,"     INICIO     ","","",-1,-1,0,"../index.php"]);
stm_aix("p0i2","p0i0",[0,"IMPRIMIR","","",-1,-1,0,"","_self","","","","",0,0,0,"arrow_r.gif","arrow_r.gif",7,7]);
stm_bpx("p1","p0",[1,4,0,0,3,4,0,0,100,"",-2,"",-2,90,0,0,"#000000","#F1F2EE"]);
stm_aix("p1i0","p0i0",[0,"Movimiento del ITEM","","",-1,-1,0,"print_mov_item.php?cod_item=<?php echo $row[0]; ?>","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
//stm_aix("p1i0","p0i0",[0,"Lista de Precios","","",-1,-1,0,"print_lista_precio.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
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
<table width="50%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<?php
//    echo"<td width='20%'><A href='ver_ficha_item.php?cod_insum=$indcom' class='linktab'>GENERAL</A></td>";
    echo"<td width='20%'><A href='mod_item.php?cod_item=$indcom' class='linktab'>DATOS ARTICULO</A></td>";
    echo"<td bgcolor='#5E8CB5' width='20%'><font color='ffffff' size='2' face='Courier New, Courier, mono'><b>MOVIMIENTO ARTICULO</td>";
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
<?php echo"<center><font size=6 color=#5e8cb5><b> [$row[0]] $row[1] </b></font></center>"?>
<br>
<?php
echo"
<table align=center width=97% bgcolor=#ffffff>
<tr>
<td><font color=#5e8cb5 size=3><b>Saldo actual del articulo:</b></font></td>
<td align=right><font color=#5e8cb5 size=3><b>$row[6] $row[2]</b></font></td>
</tr>
</table>
";
?>
<br>
<!-- form inicio -->
<?php
$link=Conectarse("carioca");
$get=mysqli_query($link,"SELECT * FROM movimiento WHERE cod_item='$indcom'");
$num=count($arr_campos);
$total=mysqli_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$extra_dat = "no";
$orden = "ASC";
if (isset($_GET['orderby'])){
    $orderby= $_GET['orderby'];
}
if (isset($_GET['orden'])){
    $orden = $_GET['orden'];
}
$lado="left";
$cont=0;

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
	$get = mysqli_query($link,"select * from $tabla where cod_item='$indcom' order by $orderby $orden limit $st,$pp");

	echo"<TABLE CELLSPACING=1 CELLPADDING=2 align=center width=98% bgcolor=$arr_color_tabla[2] rules=cols frame=vsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord&cod_item=$indcom title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>&nbsp;$campo_titulo $dir</a></font></td>";	 
	 }else{
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord&cod_item=$indcom title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>&nbsp;$campo_titulo</a></font></td>";
      }
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
///////////icono de funcion//////////////////
		 $id1=$var_envio1;
		 $id2=$var_envio2;
//		 $id3=$var_envio3;
		 printf("<td align=center><a href=\"$pag_proceso?$id1=%s&$id2=%s\"><IMG SRC=$icono BORDER=0 title='Ver detalle nota'></a></td>
			  ", $row[$id1], $row[$id2], $row[$id1], $row[$id2]);
/////////////////////////////////////////////
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
//////////icono de funcion////////////////////
		 $id1=$var_envio1;
		 $id2=$var_envio2;
//		 $id3=$var_envio3;
		 printf("<td align=center><a href=\"$pag_proceso?$id1=%s&$id2=%s\"><IMG SRC=$icono BORDER=0 title='Ver detalle nota'></a></td>
			  ", $row[$id1], $row[$id2], $row[$id1], $row[$id2]);
/////////////////////////////////////////////

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
//echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

//   }

}

?>
<?//=lista_fin()?>
<!-- form fin -->
<br> 
<br>
</td>
</tr>

<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>
</table>
<br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>
