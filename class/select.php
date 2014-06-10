<?php session_start(); 

//include_once('Controller.class.php');
/*
	$ob = new cls_funciones; 
    $id_user = $_SESSION['id_saccisis'];
	 $result = $ob->f_valid_user_Estado($id_user);
     $row = mysqli_fetch_array($result); 
     $usuario =  $row['nom'];         
    if(!isset($usuario )  || $usuario == '' || $usuario == NULL  ){ 
        session_destroy(); header("Location: ".$ob->mi_hosting() );
    } 
*/


 

include_once('ControllerFormSolic.class.php');

	
if(isset($_GET['opm'])){
	switch($_GET['opm']){
		case 'tipprod':
		 ListProvincias(  $_GET['iddeptar']  );break;	 
		case 'tipdis':
		 ListDistritos($_GET['iddeptar'],$_GET['idprovicia']  );break;		  

	}
}	
	

function ListProvincias( $idval){
	if(trim($idval)=='--'){
		echo " <option value='--'>--Seleccionar--</option> ";
	}else{  
		echo " <option value='--'>--Seleccionar--</option> ";
		$obj1 = new cls_formExterno;
		$respuesta =  $obj1->f_Lista_Provincias(trim($idval)); 

  
		 while($fila = mysqli_fetch_array($respuesta)){
			echo " <option value='".$fila[0]."'>".utf8_encode( $fila[1])."</option>\n";
	 	}	  
	} 
}	


function ListDistritos($departamento,$provicia){
 		
		 
	if(trim($departamento)=='--'  and  trim($provicia)=='--'  ){
		echo " <option value='--'>--Seleccionar--</option> ";
	}else{  
		echo " <option value='--'>--Seleccionar--</option> ";
		$obj1 = new cls_formExterno;
		$respuesta =  $obj1->f_Lista_Distritos(trim($departamento),trim($provicia)); 

  
		 while($fila = mysqli_fetch_array($respuesta)){
			echo " <option value='".$fila[0]."'>".utf8_encode( $fila[1])."</option>\n";
	 	}	  
	} 

	
}
	
?>