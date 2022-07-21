<html> 
<head> 
<title>REGISTRAR NUEVA COMPRA</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript" src="calendario/calendar.js"></script>
<script language="JavaScript" type="text/javascript">
function PopWindow()
{
window.open('lista_pro_aux2.php','win','width=500,height=400,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=600');
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
		for(i=2;i<=x+1;i++){
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
		for(i=2;i<=x+1;i++){
		c=(i*7);
		z=parseFloat(window.document.form1.elements[c].value) * parseFloat(window.document.form1.elements[(c+2)].value);
		w=parseFloat(z);
		window.document.form1.elements[(c+3)].value=w;
		}
}

function subtotal(x){
	    var w,z,i,c;
		z=0
		for(i=2;i<=x+1;i++){
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

if (isset($_GET['cod_fac'])){
    $cod_fac=$_GET['cod_fac'];
} else {
    $cod_fac="";
}

if (isset($_GET['fecha_fac'])){
    $fecha=$_GET['fecha_fac'];
} else {
    $fecha=date("Y-m-d");
}

$lado="left";
$pag_proceso="quitar_item3.php";
$var_envio1="cod_item";
$var_envio2="cod_fac";
if(!$fecha){
$fecha_fac=date("20y-m-d");
}else{
$fecha_fac=$fecha;
}

if($cod_fac){
 $g=mysqli_query($link, "SELECT * FROM compra WHERE cod_fac=$cod_fac");
 $r=mysqli_fetch_array($g);
 $fecha_fac=$r[1];
 $cod_pro=$r[2];
 $nom_pro=$r[3];
 $tot_fac=$r[4];

 $a=mysqli_query($link,"SELECT * FROM compra_aux WHERE cod_fac=$cod_fac ORDER BY id");
 while($r=mysqli_fetch_array($a)){
 $arr_item[]=$r[2];
 $arr_cant[]=$r[3];
 $arr_pre[]=$r[4];
 $arr_ven[]=$r[5];
 $arr_imp[]=$r[6];
 }

if (isset($arr_item)){
    $total=count($arr_item);
} else {
    $total=0;
}

if(!$total){
$limit=0;
}else $limit=$total;

 for($i=0;$i<$limit;$i++){
   $tmp=$arr_item[$i];
   $get=mysqli_query($link,"SELECT nom_item FROM item WHERE cod_item='$tmp'");
   $row=mysqli_fetch_array($get);
   $arr_nitem[]=$row[0];
 }

 for($i=0;$i<$limit;$i++){
   $tmp=$arr_item[$i];
   $get=mysqli_query($link,"SELECT unid_item FROM item WHERE cod_item='$tmp'");
   $row=mysqli_fetch_array($get);
   $arr_unid[]=$row[0];
 }
}else{
    $limit=0;
    $tot_fac=0;
    $cod_pro="";
    $nom_pro="";

}

$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");

?> 
<?=body_container_ini("","770","550")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>REGISTRAR NUEVA COMPRA</b></font></td>
<td align="right" width="10%">
<form method="post" action="../tienda/showall_compras.php">
<input type="submit" value="Volver a lista compras" class="boton">
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
<td bgcolor="#5E8CB5" width="50%"><font color="#ffffff" size="4" face="Courier New, Courier, mono"><b>DETALLE COMPRA</b></font></td>
</tr>
</table>

<FORM METHOD="get" NAME="form1" ACTION="chk_compra2.php">
<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="#e1e4f2">
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
<tr><td>&nbsp;</td></tr>
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">N. COMPRA:</TD>
   <td colspan="2"><INPUT TYPE="text" NAME="cod_fac" SIZE="10" MAXLENGTH="10" required="" value="<?php echo $cod_fac; ?>"></td>
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
<!-- inicio -->
<table>
<?php
		 echo"<tr><td>&nbsp;</td></tr>";
		 echo"<tr><td colspan=7 bgcolor=#ffffff><font size=2 color=#5E8CB5><b>Agregar art&iacute;culos: <img src=../img/b_lista.gif width=15 height=15 onclick=JavaScript:PopWindowItem() title='Seleccionar de Lista'></b></font></td></tr>";
        //fila de incremento de item
	     echo"<tr bgcolor=#ffffff>";
         echo"<td><INPUT TYPE=text NAME=cod SIZE=10></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=nom SIZE=55 readonly></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=unid SIZE=10 readonly></font></td>";		 
	     echo"<td><INPUT TYPE=text NAME=cant SIZE=10 MAXLENGTH=10 value=0.000 align=right readonly></td>";
	     echo"<td><INPUT TYPE=text NAME=cos SIZE=10 MAXLENGTH=10 value=0.000 align=right readonly></td>";
	     echo"<td><INPUT TYPE=text NAME=ven SIZE=10 MAXLENGTH=10 value=0.000 align=right readonly></td>";
	     echo"<td><INPUT TYPE=text NAME=imp SIZE=10 MAXLENGTH=10 value=0.000 align=right readonly></td>";
   	     echo"</tr>";
?>
<tr><td colspan="7">&nbsp;</td></tr>
<tr>
<td bgcolor="#ffffff" width="35%" colspan="7"><font color="#5E8CB5" size="2" face="Courier New, Courier, mono"><b><? echo"$limit"; ?> ARTICULOS</td>
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
	   echo"<td align=left width=10%><font color=FFFFFF size=2><b>&nbsp;CODIGO&nbsp;</b></font></td>";	 
	   echo"<td align=left width=41%><font color=FFFFFF size=2><b>&nbsp;ARTICULO&nbsp;</b></font></td>";	 
	   echo"<td align=left width=10%><font color=FFFFFF size=2><b>&nbsp;UNIDAD&nbsp;</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>&nbsp;CANTIDAD&nbsp;</b></font></td>";	 	   	   
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>&nbsp;P.COSTO&nbsp;</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>&nbsp;P.VENTA&nbsp;</b></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>&nbsp;IMPORTE&nbsp;</b></font></td>";	 
	   echo"<td width=2%>&nbsp;</td>";	 
	   echo"</tr>";
	   $c=0;

	   for($c=0;$c<$limit;$c++){
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td><INPUT TYPE=text NAME=cod$c SIZE=10 VALUE=$arr_item[$c] readonly></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=nom$c SIZE=55 VALUE='$arr_nitem[$c]' readonly></font></td>";		 
         echo"<td><INPUT TYPE=text NAME=unid_item$c SIZE=10 VALUE=$arr_unid[$c] readonly></font></td>";		 
	     echo"<td><INPUT TYPE=text NAME=cant$c SIZE=10 MAXLENGTH=10 value=$arr_cant[$c] align=right ONCHANGE=veinte($limit);importes($limit);subtotal($limit);></td>";
	     echo"<td><INPUT TYPE=text NAME=cos$c SIZE=10 MAXLENGTH=10 value=$arr_pre[$c] align=right ONCHANGE=veinte($limit);importes($limit);subtotal($limit);></td>";
	     echo"<td><INPUT TYPE=text NAME=ven$c SIZE=10 MAXLENGTH=10 value=$arr_ven[$c] align=right></td>";
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
       mysqli_close($link);
       
       if (!$tot_fac){
           $tot_fac = 0;
       }
       echo"</table>";
	   
	   echo"
	   <table width=100% cellspacing=0>
	   <tr><td colspan=3><hr></td></tr>
	   <tr bgcolor=#ffffff>
	   <td width=60%>&nbsp;</td>
       <td align=right width=30%><font size=3 color=5e8cb5><b>Total Importe en Dolares:</font></td>		 
	   <td align=right width=10%><INPUT TYPE=text NAME=tot_fac SIZE=9 MAXLENGTH=10 value='$tot_fac' align=right readonly></td>
	   </tr>
	   </table>
	   <br>
	   ";
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
<form method=get action=showall_compras.php>
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
<br><br><br><br>
<?=body_container_fin()?>