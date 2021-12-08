<html> 
<head> 
<title>DETALLE COMPRA</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript1.2" src="stm31.js"></script>
</head> 
<?php 
session_start();
include('shield/acceso_db.php');

if (isset($_SESSION['usuario_nombre'])){
    

include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$total=10;

$link=Conectarse("carioca");
$cod_fac = $_GET['cod_fac'];

///////////recuperar datos de factura////////////
$get=mysql_query("SELECT * FROM compra WHERE cod_fac='$cod_fac'",$link);
$row=mysql_fetch_array($get);
$fecha_fac=$row[1];
$cod_pro=$row[2];
$nom_pro=$row[3];
$total_fac=$row[4];

//////////recuperar codigos de los items////////////
$get1=mysql_query("SELECT cod_item FROM compra_aux WHERE cod_fac='$cod_fac'",$link);
while($row1=mysql_fetch_array($get1)){
$arr_cod[]=$row1[0];
}

   $limit=count($arr_cod);

/////////////recuperar nombres de los items///////////////
   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT nom_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_item[]=$row[0];
   }

/////////////recuperar unidades de los items//////////////
   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT unid_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_unid[]=$row[0];
   }

////////////recuperar cantidades de cada item//////////////
   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT cant_fac FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac' ORDER BY id",$link);
   $row=mysql_fetch_array($get);
   $arr_cant[]=$row[0];
   }

///////////////recuperar importes de cada item///////////////
   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT importe_fac FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac' ORDER BY id",$link);
   $row=mysql_fetch_array($get);
   $arr_imp[]=$row[0];
   }

///////////////recuperar precios de cada item//////////////
   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT precio_uni FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac' ORDER BY id",$link);
   $row=mysql_fetch_array($get);
   $arr_precio[]=$row[0];
   }

///////////////recuperar precios de venta de cada item/////////////
   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT precio_ven FROM compra_aux WHERE cod_item='$tmp' && cod_fac='$cod_fac' ORDER BY id",$link);
   $row=mysql_fetch_array($get);
   $arr_precio_ven[]=$row[0];
   }

?> 
<?=body_container_ini("","770","0")?>
<table border="0" align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="65%" align="left"><font color="#5E8CB5" size="2"><b>DETALLE DE COMPRA</b></font></td>
<td align="center">
<script type="text/javascript" language="JavaScript1.2">
<!--
stm_bm(["menu7ad9",430,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",0],this);
stm_bp("p0",[0,4,0,0,3,4,0,7,100,"",-2,"",-2,90,0,0,"#000000","#cccccc","",3,0,0,"#000000"]);
stm_ai("p0i0",[0,"      INICIO      ","","",-1,-1,0,"../index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","bold 8pt 'Tahoma','Arial'","bold 8pt 'Tahoma','Arial'",0,0]);
stm_aix("p0i1","p0i0",[0,"Volver a lista compras","","",-1,-1,0,"showall_compras.php"]);
stm_aix("p0i2","p0i0",[0,"Imprimir","","",-1,-1,0,"","_self","","","","",0,0,0,"arrow_r.gif","arrow_r.gif",7,7]);
stm_bpx("p1","p0",[1,4,0,0,3,4,0,0,100,"",-2,"",-2,90,0,0,"#000000","#F1F2EE"]);
stm_aix("p1i0","p0i0",[0,"Nota de Compra","","",-1,-1,0,"print_nota_compra.php?cod_fac=<? echo $cod_fac ?>","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
stm_aix("p1i0","p0i0",[0,"Nota de Compra(MOD)","","",-1,-1,0,"print_nota_compra2.php?cod_fac=<? echo $cod_fac ?>","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#ffffff",0,"#ffffff",0,"","",3,3,0,0,"#FFFFF7","#000000","#5e8cb5","#F3AC6C","8pt 'Tahoma','Arial'","8pt 'Tahoma','Arial'"]);
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
<tr>
<td align="center" bgcolor="#5e8cb5" width="50%" colspan="3"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>&nbsp;DETALLE COMPRA</td>
<?php
if ($_SESSION['nivel_acceso'] == 1){//restringir modificar compra
echo"<td ALIGN=CENTER width='50%' bgcolor='#FFFFFF'><A href='modificar_datos_compra.php?cod_fac=$cod_fac' class='linktab2' title=''>MODIFICAR COMPRA</A></td>";
} else {
        //no mostrar pestaña de modificar compra
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
<!-- imprimir datos generales de la factura -->
<form method="get" name="form1" action="">
<br>
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Nro COMPRA:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_fac" SIZE="10" MAXLENGTH="10" value="<? echo"$cod_fac"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_fac" SIZE="10" MAXLENGTH="10" value="<? echo"$fecha_fac"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">PROVEEDOR:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_pro" SIZE="1" MAXLENGTH="5" value="<? echo"$cod_pro"; ?>" readonly>&nbsp;<INPUT TYPE="text" NAME="nom_pro" SIZE="33" MAXLENGTH="50" value="<? echo"$nom_pro"; ?>" readonly></td>
</TR> 

</TABLE>
<br>
<!-- inicio -->
<table width="20%">
<tr>
<td bgcolor="#ffffff" width="33%" colspan="3"><font color="5E8CB5" size="2" face="Courier New, Courier, mono"><b><? echo"$limit"; ?> ARTICULOS</td>
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
//////////////asignar titulos a los campos///////////////   
	   echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
            <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left width=10%><font color=FFFFFF size=2><b>CODIGO</a></font></td>";	 
	   echo"<td align=left width=35%><font color=FFFFFF size=2><b>ARTICULO</a></font></td>";	 
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>UNIDAD</a></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>CANTIDAD</a></font></td>";	 	   	   
	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>P.COSTO</a></font></td>";	 
	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>P.VENTA</a></font></td>";	 	   
	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>IMPORTE </a></font></td>";	 
	   echo"</tr>";
	   $c=0;

////////////////imprimir valores de los campos////////////////
	   for($c=0;$c<$limit;$c++){
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_cod[$c]<INPUT TYPE=hidden NAME=cod$c VALUE=$arr_cod[$c]></font></td>";		 
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_item[$c]</font></td>";		 
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_unid[$c]</font></td>";		 
         echo"<td align=right><font size=2 color=$arr_color_texto[1]>$arr_cant[$c]</font></td>";		 
         echo"<td align=right><font size=2 color=$arr_color_texto[1]>$arr_precio[$c]</font></td>";		 
         echo"<td align=right><font size=2 color=$arr_color_texto[1]>$arr_precio_ven[$c]</font></td>";		 
         echo"<td align=right><font size=2 color=$arr_color_texto[1]>$arr_imp[$c]</font></td>";		 		 		 		 
   	     echo"</tr>";
	   }
       mysql_close($link);
  	   echo"<tr><td>&nbsp;</td></tr>";//linea en blanco inferior	   
       echo"</table>";
	   
	   echo"
	   <table border=0 cellspacing=0 width=100%>
	   <tr>
	   <td COLSPAN=8><hr width=100%></td>
	   </tr>
	   <tr>
	   <td width=40% bgcolor=ffffff>&nbsp;</td>
       <td align=right width=30% bgcolor=ffffff><font size=3 color=5e8cb5><b>Importe Total en Dolares:</font></td>		 
	   <td align=right width=10% bgcolor=ffffff><INPUT TYPE=text NAME=sub_tot SIZE=9 MAXLENGTH=10 value=$total_fac align=right readonly></td>
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
<?php 
} else {
    include "../shield/acceso.php";
}
?>   