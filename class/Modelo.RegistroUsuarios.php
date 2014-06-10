<?php 
require_once("conexion.class.php");
include_once("MisFunciones.php"); 
class cls_RegistroUsuarios extends  LibreriaFuncinos {
//constructor 
	var $con;
	
	function cls_RegistroUsuarios(){
		$this->con = new DBManager;
	} 
 
	function f_Lista_Usuarios(){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " select cod_usr , a.cod_estab , desc_estab , user_name  , nombre_urs   ,  id_rol  
from  tb_usuario a ,  tb_establec  b  where  a.cod_estab = b.cod_estab  and est_usr ='1'";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}  
 	
function f_update_Usuarios_sinpwd( $cod_usr ,$cod_estab ,  $nombre_urs    ,  $id_rol ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "update tb_usuario set cod_estab='$cod_estab' ,     nombre_urs='$nombre_urs'   ,  id_rol='$id_rol'  
				where  cod_usr =  $cod_usr  ";
				 
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}
 
function f_update_Usuarios_Con_pwd( $cod_usr ,$cod_estab ,  $nombre_urs    ,  $id_rol , $user_pwd ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "update tb_usuario set cod_estab='$cod_estab' ,     nombre_urs='$nombre_urs'   ,  id_rol='$id_rol'  , user_pwd ='$user_pwd '
				where  cod_usr =  $cod_usr  ";
				 
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

 

	function f_inserta_Usuario($user_name, $pwd, $nombre,  $cod_estab, $rol   ){
		if($this->con->conectarMYSQL()==true){
 
		 	$SQL1 = "call InsertaUsuario( '$user_name', '$pwd',   '$nombre', '$cod_estab','$rol' ); ";
		 
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
 
		}
	}   


	function f_Elimina_Usuario($cod_usr){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tb_usuario  set est_usr ='0' where  cod_usr = $cod_usr  ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 


 

}
 
?>