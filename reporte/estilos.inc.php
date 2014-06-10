<?php
$format =& $workbook->addFormat(array('Size' => 8,
                                      'Align' => 'center',
                                      'Color' => 'black',
                                      'Pattern' => 1,
                                      'FgColor' => 'white',
									  'Border' => '1'
									  ));
									  
$format2 =& $workbook->addFormat(array('Size' => 8,
                                      'Align' => 'LEFT',
                                      'Color' => 'BLACK',
									   'FgColor' => 'none',
                                      'Pattern' => 1,
									  'Border' => '1',
									  'Bottom'=>'1',
									  'Top'=>'1'
									  ));	
									  							
$format3 =& $workbook->addFormat(array('Size' => 8,
									  'FontFamily'=>'Tahoma',
                                      'Align' => 'center',
                                      'Color' => 'black',
                                      'Pattern' => 1,
                                      'FgColor' => '7',
									  'Border' => '1',
									  'Bold'=>'1',
									  'Bottom'=>'1',
									  'Top'=>'1',
									  'VAlign'=> 'vcenter',
									  'HAlign'=> 'center'										  
									  ));										  
$format4 =& $workbook->addFormat(array('Size' => 8,
                                      'Merge' => '2',
                                      'Color' => 'black',
                                      'FgColor' => 'none',
									));	
$format5 =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'Left',
                                      'Color' => 'Black',
                                      'Pattern' => '0',
                                      'Border' => '0',
									  'Bold'=>'1',
									  'Bottom'=>'0',
									  'Top'=>'0',
									  'VAlign'=> 'vcenter',
									  'HAlign'=> 'center'									  
									  ));		

$format51 =& $workbook->addFormat(array('Size' => 7,
                                      'Align' => 'center',
                                      'Color' => 'Black',
                                      'Pattern' => '0',
                                      'Border' => '0',
									  'Bold'=>'1',
									  'Bottom'=>'0',
									  'Top'=>'0',
									  'VAlign'=> 'vcenter',
									  'HAlign'=> 'vcenter'
									  								  
									  ));	
$format52 =& $workbook->addFormat(array('Size' => 9,
                                      'Align' => 'Left',
                                      'Color' => 'Black',
                                      'Pattern' => '0',
                                      'Border' => '0',
									  'Bold'=>'1',
									  'Bottom'=>'0',
									  'Top'=>'0',
									  'VAlign'=> 'vcenter',
									  'HAlign'=> 'center'									  
									  ));											  
$Cabecera =& $workbook->addFormat(array('Size' => 12,
  'FontFamily'=>'Tahoma',
                                      'Align' => 'CENTER',
									  'VAlign'=> 'vcenter',
                                      'Color' => 'Black',
                                      'Pattern' => '0',
                                      'Border' => '0',
									  'Bold'=>'1',
									  'Bottom'=>'0',
									  'Top'=>'0'
									  ));			

$Cabecera1 =& $workbook->addFormat(array('Size' => 9,
  'FontFamily'=>'Tahoma',
                                      'Align' => 'CENTER',
									  'VAlign'=> 'vcenter',
                                      'Color' => 'Black',
                                      'Pattern' => '0',
                                      'Border' => '0',
									  'Bold'=>'1',
									  'Bottom'=>'0',
									  'Top'=>'0'
									  ));	

$Cabecera_Bordes =& $workbook->addFormat(array('Size' => 8,
									  'FontFamily'=>'Tahoma',
                                      'Align' => 'center',
                                      'Color' => 'black',
                                      'Pattern' => 1,
                                      'FgColor' => '7',
									  'Border' => '1',
									  'Bold'=>'1',
									  'Bottom'=>'1',
									  'TextWrap'=>'1',
									  
									  'Top'=>'1',
									  'VAlign'=> 'vcenter',
									  'HAlign'=> 'center'										  
									  ));										  

$Resultados_Bordes =& $workbook->addFormat(array(
								      'Size' => 8,
									  'FontFamily'=>'Tahoma',
                                      'Align' => 'center',
                                      //'Pattern' => 1,
                                      'Border' => '1',
									  //'Bold'=>'1',
									  //'Bottom'=>'1',
									  'TextWrap'=>'1',
									  'FgColor' => 'White',
									  //'Top'=>'1',
									  'VAlign'=> 'vcenter',
									  'HAlign'=> 'center'										  
									  ));	

$Resultados_Bordes1 =& $workbook->addFormat(array(
								      'Size' => 8,
									  'FontFamily'=>'Tahoma',
                                      'Align' => 'center',
                                      //'Pattern' => 1,
                                      'Border' => '1',
									  //'Bold'=>'1',
									  //'Bottom'=>'1',
									  'TextWrap'=>'1',
									  'Locked'=>1,
									  //'Top'=>'1',
									  'VAlign'=> 'vcenter',
									  'HAlign'=> 'center'										  
									  ));										  
									  
$Resultados_Bordes_Izq =& $workbook->addFormat(array(
								      'Size' => 8,
									  'FontFamily'=>'Tahoma',
									  'Border' => '1',
                                      'Align' => 'LEFT',
                                      'Pattern' => 1,
                                      'FgColor' => 'White',
									  'Bottom'=>'1',
									  'TextWrap'=>'1',
									  'Locked'=>1,
									  'Top'=>'1',
									  'VAlign'=> 'vcenter',
									  //'HAlign'=> 'center'										  
									  ));										  
									  
									  
