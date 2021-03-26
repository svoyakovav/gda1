function cellClick(pArray) {
	$.ajax({
		type: 'POST',
		url: 'unit_data.php',
		async: false,
		data: {'Data': pArray},
		dataType: 'json',
		success: function(result) {
			document.getElementById('QueryResult').innerHTML = result.data;
            $("#QueryResult").dialog("option", "title", "Список подвижных единиц");
			$('#QueryResult').dialog('open');
		},
        error: function (jqXHR, exception) {
			var vMsg = jqXHR.responseText;
            vMsg = vMsg.replace(/<a[^>]*>|<\/a>/g, "");
            vMsg = vMsg.replace(/\{.*?}/g, "");
            document.getElementById('QueryResult').innerHTML = vMsg;
            $("#QueryResult").dialog("option", "title", "Описание ошибки");
			$('#QueryResult').dialog('open');
		}
	});
}

function showTime(e) {
	var vBox = e.getBoundingClientRect();
	$('#default_time').css({"left":(vBox.left + pageXOffset) + "px", "top":(vBox.top + pageYOffset + 21) + "px"});
	$('#default_time').show();
}

function selectTime(pTimeValue) {$('#ReportTime').val(pTimeValue);}

$(document).ready(function() {
	$(document).mouseup(function() {$('#default_time').hide();});
	$('#ButPrint').click(function() {window.print();});
	$('#ButManual').click(function() {window.open('/reports/ControlReport/manual.html');});
	
	var vSumm = 0;
	var vValue = '';
	$('.csumm').each(function() {
		vValue = $(this).html();
		vValue = vValue.replace(/<a[^>]*>|<\/a>/g, "");
		vSumm += +vValue;
	});
	$('#TotalCell').html(vSumm);
	
	$('#ButHTML').click(function() {
		var WinPrint = window.open('','','left=0,top=0,width=400,height=200,toolbar=0,scrollbars=1,status=0');
		WinPrint.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title></title>');
		WinPrint.document.write('<style>');
		WinPrint.document.write('* {font-size: 11px; font-family: Arial, Tahoma, Arial, Helvetica, sans-serif; -webkit-print-color-adjust: exact; print-color-adjust: exact;}');
		WinPrint.document.write('table {border-collapse: collapse;}');
		WinPrint.document.write('table > tbody > tr > th, table > tbody > tr > td {border: 1px solid black; padding: 0px 1px;}');
		WinPrint.document.write('tr {text-align: center;}');
		WinPrint.document.write('td[bgcolor="#cccccc"] {font-weight: bold;}');
		WinPrint.document.write('a {text-decoration: none; color: black; display: block; margin: 0px;}');
		WinPrint.document.write('#header-block {font-size: 16px; font-weight: bold; margin: 8px 0px;}');
		WinPrint.document.write('@page {margin: 0.8cm;}');
		WinPrint.document.write('</style>');
		WinPrint.document.write('</head><body>');
		WinPrint.document.write('<div align="center" id="header-block">' + $("#header_print").html() + '</div>');
		WinPrint.document.write('<div align="center">' + $("#body-page").html() + '</div>');
		WinPrint.document.write('</body></html>');
		WinPrint.document.close();
		//WinPrint.focus();
		WinPrint.document.execCommand('SaveAs', true, 'ControlReport.html');
		WinPrint.close();
	});
	
	$('#ButExcel').click(function() {
		var vCell = '';
		var vLine01 = '';
		var vLine02 = '';
		var vHead = $('#header_print').html();
		var vTotal = $('#TotalCell').html();
		
		$('#ReportTable01 > tbody > tr > td').each(function() {
			vCell = $(this).html();
			vCell = vCell.replace(/<a[^>]*>|<\/a>/g, "");
			vLine01 += vCell + '/';
		});
		vLine01 = vLine01.slice(0, -1);
		
		$('#ReportTable02 > tbody > tr > td').each(function() {
			vCell = $(this).html();
			vCell = vCell.replace(/<a[^>]*>|<\/a>/g, "");
			vLine02 += vCell + '/';
		});
		vLine02 = vLine02.slice(0, -1);
		
		$.ajax({
			type: 'POST',
			url: 'export_excel.php',
			async: false,
			data: {'Total':vTotal, 'Head':vHead, 'Line01':vLine01, 'Line02':vLine02},
			success: function(e) {document.location.href = e;},
			error: function (jqXHR, exception) {alert('ERROR: ' + jqXHR.responseText);}
		});
	});
	
	$("input[name = ReportDate]").datepicker({
		showOn: "button",
		buttonText: "...",
		dateFormat: "dd.mm.yy",
		minDate: new Date(2016, 10 - 1, 25),
		firstDay: 1,
		monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
		monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
		dayNames: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
		dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		dayNamesShort: ['Вос', 'Пон', 'Вто', 'Сре', 'Чет', 'Пят', 'Суб']
	});
	
	$('#QueryResult').dialog({
		modal: true,
		bgiframe: true,
		width: 700,
		height: 500,
		autoOpen: false,
		buttons: [{text: "Закрыть", width: "120", click: function() {$('#QueryResult').dialog('close');}}]
	});
});