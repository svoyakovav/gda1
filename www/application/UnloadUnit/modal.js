$(document).ready(function() {
	if ($.browser.msie = true) { // если юзается браузер ie
		if (document.all && !document.querySelector) {window.location = 'http://172.20.20.103:8080/application/Errors/ErrorPage1.html'; scriptStop('');} // ie 8+
		//if (document.all && !document.addEventListener) {window.location = 'http://172.20.20.103:8080/application/Errors/ErrorPage2.html'; scriptStop('');} // ie 9+
	}
	window.gVar01 = '';
	window.gVar02 = '';
	disTimeItem('ButUpdate', 8000);
	setSize('#DivMain', -10, -75);
	
	$('#ButUpdate').click(function() {submitPage('');});
	$('#ButUnitClean').click(function() {if (confirm('Подтверждаете уборку отмеченных единиц?')) {runAction('UnitClean');}});
	$('#ButUnitDebit').click(function() {if (confirm('Подтверждаете приходование партий для отмеченных единиц?')) {runAction('UnitDebit');}});
	$('#ButNullUnload').click(function() {if (confirm('Подтверждаете фиктивную разгрузку отмеченных единиц?')) {runAction('UnitNullUnload');}});
	$('#ButUnitUnload').click(function() {runAction('BeforeUnitUnload');});
	$('#ButPrintSupply').click(function() {runAction('PrintSupply');});
	$('#ButPrintUnload').click(function() {expExcel('TableReportUnload', 'UnloadUnit.xls');});
	$('#P1_ORDER_HEADER').change(function() {upItem('P1_ORDER_LINE', '#P1_ORDER_HEADER');});
	$('#P1_ORDER_LINE').change(function() {runAction('SelectOrder', this.value);});
	$('#DivMain').scroll(function() {var vObj = document.getElementById('UnitMenu'); if (vObj.style.display == "block") {vObj.style.display = "none";}});
	$('body').mouseup(function() {var vObj = document.getElementById('UnitMenu'); if (vObj.style.display == "block") {vObj.style.display = "none";}});
	$(window).resize(function() {setSize('#DivMain', -10, -75);});
	
	$('#ModalData').dialog({
		modal: true,
		bgiframe: true,
		width: 'auto',
		resizable: false,
		autoOpen: false,
		buttons: [{text: "Закрыть",
				   width: "100",
				   click: function() {closeModal('ModalData');}},
				  {id: "ButModalData1",
				   text: "OK",
				   width: "100",
				   click: function() {if (confirm('Подтверждаете разгрузку отмеченных единиц?')) {runAction('UnitUnload');}}}]
	});
	
	$('#ModalOrder').dialog({
		modal: true,
		bgiframe: true,
		width: 'auto',
		height: 'auto',
		resizable: false,
		autoOpen: false,
		buttons: [{text: "Закрыть",
				   width: "100",
				   click: function() {closeModal('ModalOrder');}},
				  {text: "OK",
				   width: "100",
				   click: function() {runAction('UnitAddOrder');}}]
	});
});