$regularFormat0 =& $workbook->addFormat(array('size'=>9,
  'valign'=>'center',
  'VAlign'=> 'vcenter',
  //'FontFamily'=>'Tahoma',
  'FontFamily'=>'Tahoma',
  'Locked'=>'1',
  'Border' => '0'
  ));									  
$regularFormat =& $workbook->addFormat(array('size'=>9,
  'align'=>'left',
  'halign'=>'center',
  //'FontFamily'=>'Tahoma',
  'FontFamily'=>'Tahoma',
  'VAlign'=> 'vcenter',  
  'Border' => '0',
  'Locked' => 1
  ));		

$PieNota =& $workbook->addFormat(array(
	'size'=>8,
	'align'=>'Left',
	'halign'=>'Left',
	//'FontFamily'=>'Tahoma',
	'FontFamily'=>'Tahoma',
	'VAlign'=> 'Left',  
	'Bold'=>'1',	
	'Border' => '0'
  ));	  
  
  
$columnTitleFormat =& $workbook->addFormat(array(
  'bold'=>1,
  'FontFamily'=>'Calibri',
  'FgColor' => 7,
  'top'=>1,
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'center',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>7));  

$columnTitleFormatDerecha =& $workbook->addFormat(array(
  'bold'=>1,
  'FontFamily'=>'Calibri',
  'FgColor' => 7,
  'top'=>1,
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'right',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>7));  

  
$columnTitleFormat2 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => 7,
  'top'=>1,
  'FontFamily'=>'Calibri',  
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'center',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>7));  
  


$FormatoRegular0 =& $workbook->addFormat(array('size'=>8,
  'valign'=>'center',
  'VAlign'=> 'vcenter',
  'FontFamily'=>'Tahoma',
  'Border' => '0'
  ));									  
$FormatoRegular =& $workbook->addFormat(array('size'=>8,
  'align'=>'left',
  'halign'=>'center',
  'FontFamily'=>'Tahoma',
  'VAlign'=> 'vcenter',  
  'Border' => '0'
  ));		
  
$PadronCabecera =& $workbook->addFormat(array('Size' => 11,
									  'FontFamily'=>'Calibri',
                                      'HAlign' => 'HCENTER',
									  'VAlign'=> 'vcenter',
                                      'Color' => '0',
                                      //'Pattern' => '18',
									  
									  'FgColor' => 7,
                                      'Border' => '5',
									  'Bold'=>'1',
									  'Bottom'=>'5',
									  'Top'=>'5',
									  'Left'=>'0',
									  'right'=>'0',
									   'BorderColor'=>'gray',
));	  


$columnTitleFormat_1 =& $workbook->addFormat(array(
  'bold'=>0,
'FgColor' => '15',
  //'Color' => '0',
  //'BgColor' => '0',
  'Border' => '2',
  'BorderColor'=>'21',
  //'Pattern' => '18',
  'top'=>1,
  'FontFamily'=>'Calibri',  
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'center',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>7)); 
  
$columnTitleFormat_2 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => 2,
  'top'=>1,
  'FontFamily'=>'Calibri',  
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'center',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>7));   

$columnTitleFormat_3 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => 3,
  'top'=>1,
  'FontFamily'=>'Calibri',  
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'center',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>7));   
  
$Texto_Color_1 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_VERDE_OLIVA,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));     
  
$Texto_Color_2 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_ROJO2,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  


$Texto_Color_3 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_ANARAJANDO_CLARO0,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  


$Texto_Color_4 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_AZUL_CLARO,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  

    



$Texto_Color_5 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_GRIS,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  




$Texto_Color_6 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_ROSA_CLARO,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  



$Texto_Color_7 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_VERDE2,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  




$Texto_Color_8 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_ANARANJADO_CLARO2,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  

$Texto_Color_9 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_AZUL_CIELO,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  

$Texto_Color_10 =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_AZUL_HIELO,
  'top'=>1,
  'FontFamily'=>'Tahoma',
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'Left',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));   

$Texto_Color_Cabecera =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_CABECERA,
  'Color'   => 'white',
  'bold'=>1,
  'FontFamily'=>'Arial Narrow',
  'top'=>1,
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'center',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>7));  


  $Texto_Color_Total =& $workbook->addFormat(array(
 // 'bold'=>1,
  'FgColor' => CUSTOM_CABECERA,
  'Color'   => 'white',
  'bold'=>1,
  'FontFamily'=>'Tahoma',
  'top'=>1,
  'border'=>1,
  'bottom'=>1 ,
  'align'=>'center',
  'VAlign'=> 'vcenter',
  'TextWrap'=>'1',
  'size'=>8));  

$Texto_Resultado_Grilla_Centrado =& $workbook->addFormat(array(
  'size'=>8,
  'align'=>'left',
  'halign'=>'center',
  'FontFamily'=>'Tahoma',
  'VAlign'=> 'vcenter',  
  'Border' => '1',
  'Locked ' => 1
  ));	

$Resultados_Sin_Bordes_Derecha =& $workbook->addFormat(array(
								      'Size' => 9,
									  'FontFamily'=>'Tahoma',
                                      'Align' => 'right',
                                      //'Pattern' => 1,
                                      'Border' => '0',
									  //'Bold'=>'1',
									  //'Bottom'=>'1',
									  'TextWrap'=>'1',
									  
									  //'Top'=>'1',
									  'VAlign'=> 'vcenter',
									  //'HAlign'=> 'center'										  
									  ));		  
  
?>