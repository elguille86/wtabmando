<?php 
include_once('class/CompoJquery.php'); 
$obj_vista1 = new cls_funciones ;
$objQ_vista = new cls_Jquerys;   
$urlControles = "Controlador/Controller_RegistroIndicador4.php";    
?>
<script type="text/javascript">
$(document).ready(function(){
  var theme = 'energyblue';//'classic';
 $('#txtfe').attr('readonly', true);
  var source1 = { datatype: "json", 
  datafields: [ { name: 'nro'}, { name: 'codId'}, { name: 'reg_fec'}, { name: 'centro'}, { name: 'nro1'} ,  { name: 'nro2'},  { name: 'cod_estab'}  , { name: 'fec_reg'}
  ], url: 'class/json.php?type=4' };

  var dataAdapter = new $.jqx.dataAdapter(source1); <?php  echo $objQ_vista->PaginacionGrid('jqxgrid'); ?>
  $("#jqxgrid").jqxGrid({ theme: theme, source: source1, columnsresize: true, width: 810, pageable: true, pagerrenderer: pagerrenderer,  pagesize: 800, height: 300, showfilterrow: true, filterable: true,
    columns: [
      { text: 'Nro', datafield: 'nro', width: 30 }, 
      { text: 'i', datafield: 'codId', width: 140 , hidden : 'hides' },       
      { text: 'Nombre', datafield: 'centro', width: 300 }, 
      { text: 'Fecha', datafield: 'reg_fec', width: 80 },  
      { text: 'Nin Hierro', datafield: 'nro1', width: 100 }, 
      { text: 'Nin Sin', datafield: 'nro2', width: 100 }, 
      { text: 'Accion', columntype: 'button', width: 90 , cellsrenderer: function () { return "Editar"; }, buttonclick: EventoDetalle },
      { text: 'Documentos', columntype: 'button', width: 90 , cellsrenderer: function () { return "Eliminar"; }, buttonclick: Eventoelimina },                    
    ]
  });

  $.datepicker.regional['es'] = {
    closeText: 'Cerrar', prevText: '<Ant', nextText: 'Sig>', currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
    dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
    weekHeader: 'Sm', dateFormat: 'dd/mm/yy', firstDay: 1, isRTL: false, showMonthAfterYear: false, yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['es']); 


  $( "#txtfe" ).datepicker({ 
      autoSize: true , dateFormat: "yy-mm-dd" ,maxDate: '+0D'
  });


  $("#Btnnuevo").click(function (){
    $("#btngraba").css("display","block"); $("#btnactualizar").css("display","none"); 
    $(".poptitulo").html('Nuevo Registro'); $("#cbtcentro option[value=" + $("#cent").val() + "]").attr("selected", true);  $("#txtfe").val(Fecha('-'));  $("#txtnin2").val(''); $("#txtnin1").val(''); 
    $('#cbtcentro').attr('disabled', false); $('#txtfe').datepicker('enable');$("#idmensaje1").removeClass("alerta1").html('');  $("#popupWindow").jqxWindow('show');       
  }); 

  $("#popupWindow").jqxWindow({ width: 650, height: '60%', resizable: false,  theme: theme,  isModal: true,  autoOpen: false,  modalOpacity: 0.5  }); 
$('#popupWindow').on('close', function (event) {
    $("#jqxgrid").jqxGrid('updatebounddata');
});

<?php $timestamp = time();?>
  var ArrayImagenes = new Array();
  ino=0;
  NombreArchivo ="";    
  $('#fileimagen_new').uploadify({
    'formData'     : {
      'timestamp' : '<?php echo $timestamp;?>',
      'token'     : '<?php echo md5('unique_salt' . $timestamp);?>' ,
      'indicador' : 'indicador5' 
    },
    'auto'     : false,
    'fileTypeExts' : '*.csv',
    'fileSizeLimit' : '100112KB',
    'buttonText' : ' Selecionar Archivo ',
    'swf'      : 'uploadify/uploadify.swf',
    'uploader' : 'sub_file/importarcsv.php',      
    'multi'    : false, 
    'queueSizeLimit' : 1,
    'onUploadSuccess' : function(file, data, response) {
      NombreArchivo = data;
    },
    'onSelect' : function(file) { $("#idmensaje1").removeClass("alerta1").html('');  },

    'onQueueComplete' : function(queueData) {
      if(queueData.uploadsSuccessful >0) { 
        $("#idmensaje1").addClass("alerta1").html(NombreArchivo);  
        $("#btn_importa").removeAttr("disabled");  
      }
    }
  });


  $('#btn_importa').click(function() {
    $('#fileimagen_new').uploadify('upload','*'); 
    $('#btn_importa').attr('disabled','disabled'); 
    });  

  $('#btngraba').click(function() {
    ok = confirm("Desea Grabar el Siguiente Registro de la Base de Datos ")
    if(ok) {
    texto = $('#btngraba').val();
    $('#idmensaje1').removeClass("alerta1").html(""); $('#btngraba').attr('disabled','disabled'); $('#btngraba').attr('value','Validando .....');
    $.post("<?php echo $urlControles;?>",{ 
    tipf : '0004' , txtfe : $("#txtfe").val(), cbtcentro : $("#cbtcentro").val(), 

     txtnin1  :  $("#txtnin1").val(), txtnin2 : $("#txtnin2").val(), 
 
     acttoken : $('#acttoken').val(), rand:Math.random() } ,                
    function(data){
      if(data.trim() == "ok"){
        document.location = '?opm=MsgText';
      }else{
        $('#idmensaje1').addClass("alerta1").html(data.trim()); $("#btngraba").removeAttr("disabled");  $('#btngraba').val(texto); 
      }      
    });

    }
  });



  $('#btnactualizar').click(function() {
    ok = confirm("Desea Actualizar el Siguiente Registro de la Base de Datos ")
    if(ok) {
    texto = $('#btnactualizar').val();
    $('#idmensaje1').removeClass("alerta1").html(""); $('#btnactualizar').attr('disabled','disabled'); 
    $('#btnactualizar').attr('value','Validando .....');
    $.post("<?php echo $urlControles;?>",{ 
      tipf : '0006' , txtfe : $("#txtfe").val(),  cbtcentro : $("#cbtcentro").val(), 
      txtnin1  :  $("#txtnin1").val(), txtnin2 : $("#txtnin2").val(), 
      fec_reg : $("#fecreg").val(),codid : $("#id_upt").val(), acttoken : $('#acttoken').val(), rand:Math.random() } ,                
    function(data){
      if(data.trim() == "ok"){
        document.location = '?opm=MsgText';
      }else{
        $('#idmensaje1').addClass("alerta1").html(data.trim());  
        $("#btnactualizar").removeAttr("disabled");  $('#btnactualizar').val(texto); 
      }      
    });

    }
  });

  $("#btnrefescar").click(function (){ $("#jqxgrid").jqxGrid('updatebounddata'); });
  $('#btnplantilla').click(function() {
    url ="files/ImportaDatos.xls";
    window.open(url,  ' _blank');
    return false;
  }); 
});

