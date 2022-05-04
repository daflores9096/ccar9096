<?php
/********************************************************************
* Nombre de la Funcion: consulta_field($db,$tabla,$orderby,$arr_campos,$color1,$color2)
* $db : Base de Datos
* $tabla: nombre de la tabla
* $orderby: Nombre del campo para ordenar
* $arr_campos: Array con los campos que se van a mostrar
* $color1: 1er color en hexadecimal, para el combinado de la tabla
* $color2: 2do color en hexadecimal, para el combinado de la tabla
* Salida: devuelve una tabla con una combinacion de 2 colores, con todos 
          los registros obtenidos, segun los campos ingresados ordenados 
		  de acuerdo a $orderby
*********************************************************************/
function consulta_field($db, $tabla,$orderby='', $arr_campos, $arr_titulos, $color1='', $color2=''){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query($link,"SELECT * FROM $tabla ORDER BY $orderby");
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $fd0=mysqli_field_name($result,0);
   $fd1=mysqli_field_name($result,1);
   $fd2=mysqli_field_name($result,2);
//   $fd3=mysql_field_name($result,3);      
   $cont=0;
//   echo"Num Registros: $numreg <br>"; 
//   echo"Num Campos: $num <br>"; 
//   echo"Num Campos: $fd0,--- $fd1,--- $fd2,--- $fd3";

   if ($numreg==0){
   return "<tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=70%>
	   <tr bgcolor=6699cc>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}
/********************************************************************
* Nombre de la Funcion: consulta_modificar($db,$tabla,$color1,$color2)
* $db : Base de Datos
* $tabla: nombre de la tabla
* $pagina: pagina a la que se envia la peticion de borrado o modificacion
* $color1: 1er color en hexadecimal, para el combinado de la tabla
* $color2: 2do color en hexadecimal, para el combinado de la tabla
* Salida: devuelve una tabla con una combinacion de 2 colores, con todos 
          los registros obtenidos con opciones para modificar o borrar
		  de acuerdo al requerimiento.
*********************************************************************/
function consulta_modificar($db, $tabla, $pag_del, $pag_mod, $color1='', $color2=''){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query($link,"SELECT * FROM $tabla");
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $cont=0;
   if ($numreg==0){
   echo"
   <table align=center>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=90%>
	   <tr bgcolor=6699CC>";
	   for($c=0;$c<$numcam;$c++){
	   $campo_titulo=mysqli_field_name($result,$c);
	   $arr_campos[]=$campo_titulo;
	   echo"<td align=center><font color=ffffff size=3><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=yellow size=1><b>borrar</font></td>";
	   echo"<td width=5%><font color=yellow size=1><b>modif</font></td>";
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color1');>";
		 for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 $id=mysqli_field_name($result,0);
		 printf("<td align=center><a href=\"$pag_del?$id=%s\"><IMG SRC=../img/b_borrar.png BORDER=0 ALT=Borrar></a></td>
			  ", $row[$id], $row[$id]);
		 printf("<td align=center><a href=\"$pag_mod?$id=%s\"><IMG SRC=../img/b_edit.png BORDER=0 ALT=Modificar></a></td>
			  ", $row[$id], $row[$id]);			  
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color2');>";
		  for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 $id=mysqli_field_name($result,0);
		 printf("<td align=center><a href=\"$pag_del?$id=%s\"><IMG SRC=../img/b_borrar.png BORDER=0 ALT=Borrar></a></td>
			  ", $row[$id], $row[$id]);
		 printf("<td align=center><a href=\"$pag_mod?$id=%s\"><IMG SRC=../img/b_edit.png BORDER=0 ALT=Modificar></a></td>
			  ", $row[$id], $row[$id]);			  
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}
/********************************************************************
* Nombre de la Funcion: consulta_modificar_orderby($db,$tabla,$color1,$color2)
* $db : Base de Datos
* $tabla: nombre de la tabla
* $pagina: pagina a la que se envia la peticion de borrado o modificacion
* $color1: 1er color en hexadecimal, para el combinado de la tabla
* $color2: 2do color en hexadecimal, para el combinado de la tabla
* Salida: devuelve una tabla con una combinacion de 2 colores, con todos 
          los registros obtenidos con opciones para modificar o borrar
		  de acuerdo al requerimiento.
*********************************************************************/
function consulta_modificar_orderby($db, $tabla, $orderby, $pag_del, $pag_mod, $color1='', $color2=''){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query($link,"SELECT * FROM $tabla ORDER BY $orderby");
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $cont=0;
   if ($numreg==0){
   echo"
   <table align=center>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=90%>
	   <tr bgcolor=6699CC>";
	   for($c=0;$c<$numcam;$c++){
	   $campo_titulo=mysqli_field_name($result,$c);
	   $arr_campos[]=$campo_titulo;
	   echo"<td align=center><font color=ffffff size=3><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=yellow size=1><b>borrar</font></td>";
	   echo"<td width=5%><font color=yellow size=1><b>modif</font></td>";
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color1');>";
		 for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 $id=mysqli_field_name($result,0);
		 printf("<td align=center><a href=\"$pag_del?$id=%s\"><IMG SRC=../img/b_borrar.png BORDER=0 ALT=Borrar></a></td>
			  ", $row[$id], $row[$id]);
		 printf("<td align=center><a href=\"$pag_mod?$id=%s\"><IMG SRC=../img/b_edit.png BORDER=0 ALT=Modificar></a></td>
			  ", $row[$id], $row[$id]);			  
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color2');>";
		  for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 $id=mysqli_field_name($result,0);
		 printf("<td align=center><a href=\"$pag_del?$id=%s\"><IMG SRC=../img/b_borrar.png BORDER=0 ALT=Borrar></a></td>
			  ", $row[$id], $row[$id]);
		 printf("<td align=center><a href=\"$pag_mod?$id=%s\"><IMG SRC=../img/b_edit.png BORDER=0 ALT=Modificar></a></td>
			  ", $row[$id], $row[$id]);			  
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}

/********************************************************************
* Nombre de la Funcion: gen_conf_del($db,$tb,$indcom,$indtb,$pag_del,$pag_back)
* $db : Base de Datos
* $tb: nombre de la tabla
* $indcom: nombre del campo para comparar(Normalmente la clave principal)
* $indtb: nombre del campo de la tabla(Normalmente la clave principal)
* $pag_del: Nombre de la pagina que borrara el registro
* $pag_back: Nombre de la pagina a la que se regresara en caso de no borrar nada
* Salida: genera una pagina de confirmacion de borrado de un registro
		  de acuerdo al requerimiento.
*********************************************************************/
function gen_conf_del($db, $tb, $indcom, $indtb, $pag_del, $pag_back){
   include("../lib/conexion.php"); 
   $link=Conectarse("$db"); 
   echo"<center><font size=3 color=red><b>¿Esta seguro que desea eliminar el siguiente registro?</center>";  
   echo"<BR><BR>";

   $result=mysqli_query($link,"SELECT * FROM $tb WHERE $indtb='$indcom'");
   $row=mysqli_fetch_array($result);
   $numcam=mysqli_num_fields($result);
   $field=mysqli_field_name($result,0);

echo"<form method=get action=$pag_del>";
echo"<table border=0 cellpadding=1 cellspacing=2 align=center width=40%>";
   for($i=0;$i<$numcam;$i++){
   $fld=mysqli_field_name($result,$i);
   echo"<tr>";
   echo"<td bgcolor=5e8cb5 width=30%><font color=ffffff size=2><b>$fld:</font></td>";
   echo"<td bgcolor=ebf3f7 width=70%>$row[$i]</td>";
   ///////////////////////
   echo"<input type=hidden name=campo$i value=$row[$i]>";
   //////////////////////
   echo"</tr>";
   }
echo"</table>";
echo"</form>";

   echo"<BR><hr width=500>";
   echo"<TABLE ALIGN=center>";
   echo"<tr><td>";
   echo"<form method=get action=$pag_del>";
   echo"<input type=hidden name=id value=$indcom>";
   echo"<input type=submit name=enviar value=Si class=boton>";
   echo"</form>";
   echo"</td><td>";   
   echo"<form method=get action=$pag_back>";
   echo"<input type=submit name=enviar value=No class=boton>";
   echo"</form>";
   echo"</td></tr>";
   echo"</TABLE>";
}
//--------------------------------------------------------
/********************************************************************
* Nombre de la Funcion: gen_form_edit($db,$tb,$indcom,$indtb,$pag_mod,$pag_back)
* $db : Base de Datos
* $tb: nombre de la tabla
* $indcom: nombre del campo para comparar(Normalmente la clave principal)
* $indtb: nombre del campo de la tabla(Normalmente la clave principal)
* $pag_mod: Nombre de la pagina que modificara el registro
* $pag_back: Nombre de la pagina a la que se regresara en caso de no modificar nada
* Salida: genera una pagina de modificacion de un registro listo para modificarse
		  en un formulario.
*********************************************************************/
function gen_form_edit($db, $tb, $indcom, $indtb, $pag_mod, $pag_back){
   include("../lib/conexion.php"); 
   $link=Conectarse("$db"); 
   echo"<center><font size=3 color=red><b>Modificar los datos del registro</center>";  
   echo"<BR><BR>";

   $result=mysqli_query($link,"SELECT * FROM $tb WHERE $indtb='$indcom'");
   $row=mysqli_fetch_array($result);
   $numcam=mysqli_num_fields($result);
   $field=mysqli_field_name($result,0);

   echo"<table border=0 cellpadding=1 cellspacing=2 align=center>";
   echo"<form method=get action=$pag_mod>";
   for($i=0;$i<$numcam;$i++){
   $fld=mysqli_field_name($result,$i);
   echo"<tr>";
   echo"<td bgcolor=5e8cb5 width=20%><font color=ffffff size=2><b>$fld:</font></td>";
   echo"<td bgcolor=ebf3f7><INPUT TYPE=text NAME=$fld SIZE=50 MAXLENGTH=50 value='$row[$i]'></td>";
   echo"</tr>";
   }
  echo"</table>";
	echo"<br>";
   echo"<TABLE ALIGN=center>";
   echo"<tr><td>";
   echo"<input type=hidden name=ide value=$row[0]>";
   echo"<input type=submit name=enviar value=Aceptar class=boton>";
   echo"</form>";
   echo"</td><td>";   
   echo"<form method=get action=$pag_back>";
   echo"<input type=submit name=enviar value=Cancelar class=boton>";
   echo"</form>";
   echo"</td></tr>";
   echo"</TABLE>";
}
//----------------------------------------------------------------------------------------
function consulta_detalle($db, $tabla, $orderby, $identificador, $pag_deta, $color1='', $color2='',$icono){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query($link,"SELECT * FROM $tabla ORDER BY $orderby");
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $cont=0;
   if ($numreg==0){
   echo"
   <table align=center>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=0 align=center width=100%>
	   <tr bgcolor=6699cc>";
	   for($c=0;$c<$numcam;$c++){
	   $campo_titulo=mysqli_field_name($result,$c);
	   $arr_campos[]=$campo_titulo;
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=yellow size=1><b>Detalle</font></td>";
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
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
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}
///////////////////////////////////////////////////////
//Funcion: consulta_funcion($db,$tabla,$orderby,$identificador,$pag_deta... etc)
//Funcion a la que se le puede asignar cualquier etiqueta
//parecido a consulta_detalle, pero con la caracteristica
//de poder cambiar los titulos del icono y la columna detalle
//////////////////////////////////////////////////////
function consulta_funcion($db, $tabla, $orderby, $identificador, $pag_deta, $color1='', $color2='',$icono,$funcion){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query($link,"SELECT * FROM $tabla ORDER BY $orderby");
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $cont=0;
   if ($numreg==0){
   echo"
   <table align=center>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=0 align=center width=100%>
	   <tr bgcolor=6699cc>";
	   for($c=0;$c<$numcam;$c++){
	   $campo_titulo=mysqli_field_name($result,$c);
	   $arr_campos[]=$campo_titulo;
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=yellow size=1><b>$funcion</font></td>";
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color1');>";
		 for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
//		 $id=mysql_field_name($result,0);
		 $id=$identificador;
		 printf("<td align=center><a href=\"$pag_deta?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
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
		 printf("<td align=center><a href=\"$pag_deta?$id=%s\"><IMG SRC=$icono BORDER=0 ALT=$funcion></a></td>
			  ", $row[$id], $row[$id]);
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}
///////////////////////////////////////////////////////
//----------------------------------------------------------------------------
function consulta_condicion($db, $tabla,$orderby='', $fld_campo, $cond, $arr_campos, $arr_titulos, $color1='', $color2=''){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query(,$link,"SELECT * FROM $tabla WHERE $fld_campo=$cond ORDER BY $orderby");
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $fd0=mysqli_field_name($result,0);
   $fd1=mysqli_field_name($result,1);
   $fd2=mysqli_field_name($result,2);
   $fd3=mysqli_field_name($result,3);
   $cont=0;
   if ($numreg==0){
   return "<tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=70%>
	   <tr bgcolor=5e8cb5>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}
//////////////////////////////////////////////////////////////////
function consulta_entre_fechas($db, $tabla,$orderby='', $fecha1, $fechamin,$fechamax,$arr_campos, $arr_titulos, $color1='', $color2=''){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query(,$link,"SELECT * FROM $tabla WHERE $fecha1>='$fechamin' AND $fecha1<='$fechamax' ORDER BY $orderby");
//   $result=mysql_query("SELECT * FROM $tabla WHERE $fld_campo=$cond ORDER BY $orderby",$link); 
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $fd0=mysqli_field_name($result,0);
   $fd1=mysqli_field_name($result,1);
   $fd2=mysqli_field_name($result,2);
   $fd3=mysqli_field_name($result,3);
   $cont=0;
   if ($numreg==0){
   return "<tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=70%>
	   <tr bgcolor=5e8cb5>";
	   for($c=0;$c<$num;$c++){
	   $campo_titulo=$arr_titulos[$c];
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}
//--------------------------------------------//////
function consulta_entre_fechas_detalle($db, $tabla, $orderby,$identificador,$fecha1, $fechamin,$fechamax, $pag_deta, $color1='', $color2='',$icono){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query(,$link),"SELECT * FROM $tabla WHERE $fecha1>='$fechamin' AND $fecha1<='$fechamax' ORDER BY $orderby");
//   $result=mysql_query("SELECT * FROM $tabla ORDER BY $orderby",$link); 
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $cont=0;
   if ($numreg==0){
   echo"
   <table align=center>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=0 align=center width=100%>
	   <tr bgcolor=6699cc>";
	   for($c=0;$c<$numcam;$c++){
	   $campo_titulo=mysqli_field_name($result,$c);
	   $arr_campos[]=$campo_titulo;
	   echo"<td align=center><font color=ffffff size=2><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5%><font color=yellow size=1><b>Detalle</font></td>";
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
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
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}
/////////////////////////////////////////////////////////////////////////
//Funcion que permite generar una tabla con su contenido, ademas de 2 botones que 
//pueden ser direccionados a otras paginas, se envia la llave principal del registro seleccionado
//$db: base de datos
//$tabla: tabla sobre la que se desea trabajar
//$pag_1 y $pag_2: paginas procesadoras de datos
//$color1 y $color2: combinacion de colores
//Nota: los iconos y las referencias son modificables
//////////////////////////////////////////////////////////////////////////
function consulta_2opciones($db, $tabla, $pag_1, $pag_2, $color1='', $color2=''){
   //include("../lib/conexion.php"); 
   $link=Conectarse("$db");
   $result=mysqli_query(,$link),"SELECT * FROM $tabla");
   $num=count($arr_campos);
   $numreg=mysqli_num_rows($result);
   $numcam=mysqli_num_fields($result);
   $cont=0;
   if ($numreg==0){
   echo"
   <table align=center>
   <tr bgcolor=$color2><td>NO EXISTE NINGUN REGISTRO</td></tr>
   </table>
   ";
   }
   else{
       echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=90%>
	   <tr bgcolor=6699CC>";
	   for($c=0;$c<$numcam;$c++){
	   $campo_titulo=mysqli_field_name($result,$c);
	   $arr_campos[]=$campo_titulo;
	   echo"<td align=center><font color=ffffff size=3><b>$campo_titulo</font></td>";
	   }
	   echo"<td width=5% ALIGN=CENTER><font color=#00FF00 size=1><b>ING</font></td>";
	   echo"<td width=5% ALIGN=CENTER><font color=red size=1><b>SAL</font></td>";
	   echo"</tr>";
       while($row = mysqli_fetch_array($result)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$color1 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color1');>";
		 for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 $id=mysqli_field_name($result,0);
		 printf("<td align=center><a href=\"$pag_1?$id=%s\"><IMG SRC=../img/ingreso.png BORDER=0 ALT=Ingreso></a></td>
			  ", $row[$id], $row[$id]);
		 printf("<td align=center><a href=\"$pag_2?$id=%s\"><IMG SRC=../img/salida.png BORDER=0 ALT=Salida></a></td>
			  ", $row[$id], $row[$id]);			  
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$color2 onMouseOver=uno(this,'FFFFDD'); onMouseOut=dos(this,'$color2');>";
		  for($i=0;$i<$numcam;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2>$row[$cam]</font></td>";
		 }
		 $id=mysqli_field_name($result,0);
		 printf("<td align=center><a href=\"$pag_1?$id=%s\"><IMG SRC=../img/ingreso.png BORDER=0 ALT=Ingreso></a></td>
			  ", $row[$id], $row[$id]);
		 printf("<td align=center><a href=\"$pag_2?$id=%s\"><IMG SRC=../img/salida.png BORDER=0 ALT=Salida></a></td>
			  ", $row[$id], $row[$id]);			  
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($result);
       mysqli_close($link);
       echo"</table>";
   }
}
?>
