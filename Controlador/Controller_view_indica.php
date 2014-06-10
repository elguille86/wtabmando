<center>
<?php
//set_time_limit(0);
 include('../class/Modelo.Indicadores.php'); 
  $obj = new cls_Indicadores;
 
$CODIIN = $_POST['indi'];
if($CODIIN =='--'){
	$text_Indicador = " ";	
}else{
	$result= $obj->desrip_ind($CODIIN ); 
	$filasd = mysqli_fetch_array($result);
	$text_Indicador = $filasd[1];	
}
$coloverte = "#4d9622"; $colorojo = "#f63939"; $coloamarillo = "#fdd104";
$operacion ="";
$semaforo ="";
echo utf8_encode("<p><strong>Se ha Selecionado el Indicado ".$_POST['indi']." : ".$text_Indicador."</strong></p>");

switch ($_POST['indi']) {
    case 4:
        Indicador4(utf8_encode ( $text_Indicador ) );
        break;
    case 5:
        Indicador5(utf8_encode ( $text_Indicador ) );
        break;
    case 6:
        Indicador6(utf8_encode ( $text_Indicador ));
        break;
    case 8:
        Indicador8(utf8_encode ( $text_Indicador ) );
        break;

    case 7:
        Indicador7(utf8_encode ( $text_Indicador ));
        break;

    default:
       echo "No se ha encontrado Datos relacionados con este Indicador !";
 }

/* ***************************************** Funciones ************************************************* */
	function Semaforo_indi_($value)
  	{ 
		global $coloverte ; global $colorojo  ; global $coloamarillo  ; global $semaforo;
	  	$verde = " style='background:$coloverte;' >";
	  	$rojo = " style='background:$colorojo;' >";
	  	$amarillo = " style='background:$coloamarillo;' >";
		$blanco = " >";
		$value = trim($value);
		switch ($semaforo) {
			case 'indicador6':
				$value = trim( str_replace("%", "", $value ) );
			  	if($value =="" ){ $respuesta =  $blanco .$value ; }
			  	else if($value >= 3){ $respuesta =  $verde .$value."%" ; }
			  	else if(  ($value >= 2.5) && ($value < 2.9)){ $respuesta =  $amarillo.$value."%" ; }
			  	else{ $respuesta =  $rojo.$value."%" ; } 
				break;
			case 'indicador8':
			  	if($value ==""){ $respuesta = $blanco .$value ; }
			  	else if($value >= 5){ $respuesta = $verde .$value ; }
			  	else if(  ($value >= 4) && ($value < 4.99)){ $respuesta = $amarillo.$value ; }
			  	else{ $respuesta = $rojo.$value ; } 
				break; 
			case 'indicador4':
				$value = trim( str_replace("%", "", $value ) );/*
			  	if($value =="" ){ $respuesta =  $blanco .$value ; }
			  	else if($value >= 3){ $respuesta =  $verde .$value."%" ; }
			  	else if(  ($value >= 2.5) && ($value < 2.9)){ $respuesta =  $amarillo.$value."%" ; }
			  	else{ $respuesta =  $rojo.$value."%" ; } */
			  	if($value =="" ){ $respuesta =  $blanco .$value ; }
			  	else{ $respuesta =  $blanco.$value."%" ; }  
				break;

 			case 'indicador7':
				$value = trim( str_replace("%", "", $value ) );/*
			  	if($value =="" ){ $respuesta =  $blanco .$value ; }
			  	else if($value >= 3){ $respuesta =  $verde .$value."%" ; }
			  	else if(  ($value >= 2.5) && ($value < 2.9)){ $respuesta =  $amarillo.$value."%" ; }
			  	else{ $respuesta =  $rojo.$value."%" ; } */
			  	if($value =="" ){ $respuesta =  $blanco .$value ; }
			  	else{ $respuesta =  $blanco.$value."%" ; }  
				break;


		}
		return $respuesta ;
  	}


	function Leyenda_Indicador_6(){
		global $coloverte ; global $colorojo  ; global $coloamarillo  ;
		echo utf8_encode("<p>Meta Mensual 3% de la Poblacion Femenina de 25 a 64</p>");
		echo "<div class='divleyenda'>
		<p style='text-align: left;'> <strong> Leyenda : </strong> <br/>
		<span style='background: $coloverte;  padding: 0 0.8em;  '>  </span>&nbsp Exito  : De 3 A MAS (%) <br/>
		<span style='background: $coloamarillo; padding: 0 0.8em; '>  </span>&nbsp En Proceso   : DE 2.5  A 2.9 (%) <br/>
		<span style='background: $colorojo; padding: 0 0.8em; '>  </span>&nbsp Riesgo   : MENOS DE 2.5 (%) <br/>
		</p>
		<p>Fuente HIS : OITE </p>
		</div>" ;
	}

	function Leyenda_Indicador_8(){
		global $coloverte ; global $colorojo  ; global $coloamarillo  ;
		echo "<div class='divleyenda'>
		<p style='text-align: left;'> <strong> Leyenda : </strong>  <br/>
		<span style='background: $coloverte;  padding: 0 0.8em;  '>  </span>&nbsp Exito : DE 5 A MAS  <br/>
		<span style='background: $coloamarillo; padding: 0 0.8em; '>  </span>&nbsp En Proceso : DE 4  A 4.9 <br/>
		<span style='background: $colorojo; padding: 0 0.8em; '>  </span>&nbsp Riesgo : MENOS DE 4  <br/>
		</p>
		<p>Fuente HIS : OITE </p>
		</div>" ;
	} 

	function operaciones($Columnavalor1 , $Columnavalor2){
		$obj = new cls_Indicadores; global $operacion;
		switch ($operacion) {
			case 'divicion': $respuesta =   $obj->Divicion1(  $Columnavalor1 , $Columnavalor2 ); break;
			case 'porcentaje': $respuesta =   $obj->Porcentaje(  $Columnavalor1 , $Columnavalor2 ); break; 
		}
		return $respuesta;
	}


