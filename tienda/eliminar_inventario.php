<html><head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>

<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php");   
   $link=Conectarse("carioca"); 
   $id=$_GET['id_inv'];

   $result=mysqli_query($link,"SELECT estado FROM inventario WHERE id_inv='$id'");
   $row=mysqli_fetch_array($result);
   $estado=$row[0];
   
   if($estado=="Pendiente"){
   mysqli_query($link,"DELETE FROM inventario WHERE id_inv='$id'");
   mysqli_query($link,"DELETE FROM inventario_aux WHERE id_inv='$id'");
   }else {
   mysqli_query($link,"DELETE FROM inventario WHERE id_inv='$id'");
   	$get = mysqli_query($link,"SELECT cod_item, existencia_sis
						FROM inventario_aux 
						WHERE id_inv=$id");
   mysqli_query($link,"DELETE FROM inventario_aux WHERE id_inv='$id'");
    						
	while($row=mysqli_fetch_array($get)){
	  $arr_cod[]=$row['cod_item'];
	  $arr_exsis[]=$row['existencia_sis'];
	}
    $tam_arr=count($arr_cod);
	
      for($i=0;$i<$tam_arr;$i++){
      mysqli_query($link,"UPDATE item SET existencia=$arr_exsis[$i] WHERE cod_item='$arr_cod[$i]'");
      }

   }
?>

<?=body_container_ini("","770","550")?>
<br>
<?=container_mensaje("Inventario eliminado")?>
<br> 
<?php
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