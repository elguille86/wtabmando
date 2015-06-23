<?php session_start(); 
include_once('class/Controller.class.php');
	$ob = new cls_funciones; 
    $id_user = $_SESSION['id_saccisis']; 
	 $result = $ob->f_valid_user($id_user);
     $row = mysqli_fetch_array($result); 
     $usuario =  $row['nom'];         
    if(!isset($usuario )  || $usuario == '' || $usuario == NULL  ){ 
        session_destroy(); header("Location: ".$ob->mi_hosting() );
    }    
?> 
<!DOCTYPE html><html lang="es"><head>
<meta charset='utf-8' /> <meta name='author' content='Guillermo Rodriguez' /><title>:: Login de Sistema::</title><meta name="Copyright" content="DIRESA ;GUILLERMO RODRIGUEZ;Copyright 2012 Lima-Peru" /><link rel="stylesheet" href="css/styles.css" type="text/css"   /><link type="image/x-icon" href="favicon.ico" rel="icon" /><link type="image/x-icon" href="favicon.ico" rel="shortcut icon" ><link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="jqwidgets/styles/jqx.energyblue.css" type="text/css" />
<link rel="stylesheet" href="css/jquery-ui-1.9.2.custom.css" type="text/css" />
<script type="text/javascript" src="js/html5.js"></script> <script type="text/javascript" src="js/modernizr-latest.js"></script> <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script> <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<link rel="stylesheet" type="text/css" href="uploadify/uploadify.css">  <script src="uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript" src="jqwidgets/jqxcore.js"></script> <script type="text/javascript" src="jqwidgets/jqxchart.js"></script> <script type="text/javascript" src="jqwidgets/jqxdata.js"></script>  <script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script> <script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script> <script type="text/javascript" src="jqwidgets/jqxmenu.js"></script> <script type="text/javascript" src="jqwidgets/jqxpanel.js"></script> <script type="text/javascript" src="jqwidgets/jqxtree.js"></script> <script type="text/javascript" src="jqwidgets/jqxexpander.js"></script> <script type="text/javascript" src="jqwidgets/jqxgrid.js"></script> <script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script> <script type="text/javascript" src="jqwidgets/jqxgrid.columnsresize.js"></script> <script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script> <script type="text/javascript" src="jqwidgets/jqxdropdownlist.js"></script> <script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script> <script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script> <script type="text/javascript" src="jqwidgets/jqxwindow.js"></script>
<script type="text/javascript" src="js/gettheme.js"></script>
<script src="js/funcion0.1.js"  type="text/javascript"></script>  
</head>
<?php 
    require_once("class/Control.Menu.php"); $obj_funciones = new cls_funciones ; 
    $result= $obj_funciones->f_Menu_Sistema($id_user);
     while($filas = mysqli_fetch_array($result)){      
    $menuvalores[] = array(
        'id' => utf8_encode($filas[0]), 'parentid' => utf8_encode($filas[1]), 'text' => utf8_encode($filas[2]), 'href' => utf8_encode($filas[3]),
      );
    }       
?>
<script type="text/javascript">
$(document).ready(function () { var theme = 'energyblue'; var source = { datatype: "json", datafields: [ { name: 'id' },{ name: 'parentid' },{ name: 'text' },{ name: 'href' } ],id: 'id', localdata: <?php  echo json_encode($menuvalores ); ?> }; var dataAdapter = new $.jqx.dataAdapter(source); dataAdapter.dataBind(); var records = dataAdapter.getRecordsHierarchy(  'id', 'parentid', 'items', [{ name: 'text', map: 'label'  }] ); $('#jqxMenu').jqxMenu({ source: records, height: 30, theme: theme, width: '99.8%' }); $("#jqxMenu").on('itemclick', function (event) {  href = dataAdapter.recordids[event.args.id].href; if(href !=""){ if (href!=undefined) document.location = '?opm='+href; } });  });
</script> 
</head>
<body>
<header>  
    <div class="ClsSup" >  
        <img src="images/front/logoregion.png" id="logod1" width="62" height="59" id="logdir"  align="middle" style="float: left;" /> 
        <img src="images/front/logo.png" id="logod" width="62" height="59" id="logdir"  align="middle" style="float: left;" /> 
        Bienvenido al Tablero de Mando Web v0.1 - DIRESA CALLAO (Oficina de Informatica , Telecomunicaciones y Estadistica) <br> 
          <?php  echo "Usuario : ".$usuario;  ?>   <a href="salir.php" title="Salir del Sistema" >[ Salir ]</a> 
    </div>
</header><div id='content'><div id='jqxMenu' ></div></div><div id="contesyste"> <?php new cls_principal; ?></div> <div style="display:none">http://www.jqwidgets.com/license/</div><footer> Copyright © Todos los Derechos Reservados - 2013 <br/> Direcci&oacute;n Regional de Salud del Callao<br/> Oficina de Inform&aacute;tica, Telecomunicaciones y Estad&iacute;stica<br/> Unidad de Informatica<br/> Lima - Perú <br/> <!--Desarrollado por : <a href="mailto:g.rodriguez.p@hotmail.com"> Guillermo Rodriguez Pineda</a>--><br/><br/> </footer> </body></html>
<?php /*
<script type="text/javascript" src="jqwidgets/jqxtabs.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxcheckbox.js"></script>
*/
?>