<?php
include ("seguridad.php");
include ("conexion.php");
include ("lib_consulta2.php");
include ("lib_formato.php");
include ("lib_estilo.php");
estilo();
body_container_ini("MENU","770","550");
lista_ini("<FONT COLOR=FEE3D3>PANEL DE CONTROL</FONT>","100%");
echo"<br>";
//session_register("idusuario");
$usr=$_SESSION['idusuario'];
$j=0;
$l=0;
echo"
<table width=100% bgcolor='#D0FF00' border=2>
<tr>";
for ($k=1; $k<6; $k++)
{
    switch ($k)
    {
      case 1:
        $titulo="GRANJAS";
        $op=6;
        break;
      case 2:
        $titulo="MOLINOS";
        $op=6;
        break;
      case 3:
        $titulo="COMERCIALIZACION";
        $op=6;
        break;
      case 4:
        $titulo="WEB";
        $op=6;
        break;
      case 5:
        $titulo="USUARIOS";
        $op=1;
        break;
      case 6:
        $titulo="PRODUCCION";
        $op=6;
        break;
    }
    echo"
    <td>
    <table width=100% bgcolor='#FFDD00' border=1>
    <tr>
    <td align=center colspan='3'>$titulo</td>
    </tr>
    <tr>";
    $l++;
    $db="usuarios";
    list ($op1, $op2, $op3, $op4, $op5, $op6)=permisos_nivel1($db,$usr,$titulo,$op);
	for ($i=1; $i<=$op; $i++)
	{
    	if($j==3)
	    {
	        echo"</tr>
	        <tr>";
	        $j=0;
	    }
        switch ($titulo)
        {
////////////////////////////OPCIONES GRANJAS///////////////////////////////////
          case "GRANJAS":
        	switch ($i)
	        {
	          case 1:
	            if($op1==1)
	            {
	                echo"<td><a href='../granjas/granjas.php'>control granjas</a></td>";
	                $j++;
	            }
	            break;
	          case 2:
	            if($op2==1)
	            {
	                echo"<td><a href='../granjas/galpones.php'>control galpones</a></td>";
	                $j++;
	            }
	            break;
              case 3:
	            if($op3==1)
	            {
	                echo"<td><a href='../granjas/lotes.php'>control lotes</a></td>";
	                $j++;
	            }
	            break;
              case 4:
	            if($op4==1)
	            {
	                echo"<td><a href='../granjas/fichas.php'>control fichas</a></td>";
	                $j++;
	            }
	            break;
              case 5:
	            if($op5==1)
	            {
	                echo"<td><a href=''>reportes</a></td>";
	                $j++;
	            }
	            break;
	        }
          break;
////////////////////////////OPCIONES MOLINOS///////////////////////////
          case "MOLINOS":
        	switch ($i)
	        {
	          case 1:
	            if($op1==1)
	            {
	                echo"<td><a href=''>controles op1</a></td>";
	                $j++;
	            }
	            break;
	          case 2:
	            if($op2==1)
	            {
	                echo"<td><a href=''>controles op2</a></td>";
	                $j++;
	            }
	            break;
              case 3:
	            if($op3==1)
	            {
	                echo"<td><a href=''>controles op3</a></td>";
	                $j++;
	            }
	            break;
              case 4:
	            if($op4==1)
	            {
	                echo"<td><a href=''>controles op4</a></td>";
	                $j++;
	            }
	            break;
              case 5:
	            if($op5==1)
	            {
	                echo"<td><a href=''>controles op5</a></td>";
	                $j++;
	            }
	            break;
	        }
          break;
////////////////////////////OPCIONES COMERCIALIZACION///////////////////////////
          case "COMERCIALIZACION":
        	switch ($i)
	        {
	          case 1:
	            if($op1==1)
	            {
	                echo"<td><a href=''>controles op1</a></td>";
	                $j++;
	            }
	            break;
	          case 2:
	            if($op2==1)
	            {
	                echo"<td><a href=''>controles op2</a></td>";
	                $j++;
	            }
	            break;
              case 3:
	            if($op3==1)
	            {
	                echo"<td><a href=''>controles op3</a></td>";
	                $j++;
	            }
	            break;
              case 4:
	            if($op4==1)
	            {
	                echo"<td><a href=''>controles op4</a></td>";
	                $j++;
	            }
	            break;
              case 5:
	            if($op5==1)
	            {
	                echo"<td><a href=''>controles op5</a></td>";
	                $j++;
	            }
	            break;
	        }
          break;
          ////////////////////////////OPCIONES WEB///////////////////////////
          case "WEB":
        	switch ($i)
	        {
	          case 1:
	            if($op1==1)
	            {
	                echo"<td><a href=''>controles op1</a></td>";
	                $j++;
	            }
	            break;
	          case 2:
	            if($op2==1)
	            {
	                echo"<td><a href=''>controles op2</a></td>";
	                $j++;
	            }
	            break;
              case 3:
	            if($op3==1)
	            {
	                echo"<td><a href=''>controles op3</a></td>";
	                $j++;
	            }
	            break;
              case 4:
	            if($op4==1)
	            {
	                echo"<td><a href=''>controles op4</a></td>";
	                $j++;
	            }
	            break;
              case 5:
	            if($op5==1)
	            {
	                echo"<td><a href=''>controles op5</a></td>";
	                $j++;
	            }
	            break;
	        }
          break;
          ////////////////////////////OPCIONES USUARIOS///////////////////////////
          case "USUARIOS":
        	switch ($i)
	        {
	          case 1:
	            if($op1==1)
	            {
	                echo"<td><a href='../backup/index.php'>backups</a></td>";
                    echo"<td><a href='../usuarios/susuario.php'>control usuarios</a></td>";
	                $j++;
	            }
                else
                {
                    echo"<td><a href='../usuarios/datospassword.php?usuario=si'>cambiar contraseña</a></td>";
	                $j++;
                }
	            break;
	        }
          break;
        }
	};
    echo"</tr>
	</table>";
    if($l==2)
    {
    	echo"</tr><tr>";
        $l=0;
        $j=0;
    }
    else
    {
    	echo"</td>";
        $j=0;
    }
};
echo"</tr></table>
<br>
<table align='center'>
<tr>
<td>
<form method='post' action='../index.php'>
<input type='submit' name='enviar' value='Salir' class='boton'>
</form>
</td>

</tr>
</table>";

lista_fin();
body_container_fin();
?>