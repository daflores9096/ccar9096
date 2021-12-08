<?php
session_start();
include('shield/acceso_db.php');
if(isset($_SESSION['usuario_nombre'])) {
?>
<html>
<head>
<title>CARIOCA CHILE</title>
<link rel='STYLESHEET' type='text/css' href='./estilos/estilo1.css'>
<meta name="robots" content="noindex">
</head>
<body topmargin='0' leftmargin='0' marginwidth='0' marginheight='0' bottommargin='0' bgcolor='#E1E4F2' style="font-family: Arial">
    <table cellpadding='0' cellspacing='0' width='870' height='100%' bgcolor="#004374" align='center' style="padding: 20px 20px 20px 40px">
        <tr>
            <td colspan="2" style="text-align: right; color: white"><p>Bienvenido <strong><?=$_SESSION['usuario_nombre']?></strong> | <a href="shield/cambiar_contrasena.php" style="color:#F3AC6C">Cambiar contrase&ntilde;a</a>&nbsp;&nbsp; | <a href="shield/logout.php" style="color:#F3AC6C">Cerrar Sesi&oacute;n</a>&nbsp;&nbsp;</p></td>    
        </tr>
        
	<tr>
	<td align=right><img src='./img/icon_inventario.png' width='50' height='50' style="background: #ffffff; border-radius: 5px; padding: 3px" /></td>
	<td><div style="color: #ffffff; font-size: 1.8em;">&nbsp;Inventario</div></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td style="padding-left: 12px"><font color='#FFFFFF' size='2'><b>
                <a href='./tienda/showall_item.php' class='linkmenu'>Lista de Art&iacute;culos</a>
        <?php 
        if ($_SESSION['nivel_acceso'] == '1'){
        ?>        
	-
        <a href='./tienda/showall_inventarios.php' class='linkmenu'> Inventario F&iacute;sico</a>
        <?php } else { }?>
        
	</b></font></td>
	</tr>


	<tr>
	<td align=right><img src='./img/icon_movimientos.png' width='50' height='50' style="background: #ffffff; border-radius: 5px; padding: 3px" /></td>
	<td><div style="color: #ffffff; font-size: 1.8em;">&nbsp;Movimientos (Ingresos y Salidas)</div></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td style="padding-left: 12px"><font color='#FFFFFF' size='2'><b>
            <?php 
            if ($_SESSION['nivel_acceso'] == '1'){
            ?>  
		<a href='./tienda/showall_compras.php' class='linkmenu'>Compras</a>
         - 
            <?php 
            }
            ?>    
		<a href='./tienda/showall_ventas.php' class='linkmenu'> Ventas</a>

	</b></font></td>
	</tr>

	<tr>
            <td align=right><img src='./img/icon_contactos.png' width='50' height='50' style="background: #ffffff; border-radius: 5px; padding: 3px"></td>
            <td><div style="color: #ffffff; font-size: 1.8em;">&nbsp;Contactos</div></td>
	</tr>

    <tr>
	<td>&nbsp;</td>
	<td style="padding-left: 12px"><font color='#FFFFFF' size='2'><b>
        <?php 
        if ($_SESSION['nivel_acceso'] == '1'){
        ?>        
    <a href='./tienda/showall_proveedores.php' class='linkmenu'>Proveedores</a>
	-
        <?php 
        }
        ?>
    <a href='./tienda/showall_clientes.php' class='linkmenu'>Clientes</a>
    </b></font></td>
	</tr>

        <?php 
        if ($_SESSION['nivel_acceso'] == '1'){
        ?>
	<tr>
	<td align=right><img src='./img/icon_reportes.png' width='50' height='50' style="background: #ededef; border-radius: 5px; padding: 3px" /></td>
	<td><div style="color: #ffffff; font-size: 1.8em;">&nbsp;Reportes</div></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td style="padding-left: 12px"><font color='#FFFFFF' size='2'><b>
    	<a href='./tienda/find_compras.php' class='linkmenu'>Reporte de Compras</a>
         - 
		<a href='./tienda/find_ventas.php' class='linkmenu'> Reporte de Ventas</a>
    </b></font></td>
	</tr>
        <?php } ?>

        <?php 
        if ($_SESSION['nivel_acceso'] == '1'){
        ?>
	<tr>
	<td align=right><img src='./img/icon_backup.png' width='50' height='50' style="background: #ffffff; border-radius: 5px; padding: 3px" /></td>
	<td><div style="color: #ffffff; font-size: 1.8em;">&nbsp;Respaldos</div></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td style="padding-left: 12px"><font color='#FFFFFF' size='2'><b>
		<a href='./tienda/backup_respaldo.php' class='linkmenu'> Crear respaldo</a>
		 -
		<a href='./tienda/backup_respaldo2.php' class='linkmenu'> Crear respaldo en disco</a>
                 - 
		<a href='./tienda/backup_respaldo.php?restaura=si' class='linkmenu'> Restaurar respaldo</a>
                 - 
		<a href='./tienda/reset_tables.php' class='linkmenu'> Reiniciar Base de Datos</a>
            </b></font></td>
	</tr>
        <?php } ?>
        
        <?php 
        if ($_SESSION['nivel_acceso'] == '1'){
        ?>
        <tr>
	<td align=right><img src='./img/icon_usuarios.jpg' width='50' height='50' style="background: #ffffff; border-radius: 5px; padding: 3px" /></td>
	<td><div style="color: #ffffff; font-size: 1.8em;">&nbsp;Usuarios</div></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td style="padding-left: 12px"><font color='#FFFFFF' size='2'><b>
		<a href='./shield/registro.php' class='linkmenu'> Registrar nuevo usuario</a>
            </b></font></td>
	</tr>
        <?php } ?>
	<tr>
	<td colspan='2'>&nbsp;</td>
	</tr>

</table>

</body>
</html>
<?php
    }else {
?>        
        <html>
        <body style="background: #ededef">
        <div id="contenedor_login" style="width: 400px; height: 150px; background: #ffffff; margin: 0 auto; margin-top: 100px; border: 1px solid #ccc; text-align: center; padding: 20px; font-family: Arial">
            <div style="margin-top: 20px; margin-bottom: 10px; font-size: 1.2em">CARIOCA</div>
            <div style="margin-top: 10px; margin-bottom: 20px">Acceso restringido</div>
            
            <a href='shield/acceso.php'><div style="background: #004374; width: 120px; height: 30px; color: #ffffff; margin: 0 auto; padding-top: 10px">Ingresar</div></a>
            
        </div>
        </body>    
        </html>
        
<?php        
    }
?> 