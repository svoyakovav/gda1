<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Рапорт диспетчера</title>
		<script type="text/javascript" src="/libraryes/jquery-2.2.4.min.js"></script>
		<link type="text/css" href="/libraryes/jquery-ui-1.11.4.base/jquery-ui.min.css" rel="stylesheet">
		<script type="text/javascript" src="/libraryes/jquery-ui-1.11.4.base/jquery-ui.min.js"></script>
		
		<script type="text/javascript" src="script.js"></script>
		<link rel="stylesheet" href="style.css" type="text/css">
		<link rel="stylesheet" href="style-print.css" type="text/css" media="print">
	</head>
<body>
    <div id="QueryResult"></div>
	<div id="default_time">
		<ul>
			<li onclick="javascript:selectTime('06:00:00');">Начало суток (06:00)</li>
			<li onclick="javascript:selectTime('18:00:00');">Конец суток (18:00)</li>
		</ul>
	</div>
	<?php
		//set_time_limit(60);
		/*
		$ReportType = $_POST['ReportType'];
		if ($ReportType == "" || $ReportType == "NULL") {$ReportType = "TRAIN";}
		<select name="ReportType">
			<option <?=(($ReportType == "TRAIN") ? "selected" : "") ?> value="TRAIN">подвижного состава</option>
			<option <?=(($ReportType == "RAW") ? "selected" : "") ?> value="RAW">сырья</option>
		</select>
		echo "<input type=\"hidden\" id=\"ReportType\" value=\"$ReportType\">";
        if ($ReportType == "TRAIN") {
            include("train.php");
        } else if ($ReportType == "RAW") {
            include("raw.php");
        }
		*/
		
		$PageHeader = "Суточный рапорт по движению подвижного состава на";
		$ReportDate = $_POST['ReportDate']; if ($ReportDate == '') {$ReportDate = Date("d.m.Y");}
		$ReportTime = $_POST['ReportTime']; if ($ReportTime == '') {$ReportTime = "06:00:00";}
//		$ReportTime = "06:00:00";
		$SetDate = $ReportDate . " " . $ReportTime;
		$PreviousDate = date_create($ReportDate); date_modify($PreviousDate , '-1 day');
		$PreviousDate = date_format($PreviousDate , "d.m.Y") . " " . $ReportTime;
		$BeginMonth = "01." . Date("m.Y", strtotime($ReportDate)) . " 00:00:00";
		$UnitType = "''";
		
		echo "<div id=\"header_print\" align=\"center\" class=\"header-block print\">" . $PageHeader . " " . $SetDate ."</div>";
    ?>
    <div class="header-block noprint" align="left">
		<button id="ButPrint" type="button">
			<img src="http://172.20.20.103:8080/images/icons/print_16x16.ico" align="left" style="vertical-align: middle">&nbsp;Печать
		</button>
		<button id="ButExcel" type="button">
			<img src="http://172.20.20.103:8080/images/icons/excel_16x16.ico" align="left" style="vertical-align: middle">&nbsp;Формировать "Excel"
		</button>
		<button id="ButHTML" type="button">
			<img src="http://172.20.20.103:8080/images/icons/internet-explorer_16x16.png" align="left" style="vertical-align: middle">&nbsp;Формировать "HTML"
		</button>
		<button id="ButManual" type="button">
			<img src="http://172.20.20.103:8080/images/icons/inform_16x16.ico" align="left" style="vertical-align: middle">&nbsp;Инструкция
		</button>
	</div>
	<div class="header-block noprint" align="center">
		<form action="" method="POST">
            <b><?= $PageHeader ?></b>
			<input autocomplete="off" type="text" size="8" name="ReportDate" value="<?= $ReportDate ?>" readonly>
			<input autocomplete="off" type="text" size="6" name="ReportTime" value="<?= $ReportTime ?>" id="ReportTime" onclick="javascript:showTime(this);">
			<button type="submit">
                <img src="http://172.20.20.103:8080/images/icons/update_16x16.ico" align="left" style="vertical-align: middle">&nbsp;Обновить
            </button>
        </form>
    </div>
    <?php
		include($_SERVER['DOCUMENT_ROOT'] . "/libraryes/itl_connect.php");
		include("sql_scripts.php");
		include("function.php");
		include("train.php");
    ?>
</body>
</html>