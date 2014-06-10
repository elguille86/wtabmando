<?php  
require_once('VariableGlobal.php'); 
$obje = new ConfiguracionGlobal ; 

$mi_bd = $obje->G_BaseDatos;
$mi_servidor = $obje->G_Servidor; 
$mi_usuario = $obje->G_Usuario;
$mi_password = $obje->G_Clave;
 
class DBManager extends  ConfiguracionGlobal{
var $conect_MySql;
var $BaseDatos;
var $Servidor;
var $Usuario;
var $Clave;

var $MSSQL_BaseDatos;
var $MSSQL_Servidor;
var $MSSQL_Usuario;
var $MSSQL_Clave;

	function DBManager(){
		$this->BaseDatos = $this->G_BaseDatos;
		$this->Servidor = $this->G_Servidor; 
		$this->Usuario = $this->G_Usuario;
		$this->Clave = $this->G_Clave;  

		$this->MSSQL_BaseDatos = $this->G_MSSQL_BaseDatos;
		$this->MSSQL_Servidor = $this->G_MSSQL_Servidor; 
		$this->MSSQL_Usuario = $this->G_MSSQL_Usuario;
		$this->MSSQL_Clave = $this->G_MSSQL_Clave;  
  	}
 
	function conectarMSSQL(){
		try
		{
			$db = new PDO("sqlsrv:Server=".$this->MSSQL_Servidor." ; Database =".$this->MSSQL_BaseDatos, $this->MSSQL_Usuario, $this->MSSQL_Clave);
        	$db->setAttribute(PDO::SQLSRV_ATTR_DIRECT_QUERY, true);
        	return $db ;			
		} catch( PDOException $e)
		{
			print  "<p><b> [:(] Error : </b> No puede conectarse con la base de datos.</p>\n";
        	exit();
		}
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



}



?>

 