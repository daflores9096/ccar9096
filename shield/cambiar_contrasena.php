<?php
    session_start();
    include('./acceso_db.php'); // incluímos los datos de conexión a la BD
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
<body style="font-family: Arial">
    <?php
        if(isset($_SESSION['usuario_nombre'])) { // comprobamos que la sesión esté iniciada
            if(isset($_POST['enviar'])) {
                if($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) {
    ?>                
                    <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">Las contrase&ntilde;as ingresadas NO COINCIDEN.</div>

                            <a href='javascript:history.back();'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Reintentar</div></a>

                        </div>
                        </body>    
                    </html>
    <?php                
                } else {
                    $usuario_nombre = $_SESSION['usuario_nombre'];
                    $usuario_clave = mysqli_real_escape_string($link,$_POST["usuario_clave"]);
                    $usuario_clave = md5($usuario_clave); // encriptamos la nueva contraseña con md5
                    $sql = mysqli_query($link,"UPDATE usuarios SET usuario_clave='".$usuario_clave."' WHERE usuario_nombre='".$usuario_nombre."'");
                    if($sql) {
    ?>                    
                        <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">Contrase&ntilde;a cambiada correctamente.</div>

                            <a href='../index.php'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Continuar</div></a>

                        </div>
                        </body>    
                        </html>
    <?php                    
                    } else {
    ?>                    
                        <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">Ha ocurrido un error y no se pudo cambiar la contrase&ntilde;a.</div>

                            <a href='javascript:history.back();'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Reintentar</div></a>

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
                <div style="font-size: 1.3em; margin-top: 20px; margin-bottom: 10px">Nueva contrase&ntilde;a:</div>
                <input type="password" name="usuario_clave" required="true" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
                <div style="font-size: 1.3em; margin-top: 20px; margin-bottom: 10px">Repetir contrase&ntilde;a:</div>
                <input type="password" name="usuario_clave_conf"  required="true" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
                <input type="submit" name="enviar" value="Cambiar contraseña" style="background: #004374; width: 350px; height: 50px; color: #ffffff; font-size: 1.2em; margin: 0 auto; margin-top: 40px; margin-bottom: 40px; padding: 10px; border: none" />
                <a href='../index.php' class="lnkCancelar"><div style="width: 330px; height: 30px; font-size: 1.2em; margin: 0 auto; margin-top: 0px; margin-bottom: 40px; text-align: center">Volver atr&aacute;s</div></a>
            </form>                    
            </div>
    
    <?php
            }
        }else {
            echo "Acceso denegado.";
        }
    ?> 
</body>
</html>