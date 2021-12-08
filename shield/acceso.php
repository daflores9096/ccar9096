<?php
session_start();
include('../shield/acceso_db.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
        <style>
            a.lnkPass:link{font-size:1em; text-decoration:none; color:#004374; font-weight: normal}
            a.lnkPass:visited {font-size:1em; text-decoration:none;color:#004374; font-weight: normal}
            a.lnkPass:hover {font-size:1em; text-decoration: underline; color: #004374; font-weight: normal}
        </style>
</head>
<body style="font-family: Arial; background: #ededef">
	<?php
	    if(empty($_SESSION['usuario_nombre'])) { // comprobamos que las variables de sesión estén vacías        
	?>
    
    <div style="margin: 0 auto; margin-top: 100px; width: 540px; border: 1px solid #ccc; background: #ffffff">
        <div style="width: 500px; background: #004374; color: #ffffff; font-size: 2.5em; text-align: center; padding: 20px">CARIOCA</div>
        <div style="width: 350px; margin: 0 auto; border: 0px solid orange; font-size: 1.8em; margin-top: 30px; margin-bottom: 30px">Iniciar Sesi&oacute;n</div>
        <form action="../shield/comprobar.php" method="post" style="width: 350px; margin: 0 auto">
            <div style="font-size: 1.3em; margin-top: 20px">Nombre de usuario:</div>
            <input type="text" name="usuario_nombre"  required="true" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
            <div style="font-size: 1.3em; margin-top: 20px">Contraseña:</div>
            <input type="password" name="usuario_clave"  required="true" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
	    <div style="margin-top: 10px"><a href="../shield/recuperar_contrasena.php" class="lnkPass">Recuperar contraseña</a></div>
            <input type="submit" name="enviar" value="Iniciar sesi&oacute;n" style="background: #004374; width: 350px; height: 50px; color: #ffffff; font-size: 1.2em; margin: 0 auto; margin-top: 40px; margin-bottom: 40px; padding: 10px; border: none" />
	</form>                    
    </div>
	        
	<?php
	    }else {
	?>
	        <p>Hola <strong><?=$_SESSION['usuario_nombre']?></strong> | <a href="logout.php">Salir</a></p>
	<?php
	    }
	?>  
</body>
</html>