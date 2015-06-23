<?php session_start(); 
require_once('../class/Modelo.RegistroIndicador4.php'); 
require_once('../class/Controller.class.php'); 

$h = new cls_RegistroIndicador4;

$txtfe 			=  $h->scape( $h->ExistePost( utf8_decode( $_POST['txtfe']) ) );
$codid 			=  $h->ExistePost($_POST['codid']);
$cbtcentro 		=  $h->ExistePost($_POST['cbtcentro']);
 
$txtnin2 	=   $_POST['txtnin2'] ;
$txtnin1 	=   $_POST['txtnin1'] ;
$fec_reg 	=   $_POST['fec_reg'] ;
$nroindicador 	=   $_POST['indica'] ;

 
 
function Elimina_Indicador($codid ,$fec , $nroIndicador ){

$datetime1 = new DateTime($fec);
$today = new DateTime();  
$interval = $datetime1->diff($today);
$diferencia =  $interval->format('%d');


 	if($diferencia >0){
		$mensaje = "Solo puede Eliminar Registro del mismo dia que se Registro ";
		$clase = "error1"; 
		$imprime = "ok1"; 
		return array ($mensaje, $clase,  $mensaje  );   	
 	} 
	$obj  = new cls_RegistroIndicador4;
	$arrayindicado = explode("-", $codid);
	$codigo = $arrayindicado[1];
	switch ($nroIndicador) {
	    case 1:
	        $resp_Query = $obj->f_Elimina_Indicador1($codigo ,$fec_reg);
	        break;
	    case 2:
	        $resp_Query = $obj->f_Elimina_Indicador2($codigo ,$fec_reg);
	        break;
	    case 4:
	        $resp_Query = $obj->f_Elimina_Indicador4($codigo ,$fec_reg);
	        break;
	    case 5:
	        $resp_Query = $obj->f_Elimina_Indicador5($codigo ,$fec_reg);
	        break;
	    case 6:
	        $resp_Query = $obj->f_Elimina_Indicador6($codigo ,$fec_reg);
	        break;
	    case 7:
	        $resp_Query = $obj->f_Elimina_Indicador7($codigo ,$fec_reg);
	        break;
	    case 8:
	        $resp_Query = $obj->f_Elimina_Indicador8($codigo ,$fec_reg);
	        break;
	    case 16:
	        $resp_Query = $obj->f_Elimina_Indicador2_1($codigo ,$fec_reg);
	        break;
	} 
	if($resp_Query == true){
			$mensaje = "Datos Eliminado con Exito ";
			$clase = "exito1"; 
			$imprime = "ok"; 
	}
	else 
	{
		$mensaje = "Error al Eliminar los Datos " ;
		$clase = "error1"; 
		$imprime = "ok1".$nroIndicador.' codigo : '.$codigo; 
	} 
	return array ($mensaje, $clase, $imprime);  
}



