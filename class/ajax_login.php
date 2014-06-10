<?php session_start();
require_once('Controller.class.php'); 
$obj_funciones = new cls_funciones;
$user_name 	= $obj_funciones->scape($_POST['user_name']);	
$pass 		= $obj_funciones->scape($_POST['password']);
 
if(!isset($user_name )){ 
	session_destroy();
 	header("Location: ".$obj_funciones->mi_hosting() );
	return;
} 
 
//if( ($result= $obj_funciones->f_valid_user_Estado($user_name)) >= 1){

if( ($result= $obj_funciones->f_valid_user($user_name )) >= 1){
	
	$row = mysqli_fetch_array($result);  

	if($row ['est_usr'] == '0'){
		session_destroy();
		echo "Usuario Desactivado";
	}
	else if( $row['user_pwd'] = md5($pass) ) {
		//echo "SysAReg.php?energyblue";
		echo "registro.php";
		 $_SESSION['id_saccisis'] = $user_name;//$row ['nom']; 
		 $_SESSION['id_cod'] = $row ['user_name'];//$row ['nom']; 
		 $_SESSION['codCentro'] = $row ['cod_estab'];//$row ['nom']; 

		
	} else{
		session_destroy();
		echo "Error de Acceso : ".$row['user_pwd'] ." - ". md5($pass) ;	
	}  
}else {
	session_destroy();
	echo "Usuario o Contrase&ntilde;a Incorrectos . " ;
}

	/*
}else {
	session_destroy();
		echo "Usuario Desactivado";

}
*/



///////////////////////////////////////////////////////////////
  
 
?>