<?php
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function carpe_ini($titulo,$ancho){
echo"
<table width=$ancho border=0 cellspacing=0 cellpadding=0 align=center>
<tr valign=bottom>
<td width=20 background=../corner/1_1.gif>&nbsp;</td>
<td width=50% background=../corner/1_2.gif><font color=ffffff size=2><b>$titulo</font></td>
<td width=20><img src=../corner/1_3.gif></td>
<td background=../corner/1_4.gif>&nbsp;</td>
<td width=20><img src=../corner/1_5.gif></td>
</tr>

<tr>
<td><img src=../corner/2_1.gif></td>
<td background=../corner/2_2.gif></td>
<td background=../corner/2_3.gif></td>
<td background=../corner/2_2.gif></td>
<td><img src=../corner/2_5.gif></td>
</tr>

<tr>
<td background=../corner/4_1.gif>&nbsp;</td>
<td bgcolor=ebf3f7 colspan=3>
";
}

function carpe_fin(){
echo"
</td>
<td background=../corner/4_5.gif>&nbsp;</td>
</tr>

<tr>
<td><img src=../corner/5_1.gif></td>
<td background=../corner/5_3.gif>&nbsp;</td>
<td background=../corner/5_3.gif>&nbsp;</td>
<td background=../corner/5_3.gif>&nbsp;</td>
<td><img src=../corner/5_5.gif></td>
</tr>

</table>
";
}

function deta_ini($titulo,$ancho){
echo"
<table width=$ancho border=0 cellspacing=0 cellpadding=0 align=center>
<tr valign=bottom>
<td width=20 background=../corner/c1_1.gif>&nbsp;</td>
<td width=40% background=../corner/c1_2.gif><font color=5e8cb5 size=2><b>$titulo</font></td>
<td width=20><img src=../corner/c1_3.gif></td>
<td background=../corner/c1_4.gif>&nbsp;</td>
<td width=20><img src=../corner/c1_5.gif></td>
</tr>

<tr>
<td><img src=../corner/c2_1.gif></td>
<td background=../corner/c2_2.gif></td>
<td background=../corner/c2_3.gif></td>
<td background=../corner/c2_2.gif></td>
<td><img src=../corner/c2_5.gif></td>
</tr>

<tr>
<td background=../corner/c4_1.gif>&nbsp;</td>
<td bgcolor=ebf3f7 colspan=3>
";
}

function deta_fin(){
echo"
</td>
<td background=../corner/c4_5.gif>&nbsp;</td>
</tr>

<tr>
<td><img src=../corner/c5_1.gif></td>
<td background=../corner/c5_3.gif>&nbsp;</td>
<td background=../corner/c5_3.gif>&nbsp;</td>
<td background=../corner/c5_3.gif>&nbsp;</td>
<td><img src=../corner/c5_5.gif></td>
</tr>


</table>
";
}

function lista_ini($titulo,$ancho){
echo"
<table width=$ancho border=0 cellspacing=0 cellpadding=0 align=center>
<tr valign=bottom>
<td width=10><img src=../corner/b1_1.gif></td>
<td width=40% background=../corner/b1_2.gif><font color=ffffff size=2><b>$titulo</font></td>
<td width=10><img src=../corner/b1_3.gif></td>
<td background=../corner/b1_4.gif>&nbsp;</td>
<td width=20><img src=../corner/b1_5.gif></td>
</tr>

<tr>
<td background=../corner/b2_1.gif>&nbsp;</td>
<td bgcolor=ebf3f7 colspan=3>
";
}

function lista_fin(){
echo"
</td>
<td background=../corner/b2_5.gif>&nbsp;</td>
</tr>

<tr valign=top>
<td><img src=../corner/b3_1.gif></td>
<td background=../corner/b3_3.gif colspan=3></td>
<td><img src=../corner/b3_5.gif></td>
</tr>


</table>
";
}


