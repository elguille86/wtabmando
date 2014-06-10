<?php session_start(); 
//include_once("Controller.class.php");  
include_once("ControllerSolicitudes.class.php");  

$obj_funciones = new cls_solicitudes;
 /*
if(empty($_SESSION['id_saccisis'])){ session_destroy();
	header("Location: ".$obj_funciones->mi_hosting()."salir.php" );
}	 */
ini_set('memory_limit', '256M'); 
$typec = $_POST['type']; 
$cod = $_POST['cQ']; 


 function Lista_Seguimiento($NroTicket){
  $imprime ="";
    $obj = new cls_solicitudes ;
    $resultado = $obj->ValidaNumero($NroTicket);
    if($resultado != "true"){
      return $resultado;
    }
    else
    {
    $result= $obj->DatosTicket($NroTicket);
    $cant = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if($cant>0){
      $Nro_Hruta =  $row['Nro_Hruta'];  
      $myear =  $row['myear'] ;
      $fec =  $row['fec'];
      if(($Nro_Hruta  != NULL)  || ($Nro_Hruta  != "")){

        $imprime =  "<p>Nro de Hoja de Ruta : $Nro_Hruta , Fecha de Ingreso : $fec </p>" ;
        $result = $obj->f_Seguimiento($myear , $Nro_Hruta  );
        $imprime = $imprime."<table width='100%' class='clsTabla' border='0' cellspacing='0' cellpadding='0'>
              <thead><tr>
                <td>Nro</td>
                <td>Origen</td>
                <td>Destino</td>
                <td>F.Recep</td>
                <td>F.Deriv</td>
                <td>Estado</td>
              </tr></thead>";$i=1;
        foreach ($result as $valor) {
          $procede  =  $valor[8]; $destino  =  $valor[10]; $estado  =  $valor[12];
          $fderiva  =  $valor[28]; $frecept  =  $valor[29];
          $imprime = $imprime. " <tr>
            <td>$i</td>
            <td>$procede</td>
            <td>$destino</td>
            <td>$frecept</td>
            <td>$fderiva</td>
            <td>$estado</td>
          </tr>";
          $i=$i+1;
        } 
        $imprime = $imprime.  "</table>";
        return  $imprime;
      }
      else 
      {
        return "<diV class='  ".$row['class']."'> Error insercion  </div>";
      } 
    }
    else
    {
      return "<diV class='info1  '> El ticket Nro :  <b>$NroTicket</b> , aun no se ingresa al sistema de tramite  </div>";
    }
  }    
  } 
 
	switch($typec)
	{
    case 'conc': echo Lista_Seguimiento($cod); break;
	} 
 
?>