function Tabla_dibujada_1($TablaArray,   $titulo ,$ActCabe=true , $ActPIE=true  ){
$obj = new cls_Indicadores;
$cabecera = "<table class='clsTabla' cellpadding='0' cellspacing='0'><thead>
	<tr>
		<td>CENTRO DE SALUD</td>
		<td>Abr</td> <td>May</td> <td>Jun</td>
		<td>Jul</td> <td>Ago</td> <td>Set</td>
		<td>Oct</td> <td>Nov</td> <td>Dic</td>	<td>Total</td>
	</tr></thead>";
	if ($ActCabe) echo $cabecera;
	if(isset($TablaArray)){
	foreach($TablaArray as $key => $filas){	
		$Columnavalor1 +=$filas[1]; $Columnavalor2 +=$filas[2];
		$Columnavalor3 +=$filas[3]; $Columnavalor4 +=$filas[4];
		$Columnavalor5 +=$filas[5]; $Columnavalor6 +=$filas[6];
		$Columnavalor7 +=$filas[7]; $Columnavalor8 +=$filas[8];
		$Columnavalor9 +=$filas[9]; $Columnavalor10 +=$filas[10];
		$Columnavalor11 +=$filas[11]; $Columnavalor12 +=$filas[12];
		$Columnavalor13 +=$filas[13]; $Columnavalor14 +=$filas[14];
		$Columnavalor15 +=$filas[15]; $Columnavalor16 +=$filas[16];
		$Columnavalor17 +=$filas[17]; $Columnavalor18 +=$filas[18];
		for ($i=1; $i <=18 ; $i++) { 
			if ($i%2==0){ $totalFila_Mayor += intval($filas[$i]); }
			else{ $totalFila_Menor += intval($filas[$i]); }
		}
	} 		 
	$totalFila_Centro = Semaforo_indi_(  operaciones($totalFila_Menor, $totalFila_Mayor )   );
	echo "<tr> <td colspan='11' style='background:#E0E9F5;'>  </td> </tr>" ;
	echo "<tr>" ;
	echo "<td style='background:#E0E9F5;' ><strong>TOTAL $titulo</strong></td>";
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor1 , $Columnavalor2 ) )."</td>";	
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor3 , $Columnavalor4 ) )."</td>";	
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor5 , $Columnavalor6 ) )."</td>";	
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor7 , $Columnavalor8 ) )."</td>";	
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor9 , $Columnavalor10 ) )."</td>";	
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor11 , $Columnavalor12 ) )."</td>";	
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor13 , $Columnavalor14 ) )."</td>";	
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor15 , $Columnavalor16 ) )."</td>";	
	echo "<td". Semaforo_indi_( operaciones(  $Columnavalor17 , $Columnavalor18 ) )."</td>";	
	echo "<td".  $totalFila_Centro  ."</td>";	
	echo "</tr>" ;
	echo "<tr> <td colspan='11' style='background:#E0E9F5;'><strong>  $titulo</strong></td> </tr>" ;
	foreach($TablaArray as $key => $filas){
		echo "<tr>" ;
  		echo "<td>&nbsp;&nbsp;". utf8_encode(  $filas[0]  ) ."</td>"; 
		echo "<td".Semaforo_indi_(operaciones($filas[1], $filas[2] ) ) ."</td>";
		echo "<td".Semaforo_indi_(operaciones($filas[3], $filas[4] ) ) ."</td>";
		echo "<td".Semaforo_indi_(operaciones($filas[5], $filas[6] ) ) ."</td>";
		echo "<td".Semaforo_indi_(operaciones($filas[7], $filas[8] ) ) ."</td>";
		echo "<td".Semaforo_indi_(operaciones($filas[9], $filas[10] ) ) ."</td>"; 
		echo "<td".Semaforo_indi_(operaciones($filas[11], $filas[12] ) ) ."</td>";
		echo "<td".Semaforo_indi_(operaciones($filas[13], $filas[14] ) ) ."</td>";
		echo "<td".Semaforo_indi_(operaciones($filas[15], $filas[16] ) ) ."</td>";
		echo "<td".Semaforo_indi_(operaciones($filas[17], $filas[18] ) ) ."</td>"; 
    	for ($i=1; $i < 18; $i++) { 			    		
    		if ($i%2==0){ $totalFilaHorizontal_Mayor += intval($filas[$i]); }
    		else{ $totalFilaHorizontal_Menor += intval($filas[$i]); }
    	} 
		$totalFilatotalFilaHorizontal_Menor = Semaforo_indi_(  operaciones($totalFilaHorizontal_Menor, $totalFilaHorizontal_Mayor )  );		
		$totalFilaHorizontal_Mayor = 0;		$totalFilaHorizontal_Menor = 0;
		echo "<td".$totalFilatotalFilaHorizontal_Menor ."  </td>";
		echo "</tr>" ;	
	}
	}
	$pied = "</table>";
	if($ActPIE) echo $pied;
}

