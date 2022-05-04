<?php
//////////////////////////////////////////////////////////////////////////////////////
function paginacion_orden($total,$pp,$st,$url,$orderby='',$orden='',$extra='') {

$page_nav = "";
$page_first = "";
$page_previous = "";

if($total>$pp) {
$resto=$total%$pp;
if($resto==0) {
$pages=$total/$pp;
} else {
$pages=(($total-$resto)/$pp)+1;
}
 
if($pages>10) {
$current_page=($st/$pp)+1;
if($st==0) {
$first_page=0;
$last_page=10;
} else if($current_page>=5 && $current_page<=($pages-5)) {
$first_page=$current_page-5;
$last_page=$current_page+5;
} else if($current_page<5) {
$first_page=0;
$last_page=$current_page+5+(5-$current_page);
} else {
$first_page=$current_page-5-(($current_page+5)-$pages);
$last_page=$pages;
}
} else {
$first_page=0;
$last_page=$pages;
}
 
for($i=$first_page;$i< $last_page;$i++) {
$pge=$i+1;
$nextst=$i*$pp;
if($st==$nextst) {
$page_nav .= '<b>['.$pge.']';
} else {
$page_nav .= ' <a href="'.$url.$nextst.'&orderby='.$orderby.'&orden='.$orden.'&extra='.$extra.'" class="linknave"> <b>'.$pge.'</b></a>';
}
}
 
if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }
 
if($current_page< $pages) {
$page_last = '<b>[<a href="'.$url.($pages-1)*$pp.'&orderby='.$orderby.'&orden='.$orden.'&extra='.$extra.'" class="linknave"> Ultima Pag</a>]';
$page_next = '[<a href="'.$url.$current_page*$pp.'&orderby='.$orderby.'&orden='.$orden.'&extra='.$extra.'" class="linknave"> > </a>]';
}
 
if($st>0) {
$page_first = '<b>[<a href="'.$url.'0'.'&orderby='.$orderby.'&orden='.$orden.'&extra='.$extra.'" class="linknave"> Primera Pag </a>]</a>';
$page_previous = '[<a href="'.$url.''.($current_page-2)*$pp.'&orderby='.$orderby.'&orden='.$orden.'&extra='.$extra.'" class="linknave"> < </a>]';
}
}
 
return "$page_first $page_previous $page_nav $page_next $page_last";
} 

//////////////////////////////////////////////////////////////////////////////////////
function paginacion($total,$pp,$st,$url,$orderby='',$orden='') {

if($total>$pp) {
$resto=$total%$pp;
if($resto==0) {
$pages=$total/$pp;
} else {
$pages=(($total-$resto)/$pp)+1;
}
 
if($pages>10) {
$current_page=($st/$pp)+1;
if($st==0) {
$first_page=0;
$last_page=10;
} else if($current_page>=5 && $current_page<=($pages-5)) {
$first_page=$current_page-5;
$last_page=$current_page+5;
} else if($current_page<5) {
$first_page=0;
$last_page=$current_page+5+(5-$current_page);
} else {
$first_page=$current_page-5-(($current_page+5)-$pages);
$last_page=$pages;
}
} else {
$first_page=0;
$last_page=$pages;
}
 
for($i=$first_page;$i< $last_page;$i++) {
$pge=$i+1;
$nextst=$i*$pp;
if($st==$nextst) {
$page_nav .= '<b>['.$pge.']';
} else {
$page_nav .= ' <a href="'.$url.$nextst.'"> <b>'.$pge.'</b></a>';
}
}
 
if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }
 
if($current_page< $pages) {
$page_last = '<b>[<a href="'.$url.($pages-1)*$pp.'"> Ultima Pag</a>]';
$page_next = '[<a href="'.$url.$current_page*$pp.'"> > </a>]';
}
 
if($st>0) {
$page_first = '<b>[<a href="'.$url.'0'.'"> Primera Pag </a>]</a></b>';
$page_previous = '[<a href="'.$url.''.($current_page-2)*$pp.'"> < </a>]';
}
}
 
return "$page_first $page_previous $page_nav $page_next $page_last";
} 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NOMBRE: consulta_simple($db,$tabla,$color_titulos, $color1,$color2)
//
// ENTRADA:
// $db = nombre de la base de datos a la que se accedera.
// $tabla = nombre de la tabla de la cual se sacaran los resultados.
// $orderby = nombre del campo que se usara como criterio para ordenar los resultados.
// $arr_campos = lista de los campos que se quieren desplegar, no importa cuantos ni el orden.
// $arr_titulos = lista de los titulos que se quiere desplegar para cada campo. "El orden debe ser igual al de $arr_capos"
// $color1 = 1er color en hexadecimal, para el combinado de la tabla
// $color2 = 2do color en hexadecimal, para el combinado de la tabla
//
// SALIDA:
// Devuelve una tabla con una combinacion de 2 colores, con todos los registros y sus campos obtenidos sin excepcion
// no hay ninguna funcion especial, solo se despliega lo que hay en la tabla.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_simple($db, $tabla, $color_titulos, $color1='', $color2=''){
   //include("../lib/conexion.php");
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   if ($numreg==0){
   echo"
   <table align=center bgcolor=#ffffff>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=90%>
	   <tr bgcolor=$color_titulos>";
	   for($c=0;$c<$numcam;$c++){
	   $campo_titulo=mysql_field_name($result,$c);
	   $arr_campos[]=$campo_titulo;
	   echo"<td align=center><font color=ffffff size=3><b>$campo_titulo</font></td>";
	   }
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1>";
		 for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2>";
		  for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table>";
   }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Nombre: consulta_funcion1($db, $tabla,$orderby='', $arr_campos, $arr_titulos, $color_titulo='', $color1='', $color2='', $var_envio, $pag_proceso, $icono, $funcion)
