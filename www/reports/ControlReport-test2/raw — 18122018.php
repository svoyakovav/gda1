<?php
	$line = array(); // Массив строк
	$select = "";
	$row = 0;
	$result = "";
	$column_count = 20; // Кол-во колонок
	
	$sql_count = 9;
	foreach (array("$sql_10", "$sql_11", "$sql_10", "$sql_11", "$sql_12") as $sql) {
		$sql_count++;
		$sql = "
			SELECT
				COUNT(*) AS UNIT_COUNT,
				UNIT.CURRENT_WEIGHT_SIGN,
				UNIT.ACTION_TYPE_NAME,
				UNIT.UNIT_TYPE_ID,
				UNIT.UNIT_TYPE_NAME,
				UNIT.FIRST_CARGO_ID,
				UNIT.FIRST_CARGO_NAME,
				UNIT.UNIT_OWNER_SIGN
			FROM (" . $sql . ") UNIT
			GROUP BY
				UNIT.CURRENT_WEIGHT_SIGN,
				UNIT.ACTION_TYPE_NAME,
				UNIT.UNIT_TYPE_ID,
				UNIT.UNIT_TYPE_NAME,
				UNIT.FIRST_CARGO_ID,
				UNIT.FIRST_CARGO_NAME,
				UNIT.UNIT_OWNER_SIGN";
		
		switch ($sql_count) {
			case "10": $sql_date_01 = $PreviousDate; $sql_date_02 = "";       break;
			case "11": $sql_date_01 = $PreviousDate; $sql_date_02 = $SetDate; break;
			case "12": $sql_date_01 = $SetDate;      $sql_date_02 = "";       break;
			case "13": $sql_date_01 = $BeginMonth;   $sql_date_02 = $SetDate; break;
		}
		
		$sql = str_replace(":pDate",      "'" . $sql_date_01 . "'", $sql);
		$sql = str_replace(":pStartDate", "'" . $sql_date_01 . "'", $sql);
		$sql = str_replace(":pEndDate",   "'" . $sql_date_02 . "'", $sql);
		
        $select = OCIParse($itl_logon, $sql);
        OCIExecute($select, OCI_DEFAULT);
        $row = OCIFetchStatement($select, $result, 0, -1, OCI_FETCHSTATEMENT_BY_COLUMN + OCI_ASSOC);
		
        /*echo "<table border=\"1\"><tr><th>UNIT_COUNT</th><th>UNIT_TYPE_ID</th><th>UNIT_TYPE_NAME</th><th>FIRST_CARGO_ID</th>
                                  <th>FIRST_CARGO_NAME</th><th>UNIT_OWNER_SIGN</th><th>ACTION_TYPE_NAME</th><th>CURRENT_WEIGHT_SIGN</th></tr>";
        for ($i = 0; $i < $row; $i++) {
            echo "<tr>" .
                "<td>" . $result["UNIT_COUNT"][$i] . "</td>" .
                "<td>" . $result["UNIT_TYPE_ID"][$i] . "</td>" .
                "<td>" . $result["UNIT_TYPE_NAME"][$i] . "</td>" .
                "<td>" . $result["FIRST_CARGO_ID"][$i] . "</td>" .
                "<td>" . $result["FIRST_CARGO_NAME"][$i] . "</td>" .
                "<td>" . $result["UNIT_OWNER_SIGN"][$i] . "</td>" .
                "<td>" . $result["ACTION_TYPE_NAME"][$i] . "</td>" .
                "<td>" . $result["CURRENT_WEIGHT_SIGN"][$i] . "</td>" .
                "</tr>";
        }
        echo "</table><br>";*/
		
        ////////////////////////////////
        // Формирование массива строк //
        ////////////////////////////////
        $p = count($line);
        for ($i = 0; $i < $row; $i++) {
            $count = 0;
            for ($j = 0; $j < count($line); $j++) {
                if ($line[$j]["CARGO_NAME"] == $result["FIRST_CARGO_NAME"][$i] && $line[$j]["TYPE_NAME"] == $result["UNIT_TYPE_NAME"][$i]) {$count++;}
            }
            if ($count == 0) {
                $line[$p]["CARGO_ID"] = $result["FIRST_CARGO_ID"][$i];
                $line[$p]["CARGO_NAME"] = $result["FIRST_CARGO_NAME"][$i];
                $line[$p]["TYPE_ID"] = $result["UNIT_TYPE_ID"][$i];
                $line[$p]["TYPE_NAME"] = $result["UNIT_TYPE_NAME"][$i];
                $p++;
            }
        }
		
        //////////////////////////
        // Расчет массива строк //
        //////////////////////////
        for ($i = 0; $i < $p; $i++) {
            for ($j = 0; $j < $column_count; $j++) {
				
				if ($j == 1 || $j == 3 || $j == 5 || $j == 7 || $j == 10 || $j == 12 || $j == 14 || $j == 16 || $j == 18) {$ownSign = "СОБ";}
				else if ($j == 2 || $j == 4 || $j == 6 || $j == 8 || $j == 11 || $j == 13 || $j == 15 || $j == 17 || $j == 19) {$ownSign = "ЧУЖ";}
				else {$ownSign = "";}
				
                if ($j == 3 || $j == 4 || $j == 16 || $j == 17) {$actType = "ПОДАНО";}
                else if ($j == 5 || $j == 6) {$actType = "ВЫГР";}
                else if ($j == 7 || $j == 8) {$actType = "СДАНО";}
                else if ($j == 12 || $j == 13) {$actType = "ПОД_ВЫГР";}
                else {$actType = "";}
				
                if ($j == 0 || $j == 1 || $j == 2 || $j == 9 || $j == 10 || $j == 11) {$weiSign = "1";}
                else if ($j == 14 || $j == 15) {$weiSign = "0";}
                else {$weiSign = "";}
				
                if (($sql_count == 10 && $j >= 0 && $j <= 2) ||
                    ($sql_count == 11 && $j >= 3 && $j <= 8) ||
                    ($sql_count == 12 && $j >= 9 && $j <= 15) ||
                    ($sql_count == 13 && $j >= 16 && $j <= 17) ||
                    ($sql_count == 14 && $j >= 18 && $j <= 19))
                {
                    $count = 0;
                    for ($k = 0; $k < $row; $k++) {
                        if ($result["FIRST_CARGO_ID"][$k] == $line[$i]["CARGO_ID"] &&
                            $result["UNIT_TYPE_ID"][$k] == $line[$i]["TYPE_ID"] &&
                            ($result["UNIT_OWNER_SIGN"][$k] == $ownSign || $ownSign == "") &&
                            ($result["ACTION_TYPE_NAME"][$k] == $actType || $actType == "") &&
                            ($result["CURRENT_WEIGHT_SIGN"][$k] == $weiSign || $weiSign == "")) {$count += $result["UNIT_COUNT"][$k];}
                    }
					$arg =
						$sql_count . "/" . $line[$i]["TYPE_ID"] . "/" . $line[$i]["CARGO_ID"] . "/" . $ownSign . "/" . $actType . "/" . $weiSign .
						"/" . "/" . "/" . "/" . "/" . $sql_date_01 . "/" . $sql_date_02 . "/С_ПУСТО";
					
					$line[$i][$j] = (($count != 0) ? "<a href=\"javascript:onClick=cellClick('" . $arg . "');\">" . $count . "</a>" : "");
                }
            }
        }
    }
