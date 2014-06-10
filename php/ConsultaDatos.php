<?php
require_once('../class/ControllerFormSolic.class.php'); 

$h = new LibreriaFuncinos;

$NomrazQ 		=  $h->scape( $h->ExistePost( utf8_decode( $_POST['NomrazQ']) ) );
$rbtipo 		=  $h->ExistePost($_POST['rbQ']);
$nrodocQ 		=  $h->ExistePost($_POST['nrodocQ']);
$ubgeQ 			=  $h->ExistePost($_POST['ubgeQ']);
$inter 			=  $h->ExistePost($_POST['inter']);
$DirecionQ		=  $h->scape($h->ExistePost(utf8_decode($_POST['DirecionQ'])));
$emailQ			=  $h->scape($h->ExistePost(utf8_decode($_POST['emailQ'])));
$telef			=  $h->ExistePost($_POST['telef']);
$depend			=  $h->ExistePost($_POST['depend']);
$rbenteQ		=  $h->ExistePost($_POST['rbenteQ']); 
$observ			=  $h->scape($h->ExistePost(utf8_decode($_POST['observ']))); 
$solicitQ		=  $h->scape($h->ExistePost(utf8_decode($_POST['solicitQ']))); 

 
switch($_POST['tipf'])
{
	case 'misia': 
		GrabarSolicitud($NomrazQ , $rbtipo , $nrodocQ , $ubgeQ , $inter , $DirecionQ , $emailQ , $telef , $solicitQ, $depend , $rbenteQ , $observ );
	break; 

}


function GrabarSolicitud(
	$NomrazQ , $rbtipo , $nrodocQ , $ubgeQ , $inter , $DirecionQ , $emailQ , 
	$telef , $solicitQ,    $depend , $rbenteQ , $observ  )
{
	$obj  = new cls_formExterno;

	$resp_Query = $obj->f_InsertaSolicitud($NomrazQ, $rbtipo, $nrodocQ, $DirecionQ, $inter, $ubgeQ, $emailQ,
        $telef, $solicitQ, $depend, $rbenteQ, $observ);
 
     $row = mysqli_fetch_array($resp_Query); 
     $nrotiket =  $row['respuesta'];  


	if(($nrotiket  != NULL)  || ($nrotiket  != "")){
		error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
		include("class.phpmailer.php");
		//include("class.smtp.php");
		//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
		$codTiket = $nrotiket;
		$mail             = new PHPMailer();
		$body             =  $mail->getFile('Plantilla.php');
		$body             = str_replace("codigoticket",$codTiket,$body);
		$body             = str_replace("nombreticket",$NomrazQ,$body);
		
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "sistemadiresa@gmail.com";  // GMAIL username
		$mail->Password   = "diresa159";            // GMAIL password
		//$mail->AddReplyTo("webdesarrollo2010@gmail.com","First Last");
		$mail->From       = "sistemadiresa@gmail.com";
		$mail->FromName   = "DiresaCallao";
		$mail->Subject    = "DiresaCallao Notificacion";
		//$mail->Body       = "Hi,<br>This is the HTML BODY<br>";                      //HTML Body
		//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap   = 50; // set word wrap
		$mail->MsgHTML($body);

		require_once("../class/ControllerSolicitudes.class.php");  
		    $obj1 = new cls_solicitudes ;
		    $result= $obj1->f_ListaCorreos();
		   $MENSAJE1="";
		    
			$respuesta = mysqli_fetch_array($result);
			
			if( ($respuesta[0]  != NULL)  || ($respuesta[0]  !="") ) {
				$ListMail = explode(',', $respuesta[0]);	$I = 1;
				    foreach ($ListMail as  $valor) {
				    	//$mail->AddAddress($valor );
				    	$mail->AddAddress($valor, "Usuario".$I);
				    	 //$mail->ClearAddresses();    	
				        //echo $valor;
				    	$I = $I+1;
				    }
				 
				$mail->AddAttachment("images/Diresalogo.png");             // attachment
				$mail->IsHTML(true); // send as HTML
				if(!$mail->Send()) {
				  $MENSAJE1 = "Mailer Error: " . $mail->ErrorInfo;
				} else {
				  $MENSAJE1 = "Mensaje Enviado con Exito";
				}		    	
		    }

		echo "<diV class='info1 exito1'> Se ha Generado el Ticket Nro : $nrotiket , $MENSAJE1  </div>";
	}
	else {
		echo "<diV class='info1 error1'> Error  , $MENSAJE1   </div>";
	}

}

 
?>
