<?php
//set_time_limit(0);

require_once 'Spreadsheet/Excel/Writer.php';
$workbook = new Spreadsheet_Excel_Writer();

 include('Funciones.inc.php');
 include('estilos.inc.php');
 
 include('../class/ConexionExcel.php'); 
  $obj = new DBManagerExcel;
 
 
$f1 = $_GET['fec1'];
$fcha1=formatofecha($f1);

$f2 = $_GET['fec2'];
$fcha2=formatofecha($f2); 

$tipo='RESUMEN';

$worksheet = $workbook->addWorksheet($tipo);
$worksheet->setInputEncoding('utf-8');
 
$workbook->setCustomColor(14, 102, 255, 255);
$worksheet->setColumn(0,0,30);
$worksheet->setColumn(0,1,13);
$worksheet->setColumn(0,2,10);
$worksheet->setColumn(0,3,10);
$worksheet->setColumn(1,4,13);
$worksheet->setColumn(1,5,10);
$worksheet->setColumn(1,6,10);
$worksheet->setColumn(1,7,13);
$worksheet->setColumn(1,8,10);
$worksheet->setColumn(1,9,10);
$worksheet->setColumn(1,10,10);
$worksheet->setColumn(1,11,10);
$worksheet->setColumn(1,12,10);
$worksheet->setColumn(1,13,10); 


		//$worksheet->freezePanes(array(8, 1));
		$worksheet->write(1, 0, "REGION CALLAO", $Cabecera);
		$worksheet->mergeCells(1,0,1,9);
		$worksheet->write(2, 0, "REPORTE DE HUELGA DE PERSONAL MEDICO", $Cabecera);
		$worksheet->mergeCells(2,0,2,9);
		$worksheet->write(3, 0, "DIRECCION REGIONAL DE SALUD DEL CALLAO", $Cabecera);
		$worksheet->mergeCells(3,0,3,9);
		$worksheet->write(4, 0, "DESDE "."$f1"."  HASTA "."$f2", $Cabecera1);
		$worksheet->mergeCells(4,0,4,9);
	 
		
		date_default_timezone_set("America/Lima"); 
		$Fecha_Actual 	= 	date ("d/m/Y",time());
		$Hora_Actual 	= 	date ("H:i:s",time());
		$worksheet->write(6, 0, 'Fecha Impresion: '."$Fecha_Actual", $regularFormat0);
		$worksheet->write(7, 0, 'Hora Impresion: '."$Hora_Actual", $regularFormat0);
		
		 
		$FilaExcel = 8;
		$worksheet->write($FilaExcel, 0, 'ESTABLECIMIENTOS DE SALUD', $columnTitleFormat);
		$worksheet->mergeCells($FilaExcel,0,$FilaExcel+1,0);
		$worksheet->writeString($FilaExcel, 1, utf8_decode('NOMBRADOS'), $columnTitleFormat);
		$worksheet->mergeCells($FilaExcel,1,$FilaExcel,3);

		$worksheet->writeString($FilaExcel, 4, 'C.A.S.', $columnTitleFormat);
		$worksheet->mergeCells($FilaExcel,4,$FilaExcel,6);





		$worksheet->writeString($FilaExcel, 7, 'TOTAL PROGRAMADOS', $columnTitleFormat);
		$worksheet->mergeCells($FilaExcel,7,$FilaExcel+1,7);
		$worksheet->writeString($FilaExcel, 8, 'TOTAL ACATARON HUELGA', $columnTitleFormat);
		$worksheet->mergeCells($FilaExcel,8,$FilaExcel+1,8);
		$worksheet->writeString($FilaExcel, 9, '%', $columnTitleFormat);
		$worksheet->mergeCells($FilaExcel,9,$FilaExcel+1,9);
		
 
		$FilaExcel++;

		
		$worksheet->write($FilaExcel, 1, utf8_decode('MEDICOS PROGRAMADOS NOMBRADOS'), $columnTitleFormat);
		$worksheet->write($FilaExcel, 2, 'ACATO', $columnTitleFormat); 
		$worksheet->write($FilaExcel, 3, utf8_decode('%'), $columnTitleFormat);
		$worksheet->write($FilaExcel, 4, 'MEDICOS PROGRAMADOS CAS', $columnTitleFormat);
		$worksheet->write($FilaExcel, 5, 'ACATO', $columnTitleFormat);
		$worksheet->write($FilaExcel, 6, '%', $columnTitleFormat);
 

		$FilaExcel++;
		$listHospitales =true;
		$listBonilla =true;
		$listBepeca =true;
		$listVentanilla =true;
  		$result= $obj->ReporteAtenciones_RRHH($f1  ,$f2); 
    	while($filas = mysqli_fetch_array($result) ){
	  		
   		


	  		$worksheet->writeString($FilaExcel, 0, utf8_encode($filas[0]), $Resultados_Bordes_Izq);
	  		$worksheet->writeString($FilaExcel, 1, utf8_decode($filas[1]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 2, utf8_decode($filas[2]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 3, utf8_decode($filas[3]." %"), $Resultados_Bordes);

	  		$worksheet->writeString($FilaExcel, 4, utf8_decode($filas[4]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 5, utf8_decode($filas[5]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 6, utf8_decode($filas[6]." %"), $Resultados_Bordes);

	  		$worksheet->writeString($FilaExcel, 7, utf8_decode($filas[7]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 8, utf8_decode($filas[8]), $Resultados_Bordes);
	  		$worksheet->writeString($FilaExcel, 9, utf8_decode($filas[9]." %"), $Resultados_Bordes);


	        $Total1 += $filas[1];   
	        $Total2 += $filas[2];   
	        
	        $Total4 += $filas[4];   
	        $Total5 += $filas[5];   
	        
	        $Total7 += $filas[7];   
	        $Total8 += $filas[8];       
	 
	    	$FilaExcel++;
       
      	}    

  		$worksheet->writeString($FilaExcel, 0, 'TOTAL', $columnTitleFormat);
		$worksheet->writeString($FilaExcel, 1, $Total1, $columnTitleFormat);
  		$worksheet->writeString($FilaExcel, 2, $Total2, $columnTitleFormat);
  		if($Total2+$Total1 ==0  ){
  			$worksheet->writeString($FilaExcel, 3, "0 %", $columnTitleFormat);
  		}else{
  			$worksheet->writeString($FilaExcel, 3, round( ($Total2/$Total1)*100 ,2). " %", $columnTitleFormat);
  		}
//		
  		$worksheet->writeString($FilaExcel, 4, $Total4, $columnTitleFormat);
  		$worksheet->writeString($FilaExcel, 5, $Total5, $columnTitleFormat);
  		if($Total5+$Total4 ==0  ){
  			$worksheet->writeString($FilaExcel, 6, "0 %", $columnTitleFormat);
  		}else{
  			$worksheet->writeString($FilaExcel, 6, round(($Total5/$Total4)*100 ,2). " %", $columnTitleFormat);
  		}

  //		
  		$worksheet->writeString($FilaExcel, 7, $Total7, $columnTitleFormat);
  		$worksheet->writeString($FilaExcel, 8, $Total8, $columnTitleFormat);
  		if($Total8+$Total7 ==0  ){
  			$worksheet->writeString($FilaExcel, 9, "0 %", $columnTitleFormat);
  		}else{
  			$worksheet->writeString($FilaExcel, 9, round(($Total8/$Total7)*100 ,2). " %", $columnTitleFormat);
  		}
  	//	
 
	   $FilaExcel = $FilaExcel+4;



  		$worksheet->writeString($FilaExcel, 0, 'MEDICOS PROGRAMADOS', $Resultados_Bordes);
  		$worksheet->writeString($FilaExcel, 1, $Total7, $Resultados_Bordes);
		$FilaExcel++;
		$worksheet->writeString($FilaExcel, 0, 'ACATARON', $Resultados_Bordes);
  		$worksheet->writeString($FilaExcel, 1, $Total8, $Resultados_Bordes);
		$FilaExcel++;
		$worksheet->writeString($FilaExcel, 0, 'PORCENTAJE TOTAL', $columnTitleFormat);
  		if($Total8+$Total7 ==0  ){
  			$worksheet->writeString($FilaExcel, 1, "0 %", $columnTitleFormat);
  		}else{
  			$worksheet->writeString($FilaExcel, 1, round(($Total8/$Total7)*100 ,2). " %", $columnTitleFormat);
  		}

  	//	$worksheet->writeString($FilaExcel, 1, round(($Total8/$Total7)*100 ,2). " %", $columnTitleFormat);
 

		//$worksheet->write($i, 3, 'TOTAL', $columnTitleFormat); -- No se Muestra por no tener relacion

/*
		
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Pragma: public");
 */
$workbook->close();
$workbook->send('Reporte_Huelga_DiresaCallao.xls');


 ?>7