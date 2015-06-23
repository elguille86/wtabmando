<script type="text/javascript">
$(document).ready(function(){
  $('#cb_indicador').change(function(){  
    $(this).attr('disabled', true);
    ConsultaDatos();
    $(this).attr('disabled', false);     
  }); 

  $('#cb_miyear').change(function(){  
    $(this).attr('disabled', true);
    ConsultaDatos();
    $(this).attr('disabled', false);    
  }); 
  
});

function ConsultaDatos(){
  $('#conresul').html('<center><p>Cargando ... </p></center>');
  $.post('Controlador/Controller_view_indica.php' ,{ indi:$('#cb_indicador').val(),miyear:$('#cb_miyear').val(), rand:Math.random() },function(data){
    $('#conresul').html('');
    $('#conresul').html(data); $('#cb_indicador').attr('disabled', false);
  });
}


 
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
              <tr>
                <td>Indicador  : </td>
                <td>
                  <select id="cb_indicador" name="cb_indicador">
                      <option value='--' >--Seleccionar--</option> <?php
                      $obj_vista = new cls_funciones ;
                      $result= $obj_vista->f_Lista_Indicadores();
                      while($filas = mysqli_fetch_array($result)){  echo "<option value='".$filas[0]."' $sele >".utf8_encode($filas[2])."</option>"; }  
                  ?>
                  </select> 

                 </td>
                 <td  colspan='2'><div id="desin"></div>  A&ntilde;o :  
                  <select id="cb_miyear" name="cb_miyear">
                       <?php
                      
                      $result= $obj_vista->f_Menu_Year();
                      while($filas = mysqli_fetch_array($result)){  echo "<option value='".$filas[0]."' $sele >".utf8_encode($filas[0])."</option>"; }  
                  ?>
                  </select> 

                 </td>
               </tr>
              </table>
              </center>
              <div id="conresul"></div>