<html> 
<head> 
<title>REGISTRAR NUEVA VENTA</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript" src="calendario/calendar.js"></script>
<script language="JavaScript" type="text/javascript">
function PopWindow()
{
window.open('lista_cli_aux2.php','win','width=560,height=400,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=600');
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

function sumabultos(x){
	    var w,z,i,c;
		z=0
		for(i=2;i<=x+1;i++){
		c=(i*8)-1;
		z=z+parseFloat(window.document.form1.elements[c].value);
		}
		w=parseFloat(z);
		window.document.form1.tot_bul.value=w;
}

function t_bultos(x){
	    var w,z,i,c;
		z=0
		for(i=2;i<=x+1;i++){
		c=(i*8)-1;
		z=parseFloat(window.document.form1.elements[c+1].value) / parseFloat(window.document.form1.elements[(c-1)].value);
		w=parseFloat(z);
		window.document.form1.elements[(c)].value=w;
		}
}


function importes(x){
	    var w,z,i,c;
		z=0
		for(i=2;i<=x+1;i++){
		c=(i*8)-1;
		z=parseFloat(window.document.form1.elements[c+1].value) * parseFloat(window.document.form1.elements[(c+3)].value);
		w=parseFloat(z);
		window.document.form1.elements[(c+4)].value=w;
		}
}

function subtotal(x){
	    var w,z,i,c;
		z=0
		for(i=2;i<=x+1;i++){
		c=(i*8)-1;
		z=z+parseFloat(window.document.form1.elements[c+4].value);
		}
		w=parseFloat(z);
		window.document.form1.tot_fac.value=w;
}

function ctotal(x,y,z,a){
	    var q,r,s,t
		q = parseFloat(x) * parseFloat(a); 
		r = parseFloat(y) * parseFloat(a); 
		s = parseFloat(z) * parseFloat(a);
		w = parseFloat(a) + q + r + s;
		document.form1.costot.value=w;
}

</script>
</head> 
<?php 
include("../lib/conexion.php"); 
include("../lib/lib_consulta.php"); 
include("../lib/lib_formato.php");

$link = Conectarse("carioca");
$cod_fac = $_GET['cod_fac'];
$fecha = $_GET['fecha_fac'];
$pag_proceso = "quitar_item2.php";
$var_envio1 = "cod_item";
$var_envio2 = "cod_fac";
if(!$fecha){
$fecha_fac = date("20y-m-d");
}else{
$fecha_fac = $fecha;
}

if($cod_fac){
 $g=mysql_query("SELECT * FROM venta WHERE cod_fac='".$cod_fac."'",$link);
 $r=mysql_fetch_array($g);
 $fecha_fac=$r[1];
 $cod_cli=$r[2];
 $nom_cli=$r[3];
 $dire_cli=$r[4];
 $traspaso=$r[5];
 $tot_fac=$r[6];
 $tot_bul=$r[7];

 $a=mysql_query("SELECT * FROM venta_aux WHERE cod_fac='".$cod_fac."' ORDER BY id",$link);
 while($r=mysql_fetch_array($a)){
 $arr_item[]=$r[2];
 $arr_bul[]=$r[3];
 $arr_cant[]=$r[4];
 $arr_pre[]=$r[5];
 $arr_imp[]=$r[6];
 }

 $total=count($arr_item);
 $limit=$total;

 for($i=0;$i<$limit;$i++){
   $tmp=$arr_item[$i];
   $get=mysql_query("SELECT nom_item FROM item WHERE cod_item='".$tmp."'",$link);
   $row=mysql_fetch_array($get);
   $arr_nitem[]=$row[0];
 }

 for($i=0;$i<$limit;$i++){
   $tmp=$arr_item[$i];
   $get=mysql_query("SELECT unid_item FROM item WHERE cod_item='".$tmp."'",$link);
   $row=mysql_fetch_array($get);
   $arr_unid[]=$row[0];
 }

 for($i=0;$i<$limit;$i++){
   $tmp=$arr_item[$i];
   $get=mysql_query("SELECT caja_item FROM item WHERE cod_item='".$tmp."'",$link);
   $row=mysql_fetch_array($get);
   $arr_caja[]=$row[0];
 }

 for($i=0;$i<$limit;$i++){
   $tmp=$arr_item[$i];
   $get=mysql_query("SELECT precio_item FROM item WHERE cod_item='".$tmp."'",$link);
   $row=mysql_fetch_array($get);
   $arr_precio[]=$row[0];
 }

}else{}

$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");

?> 
<?=body_container_ini("","770","550")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>REGISTRAR NUEVA VENTA</b></font></td>
<td align="right" width="10%">
<form method="post" action="../tienda/showall_ventas.php">
<input type="submit" value="Volver a lista ventas" class="boton">
</form>
</td>
<td align="right" width="10%">
<form method="post" action="../index.php">
<input type="submit" name="enviar" value="INICIO" class="boton">
</form>
</td>
</tr>
</table>
<br><br><br>
<table width="30%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<td bgcolor="#5E8CB5" width="50%"><font color="#ffffff" size="4" face="Courier New, Courier, mono"><b>DETALLE VENTA</b></font></td>
</tr>
</table>

<form method="get" name="form1" action="chk_venta2.php">
<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#e1e4f2">
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
    <tr><td colspan="2">&nbsp;</td></tr>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Nº VENTA:</TD> 
   <td colspan="2"><input type="text" name="cod_fac" size="10" maxlength="10" required="" value="<?php echo $cod_fac; ?>"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA:</TD> 
   <td colspan="2"><input TYPE="text" name="fecha_fac" size="10" maxlength="10" value="<?php echo $fecha_fac; ?>"><img src="../img/b_calendar.png" onClick='showCalendar(this, form1.fecha_fac, "yyyy-mm-dd","es",1)' title="Calendario"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CLIENTE:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="cod_cli"  value="<?php echo $cod_cli; ?>" SIZE="1" MAXLENGTH="5">&nbsp;<INPUT TYPE="text" NAME="nom_cli"  value="<?php echo $nom_cli; ?>" SIZE="33" MAXLENGTH="50"><img src="../img/b_lista.gif" onclick="JavaScript:PopWindow()" title="Seleccionar de Lista"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">DIRECCION:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="dire_cli"  value="<?php echo $dire_cli; ?>" SIZE="100" MAXLENGTH="100"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">TRASPASO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="traspaso" SIZE="100" MAXLENGTH="100" value="<?php echo $traspaso; ?>"></td>
</TR> 
</TABLE>
<!-- inicio -->
<table width="20%">
<?php
echo"<tr><td>&nbsp;</td></tr>";
echo"<tr><td colspan=7 bgcolor=#ffffff><font size=2 color=#5E8CB5><b>Añadir artículos: <img src=../img/b_lista.gif onclick=JavaScript:PopWindowItem() title='Seleccionar de Lista'></b></font></td></tr>";		 
////////////////fila de incremento de item/////////////////////
echo"<tr bgcolor=$arr_color_tabla[1]>";
echo"<td><INPUT TYPE=text NAME=cod SIZE=10></font></td>";		 
echo"<td><INPUT TYPE=text NAME=nom SIZE=55 readonly></font></td>";		 
//         echo"<td><INPUT TYPE=text NAME=unid SIZE=10 readonly></font></td>";		 
echo"<td><INPUT TYPE=text NAME=bul SIZE=10 MAXLENGTH=10 value=0.00 align=right readonly></font></td>";		 
echo"<td><INPUT TYPE=text NAME=cant SIZE=10 MAXLENGTH=10 value=0.00 align=right readonly></td>";
echo"<td><INPUT TYPE=text NAME=cos SIZE=10 MAXLENGTH=10 value=0.000 align=right readonly></td>";
echo"<td><INPUT TYPE=text NAME=imp SIZE=10 MAXLENGTH=10 value=0.000 align=right readonly></td>";
echo"</tr>";
?>
<tr><td colspan="7">&nbsp;</td></tr>
<tr>
<td bgcolor="#ffffff" width="33%" colspan="8"><font color="#5E8CB5" size="2" face="Courier New, Courier, mono"><b><?php echo"$limit"; ?> ARTICULOS</td>
</tr>
</table>
<?php
/////////////////////////////////////////ini/////////////////////////////////////////

/*   if (!$total){
   echo"
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td><font size=2 color=ffffff><b>NO EXISTE NINGUN REGISTRO</font></td></tr>
   </table>
   ";
   }
   else{*/
	   echo"<TABLE border=0 CELLSPACING=0 CELLPADDING=0 align=center width=100% bgcolor=$arr_color_tabla[2] rules=ROWs frame=hsides bordercolor=#c1cdd8>
            <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left width=10%><font color=FFFFFF size=2><b>CODIGO</b></font></td>";	 
	   echo"<td align=left width=41%><font color=FFFFFF size=2><b>ARTICULO</b></font></td>";	 
	   echo"<td align=right width=15%><font color=FFFFFF size=2><b>C.CAJA</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>T.BULTOS</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>CANTIDAD</b></font></td>";	 	   	   
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>P.C.</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>P.V.</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>IMPORTE</b></font></td>";	 
	   echo"<td>&nbsp;</td>";	 
	   echo"</tr>";
	   $c=0;

	   for($c=0;$c<$limit;$c++){
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td><INPUT TYPE=text NAME=cod$c SIZE=10 VALUE=$arr_item[$c] readonly></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=nom$c SIZE=55 VALUE='$arr_nitem[$c]' readonly></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=unid_item$c SIZE=10 VALUE=$arr_caja[$c] align=right ONCHANGE=sumabultos($limit); readonly></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=bul$c SIZE=10 VALUE=$arr_bul[$c] align=right ONCHANGE=sumabultos($limit); readonly></font></td>";		
	     echo"<td><INPUT TYPE=text NAME=cant$c SIZE=10 MAXLENGTH=10 value=$arr_cant[$c] align=right ONCHANGE=importes($limit);subtotal($limit);t_bultos($limit);sumabultos($limit);></td>";
		 $tmp=$arr_precio[$c]*1.40;
	     echo"<td><INPUT TYPE=text NAME=cs$c SIZE=10 MAXLENGTH=10 value=$tmp align=right ONCHANGE=importes($limit);subtotal($limit); readonly></td>";
	     echo"<td><INPUT TYPE=text NAME=cos$c SIZE=10 MAXLENGTH=10 value=$arr_pre[$c] align=right ONCHANGE=importes($limit);subtotal($limit);></td>";
	     echo"<td><INPUT TYPE=text NAME=imp$c SIZE=10 MAXLENGTH=10 value=$arr_imp[$c] align=right readonly></td>";
/////////////////////icono de funcion////////////////////////
		 $id1=$var_envio1;
		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso?$id1=%s&$id2=%s\"><IMG SRC=../img/boton_borrar.png BORDER=0 title='Quitar item'></a></td>
			  ", $arr_item[$c], $cod_fac, $arr_item[$c], $cod_fac);
/////////////////////////////////////////////
   	     echo"</tr>";
	   }

///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
       mysql_close($link);
       echo"</table>";

if (!$tot_bul){
    $tot_bul = 0;
}       

if (!$tot_fac){
    $tot_fac = 0;
}
       
echo"
<table border=0 width=100% cellspacing=0>
<tr><td colspan=6><hr></td></tr>
<tr bgcolor=#ffffff>
<td align=right width=33%>&nbsp;</td>		 
<td align=right width=16%><font size=3 color=5e8cb5><b>Total bultos:</font></td>		 
<td align=left width=10%><INPUT TYPE=text NAME=tot_bul SIZE=10 MAXLENGTH=10 value='$tot_bul' align=right readonly></td>
<td align=right width=20%><font size=3 color=5e8cb5><b>Importe total:</font></td>		 
<td align=right width=10%><INPUT TYPE=text NAME=tot_fac SIZE=10 MAXLENGTH=10 value='$tot_fac' align=right readonly></td>
<td align=right width=1%>&nbsp;</td>		 
</tr>
</table>
<br><br>
";
echo"
<INPUT TYPE=hidden NAME=limit VALUE=$limit>
<TABLE ALIGN=CENTER>
<TR>
<TD>
<input type='hidden' name='vartest' value='101' />
<center><INPUT TYPE='submit' NAME='accion' VALUE='Guardar' class='boton'></center>
</form>
</TD>
";
echo"
<form method=get action=showall_ventas.php>
<TD>
<INPUT TYPE=hidden NAME=cod_fac VALUE=$cod_fac>
<input type=submit value=Terminar class=boton>
</form>
</TD>
</TR>
</TABLE>
";
//}
/////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<br>
</td>
</tr>
</table>
<br><br><br>
<?=body_container_fin()?>