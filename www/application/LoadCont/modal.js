$(document).ready(function() {
	if ($.browser.msie = true) { // если юзается браузер ie
		if (document.all && !document.querySelector) {window.location = 'http://172.20.20.103:8080/application/Errors/ErrorPage1.html'; scriptStop('');} // ie 8+
		//if (document.all && !document.addEventListener) {window.location = 'http://172.20.20.103:8080/application/Errors/ErrorPage2.html'; scriptStop('');} // ie 9+
	}
	divSize('#MainDiv', -10, -40);
	disTimeItem('ButUpdate', 5000);
	window.gRowId = '';
	window.gVar01 = '';
	window.gVar02 = '';
	window.gVar03 = '';
	$.each($('fieldset'), function() {$('#' + this.id).removeClass(); $('#' + this.id).addClass('ItemCustom');});
	
	$(window).resize(function() {divSize('#MainDiv', -10, -40);});
	$('#ButUpdate').click(function() {submitPage('');});
	$('#ButPrint').click(function() {runAction('DeclarationPrint');});
	$('body').mouseup(function() {var vObj = document.getElementById('MenuFront'); if (vObj.style.display == "block") {vObj.style.display = "none";}});
	$('#P1_AUTO_COMPLETE').change(function() {if ($v(this.id).length > 0) {runAction('IngredientRefresh');}});
	//$('#P1_OPR_MASS').change(function() {if ($v(this.id).length > 0) {runAction('IngredientRefresh');}});
	$('#BUT_INFORM_SPRUT').click(function() {openModal('ModalSprut', 'Доп. сведения по ЗПУ');});
	$('#BUT_LIQUID_DATA').click(function() {openModal('ModalLiquid', '');});
	
	$('#ModalData').dialog({
		modal: true,
		bgiframe: true,
		width: 'auto',
		height: 'auto',
		resizable: false,
		autoOpen: false,
		buttons: [{text: "Закрыть",
				   width: "100",
				   click: function() {closeModal('ModalData');}},
				  {id: "ButModalData1",
				   text: "Обновить",
				   width: "100",
				   click: function() {runAction('WeightUpdate');}}/*,
				  {id: "ButModalData2",
				   text: "Погрузка",
				   width: "100",
				   click: function() {runAction('CheckCar');}}*/
				 ]
	});
	
	$('#ModalSprut').dialog({
		modal: true,
		//bgiframe: true,
		width: 'auto',
		//height: 'auto',
		resizable: false,
		autoOpen: false,
		close: function() {var vLine = '';
						   $.each($('#ModalSprut .ItemCustom'), function(index, value) {if ((index % 3) == 0) {vLine += this.value + ', ';} else {vLine += this.value;}});
						   $s('P1_INFORM_SPRUT', vLine);},
		buttons: [{text: "Закрыть",
				   width: "80",
				   click: function() {closeModal('ModalSprut');}},
				  {id: "ButModalSprut1",
				   text: "Обновить",
				   width: "80",
				   click: function() {runAction('SprutUpdate');}}]
	});
	
	$('#ModalLiquid').dialog({
		modal: true,
		bgiframe: true,
		title: 'Доп. сведения по наливу',
		width: 'auto',
		height: 'auto',
		resizable: false,
		autoOpen: false,
		close: function() {var vLine = '';
						   $.each($('#ModalLiquid .ItemCustom'), function() {vLine += this.value + ', ';});
						   $s('P1_LIQUID_DATA', vLine);},
		buttons: [{text: "Закрыть",
				   width: "100",
				   click: function() {closeModal('ModalLiquid');}}]
	});
	
	$('#ModalCreateLot').dialog({
		modal: true,
		bgiframe: true,
		width: '850',
		height: '550',
		autoOpen: false,
		buttons: [{text: "Закрыть",
				   width: "100",
				   click: function() {closeModal('ModalCreateLot');}},
				  {id: "ButModalLoad1",
				   text: "Фиктивная погрузка",
				   width: "158",
				   click: function() {runAction('ContLoading', 'Virtual');}},
				  {text: "Погрузить",
				   width: "100",
				   click: function() {runAction('ContLoading', 'Normal');}}]
	});
	
});