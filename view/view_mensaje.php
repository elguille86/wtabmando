<?php session_start();  ?>
<div class="<?php  echo $_SESSION['clsmensaje'];?>">
<?php
	echo $_SESSION['mensaje'];
	$findme   = 'Publica';
	$pos = strpos($_SESSION['mensaje'], $findme);
	if ($pos === false) {
	} else {
		if($_SESSION['clsmensaje']=='exito'){
			echo "<br/><b>Nota.-</b> Verifique que el archivo se encuentre publicado.";	
		}    
	}
	$_SESSION['mensaje']= NULL;
	$_SESSION['clsmensaje']= NULL;
	//print "<meta http-equiv=Refresh content=\"1 ; url=.\">";
?>
<a href="javascript:history.back(1)">Volver a la p&aacute;gina anterior</a>
</div>