//
// ENTRADA:
// $db = nombre de la base de datos a la que se accedera.
// $tabla = nombre de la tabla de la cual se sacaran los resultados.
// $orderby = nombre del campo que se usara como criterio para ordenar los resultados.
// $arr_campos = lista de los campos que se quieren desplegar, no importa cuantos ni el orden.
// $arr_titulos = lista de los titulos que se quiere desplegar para cada campo. "El orden debe ser igual al de $arr_capos"
// $color_titulo = color en hexadecimal que tendra el fondo de los titulos en la tabla.
// $color1 = 1er color en hexadecimal para la combinacion de colores al desplegar la tabla.
// $color2 = 2er color en hexadecimal para la combinacion de colores al desplegar la tabla.
// $var_envio = nombre del campo que se enviara como parametro a la pagina de proceso.
// $pag_proceso = nombre del archivo "ruta o path" /dir/.php al que se enviara la variable para su uso posterior.
// $icono = nombre del archivo "ruta o path" .jpg, .gif o .png imagen que se usara como icono al desplegar los resultados en la tabla.
// $funcion = nombre de la funcion que se realizara cada boton al desplegar la tabla.
//
// SALIDA:
// Se genera una tabla con una combinacion de 2 colores con los resultados de la consulta y adicionalmente un icono para cada registro
// o fila, que enviara un dato o variable a otra pagina de proceso.
//
// SCRIPT EXTRA:
// Este script es necesario para obtener el efecto de cursor en los registro de la tabla, asi que hay que copiarlo
// dentro de <HEAD></HEAD>
/*
<script>
function uno(src,color_entrada) {
    src.bgColor=color_entrada;src.style.cursor="";
}
function dos(src,color_default) {
    src.bgColor=color_default;src.style.cursor="default";
}
</script>
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_funcion1($db, $tabla,$orderby='', $arr_campos, $arr_titulos, $color_titulo='', $color1='', $color2='', $var_envio, $pag_proceso, $icono, $funcion){
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;

   if ($numreg==0){
   echo"
   <table align=center bgcolor=#ffffff>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=#ffffff>
	   <tr bgcolor=$color_titulo>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=yellow size=1><b>$funcion</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color1');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color2');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table>";
   }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NOMBRE: consulta_funcion2($db, $tabla,$orderby='', $arr_campos, $arr_titulos, $color_titulo='', $color1='', $color2='', $var1_envio, $var2_envio, $pag_proceso1, $pag_proceso2, $icono1, $icono2, $funcion1,$funcion2)
//
// SALIDA:
// Se genera una tabla con una combinacion de 2 colores con los resultados de la consulta y adicionalmente 2 iconos para cada registro
// o fila, que enviara un dato o variable a otra pagina de proceso.
// Similar a consulta_funcion1, pero con la diferencia de generar 2 botones a los que se les puede asignar
// diferentes funciones p.ej: borrar, modificar, detalle, etc.
// En este caso se pueden asignar 2 variables de envio hacia 2 paginas de proceso diferentes, o se puede
// asignar la misma variable a las 2 paginas de proceso, dependiendo del caso.
//
// SCRIPT EXTRA:
// Al igual que en consulta_funcion1, este script es necesario para obtener el efecto de cursor en los registro de la tabla,
//asi que hay que copiarlo dentro de la etiqueta <HEAD></HEAD>
/*
<script>
function uno(src,color_entrada) {
    src.bgColor=color_entrada;src.style.cursor="";
}
function dos(src,color_default) {
    src.bgColor=color_default;src.style.cursor="default";
}
</script>
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_funcion2($db, $tabla,$orderby='', $arr_campos, $arr_titulos, $color_titulo='', $color1='', $color2='', $var1_envio, $var2_envio, $pag_proceso1, $pag_proceso2, $icono1, $icono2, $funcion1,$funcion2){
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;

   if ($numreg==0){
   echo"
   <table align=center>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=#ffffff>
	   <tr bgcolor=$color_titulo>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=yellow size=1><b>$funcion1</font></td>";
	   echo"<td width=5%><font color=yellow size=1><b>$funcion2</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color1');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var1_envio;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);
		 $id2=$var2_envio;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);

/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color2');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var1_envio;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var2_envio;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table>";
   }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NOMBRE: gen_conf_del($db,$tb,$indcom,$indtb,$pag_del,$pag_back)
//
// ENTRADA:
// $db = Base de Datos.
// $tb = nombre de la tabla.
// $indcom = nombre de "la variable enviada de una pagina anterior" para comparar(Normalmente la clave principal).
// $indtb = nombre del campo de la tabla para comparar, este campo debe tener el mismo nombre que el de la
// 			la variable que se envio de la pagina anterior,(normalmente la clave principal).
// $pag_del = Nombre del archivo .php o la pagina que borrara el registro.
// $pag_back = Nombre de la pagina a la que se regresara en caso de no borrar nada.
//
// SALIDA:
// genera una pagina de confirmacion de borrado de un registro, se despliega antes un detalle del mismo y se da la
// opcion a borrarlo o no.
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function gen_conf_del($db, $tb, $indcom, $indtb, $pag_del, $pag_back){
   include("../lib/conexion.php");
   $link=Conectarse("$db");
   echo"<center><font size=3 color=red><b>¿Confirma que desea liminar el siguiente registro?</center>";
   echo"<BR>";

   $result=mysql_query("SELECT * FROM $tb WHERE $indtb='$indcom'",$link);
   $row=mysql_fetch_array($result);
   $numcam=mysql_num_fields($result);
   $field=mysql_field_name($result,0);

echo"<form method=get action=$pag_del>";
echo"<table border=0 cellpadding=1 cellspacing=2 align=center width=100%>";
   for($i=0;$i<$numcam;$i++){
   $fld=mysql_field_name($result,$i);
   echo"<tr>";
   echo"<td bgcolor=5e8cb5 width=20%><font color=ffffff size=2><b>$fld:</font></td>";
   echo"<td bgcolor=ffffff width=80%>$row[$i]</td>";
   ///////////////////////
   echo"<input type=hidden name=campo$i value=$row[$i]>";
   //////////////////////
   echo"</tr>";
   }
echo"</table>";
echo"</form>";

echo"
<br>
<TABLE ALIGN=center>
<tr><td>
<form method=get action=$pag_del>
<input type=hidden name=id value=$indcom>
<input type=submit name=enviar value=Si class=boton>
</form>
</td><td>
<form method=get action=$pag_back>
<input type=button value=No onclick=history.go(-1) class=boton>
</form>
</td></tr>
</TABLE>
";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NOMBRE: gen_form_edit($db,$tb,$indcom,$indtb,$pag_mod,$pag_back)
//
// ENTRADA:
// $db = Base de Datos.
// $tb = nombre de la tabla.
// $indcom = nombre de "la variable enviada de una pagina anterior" para comparar(Normalmente la clave principal).
// $indtb = nombre del campo de la tabla para comparar, este campo debe tener el mismo nombre que el de la
// 			la variable que se envio de la pagina anterior,(normalmente la clave principal).
// $pag_mod = Nombre del archivo .php o la pagina que modificara el registro.
// $pag_back = Nombre de la pagina a la que se regresara en caso de no modificar nada.
//
// SALIDA:
// genera una pagina que despliega los campos del registro, con la posibilidad de modificarlos o dejarlos intactos
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function gen_form_edit($db, $tb, $indcom, $indtb, $pag_mod, $pag_back){
   include("../lib/conexion.php");
   $link=Conectarse("$db");
   echo"<center><font size=3 color=red><b>Modificar los datos del registro</center>";
   echo"<BR>";

   $result=mysql_query("SELECT * FROM $tb WHERE $indtb='$indcom'",$link);
   $row=mysql_fetch_array($result);
   $numcam=mysql_num_fields($result);
   $field=mysql_field_name($result,0);

   echo"<table border=0 cellpadding=1 cellspacing=2 align=center>";
   echo"<form method=get action=$pag_mod>";
   for($i=0;$i<$numcam;$i++){
   $fld=mysql_field_name($result,$i);
   echo"<tr>";
   echo"<td bgcolor=5e8cb5 width=20%><font color=ffffff size=2><b>$fld:</font></td>";
   echo"<td bgcolor=ebf3f7><INPUT TYPE=text NAME=$fld SIZE=50 MAXLENGTH=500 value='$row[$i]'></td>";
   echo"</tr>";
   }
   echo"</table>";
   echo"<br>";
   echo"<TABLE ALIGN=center>";
   echo"<tr><td>";
   echo"<input type=hidden name=ide value=$row[0]>";
   echo"<input type=submit name=enviar value=Si class=boton>";
   echo"</form>";
   echo"</td><form method=get action=$pag_back><td>";
   echo"<input type=button value=No onclick=history.go(-1) class=boton>";
   echo"</td></form></tr>";
   echo"</TABLE>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NOMBRE: consulta_paginada_simple($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$pag_ini,$tam_pag)
//
// ENTRADA:
// $db = nombre de la base de datos a la que se accedera.
// $tabla = nombre de la tabla de la cual se sacaran los resultados.
// $orderby = nombre del campo que se usara como criterio para ordenar los resultados.
// $arr_campos = lista de los campos que se quieren desplegar, no importa cuantos ni el orden.
// $arr_titulos = lista de los titulos que se quiere desplegar para cada campo. "El orden debe ser igual al de $arr_capos"
// $arr_color_tabla = array de 4 colores en hexadecimal que deben tener la sgte forma:
//					  array(color_fondo_titulo, color_fondo_resultados1, color_fondo_resultados2, color_fondo_navegador de paginas)
// $arr_color_texto = array de 3 colores en hexadecimal que deben tener la sgte forma:
//					  array(color_texto_titulo, color_texto_resultados, color_texto_navegador de paginas)
// $pag_ini = nombre del archivo "ruta o path" /dir/.php del archivo que despliega los resultados paginados(normalmente el
//            archivo .php que contiene a esta funcion, esto por la razon de que se reenvian datos al navegar por las paginas de resultados).
// $pag_tam = Numero de resultados que se despliegan por pagina.
//
// SALIDA:
// Se genera una tabla con una combinacion de 2 colores en los resultados paginados de la consulta.
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_paginada_simple($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$pag_ini,$tam_pag){
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   $registros = $tam_pag;
   $pagina = $_GET["pagina"];

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}
$result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby LIMIT $inicio, $registros",$link);
$total_paginas = ceil($numreg / $registros);

   if (!$numreg){
   echo"
   <table align=center bgcolor=#ffffff width=50%>
   <tr bgcolor=$arr_color_tabla[0]><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2]>
	   <tr bgcolor=$arr_color_tabla[0]>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b>$campo_titulo</font></td>";
	   }
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table><br>";
   }
////////////////////////////////////
	if($numreg) {

		echo "<center>";

		if(($pagina - 1) > 0) {
			echo "<a href='$pag_ini?pagina=".($pagina-1)."'><font color=$arr_color_texto[2]>[Anterior]</font></a> ";
		}

		for ($i=1; $i<=$total_paginas; $i++){
			if ($pagina == $i)
				echo "<b><font color=#5e8cb5>".$pagina."</font></b> ";
			else
				echo "<a href='$pag_ini?pagina=$i'><font color=$arr_color_texto[2]>$i</font></a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
			echo " <a href='$pag_ini?pagina=".($pagina+1)."'><font color=$arr_color_texto[2]>[Siguiente]</font></a>";
		}

		echo "</center>";

	}

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NOMBRE: consulta_paginada_funcion1($db,$tabla,$orderby='',$arr_campos='',$arr_titulos,$arr_color_tabla='',$arr_color_texto='',$var_envio,$pag_proceso,$icono,$funcion,$pag_ini,$tam_pag)
//
// ENTRADA:
// $db = nombre de la base de datos a la que se accedera.
// $tabla = nombre de la tabla de la cual se sacaran los resultados.
// $orderby = nombre del campo que se usara como criterio para ordenar los resultados.
// $arr_campos = lista de los campos que se quieren desplegar, no importa cuantos ni el orden.
// $arr_titulos = lista de los titulos que se quiere desplegar para cada campo. "El orden debe ser igual al de $arr_capos"
// $arr_color_tabla = array de 4 colores en hexadecimal que deben tener la sgte forma:
//					  array(color_fondo_titulo, color_fondo_resultados1, color_fondo_resultados2, color_fondo_navegador de paginas)
// $arr_color_texto = array de 3 colores en hexadecimal que deben tener la sgte forma:
//					  array(color_texto_titulo, color_texto_resultados, color_texto_navegador de paginas)
// $var_envio = nombre del campo que se enviara como parametro a la pagina de proceso.
// $pag_proceso = nombre del archivo "ruta o path" /dir/.php al que se enviara la variable para su uso posterior.
// $icono = nombre del archivo "ruta o path" .jpg, .gif o .png imagen que se usara como icono al desplegar los resultados en la tabla.
// $funcion = nombre de la funcion que se realizara cada boton al desplegar la tabla.
// $pag_ini = nombre del archivo "ruta o path" /dir/.php del archivo que despliega los resultados paginados(normalmente el
//            archivo .php que contiene a esta funcion, esto por la razon de que se reenvian datos al navegar por las paginas de resultados).
// $pag_tam = Numero de resultados que se despliegan por pagina.
//
// SALIDA:
// Se genera una tabla con una combinacion de 2 colores en los resultados de la consulta y adicionalmente un icono para cada registro
// o fila, que enviara un dato o variable a otra pagina de proceso.
//
// SCRIPT EXTRA:
// Este script es necesario para obtener el efecto de cursor en los registro de la tabla, asi que hay que copiarlo
// dentro de <HEAD></HEAD>
/*
<script>
function uno(src,color_entrada) {
    src.bgColor=color_entrada;src.style.cursor="";
}
function dos(src,color_default) {
    src.bgColor=color_default;src.style.cursor="default";
}
</script>
*/
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_paginada_funcion1($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='', $var_envio, $pag_proceso, $icono, $funcion,$pag_ini,$tam_pag){
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   $registros = $tam_pag;
   $pagina = $_GET["pagina"];

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}
$result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby LIMIT $inicio, $registros",$link);
$total_paginas = ceil($numreg / $registros);

   if (!$numreg){
   echo"
   <table align=center bgcolor=#ffffff>
   <tr bgcolor=$arr_color_tabla[0]><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2]>
	   <tr bgcolor=$arr_color_tabla[0]>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table><br>";
   }
