<script type="text/javascript">
$(document).ready(function(){
 
 $('#cb_indicador').change(function(){  
  $('#cb_indicador').attr('disabled', true);
  $('#conresul').html('<center><p>Cargando ... </p></center>');
        $.post('Controlador/Controller_view_indica.php' ,{ indi:$('#cb_indicador').val(), rand:Math.random() },function(data){
          $('#conresul').html('');
          $('#conresul').html(data); $('#cb_indicador').attr('disabled', false);
      }); 
  });

});
 

</script>   
 
</head>
<body class='default'>
    <div id='jqxWidget'>
        <div id="jqxgrid"></div>
    </div>
</body>
</html>

 
            <center><b> Reportes Tablero de Mando</b></center>
            <center><b> <?php echo html_entity_decode (" Indicadores de Desempeño y metas Insituciones - DIRESA CALLAO" )?></b></center>
         
               <center><br/ >
               <table >

             <?php
             /*

 $('#cbredes').change(function(){
  var depat = $(this).val();  
  if(depat==0){
    $("#cbcentro").attr('disabled', true);
    $("#cbcentro option[value='--']").attr("selected", true);
  }else {
      $('#cbcentro').find('option').remove().end().append("<option value='--'>Cargando....</option>");
      $('#cbcentro').attr('disabled','disabled');
      $.post('class/json.php?type=1&codred='+depat,{ rand:Math.random() },function(data){
          $('#cbcentro').find('option').remove().end().append(data);
      }); 
      $("#cbcentro").removeAttr("disabled");
    $("#cbcentro").attr('disabled', false);
  } 
  });


              <tr>

                <td>Redes  : </td>
                <td colspan='3'>
                  <select id="cbredes" name="cbredes">
            <option value='--' >--Seleccionar--</option> <option value='0' >Todo</option><?php
                    $obj_vista = new cls_funciones ;
                    $result= $obj_vista->f_Lista_Redes();
                      while($filas = mysqli_fetch_array($result)){  
         echo "<option value='".$filas[0]."' $sele >".utf8_encode($filas[1])."</option>";
                      }  
                  ?>
                  </select> 

                 </td>
               </tr>
              <tr>


              <tr>

                <td>Centro  : </td>
                <td colspan='3'>
                  <select id="cbcentro" name="cbcentro"><option value='--' >--Seleccionar--</option></select> 

                 </td>
               </tr>
              <tr> 
<p><input type="button" id="btngenerar" name="btngenerar" value=" Reporte " /></p>
             */
             ?>   



              <tr>

                <td>Indicador  : </td>
                <td>
                  <select id="cb_indicador" name="cb_indicador">
            <option value='--' >--Seleccionar--</option> <?php
                    $obj_vista = new cls_funciones ;
                    $result= $obj_vista->f_Lista_Indicadores();
                      while($filas = mysqli_fetch_array($result)){  
         echo "<option value='".$filas[0]."' $sele >".utf8_encode($filas[2])."</option>";
                      }  
                  ?>
                  </select> 

                 </td>
                 <td  colspan='2'><div id="desin"></div> </td>
               </tr>
              <tr>

 
              </table>

              
 

              </center>
              <div id="conresul"></div>

 