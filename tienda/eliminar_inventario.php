<html><head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>

<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php");   
   $link=Conectarse("carioca"); 
   $id=$_GET['id_inv'];

   $result=mysql_query("SELECT estado FROM inventario WHERE id_inv='$id'",$link);
   $row=mysql_fetch_array($result);
   $estado=$row[0];
   
   if($estado=="Pendiente"){
   mysql_query("DELETE FROM inventario WHERE id_inv='$id'",$link);   
   mysql_query("DELETE FROM inventario_aux WHERE id_inv='$id'",$link);   
   }else {
   mysql_query("DELETE FROM inventario WHERE id_inv='$id'",$link);      
   	$get = mysql_query("SELECT cod_item, existencia_sis
						FROM inventario_aux 
						WHERE id_inv=$id");
   mysql_query("DELETE FROM inventario_aux WHERE id_inv='$id'",$link);      
    						
	while($row=mysql_fetch_array($get)){
	  $arr_cod[]=$row[cod_item];
	  $arr_exsis[]=$row[existencia_sis];
	}
    $tam_arr=count($arr_cod);
	
      for($i=0;$i<$tam_arr;$i++){
      mysql_query("UPDATE item SET existencia=$arr_exsis[$i] WHERE cod_item='$arr_cod[$i]'",$link); 
      }

   }
?>

<?=body_container_ini("","770","550")?>
<br>
<?=container_mensaje("Inventario eliminado")?>
<br> 
<?
   echo"
   <table align=center>
   <tr>
    <td>
	   <form method=post action=anular_inventarios.php>
       <input type=submit name=enviar value=Continuar class=boton>
       </form></center>
	</td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>