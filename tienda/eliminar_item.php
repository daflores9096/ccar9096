<html><head>
<style type="text/css">
  .boton{
        font-size:10px;
        font-family:Verdana,Helvetica;
        font-weight:bold;
        color:white;
        background:#5e8cb5;
        border:0px;
        width:80px;
        height:19px;
       }
</style>
</head>

<?php 
   include("../lib/conexion.php"); 
   include("../lib/lib_formato.php");   
   $link=Conectarse("carioca"); 
   $id=$_GET['cod_item'];
   
   mysql_query("DELETE FROM item WHERE cod_item='$id'",$link);   
?>

<?=body_container_ini("","770","550")?>
<br>
<?=container_mensaje("Articulo eliminado")?>
<br> 
<?
   echo"
   <table align=center>
   <tr>
    <td>
	   <form method=post action=anular_item.php>
       <input type=submit name=enviar value=Continuar class=boton>
       </form></center>
	</td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>