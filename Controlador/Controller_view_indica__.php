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
$coloverte = "#4d9622";
$colorojo = "#f63939";
$coloamarillo = "#fdd104";


echo utf8_encode("<p><strong>Se ha Selecionado el Indicado : ".$text_Indicador."</strong></p>");


switch ($_POST['indi']) {
    case 6:
        Indicador6(utf8_encode ( $text_Indicador ));
        break;
    case 8:
        Indicador8(utf8_encode ( $text_Indicador ) );
        break;
    default:
       echo "No se ha encontrado Datos relacionados con este Indicador !";

 }

/* **** Funciones *** */



	function Porcentaje($vmenor, $vmayor) {
		if($vmenor ==0  && $vmayor==0 ){
			return  '';
		}else if($vmenor ==0  || $vmayor==0 ){
			return  '0.0%';
		}else{
			return  round(   ( intval($vmenor) *100 )  / intval($vmayor ) , 1) .'%';
		}  	
	}

  	function Semaforo_indi8($value)
  	{ 
		global $coloverte;  global $colorojo;  global $coloamarillo;
	  	$verde = " style='background:$coloverte;' >";
	  	$rojo = " style='background:$colorojo;' >";
	  	$amarillo = " style='background:$coloamarillo;' >";
		$blanco = " >";
	  	if($value == ''){ return $blanco .$value ; }
	  	if($value >= 5){ return $verde .$value ; }
	  	if(  ($value >= 4) && ($value < 4.99)){ return $amarillo.$value ; }
	  	else{ return $rojo.$value ; } 
  	}

	function Semaforo_indi6($value)
  	{ 
		global $coloverte ; global $colorojo  ; global $coloamarillo  ;

	  	$verde = " style='background:$coloverte;' >";
	  	$rojo = " style='background:$colorojo;' >";
	  	$amarillo = " style='background:$coloamarillo;' >";
		$blanco = " >";
	  	if($value == ''){ return $blanco .$value ; }
	  	if($value >= 3){ return $verde .$value ; }
	  	if(  ($value >= 2.5) && ($value < 2.9)){ return $amarillo.$value ; }
	  	else{ return $rojo.$value ; } 
  	}


function Grafica_1($Nombre_Titulo, $EjeAxis ,$_ArrayDAtos, $nombreCentro,$IDDIV, $maximovalor){
echo "
 			 var sampleData = ";
echo $_ArrayDAtos ." ;";
echo "            var settings = {
                title: '$Nombre_Titulo',
                description: ' $nombreCentro',
                showLegend: true,
                enableAnimations: true,
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 10, top: 0, right: 0, bottom: 10 },
                source: sampleData,
                categoryAxis:
                    {
                        dataField: 'Centro',
                        showGridLines: true,
                        textRotationAngle: -90,
                    },
                colorScheme: 'scheme05',
                seriesGroups:
                    [
                        {
                            type: 'column',
                            columnsGapPercent: 80,
                            showLabels: true,
                            valueAxis:
                            {
                                unitInterval: $maximovalor,
                                displayValueAxis: true,
                                description: '$EjeAxis'
                            },
                            series: [
                                    { dataField: 'Abr', displayText: 'Abr'},
                                    { dataField: 'May', displayText: 'May' },
                                    { dataField: 'Jun', displayText: 'Jun' },
                                    { dataField: 'Jul', displayText: 'Jul' },
                                    { dataField: 'Ago', displayText: 'Ago' },
                                    { dataField: 'Set', displayText: 'Set' },
                                    { dataField: 'Nov', displayText: 'Nov' },
                                    { dataField: 'Dic', displayText: 'Dic' },
                                ]
                        } 
                    ]
            };
            $('#$IDDIV').jqxChart(settings);

    
";

}




