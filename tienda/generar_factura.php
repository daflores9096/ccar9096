<html> 
<head> 
<title>NOTA DE COMPRA</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script language="JavaScript" src="calendario/javascripts.js"></script>
<script> 
function uno(src,color_entrada) { 
    src.bgColor=color_entrada;src.style.cursor="";
} 
function dos(src,color_default) { 
    src.bgColor=color_default;src.style.cursor="default"; 
} 

function sumcant(x){
	    var w,z,i,c;
		z=0
		for(i=1;i<=x;i++){
		c=(i*4);
		z=z+parseFloat(window.document.form1.elements[c].value);
		}
		w=parseFloat(z);
		window.document.form1.cant_res.value=w;
}

function importes(x){
	    var w,z,i,c;
		z=0
		for(i=1;i<=x;i++){
		c=(i*4)+1;
		z=parseFloat(window.document.form1.elements[c].value) * parseFloat(window.document.form1.elements[(c+1)].value);
		w=parseFloat(z);
		window.document.form1.elements[(c+2)].value=w;
		}
}

function subtotal(x){
	    var w,z,i,c;
		z=0
		for(i=1;i<=x;i++){
		c=(i*4)+1;
		z=z+parseFloat(window.document.form1.elements[c+2].value);
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

$link=Conectarse("carioca");
$cod_fac = $_GET['cod_fac'];
$fecha_fac = $_GET['fecha_fac'];
$cod_pro = $_GET['cod_pro'];
$nom_pro = $_GET['nom_pro'];
$numreg=$_GET['total'];
$total=$numreg;

$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");


$limit=0;

   for($i=0;$i<$numreg;$i++){
   $tmp="id$i";
   $cod=$_GET[$tmp];
     if($cod!=""){
      $arr_cod[]=$cod;
	  $limit=$limit+1;
     }else {}
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT nom_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_insum[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT unid_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_unid[]=$row[0];
   }

   for($i=0;$i<$limit;$i++){
   $tmp=$arr_cod[$i];
   $get=mysql_query("SELECT precio_item FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
   $arr_precio[]=$row[0];
   }


?> 
<?=body_container_ini("","770","550")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>ENTRADAS POR COMPRA</b></font></td>
<td align="right" width="10%">
<form method="post" action="../tienda/nueva_compra.php">
<input type="button" value="<< Atras" onClick="history.go(-1)" class="boton">
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
<table width="25%" bgcolor="#5E8CB5">
<tr align="center" bgcolor="#FFFFFF">
<td bgcolor="#5E8CB5" width="33%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>NOTA DE COMPRA</td>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="e1e4f2">
<br>
<form method="get" name="form1" action="chk_compra.php">
<br>
<TABLE border="0" cellpadding="1" cellspacing="2" width="70%"> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">Nº COMPRA:</TD> 
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
	   echo"<TABLE CELLSPACING=0 CELLPADDING=0 align=center width=100% bgcolor=$arr_color_tabla[2] rules=ROWs frame=hsides bordercolor=#c1cdd8>
            <tr bgcolor=$arr_color_tabla[0]>";
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>CODIGO</a></font></td>";	 
	   echo"<td align=left width=55%><font color=FFFFFF size=2><b>ARTICULO</a></font></td>";	 
	   echo"<td align=left width=15%><font color=FFFFFF size=2><b>UNIDAD</a></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>CANTIDAD</a></font></td>";	 	   	   
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>COSTO U.</a></font></td>";	 
	   echo"<td align=right width=10%><font color=FFFFFF size=2><b>IMPORTE </a></font></td>";	 
	   echo"</tr>";
	   $c=0;

	   for($c=0;$c<$limit;$c++){
	     echo"<tr bgcolor=$arr_color_tabla[1]>";
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_cod[$c]<INPUT TYPE=hidden NAME=cod$c VALUE=$arr_cod[$c]></font></td>";		 
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_insum[$c]</font></td>";		 
         echo"<td align=left><font size=2 color=$arr_color_texto[1]>$arr_unid[$c]</font></td>";		 
	     echo"<td><INPUT TYPE=text NAME=cant$c SIZE=10 MAXLENGTH=10 value=0.00 align=right ONCHANGE=importes($limit);subtotal($limit)></td>";
	     echo"<td><INPUT TYPE=text NAME=cos$c SIZE=10 MAXLENGTH=10 value=$arr_precio[$c] align=right ONCHANGE=importes($limit);subtotal($limit)></td>";
	     echo"<td><INPUT TYPE=text NAME=imp$c SIZE=10 MAXLENGTH=10 value=0.00 align=right readonly></td>";
   	     echo"</tr>";
	   }
       mysql_close($link);
       echo"</table>";
	   
	   echo"
	   <table width=100% cellspacing=0>
	   <tr><td width=60%>&nbsp;</td></tr>
	   <tr><td colspan=3><hr></td></tr>
	   <tr bgcolor=#ffffff>
	   <td width=60%>&nbsp;</td>
       <td align=right width=10%><font size=2 color=5e8cb5><b>TOTAL:</font></td>		 
	   <td align=right width=10%><INPUT TYPE=text NAME=tot_fac SIZE=9 MAXLENGTH=10 value=0.00 align=right readonly></td>
	   </tr>
	   </table>


	   <br><br>
	   
	   ";
echo"
<INPUT TYPE=hidden NAME=limit VALUE=$limit>
";

echo"<center><INPUT TYPE=submit NAME=accion VALUE=Guardar class=boton></center>";
echo"</form>";

}

//////////////////////////////////////////////////////fin///////////////////////////////////////////
?>
<!-- fin -->
<br>
<br>
</td>
</tr>
</table>
<br><br><br>
<?=body_container_fin()?>