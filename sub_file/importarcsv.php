<?php session_start(); 
include_once("../class/Controller.class.php");  
 
if(empty($_SESSION['id_saccisis'])){ session_destroy();
	$obj_funciones = new cls_funciones ;
	header("Location: ".$obj_funciones->mi_hosting()."salir.php" );
}	  

 /*
 
ini_set('post_max_size','1000M');
ini_set('upload_max_filesize','1000M');
ini_set('max_execution_time','10000');
ini_set('max_input_time','10000');
*/
include '../class/Modelo.RegistroIndicador4.php';
$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
 
 
	$indicadores[] = array(
      'name' => 'importar',
      'codigo'=>'cod_estab',
      'Indicador'=>'Indicador' ,
      'fecha'=>'fecha',
      'valor1'=>'valor1',
      'valor2'=>'valor2' ,
       
	); 

	$ListaStoreProcedere[] = array(

		);
    $ListaStoreProcedure = array(
        array(
            'NombreSP' => 'f_inserta_Indicador5',
        'NroIndicador' => '5',
        ),
    );
    $ListaStoreProcedure[] = array(
        'NombreSP' => 'f_inserta_Indicador4',
        'NroIndicador' => '4',
	);
 

    $ListaStoreProcedure[] = array(
        'NombreSP' => 'f_inserta_Indicador1',
        'NroIndicador' => '1',
	);
    $ListaStoreProcedure[] = array(
        'NombreSP' => 'f_inserta_Indicador2',
        'NroIndicador' => '2',
	);
    $ListaStoreProcedure[] = array(
        'NombreSP' => 'f_inserta_Indicador6',
        'NroIndicador' => '6',
	);

    $ListaStoreProcedure[] = array(
        'NombreSP' => 'f_inserta_Indicador7',
        'NroIndicador' => '7',
	);

    $ListaStoreProcedure[] = array(
        'NombreSP' => 'f_inserta_Indicador8',
        'NroIndicador' => '8',
	);


    $ListaStoreProcedure[] = array(
        'NombreSP' => 'f_inserta_Indicador2_1',
        'NroIndicador' => '16',
	);

 
	$file = $_FILES['Filedata']['tmp_name'] ; 
	$infoarchivo = pathinfo($_FILES['Filedata']['name'] );
	$nombra_completo = $_FILES['Filedata']['name']; 
	$NombreArchivo = $infoarchivo['filename'];
	 
	$fileTypes = array('csv'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);

//echo $indicadores[0]['name'];
	foreach ($indicadores as $key => $value) {
		if(  $_POST['tip_indicador']==$indicadores[$key]['name']   ){ 
			$lectura=true;
			$codigo = $indicadores[$key]['codigo'] ; 
			$fecha = $indicadores[$key]['fecha'] ; 
			$Indicador = $indicadores[$key]['Indicador'] ; 
			$valor1 = $indicadores[$key]['valor1'] ; 
			$valor2 = $indicadores[$key]['valor2'] ; 
			//$sp = $indicadores[$key]['sp'] ; 
			break; 
		}

	}

	$cabe= true;
	if($lectura){
  		$arrResult = array();
  		$handle = fopen($file,"r");
  		$i =0 ;
  		if( $handle ) {
    		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    			if($cabe){
	      			if( ($i==0)  && ($data[0] == $codigo) && ($data[2] == $Indicador) && ($data[3] == $fecha) && ($data[4] == $valor1) && ($data[5] == $valor2)  ){
	      				$cabe = false;
	      			}else{
	      				echo "No se estan respetando las Cabeceras indicadas en la platilla de Importacion"; break;
	      			}
	    		}else {
    				if( isset($data[0]) && isset($data[2]) && isset($data[3]) && isset($data[4]) && isset($data[5]) ){
    					$obj = new cls_RegistroIndicador4();
    					$car_Query = $obj->ExsiteCentroSalud( $data[0]  );
						$tb1 = mysqli_fetch_array($car_Query);
						$codi = $data[0];
						if(($car_Query) && ($tb1[0]=='0')  ) {
							echo "El Codigo :  ".$data[0]. ' no pertenerce a un centro de Salud , verificar en la plantilla.'; 
							echo ' Detalle del Registro ';
							var_dump($data);unset($datos);
							break;exit();
						} 

						$resultado = $obj->validateFecha($data[3],'$fecha');
						if($resultado != "true"){
							echo $resultado; echo ' Detalle del Registro ';var_dump($data);unset($datos);
							break; exit();
						}

						$resultado = $obj->ValidaNumero($data[4],'Columna $valor1 ');
						if($resultado != "true"){
							echo $resultado; echo ' Detalle del Registro ';var_dump($data);unset($datos);
							break; exit();
						}

						$resultado = $obj->ValidaNumero($data[5],'Columna $valor2 ');
						if($resultado != "true"){
							echo $resultado; echo ' Detalle del Registro ';var_dump($data);unset($datos);
							break; exit();
						}



						$datos[] = array( $data[0], $data[1] ,$data[2] , $data[3], $data[4], $data[5] ,    ); 
 

    				}else{
    					echo "Existen  valores vacios en el archivo : $nombra_completo "; break;
    				}			
    			}
        		$i++;
    		}
    		fclose($handle);
  		}
	}
	else { 
		echo  $_POST['indicador']. '- '.$indicadores[$key]['name'];
		echo "El archivo : <b> $nombra_completo </b> no tiene el nombre autorizado por ser procesado por el Servidor";
		break;
	}  
 
	if(isset($datos)){
		$can=0;
		$messagefinal= true;
	//include '../class/Modelo.RegistroIndicador4.php';
		$indicador = new cls_RegistroIndicador4();
		foreach ($datos as $key => $value) {

               $sp_del_indicador ="";
            for($i = 0; $i < count($ListaStoreProcedure); $i++){
            	if($ListaStoreProcedure[$i]['NroIndicador']==$datos[$key][2]){
            		$sp_del_indicador = $ListaStoreProcedure[$i]['NombreSP'];
            		break;
            	}
            }
         

			$resp_Query = $indicador->$sp_del_indicador( $_SESSION['id_cod'], 
			$datos[$key][3] , $datos[$key][0], $datos[$key][4], $datos[$key][5]);
			$tabla = mysqli_fetch_array($resp_Query);
			if(($resp_Query) && ($tabla[0]=='1')  ) {
				$can++ ; 
			}else{
				$mensaje = $tabla[0];
				$arraerror[] = array(
				$datos[$key][0],$datos[$key][1] ,  $datos[$key][2], $datos[$key][3], $datos[$key][4]
				, $datos[$key][5]
					);
				echo 'Nro de Registros ingresados : '.$can.' en la  Base de Datos<br/>';
				echo $mensaje;
				var_dump($arraerror);
				$messagefinal=false;
				break;
			}
		}
 		if($messagefinal)echo 'Nro de Registros ingresados : '.$can.' en la  Base de Datos';
	}  
}else{
	echo "Erro de lectura de Archivo. :( ";

}

?>