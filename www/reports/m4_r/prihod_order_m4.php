<?php
define('FPDF_FONTPATH','ufpdf/font/'); //  Устанавливаем путь к папке шрифтов
require_once ($_SERVER['DOCUMENT_ROOT'].'/reports/m4_r/ufpdf/ufpdf.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/reports/m4_r/prihod_order_m4_sql.php');

/*
define('FPDF_FONTPATH','UFPDF/font/'); //  Устанавливаем путь к папке шрифтов
require('UFPDF/ufpdf.php'); // Подключаем класс FPDF
require('prihod_order_m4_sql.php'); // Подключаем SQL запрос
*/

$pdf = new UFPDF();
$pdf->Open();
$pdf->AddFont('TimesNewRomanPSMT','','times.php'); // Добавляем шрифт
$pdf->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php'); // Добавляем шрифт
$pdf->AddFont('TimesNewRomanPS-BoldItalicMT','','timesbi.php'); // Добавляем шрифт
// -------------------
set_time_limit(60);

$sid="(DESCRIPTION =
          (ADDRESS_LIST =
          (ADDRESS = (PROTOCOL = TCP)(HOST = t8dbnew.oracle.aoka)(PORT = 1521))
      )
          (CONNECT_DATA =
          (SERVICE_NAME = PROD)))";

if ($c = OCILogon("apexpdf", "apexpdf", $sid))
{
  $sql = OCIParse($c, $ss);
  OCIExecute($sql, OCI_DEFAULT);

  $sql = OCIParse($c, $s);
  OCIExecute($sql, OCI_DEFAULT);

  while (OCIFetch($sql))
   {
  $pdf->AddPage('L'); //Добавляем страничку в документ
//------ шапка документа ----------
  $pdf->SetFont('TimesNewRomanPS-BoldMT','',9);
  $pdf->Cell(0, 4, "ПРИХОДНЫЙ ОРДЕР №" . ociresult($sql, "RECEIPT_ORDER_NO"), 0, 0, 'C', 0);
  $pdf->ln(); $pdf->ln();
  $pdf->SetFont('TimesNewRomanPSMT','',8.5);
  $pdf->Cell(0, 4, "Типовая межотраслевая форма №М-4", 0, 0, 'R', 0); $pdf->ln();
  $pdf->Cell(0, 4, "Утверждена постановлением Госкомстата России", 0, 0, 'R', 0); $pdf->ln();
  $pdf->Cell(0, 4, "от 30.10.97 № 71а", 0, 0, 'R', 0);
  $pdf->ln(); $pdf->ln();
  $pdf->Cell(247, 4, "", 1, 0, 'R', 0); $pdf->Cell(30, 4, "Коды", 1, 0, 'C', 0); $pdf->ln();
  $pdf->Cell(247, 4, "Форма по ОКУД", 1, 0, 'R', 0); $pdf->Cell(30, 4, "0315003", 1, 0, 'C', 0); $pdf->ln();
  $pdf->Cell(25, 4, "Организация", 1, 0, 'L', 0);
  $pdf->Cell(192, 4, iconv('windows-1251', 'UTF-8', ociresult($sql, "ORGANIZATION")), 1, 0, 'L', 0);  
  $pdf->Cell(30, 4, "по ОКПО", 1, 0, 'R', 0);
  $pdf->Cell(30, 4, ociresult($sql, "OKPO"), 1, 0, 'C', 0); $pdf->ln();
  $pdf->Cell(50, 4, "Структурное подразделение", 0, 0, 'L', 0);
  $pdf->Cell(167, 4, iconv('windows-1251', 'UTF-8', ociresult($sql, "DIVISION")), 'B', 0, 'L', 0); $pdf->ln();
  $pdf->Cell(50, 4, "Складское подразделение", 0, 0, 'L', 0);
  $pdf->Cell(167, 4, iconv('windows-1251', 'UTF-8', ociresult($sql, "OPERATION_TYPE")), 'B', 0, 'L', 0); $pdf->ln(8);
//------ шапка 1-ой таблицы ---------
  $HightT = 14; // ширина таблицы

  $header = array("Дата составления", "Код вида операции", "Склад", "Поставщик", "Наименование", "Код",
                  "Страховая компания", "Корреспондирующий счет", "Счет, субсчет / Код аналитического учета",
				  "Номер документа", "Сопроводительного", "Платежного", "Номер паспорта"); // Массив с заголовками столбцов

  $w = array('n', 30, 'n', 30, 'n', 25, 't', 40, 'd', 25, 'd', 15, 'n', 25, 't', 50, 'd', 50, 't', 55, 'd', 30, 'd', 25, 'n', 22); // Массив с шириной столбцов

  $pdf->SetFont('TimesNewRomanPSMT', '', 7);

  for($i = 0; $i < count($header); $i++)
   {
	 $PosX = $pdf->GetX(); $PosY = $pdf->GetY();
	 $str = $pdf->GapStr($header[$i], $w[$i * 2 + 1]); // ставим пробелы для длинных строк
	 $len = $pdf->MultiCellHeight($w[$i * 2 + 1], $HightT, wordwrap($str, $w[$i * 2 + 1], "\n")); // вычисляем кол-во строк в ячейке

 	 if ($w[$i * 2] == 'n')
	  {$pdf->MultiCell($w[$i * 2 + 1], $HightT / ($len / $HightT), wordwrap($str, $w[$i * 2 + 1], "\n"), 1, 'C');
	   $pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY);}

	 if ($w[$i * 2] == 't')
	  {$pdf->MultiCell($w[$i * 2 + 1], ($HightT / ($len / $HightT)) / 2, wordwrap($str, $w[$i * 2 + 1], "\n"), 1, 'C');
	   $pdf->SetXY($PosX, $PosY + $HightT / 2);}

	 if ($w[$i * 2] == 'd')
	  {$pdf->MultiCell($w[$i * 2 + 1], ($HightT / ($len / $HightT)) / 2, wordwrap($str, $w[$i * 2 + 1], "\n"), 1, 'C');
	    if ($w[$i * 2 + 2] == 'n' || $w[$i * 2 + 2] == 't')
	     {$pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY - $HightT / 2);}
	    else
	     {$pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY);}
	  }
   }
 $pdf->ln($HightT);
