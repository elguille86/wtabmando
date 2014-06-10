<?php
function formatofecha($cad){
$dia=substr($cad, 0, 2);
$mes=substr($cad, 3, 2);
$ano=substr($cad, 6, 4);
$cad2 = ($ano."-".$mes."-".$dia);
return $cad2;
}


// DD-MM-YYYY
function formatofecha2($cad){
$ano=substr($cad, 0, 4);
$mes=substr($cad, 5, 2);
$dia=substr($cad, 8, 2);
$cad2 = ($dia."/".$mes."/".$ano);
return $cad2;
}


function MesPeriodo($cad){

switch ($cad)
{
case "01":
  $cad2= "01 ENE ";
  break;
case "02":
  $cad2= "02 FEB ";
  break;
case "03":
  $cad2= "03 MAR ";
  break;
case "04":
  $cad2= "04 ABR ";
  break;
case "05":
  $cad2= "05 MAY ";
  break;
case "06":
  $cad2= "06 JUN ";
  break;
case "07":
  $cad2= "07 JUL ";
  break;
case "08":
  $cad2= "08 AGO ";
  break;
case "09":
  $cad2= "09 SET ";
  break;
case "10":
  $cad2= "10 OCT ";
  break;
case "11":
  $cad2= "11 NOV ";
  break;
case "12":
  $cad2= "12 DIC ";
  break;  
default:
  echo "NO SABO";
}
return $cad2;
}


function agrega_cero($numero,$ceros){

if(strlen($numero)<$ceros) 
{	 

for($j=strlen($numero);$j<3;$j++) $numero="0".$numero;
}

return $numero;
}


function getMonthDays($Month, $Year) 
{ 
   //Si la extensión que mencioné está instalada, usamos esa. 
   if( is_callable("cal_days_in_month")) 
   { 
      return cal_days_in_month(CAL_GREGORIAN, $Month, $Year); 
   } 
   else 
   { 
      //Lo hacemos a mi manera. 
      return date("t",mktime(0,0,0,$Month,1,$Year)); 
   } 
} 
//Obtenemos la cantidad de días que tiene septiembre del 2008 

?>
