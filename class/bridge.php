<?php session_start(); 
//include_once("Controller.class.php");  
include_once("ControllerSolicitudes.class.php");  

$obj_funciones = new cls_solicitudes;


// por mientras

if(empty($_SESSION['id_saccisis'])){ session_destroy();
	header("Location: ".$obj_funciones->mi_hosting()."salir.php" );
}	 

 
$h = new cls_solicitudes; 
$tipf       =   $_POST['tipf'] ;
$codicoQ    =  $h->ExistePost($_POST['cQ']);
$HrutaQ     =  $h->ExistePost($_POST['HrutaQ']);
$fdocQ      =  $h->ExistePost($_POST['fdocQ']);
$ValorcQ      =  $h->ExistePost($_POST['ValorcQ']);

  function RegistraEntrada($cod_id , $cod_usr, $Hro_Hruta , $Fec_Hruta  ){
    $obj = new cls_solicitudes ;
    $result= $obj->f_RecepDocumento($cod_id , $cod_usr, $Hro_Hruta , $Fec_Hruta);
    $cant = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result); 
    if($cant>0){
      $repuesta =  $row['respuesta'];  
      if(($repuesta  != NULL)  || ($repuesta  != "")){
        echo "<diV class='  ".$row['class']."'> $repuesta </div>";
      }
      else {
        echo "<diV class='  ".$row['class']."'> Error insercion  </div>";
      }
    }else
    {
      echo "<diV class='info1  '> Error al registrar los datos   </div>";
    }
  }


  function UpdateConfiguracion($codicoQ , $ValorcQ   ){
    $obj = new cls_solicitudes ;

    $codicoQ = $obj ->decrypt( $codicoQ, $obj ->mi_key());

    $ValorcQ  = str_replace(" ", "", $ValorcQ );
    $result= $obj->f_UpdateConfiguracion($codicoQ , $ValorcQ );
    if($result == true) {
        echo "<diV class='  exito1'> Actualizdo con exito </div>";
    }else
    {
      echo "<diV class='info1  '> Error al registrar los datos   </div>";
    }
  }

 


  function DatosTicket($NroTicket){
 
    $obj = new cls_solicitudes ;
    $resultado = $obj->ValidaNumero($NroTicket);
    if($resultado != "true"){
      return $resultado;
    }else
    {
    $result= $obj->DatosTicket($NroTicket);
    $cant = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if($cant>0){
      $_SESSION['Nro_Hruta'] =  $Nro_Hruta =  $row['Nro_Hruta'];  
      $_SESSION['myear'] = $myear =  $row['myear'] ;
      $fec =  $row['fec'];
      
      if(($Nro_Hruta  != NULL)  || ($Nro_Hruta  != "")){

        return "Nro de Hoja de Ruta : $Nro_Hruta , Fecha de Ingreso : $fec " ;
      }
      else {
        return "<diV class='  ".$row['class']."'> Error insercion  </div>";
      } 
    }else
    {
      return "<diV class='info1  '> El ticket Nro :  <b>$NroTicket</b> , aun no se ingresa al sistema de tramite  </div>";
    }
    }
 
  }


	switch($tipf)
	{
    case 'docReg': echo  RegistraEntrada($codicoQ  , $_SESSION['id_cod'] , $HrutaQ , $fdocQ  ); break;
    case 'DatoTicket': echo  DatosTicket($codicoQ  ); break;

    case 'RegConf': echo  UpdateConfiguracion($codicoQ , $ValorcQ  ); break;
    
	} 
   
 
?>
  	 