////////////////////////////////////
	if($numreg) {

		echo "<center>";

		if(($pagina - 1) > 0) {
			echo "<a href='$pag_ini?pagina=".($pagina-1)."'><font color=$arr_color_texto[2]>[Anterior]</font></a> ";
		}

		for ($i=1; $i<=$total_paginas; $i++){
			if ($pagina == $i)
				echo "<b><font color=#5e8cb5>".$pagina."</font></b> ";
			else
				echo "<a href='$pag_ini?pagina=$i'><font color=$arr_color_texto[2]>$i</font></a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
			echo " <a href='$pag_ini?pagina=".($pagina+1)."'><font color=$arr_color_texto[2]>[Siguiente]</font></a>";
		}

		echo "</center>";

	}

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NOMBRE: consulta_paginada_funcion2($db, $tabla,$orderby, $arr_campos, $arr_titulos, $arr_color_tabla, $arr_color_texto, $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag)
//
// ENTRADA:
// $db = nombre de la base de datos a la que se accedera.
// $tabla = nombre de la tabla de la cual se sacaran los resultados.
// $orderby = nombre del campo que se usara como criterio para ordenar los resultados.
// $arr_campos = lista de los campos que se quieren desplegar, no importa cuantos ni el orden.
// $arr_titulos = lista de los titulos que se quiere desplegar para cada campo. "El orden debe ser igual al de $arr_capos"
// $arr_color_tabla = array de 4 colores en hexadecimal que deben tener la sgte forma:
//					  array(color_fondo_titulo, color_fondo_resultados1, color_fondo_resultados2, color_fondo_navegador de paginas)
// $arr_color_texto = array de 3 colores en hexadecimal que deben tener la sgte forma:
//					  array(color_texto_titulo, color_texto_resultados, color_texto_navegador de paginas)
// $var_envio1 = nombre del campo que se enviara como parametro a la pagina de proceso 1.
// $var_envio2 = nombre del campo que se enviara como parametro a la pagina de proceso 2.
// $pag_proceso1 = nombre del archivo "ruta o path" /dir/.php al que se enviara la variable1 para su uso posterior.
// $pag_proceso2 = nombre del archivo "ruta o path" /dir/.php al que se enviara la variable2 para su uso posterior.
// $icono1 = nombre del archivo "ruta o path" .jpg, .gif o .png imagen que se usara como icono1 al desplegar los resultados en la tabla.
// $icono2 = nombre del archivo "ruta o path" .jpg, .gif o .png imagen que se usara como icono2 al desplegar los resultados en la tabla.
// $funcion1 = nombre de la funcion1 que se realizara cada boton al desplegar la tabla.
// $funcion2 = nombre de la funcion2 que se realizara cada boton al desplegar la tabla.
// $pag_ini = nombre del archivo "ruta o path" /dir/.php del archivo que despliega los resultados paginados(normalmente es el
//            archivo .php que contiene a esta funcion, esto por la razon de que se reenvian datos al navegar por las paginas de resultados).
// $pag_tam = Numero de resultados que se despliegan por pagina.
//
// SALIDA:
// Se genera una tabla con una combinacion de 2 colores en los resultados de la consulta y adicionalmente un icono para cada registro
// o fila, que enviara un dato o variable a otra pagina de proceso.
//
// SCRIPT EXTRA:
// Este script es necesario para obtener el efecto de cursor en los registro de la tabla, asi que hay que copiarlo
// dentro de <HEAD></HEAD>
/*
<script>
function uno(src,color_entrada) {
    src.bgColor=color_entrada;src.style.cursor="";
}
function dos(src,color_default) {
    src.bgColor=color_default;src.style.cursor="default";
}
</script>
*/
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_paginada_funcion2($db, $tabla,$orderby='', $arr_campos='', $arr_titulos='', $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag){
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   $registros = $tam_pag;
   $pagina = $_GET["pagina"];

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}
$result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby LIMIT $inicio, $registros",$link);
$total_paginas = ceil($numreg / $registros);

   if (!$numreg){
   echo"
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2]>
	   <tr bgcolor=$arr_color_tabla[0]>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion1</font></td>";
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion2</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);

