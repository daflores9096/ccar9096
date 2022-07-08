<head>
<title>INVENTARIO FISICO</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script type="text/javascript" language="JavaScript" src="calendario/calendar.js"></script>
<script> 
function uno(src,color_entrada) { 
    src.bgColor=color_entrada;src.style.cursor="";
} 
function dos(src,color_default) { 
    src.bgColor=color_default;src.style.cursor="default"; 
} 
function seleccionar_todo(){
   for (i=0;i<document.form2.elements.length;i++)
      if(document.form2.elements[i].type == "checkbox")
         document.form2.elements[i].checked=1
} 
function deseleccionar_todo(){
   for (i=0;i<document.form2.elements.length;i++)
      if(document.form2.elements[i].type == "checkbox")
         document.form2.elements[i].checked=0
} 
</script>
</head> 
<?php
include("../lib/conexion.php");
include("../lib/lib_consulta.php");
include("../lib/lib_formato.php");
//include ("calendario/calendario.php");
/////////////////////////////////////////////////
$db="carioca";
$tabla="item";
$orderby="nom_item";
$arr_campos=array("cod_item","nom_item","unid_item","existencia");
$arr_titulos=array("","CODIGO","ITEM","UNIDAD","EXISTENCIA");
$arr_color_tabla=array("5e8cb5","ffffff","ffffff","5e8cb5");
$arr_color_texto=array("ffffff","000000","c4b6ff");
$var_envio1="cod_item";
$var_envio2="cod_item";
$pag_proceso1="conf_del_insum.php";
$pag_proceso2="form_edit_insum.php";
$pag_proceso3="conf_del_insum_box.php";
$icono1="../img/boton_borrar.png";
$icono2="../img/boton_edit.png";
$funcion1="Borrar";
$funcion2="Modificar";
$pag_ini="nuevo_inventario.php";
$tam_pag=1000;
/////////////////////////////////////////////////
$link=Conectarse("$db"); 
$result=mysqli_query($link,"SELECT max(id_inv) AS elmax FROM inventario");
$last_id_inv=mysqli_fetch_array($result);
$id_inv=$last_id_inv[0] + 1;
$ultimafecha=date("20y-m-d");
?>
<?=body_container_ini("","770","0")?>
<table align="right" bgcolor="#e1e4f2" width="100%">
<tr>
<td width="80%"><font color="#5E8CB5" size="2"><b>INVENTARIO FISICO > Nuevo Inventario</b></font></td>
<td align="right" width="10%">
<form method="post" action="showall_inventarios.php">
<input type="submit" name="enviar" value="<< ATRAS" class="boton">
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
<td bgcolor="#5E8CB5" width="33%"><font color="ffffff" size="2" face="Courier New, Courier, mono"><b>NUEVO LEVANTAMIENTO</td>
</tr>
</table>

<table border="0" width="100%" bgcolor="#5E8CB5">
<tr>
<td bgcolor="e1e4f2">
<br>
<br>
<!-- form inicio -->
<FORM name="form2" ACTION="generar_inventario.php" method="get"> 
<TABLE border="0" cellpadding="1" cellspacing="2" width="90%"> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">CODIGO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="id_inv" SIZE="10" MAXLENGTH="10" value="<?php echo"$id_inv"; ?>"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">FECHA LEVANTAMIENTO:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="fecha_lev" SIZE="10" MAXLENGTH="10" value="<?php echo $ultimafecha; ?>"><img src="../img/b_calendar.png" onClick='showCalendar(this, form2.fecha_lev, "yyyy-mm-dd","es",1)' title="Calendario"></td>
</TR> 
<TR> 
   <TD bgcolor="#FFFFFF"><b><font size="2" color="#5e8cb5">DESCRIPCION:</TD> 
   <td colspan="2"><INPUT TYPE="text" NAME="descripcion" SIZE="40" MAXLENGTH="40" value="Inventario"></td>
</TR> 

