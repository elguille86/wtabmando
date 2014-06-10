<!DOCTYPE html> <html lang="es"> <head>
  <title>:: Solicitud Online ::</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="X-UA-Compatible" content="IE=8" /> 
  <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1"/>
  <link type="image/x-icon" href="favicon.ico" rel="icon" />
  <meta name="Copyright" content="DIRESA ; GUILLERMO RODRIGUEZ;Copyright 2014 Lima-Peru" />
  <link rel="stylesheet" href="css/styles.css" type="text/css"   />
  <link rel="stylesheet" href="css/mobil.css" type="text/css"   />
  <link rel="stylesheet" href="css/mensajes.css" type="text/css"   /> 
  <link rel="stylesheet" href="css/jquery-ui-1.9.2.custom.css"  type="text/css" /> 
  <script src='js/prefixfree.min.js' language="javascript" ></script>
  <script src="js/html5.js"  type="text/javascript"></script>
  <script src="js/jquery-1.8.3.js"  type="text/javascript"></script>
  <script src="js/jquery-ui-1.9.2.custom.js"></script> 
  <script src="js/jquery.validate.js"  type="text/javascript"></script>
  <script src="js/funcion0.1.js"  type="text/javascript"></script>




</head>
<body>
  <div id="contesyste_from">
    <div class="colum3">
      <img SRC="images/front/logo.png" width="81" height="77"/>
    </div>  
    <div class="colum2">
    <strong> <p>SOLICITUD DE ACCESO A LA INFORMACI&Oacute;N P&Uacute;BLICA</p> </strong>
    <p>(Texto &Uacute;nico Ordenado de la Ley N&deg; 27806, Ley de Transparencia y Acceso a la Informaci&oacute;n P&uacute;blica, aprobado por Decreto Supremo N&deg; 043-2003-PCM)</p>
    </div>  
    <?php
    include('html/menu1.php');
    ?>
<script type="text/javascript">
$(document).ready(function () {
  $("#hticket").focus();

  $('#Btnconsulta').click(function(){
    $("#det").html("<diV class='info1 '>Cargando.......</diV>");
    $.post("class/jsonexterno.php",{ type:'conc', cQ:$("#hticket").val(), 
      rand:Math.random() },function(data){ 
        $("#det").html(data); $("#hticket").focus();
    });  
    $("#jqxgrid").jqxGrid('updatebounddata'  );
  });

});       
 

</script>

 <div class="titulo">Seguimiento de Documentacion (Sistema de Tramite Documentario)</div>
<div class="barrabones"> 
Hro de Ticket : <input id="hticket"  type="text"  name="hticket" size="6" class="numero" maxlength="6" /> 
  <br/><p><input type="button" id="Btnconsulta" name="Btnconsulta" value=" Consultar" /></p>
  <div id="det">  </div>
</div>

<p>Solictud Virutal - Movil </p>
</div>  
 

</body>
</html>
 
