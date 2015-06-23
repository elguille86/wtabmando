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

//-------------------------------- Insertar ----------------------------------------------------


	function f_inserta_Indicador1($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind1( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	} 

	function f_inserta_Indicador2($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind2( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
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

	function f_inserta_Indicador5($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind5( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
			//return $SQL1;
		}
	}


	function f_inserta_Indicador6($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind6( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

	function f_inserta_Indicador7($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind7( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}


	function f_inserta_Indicador8($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind8( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

	function f_inserta_Indicador2_1($user_name, $reg_fec,  $cod_estab, 
		$aten_cons,  $aten_emer    ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " call Inserta_ind2_1( '$user_name' , '$reg_fec' , '$cod_estab' ,$aten_cons, $aten_emer); ";	 
		  	return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

//-------------------------------- Insertar ----------------------------------------------------
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

	function f_Lista_Todos_IndicadorActivos(){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "
	SELECT DATE_FORMAT(fec_dato,'%Y-%m-%d')  as  fec_dato ,
			desc_estab  as centro, valor1 , valor2 , codtab1 , a.cod_estab as cod_estab  ,  
			DATE_FORMAT(fec_reg,'%Y-%m-%d')  as  fec_reg1 , codind ,DATE_FORMAT(fec_dato,'%Y-%m')  as  periodo  
			FROM tv_indicadores a, tb_establec b 
			where a.cod_estab = b.cod_estab and estado='1'  
			ORDER BY fec_dato desc , fec_reg desc
			";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

// ----------------------------- Eliminar  -------------------------------------------------

	function f_Elimina_Indicador1($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_1  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 

	function f_Elimina_Indicador2($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_2  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 

	function f_Elimina_Indicador4($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_4  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 


	function f_Elimina_Indicador5($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_5  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 

	function f_Elimina_Indicador6($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_6  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 

	function f_Elimina_Indicador7($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_7  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	} 

	function f_Elimina_Indicador8($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_8  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	} 


	function f_Elimina_Indicador2_1($codId){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = " update  tabindi_2_1  set estado ='0' where  codtab1 ='$codId' ";
		return mysqli_query($this->con->conect_MySql ,$SQL1);

		}
	} 
// ----------------------------- Eliminar  -------------------------------------------------





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

	function f_Actualizar_Indicador1( $CodID, $fec_dato,  $cod_estab,  $Nro_ninh,  $Nro_nin ,$user_name){
		if($this->con->conectarMYSQL()==true){
		 $SQL1 = "
			 update   tabindi_1 set 
							fec_dato = '$fec_dato',
 							user_name = '$user_name',
							cod_estab = '$cod_estab',
							cas_des = 	$Nro_ninh, 
							menor_5a = $Nro_nin 
			 where  codtab1  = '$CodID'
			";
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

	function f_Actualizar_Indicador2( $CodID, $fec_dato,  $cod_estab,  $Nro_ninh,  $Nro_nin ,$user_name){
		if($this->con->conectarMYSQL()==true){
		 $SQL1 = "
			 update   tabindi_2 set 
							fec_dato = '$fec_dato',
 							user_name = '$user_name',
							cod_estab = '$cod_estab',
							cas_ane = 	$Nro_ninh, 
							nin_3 = $Nro_nin 
			 where  codtab1  = '$CodID'
			";
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}


	function f_Actualizar_Indicador2_1( $CodID, $fec_dato,  $cod_estab,  $Nro_ninh,  $Nro_nin ,$user_name){
		if($this->con->conectarMYSQL()==true){
		 $SQL1 = "
			 update   tabindi_2_1 set 
							fec_dato = '$fec_dato',
 							user_name = '$user_name',
							cod_estab = '$cod_estab',
							cas_ane = 	$Nro_ninh, 
							nin_3 = $Nro_nin 
			 where  codtab1  = '$CodID'
			";
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}



	function f_Actualizar_Indicador6( $CodID, $fec_dato,  $cod_estab,  $Nro_ninh,  $Nro_nin ,$user_name){
		if($this->con->conectarMYSQL()==true){
		 $SQL1 = "
			 update   tabindi_6 set 
							fec_dato = '$fec_dato',
 							user_name = '$user_name',
							cod_estab = '$cod_estab',
							Nro_muj_pap = 	$Nro_ninh, 
							Pob_fem_2013 = $Nro_nin 
			 where  codtab1  = '$CodID'
			";
		 return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	}

	function f_Actualizar_Indicador7( $CodID, $fec_dato,  $cod_estab,  $Nro_ninh,  $Nro_nin ,$user_name){
		if($this->con->conectarMYSQL()==true){
		 $SQL1 = "
			 update   tabindi_7 set 
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

	function f_Actualizar_Indicador8( $CodID, $fec_dato,  $cod_estab,  $Nro_ninh,  $Nro_nin ,$user_name){
		if($this->con->conectarMYSQL()==true){
		 $SQL1 = "
			 update   tabindi_8 set 
							fec_dato = '$fec_dato',
 							user_name = '$user_name',
							cod_estab = '$cod_estab',
							Nro_aten = 	$Nro_ninh, 
							horasmedico = $Nro_nin 
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
 


 

}
 
?>