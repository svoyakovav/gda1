$(document).ready(function() {
	if ($.browser.msie = true) { // если юзается браузер ie
		//if (document.all && !document.querySelector) {window.location = 'http://172.20.20.103:8080/application/Errors/ErrorPage1.html'; scriptStop('');} // ie 8+
		if (document.all && !document.addEventListener) {window.location = 'http://172.20.20.103:8080/application/Errors/ErrorPage2.html'; scriptStop('');} // ie 9+
	}
	disTimeItem('ButFormUpdate', 8000);
	setSize('divFront', -200, -100);
	window.gRowId = '';
	window.gVar01 = '';
	window.gVar02 = '';
	window.gVar03 = '';
	window.gPrevious = '';
	$.each($('fieldset'), function() {$('#' + this.id).removeClass(); $('#' + this.id).addClass('modalItem');});
	
	$(window).resize(function() {setSize('divFront', -200, -100);});
	$('#divFront').scroll(function() {var vObj = document.getElementById('menuFront'); if (vObj.style.display == "block") {vObj.style.display = "none";}});
	$('body').mouseup(function() {var vObj = document.getElementById('menuFront'); if (vObj.style.display == "block") {vObj.style.display = "none";}});
	$('#BUT_INFORM_LIQUID').click(function() {openModal('ModalLiquid', '');});
	$('#BUT_INFORM_SPRUT').click(function() {openModal('ModalSprut', 'Доп. сведения по ЗПУ');});
	$('#ButFormUpdate').click(function() {submitPage('');});
	$('#P1_AUTO_COMPLETE').change(function() {if ($v(this.id) != '') {runAction('SelectIngredient');}});
	$('#P1_METHOD_DEFINITION').change(function() {runAction('ChangeMethodDefinition', '', this.value);});
	$('div#ModalSprut .modalItem').blur(function() {
		var vLine = '';
		$.each($('div#ModalSprut .modalItem:enabled').not('#P1_SPRUT_TYPE'), function() {vLine += this.value;});
		if (vLine == '') {assignItem('P1_SPRUT_TYPE', 'Current', '', 'FFFFFF');} else {assignItem('P1_SPRUT_TYPE', 'Current', '', 'FFFF80');}
	});

	$('#P1_SPRUT_TYPE').change(function() {    if ($('#P1_SPRUT_TYPE option:selected').text().toUpperCase()=='ЗАКРУТКА') {		
		for (var i = 1; i<9; i++) { $('#P1_SPRUT_S' + i).attr('disabled', true); $('#P1_SPRUT_N' + i).attr('disabled', true); $('#P1_SPRUT_S' + i).val('');
				$('#P1_SPRUT_N' + i).val('');}   
		$('#P1_SPRUT_S1').val('З');
		$('#P1_SPRUT_N1').val('акрутка');
		$('.countsprut').show();
		$('#P1_SPRUT_COUNT  option[value="1"]').attr("selected", "selected");
		}
	else {  for (var i = 1; i<9; i++) { $('#P1_SPRUT_S' + i).attr('disabled', false);
				$('#P1_SPRUT_N' + i).attr('disabled', false); $('#P1_SPRUT_S' + i).val('');
				$('#P1_SPRUT_N' + i).val('');	}
			$('.countsprut').hide();
			$('#P1_SPRUT_COUNT  option[value="1"]').attr("selected", "selected");
		}});

	$('#P1_SPRUT_COUNT').change(function() {
		for (var i = 1; i<9; i++) { $('#P1_SPRUT_S' + i).val(''); $('#P1_SPRUT_N' + i).val('');}
		for (var i = 1; i<=($('#P1_SPRUT_COUNT option:selected').val()); i++) { $('#P1_SPRUT_S' + i).val('З'); $('#P1_SPRUT_N' + i).val('акрутка');}
	});		

	
	$('#ModalData').dialog({
		modal: true,
		bgiframe: true,
		//show: 'drop',
		width: 'auto',
		height: 'auto',
		resizable: false,
		autoOpen: false,
		buttons: [{text: "Закрыть",
				   width: "100",
				   click: function() {closeModal('ModalData');}},
				  {id: "ButModalData1",
				   text: "Обновить форму",
				   width: "150",
				   click: function() {runAction('DataCar');}},
				  {id: "ButModalData2",
				   text: "Погрузка",
				   width: "100",
				   click: function() {runAction('CheckCar');}}]
	});
	
	$('#ModalCreateLot').dialog({
		modal: true,
		bgiframe: true,
		width: '850',
		height: '550',
		//resizable: false,
		autoOpen: false,
		buttons: [{disabled:"disabled",
				   id: "ButGetCargoWeight",
				   text: "Получить данные взвешивания",
				   width: "300",
				   click: function() {runAction('getCargoWeight');}},
				  {text: "Закрыть",
				   width: "100",
				   click: function() {closeModal('ModalCreateLot');}},
				  {id: "ButModalLoad2",
				   text: "Перепродажа",
				   width: "120",
				   click: function() {assignItem('P1_RESALE_LOT', 'Current', '', 'FFFF80'); openModal('ModalResale', '');}},
				  {id: "ButModalLoad1",
				   text: "Фиктивная погрузка",
				   width: "158",
				   click: function() {runAction('CreateLot', '', 'Virtual');}},
				  {text: "Погрузить",
				   width: "100",
				   click: function() {runAction('CreateLot', '', 'Normal');}}]
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
						   $.each($('#ModalLiquid .modalItem'), function() {vLine += this.value + ', ';});
						   $s('P1_INFORM_LIQUID', vLine);},
		buttons: [{text: "Закрыть",
				   width: "100",
				   click: function() {closeModal('ModalLiquid');}}]
	});
	
	$('#ModalSprut').dialog({
		modal: true,
		bgiframe: true,
		width: 'auto',
		height: 'auto',
		resizable: false,
		autoOpen: false,
		close: function() {var vLine = '';
						   $.each($('#ModalSprut .modalItem'), function(index, value) {if ((index % 3) == 0) {vLine += this.value + ', ';} else {vLine += this.value;}});
						   $s('P1_INFORM_SPRUT', vLine);},
		buttons: [{text: "Закрыть",
				   width: "80",
				   click: function() {closeModal('ModalSprut');}},
				  {id: "ButModalSprut1",
				   text: "Обновить",
				   width: "80",
				   click: function() {runAction('UpdateSprut');}}]
	});
	
	$('#ModalResale').dialog({
		modal: true,
		bgiframe: true,
		title: 'Оформление перепродажи',
		width: 'auto',
		height: 'auto',
		resizable: false,
		autoOpen: false,
		close: function() {assignItem('P1_RESALE_LOT', 'Current', '', 'FFFFFF');},
		buttons: [{text: "Закрыть",
				   width: "90",
				   click: function() {closeModal('ModalResale');}},
				  {text: "OK",
				   width: "60",
				   click: function() {runAction('CreateLot', '', 'Resale');}}]
	});

	$('#Form3').dialog({
		modal: true,
		bgiframe: true,
		title: 'Форма 3',
		width: 'auto',
		height: 'auto',
		resizable: false,
		autoOpen: false,
		//close: function() {assignItem('P1_RESALE_LOT', 'Current', '', 'FFFFFF');},
		buttons: [{text: "Закрыть",
				   width: "90",
				   click: function() {closeModal('Form3');}},
				  {text: "Печать",
				   width: "60",
				   click: function() {ExportExcel('Form3', 'form3.xls');}}]
	});		
	
	
	
});