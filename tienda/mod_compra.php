<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 

   $id=$_GET['cod_fac'];
   $cod_fac=$_GET['cod_fac'];   
   $fecha_fac=$_GET['fecha_fac']; 
   $cod_pro=$_GET['cod_pro'];
   $nom_pro=$_GET['nom_pro'];    
   $total_fac=$_GET['tot_fac'];
   $numreg=$_GET['limit']; 

   $cod=$_GET['cod'];
   $nom=$_GET['nom'];
   $unid=$_GET['unid'];
   $cant=$_GET['cant'];
   $cos=$_GET['cos'];
   $ven=$_GET['ven'];   
   $imp=$_GET['imp'];

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
//capturar los precios de venta
   for($i=0;$i<$numreg;$i++){
   $tmp="ven$i";
   $arr_ven[]=$_GET[$tmp];
   }
//capturar los importes
   for($i=0;$i<$numreg;$i++){
   $tmp="imp$i";
   $arr_imp[]=$_GET[$tmp];
   }

/////////////////////////////fase 1: eliminar registro//////////////////////////////
   $get1=mysql_query("SELECT cod_item,cant_fac FROM compra_aux WHERE cod_fac='$id'",$link);   
   while($row1=mysql_fetch_array($get1)){
   $arr_codigos[]=$row1['cod_item'];
   $arr_cantidades[]=$row1['cant_fac'];
   }
   $numreg=count($arr_codigos);
   for($i=0;$i<$numreg;$i++){
   $codi=$arr_codigos[$i];
   $tmp=$arr_cantidades[$i];
   mysql_query("UPDATE item SET existencia=existencia - $tmp 
                WHERE cod_item='$codi'",$link);  
   }   
   mysql_query("DELETE FROM compra WHERE cod_fac='$id'",$link);   
   mysql_query("DELETE FROM compra_aux WHERE cod_fac='$id'",$link);   
   mysql_query("DELETE FROM movimiento WHERE cod_mov='$id'",$link);        
   
///////////////////////////////////////////////////////////////////////////////////

///////////////////////fase 2: reinsertar el registro modificado///////////////////////////
   mysql_query("insert into compra (cod_fac, fecha_fac, cod_pro, nom_pro, total_fac) 
   values ('$cod_fac', '$fecha_fac', '$cod_pro', '$nom_pro', '$total_fac')",$link); 

   for($i=0;$i<$numreg;$i++){
   mysql_query("insert into compra_aux (cod_fac, cod_item, cant_fac, precio_uni, precio_ven, importe_fac) 
   values ('$cod_fac', '$arr_cod[$i]', '$arr_cant[$i]', '$arr_cos[$i]', '$arr_ven[$i]', '$arr_imp[$i]')",$link); 
   }
/////////////////////registrar modificacion en existencia////////////////////////   
   for($i=0;$i<$numreg;$i++){
   $codi=$arr_cod[$i];
   $tmp=$arr_cant[$i];
   mysql_query("UPDATE item SET existencia=existencia + $tmp 
                WHERE cod_item='$codi'",$link);  
//////////////registrar movimiento///////////////////
   mysql_query("INSERT INTO movimiento (tipo_mov, cod_mov, cod_item, fecha_mov, cod_cli_pro, nom_cli_pro, entrada, salida) 
   values ('C', '$cod_fac', '$codi', '$fecha_fac', '$cod_pro', '$nom_pro', '$tmp','0')",$link); 
////////////////////////////////////////////////////////////////////////////////////////////////				
   }

if (!$cod){
header("Location:./modificar_datos_compra.php?cod_fac=$cod_fac");
}else {
////////////item a�adido////////////////////////
   mysql_query("insert into compra_aux (cod_fac, cod_item, cant_fac, precio_uni, precio_ven, importe_fac) 
   values ('$cod_fac', '$cod', '$cant', '$cos', '$ven', '$imp')",$link); 

///////////////////registrar existencia de item a�adido/////////////////////////
   mysql_query("UPDATE item SET existencia=existencia + $cant 
                WHERE cod_item='$cod'",$link);  
//////////////registrar movimiento item a�adido///////////////////
   mysql_query("INSERT INTO movimiento (tipo_mov, cod_mov, cod_item, fecha_mov, cod_cli_pro, nom_cli_pro, entrada, salida) 
   values ('V', '$cod_fac', '$cod', '$fecha_fac', '$cod_pro', '$nom_pro', '$cant','0')",$link); 
};

header("Location:./modificar_datos_compra.php?cod_fac=$cod_fac");
?>