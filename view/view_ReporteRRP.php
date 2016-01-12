<script type="text/javascript">
$(document).ready(function(){
  $('#cb_indicador').change(function(){  
    $(this).attr('disabled', true);
    ConsultaDatos();
    $(this).attr('disabled', false);     
  }); 

 
  
});

function ConsultaDatos(){
  $('#conresul').html('<center><p>Cargando ... </p></center>');  
  $.post('Controlador/Controller_view_indica_RRP.php' ,{ indi:$('#cb_indicador').val(),  rand:Math.random() },function(data){
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
            <center><b> <?php echo html_entity_decode (" Metas Presupuesto por Resultados - PPR - DIRESA CALLAO" )?></b></center>
         
               <center><br/ >
               <table >
              <tr>
                <td>Indicador  : </td>
                <td>
                  <select id="cb_indicador" name="cb_indicador">
                      <option value='--' >--Seleccionar--</option> <?php
                      $obj_vista = new cls_funciones ;
                      $result= $obj_vista->f_lista_Indicadores_ppr();
                      while($filas = mysqli_fetch_array($result)){  echo "<option value='".$filas[0]."' $sele >".utf8_encode($filas[1])."</option>"; }  
                  ?>
                  </select> 

                 </td>
                 <td  colspan='2'><div id="desin"></div>  
 

                 </td>
               </tr>
              </table>
              </center>
              <div id="conresul"></div>