//----- вывод данных 1-ой таблицы --------
  $HightT = 20; // ширина таблицы
  $s = 0;
  
  $header = array(ociresult($sql, "FILLING_DATE"), '', ociresult($sql, "WAREHOUSE"), ociresult($sql, "SUPPLIER_DESCRIPTION"),
                  ociresult($sql, "SUPPLIER_CODE"), ociresult($sql, "INSURANCE_COMPANY"),
				  ociresult($sql, "CORRESPONDING_ACCOUNT"), ociresult($sql, "ACCOMPANYING_NOTE"),
				  ociresult($sql, "PAYING"), ociresult($sql, "PASSPORT_NUMBER")); // Массив со значениями столбцов

  for($i = 0; $i < count($w); $i++)
   {
     if ($w[$i * 2] != 't')
      {
	   $PosX = $pdf->GetX(); $PosY = $pdf->GetY();
		if ($i == 4) // для полей кроме 'наименование' длину ячейки для вычисления длины строки умножаем на два т.к. содержится числовые символы
	     {$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', $header[$i - $s]), $w[$i * 2 + 1]);} // ставим пробелы для длинных строк
	    else
	     {$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', $header[$i - $s]), ($w[$i * 2 + 1] * 2) - 3);} // ставим пробелы для длинных строк
       $len = $pdf->MultiCellHeight($w[$i * 2 + 1], $HightT, wordwrap($str, $w[$i * 2 + 1] - 3, "\n")); // вычисляем кол-во строк в ячейке
	   $pdf->MultiCell($w[$i * 2 + 1], $HightT / ($len / $HightT), wordwrap($str, $w[$i * 2 + 1] - 3, "\n"), 1, 'C');
	   $pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY);
      }
	 else {$s = $s + 1;}
   }
 $pdf->ln($HightT + 4);
 
//------ шапка 2-ой таблицы ---------
  $HightT = 18; // ширина таблицы

  $header = array("Материальные ценности", "Наименование, сотр, размер, марка", "Номенклатурный номер", "Единица измерения", "Код", "Наименование",
                  "Количество", "По документу", "Получено", "Принято", "Цена, руб. коп.", "Сумма без учета НДС, руб. коп.", "Сумма НДС, руб. коп.",
				  "Всего с учетом НДС, руб. коп.", "Счет учета материалов", "Заказ на приобретение", "Категория", "Номер по складской картотеке"); // Массив с заголовками столбцов

  $w = array('t', 50, 'd', 35, 'd', 15,
             't', 20, 'd', 8, 'd', 12,
			 't', 50, 'd', 15, 'd', 15, 'd', 20,
			 'n', 17, 'n', 20, 'n', 20, 'n', 20, 'n', 20, 'n', 20, 'n', 20, 'n', 20); // Массив с шириной столбцов

  for($i = 0; $i < count($header); $i++)
   {
	 $PosX = $pdf->GetX(); $PosY = $pdf->GetY();
	 $str = $pdf->GapStr($header[$i], $w[$i * 2 + 1]); // ставим пробелы для длинных строк
	 $len = $pdf->MultiCellHeight($w[$i * 2 + 1], $HightT, wordwrap($str, $w[$i * 2 + 1], "\n")); // вычисляем кол-во строк в ячейке

 	 if ($w[$i * 2] == 'n')
	  {$pdf->MultiCell($w[$i * 2 + 1], $HightT / ($len / $HightT), wordwrap($str, $w[$i * 2 + 1], "\n"), 1, 'C');
	   $pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY);}

	 if ($w[$i * 2] == 't')
	  {$pdf->MultiCell($w[$i * 2 + 1], ($HightT / ($len / $HightT)) / 2, wordwrap($str, $w[$i * 2 + 1], "\n"), 1, 'C');
	   $pdf->SetXY($PosX, $PosY + $HightT / 2);}

	 if ($w[$i * 2] == 'd')
	  {$pdf->MultiCell($w[$i * 2 + 1], ($HightT / ($len / $HightT)) / 2, wordwrap($str, $w[$i * 2 + 1], "\n"), 1, 'C');
	    if ($w[$i * 2 + 2] == 'n' || $w[$i * 2 + 2] == 't')
	     {$pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY - $HightT / 2);}
	    else
	     {$pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY);}
	  }
   }
 $pdf->ln($HightT);
