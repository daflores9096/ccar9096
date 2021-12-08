<html>
<head>
<title>Registrando Nuevo Proveedor</title>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>
<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 
   $cod_pro=$_GET['cod_pro']; 
   $nom_pro=$_GET['nom_pro'];
   $contacto_sec=$_GET['contacto_sec'];
   $dire_pro=$_GET['dire_pro'];
   $ciudad_pro=$_GET['ciudad_pro'];
   $tel_pro=$_GET['tel_pro'];
   $tel_sec=$_GET['tel_sec'];
   $email_pro=$_GET['email_pro'];   
   $desc_pro=$_GET['desc_pro'];   
   
$get=mysql_query("SELECT * FROM proveedor WHERE cod_pro=$cod_pro",$link);
$result=mysql_fetch_array($get);
?>
<?=body_container_ini("","770","0")?>
<br>
<?php
if ($cod_pro=='' || $nom_pro=='') {
?>
<?=container_mensaje("Por favor... No debe dejar campos en blanco...")?>
<?php
echo"
<br>
<form method=post action=../carioca/tienda/nuevo_proveedor.php>
<center><input type=button value=Atras onClick=history.go(-1) class=boton></center>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
";
}

else if($result[0]==$cod_pro){
?>
<?=container_mensaje("Existe duplicidad de CODIGO... por favor pruebe con otro.")?>
<?php
echo"
<br>
<form method=post action=../molino/nuevo_proveedor.php>
<center><input type=button value=Atras onClick=history.go(-1) class=boton></center>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
";
} else {
   //$qry = "insert into proveedor (cod_pro, nom_pro, contacto_sec, dire_pro, ciudad_pro, tel_pro, tel_sec, email_pro, desc_pro) values ('$cod_pro','$nom_pro','$contacto_sec', '$dire_pro', '$ciudad_pro', '$tel_pro', '$tel_sec', '$email_pro', '$desc_pro')";
   //echo $qry;
   //exit();
   mysql_query("insert into proveedor (cod_pro, nom_pro, contacto_sec, dire_pro, ciudad_pro, tel_pro, tel_sec, email_pro, desc_pro) 
   values ('$cod_pro','$nom_pro','$contacto_sec', '$dire_pro', '$ciudad_pro', '$tel_pro', '$tel_sec', '$email_pro', '$desc_pro')",$link); 

?>
<?=container_mensaje("Proveedor Añadido... ¿Desea añadir otro?")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=post action=nuevo_proveedor.php>
       <input type=submit name=enviar value=Si class=boton>
       </form>
   </td>
   <td><form method=post action=showall_proveedores.php>
       <input type=submit name=enviar value=No class=boton>
   </form></center>
   </td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<? } ?>
<?=body_container_fin()?>