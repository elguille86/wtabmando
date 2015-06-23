<?php 
require_once("conexion.class.php");
include_once("MisFunciones.php"); 
class cls_funciones  extends  LibreriaFuncinos {
//constructor 
	var $con;
	
	function cls_funciones(){
		$this->con = new DBManager;
	} 

	function f_valid_user($usuario ){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select  nombre_urs  as nom ,a.cod_estab , desc_estab  , user_name , user_pwd , est_usr from 
		tb_usuario a ,   tb_establec  b 
		where user_name= '$usuario' 
	and a.cod_estab = b.cod_estab";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}


	function f_Lista_Centros(){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select cod_estab, desc_estab  
 
		FROM tb_establec where cod_red in(1,2,3,4,8,5) 
 and cod_estab not in ( '000011183','000017883')
Order By cod_red  ,  `cod_mic`,    cod_estab    ";

		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

 
	function f_lista_Indicadores_activos(){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select codind, abre from  tb_indicadores where estado='1'  ";

		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	} 



	function f_Lista_Centros_Usuarios(){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select cod_estab, desc_estab  
 
		FROM tb_establec where cod_red in(1,2,3,4,8,5) 
 and cod_estab not in ( '000017883')
Order By cod_red  ,  `cod_mic`,    cod_estab    ";

		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}


	function f_Lista_Centros_Detalle($codRed){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select `cod_estab` , `desc_estab`  from  `tb_establec` where cod_Red =$codRed ";

		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}



	function f_Lista_Nivel(){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select  id_rol  ,   des_rol   from tb_rol order by id_rol desc ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}
 
	function f_Lista_Indicadores(){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select * from tb_indicadores ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

	function f_Lista_Redes(){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select cod_red , nom_red from  tb_establec  where cod_red in(1 ,2, 3) group by cod_red , nom_red ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}


 
	/*
	function f_valid_user_Estado($usuario){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "select  nombre_urs  as nom , a.cod_dep  , desp_dep , cod_usr  from 
		tb_usuario a ,  tb_dependencias b  where user_name= '".$usuario."'   and est_usr ='1' and a.cod_dep = b.cod_dep";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}*/

	function f_Menu_Sistema($usuario){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "call sp_listamenu ('".$usuario."');";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}
 
 
	function f_Menu_Year(){
		if($this->con->conectarMYSQL()==true){
		$SQL1 = "call yearindicadores;";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

 
}
 
?>