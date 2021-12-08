<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php");   
   $link=Conectarse("carioca"); 
   $cod_fac=$_GET['cod_fac'];
   $cod_item=$_GET['cod_item'];   

   $get=mysql_query("SELECT bultos,cant_fac, importe_fac FROM venta_aux WHERE cod_fac=$cod_fac AND cod_item='$cod_item'",$link);
   $row=mysql_fetch_array($get);

///////////////////reponer existencia de item eliminado/////////////////////////
   mysql_query("UPDATE item SET existencia=existencia + $row[1] 
                WHERE cod_item='$cod_item'",$link);  

///////////////////////actualizar total factura////////////////////////////
   mysql_query("UPDATE venta SET total_fac=total_fac - $row[2] 
                WHERE cod_fac='$cod_fac'",$link);  
///////////////////////actualizar numero bultos////////////////////////////
   mysql_query("UPDATE venta SET tot_bul=tot_bul - $row[0] 
                WHERE cod_fac='$cod_fac'",$link);  
///////////////////actualizar datos del item eliminado//////////////////////
   mysql_query("DELETE FROM movimiento WHERE cod_mov=$cod_fac AND cod_item='$cod_item'",$link);   
   mysql_query("DELETE FROM venta_aux WHERE cod_fac=$cod_fac AND cod_item='$cod_item'",$link);   

header("Location:./nueva_venta2.php?cod_fac=$cod_fac");
?>
