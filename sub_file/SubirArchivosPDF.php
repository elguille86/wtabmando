<?php session_start(); 
if(empty($_SESSION['id_user'])){ session_destroy();
	header("Location: ../salir.php");  
	}
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
// instanciamos para poder usar el objeto ClassFunciones.php
/*
ini_set('post_max_size','1000M');
ini_set('upload_max_filesize','1000M');
ini_set('max_execution_time','10000');
ini_set('max_input_time','10000');
*/

require_once("../class/convatoria.class.php");
$obje   = new cls_cas;
 
// Define a destination
$Caperta_hosting = $_SERVER['DOCUMENT_ROOT']."/".$obje->mi_hosting();
$targetFolderCas 			=  $Caperta_hosting.$obje->array_directorio["Cas"];
$targetFolderBoleEpi 		=  $Caperta_hosting.$obje->array_directorio["BoletinEpi"];
$targetFolderLegal 			=  $Caperta_hosting.$obje->array_directorio["MarcoLegal"];
$targetFolderInfluenza		=  $Caperta_hosting.$obje->array_directorio["Influenza"];
$targetFolderEstadistica	=  $Caperta_hosting.$obje->array_directorio["Estadistica"];
$targetFolderNoTramisible	=  $Caperta_hosting.$obje->array_directorio["notransmisibles"];
$targetFolder_Adquidisiones	=  $Caperta_hosting.$obje->array_directorio["adquisciones"];
$targetFolder_finanzas		=  $Caperta_hosting.$obje->array_directorio["finanzas"];
$targetFolder_Personal		=  $Caperta_hosting.$obje->array_directorio["personal"];
$targetFolder_Ordenes		=  $Caperta_hosting.$obje->array_directorio["ordenes"];
$targetFolder_Actividad		=  $Caperta_hosting.$obje->array_directorio["ActividadOficiales"];
$targetFolder_Documentos	=  $Caperta_hosting.$obje->array_directorio["tupa"];
$targetFolder_Declaley30161 =  $Caperta_hosting.$obje->array_directorio["declaraley30161"];

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) 
{
	$tempFile = $_FILES['Filedata']['tmp_name'] ;

	// Validate the file type
	$fileTypes = array('pdf'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']); 
	
	if (in_array($fileParts['extension'],$fileTypes)) 
	{
		function fecha_sys_server(){
			//		$semana_sig = time() + (7 * 24 * 60 * 60);
        			           // 7 días; 24 horas; 60 minutos; 60 segundos
			// En esta ocacion restaremos una hora por diferencia de horas del "Hosting Gratuito"
			$time = time();// - (1 * 1 * 60 * 60) ;
			return date('Ymd-his', $time);  //--> Formato de Salida :  2009-04-16 11:14:11 PM  
		}			
		//  $prefijo = fecha_sys_server().'-'.substr(md5(uniqid(rand())),0,8);

		$respuesta = $obje->GeneraCodigoArchivo();
		$fila = mysqli_fetch_array($respuesta);
		$prefijo = $fila[0];




		
		$targetFile = $prefijo.'.'.$fileParts['extension'];		
		function RutaArchivo($Folder, $FileTemporal , $NewFile )
		{
			if(move_uploaded_file($FileTemporal , $Folder.$NewFile)){
					return $NewFile;				
			}else{
				return "ERRORFILE";			
			}
		}

		switch($_POST['TypeFile']){
			case 'AAA':
				echo RutaArchivo($targetFolderCas, $tempFile, $targetFile );	break;
			case 'BBB':
				echo RutaArchivo($targetFolderBoleEpi, $tempFile, $targetFile );	break;
			case 'LLL':
				echo RutaArchivo($targetFolderLegal, $tempFile, $targetFile );	break;
			case 'III':
				echo RutaArchivo($targetFolderInfluenza, $tempFile, $targetFile );	break;	
			case 'EEE':
				echo RutaArchivo($targetFolderEstadistica, $tempFile, $targetFile );	break;	
			case 'NOT':
				echo RutaArchivo($targetFolderNoTramisible, $tempFile, $targetFile );	break;	
			case 'ADQ':
				echo RutaArchivo($targetFolder_Adquidisiones, $tempFile, $targetFile );	break;	
			case 'FFF':
				echo RutaArchivo($targetFolder_finanzas, $tempFile, $targetFile );	break;	
			case 'PER':
				echo RutaArchivo($targetFolder_Personal, $tempFile, $targetFile );	break;	
			case 'ORD':
				echo RutaArchivo($targetFolder_Ordenes, $tempFile, $targetFile );	break;	
			case 'ACT':
				echo RutaArchivo($targetFolder_Actividad, $tempFile, $targetFile );	break;	
			case 'TUP':
				echo RutaArchivo($targetFolder_Documentos, $tempFile,  'TUPA'.$targetFile );	break;
			case 'DES':
				echo RutaArchivo($targetFolder_Declaley30161, $tempFile,  'De'.$targetFile );	break;
		}
	}
} 
else 
{
	echo 'ERRORFILE-T';
}

?>