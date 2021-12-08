<?php
//////////////////////////////////////////////////////////////////////////////////////
function paginacion_orden($total,$pp,$st,$url,$orderby='',$orden='')
{

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
$page_nav .= ' <a href="'.$url.$nextst.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> <b>'.$pge.'</b></a>';
}
}

if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }

if($current_page< $pages) {
$page_last = '<b>[<a href="'.$url.($pages-1)*$pp.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> Ultima Pag</a>]';
$page_next = '[<a href="'.$url.$current_page*$pp.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> > </a>]';
}

if($st>0) {
$page_first = '<b>[<a href="'.$url.'0'.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> Primera Pag </a>]</a>';
$page_previous = '[<a href="'.$url.''.($current_page-2)*$pp.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> < </a>]';
}
}

return "$page_first $page_previous $page_nav $page_next $page_last";
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


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=97% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=center><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo> $campo_titulo $dir</a></font></td>";
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo> $campo_titulo</a></font></td>";
      }

	 }
     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	 echo"</tr>";

	   while($row = mysql_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
         if($cam=='numgalpones')
	     	echo"<td align=right><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
         else
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
         if($cam=='numgalpones')
	     	echo"<td align=right><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
         else
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
//////////////////////////////////////////////////////////////////////////////////////
function paginacion_orden2($total,$pp,$st,$url,$orderby='',$orden='',$where,$varaux='') {

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
$page_nav .= ' <a href="'.$url.$nextst.'&'.$varaux[0].'='.$varaux[1].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> <b>'.$pge.'</b></a>';
}
}

if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }

if($current_page< $pages) {
$page_last = '<b>[<a href="'.$url.($pages-1)*$pp.'&'.$varaux[0].'='.$varaux[1].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> Ultima Pag</a>]';
$page_next = '[<a href="'.$url.$current_page*$pp.'&'.$varaux[0].'='.$varaux[1].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> > </a>]';
}

if($st>0) {
$page_first = '<b>[<a href="'.$url.'0'.'&'.$varaux[0].'='.$varaux[1].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> Primera Pag </a>]</a>';
$page_previous = '[<a href="'.$url.''.($current_page-2)*$pp.'&'.$varaux[0].'='.$varaux[1].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> < </a>]';
}
}

