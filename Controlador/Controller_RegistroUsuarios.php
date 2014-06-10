<?php session_start(); 
require_once('../class/Modelo.RegistroUsuarios.php'); 

$h = new cls_RegistroUsuarios;
//header("Content-Type: text/html;charset=utf-8");

$txtfe 			=  $h->scape( $h->ExistePost( utf8_decode( $_POST['txtfe']) ) );

$txtusuario		=  $h->ExistePost($_POST['txtusuario']); 
$txtclave 		=  $h->ExistePost($_POST['txtclave']);
$cbnivel  		=  $h->ExistePost($_POST['cbnivel']);
$cbtcentro 		=  $h->ExistePost($_POST['cbtcentro']);
$txtnombre		=  $h->ExistePost($_POST['txtnombre']);



$ipwd 			=  $_POST['ipwd'];
$codid 			=  $h->ExistePost($_POST['codid']);
 
 
 
 
function Elimaina_Registro_Usuario($codid){

	 
	$obj  = new cls_RegistroUsuarios;
	$resp_Query = $obj->f_Elimina_Usuario($codid
		);
 
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

 


function Inserta_Registro_usuario( $txtusuario	 , $txtclave , $cbnivel , $cbtcentro, $txtnombre  )
{
	$obj  = new cls_RegistroUsuarios;
 
 

	$resultado = $obj->ValidaComparacion($cbtcentro,"--","Debe Seleccionar un Centro de Salud");
	if($resultado != "true"){
		return array ($resultado ,"error" ,$resultado); 
	} 

	$resultado = $obj->ValidaComparacion($cbnivel,"--","Debe Seleccionar un Nivel");
	if($resultado != "true"){
		return array ($resultado ,"error" ,$resultado); 
	} 


	$resultado = $obj->EsBlanco($txtusuario,'Usuario ');
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}


	$resultado = $obj->EsBlanco($txtnombre,'Nombre ');
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$resultado = $obj->EsBlanco($txtclave,'clave ');
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}
	$txtnombre = mb_strtoupper($txtnombre, 'UTF-8'); 
 
	$resp_Query = $obj->f_inserta_Usuario(  htmlentities ($txtusuario)	 , md5($txtclave) , htmlentities ($txtnombre ), $cbtcentro, $cbnivel  );

	$tabla = mysqli_fetch_array($resp_Query);

	if(($resp_Query) && ($tabla[0]=='1')  ) {
			$mensaje = "Data Publica con Exito ";
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



function Actualizar_Registro_Usuario( $txtnombre , $txtclave ,$cbnivel , $cbtcentro,  $ipwd ,$codid )
{	  
	$obj  = new cls_RegistroUsuarios;

	$resultado = $obj->ValidaComparacion($cbtcentro,"--","Debe Seleccionar un Centro de Salud");
	if($resultado != "true"){
		return array ($resultado ,"error" ,$resultado); 
	} 

	$resultado = $obj->ValidaComparacion($cbnivel,"--","Debe Seleccionar un Nivel");
	if($resultado != "true"){
		return array ($resultado ,"error" ,$resultado); 
	} 


	$resultado = $obj->EsBlanco($txtnombre,'Nombre ');
	if($resultado != "true"){
 		return array ($resultado ,"error" ,$resultado); 
	}

	$txtnombre = mb_strtoupper($txtnombre, 'UTF-8'); 

	if ($ipwd=='0'){
		$resp_Query = $obj->f_update_Usuarios_sinpwd( $codid , $cbtcentro, htmlentities( $txtnombre ),   $cbnivel  );
 	 
	}else {
		$resp_Query = $obj->f_update_Usuarios_Con_pwd( $codid , $cbtcentro, htmlentities( $txtnombre ),   $cbnivel , trim(md5($txtclave)) );



	}
 
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
	list ($mensaje, $clase, $imprime) =	Inserta_Registro_Usuario( $txtusuario	 , $txtclave , $cbnivel , $cbtcentro, $txtnombre );
	break; 
	case '0002': 
	list ($mensaje, $clase, $imprime) =	Elimaina_Registro_Usuario($codid );
	break; 
	case '0003': 
	list ($mensaje, $clase, $imprime) =	Actualizar_Registro_Usuario( $txtnombre , $txtclave ,$cbnivel , $cbtcentro,  $ipwd ,$codid );
	break; 
}




 



 
ini_set('display_errors', 'Off');
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);  

$_SESSION['mensaje'] = $mensaje;
$_SESSION['clsmensaje'] = $clase;
echo trim($imprime); 
 
?>
