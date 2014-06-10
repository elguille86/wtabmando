
<?php 
require_once("conexion.class.php");
include_once("MisFunciones.php"); 
class cls_Indicadores extends  LibreriaFuncinos {
//constructor 
	var $con;
	
	function cls_Indicadores(){
		$this->con = new DBManager;
	} 

	 
 	function Reporte_Indicado_6( $myear ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "call ReporteIndicado6 ('$myear'); ";
		 return  mysqli_query($this->con->conect_MySql ,$SQL1);
		 } 
 	 }
	 
 	function Reporte_Indicado_8( $myear ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "call ReporteIndicado8 ('$myear'); ";
		 return  mysqli_query($this->con->conect_MySql ,$SQL1);
		 } 
 	 }

 	function Reporte_Indicado_4( $myear ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "call ReporteIndicado4 ('$myear'); ";
		 return  mysqli_query($this->con->conect_MySql ,$SQL1);
		 } 
 	 }

 	function desrip_ind( $cod ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "select * from `tb_indicadores` where codind = $cod  ";
		 return  mysqli_query($this->con->conect_MySql ,$SQL1);
		 } 
 	 }
 	function Reporte_Indicado_5( $myear ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "call ReporteIndicado5 ('$myear'); ";
		 return  mysqli_query($this->con->conect_MySql ,$SQL1);
		 } 
 	 }

 	function Reporte_Indicado_7( $myear ){
		if($this->con->conectarMYSQL()==true){
			$SQL1 = "call ReporteIndicado7 ('$myear'); ";
		 return  mysqli_query($this->con->conect_MySql ,$SQL1);
		 } 
 	 }

}
 
?>