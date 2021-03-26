<?php
define('FPDF_FONTPATH','font/'); //  Устанавливаем путь к папке шрифтов
require_once($_SERVER['DOCUMENT_ROOT'].'/reports/m4_r/ufpdf/ufpdf.php'); // Подключаем класс FPDF
require_once($_SERVER['DOCUMENT_ROOT'].'/reports/invoice_gu_27_vc/sql_script.php'); // Подключаем SQL запрос

$pdf = new UFPDF();
$pdf->Open();
// ---- Подключаем шрифты ----
$pdf->AddFont('TimesNewRomanPSMT','','times.php');
$pdf->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$pdf->AddFont('TimesNewRomanPS-BoldItalicMT','','timesbi.php');
// ---------------------------
set_time_limit(100); // Лимит времени ожидания ответа от сервера (сек)

$sid="(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = TL-SR-GDD1.kuazot.ru)(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = ITL)))";

if ($conn = OCILogon("xx_user", "xx_user2016", $sid))
 {
  $sql_inv = OCIParse($conn, $sql_script_inv);
  OCIExecute($sql_inv, OCI_DEFAULT);
  
  $tLength = 4; // Верхний отступ
  $sFontT = 10; // Размер шрифта
  $wLine = 5; // Разрыв между строками
  $vBorder = 0; // Видимость границ ячеек (0/1)
  $pdf->SetLineWidth(0.5); // Толщина линий/границ (мм)
  
  $pdf->SetTopMargin($tLength);
  while (OCIFetch($sql_inv))
   {
	$pdf->AddPage('P'); //Добавляем страничку в документ
    $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->MultiCell(130, 3, "\nОсобые отметки: " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "UNIQUE_NUMBER")) . " " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_SCD_NUMBER")), $vBorder, 'L');
	$pdf->SetXY(140, $tLength);
    $pdf->SetFont('TimesNewRomanPSMT','',8);
	$pdf->MultiCell(48, 3, "ГУ-27у-ВЦ (учет по ГУ-27)\nУтверждена ОАО «РЖД» в 2004г.", $vBorder, 'L');
	$pdf->SetXY(188, $tLength);
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',8);
	$pdf->Cell(12, 6, "Лист 1", $vBorder, 0, 'R', 0);
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->ln();
	if (ociresult($sql_inv, "CF_SPC_DESC") != '') {$pdf->MultiCell(0, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_SPC_DESC")), 158, "\n"), $vBorder, 'L');}
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	if (ociresult($sql_inv, "ROUTE_DESC") != '') {$pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "ROUTE_DESC")), $vBorder, 0, 'L', 0); $pdf->ln();}
	if (ociresult($sql_inv, "CLAIM_DESC") != '') {$pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CLAIM_DESC")), $vBorder, 0, 'L', 0); $pdf->ln();}
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->Cell(35, $wLine, "Перевозчик", $vBorder, 0, 'L', 0);
	$pdf->ln(); $pdf->Cell(35, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "RAILWAY_NAME")), $vBorder, 0, 'L', 0);
	$pdf->Cell(0, $wLine, "ОРИГИНАЛ ТРАНСПОРТНОЙ ЖЕЛЕЗНОДОРОЖНОЙ НАКЛАДНОЙ " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "INV_NUMBER")), $vBorder, 0, 'C', 0);
	$pdf->ln(); $pdf->SetX(45);
	$pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TYPE_NAME")), $vBorder, 0, 'C', 0);
	$pdf->ln(); $pdf->SetX(45);
	$pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DISP_KIND_NAME")), $vBorder, 0, 'C', 0);
	$pdf->ln(); $pdf->Cell(0, $wLine, "", $vBorder, 0, 'L', 0);
	$pdf->ln(); $pdf->Cell(0, $wLine, "Срок доставки истекает " . ociresult($sql_inv, "DATE_EXPIRE"), $vBorder, 0, 'L', 0);
	$pdf->ln(); $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "SEND_SPEED_NAME")), $vBorder, 0, 'L', 0);
	$pdf->ln(); $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CARRIER_NAME")), $vBorder, 0, 'L', 0);
	
	// ---------- ЛЕВАЯ ЧАСТЬ "ШАПКИ" -------------
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->ln(); 
	$PosYR = $pdf->GetY();
	$pdf->Cell(75, $wLine, "Станция отправления", $vBorder, 0, 'L', 0);
	$pdf->Cell(20, $wLine, "Код", $vBorder, 0, 'L', 0);
	$vAdd1 = $pdf->GetY();
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->ln(); $pdf->Cell(75, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FROM_STATION_NAME")), $vBorder, 0, 'L', 0);
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->Cell(20, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FROM_STATION_CODE")), $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->Cell(95, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FROM_STATION_RAILWAY_NAME")), $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->Cell(75, $wLine, "Грузоотправитель", $vBorder, 0, 'L', 0);
	$pdf->Cell(20, $wLine, "Код", $vBorder, 0, 'L', 0);
	$pdf->ln();
	$PosY = $pdf->GetY();
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "SENDER_NAME")), 65);
	$pdf->MultiCell(75, $wLine, wordwrap($str, 60, "\n"), $vBorder, 'L');
	$PosYadd = $pdf->GetY();
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->SetXY(85, $PosY);
	$pdf->Cell(20, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "SENDER_OKPO")), $vBorder, 0, 'L', 0);
	$pdf->SetXY(10, $PosYadd);
	$pdf->Cell(95, $wLine, "Почтовый адрес грузоотправителя", $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	//$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "SENDER_ADDRESS")), 85);
	$pdf->MultiCell(95, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "SENDER_ADDRESS")), 72, "\n"), $vBorder, 'L');
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->Cell(75, $wLine, "Плательщик", $vBorder, 0, 'L', 0);
    $pdf->Cell(20, $wLine, "Код", $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$PosY = $pdf->GetY();
	//$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_PAYER_NAME")), 65);
	$pdf->MultiCell(75, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_PAYER_NAME")), 60, "\n"), $vBorder, 'L');
	$PosYmaxL = $pdf->GetY();
	$pdf->SetXY(85, $PosY);
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
    $pdf->Cell(20, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_PAYER_CODE")), $vBorder, 0, 'L', 0);
	
	// ---------- ПРАВАЯ ЧАСТЬ "ШАПКИ" -------------
	$pdf->SetXY(105, $PosYR);
	$pdf->Cell(75, $wLine, "Станция назначения", $vBorder, 0, 'L', 0);
	$pdf->Cell(0, $wLine, "Код", $vBorder, 0, 'L', 0);
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->ln(); $pdf->SetX(105);
	$pdf->Cell(75, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TO_STATION_NAME")), $vBorder, 0, 'L', 0);
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TO_STATION_CODE")), $vBorder, 0, 'L', 0);
	$pdf->ln(); $pdf->SetX(105);
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TO_STATION_RAILWAY_NAME")), $vBorder, 0, 'L', 0);
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	if (ociresult($sql_inv, "TO_LOAD_WAY") != '') {$pdf->ln(); $pdf->SetX(105); $pdf->Cell(0, $wLine, "Подача на подъездной путь", $vBorder, 0, 'L', 0);}
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	if (ociresult($sql_inv, "TO_LOAD_WAY") != '') {$pdf->ln(); $pdf->SetX(105); $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TO_LOAD_WAY")), $vBorder, 0, 'L', 0);}
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->ln(); $pdf->SetX(105);
	$pdf->Cell(75, $wLine, "Грузополучатель", $vBorder, 0, 'L', 0);
	$pdf->Cell(0, $wLine, "Код", $vBorder, 0, 'L', 0);
	$pdf->ln(); $pdf->SetX(105);
	$PosY = $pdf->GetY();
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "RECIP_NAME")), 65);
	$pdf->MultiCell(75, $wLine, wordwrap($str, 60, "\n"), $vBorder, 'L');
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$PosYadd = $pdf->GetY();
	$pdf->SetXY(180, $PosY);
	$pdf->Cell(20, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "RECIP_OKPO")), $vBorder, 0, 'L', 0);
	$pdf->ln(); $pdf->SetX(105);
	$pdf->SetXY(105, $PosYadd);
	$pdf->Cell(0, $wLine, "Почтовый адрес грузополучателя", $vBorder, 0, 'L', 0);
    $pdf->ln(); $pdf->SetX(105);
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	//$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "RECIP_ADDRESS")), 85);
	$pdf->MultiCell(95, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "RECIP_ADDRESS")), 72, "\n"), $vBorder, 'L');
	$pdf->SetX(105);
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->Cell(75, $wLine, "Плательщик", $vBorder, 0, 'L', 0);
	$pdf->Cell(0, $wLine, "Код", $vBorder, 0, 'L', 0);
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
    $pdf->ln(); $pdf->SetX(105);
	$PosY = $pdf->GetY();
	//$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_PAYER_NAME_2")), 65);
	$pdf->MultiCell(75, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_PAYER_NAME_2")), 60, "\n"), $vBorder, 'L');
	$PosYmaxR = $pdf->GetY();
	$pdf->SetXY(180, $PosY);
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_PAYER_CODE_2")), $vBorder, 0, 'L', 0);
	
	//------------- СВЕДЕНИЯ О ГРУЗЕ ---------------
	if ($PosYmaxL > $PosYmaxR) 
	 {$pdf->SetXY(10, $PosYmaxL);
	  $pdf->Line(105, $vAdd1, 105, $PosYmaxL);
	  $pdf->Line(10, $PosYmaxL, 200, $PosYmaxL);}
	else
	 {$pdf->SetXY(10, $PosYmaxR);
	  $pdf->Line(105, $vAdd1, 105, $PosYmaxR);
	  $pdf->Line(10, $PosYmaxR, 200, $PosYmaxR);}
	
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->Cell(0, $wLine, "СВЕДЕНИЯ О ГРУЗЕ", $vBorder, 0, 'C', 0);
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
    $pdf->ln();
	$pdf->Cell(118, $wLine, "Наименование", $vBorder, 0, 'L', 0);
	$pdf->Cell(18, $wLine, "Код", $vBorder, 0, 'C', 0);	
	$pdf->Cell(18, $wLine, "Упак.", $vBorder, 0, 'C', 0);	
	$pdf->Cell(18, $wLine, "Кол. мест", $vBorder, 0, 'C', 0);	
	$pdf->Cell(18, $wLine, "Масса, кг.", $vBorder, 0, 'C', 0);	
    $pdf->ln();
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$PosY = $pdf->GetY();
	$pdf->MultiCell(118, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_FREIGHT_INFO")), 93, "\n"), $vBorder, 'L');
	$PosYadd = $pdf->GetY();
	$pdf->SetXY(128, $PosY);
	$pdf->Cell(18, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FREIGHT_GNG_CODE")), $vBorder, 0, 'C', 0);
	$pdf->ln(); $pdf->SetX(128);
	$pdf->Cell(18, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FREIGHT_CODE_NAME")), $vBorder, 0, 'C', 0);
	$pdf->SetXY(146, $pdf->GetY() - $wLine);
	$pdf->Cell(18, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FREIGHT_PACKAGE_TYPE")), $vBorder, 0, 'C', 0);
	$pdf->Cell(18, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FREIGHT_PACKAGE_COUNT")), $vBorder, 0, 'C', 0);
	$pdf->Cell(18, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FREIGHT_REAL_WEIGHT")), $vBorder, 0, 'C', 0);
	
	if (ociresult($sql_inv, "FREIGHT_ADDITIONAL") != '')
	 {$pdf->SetXY(15, $PosYadd);
	  $PosY = $pdf->GetY();
   	  $pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	  $pdf->MultiCell(113, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FREIGHT_ADDITIONAL")), 103, "\n"), $vBorder, 'L');
	  $PosYadd = $pdf->GetY();
	  $pdf->SetXY(128, $PosY);}
	
	$pdf->SetY($PosYadd);
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	if (ociresult($sql_inv, "CF_DANGER_ADDITIONAL") != '') {$pdf->MultiCell(0, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_DANGER_ADDITIONAL")), 175, "\n"), $vBorder, 'L');}
	if (ociresult($sql_inv, "CF_PRIOR_CODE") != '') {$pdf->MultiCell(0, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_PRIOR_CODE")), 175, "\n"), $vBorder, 'L');}
	if (ociresult($sql_inv, "OWN_RNT_INFO_1") != '') {$pdf->MultiCell(0, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "OWN_RNT_INFO_1")), 175, "\n"), $vBorder, 'L');}
	if (ociresult($sql_inv, "OWN_RNT_INFO_2") != '') {$pdf->MultiCell(0, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "OWN_RNT_INFO_2")), 175, "\n"), $vBorder, 'L');}
	
	if (iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FREIGHT_REAL_WEIGHT")) > 0)
	 {
      if (ociresult($sql_inv, "TTL_WEIGHT_IN_STRING") != '') 
	   {$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	    $pdf->Cell(40, $wLine, "Итого масса (прописью): ", $vBorder, 0, 'L', 0);
	    $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	    $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TTL_WEIGHT_IN_STRING")), $vBorder, 0, 'L', 0);
		$pdf->ln();}
	
	  if (ociresult($sql_inv, "TTL_PACKCOUNT_IN_STRING") != '')
	   {$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	    $pdf->Cell(40, $wLine, "Итого мест (прописью): ", $vBorder, 0, 'L', 0);
	    $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	    $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TTL_PACKCOUNT_IN_STRING")), $vBorder, 0, 'L', 0);
		$pdf->ln();}
	
	  $pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	  $pdf->Cell(31, $wLine, "Масса определена: ", $vBorder, 0, 'L', 0);
	  $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	  $pdf->Cell(38, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "SCALE_PERSON_NAME")), $vBorder, 0, 'L', 0);
	  $pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	  $pdf->Cell(44, $wLine, "Способ определения массы: ", $vBorder, 0, 'L', 0);
	  $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	  $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "SCALE_TYPE_NAME")), $vBorder, 0, 'L', 0);
      $pdf->ln();
	  $pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
  	  $pdf->Cell(46, $wLine, "Погрузка вагона средствами: ", $vBorder, 0, 'L', 0);
	  $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	  $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "LOAD_AS_SETS_NAME")), $vBorder, 0, 'L', 0);
	  $pdf->ln();
	 }
	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	
	//---------- СВЕДЕНИЯ О ГРУЗЕ (НИЖНЯЯ ЧАСТЬ) -----------
	if (ociresult($sql_inv, "CLS_NAME_1") != '') {$pdf->MultiCell(0, $wLine, wordwrap(iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CLS_NAME_1")), 140, "\n"), $vBorder, 'L');}
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	
	if (ociresult($sql_inv, "RESP_PERSON_1") != '')
	 {$pdf->Cell(0, $wLine, "За правильность внесенных в накладную сведений отвечаю", $vBorder, 0, 'L', 0); $pdf->ln();
	  $pdf->Cell(32, $wLine, "Грузоотправитель: ", $vBorder, 0, 'L', 0);
	  $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	  $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "RESP_PERSON_1")), $vBorder, 0, 'L', 0);
	  $pdf->ln();}
	
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	if (ociresult($sql_inv, "CF_DEP_NOTMDOC") != '') 
	 {$pdf->MultiCell(0, $wLine, wordwrap("Груз размещен и закреплен согласно " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_DEP_NOTMDOC")), 195, "\n"), $vBorder, 'L');}
	
	if (ociresult($sql_inv, "DEPL_PERSON") != '')
	 {$pdf->Cell(32, $wLine, "Грузоотправитель: ", $vBorder, 0, 'L', 0);
	  $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	  $pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DEPL_PERSON")), $vBorder, 0, 'L', 0); $pdf->ln();}
	
	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	
	//---------- ТАРИФНЫЕ ОТМЕТКИ -----------
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->Cell(110, $wLine, "ТАРИФНЫЕ ОТМЕТКИ: Коды " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TARIF_CODE")), $vBorder, 0, 'L', 0);
	$pdf->Cell(0, $wLine, "Пр. зам. ваг.", $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->Cell(65, $wLine, "Схема " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_D_SCHEME")), $vBorder, 0, 'R', 0);
	$pdf->Cell(40, $wLine, "Коэф. тар. " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "D_TARIF_COEF")), $vBorder, 0, 'R', 0);
	$pdf->Cell(25, $wLine, "Вид отпр. ", $vBorder, 0, 'R', 0);
	$pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
	$pdf->Cell(22, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "SENDKIND_SHORT_NAME")), $vBorder, 0, 'L', 0);
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->Cell(0, $wLine, "Расст. " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "D_MIN_WAY")), $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->Cell(32, $wLine, "Скидка: " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "D_REST_TARIF_PERCENT")), $vBorder, 0, 'L', 0);
	$pdf->Cell(70, $wLine, "Исключительный тариф " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "IX_TARIF_CODE")), $vBorder, 0, 'L', 0);
	$pdf->Cell(0, $wLine, "Класс " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "D_FREIGHT_TARIF_CLASS")), $vBorder, 0, 'L', 0);
    $pdf->ln(); $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	
	//---------- СВЕДЕНИЯ О ВАГОНЕ -----------
	$CountCar = ociresult($sql_inv, "COUNT_CAR");
	
    if ($CountCar > 0)
     {
      $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
      $pdf->Cell(100, $wLine, "СВЕДЕНИЯ О ВАГОНЕ:", $vBorder, 0, 'L', 0);
      $pdf->Cell(0, $wLine, "ПРОВОЗНАЯ ПЛАТА, РУБ. КОП.", $vBorder, 0, 'R', 0);
      $pdf->ln();
      $pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
    
      $FillingEx = ociresult($sql_inv, "IS_FILLING_EXISTS");
    
      //-- шапка таблицы --
      if ($FillingEx == 0)
       {
        if ($CountCar > 1)
         {$pdf->Cell(5, $wLine - 1, "№", $vBorder, 0, 'C', 0); $pdf->Cell(10, $wLine - 1, "Род", $vBorder, 0, 'C', 0);}
        else
         {$pdf->Cell(15, $wLine - 1, "Род", $vBorder, 0, 'C', 0);}
        $pdf->Cell(20, ($wLine - 1) * 2, "№ вагона", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, ($wLine - 1) * 2, "Рол.", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, ($wLine - 1) * 2, "Г/П", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, ($wLine - 1) * 2, "Оси", $vBorder, 0, 'C', 0);
        $pdf->Cell(50, $wLine - 1, "Масса, кг.", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, $wLine - 1, "Пров.", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, $wLine - 1, "Инд.", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, $wLine - 1, "Об.", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, ($wLine - 1) * 2, "Прим.", $vBorder, 0, 'C', 0);
        $pdf->Cell(0, $wLine - 1, "ПРИ ОТПРАВЛЕНИИ", $vBorder, 0, 'C', 0);
        $pdf->ln();
        if ($CountCar > 1)
         {$pdf->Cell(5, $wLine - 1, "п/п", $vBorder, 0, 'C', 0); $pdf->Cell(10, $wLine - 1, "ваг.", $vBorder, 0, 'C', 0);}
        else
         {$pdf->Cell(15, $wLine - 1, "ваг.", $vBorder, 0, 'C', 0);}
        $pdf->SetX(75);
        $pdf->Cell(16, $wLine - 1, "нетто", $vBorder, 0, 'C', 0);
        $pdf->Cell(16, $wLine - 1, "тара", $vBorder, 0, 'C', 0);
        $pdf->Cell(18, $wLine - 1, "брутто", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, $wLine - 1, "кол.", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, $wLine - 1, "негаб.", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, $wLine - 1, "куз.", $vBorder, 0, 'C', 0);
        $pdf->SetX(165);
        $pdf->Cell(0, $wLine - 1, "(ПО ПРИБЫТИЮ)", $vBorder, 0, 'C', 0);
       }
    
      if ($FillingEx > 0)
       {
        if ($CountCar > 1)
         {$pdf->Cell(5, $wLine - 1, "№", $vBorder, 0, 'C', 0); $pdf->Cell(10, $wLine - 1, "Род", $vBorder, 0, 'C', 0);}
        else
         {$pdf->Cell(15, $wLine - 1, "Род", $vBorder, 0, 'C', 0);}
        $pdf->Cell(20, ($wLine - 1) * 2, "№ вагона", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, ($wLine - 1) * 2, "Г/П", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, ($wLine - 1) * 2, "Оси", $vBorder, 0, 'C', 0);
        $pdf->Cell(50, $wLine - 1, "Масса, кг.", $vBorder, 0, 'C', 0);
        $pdf->Cell(10, ($wLine - 1) * 2, "T, oC", $vBorder, 0, 'C', 0);
        $pdf->Cell(13, $wLine - 1, "Выс.", $vBorder, 0, 'C', 0);
        $pdf->Cell(12, $wLine - 1, "Тип", $vBorder, 0, 'C', 0);
        $pdf->Cell(13, ($wLine - 1) * 2, "Плотн.", $vBorder, 0, 'C', 0);
        $pdf->Cell(0, $wLine - 1, "ПРИ ОТПРАВЛЕНИИ", $vBorder, 0, 'C', 0);
        $pdf->ln();
        if ($CountCar > 1)
         {$pdf->Cell(5, $wLine - 1, "п/п", $vBorder, 0, 'C', 0); $pdf->Cell(10, $wLine - 1, "ваг.", $vBorder, 0, 'C', 0);}
        else
         {$pdf->Cell(15, $wLine - 1, "ваг.", $vBorder, 0, 'C', 0);}
        $pdf->SetX(65);
        $pdf->Cell(16, $wLine - 1, "нетто", $vBorder, 0, 'C', 0);
        $pdf->Cell(16, $wLine - 1, "тара", $vBorder, 0, 'C', 0);
        $pdf->Cell(18, $wLine - 1, "брутто", $vBorder, 0, 'C', 0);
        $pdf->SetX(125);
        $pdf->Cell(13, $wLine - 1, "нал., см.", $vBorder, 0, 'C', 0);
        $pdf->Cell(12, $wLine - 1, "цист.", $vBorder, 0, 'C', 0);
        $pdf->SetX(163);
        $pdf->Cell(0, $wLine - 1, "(ПО ПРИБЫТИЮ)", $vBorder, 0, 'C', 0);
       }
      $pdf->ln();
    
      //-- тело таблицы --
      $sql_car = OCIParse($conn, $sql_script_car);
      oci_bind_by_name($sql_car, ':invoice_id', ociresult($sql_inv, "INVOICE_ID"));
      OCIExecute($sql_car, OCI_DEFAULT);
        while (OCIFetch($sql_car))
         {
        if ($FillingEx == 0)
         {
          if ($CountCar > 1)
           {$pdf->Cell(5, $wLine, ociresult($sql_car, "CAR_ORDER"), $vBorder, 0, 'C', 0);
            $pdf->Cell(10, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_car, "IC_TYPE_NAME")), $vBorder, 0, 'C', 0);}
          else
           {$pdf->Cell(15, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_car, "IC_TYPE_NAME")), $vBorder, 0, 'C', 0);}
          $pdf->Cell(20, $wLine, ociresult($sql_car, "IC_CAR_NUMBER"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_ROLLS"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_TONNAGE"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_AXLES"), $vBorder, 0, 'C', 0);
          $pdf->Cell(16, $wLine, ociresult($sql_car, "IC_WEIGHT_NET"), $vBorder, 0, 'C', 0);
          $pdf->Cell(16, $wLine, ociresult($sql_car, "IC_WEIGHT_TARE"), $vBorder, 0, 'C', 0);
          $pdf->Cell(18, $wLine, ociresult($sql_car, "IC_TARE_CODE") . " " . ociresult($sql_car, "IC_WEIGHT_GROSS"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_CAR_CNT_GUIDE"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_OUTSIZE_CODE"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_VOLUME"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_car, "IC_OWNER_TYPE_NAME")), $vBorder, 0, 'C', 0);
          $pdf->Cell(0, $wLine, "Тар. " . ociresult($sql_car, "IC_CAR_AMOUNT"), $vBorder, 0, 'C', 0);
          $pdf->ln();
         }
      
        if ($FillingEx > 0)
         {
          if ($CountCar > 1)
           {$pdf->Cell(5, $wLine, ociresult($sql_car, "CAR_ORDER"), $vBorder, 0, 'C', 0);
            $pdf->Cell(10, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_car, "IC_TYPE_NAME")), $vBorder, 0, 'C', 0);}
          else
           {$pdf->Cell(15, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_car, "IC_TYPE_NAME")), $vBorder, 0, 'C', 0);}
          $pdf->Cell(20, $wLine, ociresult($sql_car, "IC_CAR_NUMBER"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_TONNAGE"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_AXLES"), $vBorder, 0, 'C', 0);
          $pdf->Cell(16, $wLine, ociresult($sql_car, "IC_WEIGHT_NET"), $vBorder, 0, 'C', 0);
          $pdf->Cell(16, $wLine, ociresult($sql_car, "IC_WEIGHT_TARE"), $vBorder, 0, 'C', 0);
          $pdf->Cell(18, $wLine, ociresult($sql_car, "IC_TARE_CODE") . " " . ociresult($sql_car, "IC_WEIGHT_GROSS"), $vBorder, 0, 'C', 0);
          $pdf->Cell(10, $wLine, ociresult($sql_car, "IC_LIQUID_TEMPERATURE"), $vBorder, 0, 'C', 0);
          $pdf->Cell(13, $wLine, ociresult($sql_car, "IC_LIQUID_HEIGHT"), $vBorder, 0, 'C', 0);
          $pdf->Cell(12, $wLine, ociresult($sql_car, "IC_TANKTYPE"), $vBorder, 0, 'C', 0);
          $pdf->Cell(13, $wLine, ociresult($sql_car, "IC_LIQUID_DENSITY"), $vBorder, 0, 'C', 0);
          $pdf->Cell(0, $wLine, "Тар. " . ociresult($sql_car, "IC_CAR_AMOUNT"), $vBorder, 0, 'C', 0);
          $pdf->ln();
         }
       }
    
    //-- итоги --
    $pdf->SetFont('TimesNewRomanPS-BoldMT','',$sFontT);
    if ($CountCar > 1) {$pdf->Cell(130, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_ITOGO_STR")), $vBorder, 0, 'L', 0);}
    $pdf->Cell(0, $wLine, "Итого " . ociresult($sql_inv, "SUM_CAR_AMOUNT"), $vBorder, 0, 'R', 0);
    $pdf->ln(); $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());    
	}
     
	//-------------- ПЛАТЕЖИ ----------------
	$pdf->SetFont('TimesNewRomanPSMT','',$sFontT);
	$pdf->MultiCell(0, $wLine, wordwrap("ПЛАТЕЖИ ВНЕСЕНЫ НА СТАНЦИИ ОТПРАВЛЕНИЯ: " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_AMOUNT_STR")), 188, "\n"), $vBorder, 'L');
	$pdf->Cell(70, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "PAY_PLACE_NAME")), $vBorder, 0, 'L', 0);
	$pdf->Cell(0, $wLine, "Вид расчета: " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "PAY_FORM_NAME")), $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->Cell(0, $wLine, "Перевозчик: " . iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CP_GOODS_CASHIER_POST_FIO")), $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->Cell(0, $wLine, "ПО ПРИБЫТИИ ПО ОКОНЧАТЕЛЬНОМУ РАСЧЕТУ УПЛАТИЛ:", $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->Cell(0, $wLine, "Недобор __________________________ руб. Перебор __________________________ руб.", $vBorder, 0, 'L', 0);
	$pdf->ln();
	$pdf->Cell(0, $wLine, "Платежи внесены на станции назначения: ____________________________________________________", $vBorder, 0, 'L', 0);
	$pdf->SetX(75);
	$pdf->Cell(0, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CF_PLACE_PAY")), $vBorder, 0, 'L', 0);
	$pdf->ln(); $pdf->Line(10, $pdf->GetY() + 1, 200, $pdf->GetY() + 1);
	
	//-------------- КАЛЕНДАРНЫЕ ШТЕМПЕЛЯ ----------------
	$pdf->ln();
//	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	$pdf->SetLineWidth(0.3);
	$pdf->Cell(0, $wLine, "КАЛЕНДАРНЫЕ ШТЕМПЕЛЯ", 'LRTB', 1, 'C', 0);
	$pdf->SetLineWidth(0.2);
	$pdf->Cell(47.5, $wLine, "Оформление приема", 'LT', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "Прибытие на станцию", 'LT', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "Уведомление", 'LT', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "Выдвча оригинала", 'LTR', 0, 'L', 0);
		$pdf->ln();
	$pdf->Cell(47.5, $wLine, "груза к перевозке", 'L', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "назначения", 'L', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "грузополучателя о", 'L', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "накладной", 'LR', 0, 'L', 0);

	$pdf->ln(); 
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "FROM_STATION_NAME")), 'L', 0, 'C', 0);
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TO_STATION_NAME")), 'L', 0, 'C', 0);
	$pdf->Cell(47.5, $wLine, "прибытии груза", 'L', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "грузополучателю", 'LR', 0, 'L', 0);
	
	$pdf->ln(); 
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_READY_LOCAL")), 'L', 0, 'C', 0);	
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_ARRIVE_LOCAL")), 'L', 0, 'C', 0);
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_NOTIFICATION_LOCAL")), 'LR', 0, 'C', 0);
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "TO_STATION_NAME")), 'R', 0, 'C', 0);
	
	$pdf->ln(); 
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_READY")), 'LB', 0, 'C', 0);	
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_ARRIVE")), 'LB', 0, 'C', 0);
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_NOTIFICATION")), 'LB', 0, 'C', 0);
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_RECREDIT")), 'LBR', 0, 'C', 0);
	
	$pdf->ln(); 
	$pdf->Cell(47.5, $wLine, "", 'L', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "", 'L', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "Время ".iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_NOTIFICATION_HH"))." час. ".iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "DATE_NOTIFICATION_MI"))." мин.", 'LR', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "", 'LR', 0, 'L', 0);


	$pdf->ln(); 
	$pdf->Cell(47.5, $wLine, "", 'L', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "", 'L', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, iconv('windows-1251', 'UTF-8', ociresult($sql_inv, "CP_FIO_ECP")), 'LBT', 0, 'C', 0);
	$pdf->Cell(47.5, $wLine, "", 'LR', 0, 'L', 0);

	$pdf->ln(); 
	$pdf->Cell(47.5, $wLine, "", 'LB', 0, 'L', 0);
	$pdf->Cell(47.5, $wLine, "", 'LB', 0, 'L', 0);
	$pdf->Cell(30.5, $wLine, "перевозчик", 'LBT', 0, 'C', 0);
	$pdf->Cell(17, $wLine, "подпись", 'LBT', 0, 'C', 0);
	$pdf->Cell(47.5, $wLine, "", 'LBR', 0, 'L', 0);
	
	//-------------- ОСОБЫЕ ЗАЯВЛЕНИЯ И ОТМЕТКИ ОТПРАВИТЕЛЯ ----------------
	$pdf->ln(); 
	$pdf->SetLineWidth(0.5);
	$pdf->ln(); $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
/*	$pdf->ln(); 
	$pdf->Cell(130, $wLine, "ОСОБЫЕ ЗАЯВЛЕНИЯ И ОТМЕТКИ ОТПРАВИТЕЛЯ", $vBorder, 0, 'L', 0);
	$pdf->Cell(60, $wLine, "", $vBorder, 0, 'L', 0);*/
	}
   

   
  OCILogoff($conn);
  $pdf->Output();  
 }
else 
 {
  $err = OCIError(); echo "Oracle Connect Error. " . $err[text];
 }
?>