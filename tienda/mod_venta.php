<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 

   //print_r($_REQUEST);
   //exit();
   
   $id=$_GET['cod_fac'];
   $cod_fac=$_GET['cod_fac'];   
   $fecha_fac=$_GET['fecha_fac']; 
   $cod_cli=$_GET['cod_cli'];
   $nom_cli=$_GET['nom_cli']; 
   $dire_cli=$_GET['dire_cli'];   
   $traspaso=$_GET['traspaso'];
   $total_fac=$_GET['tot_fac'];
   $total_bul=$_GET['tot_bul'];
   $numreg=$_GET['limit']; 

   $cod=$_GET['cod'];
   $nom=$_GET['nom'];
   $bul=$_GET['bul'];
   $cant=$_GET['cant'];
   $cos=$_GET['cos'];
   $imp=$_GET['imp'];

//capturar los codigos
   for($i=0;$i<$numreg;$i++){
   $tmp="cod$i";
   $arr_cod[]=$_GET[$tmp];
   }
//capturar las cantidades de bultos
   for($i=0;$i<$numreg;$i++){
   $tmp="bul$i";
   $arr_bul[]=$_GET[$tmp];
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

/////////////////////////////fase 1: eliminar registro//////////////////////////////
   $get1=mysql_query("SELECT cod_item,cant_fac FROM venta_aux WHERE cod_fac='$id'",$link);   
   while($row1=mysql_fetch_array($get1)){
   $arr_codigos[]=$row1['cod_item'];
   $arr_cantidades[]=$row1['cant_fac'];
   }
   $numreg=count($arr_codigos);
   for($i=0;$i<$numreg;$i++){
   $codi=$arr_codigos[$i];
   $tmp=$arr_cantidades[$i];
   mysql_query("UPDATE item SET existencia=existencia + $tmp 
                WHERE cod_item='$codi'",$link);  
   }   
   mysql_query("DELETE FROM venta WHERE cod_fac='$id'",$link);   
   mysql_query("DELETE FROM venta_aux WHERE cod_fac='$id'",$link);   
   mysql_query("DELETE FROM movimiento WHERE cod_mov='$id'",$link);        
   
///////////////////////////////////////////////////////////////////////////////////

///////////////////////fase 2: reinsertar el registro modificado///////////////////////////
   mysql_query("insert into venta (cod_fac, fecha_fac, cod_cli, nom_cli, dire_cli, traspaso, total_fac, tot_bul) 
   values ('$cod_fac', '$fecha_fac', '$cod_cli', '$nom_cli', '$dire_cli', '$traspaso', '$total_fac', '$total_bul')",$link); 

   for($i=0;$i<$numreg;$i++){
   $qry = "insert into venta_aux (cod_fac, cod_item, bultos, cant_fac, precio_uni, importe_fac) values ('$cod_fac', '$arr_cod[$i]', '$arr_bul[$i]', '$arr_cant[$i]', '$arr_cos[$i]', '$arr_imp[$i]')";    
   mysql_query("insert into venta_aux (cod_fac, cod_item, bultos, cant_fac, precio_uni, importe_fac) values ('$cod_fac', '$arr_cod[$i]', '$arr_bul[$i]', '$arr_cant[$i]', '$arr_cos[$i]', '$arr_imp[$i]')",$link); 
   }
/////////////////////registrar modificacion en existencia////////////////////////   
   for($i=0;$i<$numreg;$i++){
   $codi=$arr_cod[$i];
   $tmp=$arr_cant[$i];
   mysql_query("UPDATE item SET existencia=existencia - $tmp 
                WHERE cod_item='$codi'",$link);  
//////////////registrar movimiento///////////////////
   mysql_query("INSERT INTO movimiento (tipo_mov, cod_mov, cod_item, fecha_mov, cod_cli_pro, nom_cli_pro, entrada, salida) 
   values ('V', '$cod_fac', '$codi', '$fecha_fac', '$cod_cli', '$nom_cli', '0','$tmp')",$link); 
////////////////////////////////////////////////////////////////////////////////////////////////				
   }

if (!$cod){
header("Location:./modificar_datos_venta.php?cod_fac=$cod_fac");
}else {
////////////item añadido////////////////////////
   mysql_query("insert into venta_aux (cod_fac, cod_item, bultos, cant_fac, precio_uni, importe_fac) 
               values ('$cod_fac', '$cod', '$bul', '$cant', '$cos', '$imp')",$link); 

///////////////////registrar existencia de item añadido/////////////////////////
   mysql_query("UPDATE item SET existencia=existencia - $cant 
                WHERE cod_item='$cod'",$link);  
//////////////registrar movimiento item añadido///////////////////
   mysql_query("INSERT INTO movimiento (tipo_mov, cod_mov, cod_item, fecha_mov, cod_cli_pro, nom_cli_pro, entrada, salida) 
   values ('V', '$cod_fac', '$cod', '$fecha_fac', '$cod_cli', '$nom_cli', '0','$cant')",$link); 
};

header("Location:./modificar_datos_venta.php?cod_fac=$cod_fac");
?>