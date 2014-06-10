<?php 
require_once("conexion.class.php");
include_once("MisFunciones.php"); 
class cls_RegistroIndicador4 extends  LibreriaFuncinos {
//constructor 
	var $con;
	
	function cls_RegistroIndicador4(){
		$this->con = new DBManager;
	} 

	function ExsiteCentroSalud( $cod_estab  ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call ExisteCentro( '$cod_estab'  ); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
			//return $SQL1;
		}
	} 


	function f_inserta_Indicador4($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind4( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
			//return $SQL1;
		}
	} 

	function f_Lista_Indicador4(){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "
			SELECT DATE_FORMAT(fec_dato,'%Y-%m-%d')  as  fec_dato ,
			desc_estab  as centro, Nro_ninh , Nro_nin , codtab1 , a.cod_estab as cod_estab  ,  
			DATE_FORMAT(fec_reg,'%Y-%m-%d')  as  fec_reg
			FROM tabindi_4 a, tb_establec b 
			where a.cod_estab = b.cod_estab and estado='1'  
			ORDER BY fec_dato desc , fec_reg desc
			";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}


	function f_Elimina_Indicador4($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_4  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 

	function f_Actualizar_Indicador4( $CodID, $fec_dato,  $cod_estab,  $Nro_ninh,  $Nro_nin ,$user_name){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "
			 update   tabindi_4 set 
							fec_dato = '$fec_dato',
 							user_name = '$user_name',
							cod_estab = '$cod_estab',
							Nro_ninh = 	$Nro_ninh, 
							Nro_nin = $Nro_nin 
			 where  codtab1  = '$CodID'
			";
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

//----------------------------------------------------------------------

	function f_Lista_Indicador5(){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "
			SELECT DATE_FORMAT(fec_dato,'%Y-%m-%d')  as  fec_dato ,
			desc_estab  as centro, Nro_ninh , Nro_nin , codtab1 , a.cod_estab as cod_estab  ,  
			DATE_FORMAT(fec_reg,'%Y-%m-%d')  as  fec_reg
			FROM tabindi_5 a, tb_establec b 
			where a.cod_estab = b.cod_estab and estado='1'  
			ORDER BY fec_dato desc , fec_reg desc
			";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

	function f_inserta_Indicador5($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind5( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
			//return $SQL1;
		}
	} 

	function f_Elimina_Indicador5($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_5  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 

	function f_Actualizar_Indicador5( $CodID, $fec_dato,  $cod_estab,  $Nro_ninh,  $Nro_nin ,$user_name){
		if($this->con->conectarMYSQL()==true){
		 $SQL1 = "
			 update   tabindi_5 set 
							fec_dato = '$fec_dato',
 							user_name = '$user_name',
							cod_estab = '$cod_estab',
							Nro_ninh = 	$Nro_ninh, 
							Nro_nin = $Nro_nin 
			 where  codtab1  = '$CodID'
			";
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}
 

}
 
?>