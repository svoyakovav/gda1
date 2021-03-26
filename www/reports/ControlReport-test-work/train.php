<?php
    // Объявление массивов ячеек и строк
	$cell = array(); //массив значений
	$colCount = 22; //количество столбцов
    $line = array(
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Итого</th>", "TRN_HEADER",
			"NIL", "NIL", "NIL", "NIL", "CAR", "NIL", "NIL", "NIL"),

		//--------Крытые вагоны
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Крытые</th>", "TRN_HEADER",
			"20", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\">Без специализ.</th>", "TRN_WITHOUT",
			"20", "", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\">203</th>", "TRN_LINE",
			"20", "195", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\">204</th>", "TRN_LINE",
			"20", "196", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\">325</th>", "TRN_LINE",
			"20", "201", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\">470</th>", "TRN_LINE",
			"20", "516", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		
		//--------Полувагоны
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Полувагоны</th>", "TRN_HEADER",
			"12", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\" align=\"left\">Без специализ.</th>", "TRN_WITHOUT",
			"12", "", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th rowspan=\"3\" align=\"left\">203</th><th colspan=\"2\">соб.</th>", "TRN_LINE",
			"12", "195", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"2\">соб. склад</th>", "TRN_LINE",
			"12", "195", "NIL", "ССКЛ", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"2\">чуж.</th>", "TRN_LINE",
			"12", "195", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">323</th>", "TRN_LINE",
			"12", "199", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th rowspan=\"6\" align=\"left\">Сульфат</th><th colspan=\"2\" bgcolor=\"#dddddd\">Общие</th>", "TRN_LINE",
			"12", "NIL", "NIL", "NIL", "NIL", "54", "NIL", "NIL"),
		array("<th rowspan=\"2\">325</th><th>соб.</th>", "TRN_LINE",
			"12", "201", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"12", "201", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"),
		array("<th rowspan=\"2\">337</th><th>соб.</th>", "TRN_LINE",
			"12", "204", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"12", "204", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"),
		array("<th colspan=\"2\">925</th>", "TRN_LINE",
			"12", "1236", "NIL", "NIL", "NIL", "54", "NIL", "NIL"),

		//--------Полувагоны ВЫГРУЗКА
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Полувагоны ВЫГРУЗКА</th>", "TRN_HEADER",
			"", "", "", "", "", "", "", ""),			
/*20/11/2018*/
    	array("<th colspan=\"3\" align=\"left\">Магнезит</th>", "TRN_LINE",
			"12", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "48"),
		
		//--------Минераловозы
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Минераловозы</th>", "TRN_HEADER",
			"15", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "PARENT"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\" align=\"left\">Без специализ.</th>", "TRN_WITHOUT",
			"15", "", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "CHILD"),
		array("<th rowspan=\"2\" colspan=\"2\" align=\"left\">203</th><th>соб.</th>", "TRN_LINE",
			"15", "195", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL", "CHILD"),
		array("<th>чуж.</th>", "TRN_LINE",
			"15", "195", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL", "CHILD"),
		array("<th rowspan=\"2\" colspan=\"2\" align=\"left\">204</th><th>соб.</th>", "TRN_LINE",
			"15", "196", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL", "CHILD"),
		array("<th>чуж.</th>", "TRN_LINE",
			"15", "196", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL", "CHILD"),
		array("<th rowspan=\"6\" align=\"left\">Сульфат</th><th colspan=\"2\" bgcolor=\"#dddddd\">Общие</th>", "TRN_LINE",
			"15", "NIL", "NIL", "NIL", "NIL", "54", "NIL", "NIL"),
		array("<th rowspan=\"2\">325</th><th>соб.</th>", "TRN_LINE",
			"15", "201", "NIL", "СОБ", "NIL", "54", "NIL", "NIL", "CHILD"),
		array("<th>чуж.</th>", "TRN_LINE",
			"15", "201", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL", "CHILD"),
		array("<th rowspan=\"2\">337</th><th>соб.</th>", "TRN_LINE",
			"15", "204", "NIL", "СОБ", "NIL", "54", "NIL", "NIL", "CHILD"),
		array("<th>чуж.</th>", "TRN_LINE",
			"15", "204", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL", "CHILD"),
		array("<th colspan=\"2\">925</th>", "TRN_LINE",
			"15", "1236", "NIL", "NIL", "NIL", "54", "NIL", "NIL", "CHILD"),
		
		//--------Контейнера
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Контейнера</th>", "TRN_HEADER",
			"881", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"2\" rowspan=\"2\" bgcolor=\"#dddddd\" align=\"left\">Без<br>специализ.</th><th bgcolor=\"#dddddd\">40 фут</th>", "TRN_WITHOUT",
			"881", "NIL", "NIL", "NIL", "NIL", "", "40", "NIL"),
		array("<th bgcolor=\"#dddddd\">20 фут</th>", "TRN_WITHOUT",
			"881", "NIL", "NIL", "NIL", "NIL", "", "20", "NIL"),
		
		array("<th colspan=\"3\" align=\"left\">Капролактам</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "51", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Полиамид</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "52", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Селитра</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "49", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Ткань кордная</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "53", "NIL", "NIL"),
		
		//--------Контейнера-цистерны
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Контейнера-цистерны</th>", "TRN_HEADER",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\" align=\"left\">Без специализ.</th>", "TRN_WITHOUT",
/*тел*/		"880", "NIL", "NIL", "NIL", "NIL", "666", "NIL", "NIL"),   
		array("<th colspan=\"3\" align=\"left\">Ам. вода</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "42", "NIL", "NIL"),
		array("<th rowspan=\"2\" colspan=\"2\" align=\"left\">КАС</th><th>соб.</th>", "TRN_LINE",
			"880", "NIL", "NIL", "СОБ", "NIL", "46", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"880", "NIL", "NIL", "ЧУЖ", "NIL", "46", "NIL", "NIL"),
/*тел*/	array("<th rowspan=\"2\" colspan=\"2\" align=\"left\">КААС</th><th>соб.</th>", "TRN_LINE",
			"880", "NIL", "NIL", "СОБ", "NIL", "122", "NIL", "NIL"),
/*тел*/	array("<th>чуж.</th>", "TRN_LINE",
			"880", "NIL", "NIL", "ЧУЖ", "NIL", "122", "NIL", "NIL"),	
/*тел*/	array("<th colspan=\"3\" align=\"left\">Капролактам</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "51", "NIL", "NIL"),
/*тел*/	array("<th colspan=\"3\" align=\"left\">ЩСПК (Щелочной сток)</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "43", "NIL", "NIL"),	
			
		//--------Конт-цистерны ВЫГРУЗКА
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Конт-цистерны ВЫГРУЗКА</th>", "TRN_HEADER",
			"", "", "", "", "", "", "", ""),
/*тел*/	array("<th colspan=\"3\" align=\"left\">Бензол</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "45"),
/*тел*/	array("<th colspan=\"3\" align=\"left\">Натрия гидроксид</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "502"),			
/*тел*/	array("<th colspan=\"3\" align=\"left\">Олеум</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "56"),
/*тел*/	array("<th colspan=\"3\" align=\"left\">Серная кислота</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "57"),

			//--------Складские цистерны			
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Складские цистерны</th>",  "TRN_HEADER",
			"21", "NIL", "NIL", "NIL", "NIL", "162", "NIL", "NIL"),		

			//--------Цистерны
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Цистерны</th>", "TRN_HEADER",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\" align=\"left\">Без специализ.</th>", "TRN_WITHOUT",
			"21", "NIL", "NIL", "NIL", "NIL", "666", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Ам.вода</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "42", "NIL", "NIL"),
		array("<th rowspan=\"2\" colspan=\"2\" align=\"left\">Аммиак</th><th>соб.</th>", "TRN_LINE",
			"21", "NIL", "NIL", "СОБ", "NIL", "41", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"21", "NIL", "NIL", "ЧУЖ", "NIL", "41", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Аргон</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "44", "NIL", "NIL"),

		array("<th colspan=\"3\" align=\"left\">КАС</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "46", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">КААС</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "122", "NIL", "NIL"),
		
		array("<th colspan=\"3\" align=\"left\">Масло ПОД</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "55", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Растворитель СФПК</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "101", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Циклен</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "123", "NIL", "NIL"),					
		array("<th colspan=\"3\" align=\"left\">Циклогексан</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "58", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Циклогексанол</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "60", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">Циклогексанон</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "59", "NIL", "NIL"),
		array("<th colspan=\"3\" align=\"left\">ЩСПК (Щелочной сток)</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "43", "NIL", "NIL"),

			//--------Цистерны (Выгрузка)
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Цистерны ВЫГРУЗКА </th>", "TRN_HEADER",
			"", "", "", "", "", "", "", ""),
/*тел*/	array("<th colspan=\"3\" align=\"left\">Бензол</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "45"),	
/*тел*/	array("<th colspan=\"3\" align=\"left\">Магнезит</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "48"),				
/*тел*/	array("<th colspan=\"3\" align=\"left\">Натрия гидроксид</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "502"),
/*тел*/	array("<th rowspan=\"2\" colspan=\"2\" align=\"left\">Олеум</th><th>соб.</th>", "TRN_LINE",
			"21", "NIL", "NIL", "СОБ", "NIL", "NIL", "NIL", "56"),
/*тел*/	array("<th>чуж.</th>", "TRN_LINE",
			"21", "NIL", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "56"),
/*тел*/	array("<th rowspan=\"2\" colspan=\"2\" align=\"left\">Серная кислота</th><th>соб.</th>", "TRN_LINE",
			"21", "NIL", "NIL", "СОБ", "NIL", "NIL", "NIL", "57"),
/*тел*/	array("<th>чуж.</th>", "TRN_LINE",
			"21", "NIL", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "57"),		
			
/*тел*///	array("<th>чуж.</th>", "TRN_LINE",
		//	"21", "NIL", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "502"),

/*тел*///	array("<th>чуж.</th>", "TRN_LINE",
		//	"21", "NIL", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "48"),

/*тел*///	array("<th>чуж.</th>", "TRN_LINE",
		//	"21", "NIL", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "45"),		
/*тел*/	//array("<th colspan=\"3\">Фенол</th>", "TRN_LINE",
		//	"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "501"),
/*тел*///	array("<th>чуж.</th>", "TRN_LINE",
		//	"21", "NIL", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "501"),					
			
			//--------Платформы
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Платформы</th>", "TRN_HEADER",
			"23", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
	);

	$rowCount = count($line); //количество строк
	
	
	// Формирование массива ячеек
	for ($i = 0; $i < $rowCount; $i++) {
		for ($j = 0; $j < $colCount; $j++) {
			$btype = substr($line[$i][1], 0, 3);
			$ltype = substr($line[$i][1], 4);

			$cell[$i][$j][1] = $line[$i][3]; // ORGANIZATION_ID
			$cell[$i][$j][3] = $line[$i][4]; // CAR_WALKING_ID (1 - Экспорт; 4 - Внутренний рынок)
			$cell[$i][$j][5] = $line[$i][6]; // UNIT_TYPE_CODE (CAR/CONT)
			$cell[$i][$j][7] = $line[$i][7]; // CARGO_CATEGORY_ID
			$cell[$i][$j][8] = "0";
			$cell[$i][$j][9] = "0";
			$cell[$i][$j][11] = $line[$i][8]; // UNIT_LENGTH
/**/		$cell[$i][$j][14] = $line[$i][9]; // FCARGO_CATEGORY_ID
			$cell[$i][$j][15] = $line[$i][10]; // PARENT or CHILD

 			if ($btype == "TRN") {
				$cell[$i][$j][13] = "NIL"; // FWEIGHT_SIGN
				
				if ($ltype == "HEADER") {
					switch ($j) {
						/*case 4: коммент*/ case /*18*/19: $cell[$i][$j][0] = "0"; break;
						default: $cell[$i][$j][0] = $line[$i][2]; break;}
				} else if ($ltype == "WITHOUT") {
					switch ($j) {
						case 0:
						case 1: 
						case 9: 
						case 10: 
						case 11: 
						case 12: 
						/*case 13:*/ 
						case 14: 
						case 15: 
						case 16: 
						case 17:/*ins*/
						case 18: 
						case /*20*/21: 
							$cell[$i][$j][0] = $line[$i][2]; 
							break;
						default: 
							$cell[$i][$j][0] = "0"; 
							break;
						}
				} else if ($ltype == "LINE") {
					switch ($j) {
						case 2: 
						case 3: 
						/*case 4:*/ 
						case 5: 
						case /*18*/19: 
						case /*19*/20: 
							$cell[$i][$j][0] = "0"; 
							break;
						default: 
							$cell[$i][$j][0] = $line[$i][2]; 
							break;
						}
				}
				
				$cell[$i][$j][4] = $line[$i][5]; // CAR_OWNER_SIGN (1 - Собственный; 0 - Чужой)
				
				// WEIGHT_SIGN (0 - Порожний; 1 - Груженый)
				switch ($j) {
					case 1: case 3: /*нов*/case 4: case 8: case 9: case 10: case 11: case 12: case /*20*/21: $cell[$i][$j][2] = "1"; break;
					case 2: case 5: /*case 13: */case 14: case 15: case 16: case 17: /*ins*/case 18: case /*19*/20: $cell[$i][$j][2] = "0"; break;
					default: $cell[$i][$j][2] = "NIL"; break;
				}
				
				// ACTION_TYPE
				switch ($j) {
					case 2: case 3: case /*19*/20: $cell[$i][$j][6] = "РЕГИСТР"; break;
					/*нов*/case 4: case 5: case 8: case /*20*/21: $cell[$i][$j][6] = "ПРИЕМ_СОСТ"; break;
					case 6: $cell[$i][$j][6] = "ПОГР"; break;
					case 7: $cell[$i][$j][6] = "ВЫГР"; break;
					case 10: $cell[$i][$j][6] = "СДАЧА"; break;
					case 11: $cell[$i][$j][6] = "С_ДОК"; break;
					case 12: $cell[$i][$j][6] = "СКЛАД"; break;
/*18-12-2018*/		case 13: $cell[$i][$j][6] = "ПОД_ВЫГР"; break;
					case /*14*/15: $cell[$i][$j][6] = "ПОД_ПОГР"; break;
					case /*15*/16: $cell[$i][$j][6] = "ГОТ_ПОГР"; break;
					case /*16*/17: $cell[$i][$j][6] = "В_ОТСТ"; break;
					case /*17*/18: $cell[$i][$j][6] = "БРАК"; break;
					default: $cell[$i][$j][6] = "NIL"; break;
				}
				// SQL_NUMBER
				if ($j >= 9 && $j <= /*17*/18) {$cell[$i][$j][10] = "3";}
				else if ($j >= /*19*/20 && $j <= /*20*/21) {$cell[$i][$j][10] = "4";}
				else if ($j >= 0 && $j <= 1) {$cell[$i][$j][10] = "1";}
				else {$cell[$i][$j][10] = "2";}
				
				// Краткое наименование колонки (для вывода строк в модальном окне)
				switch ($j) {
					case 2: $cell[$i][$j][12] = "ПС_ПРИБ_ПОРОЖ"; break;
					case 3: $cell[$i][$j][12] = "ПС_ПРИБ_ГРУЖ"; break;
/*нов */		    case 4: $cell[$i][$j][12] = "ПС_СДАНО_ГРУЖ"; break;
					case 5: $cell[$i][$j][12] = "ПС_СДАНО_ПОРОЖ"; break;   
					case 8: 
					case 20: $cell[$i][$j][12] = "ПС_ОФОРМ"; break;
					case 6: $cell[$i][$j][12] = "ПС_ПОГРУЖ"; break;
					case 7: $cell[$i][$j][12] = "ПС_ВЫГРУЖ"; break;
					case 9: $cell[$i][$j][12] = "ПС_ГРУЖ_ВСЕГО"; break;
					case 10: $cell[$i][$j][12] = "ПС_ВСДАЧЕ"; break;
					case 11: $cell[$i][$j][12] = "ПС_СДОК"; break;
					case 12: $cell[$i][$j][12] = "ПС_СКЛАД"; break;
/*18-12-2018*/		case 13: $cell[$i][$j][12] = "С_ПОД_ВЫГР"; break;
					case /*13*/14: $cell[$i][$j][12] = "ПС_ПОРОЖ_ВСЕГО"; break;
					case /*14*/15: $cell[$i][$j][12] = "ПС_ПОД_ПОГР"; break;
					case /*15*/16: $cell[$i][$j][12] = "ПС_ГОТ_ПОГР"; break;
					case /*16*/18: $cell[$i][$j][12] = "ПС_В_ОТСТОЕ"; break;
					case /*17*/18: $cell[$i][$j][12] = "ПС_БРАК"; break;
					default: $cell[$i][$j][12] = "ПС_ПУСТО"; break;
				}
			}
        }
    }
	
    // Расчет массива ячеек
    foreach (array("1", "2", "3", "4") as $sql) {
        switch ($sql) {
			case "1": $sql_current = $sql_script01; $sql_date_01 = $PreviousDate; $sql_date_02 = "";       break;
			case "3": $sql_current = $sql_script03; $sql_date_01 = $SetDate;      $sql_date_02 = "";       break;
			case "2": $sql_current = $sql_script02; $sql_date_01 = $PreviousDate; $sql_date_02 = $SetDate; break;
			case "4": $sql_current = $sql_script02; $sql_date_01 = $BeginMonth;   $sql_date_02 = $SetDate; break;
		}
		
		$sql_current = str_replace(":pDate",      "'" . $sql_date_01 . "'", $sql_current);
		$sql_current = str_replace(":pStartDate", "'" . $sql_date_01 . "'", $sql_current);
		$sql_current = str_replace(":pEndDate",   "'" . $sql_date_02 . "'", $sql_current);
/*
				case when UNIT.UNIT_TYPE_CODE='CONT' and UNIT.FCARGO_CATEGORY_ID=666 then 0 else
				COUNT(*) end AS CAR_COUNT,
*/		
		$sql_current = "
			SELECT
                count(*) as CAR_COUNT,
				UNIT.CAR_WALKING_ID,
				UNIT.CAR_TYPE_ID,
				UNIT.WEIGHT_SIGN,
				UNIT.ORGANIZATION_ID,
				UNIT.UNIT_TYPE_CODE,
				UNIT.ACTION_TYPE,
				UNIT.CAR_OWNER_SIGN,
				UNIT.UNIT_LENGTH,
				UNIT.CARGO_CATEGORY_ID,
				UNIT.FWEIGHT_SIGN,
				UNIT.FCARGO_CATEGORY_ID
			FROM (" . $sql_current . ") UNIT
			GROUP BY
				UNIT.CAR_WALKING_ID,
				UNIT.CAR_TYPE_ID,
				UNIT.WEIGHT_SIGN,
				UNIT.ORGANIZATION_ID,
				UNIT.CAR_OWNER_SIGN,
				UNIT.UNIT_TYPE_CODE,
				UNIT.ACTION_TYPE,
				UNIT.UNIT_LENGTH,
				UNIT.CARGO_CATEGORY_ID,
				UNIT.FWEIGHT_SIGN,
				UNIT.FCARGO_CATEGORY_ID
		";
		
		$select = OCIParse($itl_logon, $sql_current);
        OCIExecute($select, OCI_DEFAULT);
        $rows = OCIFetchStatement($select, $result, 0, -1, OCI_FETCHSTATEMENT_BY_COLUMN + OCI_ASSOC);

		for ($i = 0; $i < $rowCount; $i++) {
			for ($j = 0; $j < $colCount; $j++) {
				$count = 0;
				if ($sql == $cell[$i][$j][10] && $cell[$i][$j][0] != "0") {

					for ($x = 0; $x < $rows; $x++) {
						//($value[6] == "NIL" || strpos($result["ACTION_TYPE"][$i], $value[6]) !== false)
							# code...
							if (($cell[$i][$j][0] == "NIL"  || $result["CAR_TYPE_ID"][$x]        == $cell[$i][$j][0]) &&
							($cell[$i][$j][1] == "NIL"  || $result["ORGANIZATION_ID"][$x]    == $cell[$i][$j][1]) &&
							($cell[$i][$j][2] == "NIL"  || $result["WEIGHT_SIGN"][$x]        == $cell[$i][$j][2]) &&
							($cell[$i][$j][3] == "NIL"  || $result["CAR_WALKING_ID"][$x]     == $cell[$i][$j][3]) &&
							($cell[$i][$j][4] == "NIL"  || $result["CAR_OWNER_SIGN"][$x]     == $cell[$i][$j][4]) &&
							($cell[$i][$j][5] == "NIL"  || $result["UNIT_TYPE_CODE"][$x]     == $cell[$i][$j][5]) &&
							($cell[$i][$j][7] == "NIL"  || $result["CARGO_CATEGORY_ID"][$x]  == $cell[$i][$j][7]) &&
							($cell[$i][$j][11] == "NIL" || $result["UNIT_LENGTH"][$x]        == $cell[$i][$j][11]) &&
							($cell[$i][$j][13] == "NIL" || $result["FWEIGHT_SIGN"][$x]       == $cell[$i][$j][13]) &&
							($cell[$i][$j][14] == "NIL" || $result["FCARGO_CATEGORY_ID"][$x] == $cell[$i][$j][14]) &&
	//						($cell[$i][$j][20] == "NIL" || $result["cont_location"][$i]      == $cell[$i][$j][20]) &&
							($cell[$i][$j][6] == "NIL"  || $result["ACTION_TYPE"][$x]        == $cell[$i][$j][6])
						) {$count += $result["CAR_COUNT"][$x];}
						
						
					}

				$p = $cell[$i][$j][10] . "/" . $cell[$i][$j][0] . "/" . $cell[$i][$j][1] . "/" . $cell[$i][$j][2] . "/" . $cell[$i][$j][3] ."/" .
				$cell[$i][$j][4] . "/" . $cell[$i][$j][5] . "/" . $cell[$i][$j][6] . "/" . $cell[$i][$j][7] . "/" . $cell[$i][$j][11] . "/" .
				$sql_date_01 . "/" . $sql_date_02 . "/" . $cell[$i][$j][12] . "/" . $cell[$i][$j][13] . "/" . $cell[$i][$j][14];
	 
	   			$cell[$i][$j][8] = (($count != 0) ? "<a href=\"javascript:onClick=cellClick('" . $p . "');\">" . $count . "</a>" : "");
	   			$cell[$i][$j][9] = $count;
			}

		}
	}

				
	}

	unset($sql);
	
	OCIFreeStatement($select);
	OCILogOff($itl_logon);

	$cell = analize($cell, $colCount, $rowCount);
?>
<!-- Таблица -->
	<div align="center" id="body-page">
		<table id="ReportTable01">
			<thead>
				<tr>
					<th colspan="2">Всего вагонов:</th>
					<th align="left" id="TotalCell"></th>
					<th colspan="21"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th rowspan="3" colspan="3"><div style="width: 145px;">Подвижной<br>состав</div></th>
					<th colspan="9" bgcolor="#dddddd">За прошедшие сутки</th>
					<th colspan="11" bgcolor="#dddddd">На текущие сутки</th>
					<th colspan="2" bgcolor="#dddddd">С начала мес.</th>
				</tr>
				<tr>
					<th colspan="2" bgcolor="#dddddd">Начало суток</th>
					<th colspan="2" bgcolor="#dddddd">Прибыло</th>
<!--изм-->					<th rowspan="2" bgcolor="#dddddd">Сдано<br>груж.</th>
					<th rowspan="2" bgcolor="#dddddd">Сдано<br>порож.</th>
					<th rowspan="2" bgcolor="#dddddd">Пог-<br>руж.</th>
					<th rowspan="2" bgcolor="#dddddd">Выг-<br>руж.</th>
					<th rowspan="2" bgcolor="#dddddd">Оформ-<br>лено (???)</th>
					<th colspan="5" bgcolor="#dddddd">Груженые</th>
					<th colspan="5" bgcolor="#dddddd">Порожние</th>
					<th rowspan="2" bgcolor="#dddddd">Итого</th>
					<th rowspan="2" bgcolor="#dddddd">При-<br>было</th>
					<th rowspan="2" bgcolor="#dddddd">Оформ-<br>лено</th>
				</tr>
				<tr>
					<th bgcolor="#dddddd">Всего</th>
					<th bgcolor="#dddddd">Груж.</th>
					<th bgcolor="#dddddd">Порож.</th>
					<th bgcolor="#dddddd">Груж.</th>
					<th bgcolor="#dddddd">Всего</th>
					<th bgcolor="#dddddd">В сдаче</th>
					<th bgcolor="#dddddd">С док.</th>
					<th bgcolor="#dddddd">Склад</th>
<!--нов-->				<th bgcolor="#dddddd">Под<br>выгр</th>   
					<th bgcolor="#dddddd">Всего</th>
					<th bgcolor="#dddddd">п/п</th>
					<th bgcolor="#dddddd">Гот. п/п</th>
					<th bgcolor="#dddddd">В отс.</th>
					<th bgcolor="#dddddd">Брак</th>
				</tr>
<?php
    for ($i = 0; $i < $rowCount; $i++) {
		$btype = substr($line[$i][1], 0, 3);
		$ltype = substr($line[$i][1], 4);
		
		$result = "";
		for ($j = 0; $j < $colCount; $j++) {
			if ($btype == "TRN") {
				//-----------
				/*--коммент 
				    if ($j == 4 && $ltype == "HEADER") {
					$calc = $cell[$p - 4][9] + $cell[$p - 2][9] + $cell[$p - 1][9];
					$cell[$p][8] = $calc;
					$cell[$p][9] = $calc;} // Обеспечение
  				else*/ if ($j == /*18*/19) {
					$calc = $cell[$i][$j - /*9*/10][9] + $cell[$i][$j - 5][9];
					$cell[$i][$j][8] = ($calc == 0) ? "" : $calc;
					$cell[$i][$j][9] = $calc;} // Итого (на тек. сутки)
				
/*13 24*/			if (($i == /*13*/14 || $i == 24) ||
					(($ltype == "LINE") && ($j == 0 || $j == 1)) ||
/*13*/					(($ltype == "LINE") && ($j == 9 || $j == /*13*/14)) ||
					($ltype == "WITHOUT" && $cell[$i][$j][8] != "0")) {$color = "bgcolor=\"#dddddd\"";}
				else if ($ltype == "HEADER") {$color = "bgcolor=\"#cccccc\"";}
				else {$color = "";}
				//-----------
			} 

/*13*/			if ($i == 0 && ($j == 9 || $j == /*13*/14)) {$csumm = "class=\"csumm\"";} else {$csumm = "";}

				if ($cell[$i][$j][15] == "ERROR") { $color = "bgcolor=\"#D3091B\""; }

				
			
				$result .= "<td " . $color . " " . $csumm . ">" . (($cell[$i][$j][8] == "0") ? "" : $cell[$i][$j][8]) . "</td>";

		}
		echo "<tr>" . $line[$i][0] . $result . "</tr>";
    }
?>
		</table>
	</div>