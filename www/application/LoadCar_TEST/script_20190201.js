function openModal(pModalName, pTitleName) {if (pTitleName != '') {$('#' + pModalName).dialog('option', 'title', pTitleName);} $('#' + pModalName).dialog('open');}
function closeModal(pModalName) {$('#' + pModalName).dialog('close');}
function scriptStop(pMessage) {if (pMessage != '') {alert(pMessage);} throw new Error("stop");}
function submitPage(pValue) {if (pValue != '') {document.getElementById('P1_MENU_ITEM').value = pValue;} apex.submit({showWait: 'True'});}
function searchOnLine(pLine, pSearch) {if (pLine.toUpperCase().indexOf(pSearch) >= 0) {return 1;} else {return 0;}}

function setSize(pBlockId, pOffsetX, pOffsetY) {
	$('#' + pBlockId).css({
		width: $(window).width() + pOffsetX + 'px',
		height: $(window).height() + pOffsetY + 'px'
	});
}

function assignItem(pItem, pValue, pDisable, pColor) {
	if (pValue != 'Current') {$s(pItem, pValue);}
	if (pDisable != '') {(pDisable == 'True') ? $('#' + pItem).attr('disabled', true) : $('#' + pItem).attr('disabled', false);}
	if (pColor != '') {document.getElementById(pItem).style.background = '#' + pColor;}
}

function checkItem(pSelector) {
	var vLine = ''; var vItem = ''; var vColor = '';
	$.each($(pSelector), function() {
		vColor = $(this).css("background-color");
		if (vColor != 'rgb(255, 255, 255)' && vColor != 'rgb(229, 229, 229)' && vColor != 'transparent' && this.value == '') {
			vItem = this.id.substr(0, 5);
			switch(vItem) {
				case 'qty_n': vItem = 'Вес нетто для продукта'; break;
				case 'qty_p': vItem = 'Количество мест для продукта'; break;
				case 'qty_b': vItem = 'Вес брутто для продукта'; break;
				case 'qty_pm': vItem ='Длина в п.м.'; break;
				case 'sub_c': vItem = 'Подразделение для ингредиента'; break;
				default: vItem = $('#' + this.id).parent().prev().text();}
			vLine += '\n# ' + vItem;
		}
	});
	if (vLine == '') {return '';} else {return 'Обязательные поля не заполнены:' + vLine;}
}