?>
<!-- Таблица -->
<!--    <tr>
        <th rowspan="3" colspan="2">Сырье</th>
        <th colspan="9" bgcolor="#DCECFF">За прошедшие сутки</th>
        <th colspan="7" bgcolor="#FFDDE2">На текущие сутки</th>
        <th colspan="2" rowspan="2" bgcolor="#E6E6E6">Подано с<br>нач. мес.</th>
        <th colspan="2" rowspan="2" bgcolor="#B4FFB4">Подход на<br>"Жиг. море"</th>
    </tr>
    <tr>
        <th colspan="3" bgcolor="#DCECFF">Начало суток груж.</th>
        <th colspan="2" bgcolor="#DCECFF">Подано</th>
        <th colspan="2" bgcolor="#DCECFF">Выгружено</th>
        <th colspan="2" bgcolor="#DCECFF">Сдано</th>
        <th colspan="3" bgcolor="#FFDDE2">Груженых</th>
        <th colspan="2" bgcolor="#FFDDE2">Под выгр.</th>
        <th colspan="2" bgcolor="#FFDDE2">Порожних</th>
    </tr>
    <tr>
        <th bgcolor="#DCECFF">Всего</th>
        <th bgcolor="#DCECFF">Соб</th>
        <th bgcolor="#DCECFF">Чуж</th>
        <th bgcolor="#DCECFF">Соб</th>
        <th bgcolor="#DCECFF">Чуж</th>
        <th bgcolor="#DCECFF">Соб</th>
        <th bgcolor="#DCECFF">Чуж</th>
        <th bgcolor="#DCECFF">Соб</th>
        <th bgcolor="#DCECFF">Чуж</th>
        <th bgcolor="#FFDDE2">Всего</th>
        <th bgcolor="#FFDDE2">Соб</th>
        <th bgcolor="#FFDDE2">Чуж</th>
        <th bgcolor="#FFDDE2">Соб</th>
        <th bgcolor="#FFDDE2">Чуж</th>
        <th bgcolor="#FFDDE2">Соб</th>
        <th bgcolor="#FFDDE2">Чуж</th>
        <th bgcolor="#E6E6E6">Соб</th>
        <th bgcolor="#E6E6E6">Чуж</th>
        <th bgcolor="#B4FFB4">Соб</th>
        <th bgcolor="#B4FFB4">Чуж</th>
    </tr>
	-->
<?php
    $data_cargo = array();
    foreach($line as $key => $arr){$data_cargo[$key] = $arr['CARGO_NAME'];}
    $data_type = array();
    foreach($line as $key => $arr){$data_type[$key] = $arr['TYPE_NAME'];}
    array_multisort($data_cargo, SORT_ASC, $data_type, SORT_DESC, $line);
    //echo "LINE (Отсортированные строки заголовка):<br>";
    //print_r($line); echo "<br><br>";
	
    if ($p > 0) {
        for ($i = 0; $i < $p; $i++) {
            if ($line[$i]["CARGO_NAME"] == $line[$i - 1]["CARGO_NAME"]) {
                $count = 0;
            } else {
                $count = 1;
                while ($line[$i]["CARGO_NAME"] == $line[$i + $count]["CARGO_NAME"]) {$count++;}
            }
            // Вывод левой части заголовка
            echo "<tr>";
            if ($count != 0) {echo "<td rowspan=\"" . $count . "\"><p class=\"clip\">" . $line[$i]["CARGO_NAME"] . "</p></td>";}
            echo "<td>" . $line[$i]["TYPE_NAME"] . "</td>";
            // Вывод ячеек таблицы
            for ($j = 0; $j < $column_count; $j++) {
                $color = "";
                if ($j >= 0 && $j <= 2) {
                    $color = "bgcolor=\"#DCECFF\"";
                } else if ($j >= 9 && $j <= 11) {
                    $color = "bgcolor=\"#FFDDE2\"";
                }
                echo "<td " . $color . ">" . $line[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
    }
	
    OCIFreeStatement($select);
    OCILogOff($itl_logon);
?>