//----- вывод данных 2-ой таблицы --------
  $HightT = 20; // ширина таблицы
  $s = 0;

  $header = array(ociresult($sql, "INVENTORY_ITEMS_DESCRIPTION"),
                  ociresult($sql, "INVENTORY_ITEMS_PART_NUMBER"),
				  ociresult($sql, "UNIT_OF_MEASURE_CODE"),
                  ociresult($sql, "UNIT_OF_MEASURE_DESCRIPTION"),
				  ociresult($sql, "CR_QUANTITY_DELIVERED"),
				  ociresult($sql, "CR_QUANTITY_DELIVERED"),
				  ociresult($sql, "CR_QUANTITY_DELIVERED"),
				  ociresult($sql, "PRICE"),
				  ociresult($sql, "TOTAL_NO_VAT"),
				  ociresult($sql, "VAT_AMT"),
				  ociresult($sql, "TOTAL_WITH_VAT"),
				  ociresult($sql, "INV_MAT_ACCT"),
				  ociresult($sql, "PURCHASING_DOCUMENT"),
				  ociresult($sql, "CATEGORY"),
				  ociresult($sql, "NUMBER_BY_INVENTORY_CARDS")); // Массив со значениями столбцов

  for($i = 0; $i < count($w); $i++)
   {
     if ($w[$i * 2] != 't')
      {
	   $PosX = $pdf->GetX(); $PosY = $pdf->GetY();
        if ($i == 1 || $i == 5)
	     {$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', $header[$i - $s]), $w[$i * 2 + 1]);} // ставим пробелы для длинных строк
	    else
	     {$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', $header[$i - $s]), ($w[$i * 2 + 1] * 2) - 3);} // ставим пробелы для длинных строк
	   $len = $pdf->MultiCellHeight($w[$i * 2 + 1], $HightT, wordwrap($str, $w[$i * 2 + 1] - 3, "\n")); // вычисляем кол-во строк в ячейке
	   $pdf->MultiCell($w[$i * 2 + 1], $HightT / ($len / $HightT), wordwrap($str, $w[$i * 2 + 1] - 3, "\n"), 1, 'C');
	   $pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY);
      }
	 else {$s = $s + 1;}
   }
 $pdf->ln($HightT);
//----- вывод данных 2-ой таблицы (2строка) --------
  $HightT = 6; // ширина таблицы
  $s = 0;

  $header = array('',
                  '',
				  '',
				  '',
				  'Всего',
				  ociresult($sql, "CR_QUANTITY_DELIVERED"),
				  ociresult($sql, "CR_QUANTITY_DELIVERED"),
				  '',
                  ociresult($sql, "TOTAL_NO_VAT"),
				  ociresult($sql, "VAT_AMT"),
				  ociresult($sql, "TOTAL_WITH_VAT"),
				  '',
				  '',
				  '',
				  ''); // Массив со значениями столбцов

  for($i = 0; $i < count($w); $i++)
   {
     if ($w[$i * 2] != 't')
      {
	   $PosX = $pdf->GetX(); $PosY = $pdf->GetY();
	   if ($i == 7)
        {$str = $pdf->GapStr($header[$i - $s], $w[$i * 2 + 1] * 2);}
       else
	    {$str = $pdf->GapStr(iconv('windows-1251', 'UTF-8', $header[$i - $s]), $w[$i * 2 + 1] * 2);}
	   $len = $pdf->MultiCellHeight($w[$i * 2 + 1], $HightT, wordwrap($str, $w[$i * 2 + 1], "\n")); // вычисляем кол-во строк в ячейке
	   $pdf->MultiCell($w[$i * 2 + 1], $HightT / ($len / $HightT), wordwrap($str, $w[$i * 2 + 1], "\n"), 1, 'C');
	   $pdf->SetXY($PosX + $w[$i * 2 + 1], $PosY);
      }
	 else {$s = $s + 1;}
   }
 
  $pdf->SetY(170);
  $pdf->SetFont('TimesNewRomanPS-BoldMT','',9);
  $pdf->Cell(30, 6, "Принял", 0, 0, 'C', 0);
  $pdf->Cell(110, 6, "", 'B', 0, 'C', 0);
  $pdf->Cell(20, 6, "Сдал", 0, 0, 'C', 0);
  $pdf->Cell(118, 6, "", 'B', 0, 'C', 0);
  $pdf->ln();

  $pdf->SetFont('TimesNewRomanPSMT','',6);
  $pdf->Cell(30, 3, "", 0, 0, 'C', 0);
  $pdf->Cell(35, 3, "Должность", 0, 0, 'C', 0);
  $pdf->Cell(35, 3, "Подпись", 0, 0, 'C', 0);
  $pdf->Cell(35, 3, "Расшифровка подписи", 0, 0, 'C', 0);
  $pdf->Cell(30, 3, "", 0, 0, 'C', 0);
  $pdf->Cell(35, 3, "Должность", 0, 0, 'C', 0);
  $pdf->Cell(35, 3, "Подпись", 0, 0, 'C', 0);
  $pdf->Cell(35, 3, "Расшифровка подписи", 0, 0, 'C', 0);
 }

   OCILogoff($c);
//-----
  $pdf->Output();  
}
else 
 {
  $err = OCIError(); echo "Oracle Connect Error " . $err[text];
 }

?>