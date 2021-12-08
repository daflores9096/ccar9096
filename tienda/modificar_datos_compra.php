<html> 
<head> 
<title>NOTA DE COMPRA</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript" src="calendario/calendar.js"></script>
<script language="JavaScript" type="text/javascript">
function PopWindow()
{
window.open('lista_pro_aux2.php','win','width=460,height=400,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=600');
}
function PopWindowItem()
{
window.open('lista_item.php','win','width=560,height=400,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=600');
}
</script>

<script> 
function uno(src,color_entrada) { 
    src.bgColor=color_entrada;src.style.cursor="";
} 
function dos(src,color_default) { 
    src.bgColor=color_default;src.style.cursor="default"; 
} 

function veinte(x){
	    var w,z,i,c,tmp;
		z=0
		for(i=1;i<=x;i++){
		c=(i*7);
		tmp=parseFloat(window.document.form1.elements[c+1].value) * 0.40;
		z=parseFloat(window.document.form1.elements[c+1].value) + tmp;
		w=parseFloat(z);
		window.document.form1.elements[c+2].value=w;
		}
}

function importes(x){
	    var w,z,i,c;
		z=0
		for(i=1;i<=x;i++){
		c=(i*7);
		z=parseFloat(window.document.form1.elements[c].value) * parseFloat(window.document.form1.elements[(c+2)].value);
		w=parseFloat(z);
		window.document.form1.elements[(c+3)].value=w;
		}
}

function subtotal(x){
	    var w,z,i,c;
		z=0
		for(i=1;i<=x;i++){
		c=(i*7);
		z=z+parseFloat(window.document.form1.elements[c+3].value);
		}
		w=parseFloat(z);
		window.document.form1.tot_fac.value=w;
}

</script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");

$link=Conectarse("carioca");
$cod_fac = $_GET['cod_fac'];
$pag_proceso="quitar_item_compra.php";
$var_envio1="cod_item";
$var_envio2="cod_fac";

///////////////recuperar datos de la factura///////////////
$g=mysql_query("SELECT * FROM compra WHERE cod_fac=$cod_fac",$link);
$r=mysql_fetch_array($g);
$fecha_fac=$r[1];
$cod_pro=$r[2];
$nom_pro=$r[3];
$tot_fac=$r[4];

/////////////////recuperar datos de los items/////////////////////
$a=mysql_query("SELECT * FROM compra_aux WHERE cod_fac=$cod_fac ORDER BY id",$link);
while($r=mysql_fetch_array($a)){
$arr_item[]=$r[2];
$arr_cant[]=$r[3];
$arr_pre[]=$r[4];
$arr_ven[]=$r[5];
$arr_imp[]=$r[6];
}

$total=count($arr_item);
$limit=$total;