return "$page_first $page_previous $page_nav $page_next $page_last";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion1_1($db, $tabla,$where,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$var_envio,$pag_proceso,$icono,$funcion,$pag_ini,$tam_pag){
if ($_GET["where"]!="")
    {
        //echo $_GET["where"];
        $where= $_GET["where"];
        $where=str_replace("\'","'", $where);
    }
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla WHERE $where",$link);
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
	$get = mysql_query('select * from '.$tabla.' where '.$where.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=97% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=center><font color=red size=2><b><a href=$pag_ini?where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo> $campo_titulo $dir</a></font></td>";
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo> $campo_titulo</a></font></td>";
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
echo paginacion_orden2($total, $pp, $st, $pag,$orderby,$orden,$where);
echo"</font></center>";

   }

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion1_1_color($db, $tabla,$where,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$var_envio,$pag_proceso,$icono,$funcion,$pag_ini,$tam_pag,$opcional,$varaux=''){
if ($_GET["where"]!="")
    {
        //echo $_GET["where"];
        $where= $_GET["where"];
        $where=str_replace("\'","'", $where);
    }
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla WHERE $where",$link);
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
	$get = mysql_query('select * from '.$tabla.' where '.$where.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=97% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=center><font color=red size=2><b><a href=$pag_ini?$varaux[0]=$varaux[1]&where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo> $campo_titulo $dir</a></font></td>";
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?$varaux[0]=$varaux[1]&where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo> $campo_titulo</a></font></td>";
      }

	 }
     echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	 echo"</tr>";

	   while($row = mysql_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
         if($row[$cam]==$opcional[0])
         	echo"<td><font size=2 color=$opcional[1]>$row[$cam]</font></td>";
         elseif($row[$cam]==$opcional[2])
         	echo"<td><font size=2 color=$opcional[3]>$row[$cam]</font></td>";
         else
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
         if($row[$cam]==$opcional[0])
         	echo"<td><font size=2 color=$opcional[1]>$row[$cam]</font></td>";
         elseif($row[$cam]==$opcional[2])
         	echo"<td><font size=2 color=$opcional[3]>$row[$cam]</font></td>";
         else
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
echo paginacion_orden2($total, $pp, $st, $pag,$orderby,$orden,$where,$varaux);
echo"</font></center>";

   }

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_simple_where($db, $tabla,$where,$orderby='',$groupby, $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$pag_ini,$tam_pag,$extra_dat=''){
if ($_GET["where"]!="")
    {
        $where= $_GET["where"];
        $where=str_replace("\'","'", $where);
    }
if ($_GET["groupby"]!="")
    {
        $groupby= $_GET["groupby"];
        $groupby=str_replace("\'","'", $groupby);
    }

$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla WHERE $where GROUP BY $groupby",$link);
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
	$get = mysql_query('select * from '.$tabla.' where '.$where.' group by '.$groupby.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=rows frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?where=$where&groupby=$groupby&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>| $campo_titulo $dir</a></font></td>";
	 }else{
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?where=$where&groupby=$groupby&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>| $campo_titulo</a></font></td>";
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
echo paginacion_orden3($total, $pp, $st, $pag,$orderby,$orden,$where,$groupby);
echo"</font></center>";

   }

}
//////////////////////////////////////////////////////////////////////////////////////
function paginacion_orden3($total,$pp,$st,$url,$orderby='',$orden='',$where,$groupby) {

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
$page_nav .= ' <a href="'.$url.$nextst.'&where='.$where.'&groupby='.$groupby.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> <b>'.$pge.'</b></a>';
}
}

if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }

if($current_page< $pages) {
$page_last = '<b>[<a href="'.$url.($pages-1)*$pp.'&where='.$where.'&groupby='.$groupby.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> Ultima Pag</a>]';
$page_next = '[<a href="'.$url.$current_page*$pp.'&where='.$where.'&groupby='.$groupby.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> > </a>]';
}

if($st>0) {
$page_first = '<b>[<a href="'.$url.'0'.'&where='.$where.'&groupby='.$groupby.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> Primera Pag </a>]</a>';
$page_previous = '[<a href="'.$url.''.($current_page-2)*$pp.'&where='.$where.'&groupby='.$groupby.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> < </a>]';
}
}

