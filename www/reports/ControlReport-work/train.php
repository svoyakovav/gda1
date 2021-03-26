<?php
//2018-03-26 elt исключение из строки Прочее контейнеров и платформ №373

// Объявление массивов ячеек и строк
$cell = array();
$line = array(
	array(
		"<th colspan=\"3\" bgcolor=\"#A7CEF6\">Общее количество</th>", "TRN_HEADER",
		"NIL", "NIL", "NIL", "NIL", "CAR", "NIL", "NIL", "NIL"
	),
	//--------
	array(
		"<th colspan=\"3\" bgcolor=\"#FADCBD\">Крытые</th>", "TRN_TYPE",
		"20", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),

	array(
		"<th colspan=\"2\" rowspan=\"2\" bgcolor=\"#CCF5D4\">Без специализ.</th><th bgcolor=\"#CCF5D4\">РФ</th>", "TRN_WITHOUT",
		"20", "", "4", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th bgcolor=\"#CCF5D4\">ЭКСП</th>", "TRN_WITHOUT",
		"20", "", "1", "NIL", "NIL", "NIL", "NIL", "NIL"
	),

	array(
		"<th colspan=\"2\" rowspan=\"2\">203</th><th>РФ</th>", "TRN_LINE",
		"20", "195", "4", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th>ЭКСП</th>", "TRN_LINE",
		"20", "195", "1", "NIL", "NIL", "NIL", "NIL", "NIL"
	),

	array(
		"<th colspan=\"2\" rowspan=\"2\">204</th><th>РФ</th>", "TRN_LINE",
		"20", "196", "4", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th>ЭКСП</th>", "TRN_LINE",
		"20", "196", "1", "NIL", "NIL", "NIL", "NIL", "NIL"
	),

	array(
		"<th colspan=\"2\" rowspan=\"2\">325</th><th>РФ</th>", "TRN_LINE",
		"20", "201", "4", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th>ЭКСП</th>", "TRN_LINE",
		"20", "201", "1", "NIL", "NIL", "NIL", "NIL", "NIL"
	),

	array(
		"<th colspan=\"3\">470</th>", "TRN_LINE",
		"20", "516", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	//--------
	array(
		"<th colspan=\"3\" bgcolor=\"#FADCBD\">Полувагоны</th>", "TRN_TYPE",
		"12", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th colspan=\"3\" bgcolor=\"#CCF5D4\">Без специализ.</th>", "TRN_WITHOUT",
		"12", "", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th rowspan=\"3\">203</th><th colspan=\"2\">соб.</th>", "TRN_LINE",
		"12", "195", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th colspan=\"2\">соб. склад</th>", "TRN_LINE",
		"12", "195", "NIL", "ССКЛ", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th colspan=\"2\">ЧУЖ</th>", "TRN_LINE",
		"12", "195", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"
	),

	array(
		"<th colspan=\"1\" rowspan=\"2\">323</th><th colspan=\"2\">соб.</th>", "TRN_LINE",
		"12", "199", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th colspan=\"2\">ЧУЖ</th>", "TRN_LINE",
		"12", "199", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"
	),

	array(
		"<th rowspan=\"5\">Сульфат</th><th colspan=\"2\" bgcolor=\"#F9F9B3\">Общие</th>", "TRN_LINE",
		"12", "NIL", "NIL", "NIL", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th rowspan=\"2\">325</th><th>соб.</th>", "TRN_LINE",
		"12", "201", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"12", "201", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th rowspan=\"2\">337</th><th>соб.</th>", "TRN_LINE",
		"12", "204", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"12", "204", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"
	),
	// array(
	// 	"<th colspan=\"2\">925</th>", "TRN_LINE",
	// 	"12", "1236", "NIL", "NIL", "NIL", "54", "NIL", "NIL"
	// ),
	//--------
	array(
		"<th colspan=\"3\" bgcolor=\"#FADCBD\">Минераловозы</th>", "TRN_TYPE",
		"15", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th colspan=\"3\" bgcolor=\"#CCF5D4\">Без специализ.</th>", "TRN_WITHOUT",
		"15", "", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th rowspan=\"2\" colspan=\"2\">203</th><th>соб.</th>", "TRN_LINE",
		"15", "195", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"15", "195", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th rowspan=\"2\" colspan=\"2\">204</th><th>соб.</th>", "TRN_LINE",
		"15", "196", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"15", "196", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th rowspan=\"6\">Сульфат</th><th rowspan=\"2\" bgcolor=\"#F9F9B3\">Общие</th><th bgcolor=\"#F9F9B3\">соб.</th>", "TRN_LINE",
		"15", "NIL", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th bgcolor=\"#F9F9B3\">чуж.</th>", "TRN_LINE",
		"15", "NIL", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th rowspan=\"2\">325</th><th>соб.</th>", "TRN_LINE",
		"15", "201", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"15", "201", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th rowspan=\"2\">337</th><th>соб.</th>", "TRN_LINE",
		"15", "204", "NIL", "СОБ", "NIL", "54", "NIL", "NIL"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"15", "204", "NIL", "ЧУЖ", "NIL", "54", "NIL", "NIL"
	),
	// array(
	// 	"<th colspan=\"2\">925</th>", "TRN_LINE",
	// 	"15", "1236", "NIL", "NIL", "NIL", "54", "NIL", "NIL"
	// ),
	//--------
	array(
		"<th colspan=\"2\" rowspan=\"2\" bgcolor=\"#19E622\">Платформы</th><th bgcolor=\"#19E622\">СОБ</th>", "TRN_HEADER",
		"23", "NIL", "NIL", "СОБ", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th bgcolor=\"#19E622\">ЧУЖ</th>", "TRN_HEADER",
		"23", "NIL", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "NIL"
	),
	//--------
	array(
		"<th colspan=\"3\" bgcolor=\"#FADCBD\">Контейнера</th>", "TRN_TYPE",
		"881", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th colspan=\"2\" rowspan=\"2\" bgcolor=\"#CCF5D4\">Без<br>специализ.</th><th bgcolor=\"#CCF5D4\">40 фут</th>", "TRN_WITHOUT",
		"881", "NIL", "NIL", "NIL", "NIL", "", "40", "NIL"
	),
	array(
		"<th bgcolor=\"#CCF5D4\">20 фут</th>", "TRN_WITHOUT",
		"881", "NIL", "NIL", "NIL", "NIL", "", "20", "NIL"
	),

	array(
		"<th colspan=\"2\" rowspan=\"2\">Карбамид</th><th>40 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "50", "40", "NIL"
	),
	array(
		"<th>20 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "50", "20", "NIL"
	),

	array(
		"<th colspan=\"2\" rowspan=\"2\">Селитра</th><th>40 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "49", "40", "NIL"
	),
	array(
		"<th>20 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "49", "20", "NIL"
	),

	array(
		"<th colspan=\"2\" rowspan=\"2\">Сульфат</th><th>40 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "54", "40", "NIL"
	),
	array(
		"<th>20 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "54", "20", "NIL"
	),

	array(
		"<th colspan=\"2\" rowspan=\"2\">Капролактам</th><th>40 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "51", "40", "NIL"
	),
	array(
		"<th>20 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "51", "20", "NIL"
	),
	//array("<th>20 фут</th>", "TRN_LINE",
	//	"881", "NIL", "NIL", "NIL", "NIL", "51", "20", "NIL"),

	//array("<th>20 фут</th>", "TRN_LINE",
	//	"881", "NIL", "NIL", "NIL", "NIL", "50", "20", "NIL"),

	array(
		"<th colspan=\"2\" rowspan=\"2\">Полиамид</th><th>40 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "52", "40", "NIL"
	),
	array(
		"<th>20 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "52", "20", "NIL"
	),
	//array("<th>20 фут</th>", "TRN_LINE",
	//	"881", "NIL", "NIL", "NIL", "NIL", "52", "20", "NIL"),

	//array("<th>20 фут</th>", "TRN_LINE",
	//	"881", "NIL", "NIL", "NIL", "NIL", "49", "20", "NIL"),

	//array("<th>20 фут</th>", "TRN_LINE",
	//	"881", "NIL", "NIL", "NIL", "NIL", "54", "20", "NIL"),

	array(
		"<th colspan=\"2\" rowspan=\"2\">Ткань кордная</th><th>40 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "53", "40", "NIL"
	),
	array(
		"<th>20 фут</th>", "TRN_LINE",
		"881", "NIL", "NIL", "NIL", "NIL", "53", "20", "NIL"
	),
	//array("<th>20 фут</th>", "TRN_LINE",
	//	"881", "NIL", "NIL", "NIL", "NIL", "53", "20", "NIL"),

	//--------
	array(
		"<th colspan=\"3\" bgcolor=\"#FADCBD\">Контейнера-цистерны</th>", "TRN_TYPE",
		"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th colspan=\"3\" bgcolor=\"#CCF5D4\">Без специализ.</th>", "TRN_WITHOUT",
		"880", "NIL", "NIL", "NIL", "NIL", "", "NIL", "NIL"
	),
	// array(
	// 	"<th colspan=\"3\">Ам. вода</th>", "TRN_LINE",
	// 	"880", "NIL", "NIL", "NIL", "NIL", "42", "NIL", "NIL"
	// ),
	array(
		"<th rowspan=\"2\" colspan=\"2\">КАС</th><th>соб.</th>", "TRN_LINE",
		"880", "NIL", "NIL", "СОБ", "NIL", "46", "NIL", "NIL"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"880", "NIL", "NIL", "ЧУЖ", "NIL", "46", "NIL", "NIL"
	),
	array(
		"<th colspan=\"2\">Капролактам</th><th>ЧУЖ</th>", "TRN_LINE",
		"880", "NIL", "NIL", "ЧУЖ", "NIL", "51", "NIL", "NIL"
	),
	//-------
	array(
		"<th colspan=\"3\" bgcolor=\"#FADCBD\">Цистерны</th>", "TRN_TYPE",
		"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	),
	array(
		"<th colspan=\"3\" bgcolor=\"#CCF5D4\">Складские (с истекшим сроком)</th>", "TRN_WITHOUT",
		"21", "NIL", "NIL", "NIL", "NIL", "", "NIL", "NIL"
	),
	array(
		"<th colspan=\"3\" bgcolor=\"#CCF5D4\">Без специализ. годные</th>", "TRN_WITHOUT",
		"21", "NIL", "NIL", "NIL", "NIL", "", "NIL", "NIL"
	),
	array(
		"<th colspan=\"3\">Ам. вода</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "42", "NIL", "NIL"
	),

	array(
		"<th rowspan=\"2\" colspan=\"2\">Аммиак</th><th>СОБ</th>", "TRN_LINE",
		"21", "NIL", "NIL", "СОБ", "NIL", "41", "NIL", "NIL"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"21", "NIL", "NIL", "ЧУЖ", "NIL", "41", "NIL", "NIL"
	),

	array(
		"<th colspan=\"3\">Аргон</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "44", "NIL", "NIL"
	),

	array(
		"<th rowspan=\"2\" colspan=\"2\">Бензол</th><th>СОБ</th>", "TRN_LINE",
		"21", "NIL", "NIL", "СОБ", "NIL", "NIL", "NIL", "45"
	),
	array(
		"<th>ЧУЖ</th>", "TRN_LINE",
		"21", "NIL", "NIL", "ЧУЖ", "NIL", "NIL", "NIL", "45"
	),

	array(
		"<th colspan=\"3\">КАС</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "46", "NIL", "NIL"
	),

	array(
		"<th colspan=\"3\">Магнезит</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "48"
	),

	array(
		"<th colspan=\"3\">Масло ПОД</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "55", "NIL", "NIL"
	),

	array(
		"<th rowspan=\"2\">Олеум</th><th colspan=\"2\">КЦ</th>", "TRN_LINE",
		"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "56"
	),
	array(
		"<th colspan=\"2\">Цист</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "56"
	),

	array(
		"<th colspan=\"3\">Растворитель СФПК</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "101", "NIL", "NIL"
	),

	array(
		"<th rowspan=\"2\">Серная<br>кислота</th><th colspan=\"2\">КЦ</th>", "TRN_LINE",
		"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "57"
	),
	array(
		"<th colspan=\"2\">Цист</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "57"
	),

	array(
		"<th colspan=\"3\">Циклогексан</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "58", "NIL", "NIL"
	),
	array(
		"<th colspan=\"3\">Циклогексанол</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "60", "NIL", "NIL"
	),
	array(
		"<th colspan=\"3\">Циклогексанон</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "59", "NIL", "NIL"
	),

	array(
		"<th rowspan=\"2\">Фенол</th><th colspan=\"2\">КЦ</th>", "TRN_LINE",
		"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "501"
	),
	array(
		"<th colspan=\"2\">Цист</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "501"
	),

	array(
		"<th colspan=\"3\">ЩСПК (Щелочной сток)</th>", "TRN_LINE",
		"21", "NIL", "NIL", "NIL", "NIL", "43", "NIL", "NIL"
	),
	//--------

	// ---- RAW ----- \\
	// array(
	// 	"<th colspan=\"2\" bgcolor=\"#cccccc\">Итого</th>", "TRN_HEADER",
	// 	"NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL"
	// ),
	//--------
	// array(
	// 	"<th colspan=\"3\">Бензол</th>", "TRN_LINE",
	// 	"NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "45"
	// ),


	// array(
	// 	"<th rowspan=\"2\">Натрия<br>гидроксид</th><th colspan=\"2\">Цистерны</th>", "TRN_LINE",
	// 	"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "502"
	// ),
	// array(
	// 	"<th colspan=\"2\">КЦ</th>", "TRN_LINE",
	// 	"880", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "502"
	// ),
	// array(
	// 	"<th rowspan=\"2\">Магнезит</th><th colspan=\"2\">Цистерны</th>", "TRN_LINE",
	// 	"21", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "48"
	// ),
	// array(
	// 	"<th colspan=\"2\">Полувагоны</th>", "TRN_LINE",
	// 	"12", "NIL", "NIL", "NIL", "NIL", "NIL", "NIL", "48"
	// ),
	// array(
	// 	"<th colspan=\"3\">Прочее</th>", "TRN_LINE",
	// 	"NIL", "NIL", "NIL", "NIL", "CAR", "NIL", "NIL", "666"
	// )
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
		$cell[$p][4] = $line[$i][5]; // CAR_OWNER_SIGN (1 - Собственный; 0 - Чужой)
		$cell[$p][5] = $line[$i][6]; // UNIT_TYPE_CODE (CAR/CONT)
		$cell[$p][7] = $line[$i][7]; // CARGO_CATEGORY_ID
		$cell[$p][8] = "0";
		$cell[$p][9] = "0";
		$cell[$p][11] = $line[$i][8]; // UNIT_LENGTH
		$cell[$p][13] = "NIL"; // FWEIGHT_SIGN
		$cell[$p][14] = $line[$i][9]; // FCARGO_CATEGORY_ID



		if (($ltype == "HEADER") || ($ltype == "TYPE")) {
			switch ($j) {
				case 4:
				case 9:
					$cell[$p][0] = "0";
					break;
				default:
					$cell[$p][0] = $line[$i][2];
					break;
			}
		} else if ($ltype == "WITHOUT") {
			switch ($j) {
				case 0:
				case 1:
				case 10:
				case 11:
				case 12:
				case 13:
				case 14:
				case 15:
				case 16:
				case 17:
				case 18:
				case 20:
					$cell[$p][0] = $line[$i][2];
					break;
				default:
					$cell[$p][0] = "0";
					break;
			}
		} else if ($ltype == "LINE") {
			switch ($j) {
				case 2:
				case 3:
				case 4:
				case 5:
				case 9:
				case 19:
					$cell[$p][0] = "0";
					break;
				default:
					$cell[$p][0] = $line[$i][2];
					break;
			}
		}

		// WEIGHT_SIGN (0 - Порожний; 1 - Груженый)
		switch ($j) {
			case 1:
			case 3:
			case 8:
			case 10:
			case 11:
			case 12:
			case 13:
			case 20:
				$cell[$p][2] = "1";
				break;
			case 2:
			case 5:
			case 14:
			case 15:
			case 16:
			case 17:
			case 18:
			case 19:
				$cell[$p][2] = "0";
				break;
			default:
				$cell[$p][2] = "NIL";
				break;
		}

		// ACTION_TYPE
		switch ($j) {
			case 2:
			case 3:
			case 19:
				$cell[$p][6] = "РЕГИСТР";
				break;
			case 5:
			case 8:
			case 20:
				$cell[$p][6] = "ПРИЕМ_СОСТ";
				break;
			case 6:
				$cell[$p][6] = "ПОГР";
				break;
			case 7:
				$cell[$p][6] = "ВЫГР";
				break;
			case 11:
				$cell[$p][6] = "СДАЧА";
				break;
			case 12:
				$cell[$p][6] = "С_ДОК";
				break;
			case 13:
				$cell[$p][6] = "СКЛАД";
				break;
			case 15:
				$cell[$p][6] = "ПОД_ПОГР";
				break;
			case 16:
				$cell[$p][6] = "ГОТ_ПОГР";
				break;
			case 17:
				$cell[$p][6] = "В_ОТСТ";
				break;
			case 18:
				$cell[$p][6] = "БРАК";
				break;
			default:
				$cell[$p][6] = "NIL";
				break;
		}
		// SQL_NUMBER
		if ($j >= 10 && $j <= 18) {
			$cell[$p][10] = "3";
		} else if ($j >= 19 && $j <= 20) {
			$cell[$p][10] = "4";
		} else if ($j >= 0 && $j <= 1) {
			$cell[$p][10] = "1";
		} else {
			$cell[$p][10] = "2";
		}
		// Краткое наименование колонки (для вывода строк в модальном окне)
		switch ($j) {
			case 2:
				$cell[$p][12] = "ПС_ПРИБ_ПОРОЖ";
				break;
			case 3:
				$cell[$p][12] = "ПС_ПРИБ_ГРУЖ";
				break;
			case 5:
				$cell[$p][12] = "ПС_СДАНО_ПОРОЖ";
				break;
			case 8:
			case 20:
				$cell[$p][12] = "ПС_ОФОРМ";
				break;
			case 6:
				$cell[$p][12] = "ПС_ПОГРУЖ";
				break;
			case 7:
				$cell[$p][12] = "ПС_ВЫГРУЖ";
				break;
			case 10:
				$cell[$p][12] = "ПС_ГРУЖ_ВСЕГО";
				break;
			case 11:
				$cell[$p][12] = "ПС_ВСДАЧЕ";
				break;
			case 12:
				$cell[$p][12] = "ПС_СДОК";
				break;
			case 13:
				$cell[$p][12] = "ПС_СКЛАД";
				break;
			case 14:
				$cell[$p][12] = "ПС_ПОРОЖ_ВСЕГО";
				break;
			case 15:
				$cell[$p][12] = "ПС_ПОД_ПОГР";
				break;
			case 16:
				$cell[$p][12] = "ПС_ГОТ_ПОГР";
				break;
			case 17:
				$cell[$p][12] = "ПС_В_ОТСТОЕ";
				break;
			case 18:
				$cell[$p][12] = "ПС_БРАК";
				break;
			default:
				$cell[$p][12] = "ПС_ПУСТО";
				break;
		}
	}
}
/*foreach ($line as $key => $value) {
    echo $key . " = " . $value[0] . ", " . $value[1] . ", " . $value[2] . ", " . $value[3] . ", " . $value[4] . ", " . $value[5] . ", " . $value[6] . ", " . $value[7] . "<br>";
    }*/

// Расчет массива ячеек
foreach (array("1", "2", "3", "4") as $sql) {
	switch ($sql) {
		case "1":
			$sql_current = $sql_script01;
			$sql_date_01 = $PreviousDate;
			$sql_date_02 = "";
			break;
		case "3":
			$sql_current = $sql_script03;
			$sql_date_01 = $SetDate;
			$sql_date_02 = "";
			break;
		case "2":
			$sql_current = $sql_script02;
			$sql_date_01 = $PreviousDate;
			$sql_date_02 = $SetYesTodayDate;
			break;
		case "4":
			$sql_current = $sql_script02;
			$sql_date_01 = $BeginMonth;
			$sql_date_02 = $SetDate;
			break;
	}

	$sql_current = str_replace(":pDate",      "'" . $sql_date_01 . "'", $sql_current);
	$sql_current = str_replace(":pStartDate", "'" . $sql_date_01 . "'", $sql_current);
	$sql_current = str_replace(":pEndDate",   "'" . $sql_date_02 . "'", $sql_current);

	$sql_current = "
			SELECT
				" . $sql . " AS SQL_TYPE,
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
	switch ($sql) {
		case 4:
			$sql_current_all =	$sql_current_all . $sql_current;
			break;
		default:
			$sql_current_all =	$sql_current_all . $sql_current . " UNION ALL ";
			break;
	}
}

//echo '<br><b>sql-',$sql,':</b><br>',nl2br($sql_current_all),'<br>';

$select = OCIParse($itl_logon, $sql_current_all);

$time_start = microtime(true);
// Выполнение запроса
OCIExecute($select, OCI_DEFAULT);
$time_end = microtime(true);
$time = $time_end - $time_start;
echo "<br>Запрос - $time с., ";

$rows = OCIFetchStatement($select, $result, 0, -1, OCI_FETCHSTATEMENT_BY_COLUMN + OCI_ASSOC);

for ($i = 0; $i < $rows; $i++) {
	//($value[6] == "NIL" || strpos($result["ACTION_TYPE"][$i], $value[6]) !== false)
	switch ($result["SQL_TYPE"][$i]) {
		case 1:
			$c1 = $i;
			break;
		case 2:
			$c2 = $i;
			break;
		case 3:
			$c3 = $i;
			break;
		case 4:
			break;
	}
}

$time_start = microtime(true);
//print_r($result["SQL_TYPE"]);
foreach ($cell as &$value) {
	//		if ($sql == $value[10] && $value[0] != "0") {
	$count = 0;
	switch ($value[10]) {
		case 1:
			for ($i = 0; $i < $c1; $i++) {
				//($value[6] == "NIL" || strpos($result["ACTION_TYPE"][$i], $value[6]) !== false)
				if (($result["SQL_TYPE"][$i]        == $value[10]) && ($value[0] == "NIL"  || $result["CAR_TYPE_ID"][$i]        == $value[0]) && ($value[1] == "NIL"  || $result["ORGANIZATION_ID"][$i]    == $value[1]) && ($value[2] == "NIL"  || $result["WEIGHT_SIGN"][$i]        == $value[2]) && ($value[3] == "NIL"  || $result["CAR_WALKING_ID"][$i]     == $value[3]) && ($value[4] == "NIL"  || $result["CAR_OWNER_SIGN"][$i]     == $value[4]) && ($value[5] == "NIL"  || $result["UNIT_TYPE_CODE"][$i]     == $value[5]) && ($value[7] == "NIL"  || $result["CARGO_CATEGORY_ID"][$i]  == $value[7]) && ($value[11] == "NIL" || $result["UNIT_LENGTH"][$i]        == $value[11]) && ($value[13] == "NIL" || $result["FWEIGHT_SIGN"][$i]       == $value[13]) && ($value[14] == "NIL" || $result["FCARGO_CATEGORY_ID"][$i] == $value[14]) && ($value[6] == "NIL"  || $result["ACTION_TYPE"][$i]        == $value[6])
				) {
					$count += $result["CAR_COUNT"][$i];
				}
			}
			break;
			case 2:
			for ($i = $c1; $i < $c2; $i++) {
				//($value[6] == "NIL" || strpos($result["ACTION_TYPE"][$i], $value[6]) !== false)
				if (($result["SQL_TYPE"][$i]        == $value[10]) && ($value[0] == "NIL"  || $result["CAR_TYPE_ID"][$i]        == $value[0]) && ($value[1] == "NIL"  || $result["ORGANIZATION_ID"][$i]    == $value[1]) && ($value[2] == "NIL"  || $result["WEIGHT_SIGN"][$i]        == $value[2]) && ($value[3] == "NIL"  || $result["CAR_WALKING_ID"][$i]     == $value[3]) && ($value[4] == "NIL"  || $result["CAR_OWNER_SIGN"][$i]     == $value[4]) && ($value[5] == "NIL"  || $result["UNIT_TYPE_CODE"][$i]     == $value[5]) && ($value[7] == "NIL"  || $result["CARGO_CATEGORY_ID"][$i]  == $value[7]) && ($value[11] == "NIL" || $result["UNIT_LENGTH"][$i]        == $value[11]) && ($value[13] == "NIL" || $result["FWEIGHT_SIGN"][$i]       == $value[13]) && ($value[14] == "NIL" || $result["FCARGO_CATEGORY_ID"][$i] == $value[14]) && ($value[6] == "NIL"  || $result["ACTION_TYPE"][$i]        == $value[6])
				) {
					$count += $result["CAR_COUNT"][$i];
				}
			}
			break;
			case 3:
			for ($i = $c2; $i < $c3; $i++) {
				//($value[6] == "NIL" || strpos($result["ACTION_TYPE"][$i], $value[6]) !== false)
				if (($result["SQL_TYPE"][$i]        == $value[10]) && ($value[0] == "NIL"  || $result["CAR_TYPE_ID"][$i]        == $value[0]) && ($value[1] == "NIL"  || $result["ORGANIZATION_ID"][$i]    == $value[1]) && ($value[2] == "NIL"  || $result["WEIGHT_SIGN"][$i]        == $value[2]) && ($value[3] == "NIL"  || $result["CAR_WALKING_ID"][$i]     == $value[3]) && ($value[4] == "NIL"  || $result["CAR_OWNER_SIGN"][$i]     == $value[4]) && ($value[5] == "NIL"  || $result["UNIT_TYPE_CODE"][$i]     == $value[5]) && ($value[7] == "NIL"  || $result["CARGO_CATEGORY_ID"][$i]  == $value[7]) && ($value[11] == "NIL" || $result["UNIT_LENGTH"][$i]        == $value[11]) && ($value[13] == "NIL" || $result["FWEIGHT_SIGN"][$i]       == $value[13]) && ($value[14] == "NIL" || $result["FCARGO_CATEGORY_ID"][$i] == $value[14]) && ($value[6] == "NIL"  || $result["ACTION_TYPE"][$i]        == $value[6])
				) {
					$count += $result["CAR_COUNT"][$i];
				}
			}
			break;
			case 4:
			for ($i = $c3; $i < $rows; $i++) {
				//($value[6] == "NIL" || strpos($result["ACTION_TYPE"][$i], $value[6]) !== false)
				if (($result["SQL_TYPE"][$i]        == $value[10]) && ($value[0] == "NIL"  || $result["CAR_TYPE_ID"][$i]        == $value[0]) && ($value[1] == "NIL"  || $result["ORGANIZATION_ID"][$i]    == $value[1]) && ($value[2] == "NIL"  || $result["WEIGHT_SIGN"][$i]        == $value[2]) && ($value[3] == "NIL"  || $result["CAR_WALKING_ID"][$i]     == $value[3]) && ($value[4] == "NIL"  || $result["CAR_OWNER_SIGN"][$i]     == $value[4]) && ($value[5] == "NIL"  || $result["UNIT_TYPE_CODE"][$i]     == $value[5]) && ($value[7] == "NIL"  || $result["CARGO_CATEGORY_ID"][$i]  == $value[7]) && ($value[11] == "NIL" || $result["UNIT_LENGTH"][$i]        == $value[11]) && ($value[13] == "NIL" || $result["FWEIGHT_SIGN"][$i]       == $value[13]) && ($value[14] == "NIL" || $result["FCARGO_CATEGORY_ID"][$i] == $value[14]) && ($value[6] == "NIL"  || $result["ACTION_TYPE"][$i]        == $value[6])
				) {
					$count += $result["CAR_COUNT"][$i];
				}
			}
			break;
	}

	switch ($value[10]) {
		case "1":
			$sql_date_01 = $PreviousDate;
			$sql_date_02 = "";
			break;
		case "3":
			$sql_date_01 = $SetDate;
			$sql_date_02 = "";
			break;
		case "2":
			$sql_date_01 = $PreviousDate;
			$sql_date_02 = $SetYesTodayDate;
			break;
		case "4":
			$sql_date_01 = $BeginMonth;
			$sql_date_02 = $SetDate;
			break;
	}

	$p = $value[10] . "/" . $value[0] . "/" . $value[1] . "/" . $value[2] . "/" . $value[3] . "/" .
		$value[4] . "/" . $value[5] . "/" . $value[6] . "/" . $value[7] . "/" . $value[11] . "/" .
		$sql_date_01 . "/" . $sql_date_02 . "/" . $value[12] . "/" . $value[13] . "/" . $value[14];

	$value[8] = (($count != 0) ? "<a href=\"javascript:onClick=cellClick('" . $p . "');\">" . $count . "</a>" : "");
	$value[9] = $count;
}
//	}

$time_end = microtime(true);
$time = $time_end - $time_start;
echo "Массив - $time с.";

unset($sql);
unset($value);
OCIFreeStatement($select);
OCILogOff($itl_logon);
?>
<!-- Таблица -->
<div align="center" id="body-page">
	<hr>
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
				<th rowspan="3" colspan="3">
					<div style="width: 145px;">Подвижной<br>состав</div>
				</th>
				<th colspan="9" bgcolor="#CFEDF7">За прошедшие сутки</th>
				<th colspan="10" bgcolor="#F5D6D8">На текущие сутки</th>
				<th colspan="2" bgcolor="#dddddd">С начала мес.</th>
			</tr>
			<tr>
				<th colspan="2" bgcolor="#CFEDF7">Начало суток</th>
				<th colspan="2" bgcolor="#CFEDF7">Прибыло</th>
				<th rowspan="2" bgcolor="#CFEDF7">Обес-<br>печ.</th>
				<th rowspan="2" bgcolor="#CFEDF7">Сдано<br>порож.</th>
				<th rowspan="2" bgcolor="#CFEDF7">Пог-<br>руж.</th>
				<th rowspan="2" bgcolor="#CFEDF7">Выг-<br>руж.</th>
				<th rowspan="2" bgcolor="#CFEDF7">Оформ-<br>лено</th>
				<th rowspan="2" bgcolor="#F5D6D8">Итого</th>
				<th colspan="4" bgcolor="#F5D6D8">Груженые</th>
				<th colspan="5" bgcolor="#F5D6D8">Порожние</th>
				<th rowspan="2" bgcolor="#dddddd">При-<br>было</th>
				<th rowspan="2" bgcolor="#dddddd">Оформ-<br>лено</th>
			</tr>
			<tr>
				<th bgcolor="#CFEDF7">Всего</th>
				<th bgcolor="#CFEDF7">Груж.</th>
				<th bgcolor="#CFEDF7">Порож.</th>
				<th bgcolor="#CFEDF7">Груж.</th>
				<th bgcolor="#F5D6D8">Всего</th>
				<th bgcolor="#F5D6D8">В сдаче</th>
				<th bgcolor="#F5D6D8">С док.</th>
				<th bgcolor="#F5D6D8">Склад</th>
				<th bgcolor="#F5D6D8">Всего</th>
				<th bgcolor="#F5D6D8">п/п</th>
				<th bgcolor="#F5D6D8">Гот. п/п</th>
				<th bgcolor="#F5D6D8">В отс.</th>
				<th bgcolor="#F5D6D8">Брак</th>
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
					//-----------
					// if ($j == 9) {
					// 	$color = "bgcolor=\"#FCCFCF\"";
					// } 

					if ($j == 4 && ($ltype == "HEADER" || $ltype == "TYPE")) {
						$calc = $cell[$p - 4][9] + $cell[$p - 2][9] + $cell[$p - 1][9];
						$cell[$p][8] = $calc;
						$cell[$p][9] = $calc;
					} // Обеспечение
					else if ($j == 9) {
						$calc = $cell[$p + 1][9] + $cell[$p + 5][9];
						$cell[$p][8] = ($calc == 0) ? "" : $calc;
						$cell[$p][9] = $calc;
					} // Итого (на тек. сутки)

					//Блок раскраски. Начало
					switch ($j) {
						case 0:
						case 1:
							$color = "bgcolor=\"#CFEDF7\"";
							break;
						case 10:
						case 14:
						case 30:
							$color = "bgcolor=\"#F5D6D8\"";
							break;
						default:
							$color = "";
							break;
					}

					// if (($i == 13 || $i == 24) ||
					// 	//(($ltype == "LINE") && ($j == 0 || $j == 1)) || 
					// 	// (($ltype == "LINE") && ($j == 9 || $j == 13)) || 
					// 	($ltype == "WITHOUT" && $cell[$p][8] != "0")
					// )
					// {
					// 	$color = "bgcolor=\"#dddddd\"";
					// } else if ($ltype == "HEADER") {
					// 	$color = "bgcolor=\"#A7CEF6\"";
					// } else {
					// 	// $color = "";
					// }
					//-----------


					if ($i == 0 && ($j == 10 || $j == 14)) {
						$csumm = "class=\"csumm\"";
					} else {
						$csumm = "";
					}

					switch ($ltype) {
						case "HEADER":
							$color = "bgcolor=\"#A7CEF6\"";
							break;
						case "TYPE":
							$color = "bgcolor=\"#FADCBD\"";
							break;
						case "WITHOUT":
							$color = "bgcolor=\"#CCF5D4\"";
							break;
						default:
							break;
					}

					switch ($i) {
						case 35:
						case 36:
							$color = "bgcolor=\"#19E622\"";
							break;
						case 18:
						case 29:
						case 30:
							$color = "bgcolor=\"#F9F9B3\"";
							break;
						default:
							break;
					}
					//Блок раскраски. Конец

					$result .= "<td " . $color . " " . $csumm . ">" . (($cell[$p][8] == "0") ? "" : $cell[$p][8]) . "</td>";

					$p++;
				}
				echo "<tr>" . $line[$i][0] . $result . "</tr>";
			}
			?>
	</table>
	<br>
	<hr>
</div>