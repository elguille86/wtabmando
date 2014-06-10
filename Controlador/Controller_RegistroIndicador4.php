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

 
 
function Elimina_Indicador4($codid ,$fec ){

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
	$resp_Query = $obj->f_Elimina_Indicador4($codid ,$fec_reg);
 
	if($resp_Query == true){
			$mensaje = "Datos Eliminado con Exito ";
			$clase = "exito1"; 
			$imprime = "ok"; 
	}
	else 
	{
		$mensaje = "Error al Eliminar los Datos";
		$clase = "error1"; 
		$imprime = "ok1"; 
	} 
	return array ($mensaje, $clase, $imprime);  
}

function Inserta_Registro4( $txtfe , $cbtcentro , $txtnin1,$txtnin2 )
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

	$resultado = $obj->EsBlanco($txtnin1, html_entity_decode ('Número de  niños de 6 a 11 meses de edad que recibieron hierro') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resultado = $obj->EsBlanco($txtnin2,html_entity_decode ('Numero de Niños de 6 a 11 meses ') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resp_Query = $obj->f_inserta_Indicador4( $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2  );

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

 

function Actualizar_Indicador4($codid,$txtfe , $cbtcentro , $txtnin1, $txtnin2,  $fecreg)
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
 

	$resultado = $obj->EsBlanco($txtnin1, html_entity_decode ('Número de  niños de 6 a 11 meses de edad que recibieron hierro') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resultado = $obj->EsBlanco($txtnin2,html_entity_decode ('Numero de Niños de 6 a 11 meses ') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
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


function Inserta_Registro5( $txtfe , $cbtcentro , $txtnin1,$txtnin2 )
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

	$resultado = $obj->EsBlanco($txtnin1, html_entity_decode ('Número de  neonatos que recibieron 2 o mas controles CRED') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resultado = $obj->EsBlanco($txtnin2,html_entity_decode ('Numero de Neonatos') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resp_Query = $obj->f_inserta_Indicador5( $_SESSION['id_cod'], $txtfe ,  $cbtcentro , $txtnin1 ,$txtnin2  );

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

 
function Elimina_Indicador5($codid ,$fec ){

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
	$resp_Query = $obj->f_Elimina_Indicador5($codid ,$fec_reg);
 
	if($resp_Query == true){
			$mensaje = "Datos Eliminado con Exito ";
			$clase = "exito1"; 
			$imprime = "ok"; 
	}
	else 
	{
		$mensaje = "Error al Eliminar los Datos";
		$clase = "error1"; 
		$imprime = "ok1"; 
	} 
	return array ($mensaje, $clase, $imprime);  
}


function Actualizar_Indicador5($codid,$txtfe , $cbtcentro , $txtnin1, $txtnin2,  $fecreg)
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
 

	$resultado = $obj->EsBlanco($txtnin1, html_entity_decode ('Número de  neonatos que recibieron 2 o mas controles CRED') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resultado = $obj->EsBlanco($txtnin2,html_entity_decode ('Numero de Neonatos ') );
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}
 


	$resp_Query = $obj->f_Actualizar_Indicador5($codid, $txtfe ,  
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



switch($_POST['tipf'])
{
	case '0001': 
	list ($mensaje, $clase, $imprime) =	Inserta_Registro4($txtfe ,  $cbtcentro , 
		$txtnin1,$txtnin2 );
	break; 
	case '0002': 
	list ($mensaje, $clase, $imprime) =	Elimina_Indicador4($codid,$fec_reg  );
	break; 
	case '0003': 
	list ($mensaje, $clase, $imprime) =	Actualizar_Indicador4($codid,$txtfe ,  $cbtcentro , 
		$txtnin1,$txtnin2 ,$fec_reg);
	break; 

	case '0004': 
	list ($mensaje, $clase, $imprime) =	Inserta_Registro5($txtfe ,  $cbtcentro , 
		$txtnin1,$txtnin2 );
	break; 
	case '0005': 
	list ($mensaje, $clase, $imprime) =	Elimina_Indicador5($codid,$fec_reg  );
	break; 	

	case '0006': 
	list ($mensaje, $clase, $imprime) =	Actualizar_Indicador5($codid,$txtfe ,  $cbtcentro , 
		$txtnin1,$txtnin2 ,$fec_reg);
	break; 
}

 
ini_set('display_errors', 'Off');
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);  

$_SESSION['mensaje'] = $mensaje;
$_SESSION['clsmensaje'] = $clase;
echo trim($imprime); 
 
?>
