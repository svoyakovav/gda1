<?php
	//2018-03-26 elt исключение из строки Прочее контейнеров и платформ №373

    // Объявление массивов ячеек и строк
    $cell = array();
    $line = array(
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Итого</th>", "TRN_HEADER",
			"NIL", "NIL", "NIL", "NIL", "CAR", "NIL", "NIL", "NIL"),
		//--------
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
		//--------
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Полувагоны</th>", "TRN_HEADER",
			"12", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\">Без специализ.</th>", "TRN_WITHOUT",
			"12", "", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th rowspan=\"3\">203</th><th colspan=\"2\">соб.</th>", "TRN_LINE",
			"12", "195", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"2\">соб. склад</th>", "TRN_LINE",
			"12", "195", "NIL", "ССКЛ", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"2\">чуж.</th>", "TRN_LINE",
			"12", "195", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\">323</th>", "TRN_LINE",
			"12", "199", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th rowspan=\"6\">Сульфат</th><th colspan=\"2\" bgcolor=\"#dddddd\">Общие</th>", "TRN_LINE",
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
		//--------
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Минераловозы</th>", "TRN_HEADER",
			"15", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\">Без специализ.</th>", "TRN_WITHOUT",
			"15", "", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th rowspan=\"2\" colspan=\"2\">203</th><th>соб.</th>", "TRN_LINE",
			"15", "195", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"15", "195", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"),
		array("<th rowspan=\"2\" colspan=\"2\">204</th><th>соб.</th>", "TRN_LINE",
			"15", "196", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"15", "196", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"),
		array("<th rowspan=\"6\">Сульфат</th><th colspan=\"2\" bgcolor=\"#dddddd\">Общие</th>", "TRN_LINE",
			"15", "NIL", "NIL", "NIL", "NIL", "54", "NIL", "NIL"),
		array("<th rowspan=\"2\">325</th><th>соб.</th>", "TRN_LINE",
			"15", "201", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"15", "201", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"),
		array("<th rowspan=\"2\">337</th><th>соб.</th>", "TRN_LINE",
			"15", "204", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"15", "204", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"),
		array("<th colspan=\"2\">925</th>", "TRN_LINE",
			"15", "1236", "NIL", "NIL", "NIL", "54", "NIL", "NIL"),
		//--------
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Контейнера</th>", "TRN_HEADER",
			"881", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"2\" rowspan=\"2\" bgcolor=\"#dddddd\">Без<br>специализ.</th><th bgcolor=\"#dddddd\">40 фут</th>", "TRN_WITHOUT",
			"881", "NIL", "NIL", "NIL", "NIL", "", "40", "NIL"),
		array("<th bgcolor=\"#dddddd\">20 фут</th>", "TRN_WITHOUT",
			"881", "NIL", "NIL", "NIL", "NIL", "", "20", "NIL"),
		
		array("<th colspan=\"3\">Капролактам</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "51", "NIL", "NIL"),
		//array("<th>20 фут</th>", "TRN_LINE",
		//	"881", "NIL", "NIL", "NIL", "NIL", "51", "20", "NIL"),
		
		array("<th colspan=\"3\">Карбамид</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "50", "NIL", "NIL"),
		//array("<th>20 фут</th>", "TRN_LINE",
		//	"881", "NIL", "NIL", "NIL", "NIL", "50", "20", "NIL"),
		
		array("<th colspan=\"3\">Полиамид</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "52", "NIL", "NIL"),
		//array("<th>20 фут</th>", "TRN_LINE",
		//	"881", "NIL", "NIL", "NIL", "NIL", "52", "20", "NIL"),
		
		array("<th colspan=\"3\">Селитра</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "49", "NIL", "NIL"),
		//array("<th>20 фут</th>", "TRN_LINE",
		//	"881", "NIL", "NIL", "NIL", "NIL", "49", "20", "NIL"),
		
		array("<th colspan=\"3\">Сульфат</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "54", "NIL", "NIL"),
		//array("<th>20 фут</th>", "TRN_LINE",
		//	"881", "NIL", "NIL", "NIL", "NIL", "54", "20", "NIL"),
		
		array("<th colspan=\"3\">Ткань кордная</th>", "TRN_LINE",
			"881", "NIL", "NIL", "NIL", "NIL", "53", "NIL", "NIL"),
		//array("<th>20 фут</th>", "TRN_LINE",
		//	"881", "NIL", "NIL", "NIL", "NIL", "53", "20", "NIL"),
		
		//--------
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Контейнера-цистерны</th>", "TRN_HEADER",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\">Без специализ.</th>", "TRN_WITHOUT",
			"880", "NIL", "NIL", "NIL", "NIL", "", "NIL", "NIL"),
		array("<th colspan=\"3\">Ам. вода</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "42", "NIL", "NIL"),
		array("<th rowspan=\"2\" colspan=\"2\">КАС</th><th>соб.</th>", "TRN_LINE",
			"880", "NIL", "NIL", "СОБ", "NIL", "46", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"880", "NIL", "NIL", "ЧУЖ", "NIL", "46", "NIL", "NIL"),
		array("<th colspan=\"3\">Капролактам</th>", "TRN_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "51", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Цистерны</th>", "TRN_HEADER",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		array("<th colspan=\"3\" bgcolor=\"#dddddd\">Без специализ.</th>", "TRN_WITHOUT",
			"21", "NIL", "NIL", "NIL", "NIL", "", "NIL", "NIL"),
		array("<th colspan=\"3\">Ам. вода</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "42", "NIL", "NIL"),
		array("<th rowspan=\"2\" colspan=\"2\">Аммиак</th><th>соб.</th>", "TRN_LINE",
			"21", "NIL", "NIL", "СОБ", "NIL", "41", "NIL", "NIL"),
		array("<th>чуж.</th>", "TRN_LINE",
			"21", "NIL", "NIL", "ЧУЖ", "NIL", "41", "NIL", "NIL"),
		array("<th colspan=\"3\">Аргон</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "44", "NIL", "NIL"),
		array("<th colspan=\"3\">КАС</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "46", "NIL", "NIL"),
		array("<th colspan=\"3\">Масло ПОД</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "55", "NIL", "NIL"),
		array("<th colspan=\"3\">Растворитель СФПК</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "101", "NIL", "NIL"),
		array("<th colspan=\"3\">Циклогексан</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "58", "NIL", "NIL"),
		array("<th colspan=\"3\">Циклогексанол</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "60", "NIL", "NIL"),
		array("<th colspan=\"3\">Циклогексанон</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "59", "NIL", "NIL"),
		array("<th colspan=\"3\">ЩСПК (Щелочной сток)</th>", "TRN_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "43", "NIL", "NIL"),
		//--------
		array("<th colspan=\"3\" bgcolor=\"#cccccc\">Платформы</th>", "TRN_HEADER",
			"23", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
							// ---- RAW ----- \\
		array("<th colspan=\"2\" bgcolor=\"#cccccc\">Итого</th>", "RAW_HEADER",
			"NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"),
		//--------
		array("<th colspan=\"2\">Бензол</th>", "RAW_LINE",
			"NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "45"),
		array("<th colspan=\"2\">Фенол</th>", "RAW_LINE",
			"NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "501"),
		array("<th rowspan=\"2\">Олеум</th><th>Цистерны</th>", "RAW_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "56"),
		array("<th>КЦ</th>", "RAW_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "56"),
		array("<th rowspan=\"2\">Серная<br>кислота</th><th>Цистерны</th>", "RAW_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "57"),
		array("<th>КЦ</th>", "RAW_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "57"),
		array("<th rowspan=\"2\">Натрия<br>гидроксид</th><th>Цистерны</th>", "RAW_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "502"),
		array("<th>КЦ</th>", "RAW_LINE",
			"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "502"),
		array("<th rowspan=\"2\">Магнезит</th><th>Цистерны</th>", "RAW_LINE",
			"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "48"),
		array("<th>Полувагоны</th>", "RAW_LINE",
			"12", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "48"),
		array("<th colspan=\"2\">Прочее</th>", "RAW_LINE",
			"NIL", "NIL", "NIL", "NIL", "CAR", "NIL", "NIL", "666")
	);
	
	// Формирование массива ячеек
	$p = -1;
	for ($i = 0; $i < count($line); $i++) {
		for ($j = 0; $j < 21; $j++) {
			$p++;
			$btype = substr($line[$i][1], 0, 3);
			$ltype = substr($line[$i][1], 4);
			
			$cell[$p][1] = $line[$i][3]; // ORGANIZATION_ID
			$cell[$p][3] = $line[$i][4]; // CAR_WALKING_ID (1 - Экспорт; 4 - Внутренний рынок)
			$cell[$p][5] = $line[$i][6]; // UNIT_TYPE_CODE (CAR/CONT)
			$cell[$p][7] = $line[$i][7]; // CARGO_CATEGORY_ID
			$cell[$p][8] = "0";
			$cell[$p][9] = "0";
			$cell[$p][11] = $line[$i][8]; // UNIT_LENGTH
			$cell[$p][14] = $line[$i][9]; // FCARGO_CATEGORY_ID
			
			if ($btype == "RAW") {
				$cell[$p][0] = $line[$i][2]; // CAR_TYPE_ID
				$cell[$p][13] = "1"; // FWEIGHT_SIGN
				
				// WEIGHT_SIGN (0 - Порожний; 1 - Груженый)
				switch ($j) {
					case 0: case 1: case 2: case 9: case 10: case 11: $cell[$p][2] = "1"; break;
					case 14: case 15: $cell[$p][2] = "0"; break;
					default: $cell[$p][2] = "NIL"; break;
				}
				
				// ACTION_TYPE
				switch ($j) {
					case 3: case 4: case 16: case 17: $cell[$p][6] = "РЕГИСТР"; break;
					case 5: case 6: $cell[$p][6] = "ВЫГР"; break;
					case 7: case 8: $cell[$p][6] = "ПРИЕМ_СОСТ"; break;
					case 12: case 13: $cell[$p][6] = "ПОД_ВЫГР"; break;
					default: $cell[$p][6] = "NIL"; break;
				}
				
				if ($j == 1 || $j == 3 || $j == 5 || $j == 7 ||
					$j == 10 || $j == 12 || $j == 14 || $j == 16) {$cell[$p][4] = "СОБ";}
				else if ($j == 0 || $j == 9) {$cell[$p][4] = "NIL";}
				else {$cell[$p][4] = "ЧУЖ";}
				
				// SQL_NUMBER
				if      ($j >= 0 && $j <= 2)   {$cell[$p][10] = "1";}
				else if ($j >= 3 && $j <= 8)   {$cell[$p][10] = "2";}
				else if ($j >= 9 && $j <= 15)  {$cell[$p][10] = "3";}
				else if ($j >= 16 && $j <= 17) {$cell[$p][10] = "4";}
				else                           {$cell[$p][10] = "NONE";}
				
				// Краткое наименование колонки (для вывода строк в модальном окне)
				switch ($j) {
					case 0: case 1: case 2: case 9: case 10: case 11: $cell[$p][12] = "С_ГРУЖ"; break;
					case 5: case 6: $cell[$p][12] = "С_ВЫГРУЖ"; break;
					case 7: case 8: $cell[$p][12] = "С_СДАНО"; break;
					case 12: case 13: $cell[$p][12] = "С_ПОД_ВЫГР"; break;
					case 14: case 15: $cell[$p][12] = "С_ПОРОЖ"; break;
					default: $cell[$p][12] = "С_ПУСТО"; break;
				}
			} else if ($btype == "TRN") {
				$cell[$p][13] = "NIL"; // FWEIGHT_SIGN
				
				if ($ltype == "HEADER") {
					switch ($j) {
						case 4: case 18: $cell[$p][0] = "0"; break;
						default: $cell[$p][0] = $line[$i][2]; break;}
				} else if ($ltype == "WITHOUT") {
					switch ($j) {
						case 0: case 1: case 9: case 10: case 11: case 12: case 13: case 14: case 15: case 16: case 17: case 20: $cell[$p][0] = $line[$i][2]; break;
						default: $cell[$p][0] = "0"; break;}
				} else if ($ltype == "LINE") {
					switch ($j) {
						case 2: case 3: case 4: case 5: case 18: case 19: $cell[$p][0] = "0"; break;
						default: $cell[$p][0] = $line[$i][2]; break;}
				}
				
				$cell[$p][4] = $line[$i][5]; // CAR_OWNER_SIGN (1 - Собственный; 0 - Чужой)
				
				// WEIGHT_SIGN (0 - Порожний; 1 - Груженый)
				switch ($j) {
					case 1: case 3: case 8: case 9: case 10: case 11: case 12: case 20: $cell[$p][2] = "1"; break;
					case 2: case 5: case 13: case 14: case 15: case 16: case 17: case 19: $cell[$p][2] = "0"; break;
					default: $cell[$p][2] = "NIL"; break;
				}
				
				// ACTION_TYPE
				switch ($j) {
					case 2: case 3: case 19: $cell[$p][6] = "РЕГИСТР"; break;
					case 5: case 8: case 20: $cell[$p][6] = "ПРИЕМ_СОСТ"; break;
					case 6: $cell[$p][6] = "ПОГР"; break;
					case 7: $cell[$p][6] = "ВЫГР"; break;
					case 10: $cell[$p][6] = "СДАЧА"; break;
					case 11: $cell[$p][6] = "С_ДОК"; break;
					case 12: $cell[$p][6] = "СКЛАД"; break;
					case 14: $cell[$p][6] = "ПОД_ПОГР"; break;
					case 15: $cell[$p][6] = "ГОТ_ПОГР"; break;
					case 16: $cell[$p][6] = "В_ОТСТ"; break;
					case 17: $cell[$p][6] = "БРАК"; break;
					default: $cell[$p][6] = "NIL"; break;
				}
				// SQL_NUMBER
				if ($j >= 9 && $j <= 17) {$cell[$p][10] = "3";}
				else if ($j >= 19 && $j <= 20) {$cell[$p][10] = "4";}
				else if ($j >= 0 && $j <= 1) {$cell[$p][10] = "1";}
				else {$cell[$p][10] = "2";}
				// Краткое наименование колонки (для вывода строк в модальном окне)
				switch ($j) {
					case 2: $cell[$p][12] = "ПС_ПРИБ_ПОРОЖ"; break;
					case 3: $cell[$p][12] = "ПС_ПРИБ_ГРУЖ"; break;
					case 5: $cell[$p][12] = "ПС_СДАНО_ПОРОЖ"; break;
					case 8: case 20: $cell[$p][12] = "ПС_ОФОРМ"; break;
					case 6: $cell[$p][12] = "ПС_ПОГРУЖ"; break;
					case 7: $cell[$p][12] = "ПС_ВЫГРУЖ"; break;
					case 9: $cell[$p][12] = "ПС_ГРУЖ_ВСЕГО"; break;
					case 10: $cell[$p][12] = "ПС_ВСДАЧЕ"; break;
					case 11: $cell[$p][12] = "ПС_СДОК"; break;
					case 12: $cell[$p][12] = "ПС_СКЛАД"; break;
					case 13: $cell[$p][12] = "ПС_ПОРОЖ_ВСЕГО"; break;
					case 14: $cell[$p][12] = "ПС_ПОД_ПОГР"; break;
					case 15: $cell[$p][12] = "ПС_ГОТ_ПОГР"; break;
					case 16: $cell[$p][12] = "ПС_В_ОТСТОЕ"; break;
					case 17: $cell[$p][12] = "ПС_БРАК"; break;
					default: $cell[$p][12] = "ПС_ПУСТО"; break;
				}
			}
        }
    }

    //  foreach ($line as $key => $value) {
	//  echo $key . " = " . $value[0] . ", " . $value[1] . ", " . $value[2] . ", " . $value[3] . ", " . $value[4] . ", " . $value[5] . ", " . $value[6] . ", " . $value[7] . 
	//  ", " . $value[8] . ", " . $value[9] . "<br>";
    //  }


	//  $str = '';
	//  $h = 0;
	//  foreach($cell as $key => $val){
	// 	$str .= $h; 
	// 	 foreach($val as  $k => $v){
	// 		$str .= '*'.$v;

	// 		// foreach($v as $i){
	// 		// 	  $str .= $i;
	// 		//  }
	// 	 }
	// 	 $str .= '<br>';
	// 	 $h++;
	// 	}	 
	//  echo $str;

	// foreach ($cell as $key => $value) {
    //   foreach ($value as $k => $v)
    //   {
    //     echo $k . " = " . $v[0] . ", " . $v[1] . ", " . $v[2] . ", " . $v[3] . ", " . $v[4] . ", " . $v[5] . ", " . $v[6] . ", " . $v[7] . "<br>";      }
    // }

// echo "<table>";
// foreach ($cell as $result){
//         echo "<tr>";
//         foreach ($result as $k => $rValue){
//                 echo "<td>".$k." - ".$rValue."</td>";
//         }
//         echo "</tr>";
// }
// echo "</table>";


//print_r ($cell);
	
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

//		echo 'sql-',$sql,':<br>',nl2br($sql_current),'<br>';
		
		$sql_current = "
			SELECT
				COUNT(*) AS CAR_COUNT,
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
		
        echo '<br><b>sql-',$sql,':</b><br>',nl2br($sql_current),'<br>';

        $select = OCIParse($itl_logon, $sql_current);

		$time_start = microtime(true);
		// Выполнение запроса
		OCIExecute($select, OCI_DEFAULT);
		$time_end = microtime(true);
		$time = $time_end - $time_start;
		echo "<br>Время выполнения запроса $sql - $time секунд";

        $rows = OCIFetchStatement($select, $result, 0, -1, OCI_FETCHSTATEMENT_BY_COLUMN + OCI_ASSOC);

        echo "<br>Номер запроса - ".$sql." - ".$rows;
//	print_r( $result);

        //echo "\"" . $sql . "\" selected successfully<br>";
        foreach ($cell as &$value) {
            if ($sql == $value[10] && $value[0] != "0") {
                $count = 0;
                for ($i = 0; $i < $rows; $i++) {
                    //($value[6] == "NIL" || strpos($result["ACTION_TYPE"][$i], $value[6]) !== false)
					if (($value[0] == "NIL"  || $result["CAR_TYPE_ID"][$i]        == $value[0]) &&
                        ($value[1] == "NIL"  || $result["ORGANIZATION_ID"][$i]    == $value[1]) &&
                        ($value[2] == "NIL"  || $result["WEIGHT_SIGN"][$i]        == $value[2]) &&
                        ($value[3] == "NIL"  || $result["CAR_WALKING_ID"][$i]     == $value[3]) &&
                        ($value[4] == "NIL"  || $result["CAR_OWNER_SIGN"][$i]     == $value[4]) &&
                        ($value[5] == "NIL"  || $result["UNIT_TYPE_CODE"][$i]     == $value[5]) &&
                        ($value[7] == "NIL"  || $result["CARGO_CATEGORY_ID"][$i]  == $value[7]) &&
						($value[11] == "NIL" || $result["UNIT_LENGTH"][$i]        == $value[11]) &&
						($value[13] == "NIL" || $result["FWEIGHT_SIGN"][$i]       == $value[13]) &&
						($value[14] == "NIL" || $result["FCARGO_CATEGORY_ID"][$i] == $value[14]) &&
						($value[6] == "NIL"  || $result["ACTION_TYPE"][$i]        == $value[6])
					   ) {$count += $result["CAR_COUNT"][$i];}
				}
				
                $p = $value[10] . "/" . $value[0] . "/" . $value[1] . "/" . $value[2] . "/" . $value[3] ."/" .
					 $value[4] . "/" . $value[5] . "/" . $value[6] . "/" . $value[7] . "/" . $value[11] . "/" .
					 $sql_date_01 . "/" . $sql_date_02 . "/" . $value[12] . "/" . $value[13] . "/" . $value[14];
                
				$value[8] = (($count != 0) ? "<a href=\"javascript:onClick=cellClick('" . $p . "');\">" . $count . "</a>" : "");
				$value[9] = $count;
			}
		}
	}
	unset($sql);
	unset($value);
	OCIFreeStatement($select);
	OCILogOff($itl_logon);

	// echo "<br>With DATA SQL<br>";

	// $str = '';
	// $h = 0;
	// foreach($cell as $key => $val){
	//    $str .= '<b>h='.$h.'</b>'; 
	// 	foreach($val as  $k => $v){
	// 	   $str .= '*'.$v;

	// 	   // foreach($v as $i){
	// 	   // 	  $str .= $i;
	// 	   //  }
	// 	}
	// 	$str .= '<br>';
	// 	$h++;
	//    }	 
	// echo $str;

// echo "<table>";
// foreach ($cell as $result){
//         echo "<tr>";
//         foreach ($result as $k => $rValue){
//                 echo "<td>".$k." - ".$rValue."</td>";
//         }
//         echo "</tr>";
// }
// echo "</table>";

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
					<th colspan="10" bgcolor="#dddddd">На текущие сутки</th>
					<th colspan="2" bgcolor="#dddddd">С начала мес.</th>
				</tr>
				<tr>
					<th colspan="2" bgcolor="#dddddd">Начало суток</th>
					<th colspan="2" bgcolor="#dddddd">Прибыло</th>
					<th rowspan="2" bgcolor="#dddddd">Обес-<br>печ.</th>
					<th rowspan="2" bgcolor="#dddddd">Сдано<br>порож.</th>
					<th rowspan="2" bgcolor="#dddddd">Пог-<br>руж.</th>
					<th rowspan="2" bgcolor="#dddddd">Выг-<br>руж.</th>
					<th rowspan="2" bgcolor="#dddddd">Оформ-<br>лено</th>
					<th colspan="4" bgcolor="#dddddd">Груженые</th>
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
					<th bgcolor="#dddddd">Всего</th>
					<th bgcolor="#dddddd">п/п</th>
					<th bgcolor="#dddddd">Гот. п/п</th>
					<th bgcolor="#dddddd">В отс.</th>
					<th bgcolor="#dddddd">Брак</th>
				</tr>
<?php
    $p = 0;
    $count = count($line);
	$rawMarker = "0";
    for ($i = 0; $i < $count; $i++) {
		$btype = substr($line[$i][1], 0, 3);
		$ltype = substr($line[$i][1], 4);
		
		$result = "";
		for ($j = 0; $j < count($cell) / $count; $j++) {
			if ($btype == "TRN") {
				//-----------
				if ($j == 4 && $ltype == "HEADER") {
					$calc = $cell[$p - 4][9] + $cell[$p - 2][9] + $cell[$p - 1][9];
					$cell[$p][8] = $calc;
					$cell[$p][9] = $calc;} // Обеспечение
				else if ($j == 18) {
					$calc = $cell[$p - 9][9] + $cell[$p - 5][9];
					$cell[$p][8] = ($calc == 0) ? "" : $calc;
					$cell[$p][9] = $calc;} // Итого (на тек. сутки)
				
				if (($i == 13 || $i == 25) ||
					(($ltype == "LINE") && ($j == 0 || $j == 1)) ||
					(($ltype == "LINE") && ($j == 9 || $j == 13)) ||
					($ltype == "WITHOUT" && $cell[$p][8] != "0")) {$color = "bgcolor=\"#dddddd\"";}
				else if ($ltype == "HEADER") {$color = "bgcolor=\"#cccccc\"";}
				else {$color = "";}
				//-----------
			} else if ($btype == "RAW") {
				//-----------
				if ($rawMarker == "0") {
					echo "
							</tbody>
						</table>
						<hr>
						<table id=\"ReportTable02\">
							<tr>
								<th colspan=\"2\" rowspan=\"3\">Выгрузка</th>
								<th colspan=\"9\" bgcolor=\"#dddddd\">За прошедшие сутки</th>
								<th colspan=\"7\" bgcolor=\"#dddddd\">На текущие сутки</th>
								<th colspan=\"2\" rowspan=\"2\" bgcolor=\"#dddddd\">Подано с<br>нач. месяца</th>
							</tr>
							<tr>
								<th colspan=\"3\" bgcolor=\"#dddddd\">Начало суток груж.</th>
								<th colspan=\"2\" bgcolor=\"#dddddd\">Подано</th>
								<th colspan=\"2\" bgcolor=\"#dddddd\">Выгружено</th>
								<th colspan=\"2\" bgcolor=\"#dddddd\">Сдано</th>
								<th colspan=\"3\" bgcolor=\"#dddddd\">Груженые</th>
								<th colspan=\"2\" bgcolor=\"#dddddd\">Под выгрузкой</th>
								<th colspan=\"2\" bgcolor=\"#dddddd\">Порожние</th>
							</tr>
							<tr>
								<th bgcolor=\"#dddddd\">Всего</th>
								<th bgcolor=\"#dddddd\">соб.</th>
								<th bgcolor=\"#dddddd\">чуж.</th>
								<th bgcolor=\"#dddddd\">соб.</th>
								<th bgcolor=\"#dddddd\">чуж.</th>
								<th bgcolor=\"#dddddd\">соб.</th>
								<th bgcolor=\"#dddddd\">чуж.</th>
								<th bgcolor=\"#dddddd\">соб.</th>
								<th bgcolor=\"#dddddd\">чуж.</th>
								<th bgcolor=\"#dddddd\">Всего</th>
								<th bgcolor=\"#dddddd\">соб.</th>
								<th bgcolor=\"#dddddd\">чуж.</th>
								<th bgcolor=\"#dddddd\">соб.</th>
								<th bgcolor=\"#dddddd\">чуж.</th>
								<th bgcolor=\"#dddddd\">соб.</th>
								<th bgcolor=\"#dddddd\">чуж.</th>
								<th bgcolor=\"#dddddd\">соб.</th>
								<th bgcolor=\"#dddddd\">чуж.</th>
							</tr>
						";
					$rawMarker = "1";
				}
				//-----------
				if ($ltype == "HEADER") {$color = "bgcolor=\"#cccccc\"";}
				else if ($j == 0 || $j == 1 || $j == 2 || $j == 9 || $j == 10 || $j == 11) {$color = "bgcolor=\"#dddddd\"";}
				else {$color = "";}
				//-----------
			}
			
			if ($i == 0 && ($j == 9 || $j == 13)) {$csumm = "class=\"csumm\"";} else {$csumm = "";}
			
			if ($btype == "RAW" && $j >= 18) {
				$result .= "";
			} else {
				$result .= "<td " . $color . " " . $csumm . ">" . (($cell[$p][8] == "0") ? "" : $cell[$p][8]) . " (".$cell[$p][10]. ")</td>";
			}
			
			$p++;
		}

		echo "<tr>" . $line[$i][0] . $result . "</tr>";
    }
?>
		</table>
	</div>