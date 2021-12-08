<html>
<head>
<title>Registrando Nuevo Cliente</title>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>
<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 
   $cod_cli=$_GET['cod_cli']; 
   $nom_cli=$_GET['nom_cli'];
   $contacto_sec=$_GET['contacto_sec'];
   $dire_cli=$_GET['dire_cli'];
   $dire_sec=$_GET['dire_sec'];
   $ciudad_cli=$_GET['ciudad_cli'];
   $tel_cli=$_GET['tel_cli'];
   $tel_sec=$_GET['tel_sec'];
   $email_cli=$_GET['email_cli'];   
   $desc_cli=$_GET['desc_cli'];   
   
$get=mysql_query("SELECT * FROM cliente WHERE cod_cli=$cod_cli",$link);
$result=mysql_fetch_array($get);
?>
<?=body_container_ini("","770","550")?>
<br>
<?php
if ($cod_cli=='' || $nom_cli=='') {
?>
<?=container_mensaje("Por favor... No debe dejar campos en blanco...")?>
<?php
echo"
<br>
<form method=post action=../tienda/nuevo_cliente.php>
<center><input type=button value=Atras onClick=history.go(-1) class=boton></center>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
";
}

else if($result[0]==$cod_cli){
?>
<?=container_mensaje("Existe duplicidad de CODIGO... por favor pruebe con otro.")?>
<?php
echo"
<br>
<form method=post action=../tienda/nuevo_cliente.php>
<center><input type=button value=Atras onClick=history.go(-1) class=boton></center>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
";
} else {
   //$qry = "insert into cliente (cod_cli, nom_cli, contacto_sec, dire_cli, dire_sec, ciudad_cli, tel_cli, tel_sec, email_cli, desc_cli) values ('$cod_cli','$nom_cli','$contacto_sec', '$dire_cli', '$dire_sec', '$ciudad_cli', '$tel_cli', '$tel_sec', '$email_cli', '$desc_cli')";
   //echo $qry;
   //exit();
   mysql_query("insert into cliente (cod_cli, nom_cli, contacto_sec, dire_cli, dire_sec, ciudad_cli, tel_cli, tel_sec, email_cli, desc_cli) 
   values ('$cod_cli','$nom_cli','$contacto_sec', '$dire_cli', '$dire_sec', '$ciudad_cli', '$tel_cli', '$tel_sec', '$email_cli', '$desc_cli')",$link); 

?>
<?=container_mensaje("Cliente Añadido... ¿Desea añadir otro?")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=post action=nuevo_cliente.php>
       <input type=submit name=enviar value=Si class=boton>
       </form>
   </td>
   <td><form method=post action=showall_clientes.php>
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