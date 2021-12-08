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
   $id=$_GET['cod_cli'];
   
   mysql_query("DELETE FROM cliente WHERE cod_cli='$id'",$link);   
?>

<?=body_container_ini("","770","550")?>
<br>
<?=container_mensaje("Cliente eliminado?")?>
<br> 
<?
   echo"
   <table align=center>
   <tr>
    <td>
	   <form method=post action=anular_clientes.php>
       <input type=submit name=enviar value=Continuar class=boton>
       </form></center>
	</td>
   </tr>
   </table>
   ";
?> 
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?=body_container_fin()?>