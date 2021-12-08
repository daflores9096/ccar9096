<html><head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>

<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php");   
   $link=Conectarse("carioca"); 
   $id=$_GET['cod_fac'];
   
   $get1=mysql_query("SELECT cod_item,cant_fac FROM venta_aux WHERE cod_fac='$id'",$link);   
   while($row1=mysql_fetch_array($get1)){
   $arr_cod[]=$row1['cod_item'];
   $arr_cant[]=$row1['cant_fac'];
   }

   $numreg=count($arr_cod);
   for($i=0;$i<$numreg;$i++){
   $cod=$arr_cod[$i];
   $tmp=$arr_cant[$i];
   mysql_query("UPDATE item SET existencia=existencia + $tmp 
                WHERE cod_item='$cod'",$link);  
   }   
   
   mysql_query("DELETE FROM venta WHERE cod_fac='$id'",$link);   
   mysql_query("DELETE FROM venta_aux WHERE cod_fac='$id'",$link);   
   mysql_query("DELETE FROM movimiento WHERE cod_mov='$id'",$link);        
   
   
?>

<?=body_container_ini("","770","0")?>
<br>
<?=container_mensaje("Venta Anulada")?>
<br>
<?
   echo"
   <table align=center>
   <tr>
    <td>
	   <form method=post action=anular_venta.php>
       <input type=submit name=enviar value=Continuar class=boton>
       </form></center>
	</td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>