function runAction(pActionName, pRowId, pAttr1, pAttr2, pAttr3) {
	var vData = '';
	switch(pActionName) {
		case 'ClickCar':
			gRowId = pRowId; gVar01 = pAttr1;
			var vArray = pAttr2.split('|');
			//vArray[0] - признак наличия вагона на фронту: 1 - подан; 0 - убран
			//vArray[1] - текущее состояние вагона: "RUN" - вып.; "ERR" - ошибка; "WAR" - предупр.; null - нет
			//vArray[2] - признак загруженности: 1 - груженый; 0 - порожний
			//vArray[3] - наличие хидера погрузки: 1 - есть; 0 - нет
			if (vArray[0] == '1' && vArray[1] == '' && vArray[2] == '0') { // Дублирование операции "Погрузка"
				assignItem('ButModalData2', 'Current', 'False', '');}
			else {
				assignItem('ButModalData2', 'Current', 'True', '');}
			
			var vMenu = ["tdMenuData", "Информация по вагону", "runAction('DataCar')", (vArray[0] == '1' /*&& vArray[1] == ''*/) ? '1' : '0',
						 "tdMenuCheck", "Погрузка", "runAction('CheckCar')", (vArray[0] == '1' && vArray[1] == '' && vArray[2] == '0') ? '1' : '0',
						 "tdMenuUnload", "Выгрузка", "runAction('UnloadCar')", (vArray[0] == '1' && vArray[1] == '' && vArray[2] == '1' && vArray[3] == '1') ? '1' : '0',
//						 "tdMenuSertificat", "Формировать сертификат качества", "runAction('SertificatShape')", (vArray[1] == '' && vArray[3] == '1') ? '1' : '0',				 
						 "tdMenuClean", "Убрать вагон", "runAction('CleanCar', '', 'Подтверждаете уборку подвижной единицы')", (vArray[0] == '1' && vArray[1] == '') ? '1' : '0', //29-01-2019
						 "tdMenuSprut", "Корректировать ЗПУ", "runAction('SprutCar')", (vArray[1] == '' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuSpoil", "Установить неисправность", "runAction('OpenSpoil')", (vArray[1] == '' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuError", "Сведения об ошибке", "runAction('ErrorCar', '', '')", (vArray[1] == 'ERR') ? '1' : '0',
						 "tdMenuTransfer", "Передать данные по погрузке в АСУТЛ", "runAction('TransferCar', '', '')", (vArray[0] == '1' && vArray[1] == 'WAR' && vArray[2] == '0' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuUpdate", "Обновить операцию в АСУТЛ", "runAction('UpdateCar', '', '')", (vArray[0] == '1' && vArray[1] == 'ERR') ? '1' : '0'];
			
			for (var i = 0; i < vMenu.length / 4; i++) {
				if (vMenu[i * 4 + 3] == '0') {
					document.getElementById(vMenu[i * 4]).innerHTML = '<font color="#ABABAB">' + vMenu[i * 4 + 1] + '</font>';}
				else {
					document.getElementById(vMenu[i * 4]).innerHTML = '<a href="javascript:onClick=' + vMenu[i * 4 + 2] + ';">' + vMenu[i * 4 + 1] + '</a>';}}
			var vObjMenu = document.getElementById('menuFront');
			var vObjCurr = document.getElementById('car' + gRowId);
			vObjMenu.style.display = "block";
			$(vObjMenu).offset({top:$(vObjCurr).offset().top - 8, left:$(vObjCurr).offset().left + 8});
			break;
		case 'DataCar':
			vData = dbQuery('SelectData', gRowId, 'DataCar', '');
			document.getElementById('ModalData').innerHTML = vData;
			document.getElementById('ButModalData1').style.display = '';
			document.getElementById('ButModalData2').style.display = '';
			openModal('ModalData', 'Доп. сведения по вагону "' + gVar01 + '"');
			break;
/*29-01-2019*/			
/*		
		case 'SertificatShape':
			if (confirm('Подтверждаете операцию формирования?')) {
				vData = dbQuery(pActionName, '', gRowId);
				if (vData != '') {alert(vData);} else {alert('Документ отправлен на формирование');}}
			break;	
*/			
		case 'CheckCar':
			vData = dbQuery('CheckCar', gRowId, '', '');
			if (vData.length > 30) {alert(vData.replace(/[*]/g, '\n# '));}
			else {
				var vArray = vData.split('|');
				var vTitle = 'Погрузка вагона "' + gVar01 + '" (Списание ингредиента: "' + ((vArray[0] == '1') ? 'ON' : 'OFF') + '"; Способ упаковки: "' + vArray[5] + '")';
				gVar02 = vArray[5];
				gVar03 = vArray[0];
				gPrevious = '';
				$.each($('div.divCreateLot .modalItem').not('div#IngredientTable .modalItem'), function() {$s(this.id, '');});
				$.each($('div#ModalSprut .modalItem:disabled'), function() {$s(this.id, 'РЖД');});
				document.getElementById('ButModalSprut1').style.display = 'none';
				if (vArray[0] == '0') {assignItem('P1_AUTO_COMPLETE', '1', 'True', '');} // Признак списания ингредиента в ПЗ (не списывать)
				else if (vArray[1] == '1') {assignItem('P1_AUTO_COMPLETE', '0', 'True', '');} // Способ списания ингредиента (только ручной)
				else if (vArray[1] == '2') {assignItem('P1_AUTO_COMPLETE', '1', 'True', '');} // Способ списания ингредиента (только автоматический)
				else {assignItem('P1_AUTO_COMPLETE', '1', 'False', '');}
				if (vArray[2] == '1') {assignItem('ButModalLoad1', 'Current', 'False', '');} else {assignItem('ButModalLoad1', 'Current', 'True', '');}
				if (vArray[4] == '1') {assignItem('ButModalLoad2', 'Current', 'False', '');} else {assignItem('ButModalLoad2', 'Current', 'True', '');}
				if (vArray[3] == '1') {assignItem('P1_TARE', 'Current', 'False', '');} else {assignItem('P1_TARE', 'Current', 'True', '');}
				if (vArray[6] == '1') {assignItem('P1_UPPER_LEVEL_SEATS', 'Current', 'False', 'FFFF80');} else {assignItem('P1_UPPER_LEVEL_SEATS', 'Current', 'True', 'E5E5E5');}
				vData = dbQuery('', '', '', 'P1_STORAGE_UNIT');
				vData = dbQuery('', '', '', 'P1_RESALE_LOT');
				assignItem('P1_SPRUT_TYPE', 'Current', '', 'FFFFFF');
				openModal('ModalCreateLot', vTitle);}
			break;

		case 'ChangeSubinventory':
			//log.console("pRowId = " + pRowId);  //<F12>  -выводит данные в консоле справа в обозревателе
			vData = dbQuery('SelectData', pRowId + '|' + pAttr1, 'UpdateSubinventory', '');
			runAction('SelectIngredient');
			break;
		case 'SelectIngredient':
			var vLineValue = $v('P1_AUTO_COMPLETE') + '|' + gVar02 + '|' + $v('P1_METHOD_DEFINITION') + '|' + gVar03;
			vData = dbQuery('SelectData', vLineValue, 'SelectIngredient', '');
			document.getElementById('IngredientTable').innerHTML = vData;
			break;
		case 'ConversionQuantity':
			if (pAttr1 != '') {vData = dbQuery('SelectData', pRowId + '|' + pAttr1, 'ConversionQuantity', '');} else {vData = '||';}
			var vArray = vData.split('|');
			var vItem = pRowId.substr(5);
			document.getElementById('qty_n' + vItem).value = vArray[0];
			document.getElementById('qty_p' + vItem).value = vArray[1];
			document.getElementById('qty_b' + vItem).value = vArray[2];
			break;
/*elt, добавление расчета п.м.*/
		case 'ConversionQuantity_pm':
			if (pAttr1 != '') {vData = dbQuery('SelectData', pRowId + '|' + pAttr1, 'ConversionQuantity_pm', '');} else {vData = '||';}
			//alert(pRowId + '|' + pAttr1);
			//alert (vData);
			
			var vArray = vData.split('|');
			var vItem = pRowId.substr(5);
			//document.getElementById('qty_n' + vItem).value = vArray[0];
			//document.getElementById('qty_p' + vItem).value = vArray[1];
			document.getElementById('qty_pm' + vItem).value = vArray[0];
		    break;	
			
		case 'ChangeMethodDefinition':
			if (searchOnLine(pAttr1, 'ВЕС') == 1 || searchOnLine(gPrevious, 'ВЕС') == 1) {runAction('SelectIngredient');}
			if (searchOnLine(pAttr1, 'ОБМЕР') == 1 && gVar02 == 'НАЛИВ')
			     {$.each($('#ModalLiquid .modalItem'), function() {assignItem(this.id, '', 'False', 'FFFF80');});}
			else {$.each($('#ModalLiquid .modalItem'), function() {assignItem(this.id, '', 'True', 'E5E5E5');});}
			$s('P1_INFORM_LIQUID', '');
			gPrevious = pAttr1;
			break;
		case 'CreateLot':
/*сообщение о необновлении весов*/		
var SubDiv = $v('P1_STORAGE_UNIT').toUpperCase();
if (SubDiv.indexOf('НЗП')== -1) {alert('Указан склад'+' '+SubDiv);} else {alert('Указан склад '+SubDiv+'. \n Обновление веса продукции после взвешивание НЕВОЗМОЖНО');} ;		
		
			var vMessage = '';
			switch(pAttr1) {
				case 'Normal': vMessage = 'Подтверждаете погрузку подвижной единицы "' + gVar01 + '"?';
				break;
				case 'Resale': vMessage = 'Подтверждаете перепродажу подвижной единицы "' + gVar01 + '"?'; break;
				case 'Virtual': vMessage = 'Подтверждаете фиктивную погрузку подвижной единицы "' + gVar01 + '"?'; break;
				default: scriptStop('Тип погрузки "' + pAttr1 + '" не определен');}
			vData = checkItem('div.divCreateLot .modalItem');
			if (vData != '') {scriptStop(vData);}
			if (confirm(vMessage)) {
				var vLineValue = gRowId + '|' + gVar01 + '|' + gVar03 + '|' + pAttr1;
				vData = dbQuery('CreateLot', vLineValue, '', '');
				if (vData != '') {scriptStop(vData.replace(/[*]/g, '\n# '));} else {submitPage('');}}

			break;
			
		case 'CleanCar':
		case 'ErrorCar':
		case 'TransferCar':
		case 'UpdateCar':
			var vConfirm = '1';
			if (pAttr1 != '') {if (confirm(pAttr1 + ' "' + gVar01 + '"?')) {vConfirm = '1';} else {vConfirm = '0';}}
			if (vConfirm == '1') {
				vData = dbQuery('AddAction', gRowId, pActionName, '');
				if (vData != '') {scriptStop(vData.replace(/[*]/g, '\n'));} else {submitPage('');}}
			break;
		case 'OpenSpoil':
			vData = dbQuery('ActionSpoil', $v('SearchSpoil'), 'SelectSpoil', '');
			document.getElementById('ModalData').innerHTML = vData;
			document.getElementById('ButModalData1').style.display = 'none';
			document.getElementById('ButModalData2').style.display = 'none';
			openModal('ModalData', 'Справочник неисправностей и браков "' + gVar01 + '"');
			break;
		case 'AddSpoil':
			// confirm('Подтверждаете установку ' + ((pAttr2 == '0') ? 'брака' : 'неисправности') + ' c кодом "' + pAttr1 + '"?')
			if (confirm('Подтверждаете операцию установки?')) {
				vData = dbQuery('ActionSpoil', gRowId + '|' + pRowId + '|' + pAttr2, 'AddSpoil', '');
				if (vData == '') {alert('Операция завершена успешно'); closeModal('ModalData');} else {alert('ERROR. ' + vData);}}
			break;
		case 'SprutCar':
			vData = dbQuery('AddAction', gRowId, 'SelectSprut', '');
			var vArray = vData.split('|');
			$.each($('div#ModalSprut .modalItem:disabled'), function() {$s(this.id, 'РЖД');});
			$s('P1_SPRUT_TYPE', vArray[0]);
			for (var i = 1; i < vArray.length; i++) {
				$s('P1_SPRUT_S' + i, vArray[i].substr(3, 1));
				$s('P1_SPRUT_N' + i, vArray[i].substr(4));}
			document.getElementById('ButModalSprut1').style.display = '';
			openModal('ModalSprut', 'Корректировка ЗПУ "' + gVar01 + '"');
			break;
		case 'UpdateSprut':
			vData = checkItem('div#ModalSprut .modalItem');
			if (vData != '') {scriptStop(vData);}
			if (confirm('Подтверждаете обновление?')) {
				vData = dbQuery('UpdateSprut', gRowId, '', '');
				if (vData == '') {alert('Обновление завершено успешно'); closeModal('ModalSprut');} else {alert('ERROR. ' + vData);}}
			break;
		case 'UnloadCar':
			var vReason = prompt('Причина выгрузки подвижной единицы "' + gVar01 + '"', '');
			if (vReason == null) {scriptStop('');}
			if (vReason == '') {scriptStop('Укажите причину');}
			if (confirm('Подтверждаете выгрузку подвижной единицы "' + gVar01 + '"')) {vData = dbQuery('AddAction', gRowId + '|' + vReason, 'UnloadCar', ''); submitPage('');}
			break;
		default:
			scriptStop('Ошибка выполнения функции "runAction". Операция "' + pActionName + '" не определена');
	}
	//console.log(pActionName + ', gRowId = ' + gRowId + ', gVar01 = ' + gVar01 + ', gVar02 = ' + gVar02 + ', gVar03 = ' + gVar03);
}

function dbQuery(pProcessName, pLineValue, pProcedureName, pItemId) {
	var vRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=' + pProcessName, 0);
	if (pProcessName != '') {
		vRequest.addParam('x01', pProcedureName);
		vRequest.addParam('x02', pLineValue);
		if (pProcessName == 'CreateLot') {
			$.each($('div.divCreateLot .modalItem').not('div#IngredientTable .modalItem'), function() {vRequest.add(this.id, $v(this.id));});
			vRequest.AddArrayItems(apex.jQuery('[name=f01]'), 1);
			vRequest.AddArrayItems(apex.jQuery('[name=f02]'), 2);
			vRequest.AddArrayItems(apex.jQuery('[name=f03]'), 3);
			vRequest.AddArrayItems(apex.jQuery('[name=f04]'), 4);
			vRequest.AddArrayItems(apex.jQuery('[name=f06]'), 6);
			vRequest.AddArrayItems(apex.jQuery('[name=f07]'), 7);}
		else if (pProcessName == 'UpdateSprut') {
			$.each($('div#ModalSprut .modalItem'), function() {vRequest.add(this.id, $v(this.id));});
		}
		var vResult = vRequest.get();
		if (searchOnLine(vResult, 'ORA') == 1) {scriptStop('Ошибка выполнения процесса "' + pProcessName + '", процедура "' + pProcedureName + '". ' + vResult);}
		return vResult;}
	else {
		vRequest.get();
		$('#' + pItemId).trigger('apexrefresh');}
	vRequest = null;
}

function disTimeItem(pId, pTime) {
	if ($('#' + pId).length != 0) {
		document.getElementById(pId).disabled = true;
		setTimeout(function() {document.getElementById(pId).disabled = false;}, pTime);}
}

// ########################### //
// ########################### //
// ########################### //

/*function createLot(OperationType) {
    var NettoQTY = document.getElementsByName('f01');
    var SubDiv = $v('P1_STORAGE_UNIT').toUpperCase();
    if ($v('P1_PACK_TYPE_HID') == 'НАСЫПЬ' &&
        Number(NettoQTY[0].value) <= 55 &&
        SubDiv.indexOf('ВЕСЫ') == -1)
     {if (confirm('Вы собираетесь погрузить вагон с весом "' + NettoQTY[0].value + '" без взвешивания.\nДанное предупреждение информирует о том, что вагон уйдет с весом "' + NettoQTY[0].value + '" с предприятия.\nПодтверждаете погрузку вагона?\nВ случае отказа в поле "Складское подразделение" выберите соответствующее наименование для взвешивания в системе из перечисленных: "***: Весы".'))
       {}
      else
       {return false;}}
 }*/