return "$page_first $page_previous $page_nav $page_next $page_last";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion1_1_color2($db, $tabla,$where,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$var_envio,$pag_proceso,$icono,$funcion,$pag_ini,$tam_pag,$opcional){
if ($_GET["where"]!="")
    {
        //echo $_GET["where"];
        $where= $_GET["where"];
        $where=str_replace("\'","'", $where);
    }
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla WHERE $where",$link);
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
	$get = mysql_query('select * from '.$tabla.' where '.$where.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=97% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=center><font color=red size=2><b><a href=$pag_ini?where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo> $campo_titulo $dir</a></font></td>";
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=center><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo> $campo_titulo</a></font></td>";
      }

	 }
     //echo"<td width=5%><font color=$arr_color_texto[2] size=1><b>$funcion</font></td>";
	 echo"</tr>";
       $id=$var_envio;
	   while($row = mysql_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
         if($row[$cam]==$opcional[0])
         	echo"<td><font size=2><a href='$opcional[1]=$row[$id]' title='Lote Asignado' class=linktab4>$row[$cam]</a></font></td>";
         elseif($row[$cam]==$opcional[2])
         	echo"<td><font size=2><a href='$opcional[3]=$row[$id]' title='Asignar el Lote' class=linktab3>$row[$cam]</a></font></td>";
         else
	     	echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 /*printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='$funcion'></a></td>
			  ", $row[$id], $row[$id]);*/
/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
		  for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
         if($row[$cam]==$opcional[0])
         	echo"<td><font size=2><a href='$opcional[1]=$row[$id]' title='Lote Asignado' class=linktab4>$row[$cam]</a></font></td>";
         elseif($row[$cam]==$opcional[2])
         	echo"<td><font size=2><a href='$opcional[3]=$row[$id]' title='Asignar el Lote' class=linktab3>$row[$cam]</a></font></td>";
         else
	     	echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id=$var_envio;
		 /*printf("<td align=center><a href=\"$pag_proceso?$id=%s\"><IMG SRC=$icono BORDER=0 title='$funcion'></a></td>
			  ", $row[$id], $row[$id]);*/
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
echo paginacion_orden2($total, $pp, $st, $pag,$orderby,$orden,$where);
echo"</font></center>";

   }

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion1_1select($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='',$var_envio,$pag_proceso,$icono,$funcion,$pag_ini,$tam_pag,$capacidad,$varaux='',$varadi)
{
$where="ga.capacidad>='$capacidad' and ga.estadogalpon='inactivo' and gr.idgranja=ga.idgranja";
$link=Conectarse("$db");
$get=mysql_query("SELECT gr.nomgranja,ga.idgalpon,ga.capacidad,ga.estadogalpon FROM $tabla WHERE $where",$link);
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
	$get = mysql_query('select gr.nomgranja,ga.idgalpon,ga.capacidad,ga.estadogalpon from '.$tabla.' where '.$where.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?$varaux[0]=$varaux[1]&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>$campo_titulo $dir</a></font></td>";
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?$varaux[0]=$varaux[1]&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>$campo_titulo</a></font></td>";
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
		 printf("<td align=center><a href=\"$pag_proceso?$varadi&$id=%s\"><IMG SRC=$icono BORDER=0 title='$funcion'></a></td>
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
		 printf("<td align=center><a href=\"$pag_proceso?$varadi&$id=%s\"><IMG SRC=$icono BORDER=0 title='$funcion'></a></td>
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
echo paginacion_orden2($total, $pp, $st, $pag,$orderby,$orden,$where,$varaux);
echo"</font></center>";

   }

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion2box_where($db, $tabla,$where,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $pag_proceso3, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag,$varaux=''){
if ($_GET["where"]!="")
    {
        //echo $_GET["where"];
        $where= $_GET["where"];
        $where=str_replace("\'","'", $where);
    }
$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla WHERE $where",$link);
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
	$get = mysql_query('select * from '.$tabla.' where '.$where.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);

/*ln*/ echo"<form name=f1 method=get action=$pag_proceso3>";
	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     ";
    echo"
	<tr>
	<td colspan=3 bgcolor='EBF3F7' >&nbsp;</td>
    <td align='center' bgcolor='5e8cb5'><font color='ffffff'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AVES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td colspan=2 align='center' bgcolor='5e8cb5'><font color='ffffff'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ALIMENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td colspan=3 align='center' bgcolor='5e8cb5'><font color='ffffff'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   	<td colspan=3 bgcolor='EBF3F7' >&nbsp;</td>
	</tr>";


      echo"<tr bgcolor=$arr_color_tabla[0]>";
/*ln*/ echo"<td align=center width=8%><font color=$arr_color_texto[2] size=1><a href=javascript:seleccionar_todo()><font size=2><img border=0 src=../img/b_checked.png title=Marcar Todos><a href=javascript:deseleccionar_todo()><font size=2> <img border=0 src=../img/b_nchecked.png alt=Marcar Todos></font></a></td>";
     for($c=1;$c<$num+1;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $t=$c-1;
     $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?$varaux[0]=$varaux[1]&$varaux[2]=$varaux[3]&where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo> $campo_titulo $dir</a></font></td>";
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?$varaux[0]=$varaux[1]&$varaux[2]=$varaux[3]&where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo> $campo_titulo</a></font></td>";
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
	     echo"<td align='right'><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$varaux[0]=$varaux[1]&$varaux[2]=$varaux[3]&$id1=%s\"><IMG SRC=$icono1 BORDER=0 title=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$varaux[0]=$varaux[1]&$varaux[2]=$varaux[3]&$id2=%s\"><IMG SRC=$icono2 BORDER=0 title=$funcion2></a></td>
			  ", $row[$id2], $row[$id2]);

/////////////////////////////////////////////
   	     echo"</tr>";
         $cont=$cont+1;
         }else{
	     echo"<tr bgcolor=$arr_color_tabla[2] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[2]');>";
/*line*/ echo"<td align=center><input type=checkbox name=id$cont value=$row[$var_envio2]></td>";
  	     for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td align='right'><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
		 $id1=$var_envio1;
		 printf("<td align=center><a href=\"$pag_proceso1?$varaux[0]=$varaux[1]&$varaux[2]=$varaux[3]&$id1=%s\"><IMG SRC=$icono1 BORDER=0 title=$funcion1></a></td>
			  ", $row[$id1], $row[$id1]);

		 $id2=$var_envio2;
		 printf("<td align=center><a href=\"$pag_proceso2?$varaux[0]=$varaux[1]&$varaux[2]=$varaux[3]&$id2=%s\"><IMG SRC=$icono2 BORDER=0 title=$funcion2></a></td>
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
echo paginacion_orden4($total, $pp, $st, $pag,$orderby,$orden,$where,$varaux);
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
//////////////////////////////////////////////////////////////////////////////////////
function paginacion_orden4($total,$pp,$st,$url,$orderby='',$orden='',$where,$varaux='') {

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
$page_nav .= ' <a href="'.$url.$nextst.'&'.$varaux[0].'='.$varaux[1].'&'.$varaux[2].'='.$varaux[3].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> <b>'.$pge.'</b></a>';
}
}

if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }

if($current_page< $pages) {
$page_last = '<b>[<a href="'.$url.($pages-1)*$pp.'&'.$varaux[0].'='.$varaux[1].'&'.$varaux[2].'='.$varaux[3].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> Ultima Pag</a>]';
$page_next = '[<a href="'.$url.$current_page*$pp.'&'.$varaux[0].'='.$varaux[1].'&'.$varaux[2].'='.$varaux[3].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> > </a>]';
}

if($st>0) {
$page_first = '<b>[<a href="'.$url.'0'.'&'.$varaux[0].'='.$varaux[1].'&'.$varaux[2].'='.$varaux[3].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> Primera Pag </a>]</a>';
$page_previous = '[<a href="'.$url.''.($current_page-2)*$pp.'&'.$varaux[0].'='.$varaux[1].'&'.$varaux[2].'='.$varaux[3].'&where='.$where.'&orderby='.$orderby.'&orden='.$orden.'" class="linknave"> < </a>]';
}
}

return "$page_first $page_previous $page_nav $page_next $page_last";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function consulta_pagina_funcion2_1($db, $tabla,$where='',$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag){
if ($_GET["where"]!="")
{
    //echo $_GET["where"];
    $where= $_GET["where"];
    $where=str_replace("\'","'", $where);
}

$link=Conectarse("$db");
$get=mysql_query("SELECT * FROM $tabla WHERE $where",$link);
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
	$get = mysql_query('select * from '.$tabla.' where '.$where.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);


	echo"<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2 align=center width=100% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
     for($c=0;$c<$num;$c++){
	 $campo_titulo=$arr_titulos[$c];
 $campo=$arr_campos[$c];
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>$campo_titulo $dir</a></font></td>";
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?where=$where&orderby=$arr_campos[$c]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>$campo_titulo</a></font></td>";
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
echo paginacion_orden2($total, $pp, $st, $pag,$orderby,$orden,$where);
echo"</font></center>";
 }

}
?>