function Tabla_Resumen_1($TablaArray, $ActCabe=true , $ActPIE=true  ){
$obj = new cls_Indicadores;
$cabecera = "<table class='clsTabla' cellpadding='0' cellspacing='0'><thead>
	<tr>
		<td>CENTRO DE SALUD</td>
		<td>Abr</td> <td>May</td> <td>Jun</td>
		<td>Jul</td> <td>Ago</td> <td>Set</td>
		<td>Oct</td> <td>Nov</td> <td>Dic</td>	<td>Total</td>
	</tr></thead>";
	if ($ActCabe) echo $cabecera;
	if(isset($TablaArray)){
	foreach($TablaArray as $key => $filas){	
		switch ($filas[19]) {
		    case 4:
			$DataHospitales[] = array(
			   	$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]   
			); 
			$DataTotalSecciones[] = array(
			   	$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]   
			); 

			break;  
		    case 5:
			$DataSanidades[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]    
			); 
			$DataTotalSecciones[] = array(
			   	$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]   
			); 
			break;  
		    case 1:
			$DataBonilla[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]  
			); 
			$DataTotalSecciones[] = array(
			   	$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]   
			); 
			break;
		    case 2:
			$DataBepepeca[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]  
			); 
			break;
		    case 3:
			$Dataventanilla[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]  
			); 
			$DataTotalSecciones[] = array(
			   	$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18]   
			); 
			break;  
		}		
 	}
 
	 
		foreach($DataTotalSecciones as $key => $filas){
			$Columnavalor1 +=$filas[1]; $Columnavalor2 +=$filas[2];
			$Columnavalor3 +=$filas[3]; $Columnavalor4 +=$filas[4];
			$Columnavalor5 +=$filas[5]; $Columnavalor6 +=$filas[6];
			$Columnavalor7 +=$filas[7]; $Columnavalor8 +=$filas[8];
			$Columnavalor9 +=$filas[9]; $Columnavalor10 +=$filas[10];
			$Columnavalor11 +=$filas[11]; $Columnavalor12 +=$filas[12];
			$Columnavalor13 +=$filas[13]; $Columnavalor14 +=$filas[14];
			$Columnavalor15 +=$filas[15]; $Columnavalor16 +=$filas[16];
			$Columnavalor17 +=$filas[17]; $Columnavalor18 +=$filas[18];
			for ($i=1; $i <=18 ; $i++) { 
				if ($i%2==0){ $totalFila_Mayor += intval($filas[$i]); }
				else{ $totalFila_Menor += intval($filas[$i]); }
			}
		}
		$totalFila_Centro = Semaforo_indi_(  operaciones($totalFila_Menor, $totalFila_Mayor )   );
		echo "<tr>" ;
		echo "<td>&nbsp;&nbsp; TOTAL DIRESA CALLAO</td>";
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor1 , $Columnavalor2 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor3 , $Columnavalor4 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor5 , $Columnavalor6 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor7 , $Columnavalor8 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor9 , $Columnavalor10 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor11 , $Columnavalor12 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor13 , $Columnavalor14 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor15 , $Columnavalor16 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor17 , $Columnavalor18 ) )."</td>";	
		echo "<td".  $totalFila_Centro  ."</td>";	
		echo "</tr>" ;	
			$Columnavalor1 =""; $Columnavalor2 ="";
			$Columnavalor3 =""; $Columnavalor4 ="";
			$Columnavalor5 =""; $Columnavalor6 ="";
			$Columnavalor7 =""; $Columnavalor8 ="";
			$Columnavalor9 =""; $Columnavalor10 ="";
			$Columnavalor11 =""; $Columnavalor12 ="";
			$Columnavalor13 =""; $Columnavalor14 ="";
			$Columnavalor15 =""; $Columnavalor16 ="";
			$Columnavalor17 =""; $Columnavalor18 ="";
			$totalFila_Centro ="";
	}

 

	if(isset($DataHospitales)){
		echo "<tr> <td colspan='11' style='background:#E0E9F5;'><strong>  HOSPITALES</strong></td> </tr>" ;
		foreach($DataHospitales as $key => $filas){
			echo "<tr>" ;
	  		echo "<td>&nbsp;&nbsp;". utf8_encode(  $filas[0]  ) ."</td>"; 
			echo "<td".Semaforo_indi_(operaciones($filas[1], $filas[2] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[3], $filas[4] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[5], $filas[6] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[7], $filas[8] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[9], $filas[10] ) ) ."</td>"; 
			echo "<td".Semaforo_indi_(operaciones($filas[11], $filas[12] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[13], $filas[14] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[15], $filas[16] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[17], $filas[18] ) ) ."</td>"; 
	    	for ($i=1; $i < 18; $i++) { 			    		
	    		if ($i%2==0){ $totalFilaHorizontal_Mayor += intval($filas[$i]); }
	    		else{ $totalFilaHorizontal_Menor += intval($filas[$i]); }
	    	} 
			$totalFilatotalFilaHorizontal_Menor = Semaforo_indi_(  operaciones($totalFilaHorizontal_Menor, $totalFilaHorizontal_Mayor )  );		
			$totalFilaHorizontal_Mayor = 0;		$totalFilaHorizontal_Menor = 0;
			echo "<td".$totalFilatotalFilaHorizontal_Menor ."  </td>";
			echo "</tr>" ;	

		}
	}

	if(isset($DataSanidades)){
		echo "<tr> <td colspan='11' style='background:#E0E9F5;'><strong>  SANIDADES</strong></td> </tr>" ;
		foreach($DataSanidades as $key => $filas){
			echo "<tr>" ;
	  		echo "<td>&nbsp;&nbsp;". utf8_encode(  $filas[0]  ) ."</td>"; 
			echo "<td".Semaforo_indi_(operaciones($filas[1], $filas[2] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[3], $filas[4] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[5], $filas[6] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[7], $filas[8] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[9], $filas[10] ) ) ."</td>"; 
			echo "<td".Semaforo_indi_(operaciones($filas[11], $filas[12] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[13], $filas[14] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[15], $filas[16] ) ) ."</td>";
			echo "<td".Semaforo_indi_(operaciones($filas[17], $filas[18] ) ) ."</td>"; 
	    	for ($i=1; $i < 18; $i++) { 			    		
	    		if ($i%2==0){ $totalFilaHorizontal_Mayor += intval($filas[$i]); }
	    		else{ $totalFilaHorizontal_Menor += intval($filas[$i]); }
	    	} 
			$totalFilatotalFilaHorizontal_Menor = Semaforo_indi_(  operaciones($totalFilaHorizontal_Menor, $totalFilaHorizontal_Mayor )  );		
			$totalFilaHorizontal_Mayor = 0;		$totalFilaHorizontal_Menor = 0;
			echo "<td".$totalFilatotalFilaHorizontal_Menor ."  </td>";
			echo "</tr>" ;	
		}
	}

	if(isset($DataBonilla) || isset($DataBepepeca) || isset($Dataventanilla)  ){
		echo "<tr> <td colspan='11' style='background:#E0E9F5;'><strong>REDES</strong></td> </tr>" ;
	}
	if(isset($DataBonilla)){	
		$totalFila_Mayor = 0; $totalFila_Menor = 0;
		foreach($DataBonilla as $key => $filaB){
			$Columnavalor1 +=$filaB[1]; $Columnavalor2 +=$filaB[2];
			$Columnavalor3 +=$filaB[3]; $Columnavalor4 +=$filaB[4];
			$Columnavalor5 +=$filaB[5]; $Columnavalor6 +=$filaB[6];
			$Columnavalor7 +=$filaB[7]; $Columnavalor8 +=$filaB[8];
			$Columnavalor9 +=$filaB[9]; $Columnavalor10 +=$filaB[10];
			$Columnavalor11 +=$filaB[11]; $Columnavalor12 +=$filaB[12];
			$Columnavalor13 +=$filaB[13]; $Columnavalor14 +=$filaB[14];
			$Columnavalor15 +=$filaB[15]; $Columnavalor16 +=$filaB[16];
			$Columnavalor17 +=$filaB[17]; $Columnavalor18 +=$filaB[18];
			for ($i=1; $i <=18 ; $i++) { 
				if ($i%2==0){ $totalFila_Mayor += intval($filaB[$i]); }
				else{ $totalFila_Menor += intval($filaB[$i]); }
			}
		}
		$totalFila_Centro = Semaforo_indi_(  operaciones($totalFila_Menor, $totalFila_Mayor )   );
		
		echo "<tr>" ;
		echo "<td>&nbsp;&nbsp; TOTAL RED BONILLA</td>";
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor1 , $Columnavalor2 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor3 , $Columnavalor4 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor5 , $Columnavalor6 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor7 , $Columnavalor8 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor9 , $Columnavalor10 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor11 , $Columnavalor12 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor13 , $Columnavalor14 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor15 , $Columnavalor16 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor17 , $Columnavalor18 ) )."</td>";	
		echo "<td".  $totalFila_Centro."</td>";	
		echo "</tr>" ;	
			$Columnavalor1 =""; $Columnavalor2 ="";
			$Columnavalor3 =""; $Columnavalor4 ="";
			$Columnavalor5 =""; $Columnavalor6 ="";
			$Columnavalor7 =""; $Columnavalor8 ="";
			$Columnavalor9 =""; $Columnavalor10 ="";
			$Columnavalor11 =""; $Columnavalor12 ="";
			$Columnavalor13 =""; $Columnavalor14 ="";
			$Columnavalor15 =""; $Columnavalor16 ="";
			$Columnavalor17 =""; $Columnavalor18 ="";
			$totalFila_Centro ="";
			
	}

	if(isset($DataBepepeca)){	
	$totalFila_Mayor = 0; $totalFila_Menor = 0;	
		foreach($DataBepepeca as $key => $filas){
			$Columnavalor1 +=$filas[1]; $Columnavalor2 +=$filas[2];
			$Columnavalor3 +=$filas[3]; $Columnavalor4 +=$filas[4];
			$Columnavalor5 +=$filas[5]; $Columnavalor6 +=$filas[6];
			$Columnavalor7 +=$filas[7]; $Columnavalor8 +=$filas[8];
			$Columnavalor9 +=$filas[9]; $Columnavalor10 +=$filas[10];
			$Columnavalor11 +=$filas[11]; $Columnavalor12 +=$filas[12];
			$Columnavalor13 +=$filas[13]; $Columnavalor14 +=$filas[14];
			$Columnavalor15 +=$filas[15]; $Columnavalor16 +=$filas[16];
			$Columnavalor17 +=$filas[17]; $Columnavalor18 +=$filas[18];
			for ($i=1; $i <=18 ; $i++) { 
				if ($i%2==0){ $totalFila_Mayor += intval($filas[$i]); }
				else{ $totalFila_Menor += intval($filas[$i]); }
			}

		}
		$totalFila_Centro = Semaforo_indi_(  operaciones($totalFila_Menor, $totalFila_Mayor )   );
		echo "<tr>" ;
		echo "<td>&nbsp;&nbsp; TOTAL RED BEPECA</td>";
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor1 , $Columnavalor2 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor3 , $Columnavalor4 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor5 , $Columnavalor6 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor7 , $Columnavalor8 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor9 , $Columnavalor10 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor11 , $Columnavalor12 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor13 , $Columnavalor14 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor15 , $Columnavalor16 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor17 , $Columnavalor18 ) )."</td>";	
		echo "<td".  $totalFila_Centro  ."</td>";	
		echo "</tr>" ;	
			$Columnavalor1 =""; $Columnavalor2 ="";
			$Columnavalor3 =""; $Columnavalor4 ="";
			$Columnavalor5 =""; $Columnavalor6 ="";
			$Columnavalor7 =""; $Columnavalor8 ="";
			$Columnavalor9 =""; $Columnavalor10 ="";
			$Columnavalor11 =""; $Columnavalor12 ="";
			$Columnavalor13 =""; $Columnavalor14 ="";
			$Columnavalor15 =""; $Columnavalor16 ="";
			$Columnavalor17 =""; $Columnavalor18 ="";
			$totalFila_Centro ="";
			$totalFila_Menor=0; $totalFila_Mayor=0;
	}

	if(isset($Dataventanilla)){	
	$totalFila_Mayor = 0; $totalFila_Menor = 0;	
		foreach($Dataventanilla as $key => $filas){
			$Columnavalor1 +=$filas[1]; $Columnavalor2 +=$filas[2];
			$Columnavalor3 +=$filas[3]; $Columnavalor4 +=$filas[4];
			$Columnavalor5 +=$filas[5]; $Columnavalor6 +=$filas[6];
			$Columnavalor7 +=$filas[7]; $Columnavalor8 +=$filas[8];
			$Columnavalor9 +=$filas[9]; $Columnavalor10 +=$filas[10];
			$Columnavalor11 +=$filas[11]; $Columnavalor12 +=$filas[12];
			$Columnavalor13 +=$filas[13]; $Columnavalor14 +=$filas[14];
			$Columnavalor15 +=$filas[15]; $Columnavalor16 +=$filas[16];
			$Columnavalor17 +=$filas[17]; $Columnavalor18 +=$filas[18];
			for ($i=1; $i <=18 ; $i++) { 
				if ($i%2==0){ $totalFila_Mayor += intval($filas[$i]); }
				else{ $totalFila_Menor += intval($filas[$i]); }
			}
		}
		$totalFila_Centro = Semaforo_indi_(  operaciones($totalFila_Menor, $totalFila_Mayor )   );
		echo "<tr>" ;
		echo "<td>&nbsp;&nbsp; TOTAL RED VENTANILLA</td>";
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor1 , $Columnavalor2 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor3 , $Columnavalor4 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor5 , $Columnavalor6 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor7 , $Columnavalor8 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor9 , $Columnavalor10 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor11 , $Columnavalor12 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor13 , $Columnavalor14 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor15 , $Columnavalor16 ) )."</td>";	
		echo "<td". Semaforo_indi_( operaciones(  $Columnavalor17 , $Columnavalor18 ) )."</td>";	
		echo "<td".  $totalFila_Centro  ."</td>";	
		echo "</tr>" ;	
			$Columnavalor1 =""; $Columnavalor2 ="";
			$Columnavalor3 =""; $Columnavalor4 ="";
			$Columnavalor5 =""; $Columnavalor6 ="";
			$Columnavalor7 =""; $Columnavalor8 ="";
			$Columnavalor9 =""; $Columnavalor10 ="";
			$Columnavalor11 =""; $Columnavalor12 ="";
			$Columnavalor13 =""; $Columnavalor14 ="";
			$Columnavalor15 =""; $Columnavalor16 ="";
			$Columnavalor17 =""; $Columnavalor18 ="";	
			$totalFila_Centro ="";
			$totalFila_Menor=0; $totalFila_Mayor=0;
	}
 
	$pied = "</table>";
	if($ActPIE) echo $pied;
}





