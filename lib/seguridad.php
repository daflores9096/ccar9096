<?
//TOMO VARIABLES DE SESION SOBRE LA AUTENTIFICACION
session_register("autentificado");
//session_register('idusuario');
//echo 'nombre:'.session_name().'la sesion es:'.$_SESSION['idusuario'].'el idusario es:'.$idusuario;
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if ($autentificado != "SI") {
/*if ($idusuario != $_SESSION['idusuario'])
{ */
    //si no existe, envio a la página de autentificacion
    //header("Location:http://localhost/Tesis/Sistema/index.php");
    header("Location:../menu/index.php");
    //ademas salgo de este script
    exit();
}
?>