function EventoDetalle (row) {
  var indice = row; 
  var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', indice);
    $(".poptitulo").html('Editar Registro');  
    $("#btngraba").css("display","none"); $("#btnactualizar").css("display","block");  
    $("#cbtcentro option[value=" + dataRecord.cod_estab + "]").attr("selected", true); 
    $("#txtfe").val(dataRecord.reg_fec);
    $('#txtfe').attr('readonly', true); 
    $('#txtfe').datepicker().datepicker('disable'); 
    $('#cbtcentro').attr('disabled', true); 
    $("#txtnin1").val(dataRecord.nro1); $("#txtnin2").val(dataRecord.nro2);    
 
    $("#id_upt").val(dataRecord.codId); 
    $("#fecreg").val(dataRecord.fec_reg); 
    $("#idmensaje1").html('');
    $("#popupWindow").jqxWindow('show'); 
}

function Eventoelimina (row) {
  var indice = row; 
  var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', indice);
    if(confirm("Desea Anular el Siguiente Registro de la Base de Datos ")) {
    $.post("<?php echo $urlControles;?>",{ 
    codid : dataRecord.codId, fec_reg:dataRecord.fec_reg , tipf : '0005', acttoken:$('#acttoken').val(),  rand:Math.random() } ,                
    function(data){
      if(data.trim() == "ok"){
        //document.location = '?opm=MsgText';
        $("#jqxgrid").jqxGrid('updatebounddata');
      }else{
        alert("Error : "+data.trim());
      }      
    }); 
    }
}
  
      
</script>  
<style type="text/css">
.miscrol{ overflow:scroll; height:95% }
.miscrol input[type=text] { width: 30px; }
.miscrol td { /* width: 10%; */ }
.subtitu { padding: 0.5em 0 ; background: #E0E9F5; }

</style>
<?php
$titulo = html_entity_decode('Indicador 5 : PORCENTAJE DE RECIEN NACIDOS CON DOS CONTROLES DE CRED'  )
?>
<div class="titulo"><?php echo $titulo;?></div>
<div class="barrabones"> 
  <br/><p><input type="button" id="Btnnuevo" name="Btnnuevo" value=" Nuevo " style="padding : 0 10px 0 0;" />
  <input type="button" id="btnrefescar" name="btnrefescar" value=" Actualizar " style="padding : 0 10px 0 0;"/>
<input type="button" id="btnplantilla" name="btnplantilla" value=" Plantilla " style="padding : 0 10px 0 0;"  /></p>

</div>

<div id="jqxgrid"></div> 
 <?php 
 

 
   
?>
    <div id="popupWindow">
        <div><div class="poptitulo"></div>  </div>
        <div style="overflow: hidden;">
            <center><b> <div class="poptitulo"></div> </b></center>
             <div class="miscrol"> 
               <center><br/ >
              <table style="width: 100%;" >
              <tr>
                <td>Fecha : </td>
                <td><input type="text" id="txtfe" name="txtfe" style="width: 60px" />  </td>
                <td>Debe selecionar el ultimo dia del mes </td>
                <td>&nbsp;&nbsp; </td>
              </tr>
              <tr>
                <td>Centro de Salud :  </td>
                <td colspan='3'><select id="cbtcentro" name="cbtcentro">
                    <option value='--' >--Seleccionar--</option> <?php
                    $obj_vista = new cls_funciones ;
                    $result= $obj_vista->f_Lista_Centros();
                      while($filas = mysqli_fetch_array($result)){  
                        if($filas[0]==$_SESSION['codCentro'] )
                          {
                            $sele= ' selected';
                          }else{
                            $sele="";
                          }

                      echo "<option value='".$filas[0]."' $sele >".utf8_encode($filas[1])."</option>";
                      }  
                  ?>
                </select></td>
              </tr>
              <tr >
                <td colspan='4' align="center" class='subtitu' ><strong> Indicadores</strong></td>
              </tr>
              <tr>
                <td  colspan='2' > <?php echo html_entity_decode ('Número de  neonatos que recibieron 2 o mas controles CRED');?>  : 
                	<input type="text" id="txtnin1" name="txtnin1" class="numero" maxlength='4' /></td>
                <td  colspan='2' > <?php echo html_entity_decode ('Numero de Neonatos');?>  : 
                	<input type="text" id="txtnin2" name="txtnin2" class="numero" maxlength='4' /></td>   
              </tr>
              <tr>
                <td colspan='4' > <div id="idmensaje1"></div> </td>   
              </tr>

              <tr>
                <td colspan='3' ><input  type="file" name="fileimagen_new" id="fileimagen_new"  /> </td>
                <td> <p><input type="button" id="btn_importa" name="btn_importa" value=" importar " /></p> </td>   
              </tr>


              </table>

              <p><input type="button" id="btngraba" name="btngraba" value=" Guardar " /></p>
              <p><input type="button" id="btnactualizar" name="btnactualizar" value=" Actualizar " /></p>

              </center>
 

           </div> 
        </div>
    </div> 

<input type="hidden" id="id_upt" name="id_upt"  > </input>  
<input type="hidden" id="fecreg" name="fecreg"  > </input>  
<input type="hidden" id="cent" name="cent"  value="<?php echo $_SESSION['codCentro'] ?>" > </input> 
<?php $acttoken = md5( uniqid( rand(),true )); $_SESSION['acttoken'] = $acttoken ;?>
<input type="hidden" id="acttoken" name="acttoken" value="<?php echo $acttoken?>" > </input>   