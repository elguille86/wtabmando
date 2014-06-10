<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
ini_set('post_max_size','200M');
ini_set('upload_max_filesize','200M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');


// Define a destination
$targetFolder = '../../documentos/imagenes/'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'] ;
	//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	//$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	$targetFile = $targetFolder.$_GET['cod'].$_FILES['Filedata']['name'] ;
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';

	} else {
		echo 'Invalid file type.';
	}
}
?>