/* *************************************** Funciones **************************************  */

function Indicador8($indicado){
$myear = '2014';
global $operacion; global $semaforo;
 $obj = new cls_Indicadores;
  		$result= $obj->Reporte_Indicado_8($myear); 
    	while($filas = mysqli_fetch_array($result) ){	  		
			switch ($filas[19]) {
			    case 1:
				$DataBonilla[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break;
			    case 2:
				$DataBepepeca[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break;
			    case 3:
				$Dataventanilla[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break; 
			    case 4: 
				$DataHospitales[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
 					
				break; 
			    case 5:
				$DataSanidades[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]    
				); 
				break; 
			}

			$DataTotal[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18] ,
				$filas[19]
			); 


      	}  
 

echo "
<div id='jqxTabs'>
	<ul>
		<li><a href='#jqxTabs-1'>Resumen</a></li>
		<li><a href='#jqxTabs-2'>Hospitales</a></li>
    	<li><a href='#jqxTabs-3'>Red Bonilla</a></li>
    	<li><a href='#jqxTabs-4'>Red Bepeca</a></li>
    	<li><a href='#jqxTabs-5'>Red Ventanilla</a></li>
    	<li><a href='#jqxTabs-6'>Sanidad</a></li>
    	<li><a href='#jqxTabs-7'>DIRESA</a></li>
    </ul>

<div id='jqxTabs-1'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_8() ; $semaforo="indicador8"; $operacion='divicion';
	Tabla_Resumen_1($DataTotal    ); 
echo"	</div>
</div>

<div id='jqxTabs-2'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_8() ; $semaforo="indicador8"; $operacion='divicion';
	Tabla_dibujada_1($DataHospitales,   "HOSPITALES" );
echo"	</div>
</div>

<div id='jqxTabs-3'>
    <div class='conte_tabs'>";
    Leyenda_Indicador_8() ; $semaforo="indicador8"; $operacion='divicion';
    Tabla_dibujada_1($DataBonilla,   "RED BONILLA" );
	echo "
	</div>
</div>

<div id='jqxTabs-4'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_8() ; $semaforo="indicador8"; $operacion='divicion';
	Tabla_dibujada_1($DataBepepeca,   "RED BEPECA" );
echo"	</div>
</div>

<div id='jqxTabs-5'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_8() ; $semaforo="indicador8"; $operacion='divicion';
	Tabla_dibujada_1($Dataventanilla,   "RED VENTANILLA" );
echo"	</div>
</div>

<div id='jqxTabs-6'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_8() ; $semaforo="indicador8"; $operacion='divicion';
	Tabla_dibujada_1($DataSanidades,   "SANIDADES" );
 
echo"	</div>
</div>
<div id='jqxTabs-7'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_8() ; $semaforo="indicador8"; $operacion='divicion';
	Tabla_dibujada_1($DataHospitales,   "HOSPITALES",true,false );
	Tabla_dibujada_1($DataSanidades,   "SANIDADES",false,false );
	Tabla_dibujada_1($DataBonilla,   "RED BONILLA" ,false,false );
	Tabla_dibujada_1($DataBepepeca,   "RED BEPECA" ,false,false);
	Tabla_dibujada_1($Dataventanilla,   "RED VENTANILLA" ,false,true); 
echo"	</div>
</div>

</div>" ;//
echo "<p>Oficina de Informatica , Telecomunicaciones y Estadistica</p>" ;
echo "<script type='text/javascript'> $(document).ready(function () { $('#jqxTabs').tabs();  }); </script>";      
}


/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
function Indicador6($indicado){
	global $operacion; global $semaforo ;
	$myear = '2014';
	$listBEPECA =true; $listBonilla =true; $listVENTANILLA =true; $listHOSPITALES =true;
 
 $obj = new cls_Indicadores;
  		$result= $obj->Reporte_Indicado_6($myear); 
    	while($filas = mysqli_fetch_array($result) ){  		
			switch ($filas[19]) {
			    case 1:
					  $DataBonilla[] = array(
					   	$filas[0] ,
						$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
						$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
						$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
						$filas[13],$filas[14] , $filas[15],$filas[16] ,
						$filas[17],$filas[18]    
					);  
     					
				break;
			    case 2:
					  $DataBepepeca[] = array(
					   	$filas[0] ,
						$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
						$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
						$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
						$filas[13],$filas[14] , $filas[15],$filas[16] ,
						$filas[17],$filas[18]    
					);  
				break;
			    case 3:
					  $Dataventanilla[] = array(
					   	$filas[0] ,
						$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
						$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
						$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
						$filas[13],$filas[14] , $filas[15],$filas[16] ,
						$filas[17],$filas[18]    
					);  
 
				break; 
			    case 4:
					  $DataHospitales[] = array(
					   	$filas[0] ,
						$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
						$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
						$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
						$filas[13],$filas[14] , $filas[15],$filas[16] ,
						$filas[17],$filas[18]   
					); 
				break; 
			    case 5:
				$DataSanidades[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]    
				); 
				break; 
			}	

			$DataTotal[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18] ,
				$filas[19]
			); 



      	}  

echo "
<div id='jqxTabs'>
	<ul>
		<li><a href='#jqxTabs-1'>Resumen</a></li>
    	<li><a href='#jqxTabs-2'>Hospitales</a></li>
    	<li><a href='#jqxTabs-3'>Red Bonilla</a></li>
    	<li><a href='#jqxTabs-4'>Red Bepeca</a></li>
    	<li><a href='#jqxTabs-5'>Red Ventanilla</a></li>    	
    	<li><a href='#jqxTabs-6'>Sanidad</a></li>  
    	<li><a href='#jqxTabs-7'>DIRESA</a></li>
    </ul>
<div id='jqxTabs-1'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_6() ; $semaforo="indicador6";$operacion='porcentaje';
	Tabla_Resumen_1($DataTotal    ); 
echo"	</div>
</div>


<div id='jqxTabs-2'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_6() ; $semaforo="indicador6";$operacion='porcentaje';
	Tabla_dibujada_1($DataHospitales,   "HOSPITALES" ); 
echo"	</div>
</div>

<div id='jqxTabs-3'>
    <div class='conte_tabs'>";
    Leyenda_Indicador_6() ; $semaforo="indicador6"; $operacion='porcentaje';
    Tabla_dibujada_1($DataBonilla,   "RED BONILLA" );
	echo "
	</div>
</div>

<div id='jqxTabs-4'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_6() ; $semaforo="indicador6"; $operacion='porcentaje';
	Tabla_dibujada_1($DataBepepeca,   "RED BEPECA" );
echo"	</div>
</div>

<div id='jqxTabs-5'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_6() ; $semaforo="indicador6"; $operacion='porcentaje';
	Tabla_dibujada_1($Dataventanilla,   "RED VENTANILLA" ); 
echo"	</div>
</div>

<div id='jqxTabs-6'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_6() ; $semaforo="indicador6"; $operacion='porcentaje';
	Tabla_dibujada_1($DataSanidades,   "SANIDADES" ); 
echo"	</div>
</div>

<div id='jqxTabs-7'> 
	<div class='conte_tabs'> ";
	Leyenda_Indicador_6() ; $semaforo="indicador6"; $operacion='porcentaje';
	Tabla_dibujada_1($DataHospitales,   "HOSPITALES" ,true,false);
	Tabla_dibujada_1($DataBonilla,   "RED BONILLA" ,false, false);
	Tabla_dibujada_1($DataBepepeca,   "RED BEPECA" ,false, false );
	Tabla_dibujada_1($DataSanidades,   "SANIDADES" ,false, false );
	Tabla_dibujada_1($Dataventanilla,   "RED VENTANILLA" ,false, true);
echo"	</div>
</div>

</div>" ;//

echo "<p>Oficina de Informatica , Telecomunicaciones y Estadistica</p>" ;
echo "<script type='text/javascript'> $(document).ready(function () {  $('#jqxTabs').tabs();  }); </script>";   
} 