//////////////recuperar nombres de los items//////////////////
for($i=0;$i<$limit;$i++){
   $tmp=$arr_item[$i];
   $get=mysql_query("SELECT nom_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_nitem[]=$row[0];
}

/////////////////recuperar unidades de los items/////////////////////
for($i=0;$i<$limit;$i++){
   $tmp=$arr_item[$i];
   $get=mysql_query("SELECT unid_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_unid[]=$row[0];
}


$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");

?> 
<?=body_container_ini("","770","550")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>MODIFICAR COMPRA</b></font></td>
<td align="right" width="10%">
<form method="post" action="../tienda/showall_compras.php">
<input type="submit" value="Volver a lista compras" class="boton">
</form>
</td>
<form method="post" action="../index.php">
<td align="right" width="10%">
<input type="submit" name="enviar" value="INICIO" class="boton">
</form>
</td>
</tr>
</table>
<br><br><br>
<table width="50%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<?
echo"<td ALIGN=CENTER width='50%' bgcolor='#FFFFFF'><A href='ver_compra.php?cod_fac=$cod_fac' class='linktab2' title=''>DETALLE COMPRA</A></td>";
?>
<td bgcolor="#5E8CB5" width="50%"><font color="#ffffff" size="2" face="Courier New, Courier, mono"><b>MODIFICAR COMPRA</b></font></td>
</tr>
</table>

<FORM METHOD="get" NAME="form1" ACTION="mod_compra.php">
<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#e1e4f2">
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
<tr><td>&nbsp;</td></tr>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Nº COMPRA:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_fac" SIZE="10" MAXLENGTH="10" value="<?php echo"$cod_fac"; ?>" readonly></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_fac" SIZE="10" MAXLENGTH="10" value="<?php echo $fecha_fac; ?>" readonly><img src="../img/b_calendar.png" onClick='showCalendar(this, form1.fecha_fac, "yyyy-mm-dd","es",1)' title="Calendario"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">PROVEEDOR:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_pro"  value="<?php echo $cod_pro; ?>" SIZE="1" MAXLENGTH="5" readonly>&nbsp;<INPUT TYPE="text" NAME="nom_pro"  value="<?php echo $nom_pro; ?>" SIZE="33" MAXLENGTH="50" readonly><img src="../img/b_lista.gif" onclick="JavaScript:PopWindow()" title="Seleccionar de Lista"></td>
</TR> 
</TABLE>
<br>
<!-- inicio -->
<table width="20%">
<tr>
<td bgcolor="#ffffff" width="33%" colspan="3"><font color="#5E8CB5" size="2" face="Courier New, Courier, mono"><b><? echo"$limit"; ?> ARTICULOS</td>
</tr>
</table>
<?php
/////////////////////////////////////////ini/////////////////////////////////////////
///////////////asignar titulos de los campos/////////////////
	   echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=100% bgcolor=$arr_color_tabla[2] rules=ROWs frame=hsides bordercolor=#c1cdd8>
            <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>CODIGO</b></font></td>";	 
	   echo"<td align=left width=55%><font color=FFFFFF size=2><b>ARTICULO</b></font></td>";	 
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>UNIDAD</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>CANTIDAD</b></font></td>";	 	   	   
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>P.COSTO</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>P.VENTA</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>IMPORTE </b></font></td>";	 
	   echo"<td>&nbsp;</td>";	 
	   echo"</tr>";
	   $c=0;

/////////////////imprimir valores de los campos////////////////////
	   for($c=0;$c<$limit;$c++){
             echo"<tr bgcolor=$arr_color_tabla[1]>";
             echo"<td><INPUT TYPE=text NAME=cod$c SIZE=10 VALUE=$arr_item[$c] readonly></font></td>";		 
             echo"<td><INPUT TYPE=text NAME=nom$c SIZE=55 VALUE='$arr_nitem[$c]' readonly></font></td>";		 
             echo"<td><INPUT TYPE=text NAME=unid_item$c SIZE=10 VALUE=$arr_unid[$c] readonly></font></td>";		 
             echo"<td><INPUT TYPE=text NAME=cant$c SIZE=10 MAXLENGTH=10 value=$arr_cant[$c] style='text-align: right' ONCHANGE=veinte($limit);importes($limit);subtotal($limit) /></td>";
             echo"<td><INPUT TYPE=text NAME=cos$c SIZE=10 MAXLENGTH=10 value=$arr_pre[$c] style='text-align: right' ONCHANGE=veinte($limit);importes($limit);subtotal($limit)></td>";
             echo"<td><INPUT TYPE=text NAME=ven$c SIZE=10 MAXLENGTH=10 value=$arr_ven[$c] style='text-align: right' /></td>";
             echo"<td><INPUT TYPE=text NAME=imp$c SIZE=10 MAXLENGTH=10 value=$arr_imp[$c] style='text-align: right' readonly /></td>";
/////////////////////icono de funcion////////////////////////
                 $id1=$var_envio1;
                 $id2=$var_envio2;
                 printf("<td align=center><a href=\"$pag_proceso?$id1=%s&$id2=%s\"><IMG SRC=../img/boton_borrar.png BORDER=0 title='Quitar item'></a></td>
                          ", $arr_item[$c], $cod_fac, $arr_item[$c], $cod_fac);
/////////////////////////////////////////////
             echo"</tr>";
	   }

///////////////////////////////////////////////////////////////
		 echo"<tr><td>&nbsp;</td></tr>";
		 echo"<tr><td colspan=6><font size=2 color=#5E8CB5><b>Añadir item: <img src=../img/b_lista.gif onclick=JavaScript:PopWindowItem() title='Seleccionar de Lista'></b></font></td></tr>";		 
////////////////fila de incremento de item/////////////////////
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td><INPUT TYPE=text NAME=cod SIZE=10></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=nom SIZE=55 readonly></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=unid SIZE=10 readonly></font></td>";		 
	     echo"<td><INPUT TYPE=text NAME=cant SIZE=10 MAXLENGTH=10 value=0.00 align=right ONCHANGE=veinte($limit+1);importes($limit+1);subtotal($limit+1) readonly></td>";
	     echo"<td><INPUT TYPE=text NAME=cos SIZE=10 MAXLENGTH=10 value=0.00 align=right ONCHANGE=veinte($limit+1);importes($limit+1);subtotal($limit+1) readonly></td>";
         echo"<td><INPUT TYPE=text NAME=ven SIZE=10 MAXLENGTH=10 value=0.00 align=right readonly></td>";
	     echo"<td><INPUT TYPE=text NAME=imp SIZE=10 MAXLENGTH=10 value=0.00 align=right readonly></td>";
   	     echo"</tr>";
///////////////////////////////////////////////////////////////
       mysql_close($link);
       echo"</table>";
////////linea de monto total////////	   
	   echo"
	   <table width=100% cellspacing=0>
	   <tr><td width=60%>&nbsp;</td></tr>
	   <tr><td colspan=3><hr></td></tr>
	   <tr bgcolor=#ffffff>
	   <td width=60%>&nbsp;</td>
       <td align=right width=30%><font size=3 color=5e8cb5><b>Importe Total en Dolares:</font></td>		 
	   <td align=right width=10%><INPUT TYPE=text NAME=tot_fac SIZE=9 MAXLENGTH=10 value='$tot_fac' align=right readonly></td>
	   </tr>
	   </table>
	   <br><br>
	   ";
//OPCIONES INFERIORES
echo"
<INPUT TYPE=hidden NAME=limit VALUE=$limit>
<TABLE ALIGN=CENTER>
<TR>
<TD>
<center><INPUT TYPE=submit NAME=accion VALUE=Guardar class=boton></center>
</form>
</TD>
";
echo"
<form method=get action=ver_compra.php>
<TD>
<INPUT TYPE=hidden NAME=cod_fac VALUE=$cod_fac>
<input type=submit value=Terminar class=boton>
</form>
</TD>
</TR>
</TABLE>
";
/////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<br>
</td>
</tr>
</table>
<br><br><br>
<?=body_container_fin()?>