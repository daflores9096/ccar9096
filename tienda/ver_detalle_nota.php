<html> 
<head> 
<title>DETALLE COMPRA/VENTA</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript1.2" src="stm31.js"></script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$total=10;

$link=Conectarse("carioca");
$cod_fac = $_GET['cod_mov'];
$tipo = $_GET['tipo_mov'];

if($tipo=='C'){
    $get=mysqli_query($link,"SELECT * FROM compra WHERE cod_fac='$cod_fac'");
    $i = 4;
}else{
    $get=mysqli_query($link,"SELECT * FROM venta WHERE cod_fac='$cod_fac'");
    $i = 6;
}

$row=mysqli_fetch_array($get);
$fecha_fac=$row[1];
$cod_pro=$row[2];// variable utilizada tanto para cliente y proveedor
$nom_pro=$row[3];// variable utilizada tanto para cliente y proveedor.... por no hacer un if... jejeje!!!
$total_fac=$row[$i];

if($tipo=='C'){
$get1=mysqli_query($link,"SELECT cod_item FROM compra_aux WHERE cod_fac='$cod_fac'");
}else{
$get1=mysqli_query($link,"SELECT cod_item FROM venta_aux WHERE cod_fac='$cod_fac'");
}
while($row1=mysqli_fetch_array($get1)){
$arr_cod[]=$row1[0];
}