/* **** Funciones ************************************************************************************************************* */


 
function Indicador8($indicado){
global $coloverte ; global $colorojo  ; global $coloamarillo  ;

echo "
 <div id='jqxTabs'>
            <ul>
    	<li><a href='#jqxTabs-1'>Grafico</a></li>
    	<li><a href='#jqxTabs-2'>Datos</a></li>

            </ul>
<div id='jqxTabs-1'>
    <div class='conte_tabs'>
 		<div id='idgrabonilla' style='width:800px; height:350px; border:1px solid black;'> </div> 
 		<div id='idgrabepeca' style='width:800px; height:350px; border:1px solid black;'> </div> 
 		<div id='idgraventanilla' style='width:800px; height:350px; border:1px solid black;'> </div> 
 		<div id='idgraHospitales' style='width:800px; height:350px; border:1px solid black;'> </div> 
 		
	</div>
</div>

<div id='jqxTabs-2'> 
	<div class='conte_tabs'>
";

echo "
<table class='clsTabla' cellpadding='0' cellspacing='0'><thead>
<tr>
	<td>CENTRO DE SALUD</td>
	<td>Abr  </td><td>May  </td><td>Jun  </td>
	<td>Jul  </td><td>Ago  </td><td>Set  </td>
	<td>Oct  </td><td>Nov  </td><td>Dic  </td>
	<td>Total  </td>
</tr></thead>" ;
$myear = '2014';
$listBEPECA =true; $listBonilla =true; $listVENTANILLA =true; $listHOSPITALES =true; $listSANIDAD =true;  

echo "<div style='	width: 200px; margin: 0 auto;'>" ;
echo "<p style='text-align: left;'> Leyenda : <br/>" ;

echo "<span style='background: $coloverte;  padding: 0 0.8em;  '>  </span>&nbsp VERDE: 5 A MAS  <br/>" ;
echo "<span style='background: $coloamarillo; padding: 0 0.8em; '>  </span>&nbsp  AMARILLO: DE 4  A 4.99  <br/>" ;
echo "<span style='background: $colorojo; padding: 0 0.8em; '>  </span>&nbsp  ROJO: MENOS DE 4  <br/>" ;  
echo "</p>" ;

echo "<p>Fuente HIS : OITE </p>" ;
echo "</div>" ; 

 $obj = new cls_Indicadores;
  		$result= $obj->Reporte_Indicado_8($myear); 
    	while($filas = mysqli_fetch_array($result) ){	  		
			switch ($filas[19]) {
			    case 1:
			    	if($listBonilla){
			    		echo "<tr> <td colspan='11' style='background:#E0E9F5;'><strong>RED BONILLA</strong></td> </tr>" ; 
			    		$listBonilla =false;
			    	}
  $DataBonilla[] = array(
  'Centro' =>   $filas[21] ,//  'Centro' => utf8_encode(  ucwords(strtolower( $filas[0])) ),
  'Abr' =>  $obj->Divicion1($filas[1], $filas[2]) ,
  'May' =>  $obj->Divicion1($filas[3], $filas[4]) ,
  'Jun' =>  $obj->Divicion1($filas[5], $filas[6]) ,
  'Jul' =>  $obj->Divicion1($filas[7], $filas[8]) ,
  'Ago' =>  $obj->Divicion1($filas[9], $filas[10]) ,  
  'Set' =>  $obj->Divicion1($filas[11], $filas[12]) ,
  'Oct' =>  $obj->Divicion1($filas[13], $filas[14]) ,
  'Nov' =>  $obj->Divicion1($filas[15], $filas[16]) ,
  'Dic' =>  $obj->Divicion1($filas[17], $filas[18]) ,  
); 

			    	$bonillavalor1 +=$filas[1]; $bonillavalor2 +=$filas[2];
			    	$bonillavalor3 +=$filas[3]; $bonillavalor4 +=$filas[4];
			    	$bonillavalor5 +=$filas[5]; $bonillavalor6 +=$filas[6];
			    	$bonillavalor7 +=$filas[7]; $bonillavalor8 +=$filas[8];
			    	$bonillavalor9 +=$filas[9]; $bonillavalor10 +=$filas[10];
			    	$bonillavalor11 +=$filas[11]; $bonillavalor12 +=$filas[12];
			    	$bonillavalor13 +=$filas[13]; $bonillavalor14 +=$filas[14];
			    	$bonillavalor15 +=$filas[15]; $bonillavalor16 +=$filas[16];
			    	$bonillavalor17 +=$filas[17]; $bonillavalor17 +=$filas[18];
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaBoni_Mayor += intval($filas[$i]); }
			    		else{ $totalFilaBoni_Menor += intval($filas[$i]); }					
			    	}
			    	$totalFilaBoni = Semaforo_indi8(  $obj->Divicion1($totalFilaBoni_Menor, $totalFilaBoni_Mayor )   );						

				break;
			    case 2:
			    	if($listBEPECA){
			    		echo "<tr> <td colspan='11'  style='background:#E0E9F5;'><strong>RED BEPECA</strong></td> </tr>" ;
						$listBEPECA =false;
			    	}
  $DataBepepeca[] = array(
  'Centro' =>   $filas[21] ,//  'Centro' => utf8_encode(  ucwords(strtolower( $filas[0])) ),
  'Abr' =>  $obj->Divicion1($filas[1], $filas[2]) ,
  'May' =>  $obj->Divicion1($filas[3], $filas[4]) ,
  'Jun' =>  $obj->Divicion1($filas[5], $filas[6]) ,
  'Jul' =>  $obj->Divicion1($filas[7], $filas[8]) ,
  'Ago' =>  $obj->Divicion1($filas[9], $filas[10]) ,  
  'Set' =>  $obj->Divicion1($filas[11], $filas[12]) ,
  'Oct' =>  $obj->Divicion1($filas[13], $filas[14]) ,
  'Nov' =>  $obj->Divicion1($filas[15], $filas[16]) ,
  'Dic' =>  $obj->Divicion1($filas[17], $filas[18]) , 
); 

			    	$bepecavalor1 +=$filas[1]; $bepecavalor2 +=$filas[2];
			    	$bepecavalor3 +=$filas[3]; $bepecavalor4 +=$filas[4];
			    	$bepecavalor5 +=$filas[5]; $bepecavalor6 +=$filas[6];
			    	$bepecavalor7 +=$filas[7]; $bepecavalor8 +=$filas[8];
			    	$bepecavalor9 +=$filas[9]; $bepecavalor10 +=$filas[10];
			    	$bepecavalor11 +=$filas[11]; $bepecavalor12 +=$filas[12];
			    	$bepecavalor13 +=$filas[13]; $bepecavalor14 +=$filas[14];
			    	$bepecavalor15 +=$filas[15]; $bepecavalor16 +=$filas[16];
			    	$bepecavalor17 +=$filas[17]; $bepecavalor17 +=$filas[18];	
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaBepe_Mayor += intval($filas[$i]); }
						else{ $totalFilaBepe_Menor += intval($filas[$i]); }
						$totalFilaBepe = Semaforo_indi8(  $obj->Divicion1($totalFilaBepe_Menor, $totalFilaBepe_Mayor )   );						
			    	}

				break;
			    case 3:
			    	if($listVENTANILLA){
			    		echo "<tr> <td colspan='11'  style='background:#E0E9F5;'><strong> RED VENTANILLA</strong></td> </tr>" ;
						$listVENTANILLA =false;
			    	}

  $Dataventanilla[] = array(
  'Centro' =>   $filas[21] ,//  'Centro' => utf8_encode(  ucwords(strtolower( $filas[0])) ),
  'Abr' =>  $obj->Divicion1($filas[1], $filas[2]) ,
  'May' =>  $obj->Divicion1($filas[3], $filas[4]) ,
  'Jun' =>  $obj->Divicion1($filas[5], $filas[6]) ,
  'Jul' =>  $obj->Divicion1($filas[7], $filas[8]) ,
  'Ago' =>  $obj->Divicion1($filas[9], $filas[10]) ,  
  'Set' =>  $obj->Divicion1($filas[11], $filas[12]) ,
  'Oct' =>  $obj->Divicion1($filas[13], $filas[14]) ,
  'Nov' =>  $obj->Divicion1($filas[15], $filas[16]) ,
  'Dic' =>  $obj->Divicion1($filas[17], $filas[18]) , 
); 

			    	$ventaniilavalor1 +=$filas[1]; $ventaniilavalor2 +=$filas[2];
			    	$ventaniilavalor3 +=$filas[3]; $ventaniilavalor4 +=$filas[4];
			    	$ventaniilavalor5 +=$filas[5]; $ventaniilavalor6 +=$filas[6];
			    	$ventaniilavalor7 +=$filas[7]; $ventaniilavalor8 +=$filas[8];
			    	$ventaniilavalor9 +=$filas[9]; $ventaniilavalor10 +=$filas[10];
			    	$ventaniilavalor11 +=$filas[11]; $ventaniilavalor12 +=$filas[12];
			    	$ventaniilavalor13 +=$filas[13]; $ventaniilavalor14 +=$filas[14];
			    	$ventaniilavalor15 +=$filas[15]; $ventaniilavalor16 +=$filas[16];
			    	$ventaniilavalor17 +=$filas[17]; $ventaniilavalor17 +=$filas[18];
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaVent_Mayor += intval($filas[$i]); }
						else{ $totalFilaVent_Menor += intval($filas[$i]); }
						$totalFilavent = Semaforo_indi8(  $obj->Divicion1($totalFilaVent_Menor, $totalFilaVent_Mayor )   );						
			    	}
				break; 
			    case 4:
			    	if($listHOSPITALES){
			    		echo "<tr> <td colspan='11'><strong>RED HOSPITALES</strong></td> </tr>" ;
						$listHOSPITALES =false;
			    	}
	$DataHospitaless[] = array(
  'Centro' =>   $filas[21] ,//  'Centro' => utf8_encode(  ucwords(strtolower( $filas[0])) ),
  'Abr' =>  $obj->Divicion1($filas[1], $filas[2]) ,
  'May' =>  $obj->Divicion1($filas[3], $filas[4]) ,
  'Jun' =>  $obj->Divicion1($filas[5], $filas[6]) ,
  'Jul' =>  $obj->Divicion1($filas[7], $filas[8]) ,
  'Ago' =>  $obj->Divicion1($filas[9], $filas[10]) ,  
  'Set' =>  $obj->Divicion1($filas[11], $filas[12]) ,
  'Oct' =>  $obj->Divicion1($filas[13], $filas[14]) ,
  'Nov' =>  $obj->Divicion1($filas[15], $filas[16]) ,
  'Dic' =>  $obj->Divicion1($filas[17], $filas[18]) ,  
); 
			    	$hospitvalor1 +=$filas[1]; $hospitvalor2 +=$filas[2];
			    	$hospitvalor3 +=$filas[3]; $hospitvalor4 +=$filas[4];
			    	$hospitvalor5 +=$filas[5]; $hospitvalor6 +=$filas[6];
			    	$hospitvalor7 +=$filas[7]; $hospitvalor8 +=$filas[8];
			    	$hospitvalor9 +=$filas[9]; $hospitvalor10 +=$filas[10];
			    	$hospitvalor11 +=$filas[11]; $hospitvalor12 +=$filas[12];
			    	$hospitvalor13 +=$filas[13]; $hospitvalor14 +=$filas[14];
			    	$hospitvalor15 +=$filas[15]; $hospitvalor16 +=$filas[16];
			    	$hospitvalor17 +=$filas[17]; $hospitvalor18 +=$filas[18];
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaHospt_Mayor += intval($filas[$i]); }
						else{ $totalFilaHospt_Menor += intval($filas[$i]);}						
			    	} 
			    	$totalFilaHospt = Semaforo_indi8(  $obj->Divicion1($totalFilaHospt_Menor, $totalFilaHospt_Mayor )   );						
				break; 
			    case 5:
			    	if($listSANIDAD){
			    		echo "<tr> <td colspan='11' style='background:#E0E9F5;'><strong>DIRESA</strong></td> </tr>" ;
						$listSANIDAD =false;
			    	}
			    	$Saninvalor1 +=$filas[1]; $Saninvalor2 +=$filas[2];
			    	$Saninvalor3 +=$filas[3]; $Saninvalor4 +=$filas[4];
			    	$Saninvalor5 +=$filas[5]; $Saninvalor6 +=$filas[6];
			    	$Saninvalor7 +=$filas[7]; $Saninvalor8 +=$filas[8];
			    	$Saninvalor9 +=$filas[9]; $Saninvalor10 +=$filas[10];
			    	$Saninvalor11 +=$filas[11]; $Saninvalor12 +=$filas[12];
			    	$Saninvalor13 +=$filas[13]; $Saninvalor14 +=$filas[14];
			    	$Saninvalor15 +=$filas[15]; $Saninvalor16 +=$filas[16];
			    	$Saninvalor17 +=$filas[17]; $Saninvalor18 +=$filas[18];
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaSANI_Mayor += intval($filas[$i]); }
						else{ $totalFilaSANI_Menor += intval($filas[$i]);}						
			    	} 
			    	$totalFilaSANI = Semaforo_indi8(  $obj->Divicion1($totalFilaSANI_Menor, $totalFilaSANI_Mayor )   );						
				break; 
			}	
			echo "<tr>" ;
	  		echo "<td>&nbsp;&nbsp;".utf8_decode($filas[0]) ."</td>";
	  		echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[1], $filas[2])).' '."</td>";
 			echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[3], $filas[4])   ).' '."</td>";
 			echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[5], $filas[6])   ).' '."</td>";
 			echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[7], $filas[8])   ).' '."</td>";
 			echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[9], $filas[10])   ).' '."</td>";
 			echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[11], $filas[12])   ).' '."</td>";
 			echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[13], $filas[14])   ).' '."</td>";
 			echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[15], $filas[16])   ).' '."</td>";
 			echo "<td".Semaforo_indi8(  $obj->Divicion1($filas[17], $filas[18])   ).' '."</td>";
	    	for ($i=1; $i < 18; $i++) { 			    		
	    		if ($i%2==0){ $totalFilaHorizontal_Mayor += intval($filas[$i]);}
				else{ $totalFilaHorizontal_Menor += intval($filas[$i]); }
	    	} 
			$totalFilatotalFilaHorizontal_Menor = Semaforo_indi8(  $obj->Divicion1($totalFilaHorizontal_Menor, $totalFilaHorizontal_Mayor )   );		
			$totalFilaHorizontal_Mayor = 0;		$totalFilaHorizontal_Menor = 0;
 			echo "<td".$totalFilatotalFilaHorizontal_Menor ."</td>";
       		echo "</tr>" ;
      	}  
		echo "<tr>" ;
		echo "<td colspan='11'  style='background:#E0E9F5;'> </td>";
		echo "</tr>" ;

		echo "<tr>" ;
		echo "<td ><strong>TOTAL RED BONILLA</strong></td>";
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor1, $bonillavalor2)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor3, $bonillavalor4)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor5, $bonillavalor6)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor7, $bonillavalor8)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor9, $bonillavalor10)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor11, $bonillavalor12)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor13, $bonillavalor14)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor15, $bonillavalor16)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bonillavalor17, $bonillavalor18)   )."</td>";	
		echo "<td".  $totalFilaBoni  ."</td>";	
	echo "</tr>" ;

	echo "<tr>" ;
	echo "<td ><strong>TOTAL RED BEPECA</strong></td>";
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor1, $bepecavalor2)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor3, $bepecavalor4)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor5, $bepecavalor6)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor7, $bepecavalor8)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor9, $bepecavalor10)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor11, $bepecavalor12)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor13, $bepecavalor14)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor15, $bepecavalor16)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($bepecavalor17, $bepecavalor18)   )."</td>";
		echo "<td".  $totalFilaBepe ."</td>";				
	echo "</tr>" ;

	echo "<tr>" ;
	echo "<td ><strong>TOTAL RED VENTANILLA</strong></td>";
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventaniilavalor1, $ventaniilavalor2)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventanillavalor3, $ventanillavalor4)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventanillavalor5, $ventanillavalor6)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventanillavalor7, $ventanillavalor8)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventanillavalor9, $ventanillavalor10)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventanillavalor11, $ventanillavalor12)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventanillavalor13, $ventanillavalor14)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventanillavalor15, $ventanillavalor16)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($ventanillavalor17, $ventanillavalor18)   )."</td>";
	 	echo "<td".  $totalFilavent ."</td>";		
	echo "</tr>" ;		

	echo "<tr>" ;
	echo "<td ><strong>TOTAL RED HOSPITALES</strong></td>";
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor1, $hospitvalor2)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor3, $hospitvalor4)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor5, $hospitvalor6)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor7, $hospitvalor8)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor9, $hospitvalor10)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor11, $hospitvalor12)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor13, $hospitvalor14)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor15, $hospitvalor16)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($hospitvalor17, $hospitvalor18)   )."</td>";		
		echo "<td".  $totalFilaHospt ."</td>";
	echo "</tr>" ;	

	echo "<tr>" ;
	echo "<td ><strong>TOTAL DIRESA</strong></td>";
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor1, $Saninvalor2)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor3, $Saninvalor4)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor5, $Saninvalor6)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor7, $Saninvalor8)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor9, $Saninvalor10)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor11, $Saninvalor12)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor13, $Saninvalor14)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor15, $Saninvalor16)   )."</td>";	
		echo "<td".Semaforo_indi8(  $obj->Divicion1($Saninvalor17, $Saninvalor18)   )."</td>";	
		echo "<td".  $totalFilaSANI ."</td>";
	echo "</tr>" ;	
