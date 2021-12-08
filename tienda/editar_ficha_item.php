<html>
<head>
<link rel="STYLESHEET" type="text/css" href="../estilos/estilo1.css">
</head>

<?php 
   include("../lib/conexion.php");
   include("../lib/lib_formato.php"); 
   $link=Conectarse("carioca"); 
   $id=$_GET["cod_item"];
   $nom_item=$_GET["nom_item"]; 
   $unid_item=$_GET["unid_item"];
   $precio_item=$_GET["precio_item"];
   $caja_item=$_GET['caja_item'];
   $exi_max=$_GET["exi_max"];
   $existencia=$_GET["existencia"];
   $exi_min=$_GET["exi_min"];
   $deta_item=$_GET["deta_item"];
   $ide=$_GET["ide"];
    
   mysql_query("UPDATE item SET cod_item='$id', nom_item='$nom_item', unid_item='$unid_item', precio_item='$precio_item', caja_item='$caja_item', exi_max='$exi_max', existencia='$existencia', exi_min='$exi_min', deta_item='$deta_item' 
                WHERE cod_item='$ide'",$link);  
?>
<?=body_container_ini("","770","550")?>
<br>
<?=container_mensaje("Registro modificado")?>
<br> 
<?
   echo"
   <table align=center>
   <tr>
    <td>
	   <form method=post action=showall_item.php>
       <input type=submit name=enviar value=Continuar class=boton>
       </form></center>
	</td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>