if (empty($arr_cod)){
    $limit=0;
} else {
    $limit=count($arr_cod);
}


   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT nom_item FROM item WHERE cod_item='$tmp'");
   $row=mysqli_fetch_array($get);
   $arr_item[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT unid_item FROM item WHERE cod_item='$tmp'");
   $row=mysqli_fetch_array($get);
   $arr_unid[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   if($tipo=='C'){
   $get=mysqli_query($link,"SELECT cant_fac FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   }else{
   $get=mysqli_query($link,"SELECT cant_fac FROM venta_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   }
   $row=mysqli_fetch_array($get);
   $arr_cant[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   if($tipo=='C'){
   $get=mysqli_query($link,"SELECT importe_fac FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   }else{
   $get=mysqli_query($link,"SELECT importe_fac FROM venta_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   }
   $row=mysqli_fetch_array($get);
   $arr_imp[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   if($tipo=='C'){
   $get=mysqli_query($link,"SELECT precio_uni FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   }else{
   $get=mysqli_query($link,"SELECT precio_uni FROM venta_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac'");
   }
   $row=mysqli_fetch_array($get);
   $arr_precio[]=$row[0];
   }


?> 
<?=body_container_ini("","770","0")?>
<table border="0" align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="65%" align="left"><font color="#5E8CB5" size="2"><b>LISTA DE VENTAS</b></font></td>
<td align="center">
<script type="text/javascript" language="JavaScript1.2">
<!--
stm_bm(["menu7ad9",430,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",0],this);
stm_bp("p0",[0,4,0,0,3,4,0,7,100,"",-2,"",-2,90,0,0,"#000000","#ebf3f7","",3,0,0,"#000000"]);
stm_ai("p0i0",[0,"  &lt;&lt; INICIO   ","","",-1,-1,0,"../index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#5e8cb5",0,"#5e8cb5",0,"","",3,3,0,0,"#FFFFF7","#000000","#ffffff","#F3AC6C","bold 8pt 'Tahoma','Arial'","bold 8pt 'Tahoma','Arial'",0,0]);
<?php if($tipo=='C'){ ?>
stm_aix("p0i1","p0i0",[0,"   << Atras   ","","",-1,-1,0,"ver_movimiento_pro.php?cod_pro=<?php echo $cod_pro ?>"]);
stm_aix("p0i2","p0i0",[0,"Imprimir","","",-1,-1,0,"","_self","","","","",0,0,0,"arrow_r.gif","arrow_r.gif",7,7]);
stm_bpx("p1","p0",[1,4,0,0,3,4,0,0,100,"",-2,"",-2,90,0,0,"#000000","#F1F2EE"]);
stm_aix("p1i0","p0i0",[0,"Nota de Venta","","",-1,-1,0,"print_nota_compra.php?cod_fac=<?php echo $cod_fac ?>","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);

<?php }else{ ?>
stm_aix("p0i1","p0i0",[0,"   << Atras   ","","",-1,-1,0,"ver_movimiento_cli.php?cod_cli=<?php echo $cod_pro ?>"]);
stm_aix("p0i2","p0i0",[0,"Imprimir","","",-1,-1,0,"","_self","","","","",0,0,0,"arrow_r.gif","arrow_r.gif",7,7]);
stm_bpx("p1","p0",[1,4,0,0,3,4,0,0,100,"",-2,"",-2,90,0,0,"#000000","#F1F2EE"]);
stm_aix("p1i0","p0i0",[0,"Nota de Venta","","",-1,-1,0,"print_nota_venta.php?cod_fac=<?php echo $cod_fac ?>","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
<?php } ?>
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
<table width="15%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#5e8cb5" width="20%" colspan="3"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>&nbsp;Detalle</td>
</tr>
</table>
<table border="0" width="100%" bgcolor="#5E8CB5">
<tr bgcolor="#5E8CB5">
<td></td>
</tr>
<tr>
<td bgcolor="e1e4f2">

<form method="get" name="form1" action="chk_formula.php">
<br>
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
<TR> 
<?php
if($tipo=='C'){
?>   
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Nº COMPRA:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_fac" SIZE="10" MAXLENGTH="10" value="<?php echo"$cod_fac"; ?>" readonly></td>
<?php
}else{
?>   
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Nº VENTA:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_fac" SIZE="10" MAXLENGTH="10" value="<?php echo"$cod_fac"; ?>" readonly></td>
<?php
}
?>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_fac" SIZE="10" MAXLENGTH="10" value="<?php echo"$fecha_fac"; ?>" readonly></td>
</TR> 
<TR> 
<?php
if($tipo=='C'){
?>   
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">PROVEEDOR:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_pro" SIZE="1" MAXLENGTH="5" value="<?php echo"$cod_pro"; ?>" readonly>&nbsp;<INPUT TYPE="text" NAME="nom_pro" SIZE="33" MAXLENGTH="50" value="<?php echo"$nom_pro"; ?>" readonly></td>
<?php
}else{
?>   
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CLIENTE:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_cli" SIZE="1" MAXLENGTH="5" value="<?php echo"$cod_pro"; ?>" readonly>&nbsp;<INPUT TYPE="text" NAME="nom_pro" SIZE="33" MAXLENGTH="50" value="<?php echo"$nom_pro"; ?>" readonly></td>
<?php
}
?>
</TR> 


</TABLE>
<br>
<!-- inicio -->
<table width="20%">
<tr>
<td bgcolor="#ffffff" width="33%" colspan="3"><font color="5E8CB5" size="2" face="Courier New, Courier, mono"><b><?php echo"$limit"; ?> ARTICULOS</td>
</tr>
</table>
<?php
/////////////////////////////////////////ini/////////////////////////////////////////

   if (!$total){
   echo"
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td><font size=2 color=ffffff><b>NO EXISTE NINGUN REGISTRO</font></td></tr>
   </table>
   ";
   }
   else{
	   echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
            <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left width=10%><font color=FFFFFF size=2><b>CODIGO</a></font></td>";	 
	   echo"<td align=left width=35%><font color=FFFFFF size=2><b>ARTICULO</a></font></td>";	 
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>UNIDAD</a></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>CANTIDAD</a></font></td>";	 	   	   
	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>COSTO U.</a></font></td>";	 
	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>IMPORTE </a></font></td>";	 
	   echo"</tr>";
	   $c=0;

	   for($c=0;$c<$limit;$c++){
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_cod[$c]<INPUT TYPE=hidden NAME=cod$c VALUE=$arr_cod[$c]></font></td>";		 
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_item[$c]</font></td>";		 
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_unid[$c]</font></td>";		 
         echo"<td align=right><font size=2 color=$arr_color_texto[1]>$arr_cant[$c]</font></td>";		 
         echo"<td align=right><font size=2 color=$arr_color_texto[1]>$arr_precio[$c]</font></td>";		 
         echo"<td align=right><font size=2 color=$arr_color_texto[1]>$arr_imp[$c]</font></td>";		 		 		 		 
   	     echo"</tr>";
	   }
       mysqli_close($link);
       echo"</table>";
	   
	   echo"
	   <table border=0 cellspacing=0 width=100%>
	   <tr>
	   <td COLSPAN=8><hr width=100%></td>
	   </tr>
	   <tr>
	   <td width=40% bgcolor=ffffff>&nbsp;</td>
       <td align=right width=10% bgcolor=ffffff><font size=2 color=5e8cb5><b>Importe Total:</font></td>		 
	   <td align=right width=10% bgcolor=ffffff><INPUT TYPE=text NAME=sub_tot SIZE=9 MAXLENGTH=10 value=".$total_fac." align=right readonly></td>
	   </tr>
	   </table>
	   <br><br>
	   
	   ";
echo"
<INPUT TYPE=hidden NAME=limit VALUE=$limit>
";

//echo"<center><INPUT TYPE=submit NAME=accion VALUE=Guardar class=boton></center>";
echo"</form>";

}

//////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<!-- fin -->
</td>
</tr>
<tr bgcolor="#5E8CB5" height="5">
<td></td>
</tr>
</table>
<br><br><br>
<?=body_container_fin()?>
