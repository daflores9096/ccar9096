<?
include("conexion.php");
include("lib_consulta_prod.php");
include("lib_formato_usu.php");
include("lib_permisos.php");
$link=Conectarse("usuarios");
$ssql = "SELECT *
		 FROM usuario
         WHERE nombre='$usuario' and clave='$contrasena'";
$rs = mysql_query($ssql,$link);
$row=mysql_fetch_array($rs);
if (mysql_num_rows($rs)!=0)
{
//////////verificamos si tiene acceso al area seleccionada///////////
    $db="usuarios";
    $usr=$row[Id];
    if($titulo=="GRANJAS")
       	$op=12;
    if($titulo=="MOLINOS")
    	$op=10;
    if($titulo=="COMERCIALIZACION")
    	$op=6;
    if($titulo=="CONFIGURACION")
    	$op=1;
    list ($op1, $op2, $op3, $op4, $op5, $op6, $op7, $op8, $op9, $op10, $op11, $op12)=permisos_nivel1($db,$usr,$titulo,$op);
	if($op1==1||$op2==1||$op3==1||$op4==1||$op5==1||$op6==1||$op7==1||$op8==1||$op9==1||$op10==1||$op11==1||$op12==1)
    {
        //session_name('idusuario');
	    session_start();
	    //session_register('idusuario');
	    //$_SESSION['idusuario'] = $row[Id];
	    //header ("Location:menu.php");
	    //session_register("autentificado");
	    //$autentificado = "SI";
	    $_SESSION['autentificado'] = "SI";
	    $_SESSION['idusuario'] = $row[Id];
	    //header ("Location:menu.php?usr=".$row[Id]);

    	if($titulo=="GRANJAS")
        	header ("Location:../menu/granjas.php");
        if($titulo=="MOLINOS")
        	header ("Location:../menu/menu2.php");
        if($titulo=="COMERCIALIZACION")
        	header ("Location:../menu/menu1.php");
        if($titulo=="CONFIGURACION")
        	header ("Location:../menu/usuarios.php");
    }
    //if($op1==0 && $titulo=="CONFIGURACION")
    else
    {
        echo"
        <html>
	    <head>
	    <style type='text/css'>
	      .boton{
	            font-size:10px;
	            font-family:Verdana,Helvetica;
	            font-weight:bold;
	            color:white;
	            background:#e78000;
	            border:0px;
	            width:80px;
	            height:19px;
	           }
	    </style>
	    </head>";
        body_container_ini("","770","550");
	    echo"<br>";
	    container_mensaje("Usted no tiene permiso para acceder a esta opcion<br>Consulte con el Administrador del Sistema");
	    echo"
        <br>
          <table align=center>
	       <tr>
	        <td>
	           <form action='../index.htm'>
	           <input type='submit' name='enviar' value='Continuar' class='boton'>
	           </form></center>
	        </td>
	       </tr>
	       </table>
	    <br><br><br><br><br><br><br><br><br><br><br><br><br>";
	    body_container_fin();
    	header("Location:../menu/index.php?titulo=".$titulo);
    }
}
else
    header("Location:../menu/index.php?errorusuario=si&titulo=".$titulo);
mysql_free_result($rs);
//mysql_close($conn);
?>