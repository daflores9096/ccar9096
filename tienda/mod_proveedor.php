<head>
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
   $ide=$_GET['ide'];

   mysqli_query($link,"UPDATE proveedor SET cod_pro='$cod_pro', nom_pro='$nom_pro', contacto_sec='$contacto_sec', dire_pro='$dire_pro', ciudad_pro='$ciudad_pro', tel_pro='$tel_pro', tel_sec='$tel_sec', email_pro='$email_pro', desc_pro='$desc_pro' 
   				WHERE cod_pro=$ide");

?>
<?=body_container_ini("","770","0")?>
<br><br>

<?=container_mensaje("Datos de Proveedor Modificado")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=get action=showall_proveedores.php>
       <INPUT TYPE=hidden NAME=cod_pro VALUE=$cod_pro>
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