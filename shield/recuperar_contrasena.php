<?php
    include('acceso_db.php'); // incluímos los datos de acceso a la BD
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        a.lnkCancelar:link{font-size:1em; text-decoration:none; color:#C81E22; font-weight: normal}
        a.lnkCancelar:visited {font-size:1em; text-decoration:none;color:#C81E22; font-weight: normal}
        a.lnkCancelar:hover {font-size:1em; text-decoration: underline; color: #C81E22; font-weight: normal}
    </style>
</head>
<body>
    <?php
        if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos del formulario
            if(empty($_POST['usuario_nombre'])) {
    ?>            
                <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">No ha ingresado el usuario.</div>

                            <a href='recuperar_contrasena.php'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Volver atr&aacute;s</div></a>

                        </div>
                        </body>    
                </html>
    <?php            
            }else {
                $usuario_nombre = mysql_real_escape_string($_POST['usuario_nombre']);
                $usuario_nombre = trim($usuario_nombre);
                $sql = mysql_query("SELECT usuario_nombre, usuario_clave, usuario_email FROM usuarios WHERE usuario_nombre='".$usuario_nombre."'");
                if(mysql_num_rows($sql)) {
                    $row = mysql_fetch_assoc($sql);
                    $num_caracteres = "10"; // asignamos el número de caracteres que va a tener la nueva contraseña
                    $nueva_clave = substr(md5(rand()),0,$num_caracteres); // generamos una nueva contraseña de forma aleatoria
                    $usuario_nombre = $row['usuario_nombre'];
                    $usuario_clave = $nueva_clave; // la nueva contraseña que se enviará por correo al usuario
                    $usuario_clave2 = md5($usuario_clave); // encriptamos la nueva contraseña para guardarla en la BD
                    $usuario_email = $row['usuario_email'];
                    // actualizamos los datos (contraseña) del usuario que solicitó su contraseña
                    mysql_query("UPDATE usuarios SET usuario_clave='".$usuario_clave2."' WHERE usuario_nombre='".$usuario_nombre."'");
                    // Enviamos por email la nueva contraseña
                    $remite_nombre = "Sistema Carioca"; // Tu nombre o el de tu página
                    $remite_email = "azul3d@gmail.com"; // tu correo
                    $asunto = "Recuperación de contraseña"; // Asunto (se puede cambiar)
                    $mensaje = "Se ha generado una nueva contraseña para el usuario <strong>".$usuario_nombre."</strong>. La nueva contraseña es: <strong>".$usuario_clave."</strong>.";
                    $cabeceras = "From: ".$remite_nombre." <".$remite_email.">\r\n";
                    $cabeceras = $cabeceras."Mime-Version: 1.0\n";
                    $cabeceras = $cabeceras."Content-Type: text/html";
                    $enviar_email = mail($usuario_email,$asunto,$mensaje,$cabeceras);
                    if($enviar_email) {
    ?>                    
                        <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">La nueva contraseña ha sido enviada al email asociado al usuario <strong><?php echo $usuario_nombre ?></strong>.</div>

                            <a href='acceso.php'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Iniciar sesi&oacute;n</div></a>

                        </div>
                        </body>    
                        </html>
    <?php                    
                    }else {
    ?>                    
                        <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">No se ha podido enviar el email.</div>
                            <a href='recuperar_contrasena.php'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Volver atr&aacute;s</div></a>

                        </div>
                        </body>    
                        </html>
    <?php                    
                    }
                }else {
    ?>                                    
                    <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">El usuario <strong><?php echo $usuario_nombre ?></strong> no est&aacute; registrado.</div>

                            <a href='recuperar_contrasena.php'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Volver atr&aacute;s</div></a>

                        </div>
                        </body>    
                    </html>
    <?php                
                }
            }
        }else {
    ?>
        <div style="margin: 0 auto; margin-top: 100px; width: 540px; border: 1px solid #ccc; background: #ffffff">
        <div style="width: 500px; background: #004374; color: #ffffff; font-size: 2.5em; text-align: center; padding: 20px">CARIOCA</div>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" style="width: 350px; margin: 0 auto">
            <div style="font-size: 1.3em; margin-top: 20px; margin-bottom: 10px">Usuario:</div>
            <input type="text" name="usuario_nombre"  required="true" placeholder="Ingresa tu nombre de usuario" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
            <input type="submit" name="enviar" value="Recuperar contraseña" style="background: #004374; width: 350px; height: 50px; color: #ffffff; font-size: 1.2em; margin: 0 auto; margin-top: 40px; margin-bottom: 40px; padding: 10px; border: none" />
            <a href='../index.php' class="lnkCancelar"><div style="width: 330px; height: 30px; font-size: 1.2em; margin: 0 auto; margin-top: 0px; margin-bottom: 40px; text-align: center">Volver atr&aacute;s</div></a>
	</form>                    
        </div>

    <?php
        }
    ?> 
</body>
</html>