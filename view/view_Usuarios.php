<?php 
include_once('class/CompoJquery.php'); 
$obj_vista1 = new cls_funciones ;
$objQ_vista = new cls_Jquerys;   
$urlControles = "Controlador/Controller_RegistroUsuarios.php";       
?>
<script type="text/javascript">
$(document).ready(function(){
	var theme = 'energyblue';//'classic';
 
	var source1 = { datatype: "json", 
	datafields: [ { name: 'nro'}, { name: 'codId'}, { name: 'codesb'}, { name: 'user'}, { name: 'nomb'},  { name: 'nivel'} , { name: 'nomesb'} ,    
  	], url: 'class/json.php?type=3' };

  	var dataAdapter = new $.jqx.dataAdapter(source1); <?php  echo $objQ_vista->PaginacionGrid('jqxgrid'); ?>
	$("#jqxgrid").jqxGrid({ theme: theme, source: source1, columnsresize: true, width: 880, pageable: true, pagerrenderer: pagerrenderer,  pagesize: 800, height: 300, showfilterrow: true, filterable: true,
	columns: [
	  { text: 'Nro', datafield: 'nro', width: 30 }, { text: 'i', datafield: 'codId', width: 140 , hidden : 'hides' },       
	  { text: 'Centro', datafield: 'nomesb', width: 180 }, 
	  { text: 'Usuario', datafield: 'user', width: 140 },  
	  { text: 'Nombre', datafield: 'nomb', width: 330 }, 
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
 
	$("#chcam").click(function(event){
		if($(this).is(":checked")) {
		  $('#txtclave').css("display","none");
      $('#ipwd').val("0");
		}else{  
		  $('#txtclave').css("display","block");
      $('#ipwd').val("1");
		}
	});
 



  $("#Btnnuevo").click(function (){
    $("#btngraba").css("display","block"); 
    $("#btnactualizar").css("display","none");  
    $(".poptitulo").html('Nuevo Registro'); 
    $("#cbtcentro option[value='--']").attr("selected", true); 
    $("#cbnivel option[value='--']").attr("selected", true); 
    $("#txtclave").val('');
    $('#txtclave').css("display","block"); 
    $("#txtnombre").val(''); 
    $("#txtusuario").val(''); 
    $("#idmensaje1").html(''); 
    $("#chcam").prop("checked", "");
    $('#ipwd').val("1");
    $("#popupWindow").jqxWindow('show');   
  }); 

  $("#popupWindow").jqxWindow({ width: 600, height: '60%', resizable: false,  theme: theme,  isModal: true,  autoOpen: false,  modalOpacity: 0.5  }); 
  $('#btngraba').click(function() {
    ok = confirm("Desea Grabar el Siguiente Registro de la Base de Datos ")
    if(ok) {
    texto = $('#btngraba').val();
    $('#idmensaje1').removeClass("alerta1").html(""); $('#btngraba').attr('disabled','disabled'); $('#btngraba').attr('value','Validando .....');
    $.post("<?php echo $urlControles;?>",{ 
    tipf : '0001' ,   cbtcentro : $("#cbtcentro").val(), txtusuario : $("#txtusuario").val(), txtnombre : $("#txtnombre").val(), cbnivel : $("#cbnivel").val(),   txtclave : $("#txtclave").val(),    acttoken : $('#acttoken').val(), rand:Math.random() } ,                
    function(data){
      if(data.trim() == "ok"){ document.location = '?opm=MsgText'; }
      else{ $('#idmensaje1').addClass("alerta1").html(data.trim()); $("#btngraba").removeAttr("disabled");  $('#btngraba').val(texto);  }      
    });

    }
  });



  $('#btnactualizar').click(function() {
    ok = confirm("Desea Actualizar el Siguiente Registro de la Base de Datos ")
    if(ok) {
    texto = $('#btnactualizar').val();
    $('#idmensaje1').removeClass("alerta1").html(""); 
    $('#btnactualizar').attr('disabled','disabled'); 
    $('#btnactualizar').attr('value','Validando .....');
    $.post("<?php echo $urlControles;?>",{ 
    

    tipf : '0003' ,   cbtcentro : $("#cbtcentro").val(),  txtnombre : $("#txtnombre").val(), cbnivel : $("#cbnivel").val(),   
    txtclave : $("#txtclave").val(),   ipwd : $("#ipwd").val() ,  codid : $("#id_upt").val(),  

     acttoken : $('#acttoken').val(), rand:Math.random() } ,                
    function(data){
      if(data.trim() == "ok"){ document.location = '?opm=MsgText'; }
      else{ $('#idmensaje1').addClass("alerta1").html(data.trim());  
      $("#btnactualizar").removeAttr("disabled");  $('#btnactualizar').val(texto);  }      
    });
    }
  });

 $("#btnrefescar").click(function (){ $("#jqxgrid").jqxGrid('updatebounddata'); });

});

 

function EventoDetalle (row) {
  var indice = row; 
  var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', indice);
    $(".poptitulo").html('Editar Registro');  
    $("#btngraba").css("display","none"); 
    $("#btnactualizar").css("display","block");
    $('#txtclave').css("display","none");
    $("#txtnombre").val(dataRecord.nomb); 
    $("#txtusuario").val(dataRecord.user); 
    $("#cbtcentro option[value=" + dataRecord.codesb + "]").attr("selected", true);             
    $("#cbnivel option[value=" + dataRecord.nivel + "]").attr("selected", true); 
    $("#id_upt").val(dataRecord.codId); 
    $("#chcam").prop("checked", "checked");
    $('#ipwd').val("0");
    $("#idmensaje1").html('');
    $("#popupWindow").jqxWindow('show'); 
}

function Eventoelimina (row) {
  var indice = row; 
  var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', indice);
    if(confirm("Desea Anular el Siguiente Registro de la Base de Datos ")) {

    $.post("<?php echo $urlControles;?>",{ 
    codid : dataRecord.codId    ,tipf : '0002', acttoken:$('#acttoken').val(),  rand:Math.random() } ,                
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
.miscrol td { width: 10%; }
 
</style>
<div class="titulo"> Registro de Usuario </div>
<div class="barrabones"> 
  <br/><p><input type="button" id="Btnnuevo" name="Btnnuevo" value=" Nuevo " style="padding : 0 10px 0 0;" />
  <input type="button" id="btnrefescar" name="btnrefescar" value=" Actualizar " /></p>


 
</div>

<div id="jqxgrid"></div> 
 


    <div id="popupWindow">
        <div><div class="poptitulo"></div>  </div>
        <div style="overflow: hidden;">
            <center><b> <div class="poptitulo"></div> </b></center>
             <div class="miscrol"> 
               <center><br/ >
              <table style="width: 100%;" >
              <tr>
                <td>Usuario  : </td>
                <td><input type="text" id="txtusuario" name="txtusuario" style="width: 100px;"  /></td>
                <td>Clave : </td>
                <td><input type="password" id="txtclave" name="txtclave" style="width: 100px;" />

                </td>
                <td><input  type="checkbox" name="chcam" id="chcam"  /></td>
              </tr>
              <tr>
                <td>Nivel  : </td>
                <td> 
                	<select id="cbnivel" name="cbnivel">
						<option value='--' >--Seleccionar--</option> <?php
                    $obj_vista = new cls_funciones ;
                    $result= $obj_vista->f_Lista_Nivel();
                      while($filas = mysqli_fetch_array($result)){  
 				 echo "<option value='".$filas[0]."' $sele >".utf8_encode($filas[1])."</option>";
                      }  
                  ?>
                	</select>  
            	</td>
                <td>Nombre : </td>
                <td colspan='2'><input type="text" id="txtnombre" name="txtnombre" style="width: 250px; " /></td>
              </tr>
              <tr>
                <td>Centro de Salud :  </td>
                <td colspan='4'><select id="cbtcentro" name="cbtcentro">
                    <option value='--' >--Seleccionar--</option> <?php
                    $obj_vista = new cls_funciones ;
                    $result= $obj_vista->f_Lista_Centros_Usuarios();
                      while($filas = mysqli_fetch_array($result)){  
                      echo "<option value='".$filas[0]."' $sele >".utf8_encode($filas[1])."</option>";
                      }  
                  ?>
                </select></td>
              </tr>
 

              </table>

              <p><input type="button" id="btngraba" name="btngraba" value=" Guardar " /></p>
              <p><input type="button" id="btnactualizar" name="btnactualizar" value=" Actualizar " /></p>

              </center>
              <div id="idmensaje1"></div>

           </div> 
        </div>
    </div> 


<input type="hidden" id="id_upt" name="id_upt"  > </input>   
<input type="hidden" id="cent" name="cent"  value="<?php echo $_SESSION['codCentro'] ?>" > </input> 
<input type="hidden" id="ipwd" name="ipwd"   /> 
<?php $acttoken = md5( uniqid( rand(),true )); $_SESSION['acttoken'] = $acttoken ;?>
<input type="hidden" id="acttoken" name="acttoken" value="<?php echo $acttoken?>" > </input>   