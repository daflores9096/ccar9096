<html>
<head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>

<?php 
include("../lib/conexion.php"); 
include("../lib/lib_formato.php");   
$link=Conectarse("carioca"); 
$articulos=$_GET['articulos'];
$compras=$_GET['compras'];
$ventas=$_GET['ventas'];
$mov_compras=$_GET['mov_compras'];
$mov_ventas=$_GET['mov_ventas'];
$proveedores=$_GET['proveedores'];
$clientes=$_GET['clientes'];

if(!$articulos){   
}else{
   mysql_query("DELETE FROM item",$link);   
}   
if(!$compras){   
}else{
  mysql_query("DELETE FROM compra",$link);   
  mysql_query("DELETE FROM compra_aux",$link);   
}
if(!$ventas){   
}else{
  mysql_query("DELETE FROM venta",$link);   
  mysql_query("DELETE FROM venta_aux",$link);   
}
if(!$mov_compras){   
}else{
  mysql_query("DELETE FROM movimiento WHERE tipo_mov='C'",$link);   
}
if(!$mov_ventas){   
}else{
  mysql_query("DELETE FROM movimiento WHERE tipo_mov='V'",$link);   
}
if(!$proveedores){   
}else{
  mysql_query("DELETE FROM proveedor",$link);   
}
if(!$clientes){   
}else{
  mysql_query("DELETE FROM cliente",$link);   
}

?>

<?=body_container_ini("","770","550")?>
<br>
<?=container_mensaje("Tablas reiniciadas")?>
<br> 
<?
   echo"
   <table align=center>
   <tr>
    <td>
	   <form method=post action=../index.php>
       <input type=submit name=enviar value=Continuar class=boton>
       </form></center>
	</td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>