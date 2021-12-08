<?php
global $permisos_nivel2;
global $permisos_nivel1;
global $tamano1;
$permisos_nivel2=array(",mcgranjas,",",ecgranjas,",",acgranjas,",",mcgalpones,",",ecgalpones,",",acgalpones,",",mclotes,",",eclotes,",",aclotes,",",mmop1,",",emop1,",",amop1,",",mmop2,",",amop2,",",mmop3,",",amop3,",",mmop4,",",amop4,",",mmop5,",",amop5,",",mmop6,",",amop6,",",mmop7,",",emop7,",",amop7,",",mmop8,",",emop8,",",amop8,",",mvop1,",",avop1,",",mvop3,",",avop3,",",mvop4,",",evop4,",",avop4,");
$permisos_nivel1=array(",gop1,",",gop2,",",gop3,",",gop4,",",gop5,",",gop6,",",gop7,",",gop8,",",gop9,",",gop10,",",gop11,",",gop12,",",mop1,",",mop2,",",mop3,",",mop4,",",mop5,",",mop6,",",mop7,",",mop8,",",mop9,",",mop10,",",vop1,",",vop2,",",vop3,",",vop4,",",vop5,",",vop6,",",vop7,");
//$tamano1 = count($permisos_nivel1);

/////////////////////////////////////////////////////////////////////////////////
function arbol_permisos($id_usuario)
{
global $permisos_nivel2,$permisos_nivel1;
$link=Conectarse("usuarios");
//$id_usuario=$_GET['id_usuario'];
$result=mysql_query("SELECT a.nivel1,a.nivel2
					 FROM usuario u,area a
                     WHERE u.Id='$id_usuario' and u.Id=a.id_usuario",$link);
$row=mysql_fetch_array($result);
$nivel1=$row[nivel1];
$nivel2=$row[nivel2];
?>
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script  src="js/dhtmlXCommon.js"></script>
	<script  src="js/dhtmlXTree.js"></script>
    <script>
	var tree = null;
    function doOnLoad()
    {
		preLoadImages();
		tree=new dhtmlXTreeObject(document.getElementById('treebox1'),"100%","100%",0);
		tree.setImagePath("imgs/");
		tree.setDragHandler();
		tree.enableCheckBoxes(true);
		tree.enableThreeStateCheckboxes(true);
		tree.enableDragAndDrop(true);
        tree.loadXML("tree3.xml");
    }
	function preLoadImages()
    {
		var imSrcAr = new Array("line1.gif","line2.gif","line3.gif","line4.gif","minus2.gif","minus3.gif","minus4.gif","plus2.gif","plus3.gif","plus4.gif","book.gif","books_open.gif","books_close.gif","magazines_open.gif","magazines_close.gif","tombs.gif","tombs_mag.gif","book_titel.gif","iconCheckAll.gif")
		var imAr = new Array(0);
		for(var i=0;i<imSrcAr.length;i++)
        {
			imAr[imAr.length] = new Image();
			imAr[imAr.length-1].src = "imgs/"+imSrcAr[i]
		}
	}
    function niveles()
    {
        <?php
	    for ($i=0;$permisos_nivel1[$i]; $i++)
	    {
        	$permisos_nivel1[$i]=str_replace(",", "", $permisos_nivel1[$i]);
            if($nivel1[$i]==1)
	           	echo"tree.setCheck('".$permisos_nivel1[$i]."',true);";
        }
        for ($i=0;$permisos_nivel2[$i]; $i++)
	    {
        	$permisos_nivel2[$i]=str_replace(",", "", $permisos_nivel2[$i]);
        	if($nivel2[$i]==1)
	           	echo"tree.setCheck('".$permisos_nivel2[$i]."',true);";
            else
               	echo"tree.setCheck('".$permisos_nivel2[$i]."',false);";

	    };
    	?>
        document.susr.modpermiso.value='si';
    }
	function nuevo()
	{
	    document.susr.permiso.value=tree.getAllChecked();
	}
</script>
<?php
}
//////////////////////////////////////////////////////////////////////////////////////////
function permisos($db,$select,$from,$where,$nivel,$subarea)
{
$link=Conectarse("$db");
$ssql = "SELECT $select
		 FROM $from
         WHERE $where";
$rs = mysql_query($ssql,$link);
$row=mysql_fetch_array($rs);
$nivel=$row[$nivel];
////////GRANJAS/////////////
if($subarea=='granjas')
{
	$inicio=0;
    $fin=$inicio+3;
    $bandera=3;
}
if($subarea=='galpones')
{
	$inicio=3;
    $fin=$inicio+3;
    $bandera=3;
}
if($subarea=='lotes')
{
	$inicio=6;
    $fin=$inicio+3;
    $bandera=3;
}
////////MOLINOS/////////////    
if($subarea=='insumos')
{
	$inicio=9;
    $fin=$inicio+3;
    $bandera=3;
}
if($subarea=='inventario')
{
	$inicio=12;
    $fin=$inicio+2;
    $bandera=2;
}
if($subarea=='ecompras')
{
	$inicio=14;
    $fin=$inicio+2;
    $bandera=2;
}
if($subarea=='einsumos')
{
	$inicio=16;
    $fin=$inicio+2;
    $bandera=2;
}
if($subarea=='sinsumos')
{
	$inicio=18;
    $fin=$inicio+2;
    $bandera=2;
}
if($subarea=='salimentos')
{
	$inicio=20;
    $fin=$inicio+2;
    $bandera=2;
}
if($subarea=='formulas')
{
	$inicio=22;
    $fin=$inicio+3;
    $bandera=3;
}
if($subarea=='cproveedores')
{
	$inicio=25;
    $fin=$inicio+3;
    $bandera=3;
}
////////COMERCIALIZACION/////////////    
if($subarea=='cclientes')
{
	$inicio=28;
    $fin=$inicio+2;
    $bandera=2;
}
if($subarea=='rventas')
{
	$inicio=30;
    $fin=$inicio+2;
    $bandera=2;
}
if($subarea=='pedidos')
{
	$inicio=32;
    $fin=$inicio+3;
    $bandera=3;
}
for($i=$inicio; $i<$fin; $i++)
{
    if($bandera==3)
    {
	    if($i==$inicio)
    	    $mostrar=$nivel[$i];
        if($i==$inicio+1)
    	    $modificar=$nivel[$i];
        if($i==$inicio+2)
    	    $eliminar=$nivel[$i];
    }
    if($bandera==2)
    {
	    if($i==$inicio)
    	    $mostrar=$nivel[$i];
        if($i==$inicio+1)
    	    $eliminar=$nivel[$i];
        $modificar=0;
    }

};
$mostrar=1; 
return array ($mostrar,$modificar,$eliminar);
}
///////////////////////////////////////////////////////////////////////////////////////////////
function permisos_nivel1($db,$usr,$titulo,$op)
{
$link=Conectarse("$db");
$ssql = "SELECT nivel1
		 FROM area
         WHERE id_usuario='$usr'";
$rs = mysql_query($ssql,$link);
$row=mysql_fetch_array($rs);
$nivel1=$row[nivel1];
switch ($titulo)
{
  case "GRANJAS":
    $inicio=0;
    $fin=$inicio+$op;
    break;
  case "MOLINOS":
    $inicio=12;
    $fin=$inicio+$op;
    break;
  case "COMERCIALIZACION":
    $inicio=22;
    $fin=$inicio+$op;
    break;
  case "WEB":
    $inicio=29;
    $fin=$inicio+$op;
    break;
  //siempre tiene que ser el ultimo
  case "CONFIGURACION":    
    $inicio=29;//count($permisos_nivel1);
    $fin=$inicio+$op;
    break;
}
$aux=0;
for ($i=$inicio; $i<$fin; $i++)
{
    switch ($aux)
    {
        case 0:
        $op1=$nivel1[$i];
        $aux++;
        break;
        case 1:
        $op2=$nivel1[$i];
        $aux++;
        break;
        case 2:
        $op3=$nivel1[$i];
        $aux++;
        break;
        case 3:
        $op4=$nivel1[$i];
        $aux++;
        break;
        case 4:
        $op5=$nivel1[$i];
        $aux++;
        break;
        case 5:
        $op6=$nivel1[$i];
        $aux++;
        break;
        case 6:
        $op7=$nivel1[$i];
        $aux++;
        break;
        case 7:
        $op8=$nivel1[$i];
        $aux++;
        break;
        case 8:
        $op9=$nivel1[$i];
        $aux++;
        break;
        case 9:
        $op10=$nivel1[$i];
        $aux++;
        break;
        case 10:
        $op11=$nivel1[$i];
        $aux++;
        break;
        case 11:
        $op12=$nivel1[$i];
        $aux++;
        break;
    }
};
return array ($op1, $op2, $op3, $op4, $op5, $op6, $op7, $op8, $op9, $op10, $op11, $op12);
}
////////////////////////////////////////////////////////////////////////////////////
function guardar_permisos($permiso)
{
global $permisos_nivel2,$permisos_nivel1;
$permiso="nivel,".$permiso.",";
////////PARA NIVEL 2
for($i=0;$permisos_nivel2[$i];$i++)
{
	if(strpos($permiso, $permisos_nivel2[$i]))
	{
		if($i==0)
			$nivel2="1";
		else
			$nivel2=$nivel2."1";
	}
	else
	{
		if($i==0)
			$nivel2="0";
		else
			$nivel2=$nivel2."0";
	}
}
////////PARA NIVEL 1
for($i=0;$permisos_nivel1[$i];$i++)
{
    if(strpos($permiso, $permisos_nivel1[$i]))
    {
        if($i==0)
            $nivel1="1";
        else
            $nivel1=$nivel1."1";
    }
    else
    {
        //catalogo de granjas
        if($i==0)
        {
			if($nivel2[0]==1)
                $nivel1="1";
            else
                $nivel1="0";
        }
        //catalogo de galpones
        if($i==1)
        {
            if($nivel2[3]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //control de granjas
        if($i==2)
                $nivel1=$nivel1."0";
        //cierre de galpon
        if($i==3)
                $nivel1=$nivel1."0";
        //restaurar datos galpon
        if($i==4)
                $nivel1=$nivel1."0";
        //catalogo de lotes
        if($i==5)
        {
            if($nivel2[6]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        // resto de granjas
        if($i>5 && $i<12)
            $nivel1=$nivel1."0";
        //Catalogo de Insumos
        if($i==12)
        {
            if($nivel2[9]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //Inventario Fisico
        if($i==13)
        {
            if($nivel2[12]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //Entradas por Compra
        if($i==14)
        {
            if($nivel2[14]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //Entradas de Insumos
        if($i==15)
        {
            if($nivel2[16]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //Salidas de Insumos
        if($i==16)
        {
            if($nivel2[18]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //Salidas de Alimento
        if($i==17)
        {
            if($nivel2[20]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //Catalago de Formulas
        if($i==18)
        {
            if($nivel2[22]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //Catalago de Proveedores
        if($i==19)
        {
            if($nivel2[25]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        // resto de molino
        if($i==20)
            $nivel1=$nivel1."0";
        if($i==21)
            $nivel1=$nivel1."0";
        //comercializacion
        //catalogo de clientes
        if($i==22)
        {
            if($nivel2[28]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //estado de cuentas
        if($i==23)
            $nivel1=$nivel1."0";
        //registro de ventas
        if($i==24)
        {
            if($nivel2[30]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //pedidos
        if($i==25)
        {
            if($nivel2[32]==1)
                $nivel1=$nivel1."1";
            else
                $nivel1=$nivel1."0";
        }
        //analisis de ventas
        if($i==26)
            $nivel1=$nivel1."0";
        //reporte de salidas de alimento
        if($i==27)
            $nivel1=$nivel1."0";
		if($i==28)
            $nivel1=$nivel1."0";
        if($i>29)
            $nivel1=$nivel1."0";
    }
}
return array ($nivel1, $nivel2);
}
?>