/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table><br>";
   }
////////////////////////////////////
	if($numreg) {

		echo "<center>";

		if(($pagina - 1) > 0) {
			echo "<a href='$pag_ini?pagina=".($pagina-1)."'><font color=$arr_color_texto[2]>[Anterior]</font></a> ";
		}

		for ($i=1; $i<=$total_paginas; $i++){
			if ($pagina == $i)
				echo "<b><font color=#5e8cb5>".$pagina."</font></b> ";
			else
				echo "<a href='$pag_ini?pagina=$i'><font color=$arr_color_texto[2]>$i</font></a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
			echo " <a href='$pag_ini?pagina=".($pagina+1)."'><font color=$arr_color_texto[2]>[Siguiente]</font></a>";
		}

		echo "</center>";

	}

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_buscar($db, $tabla,$orderby='', $arr_campos='', $arr_titulos='', $arr_color_tabla='', $arr_color_texto='', $var_envio, $pag_proceso, $icono, $funcion,$pag_ini,$tam_pag,$criterio,$clave){
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla WHERE $criterio LIKE '%$clave%'",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   $registros = $tam_pag;
   $pagina = $_GET["pagina"];

$cr=$criterio;
$cl=$clave;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}
$result=mysql_query("SELECT * FROM $tabla WHERE $criterio LIKE '%$clave%' LIMIT $inicio, $registros",$link);
$total_paginas = ceil($numreg / $registros);

   if (!$numreg || $numcam==0 || $clave=''){
   echo"
   <table align=center bgcolor=#ffffff>
   <tr bgcolor=$arr_color_tabla[0]><td><font color=$arr_color_texto[0] size=2><b>Su busqueda no genero ningun resultado... por favor vuelva a intentar</font></td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2]>
	   <tr bgcolor=$arr_color_tabla[0]>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table><br>";
   }
