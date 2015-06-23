<?php session_start(); 
//include_once("Controller.class.php");  
 
if(empty($_SESSION['id_saccisis'])){ session_destroy();
	header("Location: ".$obj_funciones->mi_hosting()."salir.php" );
}	  
ini_set('memory_limit', '256M'); 
 
  function Lista_Indicador4(){
    include_once("Modelo.RegistroIndicador4.php");  
    $obj = new cls_RegistroIndicador4 ;
    $i =1;
    $result= $obj->f_Lista_Todos_IndicadorActivos();
    while($filas = mysqli_fetch_array($result)){
        $customers1[] = array(
          'nro' => $i,
          'codId' => $filas[4],
          'reg_fec' =>  $filas[0],
          'centro' => utf8_encode( $filas[1] ),
          'nro1' =>  $filas[2],
          'nro2' =>    $filas[3] ,
          'cod_estab' =>    $filas[5] ,
          'fec_reg' =>    $filas[6],
          'codind' =>    $filas[7],
          'periodo' =>    $filas[8],
          
          
          
        );    
        $i=$i+1;
      }   
    return json_encode($customers1 );
  } 

  function Lista_Indicador5(){
    include_once("Modelo.RegistroIndicador4.php");  
    $obj = new cls_RegistroIndicador4 ;
    $i =1;
    $result= $obj->f_Lista_Indicador5();
    while($filas = mysqli_fetch_array($result)){
        $customers1[] = array(
          'nro' => $i,
          'codId' => $filas[4],
          'reg_fec' =>  $filas[0],
          'centro' => utf8_encode( $filas[1] ),
          'nro1' =>  $filas[2],
          'nro2' =>    $filas[3] ,
          'cod_estab' =>    $filas[5] ,
          'fec_reg' =>    $filas[6]
          
        );    
        $i=$i+1;
      }   
    return json_encode($customers1 );
  } 



  function Lista_Registro_Usuarios(){
    include_once("Modelo.RegistroUsuarios.php");  
    $obj = new cls_RegistroUsuarios ;
    $i =1;
    $result= $obj->f_Lista_Usuarios();
    while($filas = mysqli_fetch_array($result)){
        $customers1[] = array(
          'nro' => $i,
          'codId' => $filas[0],
          'codesb' =>  $filas[1] ,
          'nomesb' =>   html_entity_decode ( $filas[2] ),
          'user' =>  $filas[3],
          'nomb' =>  html_entity_decode ($filas[4]) ,
          'nivel' =>    $filas[5] ,/*
          'moduest' =>    $filas[6] ,
          'modurrhh' =>    $filas[7] ,*/
          );    
        $i=$i+1;
      }   
    return json_encode($customers1 );
  }
  

function ListCentro( $codred){
  include_once("Controller.class.php");  
  if(trim($codred)=='--'){
    echo " <option value='--'>--Seleccionar--</option> ";
  }else{  
    echo " <option value='--'>--Seleccionar--</option> ";
    $obj1 = new cls_funciones;
    $respuesta =  $obj1->f_Lista_Centros_Detalle(trim($codred)); 

  
     while($fila = mysqli_fetch_array($respuesta)){
      echo " <option value='".$fila[0]."'>".utf8_encode( $fila[1])."</option>\n";
    }   
  } 
}

	switch($_GET['type'])
	{
    case '1': echo ListCentro($_GET['codred']); break;
    case '2': echo Lista_Indicador4(); break;
    case '3': echo Lista_Registro_Usuarios(); break;
    case '4': echo Lista_Indicador5(); break;
    

 
   
	} 
 
 
?>
  	 