</TABLE>
<!-- form fin -->
<br>
<!-- tabla box inicio -->
<table width="25%">
<tr>
<td bgcolor="#ffffff" width="33%" colspan="3"><font color="5E8CB5" size="2" face="Courier New, Courier, mono"><b>SELECCIONAR INSUMOS</td>
</tr>
</table>
<?php
//function consulta_pagina_funcion2box($db, $tabla,$orderby='', $arr_campos='', $arr_titulos, $arr_color_tabla='', $arr_color_texto='', $var_envio1, $var_envio2, $pag_proceso1, $pag_proceso2, $pag_proceso3, $icono1, $icono2, $funcion1, $funcion2,$pag_ini,$tam_pag){
$get=mysqli_query($link,"SELECT * FROM $tabla");
$num=count($arr_campos);
$total=mysqli_num_rows($get);
$pag="$pag_ini?st=";
$pp=$tam_pag;
if (isset($_GET['orderby'])){
    $orderby= $_GET['orderby'];
} else {
    $orderby= "nom_item";
}

if (isset($_GET['orden'])){
    $orden = $_GET['orden'];
} else {
    $orden = "ASC";
}
$cont=0;

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
	     $orderby=$arr_campos[1];
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

//	$get = mysql_query('select * from '.$tabla.' order by '.$orderby.' limit '.$st.','.$pp);
	$get = mysqli_query($link,'select * from '.$tabla.' order by '.$orderby.' '.$orden.' limit '.$st.','.$pp);

	echo"<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 width=95% bgcolor=$arr_color_tabla[2] rules=cols frame=hsides bordercolor=#c1cdd8>
     <tr bgcolor=$arr_color_tabla[0]>";
/*ln*/ echo"<td align=center width=8%><font color=$arr_color_texto[2] size=1><a href=javascript:seleccionar_todo()><font size=2><img border=0 src=../img/b_checked.png title=Marcar Todos><a href=javascript:deseleccionar_todo()><font size=2> <img border=0 src=../img/b_nchecked.png alt=Marcar Todos></font></a></td>";
     for($c=1;$c<$num+1;$c++){
	 $campo_titulo=$arr_titulos[$c];
	 $t=$c-1;
     $campo=$arr_campos[$t];
	 
	 if($campo==$orderby){
	   echo"<td align=left><font color=red size=2><b><a href=$pag_ini?orderby=$arr_campos[$t]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linkcampo>$campo_titulo $dir</a></font></td>";	 
	 }else{
//	 echo"<td align=left><font color=$arr_color_texto[0] size=2><b>| $campo_titulo</font></td>";
	   echo"<td align=left><font color=$arr_color_texto[0] size=2><b><a href=$pag_ini?orderby=$arr_campos[$t]&orden=$ord title='Ordenar por $arr_titulos[$c] en orden $ord' class=linktitulo>$campo_titulo</a></font></td>";
      }	 }
	 echo"</tr>";
	   
	   while($row = mysqli_fetch_array($get)) {
		 if (($cont%2)==0){
	     echo"<tr bgcolor=$arr_color_tabla[1] onMouseOver=uno(this,'FEE3D3'); onMouseOut=dos(this,'$arr_color_tabla[1]');>";
/*line*/ echo"<td align=center><input type=checkbox name=id$cont value=$row[$var_envio1]></td>";
		 for($i=0;$i<$num;$i++){
		 $cam=$arr_campos[$i];
	     echo"<td><font size=2 color=$arr_color_texto[1]>$row[$cam]</font></td>";
		 }
/////////////////////////////////////////////
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
/////////////////////////////////////////////
		 echo"</tr>";
         $cont=$cont+1;
         }
	   }
       mysqli_free_result($get);
       mysqli_close($link);
       echo"</table><br>";

echo"<center> <font size=2 color=$arr_color_texto[2]>"; 
//echo paginacion($total, $pp, $st,$pag);
echo paginacion_orden($total, $pp, $st, $pag,$orderby,$orden);
echo"</font></center>";  

/*ln /////////////////////////////*/
	  echo"<br>";
      echo"<INPUT TYPE=hidden name=total value=$total></center>";
/*ln /////////////////////////////*/	  
   }
//}
?>
<!-- tabla box fin -->
<br> 
<table align="center">
<TR >
	<TD align="center"><INPUT TYPE="submit" NAME="accion" VALUE="Aceptar" class="boton"> </TD>
	</form>
	<td width="10%">&nbsp;</td>
	<form action="showall_inventarios.php" method="post">
	<TD align="center"><INPUT TYPE="submit" NAME="accion" VALUE="Cancelar" class="boton"> </TD>
	</form>
</TR>
</table>
<br>
</td>
</tr>
</table>
<br><br><br><br><br><br>
<?=body_container_fin()?>