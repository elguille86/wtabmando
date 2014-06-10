<?php  
require_once('VariableGlobal.php'); 
$obje = new ConfiguracionGlobal ; 

$mi_bd = $obje->G_BaseDatos;
$mi_servidor = $obje->G_Servidor; 
$mi_usuario = $obje->G_Usuario;
$mi_password = $obje->G_Clave;
 
class DBManagerExcel extends  ConfiguracionGlobal{
var $conect_MySql;
var $BaseDatos;
var $Servidor;
var $Usuario;
var $Clave;

var $MSSQL_BaseDatos;
var $MSSQL_Servidor;
var $MSSQL_Usuario;
var $MSSQL_Clave;

	function DBManagerExcel(){
		$this->BaseDatos = $this->G_BaseDatos;
		$this->Servidor = $this->G_Servidor; 
		$this->Usuario = $this->G_Usuario;
		$this->Clave = $this->G_Clave;  
  	}
 
	function conectarMYSQL() {
		$con =   mysqli_connect($this->Servidor,$this->Usuario,$this->Clave,$this->BaseDatos ) ;	
 		if (mysqli_connect_errno()) {
    		printf("[:(] Error al conectar a la base de datos : %s\n", mysqli_connect_error());
	    	exit();
		}
		$this->conect_MySql=$con;
		return true; 
	}	

 	function Reporte_Indicado_6( $myear ){
		if($this->conectarMYSQL()==true){
			$SQL1 = "call ReporteIndicado6 ('$myear'); ";
		 return  mysqli_query($this->conect_MySql ,$SQL1);
		 } 
 	 }

 

}



?>
