<head>
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
   $ide=$_GET['ide'];

   mysql_query("UPDATE cliente SET cod_cli='$cod_cli', nom_cli='$nom_cli', contacto_sec='$contacto_sec', dire_cli='$dire_cli', dire_sec='$dire_sec', ciudad_cli='$ciudad_cli', tel_cli='$tel_cli', tel_sec='$tel_sec', email_cli='$email_cli', desc_cli='$desc_cli' 
   				WHERE cod_cli=$ide",$link); 

?>
<?=body_container_ini("","770","550")?>
<br><br>

<?=container_mensaje("Datos de Cliente Modificado")?>
<br>
<?php
echo"
   <table align=center>
   <tr>
   <td><form method=get action=ver_ficha_cliente.php>
       <INPUT TYPE=hidden NAME=cod_cli VALUE=$cod_cli>
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