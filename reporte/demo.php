<?php
include('../class/ConexionExcel.php'); 
$obj = new DBManagerExcel;

$f1 = $_GET['fec1'];
$f2 = $_GET['fec2'];

$result= $obj->ReporteAtenciones($f1  ,$f2); 


while($filas = mysqli_fetch_array($result) ){

		echo  utf8_decode($filas[0]);
		echo  utf8_decode($filas[1]);
       
}    
 
?>