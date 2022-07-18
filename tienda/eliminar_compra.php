<html><head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>

<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php");   
   $link=Conectarse("carioca"); 
   $id=$_GET['cod_fac'];
   
   $get1=mysqli_query($link,"SELECT cod_item,cant_fac FROM compra_aux WHERE cod_fac='$id'");
   while($row1=mysqli_fetch_array($get1)){
   $arr_cod[]=$row1['cod_item'];
   $arr_cant[]=$row1['cant_fac'];
   }

   $numreg=count($arr_cod);
   for($i=0;$i<$numreg;$i++){
   $cod=$arr_cod[$i];
   $tmp=$arr_cant[$i];
   mysqli_query($link,"UPDATE item SET existencia=existencia - $tmp 
                WHERE cod_item='$cod'");
   }   
   
   mysqli_query($link,"DELETE FROM compra WHERE cod_fac='$id'");
   mysqli_query($link,"DELETE FROM compra_aux WHERE cod_fac='$id'");
   mysqli_query($link,"DELETE FROM movimiento WHERE cod_mov='$id'");
   
   
?>

<?=body_container_ini("","770","0")?>
<br>
<?=container_mensaje("Compra Anulada")?>
<br>
<?php
   echo"
   <table align=center>
   <tr>
    <td>
	   <form method=post action=anular_compra.php>
       <input type=submit name=enviar value=Continuar class=boton>
       </form></center>
	</td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>