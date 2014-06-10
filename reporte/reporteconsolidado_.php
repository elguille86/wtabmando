<?php
//set_time_limit(0);

require_once 'Spreadsheet/Excel/Writer.php';
$workbook = new Spreadsheet_Excel_Writer();

 include('Funciones.inc.php');
 include('estilos.inc.php');
 
 include('../class/ConexionExcel.php'); 
  $obj = new DBManagerExcel;
 
 
//$myear = $_GET['fec1'];
$myear = '2014';
 

$tipo='RESUMEN';

$worksheet = $workbook->addWorksheet($tipo);
$worksheet->setInputEncoding('utf-8');
 
$workbook->setCustomColor(14, 102, 255, 255);
$worksheet->setColumn(0,0,50);
$worksheet->setColumn(0,1,13);
$worksheet->setColumn(0,2,13);
$worksheet->setColumn(0,3,13);
$worksheet->setColumn(1,4,13);
$worksheet->setColumn(1,5,13);
$worksheet->setColumn(1,6,13);
$worksheet->setColumn(1,7,13);
$worksheet->setColumn(1,8,13);
$worksheet->setColumn(1,9,13);
$worksheet->setColumn(1,10,13);
$worksheet->setColumn(1,11,13);
$worksheet->setColumn(1,12,13);
$worksheet->setColumn(1,13,13); 


		$worksheet->freezePanes(array(8, 1));
		$worksheet->write(1, 0, utf8_decode("Indicadores de Desempeño y metas Insituciones"), $Cabecera);
		 $worksheet->mergeCells(1,0,1,4);
		 //$worksheet->write(2, 0, "DESDE "."$f1"."  HASTA "."$f2", $Cabecera1);
		 $worksheet->mergeCells(2,0,2,4);
	 
		
		date_default_timezone_set("America/Lima"); 
		$Fecha_Actual 	= 	date ("d/m/Y",time());
		$Hora_Actual 	= 	date ("H:i:s",time());
		$worksheet->write(4, 0, 'Fecha Impresion: '."$Fecha_Actual", $regularFormat0);
		$worksheet->write(5, 0, 'Hora Impresion: '."$Hora_Actual", $regularFormat0);
		
		 
		$FilaExcel = 6;
		
		$worksheet->writeString($FilaExcel, 1, utf8_decode('ABRIL'), $columnTitleFormat);
		$worksheet->mergeCells($FilaExcel,1,$FilaExcel,3);

		$worksheet->writeString($FilaExcel, 4, 'MAYO', $columnTitleFormat);
		$worksheet->mergeCells($FilaExcel,4,$FilaExcel,6);
 
		$FilaExcel++;

		$worksheet->write($FilaExcel, 0, 'CENTRO DE SALUD', $columnTitleFormat);
		$worksheet->write($FilaExcel, 1, utf8_decode('Número de mujeres de 25 a 64 años con prueba de PAP'), $columnTitleFormat);
		$worksheet->write($FilaExcel, 2, utf8_decode('Poblacion femenina de 25 a 64 años (2013)'), $columnTitleFormat); 
		$worksheet->write($FilaExcel, 3, utf8_decode('INDICADOR'), $columnTitleFormat); 
		$worksheet->write($FilaExcel, 4, utf8_decode('Número de mujeres de 25 a 64 años con prueba de PAP'), $columnTitleFormat); 
		$worksheet->write($FilaExcel, 5, utf8_decode('Poblacion femenina de 25 a 64 años (2013)'), $columnTitleFormat); 
		$worksheet->write($FilaExcel, 6, utf8_decode('INDICADOR'), $columnTitleFormat); 
 

		$FilaExcel++;
 
  		$result= $obj->Reporte_Indicado_6($myear); 
    	while($filas = mysqli_fetch_array($result) ){
	  		
 
	  		//$worksheet->writeString($FilaExcel, 0, utf8_encode($filas[0]), $Resultados_Bordes_Izq);	
	  		$worksheet->writeString($FilaExcel, 0, utf8_decode($filas[0]), $Resultados_Bordes_Izq);
	  		$worksheet->writeString($FilaExcel, 1, utf8_decode($filas[1]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 2, utf8_decode($filas[2]), $Resultados_Bordes);
	  		 
	  		if($filas[1]==0  || $filas[2]==0 ){
				$ind_abri = '0 %';
	  		}else{
	  			$ind_abri =round(   ( intval($filas[1]) *100 )  / intval($filas[2]) , 0)  .' %' ;
	  		} 

	  		//$worksheet->writeString($FilaExcel, 3, utf8_decode($filas[3]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 3, $ind_abri , $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 4, utf8_decode($filas[3]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 5, utf8_decode($filas[4]), $Resultados_Bordes);

	  		if($filas[3]==0  || $filas[4]==0 ){
				$ind_mayo = '0 %';
	  		}else{
	  			$ind_mayo =round(   ( intval($filas[3]) *100 )  / intval($filas[4]) , 0)  .' %' ;
	  		} 
 			$worksheet->writeString($FilaExcel, 6, $ind_mayo , $Resultados_Bordes);
 

	 
	    	$FilaExcel++;
       
      	}    
 

		//$worksheet->write($i, 3, 'TOTAL', $columnTitleFormat); -- No se Muestra por no tener relacion

/*
		
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Pragma: public");
 */
$workbook->close();
$workbook->send('Reporte_Indicador_6.xls');


 ?>
