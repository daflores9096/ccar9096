<?php
include('acceso_db.php'); // incluimos el archivo de conexión a la Base de Datos
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
	    if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos desde el formulario
	        // creamos una función que nos parmita validar el email
	        function valida_email($correo) {
	            if (preg_match('/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+\.[A-Za-z]{2,4}$/', $correo)) return true;
	            else return false;
	        }
	        // Procedemos a comprobar que los campos del formulario no estén vacíos
	        $sin_espacios = count_chars($_POST['usuario_nombre'], 1);
	        if(!empty($sin_espacios[32])) { // comprobamos que el campo usuario_nombre no tenga espacios en blanco
	            echo "El campo <em>usuario_nombre</em> no debe contener espacios en blanco. <a href='javascript:history.back();'>Reintentar</a>";
	        }elseif(empty($_POST['usuario_nombre'])) { // comprobamos que el campo usuario_nombre no esté vacío
	            echo "No haz ingresado tu usuario. <a href='javascript:history.back();'>Reintentar</a>";
	        }elseif(empty($_POST['usuario_clave'])) { // comprobamos que el campo usuario_clave no esté vacío
	            echo "No haz ingresado contraseña. <a href='javascript:history.back();'>Reintentar</a>";
	        }elseif($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) { // comprobamos que las contraseñas ingresadas coincidan
            ?>        
                    <html>
                    <body style="background: #ededef">
                    <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                        <div style="margin-top: 30px; margin-bottom: 30px">Las contrase&ntilde;as ingresadas no coinciden.</div>

                        <a href='javascript:history.back();'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Reintentar</div></a>

                    </div>
                    </body>    
                    </html>
            <?php        
	        }elseif(!valida_email($_POST['usuario_email'])) { // validamos que el email ingresado sea correcto
	            echo "El email ingresado no es válido. <a href='javascript:history.back();'>Reintentar</a>";
	        }else {
	            // "limpiamos" los campos del formulario de posibles códigos maliciosos
	            $usuario_nombre = mysqli_real_escape_string($link,$_POST['usuario_nombre']);
	            $usuario_clave = mysqli_real_escape_string($link,$_POST['usuario_clave']);
	            $usuario_email = mysqli_real_escape_string($link,$_POST['usuario_email']);
	            // comprobamos que el usuario ingresado no haya sido registrado antes
	            $sql = mysqli_query($link,"SELECT usuario_nombre FROM usuarios WHERE usuario_nombre='".$usuario_nombre."'");
	            if(mysqli_num_rows($sql) > 0) {
            ?>            
                        <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">El nombre usuario elegido ya ha sido registrado anteriormente.</div>

                            <a href='javascript:history.back();'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Continuar</div></a>

                        </div>
                        </body>    
                        </html>
            <?php            
	            }else {
	                $usuario_clave = md5($usuario_clave); // encriptamos la contraseña ingresada con md5
	                // ingresamos los datos a la BD
	                $reg = mysqli_query($link,"INSERT INTO usuarios (usuario_nombre, usuario_clave, usuario_email, usuario_freg) VALUES ('".$usuario_nombre."', '".$usuario_clave."', '".$usuario_email."', NOW())");
	                if($reg) {
            ?>                
                        <html>
                        <body style="background: #ededef">
                        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                            <div style="margin-top: 30px; margin-bottom: 30px">Usuario creado correctamente.</div>

                            <a href='../index.php'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Continuar</div></a>

                        </div>
                        </body>    
                        </html>
            <?php                
	                }else {
	                    echo "ha ocurrido un error y no se registraron los datos.";
	                }
	            }
	        }
	    }else {
	?>
    
                <div style="margin: 0 auto; margin-top: 100px; width: 540px; border: 1px solid #ccc; background: #ffffff">
                <div style="width: 500px; background: #004374; color: #ffffff; font-size: 2.5em; text-align: center; padding: 20px">CARIOCA</div>
                <div style="width: 350px; margin: 0 auto; border: 0px solid orange; font-size: 1.8em; margin-top: 30px; margin-bottom: 30px">Crear nuevo usuario</div>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="post" style="width: 350px; margin: 0 auto">
                    <div style="font-size: 1.3em; margin-top: 20px; margin-bottom: 10px">Usuario:</div>
                    <input type="text" name="usuario_nombre" required="true" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
                    <div style="font-size: 1.3em; margin-top: 20px; margin-bottom: 10px">Contrase&ntilde;a:</div>
                    <input type="password" name="usuario_clave"  required="true" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
                    <div style="font-size: 1.3em; margin-top: 20px; margin-bottom: 10px">Repetir Contrase&ntilde;a:</div>
                    <input type="password" name="usuario_clave_conf"  required="true" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
                    <div style="font-size: 1.3em; margin-top: 20px; margin-bottom: 10px">Email:</div>
                    <input type="email" name="usuario_email" required="true" style="width: 308px; height: 30px; font-size: 1.2em; border: 1px solid #bebebe; border-radius: 3px; padding: 10px 20px;" /><br />
                    <input type="submit" name="enviar" value="Guardar" style="background: #004374; width: 350px; height: 50px; color: #ffffff; font-size: 1.2em; margin: 0 auto; margin-top: 40px; margin-bottom: 40px; padding: 10px; border: none" />
                    <input type="reset" value="Limpiar formulario" style="background: #004374; width: 350px; height: 50px; color: #ffffff; font-size: 1.2em; margin: 0 auto; margin-bottom: 40px; padding: 10px; border: none" />
                    
                    <a href='../index.php' class="lnkCancelar"><div style="width: 330px; height: 30px; font-size: 1.2em; margin: 0 auto; margin-top: 0px; margin-bottom: 40px; text-align: center">Volver atr&aacute;s</div></a>
                </form>                    
                </div>
    
<!--		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		    <label>Usuario:</label><br />
		    <input type="text" name="usuario_nombre" maxlength="15" /><br />
		    <label>Contraseña:</label><br />
		    <input type="password" name="usuario_clave" maxlength="15" /><br />
		    <label>Confirmar Contraseña:</label><br />
		    <input type="password" name="usuario_clave_conf" maxlength="15" /><br />
		    <label>Email:</label><br />
		    <input type="text" name="usuario_email" maxlength="50" /><br />
		    <input type="submit" name="enviar" value="Registrar" />
		    <input type="reset" value="Borrar" />
		</form>-->
	<?php
	    }
	?> 
</body>
</html>