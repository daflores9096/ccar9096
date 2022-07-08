<head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>
<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 

   //print_r($_REQUEST);
   //exit();
   $id_inv=$_GET['id_inv'];   
   $fecha_lev=$_GET['fecha_lev']; 
   $descripcion=$_GET['descripcion'];    
   $numreg=$_GET['numreg']; 
   $estado="Pendiente";

//capturar los codigos
   for($i=0;$i<$numreg;$i++){
   $tmp="cod$i";
   $arr_cod[]=$_GET[$tmp];
   }
//capturar las existencias del sistema
   for($i=0;$i<$numreg;$i++){
   $tmp=$arr_cod[$i];
   $get=mysqli_query($link,"SELECT existencia FROM item WHERE cod_item='$tmp'");
   $row=mysqli_fetch_array($get);
   $arr_exis[]=$row[0];
   }
//capturar las existencias reales del inventario fisico
   for($i=0;$i<$numreg;$i++){
   $tmp="cant$i";
   $arr_cant[]=$_GET[$tmp];
   }
//calcular diferencias
   for($i=0;$i<$numreg;$i++){
   $tmp=$arr_exis[$i] - $arr_cant[$i];
   $arr_dif[]=$tmp;
   }

   //$qry = "insert into inventario (id_inv, fecha_lev, descripcion, fecha_ap, estado) values ('$id_inv', '$fecha_lev', '$descripcion', '$fecha_ap', '$estado')";
   ///echo $qry;
   ///exit();
   mysqli_query($link,"insert into inventario (id_inv, fecha_lev, descripcion, estado) values ('$id_inv', '$fecha_lev', '$descripcion', '$estado')");

   for($i=0;$i<$numreg;$i++){
   mysqli_query($link,"insert into inventario_aux (id_inv, cod_item, existencia_inv, existencia_sis, diferencia) values ('$id_inv', '$arr_cod[$i]', '$arr_cant[$i]', '$arr_exis[$i]', '$arr_dif[$i]')");
   }

?>
<?=body_container_ini("","770","0")?>
<br><br>
<?=container_mensaje("Inventario Fisico Levantado")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=post action=showall_inventarios.php>
       <input type=submit name=enviar value=Continuar class=boton>
       </form>
   </td>
   </form></center>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>