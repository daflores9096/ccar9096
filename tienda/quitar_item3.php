<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php");   
   $link=Conectarse("carioca"); 
   $cod_fac=$_GET['cod_fac'];
   $cod_item=$_GET['cod_item'];   

   $get=mysqli_query($link,"SELECT cant_fac, importe_fac FROM compra_aux WHERE cod_fac=$cod_fac AND cod_item='$cod_item'");
   $row=mysqli_fetch_array($get);

///////////////////reponer existencia de item eliminado/////////////////////////
   mysqli_query($link,"UPDATE item SET existencia=existencia - $row[0] 
                WHERE cod_item='$cod_item'");

///////////////////////actualizar total factura////////////////////////////
   mysqli_query($link,"UPDATE compra SET total_fac=total_fac - $row[1] 
                WHERE cod_fac='$cod_fac'");
///////////////////actualizar datos del item eliminado//////////////////////
   mysqli_query($link,"DELETE FROM movimiento WHERE cod_mov=$cod_fac AND cod_item='$cod_item'");
   mysqli_query($link,"DELETE FROM compra_aux WHERE cod_fac=$cod_fac AND cod_item='$cod_item'");

header("Location:./nueva_compra2.php?cod_fac=$cod_fac");
?>