function Indicador4($indicado){
$myear = '2014';
global $operacion; global $semaforo;
 $obj = new cls_Indicadores;
  		$result= $obj->Reporte_Indicado_4($myear); 
    	while($filas = mysqli_fetch_array($result) ){	  		
			switch ($filas[19]) {
			    case 1:
				$DataBonilla[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break;
			    case 2:
				$DataBepepeca[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break;
			    case 3:
				$Dataventanilla[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break; 
			    case 4: 
				$DataHospitales[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
 					
				break; 
			    case 5:
				$DataSanidades[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]    
				); 
				break; 
			}

			$DataTotal[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18] ,
				$filas[19]
			); 


      	}  
 

echo "
<div id='jqxTabs'>
	<ul>
		<li><a href='#jqxTabs-1'>Resumen</a></li>
		<li><a href='#jqxTabs-2'>Hospitales</a></li>
    	<li><a href='#jqxTabs-3'>Red Bonilla</a></li>
    	<li><a href='#jqxTabs-4'>Red Bepeca</a></li>
    	<li><a href='#jqxTabs-5'>Red Ventanilla</a></li>
    	<li><a href='#jqxTabs-6'>Sanidad</a></li>
    	<li><a href='#jqxTabs-7'>DIRESA</a></li>
    </ul>

<div id='jqxTabs-1'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_Resumen_1($DataTotal    ); 
echo"	</div>
</div>

<div id='jqxTabs-2'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($DataHospitales,   "HOSPITALES" );
echo"	</div>
</div>

<div id='jqxTabs-3'>
    <div class='conte_tabs'>";
    $semaforo="indicador4"; $operacion='porcentaje';
    Tabla_dibujada_1($DataBonilla,   "RED BONILLA" );
	echo "
	</div>
</div>

<div id='jqxTabs-4'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($DataBepepeca,   "RED BEPECA" );
echo"	</div>
</div>

<div id='jqxTabs-5'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($Dataventanilla,   "RED VENTANILLA" );
echo"	</div>
</div>

<div id='jqxTabs-6'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($DataSanidades,   "SANIDADES" );
 
echo"	</div>
</div>
<div id='jqxTabs-7'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($DataHospitales,   "HOSPITALES",true,false );
	Tabla_dibujada_1($DataSanidades,   "SANIDADES",false,false );
	Tabla_dibujada_1($DataBonilla,   "RED BONILLA" ,false,false );
	Tabla_dibujada_1($DataBepepeca,   "RED BEPECA" ,false,false);
	Tabla_dibujada_1($Dataventanilla,   "RED VENTANILLA" ,false,true); 
echo"	</div>
</div>

</div>" ;//
echo "<p>Oficina de Informatica , Telecomunicaciones y Estadistica</p>" ;
echo "<script type='text/javascript'> $(document).ready(function () { $('#jqxTabs').tabs();  }); </script>";      
}





function Indicador5($indicado){
$myear = '2014';
global $operacion; global $semaforo;
 $obj = new cls_Indicadores;
  		$result= $obj->Reporte_Indicado_5($myear); 
    	while($filas = mysqli_fetch_array($result) ){	  		
			switch ($filas[19]) {
			    case 1:
				$DataBonilla[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break;
			    case 2:
				$DataBepepeca[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break;
			    case 3:
				$Dataventanilla[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
				break; 
			    case 4: 
				$DataHospitales[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]  
				); 
 					
				break; 
			    case 5:
				$DataSanidades[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]    
				); 
				break; 
			}

			$DataTotal[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18] ,
				$filas[19]
			); 


      	}  
 

echo "
<div id='jqxTabs'>
	<ul>
		<li><a href='#jqxTabs-1'>Resumen</a></li>
		<li><a href='#jqxTabs-2'>Hospitales</a></li>
    	<li><a href='#jqxTabs-3'>Red Bonilla</a></li>
    	<li><a href='#jqxTabs-4'>Red Bepeca</a></li>
    	<li><a href='#jqxTabs-5'>Red Ventanilla</a></li>
    	<li><a href='#jqxTabs-6'>Sanidad</a></li>
    	<li><a href='#jqxTabs-7'>DIRESA</a></li>
    </ul>

<div id='jqxTabs-1'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_Resumen_1($DataTotal    ); 
echo"	</div>
</div>

<div id='jqxTabs-2'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($DataHospitales,   "HOSPITALES" );
echo"	</div>
</div>

<div id='jqxTabs-3'>
    <div class='conte_tabs'>";
    $semaforo="indicador4"; $operacion='porcentaje';
    Tabla_dibujada_1($DataBonilla,   "RED BONILLA" );
	echo "
	</div>
</div>

<div id='jqxTabs-4'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($DataBepepeca,   "RED BEPECA" );
echo"	</div>
</div>

<div id='jqxTabs-5'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($Dataventanilla,   "RED VENTANILLA" );
echo"	</div>
</div>

<div id='jqxTabs-6'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($DataSanidades,   "SANIDADES" );
 
echo"	</div>
</div>
<div id='jqxTabs-7'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador4"; $operacion='porcentaje';
	Tabla_dibujada_1($DataHospitales,   "HOSPITALES",true,false );
	Tabla_dibujada_1($DataSanidades,   "SANIDADES",false,false );
	Tabla_dibujada_1($DataBonilla,   "RED BONILLA" ,false,false );
	Tabla_dibujada_1($DataBepepeca,   "RED BEPECA" ,false,false);
	Tabla_dibujada_1($Dataventanilla,   "RED VENTANILLA" ,false,true); 
echo"	</div>
</div>

</div>" ;//
echo "<p>Oficina de Informatica , Telecomunicaciones y Estadistica</p>" ;
echo "<script type='text/javascript'> $(document).ready(function () { $('#jqxTabs').tabs();  }); </script>";      
}





function Indicador7($indicado){
	global $operacion; global $semaforo ;
	$myear = '2014';
	$listBEPECA =true; $listBonilla =true; $listVENTANILLA =true; $listHOSPITALES =true;
 
 $obj = new cls_Indicadores;
  		$result= $obj->Reporte_Indicado_7($myear); 
    	while($filas = mysqli_fetch_array($result) ){  		
			switch ($filas[19]) {
			    case 1:
					  $DataBonilla[] = array(
					   	$filas[0] ,
						$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
						$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
						$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
						$filas[13],$filas[14] , $filas[15],$filas[16] ,
						$filas[17],$filas[18]    
					);  
     					
				break;
			    case 2:
					  $DataBepepeca[] = array(
					   	$filas[0] ,
						$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
						$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
						$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
						$filas[13],$filas[14] , $filas[15],$filas[16] ,
						$filas[17],$filas[18]    
					);  
				break;
			    case 3:
					  $Dataventanilla[] = array(
					   	$filas[0] ,
						$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
						$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
						$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
						$filas[13],$filas[14] , $filas[15],$filas[16] ,
						$filas[17],$filas[18]    
					);  
 
				break; 
			    case 4:
					  $DataHospitales[] = array(
					   	$filas[0] ,
						$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
						$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
						$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
						$filas[13],$filas[14] , $filas[15],$filas[16] ,
						$filas[17],$filas[18]   
					); 
				break; 
			    case 5:
				$DataSanidades[] = array(
					$filas[0] ,
					$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
					$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
					$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
					$filas[13],$filas[14] , $filas[15],$filas[16] ,
					$filas[17],$filas[18]    
				); 
				break; 
			}	

			$DataTotal[] = array(
				$filas[0] ,
				$filas[1],$filas[2] , 	$filas[3],$filas[4] ,
				$filas[5],$filas[6] , 	$filas[7],$filas[8] ,
				$filas[9],$filas[10] ,  $filas[11],$filas[12] ,
				$filas[13],$filas[14] , $filas[15],$filas[16] ,
				$filas[17],$filas[18] ,
				$filas[19]
			); 



      	}  

echo "
<div id='jqxTabs'>
	<ul>
		<li><a href='#jqxTabs-1'>Hospitales</a></li>
 
    </ul>
<div id='jqxTabs-1'> 
	<div class='conte_tabs'> ";
	$semaforo="indicador7";   $operacion='porcentaje';
	Tabla_Resumen_1($DataTotal    ); 
echo"	

<p>FUENTE: Estudio de prevalencia de infecciones intrahospitarias</p>
<p>NOTA : </p>
<p>El Indicador 7 sera medido 2 veces al año, al final del periodo (2° medicion) el logro esperado por Hospital debe ser:</p> 			
<p>001 HOSP. NAC. DANIEL A. CARRION, logro esperado 8.97%</p>			
<p>002 HOSP. SAN JOSE, logro esperado 4.287%</p>			
<p>003 HOSPITAL DE VENTANILLA, logro esperado 0%</p>


</div>
</div>
 
 

 

</div>" ;//

echo "<p>Oficina de Informatica , Telecomunicaciones y Estadistica</p>" ;
echo "<script type='text/javascript'> $(document).ready(function () {  $('#jqxTabs').tabs();  }); </script>";   
} 




?> 
</center> 