////////////////////////////////////
	if($numreg) {

		echo "<center>";

		if(($pagina - 1) > 0) {
			echo "<a href='$pag_ini?pagina=".($pagina-1)."&clave=".$cl."&criterio=".$cr."'><font color=$arr_color_texto[2]>[Anterior]</font></a> ";
		}

		for ($i=1; $i<=$total_paginas; $i++){
			if ($pagina == $i)
				echo "<b><font color=$arr_color_texto[0]>".$pagina."</font></b> ";
			else
				echo "<a href='$pag_ini?pagina=$i&clave=".$cl."&criterio=".$cr."'><font color=$arr_color_texto[2]>$i</font></a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
			echo " <a href='$pag_ini?pagina=".($pagina+1)."&clave=".$cl."&criterio=".$cr."'><font color=$arr_color_texto[2]>[Siguiente]</font></a>";
		}

		echo "</center>";

	}

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_entre_fechas_detalle($db, $tabla, $orderby,$identificador,$fecha1, $fechamin,$fechamax, $pag_deta, $color1='', $color2='',$icono){
   //include("../lib/conexion.php");
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla WHERE $fecha1>='$fechamin' AND $fecha1<='$fechamax' ORDER BY $orderby",$link);
//   $result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   if ($numreg==0){
   echo"
   <table align=center bgcolor=ffffff>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=0 align=center width=100% bgcolor=ffffff>
	   <tr bgcolor=6699cc>";
	   for($c=0;$c<$numcam;$c++){
	   $campo_titulo=mysql_field_name($result,$c);
	   $arr_campos[]=$campo_titulo;
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=yellow size=1><b>Detalle</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color1');>";
		 for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
//		 $id=mysql_field_name($result,0);
		 $id=$identificador;
		 printf("<td align=center><a href=\"$pag_deta?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=Detalle></a></td>
			  ", $row[$id], $row[$id]);
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color2');>";
		  for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
//		 $id=mysql_field_name($result,0);
		 $id=$identificador;
		 printf("<td align=center><a href=\"$pag_deta?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=Detalle></a></td>
			  ", $row[$id], $row[$id]);
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table>";
   }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function gen_form_detalle($db, $tb, $indcom, $indtb, $pag_mod){
   include("../lib/conexion.php");
   $link=Conectarse("$db");
   echo"<center><font size=3 color=red><b>Detalle de los datos</center>";
   echo"<BR>";

   $result=mysql_query("SELECT * FROM $tb WHERE $indtb='$indcom'",$link);
   $row=mysql_fetch_array($result);
   $numcam=mysql_num_fields($result);
   $field=mysql_field_name($result,0);

   echo"<table border=0 cellpadding=1 cellspacing=2 align=center>";
   echo"<form method=get action=$pag_mod>";
   for($i=0;$i<$numcam;$i++){
   $fld=mysql_field_name($result,$i);
   echo"<tr>";
   echo"<td bgcolor=5e8cb5 width=20%><font color=ffffff size=2><b>$fld:</font></td>";
   echo"<td bgcolor=ebf3f7><INPUT readonly NAME=$fld SIZE=50 MAXLENGTH=500 value='$row[$i]'></td>";
   echo"</tr>";
   }
  echo"</table>";
	echo"<br>";
   echo"<TABLE ALIGN=center>";
   echo"<tr><td>";
   echo"<input type=hidden name=ide value=$row[0]>";
   echo"<input type=submit name=enviar value=Cancelar class=boton>";
   echo"</form>";
   echo"</td></tr>";
   echo"</TABLE>";
}
//////////////////////////////////////////////////////////////////////////
function consulta_paginada_funcion2_1($db, $tabla, $where,$orderby='', $arr_campos='', $arr_titulos='', $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag){

	if ($_GET["where"]!="")
    {
        //echo $_GET["where"];
        $where= $_GET["where"];
        $where=str_replace("\'","'", $where);
        //echo "<br>";
        $criterio=$where;

    }
    else
    	$criterio = $where;
   //echo $criterio;
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla WHERE $where ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   $registros = $tam_pag;
   $pagina = $_GET["pagina"];

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}
$result=mysql_query("SELECT * FROM $tabla WHERE $where ORDER BY $orderby LIMIT $inicio, $registros",$link);
$total_paginas = ceil($numreg / $registros);

   if (!$numreg){
   echo"
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2]>
	   <tr bgcolor=$arr_color_tabla[0]>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion1</font></td>";
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion2</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);

/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table><br>";
   }
////////////////////////////////////
	if($numreg) {

		echo "<center>";

		if(($pagina - 1) > 0)
        {
			echo "<a href=\"".$pag_ini."?pagina=".($pagina-1)."&where=".$criterio."\"><font color=$arr_color_texto[2]>[Anterior]</font></a> ";
		}

		for ($i=1; $i<=$total_paginas; $i++){
			if ($pagina == $i)
				echo "<b><font color=#5e8cb5>".$pagina."</font></b> ";
			else
            	echo "<a href=\"".$pag_ini."?pagina=".$i."&where=".$criterio."\"><font color=$arr_color_texto[2]>".$i."</font></a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
			echo " <a href=\"".$pag_ini."?pagina=".($pagina+1)."&where=".$criterio."\"><font color=$arr_color_texto[2]>[Siguiente]</font></a>";
		}

		echo "</center>";

	}

}
/////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_paginada_funcion2box($db, $tabla,$orderby='', $arr_campos='', $arr_titulos='', $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $pag_proceso3, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag){
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   $registros = $tam_pag;
   $pagina = $_GET["pagina"];

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}
$result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby LIMIT $inicio, $registros",$link);
$total_paginas = ceil($numreg / $registros);

   if (!$numreg){
   echo"
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
   echo"<form name=f1 method=get action=$pag_proceso3>";
       echo"<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#c1cdd8>
	   <tr bgcolor=$arr_color_tabla[0]>";
/*ln*/ echo"<td align=center width=8%><font color=$arr_color_texto[2] size=1><a href=javascript:seleccionar_todo()><font size=2><img border=0 src=../img/b_checked.png alt=Marcar Todos><a href=javascript:deseleccionar_todo()><font size=2> <img border=0 src=../img/b_nchecked.png alt=Marcar Todos></font></a></td>";
	   for($c=1;$c<$num+1;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion1</font></td>";
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion2</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
/*line*/ echo"<td align=center><input type=checkbox name=id$cont value=$row[$var_envio1]></td>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);

/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
/*line*/ echo"<td align=center><input type=checkbox name=id$cont value=$row[$var_envio2]></td>";
 	     for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT='$funcion1'></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT='$funcion2'></a></td>
			  ", $row[$id2], $row[$id2]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table><br>";
   }
////////////////////////////////////
	if($numreg) {

		echo "<center>";

		if(($pagina - 1) > 0) {
			echo "<a href='$pag_ini?pagina=".($pagina-1)."'><font color=$arr_color_texto[2]>[Anterior]</font></a> ";
		}

		for ($i=1; $i<=$total_paginas; $i++){
			if ($pagina == $i)
				echo "<b><font color=#5e8cb5>".$pagina."</font></b> ";
			else
				echo "<a href='$pag_ini?pagina=$i'><font color=$arr_color_texto[2]>$i</font></a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
			echo " <a href='$pag_ini?pagina=".($pagina+1)."'><font color=$arr_color_texto[2]>[Siguiente]</font></a>";
		}

		echo "</center>";

	}
	  echo"<br>";
      echo"<INPUT TYPE=hidden name=tampag value=$tam_pag></center>";
      echo"
	  <table>
	  <tr>
	  <td><font size=2 color=5e8cb5>Registros marcados:</font></td>
	  <td><INPUT TYPE=IMAGE SRC=../img/boton_borrar.png border=1 bordercolor=#5e8cb5></td>
	  </tr>
	  </table>
	  ";
	  echo"</form>";

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function gen_form_edit_granja($db, $tb, $indcom, $indtb, $pag_mod, $pag_back){
   include("../lib/conexion.php");
   $link=Conectarse("$db");
   echo"<center><font size=3 color=red><b>Modificar los datos del registro</center>";
   echo"<BR>";

   $result=mysql_query("SELECT * FROM $tb WHERE $indtb='$indcom'",$link);
   $row=mysql_fetch_array($result);
   $numcam=mysql_num_fields($result);
   $field=mysql_field_name($result,0);

   echo"<table border=0 cellpadding=1 cellspacing=2 align=center>";
   echo"<form method=get action=$pag_mod>";
   for($i=0;$i<$numcam;$i++){
   $fld=mysql_field_name($result,$i);
   echo"<tr>";
   echo"<td bgcolor=5e8cb5 width=20%><font color=ffffff size=2><b>$fld:</font></td>";
   if($fld=='numgalpones')
   		echo"<td bgcolor=ebf3f7><INPUT readonly TYPE=text NAME=$fld SIZE=50 MAXLENGTH=500 value='$row[$i]'></td>";
   else
   		echo"<td bgcolor=ebf3f7><INPUT TYPE=text NAME=$fld SIZE=50 MAXLENGTH=500 value='$row[$i]'></td>";
   echo"</tr>";
   }
   echo"</table>";
   echo"<br>";
   echo"<TABLE ALIGN=center>";
   echo"<tr><td>";
   echo"<input type=hidden name=ide value=$row[0]>";
   echo"<input type=submit name=enviar value=Si class=boton>";
   echo"</form>";
   echo"</td><form method=get action=$pag_back><td>";
//   echo"<form method=get action=$pag_back>";
   echo"<input type=button value=No onclick=history.go(-1) class=boton>";
   echo"</form>";
   echo"</td></tr>";
   echo"</TABLE>";
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_paginada_funcion2box_where($db, $tabla,$where,$orderby='', $arr_campos='', $arr_titulos='', $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $pag_proceso3, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag){
	if ($_GET["where"]!="")
    {
        //echo $_GET["where"];
        $where= $_GET["where"];
        $where=str_replace("\'","'", $where);
        //echo "<br>";
        $criterio=$where;

    }
    else
    	$criterio = $where;
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla WHERE $where ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   $registros = $tam_pag;
   $pagina = $_GET["pagina"];

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}
$result=mysql_query("SELECT * FROM $tabla WHERE $where ORDER BY $orderby LIMIT $inicio, $registros",$link);
$total_paginas = ceil($numreg / $registros);

   if (!$numreg){
   echo"
   <table align=center bgcolor=$arr_color_tabla[2]>
   <tr bgcolor=$arr_color_tabla[0]><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
   echo"<form name=f1 method=get action=$pag_proceso3>";
       echo"<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#c1cdd8>
	   <tr bgcolor=$arr_color_tabla[0]>";
/*ln*/ echo"<td align=center width=8%><font color=$arr_color_texto[2] size=1><a href=javascript:seleccionar_todo()><font size=2><img border=0 src=../img/b_checked.png alt=Marcar Todos><a href=javascript:deseleccionar_todo()><font size=2> <img border=0 src=../img/b_nchecked.png alt=Marcar Todos></font></a></td>";
	   for($c=1;$c<$num+1;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion1</font></td>";
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion2</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
/*line*/ echo"<td align=center><input type=checkbox name=id$cont value=$row[$var_envio1]></td>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);

/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
/*line*/ echo"<td align=center><input type=checkbox name=id$cont value=$row[$var_envio2]></td>";
 	     for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 ALT='$funcion1'></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 ALT='$funcion2'></a></td>
			  ", $row[$id2], $row[$id2]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table><br>";
   }
////////////////////////////////////
	if($numreg) {

		echo "<center>";

        if(($pagina - 1) > 0)
        {
			echo "<a href=\"".$pag_ini."?pagina=".($pagina-1)."&where=".$criterio."\"><font color=$arr_color_texto[2]>[Anterior]</font></a> ";
		}

		for ($i=1; $i<=$total_paginas; $i++){
			if ($pagina == $i)
				echo "<b><font color=#5e8cb5>".$pagina."</font></b> ";
			else
            	echo "<a href=\"".$pag_ini."?pagina=".$i."&where=".$criterio."\"><font color=$arr_color_texto[2]>".$i."</font></a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
			echo " <a href=\"".$pag_ini."?pagina=".($pagina+1)."&where=".$criterio."\"><font color=$arr_color_texto[2]>[Siguiente]</font></a>";
		}

		echo "</center>";

	}
      echo"<br>";
      echo"<INPUT TYPE=hidden name=tampag value=$tam_pag></center>";
      echo"
	  <table>
	  <tr>
	  <td><font size=2 color=5e8cb5>Registros marcados:</font></td>
	  <td><INPUT TYPE=IMAGE SRC=../img/boton_borrar.png border=1 bordercolor=#5e8cb5></td>
	  </tr>
	  </table>
	  ";
	  echo"</form>";

}
///////////////////////////////////////////////////////////////////////////
function consulta_paginada_funcion1_1($db, $tabla,$where,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='', $var_envio,$varadi, $pag_proceso, $icono, $funcion,$pag_ini,$tam_pag){
   $link=Conectarse("$db");
   $result=mysql_query("SELECT * FROM $tabla WHERE $where ORDER BY $orderby",$link);
   $num=count($arr_campos);
   $numreg=mysql_num_rows($result);
   $numcam=mysql_num_fields($result);
   $cont=0;
   $registros = $tam_pag;
   $pagina = $_GET["pagina"];

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}
$result=mysql_query("SELECT * FROM $tabla WHERE $where ORDER BY $orderby LIMIT $inicio, $registros",$link);
$total_paginas = ceil($numreg / $registros);

   if (!$numreg){
   echo"
   <table align=center bgcolor=#ffffff>
   <tr bgcolor=$arr_color_tabla[0]><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2]>
	   <tr bgcolor=$arr_color_tabla[0]>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	   echo"</tr>";
       while($row = mysql_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$varadi&$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$varadi&$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($result);
       mysql_close($link);
       echo"</table><br>";
   }
////////////////////////////////////
	if($numreg) {

		echo "<center>";

		if(($pagina - 1) > 0) {
			echo "<a href='$pag_ini?pagina=".($pagina-1)."'><font color=$arr_color_texto[2]>[Anterior]</font></a> ";
		}

		for ($i=1; $i<=$total_paginas; $i++){
			if ($pagina == $i)
				echo "<b><font color=#5e8cb5>".$pagina."</font></b> ";
			else
				echo "<a href='$pag_ini?pagina=$i'><font color=$arr_color_texto[2]>$i</font></a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
			echo " <a href='$pag_ini?pagina=".($pagina+1)."'><font color=$arr_color_texto[2]>[Siguiente]</font></a>";
		}

		echo "</center>";

	}

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function gen_form_edit_combo($db, $tb, $indcom, $indtb,$combo, $pag_mod, $pag_back){
   include("../lib/conexion.php");
   $link=Conectarse("$db");
   echo"<center><font size=3 color=red><b>Modificar los datos del registro</center>";
   echo"<BR>";

   $result=mysql_query("SELECT * FROM $tb WHERE $indtb='$indcom'",$link);
   $row=mysql_fetch_array($result);
   $numcam=mysql_num_fields($result);
   $field=mysql_field_name($result,0);

   echo"<table border=0 cellpadding=1 cellspacing=2 align=center>";
   echo"<form method=get action=$pag_mod>";
   for($i=0;$i<$numcam;$i++)
   {
   $fld=mysql_field_name($result,$i);
   if($fld==$combo)
   {
    echo"<tr>";
   	echo"<td bgcolor=5e8cb5 width=20%><font color=ffffff size=2><b>$fld:</font></td>";
   	echo"<td bgcolor=ebf3f7>
    <select name=$fld>
    <option value='$row[$i]'>$row[$i]</option>
    <option value='activo'>activo</option>
    <option value='inactivo'>inactivo</option>
    </select>
    </td>";
   	echo"</tr>";
   }
   else
   {
   	echo"<tr>";
   	echo"<td bgcolor=5e8cb5 width=20%><font color=ffffff size=2><b>$fld:</font></td>";
   	echo"<td bgcolor=ebf3f7><INPUT TYPE=text NAME=$fld SIZE=50 MAXLENGTH=500 value='$row[$i]'></td>";
   	echo"</tr>";
   }
   }
   echo"</table>";
   echo"<br>";
   echo"<TABLE ALIGN=center>";
   echo"<tr><td>";
   echo"<input type=hidden name=ide value=$row[0]>";
   echo"<input type=submit name=enviar value=Si class=boton>";
   echo"</form>";
   echo"</td><form method=get action=$pag_back><td>";
   echo"<input type=button value=No onclick=history.go(-1) class=boton>";
   echo"</td></form></tr>";
   echo"</TABLE>";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_simple($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$pag_ini,$tam_pag,$extra_dat=''){
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla",$link);
$num=count($arr_campos);
$total=mysql_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orderby= $_GET['orderby'];
$orden = $_GET['orden'];

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
	     $orderby=$arr_campos[0];
		 $orden="ASC";
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
	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>| $campo_titulo $dir</a></font></td>";	 
	 }else{
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>| $campo_titulo</a></font></td>";
      }
	 }
	 echo"</tr>";
	   
	   while($row = mysql_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
		 $tmp=$row[$cam];
		 $t=strlen($tmp);
		 $tmpos=strpos($tmp,".");
		   if(($t - $tmpos)!=3){
		   echo"<td align=left><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		   }else echo"<td align=right><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";

		 }
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
		   if(($t - $tmpos)!=3){
		   echo"<td align=left><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		   }else echo"<td align=right><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";

		 }
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($get);
       mysql_close($link);
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
//echo paginacion($total, $pp, $st,$pag);
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

   }

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion1($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$var_envio,$pag_proceso,$icono,$funcion,$pag_ini,$tam_pag){
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla",$link);
$num=count($arr_campos);
$total=mysql_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orderby= $_GET['orderby'];
$orden = $_GET['orden'];

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
	     $orderby=$arr_campos[0];
		 $orden="ASC";
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
/*echo"Total registros: $total <br>";
echo"Ordenado por: $orderby <br>";
echo"Orden: $orden <br>";*/
	
//	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' limit '.$st.','.$pp);
	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>| $campo_titulo $dir</a></font></td>";	 
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>| $campo_titulo</a></font></td>";
      }

	 }
     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	 echo"</tr>";
	   
	   while($row = mysql_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='$funcion'></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='$funcion'></a></td>
			  ", $row[$id], $row[$id]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($get);
       mysql_close($link);
       echo"</table><br>";

echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
//echo paginacion($total, $pp, $st,$pag);
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

   }

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion2($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag){
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla",$link);
$num=count($arr_campos);
$total=mysql_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orderby= $_GET['orderby'];
$orden = $_GET['orden'];

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
	     $orderby=$arr_campos[0];
		 $orden="ASC";
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
echo"Total registros: $total <br>";
echo"Ordenado por: $orderby <br>";
echo"Orden: $orden <br>";
	
//	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' limit '.$st.','.$pp);
	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>| $campo_titulo $dir</a></font></td>";	 
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>| $campo_titulo</a></font></td>";
      }
	 }
     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion1</font></td>";
	 echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion2</font></td>";

	 echo"</tr>";
	   
	   while($row = mysql_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 title=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 title=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);

