<?php
define('FPDF_FONTPATH','font/'); // Устанавливаем путь к папке шрифтов
require_once($_SERVER['DOCUMENT_ROOT'].'/reports/m4_r/ufpdf/ufpdf.php'); //Подключаем класс FPDF
require_once($_SERVER['DOCUMENT_ROOT'].'/reports/verification_sheet/sql_script.php'); // Подключаем SQL запрос

$pdf = new UFPDF();
$pdf->Open();
// ---- Подключаем шрифты ----
$pdf->AddFont('TimesNewRomanPSMT','','times.php');
$pdf->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$pdf->AddFont('TimesNewRomanPS-BoldItalicMT','','timesbi.php');
// ---------------------------
//set_time_limit(150); // Лимит времени ожидания ответа от сервера (сек)
set_time_limit(600);

$sid = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = TL-SR-GDD1.kuazot.ru)(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = ITL)))";
//$sid = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = TL-SR-GDD1.kuazot.ru)(PORT = 1522)) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = ITLTEST)))";

if ($conn = OCILogon("xx_user", "xx_user2016", $sid, "UTF8"))
 {
  $pdf->SetMargins(6, 5); // Отступы
  $pdf->AddPage('A'); //Добавляем страничку в документ
  $pdf->SetFont('TimesNewRomanPS-BoldMT','',14);
  
  $sql_select = OCIParse($conn, "select xx_user.xx_pover_vedomost_history_s.nextval AS INVOICE_NUMBER from dual");
  OCIExecute($sql_select, OCI_DEFAULT);
  $row = oci_fetch_array($sql_select, OCI_ASSOC + OCI_RETURN_NULLS);
  $invoice_number = $row['INVOICE_NUMBER'];
  
  $dateNow = date("d.m.y H:i");
  
  $pdf->SetXY(20, 8);
  $pdf->Cell(170, 6, "Проверочная ведомость №" . $invoice_number . " от " . $dateNow . " на вывод", 0, 0, 'C', 0);
  $pdf->ln();
  $pdf->SetX(20);
  $pdf->Cell(170, 6, "железнодорожного состава на станцию «Химзаводская»", 0, 0, 'C', 0);
  $pdf->Image('logo_blue.jpg', 200, 5, 80);
  $pdf->ln(); $pdf->ln();
  
  $pdf->SetFont('TimesNewRomanPS-BoldMT','',10);
  $pdf->SetFillColor(159, 228, 255);
  
  $vHeight = 10; // Разрыв между строками
  
  $pdf->Cell(6, $vHeight, "№", 1, 0, 'C', 1);
  $pdf->Cell(18, $vHeight / 2, "Номер", "TLR", 0, 'C', 1);
  $pdf->Cell(26, $vHeight / 2, "Номер", "TLR", 0, 'C', 1);
  $pdf->Cell(16, $vHeight, "РПС", 1, 0, 'C', 1);
  $pdf->Cell(20, $vHeight / 2, "Состояние", "TLR", 0, 'C', 1);
  $pdf->Cell(55, $vHeight, "Номенклатура", 1, 0, 'C', 1);
  $pdf->Cell(13, $vHeight / 2, "Вес по", "TLR", 0, 'C', 1);
  $pdf->Cell(13, $vHeight / 2, "Вес по", "TLR", 0, 'C', 1);
  $pdf->Cell(13, $vHeight / 2, "Кол-во", "TLR", 0, 'C', 1);
  $pdf->Cell(20, $vHeight, "Тип ЗПУ", 1, 0, 'C', 1);
  $pdf->Cell(35, $vHeight, "Номер ЗПУ", 1, 0, 'C', 1);
  $pdf->Cell(25, $vHeight / 2, "Станция", "TLR", 0, 'C', 1);
  $pdf->Cell(25, $vHeight / 2, "Погрузил", "TLR", 0, 'C', 1);
  $pdf->ln();
  $pdf->SetX(12);
  $pdf->Cell(18, $vHeight / 2, "вагона", "BLR", 0, 'C', 1);
  $pdf->Cell(26, $vHeight / 2, "контейнера", "BLR", 0, 'C', 1);
  $pdf->SetX(72);
  $pdf->Cell(20, $vHeight / 2, "загруж.", "BLR", 0, 'C', 1);
  $pdf->SetX(147);
  $pdf->Cell(13, $vHeight / 2, "накл.", "BLR", 0, 'C', 1);
  $pdf->Cell(13, $vHeight / 2, "взвеш.", "BLR", 0, 'C', 1);
  $pdf->Cell(13, $vHeight / 2, "мест", "BLR", 0, 'C', 1);
  $pdf->SetX(241);
  $pdf->Cell(25, $vHeight / 2, "назначения", "BLR", 0, 'C', 1);
  $pdf->Cell(25, $vHeight / 2, "фактически", "BLR", 0, 'C', 1);
  $pdf->ln();
  
  $sql_select = OCIParse($conn, $sql_script);
  OCIExecute($sql_select, OCI_DEFAULT);
  
  $pdf->SetFont('TimesNewRomanPSMT','',9);
  
  $car_count = 0;
  $cont_count = 0;
  $vRowNumber = 0;
  while (OCIFetch($sql_select))
   {    
	if ($car_count == 0)
	 {$car_count = ociresult($sql_select, "CAR_NUMBER_COUNT");}
	
	if ($car_count == ociresult($sql_select, "CAR_NUMBER_COUNT"))
	 {$vRowNumber = $vRowNumber + 1;
	  if ($vRowNumber % 2 == 0) {$pdf->SetFillColor(255, 235, 202);} else {$pdf->SetFillColor(255, 255, 255);}
	  $pdf->SetX(6);
      $pdf->Cell(6, $vHeight * $car_count, "" . $vRowNumber . "", 1, 0, 'C', 1);
	  $pdf->Cell(18, $vHeight * $car_count, ociresult($sql_select, "CAR_NUMBER"), 1, 0, 'C', 1);
	  $pdf->SetX(56);
	  $pdf->Cell(16, $vHeight * $car_count, ociresult($sql_select, "CAR_KIND"), 1, 0, 'C', 1);
	  $pdf->SetX(160);
	  $pdf->Cell(13, $vHeight * $car_count, ociresult($sql_select, "WEIGHT_FREIGHT_SCALES"), 1, 0, 'C', 1);
	  
	  $PosY = $pdf->GetY();
	  $str = $pdf->GapStr(ociresult($sql_select, "TO_STATION_NAME"), 25);
	  $len = $pdf->MultiCellHeight(25, $vHeight * $car_count, wordwrap($str, 25, "\n"));
	  $pdf->SetX(241);
	  $pdf->MultiCell(25, ($vHeight * $car_count) / ($len / ($vHeight * $car_count)), wordwrap($str, 25, "\n"), 1, 'C', 1);
	  $pdf->SetY($PosY);
	 }
	
    if ($cont_count == 0)
	 {$cont_count = ociresult($sql_select, "CONT_NUMBER_COUNT");}
	
	if ($cont_count == ociresult($sql_select, "CONT_NUMBER_COUNT"))
	 {$pdf->SetX(30);
	  $pdf->Cell(26, $vHeight * $cont_count, ociresult($sql_select, "CONT_NUMBER"), 1, 0, 'C', 1);
	  $pdf->SetX(72);
	  $pdf->Cell(20, $vHeight * $cont_count, ociresult($sql_select, "LOADING_STATE"), 1, 0, 'C', 1);
	  $pdf->SetX(147);
	  $pdf->Cell(13, $vHeight * $cont_count, ociresult($sql_select, "WEIGHT_FREIGHT_INVOICE"), 1, 0, 'C', 1);
	  $pdf->SetX(186);
	  $pdf->Cell(20, $vHeight * $cont_count, ociresult($sql_select, "SPRUT_TYPE"), 1, 0, 'C', 1);
	  
	  $PosY = $pdf->GetY();
	  $str = ociresult($sql_select, "LOADING_USER");
	  $len = $pdf->MultiCellHeight(25, $vHeight * $cont_count, wordwrap($str, 25, "\n"));
	  $pdf->SetX(266);
	  $pdf->MultiCell(25, ($vHeight * $cont_count) / ($len / ($vHeight * $cont_count)), wordwrap($str, 25, "\n"), 1, 'C', 1);
	  $pdf->SetY($PosY);
	  
	  $pdf->SetFont('TimesNewRomanPSMT','',7);
	  $PosY = $pdf->GetY();
	  $str = ociresult($sql_select, "SPRUT_NAME");
	  $len = $pdf->MultiCellHeight(35, $vHeight * $cont_count, wordwrap($str, 35, "\n"));
	  $pdf->SetX(206);
	  $pdf->MultiCell(35, ($vHeight * $cont_count) / ($len / ($vHeight * $cont_count)), wordwrap($str, 35, "\n"), 1, 'C', 1);
	  $pdf->SetY($PosY);
	  $pdf->SetFont('TimesNewRomanPSMT','',9);
	 }
	
	$pdf->SetX(173);
	$pdf->Cell(13, $vHeight, ociresult($sql_select, "QUANTITY_PLACE"), 1, 0, 'C', 1);
	
	$pdf->SetFont('TimesNewRomanPSMT','',7);
	$str = ociresult($sql_select, "NOMENCLATURE_NAME");
	$len = $pdf->MultiCellHeight(55, $vHeight, wordwrap($str, 60, "\n"));
	$pdf->SetX(92);
	$pdf->MultiCell(55, $vHeight / ($len / $vHeight), wordwrap($str, 60, "\n"), 1, 'C', 1);
	$pdf->SetFont('TimesNewRomanPSMT','',9);
	
	$car_count = $car_count - 1;
	$cont_count = $cont_count - 1;
   }
  
  $pdf->SetFont('TimesNewRomanPS-BoldMT','',12);
  $pdf->Cell(0, 10, "Сформировал " . $user, 0, 0, 'L', 0);
  
  OCILogoff($conn);
  $FileName = 'Sheet_' . $invoice_number . '_' . date("d.m.y_H-i") . '.pdf';
  $pdf->Output($FileName, 'I'); // Вывод в браузер
  $pdf->Output($FileName, 'F'); // Сохранение на диск
  rename($FileName, "logs/" . $FileName); // Перемещение в папку логов
 }
else
 {
  $err = OCIError(); echo "Oracle Connect Error. " . $err[text];
 }
?>