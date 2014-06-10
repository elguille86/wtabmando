<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
include("class.phpmailer.php");
//include("class.smtp.php");
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
//$codTiket = $_GET['codt'];
$codTiket = '140001';
$mail             = new PHPMailer();
$body             =  $mail->getFile('Plantilla.php');
//$body             = str_replace("codigoticket",$codTiket,$body);
/*
$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "notificacionsistemadiresa@gmail.com";  // GMAIL username
$mail->Password   = "diresa159";            // GMAIL password
//$mail->AddReplyTo("webdesarrollo2010@gmail.com","First Last");
$mail->From       = "notificacionsistemadiresa@gmail.com";
$mail->FromName   = "DiresaCallao";
$mail->Subject    = "DiresaCallao Notificacion";*/
//$mail->Body       = "Hi,<br>This is the HTML BODY<br>";                      //HTML Body
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPAuth   = false;
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "correo.diresacallao.gob.pe";      // sets GMAIL as the SMTP server
$mail->Port       = 993;                   // set the SMTP port for the GMAIL server
$mail->Username   = "appdiresacallao@diresacallao.gob.pe";  // GMAIL username
$mail->Password   = "diresa";            // GMAIL password
//$mail->AddReplyTo("webdesarrollo2010@gmail.com","First Last");
$mail->From       = "appdiresacallao@diresacallao.gob.pe";
$mail->FromName   = "DiresaCallao";
$mail->Subject    = "DiresaCallao Notificacion";
//$mail->SMTPDebug = 2;
//$mail->WordWrap   = 50; // set word wrap
$mail->MsgHTML($body);


 include_once("../class/ControllerSolicitudes.class.php");  
    $obj = new cls_solicitudes ;
    $result= $obj->f_ListaCorreos();
    $respuesta = mysqli_fetch_array($result);
    $ListMail = explode(',', $respuesta[0]);	$I = 1;
    foreach ($ListMail as  $valor) {
    	$mail->AddAddress($valor, "Usuario".$I);
    	 //$mail->ClearAddresses();    	
        //echo $valor;
    	$I = $I+1;
    }
//$mail->AddAttachment("images/Diresalogo.png");             // attachment
$mail->IsHTML(true); // send as HTML
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Mensaje Enviado con Exito";
}

?>