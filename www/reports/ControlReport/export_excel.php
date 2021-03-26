<?php
	$root_directory = $_SERVER['DOCUMENT_ROOT'];
	$array01 = explode("/", $_POST['Line01']);
	$array02 = explode("/", $_POST['Line02']);
	$head = $_POST['Head'];
	$total = $_POST['Total'];
	
	// класс для работы с excel
	require_once($root_directory . '/libraryes/PHPExcel-1.8/Classes/PHPExcel.php');
	// класс для вывода данных в формате excel
	//require_once($root_directory . '/libraryes/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel5.php');
	
	$objPHPExcel = new PHPExcel();
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load('template.xlsx');
	
	$objPHPExcel->getActiveSheet()->setCellValue("A2", $head);
	$objPHPExcel->getActiveSheet()->setCellValue("C4", $total);
	
	$column = 21;
	$cell = 0;
	for ($i = 0; $i < count($array01) / $column; $i++) {
		for ($j = 0; $j < $column; $j++) {
			$objPHPExcel->getActiveSheet()->setCellValue(chr(68 + $j) . strval($i + 8), $array01[$cell]);
			$cell += 1;
		}
	}
	
	$column = 18;
	$cell = 0;
	for ($i = 0; $i < count($array02) / $column; $i++) {
		for ($j = 0; $j < $column; $j++) {
			$objPHPExcel->getActiveSheet()->setCellValue(chr(69 + $j) . strval($i + 72), $array02[$cell]);
			$cell += 1;
		}
	}
	
	// содержимое файла
	$FileName = 'ControlReport.xlsx';
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
	$objWriter->save($FileName);
	echo $FileName;
?>