/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 title=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 title=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($get);
       mysql_close($link);
       echo"</table><br>";

echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
//echo paginacion($total, $pp, $st,$pag);
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  
 }

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion2box($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $pag_proceso3, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag){
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla",$link);
$num=count($arr_campos);
$total=mysql_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
$orderby= $_GET['orderby'];
$orden = $_GET['orden'];

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
	     $orderby=$arr_campos[0];
		 $orden="ASC";
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
echo"Total registros: $total <br>";
echo"Ordenado por: $orderby <br>";
echo"Orden: $orden <br>";
	
//	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' limit '.$st.','.$pp);
	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);

/*ln*/ echo"<form name=f1 method=get action=$pag_proceso3>";
	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
/*ln*/ echo"<td align=center width=8%><font color=$arr_color_texto[2] size=1><a href=javascript:seleccionar_todo()><font size=2><img border=0 src=../img/b_checked.png title=Marcar Todos><a href=javascript:deseleccionar_todo()><font size=2> <img border=0 src=../img/b_nchecked.png alt=Marcar Todos></font></a></td>";
     for($c=1;$c<$num+1;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $t=$c-1;
     $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>| $campo_titulo $dir</a></font></td>";	 
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>| $campo_titulo</a></font></td>";
      }	 }
     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion1</font></td>";
	 echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion2</font></td>";

	 echo"</tr>";
	   
	   while($row = mysql_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
/*line*/ echo"<td align=center><input type=checkbox name=id$cont value=$row[$var_envio1]></td>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 title=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 title=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);

/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
/*line*/ echo"<td align=center><input type=checkbox name=id$cont value=$row[$var_envio2]></td>";
  	     for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$id1=%s\"><IMG SRC=$icono1 BORDER=0 title=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$id2=%s\"><IMG SRC=$icono2 BORDER=0 title=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysql_free_result($get);
       mysql_close($link);
       echo"</table><br>";

echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
//echo paginacion($total, $pp, $st,$pag);
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

/*ln /////////////////////////////*/
	  echo"<br>";
      echo"<INPUT TYPE=hidden name=tampag value=$tam_pag></center>";
      echo"
	  <table>
	  <tr>
	  <td><font size=2 color=5e8cb5>Registros marcados:</font></td>
	  <td><INPUT TYPE=IMAGE SRC=$icono1 border=1 bordercolor=#5e8cb5 title=$funcion1></td>
	  </tr>
	  </table>
	  ";
	  echo"</form>";
/*ln /////////////////////////////*/	  
   }
}

?>
