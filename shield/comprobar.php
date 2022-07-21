<?php
session_start();
include('acceso_db.php');
if(isset($_POST['enviar'])) { // comprobamos que se hayan enviado los datos del formulario
    // comprobamos que los campos usuarios_nombre y usuario_clave no est�n vac�os
    if(empty($_POST['usuario_nombre']) || empty($_POST['usuario_clave'])) {
?>        
    <html>
    <body style="background: #ededef">
    <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
        <div style="margin-top: 30px; margin-bottom: 30px">El usuario o la contrase&nacute;a son incorrectos.</div>

        <a href='javascript:history.back();'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Reintentar</div></a>

    </div>
    </body>    
    </html>

<?php        
    }else {
        // "limpiamos" los campos del formulario de posibles c�digos maliciosos
        $usuario_nombre = $_POST['usuario_nombre'];
        $usuario_clave = $_POST['usuario_clave'];
        $usuario_clave = md5($usuario_clave);
        // comprobamos que los datos ingresados en el formulario coincidan con los de la BD
        $qry = "SELECT usuario_id, usuario_nombre, usuario_clave, nivel_acceso FROM usuarios WHERE usuario_nombre='".$usuario_nombre."' AND usuario_clave='".$usuario_clave."'";
        $sql = mysqli_query($link, $qry);
        while ($row = mysqli_fetch_array($sql)){
            $id_user = $row['usuario_id'];
            $name_user = $row['usuario_nombre'];
            $nivel_acceso = $row['nivel_acceso'];
        }

        if(isset($id_user) != '') {
            $_SESSION['usuario_id'] = $id_user; // creamos la sesion "usuario_id" y le asignamos como valor el campo usuario_id
            $_SESSION['usuario_nombre'] = $name_user; // creamos la sesion "usuario_nombre" y le asignamos como valor el campo usuario_nombre
            $_SESSION['nivel_acceso'] = $nivel_acceso;
            header('Location: ../index.php');
        }else {
?>
<!--                Error, <a href="acceso.php">Reintentar</a>-->
                <html>
                <body style="background: #ededef">
                <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
                    <div style="margin-top: 30px; margin-bottom: 30px">El usuario o la contrase&nacute;a son incorrectos.</div>

                    <a href='acceso.php'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Reintentar</div></a>

                </div>
                </body>    
                </html>
<?php
            }
        }
    }else {
        header("Location: acceso.php");
}
?> 