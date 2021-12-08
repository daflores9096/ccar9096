<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php");   
   $link=Conectarse("carioca"); 
   $cod_fac=$_GET['cod_fac'];
   $cod_item=$_GET['cod_item'];   

   $get=mysql_query("SELECT cant_fac, importe_fac FROM compra_aux WHERE cod_fac=$cod_fac AND cod_item='$cod_item'",$link);
   $row=mysql_fetch_array($get);

///////////////////reponer existencia de item eliminado/////////////////////////
   mysql_query("UPDATE item SET existencia=existencia - $row[0] 
                WHERE cod_item='$cod_item'",$link);

///////////////////////actualizar total factura////////////////////////////
   mysql_query("UPDATE compra SET total_fac=total_fac - $row[1] 
                WHERE cod_fac='$cod_fac'",$link);  
///////////////////actualizar datos del item eliminado//////////////////////
   mysql_query("DELETE FROM movimiento WHERE cod_mov=$cod_fac AND cod_item='$cod_item'",$link);   
   mysql_query("DELETE FROM compra_aux WHERE cod_fac=$cod_fac AND cod_item='$cod_item'",$link);   

//////////////redireccionar despues de eliminar el registro///////////////
header("Location:./modificar_datos_compra.php?cod_fac=$cod_fac");
?>
