
<?php 
require_once("conexion.class.php");
include_once("MisFunciones.php"); 
class cls_Indicadores_PPR extends  LibreriaFuncinos {
//constructor 
	var $con;
	
	function cls_Indicadores_PPR(){
		$this->con = new DBManager;
	} 


	 
 	function f_lista_Indicadores_texto_ppr($codigo){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "select  compl , excel  from  tb_indicadores2 where Cod_Ind ='$codigo' ";

		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	} 
 

 	function f_lista_UltimaSemana_y_Mes(){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "select IFNULL(max(semana),1) as LaSemana ,IFNULL(max(mes),1) as ELMEsa , miano from  tbmeta_indppr ";

		return mysqli_query($this->con->conect_MySql ,$SQL1);
		}
	} 



 	function Data_Indicador_PPR( $NombreTb , $semana ,$miyera, $indicador ){
		if($this->con->conectarMYSQL()==true){
			 $SQL1 = "select desc_estab  ,  mes , miano , max(semana) as semana ,  meta_mes  , sum(Avance ) as Avence
				from  tbmeta_indppr a,  tb_establec b 
				where a.cod_estab = b.cod_estab and b.cod_estab in (select  cod_estab from  $NombreTb ) and semana <= $semana  and miano =$miyera
				and cod_ind ='$indicador' group by desc_estab ,mes ,miano   order by  b.cod_estab  ; ";
			return mysqli_query($this->con->conect_MySql ,$SQL1);
		
		}
	} 
 
 
 

}
 
?>