//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
//Contenedor de todas las paginas
//////////////////////////////////////////////////////////////////////////////////////////
function body_container_ini($titulo,$ancho,$alto){
echo"
<body bgcolor='#96004B' text=#000000 topmargin='0' leftmargin='0' marginwidth='0' marginheight='0' bottommargin='0'>
<table WIDTH=$ancho BORDER=0 CELLPADDING=0 CELLSPACING=0 height=$alto>
<tr>
<td colspan=3><img src=../img/top_banner.gif width=$ancho height=80></td>
</tr>

<tr>
    <td bgcolor=#FFFFFF>&nbsp;</td>
    <td bgcolor=#FFFFFF>
";
}
function body_container_fin(){
echo"
	</td>
    <td bgcolor=#FFFFFF>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor=#FFFFFF>&nbsp;</td>
    <td bgcolor=#FFFFFF>&nbsp;</td>
    <td bgcolor=#FFFFFF>&nbsp;</td>
  </tr>
  <tr>
    <td width=15 background=../img/b_inf_centro.gif></td>
    <td background=../img/b_inf_centro.gif>&nbsp;</td>
    <td width=15 background=../img/b_inf_centro.gif></td>
  </tr>
</table>
";
}
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
// Contenedor de formularios de ingreso de datos
//////////////////////////////////////////////////////////////////////////////////////////
function carpeta_ini($titulo,$ancho){
echo"
<table width=$ancho border=0 cellspacing=0 cellpadding=0 align=center>
<tr valign=bottom>
<td width=27 background=../img/cr_sup_izq1.gif>&nbsp;</td>
<td width=260 background=../img/cr_sup1_centro.gif><font size=2 color=ffffff><img src=../img/esfera.gif><b> $titulo</font></td>
<td width=24 background=../img/cr_sup_der1.gif>&nbsp;</td>
<td bgcolor=ffffff>&nbsp;</td>
<td width=25 bgcolor=ffffff>&nbsp;</td>
</tr>
<tr>
<td width=27 background=../img/cr_sup_izq2.gif>&nbsp;</td>
<td background=../img/cr_sup2_centro.gif>&nbsp;</td>
<td background=../img/cr_sup2_centro.gif>&nbsp;</td>
<td background=../img/cr_sup2_centro.gif>&nbsp;</td>
<td width=24 background=../img/cr_sup_der2.gif>&nbsp;</td>
</tr>
<tr>
<td background=../img/cr_izq.gif>&nbsp;</td>
<td bgcolor=ebf3f7 colspan=3>
";
}
function carpeta_fin(){
echo"
</td>
<td background=../img/cr_der.gif>&nbsp;</td>
</tr>
<tr>
<td width=27 background=../img/cr_inf_izq.gif>&nbsp;</td>
<td background=../img/cr_inf_centro.gif>&nbsp;</td>
<td background=../img/cr_inf_centro.gif>&nbsp;</td>
<td background=../img/cr_inf_centro.gif>&nbsp;</td>
<td width=24 background=../img/cr_inf_der.gif>&nbsp;</td>
</tr>
</table>
";
}
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
//Contenedor de Listas de Resultados
//////////////////////////////////////////////////////////////////////////////////////////
function container_lista_ini($titulo,$ancho,$pos){
echo"
<table border=0 align=$pos cellpadding=0 cellspacing=0 width=$ancho>
<tr>
	<td width=1% align=right><img src=../img/t2_izq.gif></td>
	<td width=98% background=../img/t2_centro.gif align=left><font color=#ffffff size=2><B> $titulo</font></td>
	<td width=1% align=left><img src=../img/t2_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7></td>
<td align=left><img src=../img/c_der.gif></td>
</tr>
<tr>
<td align=right background=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7>
";
}
function container_lista_fin(){
echo"
</td>
<td align=left background=../img/c_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_inf_izq.gif></td>
<td align=center background=../img/c_inf_centro.gif></td>
<td align=left><img src=../img/c_inf_der.gif></td>
</tr>
</table>
";
}
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
// Contenedor para mensajes... de error, confirmacion, etc.
//////////////////////////////////////////////////////////////////////////////////////////
function container_mensaje($mensaje){
echo"
<table border=0 align=center cellpadding=0 cellspacing=0 width=50%>
<tr>
	<td width=1% align=right><img src=../img/c_sup_izq.gif></td>
	<td width=98% background=../img/c_sup_centro.gif></font></td>
	<td width=1% align=left><img src=../img/c_sup_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7></td>
<td align=left><img src=../img/c_der.gif></td>
</tr>
<tr>
<td align=right background=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7 align=center><font color=#5e8cb5 size=3><img src=../img/esfera.gif><B> $mensaje</td>
<td align=left background=../img/c_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7></td>
<td align=left><img src=../img/c_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_inf_izq.gif></td>
<td align=center background=../img/c_inf_centro.gif></td>
<td align=left><img src=../img/c_inf_der.gif></td>
</tr>
</table>
";
}
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function container_mensaje2_ini(){
echo"
<table border=0 align=center cellpadding=0 cellspacing=0 width=50%>
<tr>
	<td width=1% align=right><img src=../img/c_sup_izq.gif></td>
	<td width=98% background=../img/c_sup_centro.gif></font></td>
	<td width=1% align=left><img src=../img/c_sup_der.gif></td>
</tr>
<tr>
<td align=right background=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7 align=center><font color=#5e8cb5 size=3>
";
}

