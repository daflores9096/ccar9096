<html> 
<head> 
<title>Aplicando Inventario Fisico</title> 
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
<script language="JavaScript" src="calendario/javascripts.js"></script>
</head>
<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 

   $id_inv=$_GET['id_inv'];   
   $fecha_lev=$_GET['fecha_lev']; 
   $fecha_ap=$_GET['fecha_ap'];    
   $descripcion=$_GET['descripcion'];    
   $estado=$_GET['estado'];
   $numreg=$_GET['numreg']; 


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

   for($i=0;$i<$numreg;$i++){
   mysql_query("UPDATE item SET existencia=$arr_cant[$i] WHERE cod_item='$arr_cod[$i]'",$link); 
   }

   mysql_query("UPDATE inventario SET fecha_ap='$fecha_ap', estado='$estado' WHERE id_inv=$id_inv",$link); 
/*
   mysql_query("insert into inventario (id_inv, fecha_lev, descripcion, fecha_ap, estado) 
   values ('$id_inv', '$fecha_lev', '$descripcion', '$fecha_ap', '$estado')",$link); 

   for($i=0;$i<$numreg;$i++){
   mysql_query("insert into inventario_aux (id_inv, cod_insum, existencia_inv, existencia_sis, diferencia) 
   values ('$id_inv', '$arr_cod[$i]', '$arr_cant[$i]', '$arr_exis[$i]', '$arr_dif[$i]')",$link); 
   }
*/

/*echo"codigo: $id_inv <br>";
echo"fechalev: $fecha_lev <br>";
echo"fechaap: $fecha_ap <br>";
echo"Descripcion: $descripcion <br>";
echo"estado: $estado <br>";
echo"numreg: $numreg <br>";


   for($i=0;$i<$numreg;$i++){
	echo"Guardando: $arr_cod[$i] --- $arr_cant[$i] --- $arr_exis[$i] --- $arr_dif[$i] <br>";   
   }*/
?>
<?=body_container_ini("","770","0")?>
<br><br>

<?
/*   for($i=0;$i<$numreg;$i++){
	echo"Guardando: $arr_cod[$i] --- $arr_cant[$i] --- $arr_exis[$i] --- $arr_dif[$i] <br>";   
   }*/
?>

<?=container_mensaje("Inventario Fisico Aplicado")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=get action=showall_inventarios.php>
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