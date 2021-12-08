<head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>
<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 

   $cod_fac=$_GET['cod_fac'];   
   $fecha_fac=$_GET['fecha_fac']; 
   $cod_cli=$_GET['cod_cli'];
   $nom_cli=$_GET['nom_cli'];    
   $total_fac=$_GET['tot_fac'];
   $numreg=$_GET['limit']; 

//capturar los codigos
   for($i=0;$i<$numreg;$i++){
   $tmp="cod$i";
   $arr_cod[]=$_GET[$tmp];
   }
//capturar las cantidades
   for($i=0;$i<$numreg;$i++){
   $tmp="cant$i";
   $arr_cant[]=$_GET[$tmp];
   }
//capturar los costos
   for($i=0;$i<$numreg;$i++){
   $tmp="cos$i";
   $arr_cos[]=$_GET[$tmp];
   }
//capturar los importes
   for($i=0;$i<$numreg;$i++){
   $tmp="imp$i";
   $arr_imp[]=$_GET[$tmp];
   }


   mysql_query("insert into venta (cod_fac, fecha_fac, cod_cli, nom_cli, total_fac) 
   values ('$cod_fac', '$fecha_fac', '$cod_cli', '$nom_cli', '$total_fac')",$link); 

   for($i=0;$i<$numreg;$i++){
   mysql_query("insert into venta_aux (cod_fac, cod_item, cant_fac, precio_uni, importe_fac) 
   values ('$cod_fac', '$arr_cod[$i]', '$arr_cant[$i]', '$arr_cos[$i]', '$arr_imp[$i]')",$link); 
   }

   for($i=0;$i<$numreg;$i++){
   $cod=$arr_cod[$i];
   $tmp=$arr_cant[$i];
   mysql_query("UPDATE item SET existencia=existencia - $tmp 
                WHERE cod_item='$cod'",$link);  
//////////////registrar movimiento///////////////////
   mysql_query("INSERT INTO movimiento (tipo_mov, cod_mov, cod_item, fecha_mov, cod_cli_pro, nom_cli_pro, entrada, salida) 
   values ('V', '$cod_fac', '$cod', '$fecha_fac', '$cod_cli', '$nom_cli', '0','$tmp')",$link); 
/////////////////////////////////////////////////////				
   }

?>
<?=body_container_ini("","770","550")?>
<br><br>
<?=container_mensaje("Venta Registrada")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=post action=showall_ventas.php>
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