function container_mensaje2_fin(){
echo"
</td>
<td align=left background=../img/c_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7></td>
<td align=left><img src=../img/c_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_inf_izq.gif></td>
<td align=center background=../img/c_inf_centro.gif></td>
<td align=left><img src=../img/c_inf_der.gif></td>
</tr>
</table>
";
}
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
// Contenedor para formularios de detalle
//////////////////////////////////////////////////////////////////////////////////////////
function container_detalle_ini($titulo,$ancho){
echo"
<table width=$ancho border=0 cellspacing=0 cellpadding=0 align=center>
<tr valign=bottom>
<td width=27 background=../img/d_sup_izq1.gif>&nbsp;</td>
<td width=250 background=../img/d_sup_centro1.gif><font size=2 color=ffffff><img src=../img/esfera.gif><b> $titulo</font></td>
<td width=24 background=../img/d_sup_der1.gif>&nbsp;</td>
<td bgcolor=ffffff>&nbsp;</td>
<td width=25 bgcolor=ffffff>&nbsp;</td>
</tr>
<tr>
<td width=27 background=../img/d_sup_izq2.gif>&nbsp;</td>
<td background=../img/d_sup_centro2.gif>&nbsp;</td>
<td background=../img/d_sup_centro2.gif>&nbsp;</td>
<td background=../img/d_sup_centro3.gif>&nbsp;</td>
<td width=24 background=../img/d_sup_der2.gif>&nbsp;</td>
</tr>
<tr>
<td background=../img/d_izq.gif>&nbsp;</td>
<td bgcolor=ebf3f7 colspan=3>
";
}
function container_detalle_fin(){
echo"
</td>
<td background=../img/d_der.gif>&nbsp;</td>
</tr>
<tr>
<td width=27 background=../img/d_inf_izq.gif>&nbsp;</td>
<td background=../img/d_inf_centro.gif>&nbsp;</td>
<td background=../img/d_inf_centro.gif>&nbsp;</td>
<td background=../img/d_inf_centro.gif>&nbsp;</td>
<td width=24 background=../img/d_inf_der.gif>&nbsp;</td>
</tr>
</table>
";
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function container_aux_ini($ancho){
echo"
<table border=0 align=center cellpadding=0 cellspacing=0 width=$ancho>
<tr>
	<td width=1% align=right><img src=../img/c_sup_izq.gif></td>
	<td width=98% background=../img/c_sup_centro.gif></font></td>
	<td width=1% align=left><img src=../img/c_sup_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7></td>
<td align=left><img src=../img/c_der.gif></td>
</tr>
<tr>
<td align=right background=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7 align=center><font color=#5e8cb5 size=3>
";
}

function container_aux_fin(){
echo"
</td>
<td align=left background=../img/c_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_izq.gif></td>
<td bgcolor=#ebf3f7></td>
<td align=left><img src=../img/c_der.gif></td>
</tr>
<tr>
<td align=right><img src=../img/c_inf_izq.gif></td>
<td align=center background=../img/c_inf_centro.gif></td>
<td align=left><img src=../img/c_inf_der.gif></td>
</tr>
</table>
";
}

//////////////////////////////////////////////////////////////////////////////////////////////////
function teclas()
{
echo"
<script>
function pulsar(e,accion)
{
  tecla = (document.all) ? e.keyCode :e.which;
  if(accion=='letras')
  	return((tecla > 64 && tecla < 91)||(tecla > 96 && tecla < 123)||(tecla == 32)||(tecla == 8)||(tecla == 0));
  if(accion=='numeros')
    return((tecla > 47 && tecla < 58)||(tecla == 8)||(tecla == 0));
  if(accion=='numdecimal')
    return((tecla > 47 && tecla < 58)||(tecla == 46)||(tecla == 8)||(tecla == 0));

}
</script>
";
}
function letras()
{
echo"onKeypress=\"return pulsar(event,'letras')\"";
}
function numeros()
{
echo"onKeypress=\"return pulsar(event,'numeros')\"";
}
function numdecimal()
{
echo"onKeypress=\"return pulsar(event,'numdecimal')\"";
}
function obligatorio()
{
echo"<font color=#FF0000 size='4'>*&nbsp;</font>";
}
function mensajeobli()
{
echo"
<tr>
<td colspan='3' align='center' bgcolor='#ebf3f7'><font color='#FF0000'>Los campos con * no pueden quedar vacios</font></td>
</tr>
";
}
?>