echo "</table>" ;

      $Datos_Boniila  =  json_encode($DataBonilla );
      $Datos_Bepeca  =  json_encode($DataBepepeca );
      $Datos_Ventanilla  =  json_encode($Dataventanilla );
      $Datos_HOSPITALES  =  json_encode($DataHospitaless );
 echo "</div></div></div>" ;// fin del div
echo "<p>Oficina de Informatica , Telecomunicaciones y Estadistica</p>" ;

echo "<script type='text/javascript'> $(document).ready(function () { $('#jqxTabs').tabs();";	        
Grafica_1($indicado,"Indicador", $Datos_Boniila, "Red Bonilla 2014" ,"idgrabonilla",   $totalFilaBoni   );
Grafica_1($indicado,"Indicador", $Datos_Bepeca, "Red Bepeca 2014" ,"idgrabepeca" ,   $totalFilavent    );
Grafica_1($indicado,"Indicador", $Datos_Ventanilla, "Red Ventanilla 2014" ,"idgraventanilla",  $totalFilaHospt  );
Grafica_1($indicado,"Indicador", $Datos_HOSPITALES, "Hospitales 2014" ,"idgraHospitales",  $totalFilaHospt  );
echo "}); </script>";      


}


/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
function Indicador6($indicado){
	global $coloverte ; global $colorojo  ; global $coloamarillo  ;
 
echo "
 <div id='jqxTabs'>
            <ul>
    	<li><a href='#jqxTabs-1'>Grafico</a></li>
    	<li><a href='#jqxTabs-2'>Datos</a></li>

            </ul>
<div id='jqxTabs-1'>
    <div class='conte_tabs'>
 		<div id='idgrabonilla' style='width:800px; height:350px; border:1px solid black;'> </div> 
 		<div id='idgrabepeca' style='width:800px; height:350px; border:1px solid black;'> </div> 
 		<div id='idgraventanilla' style='width:800px; height:350px; border:1px solid black;'> </div> 
	</div>
</div>
<div id='jqxTabs-2'> 
	<div class='conte_tabs'>
"; 
	echo "
	<table class='clsTabla' cellpadding='0' cellspacing='0'><thead>
	<tr>
		<td>CENTRO DE SALUD</td>
		<td>Abr  </td> <td>May  </td> <td>Jun  </td>
		<td>Jul  </td> <td>Ago  </td> <td>Set  </td>
		<td>Oct  </td> <td>Nov  </td> <td>Dic  </td>	<td>Total  </td>
	</tr></thead>" ;//
	$myear = '2014';
	$listBEPECA =true; $listBonilla =true; $listVENTANILLA =true; $listHOSPITALES =true;


echo utf8_encode("<p>Meta Mensual 3% de la Poblacion Femenina de 25 a 64</p>");
echo "<div style='	width: 200px; margin: 0 auto;'>" ;
echo "<p style='text-align: left;'> Leyenda : <br/>" ;

echo "<span style='background: $coloverte;  padding: 0 0.8em;  '>  </span>&nbsp VERDE: 3 A MAS (%) <br/>" ;
echo "<span style='background: $coloamarillo; padding: 0 0.8em; '>  </span>&nbsp  AMARILLO: DE 2.5  A 2.999 (%) <br/>" ;
echo "<span style='background: $colorojo; padding: 0 0.8em; '>  </span>&nbsp  ROJO: MENOS DE 2.5 (%) <br/>" ;  
echo "</p>" ;

echo "<p>Fuente HIS : OITE </p>" ;
echo "</div>" ;
 
 $obj = new cls_Indicadores;
  		$result= $obj->Reporte_Indicado_6($myear); 
    	while($filas = mysqli_fetch_array($result) ){  		
			switch ($filas[19]) {
			    case 1:
			    	if($listBonilla){
			    		echo "<tr>" ;
			    		echo "<td colspan='11'  style='background:#E0E9F5;'><strong>RED BONILLA</strong></td>";
			    		echo "</tr>" ; $listBonilla =false;
			    	}
  $DataBonilla[] = array(
  'Centro' =>   $filas[21] ,
  'Abr' =>  Porcentaje($filas[1], $filas[2]) ,
  'May' =>  Porcentaje($filas[3], $filas[4]) ,
  'Jun' =>  Porcentaje($filas[5], $filas[6]) ,
  'Jul' =>  Porcentaje($filas[7], $filas[8]) ,
  'Ago' =>  Porcentaje($filas[9], $filas[10]) ,  
  'Set' =>  Porcentaje($filas[11], $filas[12]) ,
  'Oct' =>  Porcentaje($filas[13], $filas[14]) ,
  'Nov' =>  Porcentaje($filas[15], $filas[16]) ,
  'Dic' =>  Porcentaje($filas[17], $filas[18]) ,   
);  
 
			    	$bonillavalor1 +=$filas[1]; $bonillavalor2 +=$filas[2]; 
			    	$bonillavalor3 +=$filas[3]; $bonillavalor4 +=$filas[4];
			    	$bonillavalor5 +=$filas[5]; $bonillavalor6 +=$filas[6];
			    	$bonillavalor7 +=$filas[7]; $bonillavalor8 +=$filas[8];
			    	$bonillavalor9 +=$filas[9]; $bonillavalor10 +=$filas[10];
			    	$bonillavalor11 +=$filas[11]; $bonillavalor12 +=$filas[12];
			    	$bonillavalor13 +=$filas[13]; $bonillavalor14 +=$filas[14];
			    	$bonillavalor15 +=$filas[15]; $bonillavalor16 +=$filas[16];
			    	$bonillavalor17 +=$filas[17]; $bonillavalor18 +=$filas[18];
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaBoni_Mayor += intval($filas[$i]); }
			    		else{ $totalFilaBoni_Menor += intval($filas[$i]); }						
			    	}	    					
				break;
			    case 2:
			    	if($listBEPECA){
			    		echo "<tr>" ;
			    		echo "<td colspan='11'  style='background:#E0E9F5;'><strong>RED BEPECA</strong></td>";
			    		echo "</tr>" ; $listBEPECA =false;
			    	}

  $DataBepepeca[] = array(
  'Centro' =>   $filas[21] ,
  'Abr' =>  Porcentaje($filas[1], $filas[2]) ,
  'May' =>  Porcentaje($filas[3], $filas[4]) ,
  'Jun' =>  Porcentaje($filas[5], $filas[6]) ,
  'Jul' =>  Porcentaje($filas[7], $filas[8]) ,
  'Ago' =>  Porcentaje($filas[9], $filas[10]) ,  
  'Set' =>  Porcentaje($filas[11], $filas[12]) ,
  'Oct' =>  Porcentaje($filas[13], $filas[14]) ,
  'Nov' =>  Porcentaje($filas[15], $filas[16]) ,
  'Dic' =>  Porcentaje($filas[17], $filas[18]) ,   
);  

			    	$bepecavalor1 +=$filas[1]; $bepecavalor2 +=$filas[2];
			    	$bepecavalor3 +=$filas[3]; $bepecavalor4 +=$filas[4];
			    	$bepecavalor5 +=$filas[5]; $bepecavalor6 +=$filas[6];
			    	$bepecavalor7 +=$filas[7]; $bepecavalor8 +=$filas[8];
			    	$bepecavalor9 +=$filas[9]; $bepecavalor10 +=$filas[10];
			    	$bepecavalor11 +=$filas[11]; $bepecavalor12 +=$filas[12];
			    	$bepecavalor13 +=$filas[13]; $bepecavalor14 +=$filas[14];
			    	$bepecavalor15 +=$filas[15]; $bepecavalor16 +=$filas[16];
			    	$bepecavalor17 +=$filas[17]; $bepecavalor18 +=$filas[18];	
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaBepe_Mayor += intval($filas[$i]); }
			    		else{ $totalFilaBepe_Menor += intval($filas[$i]); }
			    	}

				break;
			    case 3:
			    	if($listVENTANILLA){
			    		echo "<tr>" ;
			    		echo "<td colspan='11'  style='background:#E0E9F5;' ><strong> RED VENTANILLA</strong></td>";
			    		echo "</tr>" ; $listVENTANILLA =false;
			    	}
  $Dataventanilla[] = array(
  'Centro' =>   $filas[21] ,
  'Abr' =>  Porcentaje($filas[1], $filas[2]) ,
  'May' =>  Porcentaje($filas[3], $filas[4]) ,
  'Jun' =>  Porcentaje($filas[5], $filas[6]) ,
  'Jul' =>  Porcentaje($filas[7], $filas[8]) ,
  'Ago' =>  Porcentaje($filas[9], $filas[10]) ,  
  'Set' =>  Porcentaje($filas[11], $filas[12]) ,
  'Oct' =>  Porcentaje($filas[13], $filas[14]) ,
  'Nov' =>  Porcentaje($filas[15], $filas[16]) ,
  'Dic' =>  Porcentaje($filas[17], $filas[18]) ,  
);  
			    	$ventaniilavalor1 +=$filas[1]; $ventaniilavalor2 +=$filas[2];
			    	$ventaniilavalor3 +=$filas[3]; $ventaniilavalor4 +=$filas[4];
			    	$ventaniilavalor5 +=$filas[5]; $ventaniilavalor6 +=$filas[6];
			    	$ventaniilavalor7 +=$filas[7]; $ventaniilavalor8 +=$filas[8];
			    	$ventaniilavalor9 +=$filas[9]; $ventaniilavalor10 +=$filas[10];
			    	$ventaniilavalor11 +=$filas[11]; $ventaniilavalor12 +=$filas[12];
			    	$ventaniilavalor13 +=$filas[13]; $ventaniilavalor14 +=$filas[14];
			    	$ventaniilavalor15 +=$filas[15]; $ventaniilavalor16 +=$filas[16];
			    	$ventaniilavalor17 +=$filas[17]; $ventaniilavalor18 +=$filas[18];
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaVent_Mayor += intval($filas[$i]); }
			    		else{ $totalFilaVent_Menor += intval($filas[$i]); }
			    	}
				break; 
			    case 4:
			    	if($listHOSPITALES){
			    		echo "<tr>" ;
			    		echo "<td colspan='11'  style='background:#E0E9F5;'><strong>RED HOSPITALES</strong></td>";
			    		echo "</tr>" ; $listHOSPITALES =false;
			    	}
			    	$hospitvalor1 +=$filas[1]; $hospitvalor2 +=$filas[2];
			    	$hospitvalor3 +=$filas[3]; $hospitvalor4 +=$filas[4];
			    	$hospitvalor5 +=$filas[5]; $hospitvalor6 +=$filas[6];
			    	$hospitvalor7 +=$filas[7]; $hospitvalor8 +=$filas[8];
			    	$hospitvalor9 +=$filas[9]; $hospitvalor10 +=$filas[10];
			    	$hospitvalor11 +=$filas[11]; $hospitvalor12 +=$filas[12];
			    	$hospitvalor13 +=$filas[13]; $hospitvalor14 +=$filas[14];
			    	$hospitvalor15 +=$filas[15]; $hospitvalor16 +=$filas[16];
			    	$hospitvalor17 +=$filas[17]; $hospitvalor18 +=$filas[18];
			    	for ($i=1; $i < 18; $i++) { 			    		
			    		if ($i%2==0){ $totalFilaHospt_Mayor += intval($filas[$i]); }
			    		else{ $totalFilaHospt_Menor += intval($filas[$i]); }
			    	} 
				break; 
			}	

			$totalFilaBoni = Semaforo_indi6(  Porcentaje($totalFilaBoni_Menor, $totalFilaBoni_Mayor )   );
			$totalFilaBepe = Semaforo_indi6(  Porcentaje($totalFilaBepe_Menor, $totalFilaBepe_Mayor )   );	
			$totalFilavent = Semaforo_indi6(  Porcentaje($totalFilaVent_Menor, $totalFilaVent_Mayor )   ); 
	    	$totalFilaHospt = Semaforo_indi6(  Porcentaje($totalFilaHospt_Menor, $totalFilaHospt_Mayor )   ); 
			echo "<tr>" ;
	  		echo "<td>&nbsp;&nbsp;".  utf8_encode(  ucwords(strtolower( $filas[0])) ) ."</td>";
	  		echo "<td".Semaforo_indi6(  Porcentaje($filas[1], $filas[2]) )." </td>";
 			echo "<td".Semaforo_indi6(  Porcentaje($filas[3], $filas[4]) )." </td>";
 			echo "<td".Semaforo_indi6(  Porcentaje($filas[5], $filas[6]) )." </td>";
 			echo "<td".Semaforo_indi6(  Porcentaje($filas[7], $filas[8]) )." </td>";
 			echo "<td".Semaforo_indi6(  Porcentaje($filas[9], $filas[10]) )." </td>";
 			echo "<td".Semaforo_indi6(  Porcentaje($filas[11], $filas[12]) )." </td>";
 			echo "<td".Semaforo_indi6(  Porcentaje($filas[13], $filas[14]) )." </td>";
 			echo "<td".Semaforo_indi6(  Porcentaje($filas[15], $filas[16]) )." </td>";
 			echo "<td".Semaforo_indi6(  Porcentaje($filas[17], $filas[18]) )." </td>";
	    	for ($i=1; $i < 18; $i++) { 			    		
	    		if ($i%2==0){ $totalFilaHorizontal_Mayor += intval($filas[$i]); }
	    		else{ $totalFilaHorizontal_Menor += intval($filas[$i]); }
	    	} 
			$totalFilatotalFilaHorizontal_Menor = Semaforo_indi6(  Porcentaje($totalFilaHorizontal_Menor, $totalFilaHorizontal_Mayor )  );		
			$totalFilaHorizontal_Mayor = 0;		$totalFilaHorizontal_Menor = 0;
 			echo "<td".$totalFilatotalFilaHorizontal_Menor ."  </td>";
       		echo "</tr>" ;
      	}  
	echo "<tr>" ;
	echo "<td colspan='11'  style='background:#E0E9F5;' > </td>";
	echo "</tr>" ;

	echo "<tr>" ;
	echo "<td ><strong>TOTAL RED BONILLA</strong></td>";
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor1, $bonillavalor2)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor3, $bonillavalor4)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor5, $bonillavalor6)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor7, $bonillavalor8)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor9, $bonillavalor10)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor11, $bonillavalor12)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor13, $bonillavalor14)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor15, $bonillavalor16)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bonillavalor17, $bonillavalor18)   )."</td>";	
		echo "<td".  $totalFilaBoni  ."</td>";	
	echo "</tr>" ;

	echo "<tr>" ;
	echo "<td ><strong>TOTAL RED BEPECA</strong></td>";
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor1, $bepecavalor2)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor3, $bepecavalor4)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor5, $bepecavalor6)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor7, $bepecavalor8)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor9, $bepecavalor10)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor11, $bepecavalor12)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor13, $bepecavalor14)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor15, $bepecavalor16)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($bepecavalor17, $bepecavalor18)   )."</td>";
		 echo "<td".  $totalFilaBepe    ."</td>";			
	echo "</tr>" ;

	echo "<tr>" ;
	echo "<td ><strong>TOTAL RED VENTANILLA</strong></td>";
		echo "<td".Semaforo_indi6(  Porcentaje($ventaniilavalor1, $ventaniilavalor2)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($ventanillavalor3, $ventanillavalor4)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($ventanillavalor5, $ventanillavalor6)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($ventanillavalor7, $ventanillavalor8)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($ventanillavalor9, $ventanillavalor10)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($ventanillavalor11, $ventanillavalor12)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($ventanillavalor13, $ventanillavalor14)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($ventanillavalor15, $ventanillavalor16)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($ventanillavalor17, $ventanillavalor18)   )."</td>";
		echo "<td".  $totalFilavent     ."</td>";		
	echo "</tr>" ;		

	echo "<tr>" ;
	echo "<td ><strong>TOTAL RED HOSPITALES</strong></td>";
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor1, $hospitvalor2)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor3, $hospitvalor4)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor5, $hospitvalor6)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor7, $hospitvalor8)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor9, $hospitvalor10)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor11, $hospitvalor12)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor13, $hospitvalor14)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor15, $hospitvalor16)   )."</td>";	
		echo "<td".Semaforo_indi6(  Porcentaje($hospitvalor17, $hospitvalor18)   )."</td>";		
		 echo "<td".  $totalFilaHospt   ."</td>";
	echo "</tr>" ;	
echo "</table>" ;
 

      $Datos_Boniila  =  json_encode($DataBonilla );
      $Datos_Bepeca  =  json_encode($DataBepepeca );
      $Datos_Ventanilla  =  json_encode($Dataventanilla );
 

 echo "</div></div></div>" ;// fin del div
echo "<p>Oficina de Informatica , Telecomunicaciones y Estadistica</p>" ;
echo "<script type='text/javascript'> $(document).ready(function () { 
 $('#jqxTabs').tabs();
	";	        
Grafica_1($indicado,"Indicador (%)",$Datos_Boniila, "Red Bonilla 2014" ,"idgrabonilla", str_replace("%", "", trim( $totalFilaBoni) )  );
Grafica_1($indicado,"Indicador (%)",$Datos_Bepeca, "Red Bepeca 2014" ,"idgrabepeca" , str_replace("%", "", trim( $totalFilavent) )    );
Grafica_1($indicado,"Indicador (%)",$Datos_Ventanilla, "Red Ventanilla 2014" ,"idgraventanilla",str_replace("%", "", trim( $totalFilaHospt) ) );
echo "
 
 

 
 
}); </script>";   

} 



?> 
 
</center>
 