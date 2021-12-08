<head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>
<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 

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
   $get=mysql_query("SELECT existencia FROM item WHERE cod_item='$tmp'",$link);
   $row=mysql_fetch_array($get);
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

/*
   mysql_query("insert into inventario (id_inv, fecha_lev, descripcion, fecha_ap, estado) 
   values ('$id_inv', '$fecha_lev', '$descripcion', '$fecha_ap', '$estado')",$link); 
*/
   for($i=0;$i<$numreg;$i++){
   mysql_query("UPDATE inventario_aux SET existencia_inv=$arr_cant[$i], existencia_sis=$arr_exis[$i], diferencia=$arr_dif[$i] 
   				WHERE id_inv=$id_inv && cod_item='$arr_cod[$i]'",$link); 
   }

//     mysql_query("UPDATE inventario_aux SET existencia_inv=$arr_cant[0] WHERE id_inv=$id_inv && cod_insum=$arr_cod[0]",$link); 


/*echo"codigo: $id_inv <br>";
echo"fecha: $fecha_lev <br>";
echo"Descripcion: $descripcion <br>";
echo"numreg: $numreg <br>";
*/

?>
<?=body_container_ini("","770","550")?>
<br><br>

<?
/*   for($i=0;$i<$numreg;$i++){
	echo"Guardando: $arr_cod[$i] --- $arr_cant[$i] --- $arr_exis[$i] --- $arr_dif[$i] <br>";   
   }*/
?>

<?=container_mensaje("Inventario Fisico Modificado")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=get action=inventario_pen.php>
       <INPUT TYPE=hidden NAME=id_inv VALUE=$id_inv>
       <input type=submit name=enviar value=Continuar class=boton>
       </form>
   </td>
   </form></center>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>