function Inserta_Registro( $txtfe , $cbtcentro , $txtnin1, $txtnin2 , $nroIndicador )
{
	$obj  = new cls_RegistroIndicador4;
	$objf  = new cls_funciones;
 	if(  $HoraActual > $HoraLiminite  ){
		$texto = "No se permite Registrar Datos ingresar datos despues de las 12:00pm";
		return array ($texto ,"error" ,$texto); 
    }   
 
	$resultado = $obj->EsBlanco($txtfe,'Fecha');
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resultado = $obj->ValidaComparacion($cbtcentro,"--","Debe Seleccionar un Centro de Salud");
	if($resultado != "true"){
		return array ($resultado ,"error" ,$resultado); 
	}  

	$resultado = $obj->EsBlanco($txtnin1, html_entity_decode ('Valor 1') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resultado = $obj->EsBlanco($txtnin2,html_entity_decode ('Valor 2 ') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

 
	switch ($nroIndicador) {
	    case 1:
	        $resp_Query = $obj->f_inserta_Indicador1($_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2);
	        break;
	    case 2:
	        $resp_Query = $obj->f_inserta_Indicador2($_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2);
	        break;
	    case 4:
	        $resp_Query = $obj->f_inserta_Indicador4($_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2);
	        break;
	    case 5:
	        $resp_Query = $obj->f_inserta_Indicador5($_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2);
	        break;
	    case 6:
	        $resp_Query = $obj->f_inserta_Indicador6($_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2);
	        break;
	    case 7:
	        $resp_Query = $obj->f_inserta_Indicador7($_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2);
	        break;
	    case 8:
	        $resp_Query = $obj->f_inserta_Indicador8($_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2);
	        break;

	    case 16:
	        $resp_Query = $obj->f_inserta_Indicador2_1($_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2);
	        break;

	} 



	//$resp_Query = $obj->f_inserta_Indicador4( $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2  );

 	$tabla = mysqli_fetch_array($resp_Query);
	if(($resp_Query) && ($tabla[0]=='1')  ) {
			$mensaje = "Data Publica con Exito " ;
			$clase = "exito1"; 
			$imprime = "ok"; 
	}
	else 
	{
		$mensaje = $tabla[0];
		$clase = "error1"; 
		$imprime = $tabla[0];
	}

	 return array ($mensaje, $clase, $imprime); 

}

 

function Actualizar_Indicador($codid,$txtfe , $cbtcentro , $txtnin1, $txtnin2,  $fecreg , $nroIndicador )
{
 

	$obj  = new cls_RegistroIndicador4;
	$objf  = new cls_funciones;
 
$datetime1 = new DateTime($fecreg);
$today = new DateTime();  
$interval = $datetime1->diff($today);
$diferencia =  $interval->format('%d');

	
 	if($diferencia >0){
		$mensaje = "Solo puede Actualizar Registro del mismo dia que se Registro ";
		$clase = "error1"; 
		$imprime = "ok1"; 
		return array ($mensaje, $clase,  $mensaje  );   	
 	}
 

	$resultado = $obj->EsBlanco($txtnin1, html_entity_decode ('Valor 1') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resultado = $obj->EsBlanco($txtnin2,html_entity_decode ('Valor 2 ') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}
 
	$arrayindicado = explode("-", $codid);
	$codigo = $arrayindicado[1];
	switch ($nroIndicador) {
	    case 1:
	        $resp_Query = $obj->f_Actualizar_Indicador1($codigo, $txtfe , $cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2 );
	        break;
	    case 2:
	        $resp_Query = $obj->f_Actualizar_Indicador2($codigo, $txtfe , $cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2 );
	        break;
	    case 4:
	        $resp_Query = $obj->f_Actualizar_Indicador4($codigo, $txtfe , $cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2 );
	        break;
	    case 5:
	        $resp_Query = $obj->f_Actualizar_Indicador5($codigo, $txtfe , $cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2 );
	        break;
	    case 6:
	        $resp_Query = $obj->f_Actualizar_Indicador6($codigo, $txtfe , $cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2 );
	        break;
	    case 7:
	        $resp_Query = $obj->f_Actualizar_Indicador7($codigo, $txtfe , $cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2 );
	        break;
	    case 8:
	        $resp_Query = $obj->f_Actualizar_Indicador8($codigo, $txtfe , $cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2 );
	        break;

	    case 16:
	        $resp_Query = $obj->f_Actualizar_Indicador2_1($codigo, $txtfe , $cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2 );
	        break;
	}



	$resp_Query = $obj->f_Actualizar_Indicador4($codid, $txtfe ,  
		$cbtcentro , $txtnin1 ,$txtnin2  , $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2   
);
 
	if($resp_Query == true){
			$mensaje = "Data Actualizad con Exito ";
			$clase = "exito1"; 
			$imprime = "ok"; 
	}
	else 
	{
		$mensaje = "Error al Actualizar los Datos";
		$clase = "error1"; 
		$imprime = $mensaje ; 
	}  
	return array ($mensaje, $clase, $imprime); 
 
}

//------------------------------------------------------------------------------------------------------------------
 

switch($_POST['tipf'])
{
	case '0001': 
	list ($mensaje, $clase, $imprime) =	Inserta_Registro($txtfe ,  $cbtcentro , 
		$txtnin1 , $txtnin2  , $nroindicador);
	break; 
	case '0002': 
	list ($mensaje, $clase, $imprime) =	Elimina_Indicador($codid,$fec_reg , $nroindicador );
	break; 
	case '0003': 
	list ($mensaje, $clase, $imprime) =	Actualizar_Indicador($codid,$txtfe ,  $cbtcentro , 
		$txtnin1,$txtnin2 ,$fec_reg , $nroindicador );
	break; 
 
}

 
ini_set('display_errors', 'Off');
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);  

$_SESSION['mensaje'] = $mensaje;
$_SESSION['clsmensaje'] = $clase;
echo trim($imprime); 
 
?>
