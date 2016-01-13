<center>
<?php
//set_time_limit(0);
 include('../class/Modelo.PPR.php'); 
  $obj = new cls_Indicadores_PPR;
 
$CODIIN = $_POST['indi'];

if($CODIIN =='--'){
	$text_Indicador = " ";	
}else{
	$result= $obj->f_lista_Indicadores_texto_ppr($CODIIN ); 


	$filasd = mysqli_fetch_array($result);
	$text_Indicador = $filasd[0];	
}
$coloverte = "#4d9622"; $colorojo = "#f63939"; $coloamarillo = "#fdd104";
$operacion ="";
$semaforo ="";
echo utf8_encode("<p><strong>Se ha Selecionado el Indicado   : ".$text_Indicador."</strong></p>");
$coloverte = "#4d9622"; $colorojo = "#f63939"; $coloamarillo = "#fdd104";
 

/* ***************************************** Funciones ************************************************* */
 

	function operaciones($Columnavalor1 , $Columnavalor2){
		$obj = new cls_Indicadores_PPR; global $operacion;
		switch ($operacion) {			
			case 'porcentaje': $respuesta =   $obj->Porcentaje(  $Columnavalor1 , $Columnavalor2 ); break; 
		}
		return $respuesta;
	}

	function Leyenda(){
		global $coloverte ; global $colorojo  ; global $coloamarillo  ;
		
		echo "<div class='divleyenda'>
		<p style='text-align: left;'> <strong> Leyenda : </strong> <br/>
		<span style='background: $coloverte;  padding: 0 0.8em;  '>  </span>&nbsp Exito  : MAYOR O IGUAL LA META <br/>
		<span style='background: $colorojo; padding: 0 0.8em; '>  </span>&nbsp Riesgo   : MENOS A LA METRA  <br/>
		</p>
		<p>FUENTE:  HIS</p>
		</div>" ;
	}



	function Semaforo_indi_($value)
  	{ 
		global $coloverte ; global $colorojo  ; global $coloamarillo  ; global $semaforo;
	  	$verde = " style='background:$coloverte;'  ";
	  	$rojo = " style='background:$colorojo;'  ";
	  	$amarillo = " style='background:$coloamarillo;'  ";
		$blanco = "  ";
		$value = trim($value);
	  	if($value =="" ){ $respuesta =  $blanco; }
	  	else if($value >= 100){ $respuesta =  $verde  ; }
	  	else{ $respuesta =  $rojo ; } 
		return $respuesta ;
  	}
		 function TablaIndicadores ($result  ){
	 		echo "
	 			<table class='clsTabla' cellpadding='0' cellspacing='0'><thead><tr>
				<td width='150'>CENTRO DE SALUD</td>
				<td width='50'> Meta del Mes</td>
				<td width='50'> Meta Semana</td>
				<td width='50'>Semana   </td>
				<td width='50'>Avance  </td>
				<td width='50'> ( % ) Semana  </td>			
				<td width='50'> ( % ) Mes </td>
				</tr></thead>";

				while($filas = mysqli_fetch_array($result,MYSQL_ASSOC ) ){	
					echo "<tr>" ; $CantSemana = $filas['meta_mes']/4 ; $CantAvanceSemana =( $CantSemana *$filas['semana'] ) ;
					//$stilesstyle=" style='background:#c1bebe' >"; 
						$stilesstyle=" >"; 
					echo "<td ".$stilesstyle. $filas['desc_estab']  ."</td>";
					echo "<td align='center' ".$stilesstyle. $filas['meta_mes']  ."</td>";
					echo "<td align='center' ".$stilesstyle. $CantAvanceSemana ."</td>";
					echo "<td align='center' ".$stilesstyle. $filas['semana']  ."</td>";
					echo "<td align='center' ".$stilesstyle. $filas['Avence']  ."</td>";
					$PorcentajeAcence = operaciones( $filas['Avence'] , $CantAvanceSemana  ) ;
					$color = Semaforo_indi_($PorcentajeAcence);
					echo "<td align='center' ".$color.' '.$stilesstyle. $PorcentajeAcence ."</td>";
					echo "<td align='center' ".$color.' '.$stilesstyle. operaciones( $filas['Avence'] , $filas['meta_mes']  )  ."</td>";
		 			echo "</tr>" ;
				}
				echo "</table>";
	 		}
 
// VARIABLES DE CONFIGURACION
 $nroSemana = 1; $ELYEAR = 2016;
echo "
<div id='jqxTabs'>
	<ul> 
    	<li><a href='#jqxTabs-1'>Red Bonilla</a></li>
    	<li><a href='#jqxTabs-2'>Red Bepeca</a></li>
    	<li><a href='#jqxTabs-3'>Red Ventanilla</a></li>
    </ul>

<div id='jqxTabs-1'> 
	<div class='conte_tabs'> ";
	Leyenda(); echo "<br/>";	
	echo "<p> <h3>Semana  : ".$nroSemana."</h3></p>"; $operacion =  'porcentaje';
	$result = $obj->Data_Indicador_PPR( 'tvred_bonilla' , $nroSemana ,$ELYEAR,  $CODIIN  );
	TablaIndicadores ( $result);	
echo"	</div>
</div>

<div id='jqxTabs-2'> 
	<div class='conte_tabs'> ";
	Leyenda(); echo "<br/>";	
	echo "<p> <h3>Semana  : ".$nroSemana."</h3></p>"; $operacion =  'porcentaje';
	$result = $obj->Data_Indicador_PPR( 'tvred_bepeca' , $nroSemana ,$ELYEAR,  $CODIIN  );
	TablaIndicadores ( $result);	

echo"	</div>
</div>

<div id='jqxTabs-3'>
    <div class='conte_tabs'>";	
    Leyenda(); echo "<br/>";	
	echo "<p> <h3>Semana  : ".$nroSemana."</h3></p>"; $operacion =  'porcentaje';
	$result = $obj->Data_Indicador_PPR( 'tvred_ventanilla' , $nroSemana ,$ELYEAR,  $CODIIN  );
	TablaIndicadores ( $result);	

	echo "
	</div>
</div>

 
 

</div>" ;//
echo "<p>Oficina de Informatica , Telecomunicaciones y Estadistica</p>" ;
echo "<script type='text/javascript'> $(document).ready(function () { $('#jqxTabs').tabs();  }); </script>";      
 
 

?> 
</center> 