<html>
<head>
<title>Registrando Nuevo ITEM</title>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>
<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 
   $cod_item=$_GET['cod_item']; 
   $nom_item=$_GET['nom_item'];
   $unid_item=$_GET['unid_item'];
   $precio_item=$_GET['precio_item'];
   $caja_item=$_GET['caja_item'];
   $existencia=$_GET['existencia'];
   $exi_max=$_GET['exi_max'];
   $exi_min=$_GET['exi_min'];
   $deta_item=$_GET['deta_item'];   
if ($cod_item!=""){
$get=mysqli_query($link,"SELECT * FROM item WHERE cod_item='$cod_item'");
$result=mysqli_fetch_array($get);
}else {}
?>
<?=body_container_ini("","770","550")?>
<br>
<?php
if ($cod_item=='' || $nom_item=='') {
?>
<?=container_mensaje("Por favor especifique el CODIGO y el NOMBRE del insumo")?>
<?php
echo"
<br>
<form method=post action=../molino/nuevo_item.php>
<center><input type=button value=Atras onClick=history.go(-1) class=boton></center>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
";
}

else if($result[0]==$cod_item){
?>
<?=container_mensaje("El ITEM ya existe... por favor pruebe con otro.")?>
<?php
echo"
<br>
<form method=post action=../molino/nuevo_item.php>
<center><input type=button value=Atras onClick=history.go(-1) class=boton></center>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
";
} else {

   mysqli_query($link,"insert into item (cod_item, nom_item, unid_item, precio_item, caja_item, exi_max, existencia, exi_min, deta_item) 
   values ('$cod_item','$nom_item','$unid_item', '$precio_item', '$caja_item', '$exi_max', '$existencia', '$exi_min', '$deta_item')");

?>
<?=container_mensaje("ITEM creado... ¿Desea crear otro?")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=post action=nuevo_item.php>
       <input type=submit name=enviar value=Si class=boton>
       </form>
   </td>
   <td><form method=post action=showall_item.php>
       <input type=submit name=enviar value=No class=boton>
   </form></center>
   </td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php } ?>
<?=body_container_fin()?>