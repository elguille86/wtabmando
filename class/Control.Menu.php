<?php class cls_principal{
	function __construct(){
		if(isset($_GET['opm'])){
			$obj = new cls_funciones;
			$tabla = $obj->f_Menu_Sistema($_SESSION['id_saccisis']);
			$error = true;
			switch($_GET['opm']){
				case 'MsgText': $error = false;$this->Mensaje();break;
				case 'ireports':  
 					while($filas = mysqli_fetch_array($tabla)){
						if($filas[3]=='ireports'){
							$error = false;
							$this->viewReporeteConsolidad();break;
						}
					}
					break;
			 
				case 'ppr':  
 					while($filas = mysqli_fetch_array($tabla)){
						if($filas[3]=='ppr'){
							$error = false;
							$this->viewReporeteppr();break;
						}
					}
					break;
			 


				case 'usu':  
 					while($filas = mysqli_fetch_array($tabla)){
						if($filas[3]=='usu'){
							$error = false;
							$this->viewUsuarios();break;
						}
					}
					break;
				case 'Indi4':  
 					while($filas = mysqli_fetch_array($tabla)){
						if($filas[3]=='Indi4'){
							$error = false;
							$this->view_Indicador4();break;
						}
					}
					break; 
				case 'Indi5':  
 					while($filas = mysqli_fetch_array($tabla)){
						if($filas[3]=='Indi5'){
							$error = false;
							$this->view_Indicador5();break;
						}
					}
					break; 
				default:
					$error = false;
					$this->Error404();break; 
				}
				if($error){ $this->ErrorAcceso(); } 
 
				
		}else{
			$this->viewReporeteConsolidad();
			
			//include('view/view_bienvenida.php');			
		}
	}


	function ErrorAcceso(){
		//echo "<diV id='IdContruccion'><center>No Existe la Pagina Solicitada</center></div>";
		include('view/view_ErrorAcceso.php');
	}


 
	function viewUsuarios()
	{
	 	include('view/view_Usuarios.php');
	}

 	function view_Indicador4()
	{
	 	include('view/view_Indicador4.php');
	}

 	function view_Indicador5()
	{
	 	include('view/view_Indicador5.php');
	}
 
	function viewReporeteConsolidad()
	{
	 	include('view/view_ReporteConsolidado.php');
	}
 
 
	function Error404(){
		include('view/view_Error404.php');
		
	} 

	function Mensaje(){
		include('view/view_mensaje.php');
	}



	function viewReporeteppr()
	{
	 	include('view/view_ReporteRRP.php');
	}

}
?> 