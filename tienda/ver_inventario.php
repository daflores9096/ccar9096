<html> 
<head> 
<title>Inventario Fisico</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script language="JavaScript" src="calendario/javascripts.js"></script>
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
//include ("calendario/calendario.php");
$id_inv = $_GET['id_inv'];
//$fecha_lev = $_GET['fecha_lev'];
//$descripcion = $_GET['descripcion'];

$db="carioca";
$tabla="item";
$orderby="nom_item";
$arr_campos=array("cod_item","nom_item","unid_item","existencia");
$arr_titulos=array("CODIGO","ARTICULO","UNIDAD","EXISTENCIA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio="cod_item";
$pag_proceso="ver_ficha_item.php";
$icono="../img/b_detalle.png";
$funcion="Info Extendida";
$pag_ini="inventario_fisico.php";
$tam_pag=1000;
$link=Conectarse("$db");

$get1=mysqli_query($link,"SELECT * FROM inventario WHERE id_inv=$id_inv");
$r=mysqli_fetch_array($get1);
?> 
<?=body_container_ini("","770","0")?>
<?php
$cod=$r[0];
$fecha_lev=$r[1];
$descripcion=$r[2];
$fecha_ap=$r[3];
$estado=$r[4];
?>

<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>INVENTARIO FISICO > Detalle Inventario</b></font></td>
<td align="right" width="10%">
<script type="text/javascript" language="JavaScript1.2">
<!--
stm_bm(["menu7ad9",430,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",0],this);
stm_bp("p0",[0,4,0,0,3,4,0,7,100,"",-2,"",-2,90,0,0,"#000000","#ebf3f7","",3,0,0,"#000000"]);
stm_ai("p0i0",[0,"  &lt;&lt; Atras   ","","",-1,-1,0,"showall_inventarios.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#5e8cb5",0,"#5e8cb5",0,"","",3,3,0,0,"#FFFFF7","#000000","#ffffff","#F3AC6C","bold 8pt 'Tahoma','Arial'","bold 8pt 'Tahoma','Arial'",0,0]);
stm_aix("p0i1","p0i0",[0,"       Inicio      ","","",-1,-1,0,"../index.php"]);
stm_aix("p0i2","p0i0",[0,"Reportes","","",-1,-1,0,"","_self","","","","",0,0,0,"arrow_r.gif","arrow_r.gif",7,7]);
stm_bpx("p1","p0",[1,4,0,0,3,4,0,0,100,"",-2,"",-2,90,0,0,"#000000","#F1F2EE"]);
stm_aix("p1i0","p0i0",[0,"Vista de Impresion","","",-1,-1,0,"nodisp.php?id_inv=<?php echo $id_inv?>&fecha_lev=<?php echo $fecha_lev?>&descripcion=<?php echo $descripcion?>","_self","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
stm_aix("p1i1","p1i0",[0,"Comparativo Teorico vs Fisico","","",-1,-1,0,"nodisp.php?id_inv=<?php echo $id_inv?>&fecha_lev=<?php echo $fecha_lev?>&descripcion=<?php echo $descripcion?>"]);
stm_ep();
stm_ep();
stm_em();
//-->
</script>
</td>
</tr>
</table>
<br><br><br>
<table width="25%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<td bgcolor="#5E8CB5" width="33%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>TEORICO vs FISICO</td>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="e1e4f2">
<br>
<form method="get" name="inventario" action="chkinventario.php">
<br>
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="id_inv" SIZE="10" MAXLENGTH="10" value="<?php echo"$id_inv"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA LEVANTAMIENTO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_lev" SIZE="10" MAXLENGTH="10" value="<?php echo"$fecha_lev"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">DESCRIPCION:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="descripcion" SIZE="40" MAXLENGTH="40" value="<?php echo"$descripcion"; ?>" readonly></td>
</TR> 

</TABLE>
<br>
<table width="25%">
<tr>
<td bgcolor="#ffffff"><font color="5E8CB5" size="2" face="Courier New, Courier, mono"><b>&nbsp;CATALOGO DE INSUMOS</td>
</tr>
</table>
<!-- inicio -->
<?php
/////////////////////////////////////////ini/////////////////////////////////////////
$get1=mysqli_query($link,"SELECT * FROM inventario WHERE id_inv=$id_inv");
$get2=mysqli_query($link,"SELECT item.cod_item, item.nom_item, inventario_aux.existencia_inv 
				   FROM item,inventario_aux 
				   WHERE inventario_aux.id_inv=$id_inv && item.cod_item=inventario_aux.cod_item
 				   ORDER BY item.nom_item"
				   );
$num=count($arr_campos);
$total1=mysqli_num_rows($get1);
$total2=mysqli_num_rows($get2);
$pag="$pag_ini?st=";
$pp=$tam_pag;
if (isset($_GET['orderby'])){
    $orderby= $_GET['orderby'];
} else {
    $orderby= "cod_item";
}

if (isset($_GET['orden'])){
    $orde = $_GET['orden'];
} else {
    $orden = "DESC";
}

$lado="left";
$cont=0;

   if (!$total2){
   echo"
   <table align=left bgcolor=$arr_color_tabla[2] width=100%>
   <tr bgcolor=$arr_color_tabla[0] align=center><td><font size=2 color=ffffff><b>NO EXISTE NINGUN REGISTRO</font></td></tr>
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

	// la llamada a base de datos
        //$qry = "SELECT item.cod_item, item.nom_item, item.unid_item, inventario_aux.existencia_sis, inventario_aux.existencia_inv , inventario_aux.diferencia FROM item,inventario_aux WHERE inventario_aux.id_inv=$id_inv AND item.cod_item=inventario_aux.cod_item ORDER BY item.nom_item limit $st,$pp";
        //echo $qry;
        //exit();        
	$get = mysqli_query($link,"SELECT item.cod_item, item.nom_item, item.unid_item, inventario_aux.existencia_sis, 
							   inventario_aux.existencia_inv , inventario_aux.diferencia
						FROM item,inventario_aux 
						WHERE inventario_aux.id_inv=$id_inv AND item.cod_item=inventario_aux.cod_item
						ORDER BY item.nom_item limit $st,$pp");
        
	$numreg=mysqli_num_rows($get);

	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b>&nbsp;CODIGO</a></font></td>";
	   echo"<td align=left width=25%><font color=$arr_color_texto[0] size=2><b>&nbsp;ARTICULO</a></font></td>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b>&nbsp;UNIDAD</a></font></td>";
	   echo"<td align=right><font color=$arr_color_texto[0] size=2><b>&nbsp;EXISTENCIA FISICA</a></font></td>";
	 echo"</tr>";
	   $c=0;
	   echo"<FORM name=form1 ACTION=chk_inventario.php method=get>";
	   while($row = mysqli_fetch_array($get)) {
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td align=left width=10%><font size=2 color=$arr_color_texto[1]>
		         <font size=2 color=$arr_color_texto[1]>&nbsp;$row[cod_item]</font>
				 <INPUT TYPE=hidden NAME=cod$c VALUE=$row[cod_item]>
		      </td>";		 
         echo"<td align=left width=10%><font size=2 color=$arr_color_texto[1]>
		         <font size=2 color=$arr_color_texto[1]>&nbsp;$row[nom_item]</font>
				 <INPUT TYPE=hidden NAME=nom$c VALUE=$row[nom_item]>
		      </td>";		 
         echo"<td align=left width=10%><font size=2 color=$arr_color_texto[1]>
		         <font size=2 color=$arr_color_texto[1]>&nbsp;$row[unid_item]</font>
				 <INPUT TYPE=hidden NAME=unid$c VALUE=$row[unid_item]>
		      </td>";		
         echo"<td align=right width=10%><font size=2 color=$arr_color_texto[1]>
		         <font size=2 color=$arr_color_texto[1]>&nbsp;$row[existencia_inv]</font>
				 <INPUT TYPE=hidden NAME=exinv$c VALUE=$row[existencia_inv]>
		      </td>";		 

   	     echo"</tr>";
		 $c=$c+1;
	   }
       mysqli_free_result($get);
       mysqli_close($link);
       echo"</table><br>";
echo"
<INPUT TYPE=hidden NAME=id_inv VALUE=$id_inv>
<INPUT TYPE=hidden NAME=fecha_lev VALUE=$fecha_lev>
<INPUT TYPE=hidden NAME=descripcion VALUE='$descripcion'>
";
echo"<INPUT TYPE=hidden NAME=numreg VALUE=$numreg>";
//echo"<INPUT TYPE=submit NAME=accion VALUE=Guardar class=boton>";
echo"</form>";
echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
//echo paginacion($total, $pp, $st,$pag);
echo paginacion_orden($total1, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

   }

//////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<!-- fin -->
<br>
</td>
</tr>
</table>
<br><br><br><br><br><br><br>
<?=body_container_fin()?>