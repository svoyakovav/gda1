function openModal(pModalName, pTitleName) {if (pTitleName != '') {$('#' + pModalName).dialog('option', 'title', pTitleName);} $('#' + pModalName).dialog('open');}
function closeModal(pModalName) {$('#' + pModalName).dialog('close');}
function scriptStop(pMessage) {if (pMessage != '') {alert(pMessage);} throw new Error("stop");}
function submitPage(pValue) {if (pValue != '') {document.getElementById('P1_MENU_ITEM').value = pValue;} apex.submit({showWait: 'True'});}
function disTimeItem(pId, pTime) {if ($('#' + pId).length != 0) {document.getElementById(pId).disabled = true; setTimeout(function() {document.getElementById(pId).disabled = false;}, pTime);}}
function searchOnLine(pLine, pSearch) {if (pLine.toUpperCase().indexOf(pSearch) >= 0) {return 1;} else {return 0;}}

function divSize(pDivId, pOffsetX, pOffsetY) {
	if ($("div").is(pDivId)) {
		$(pDivId).css({
			width: window.innerWidth - $(pDivId).offset().left + pOffsetX + 'px',
			height: window.innerHeight - $(pDivId).offset().top + pOffsetY + 'px'
		});
	}
}

function upItem(pItem, pSelector) {
	var vRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=', 0);
	$.each($(pSelector), function() {vRequest.add(this.id, $v(this.id));});
	vRequest.get();
	$('#' + pItem).trigger('apexrefresh');
	vRequest = null;
}

function dbQuery(pProcessName, pSelector, pLine, pAttr1, pAttr2, pAttr3, pArrayQty) {
	var vRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=' + pProcessName, 0);
	vRequest.addParam('x01', pLine);
	vRequest.addParam('x02', pAttr1);
	vRequest.addParam('x03', pAttr2);
	vRequest.addParam('x04', pAttr3);
	if (pSelector != '') {$.each($(pSelector), function() {vRequest.add(this.id, $v(this.id));});}
	if (pArrayQty != undefined) {for (var i = 1; i <= pArrayQty; i++) {vRequest.AddArrayItems(apex.jQuery('[name=f' + ((i <= 9) ? '0' + i : i) + ']'), i);}}
	var vResult = vRequest.get();
	if (searchOnLine(vResult, 'ORA-') == 1) {scriptStop('Error Process "' + pProcessName + '". ' + vResult);}
	vRequest = null;
	return vResult;
}

function runAction(pActionName, pLine, pAttr1, pAttr2, pAttr3, pAttr4, pAttr5) {
	var vData = '';
	switch(pActionName)

	{
		case 'ClickCont':
			gRowId = pLine; // P1_CONT_ID
			gVar01 = pAttr1; // P1_CONT_NUMBER_HID
			$s('P1_GX03', pAttr2); // P1_ORG_ID
			gVar02 = pAttr3; // car_id
			gVar03 = pAttr4; // car_number
			var vArray = pAttr5.split('|');
			
			//vArray[0] - признак контейнера под погрузкой: 1 - подан; 0 - убран
			//vArray[1] - текущее состояние контейнера: "RUN" - вып.; "ERR" - ошибка; "WAR" - предупр.; null - нет
			//vArray[2] - признак загруженности: 1 - груженый; 0 - порожний
			//vArray[3] - наличие хидера погрузки: 1 - есть; 0 - нет
			//vArray[4] - наличие платформы: 1 - есть; 0 - нет
			//vArray[5] - признак перемещения партии: 0 - запрещено; 1 - разрешено
			var vMenu = ["tdMenuData", "Информация по контейнеру", "runAction('ContData')", (vArray[0] == '1') ? '1' : '0',
						 "tdMenuCheck", "Погрузка", "runAction('ContCheck')", (vArray[0] == '1' && vArray[1] == '' && vArray[2] == '0') ? '1' : '0',
						 "tdMenuUnload", "Выгрузка", "runAction('ContUnloading')", (vArray[0] == '1' && vArray[1] == '' && vArray[2] == '1' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuDeclaration", "Формировать декларацию", "runAction('DeclarationShape')", (vArray[1] == '' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuSertificat", "Формировать сертификат качества", "runAction('SertificatShape')", (vArray[1] == '' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuSprut", "Корректировать ЗПУ", "runAction('SprutSelect')", (vArray[1] == '' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuClean", "Убрать платформу", "runAction('CarClean')", (vArray[0] == '1' && vArray[1] == '' && vArray[4] == '1') ? '1' : '0',
						 "tdMenuError", "Сведения об ошибке", "runAction('ContError')", (vArray[1] == 'ERR') ? '1' : '0',
						 "tdMenuUpdate", "Обновить операцию в АСУТЛ", "runAction('ActionUpdate')", (vArray[0] == '1' && vArray[1] == 'ERR') ? '1' : '0',
						 "tdMenuMove", "Переместить на КП", "runAction('LotMove')", (vArray[5] == '1' && vArray[1] == '' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuWeight", "Корректировать веса и паллеты", "runAction('WeightSelect')", (vArray[1] == '' && vArray[3] == '1') ? '1' : '0',
						 "tdMenuSpoil", "Установить неисправность", "runAction('OpenSpoil')", (vArray[1] == '' && vArray[3] == '1') ? '1' : '0'
						 //"tdMenuTransfer", "Передать данные по погрузке в АСУТЛ", "runAction('TransferCar', '', '')", (vArray[0] == '1' && vArray[1] == 'WAR' && vArray[2] == '0' && vArray[3] == '1') ? '1' : '0',
						 ];
			
			for (var i = 0; i < vMenu.length / 4; i++) {
				if (vMenu[i * 4 + 3] == '0') {document.getElementById(vMenu[i * 4]).innerHTML = '<font color="#ABABAB">' + vMenu[i * 4 + 1] + '</font>';}
				else {document.getElementById(vMenu[i * 4]).innerHTML = '<a href="javascript:onClick=' + vMenu[i * 4 + 2] + ';">' + vMenu[i * 4 + 1] + '</a>';}}
			var vObjMenu = document.getElementById('MenuFront');
			var vObjCurr = document.getElementById('cont' + pLine);
			vObjMenu.style.display = "block";
			$(vObjMenu).offset({top:$(vObjCurr).offset().top - 8, left:$(vObjCurr).offset().left + 8});
			break;
			
		//elt 2018-03-21
		case 'OpenSpoil':
			vData = dbQuery('ActionSpoil', '', 'SelectSpoil', $v('SearchSpoil'), '', '', '') 
			document.getElementById('ModalData').innerHTML = vData;
			document.getElementById('ButModalData1').style.display = 'none';
			openModal('ModalData', 'Справочник неисправностей и браков "' + gVar01 + '"');
			break;
		case 'AddSpoil':
			// confirm('Подтверждаете установку ' + ((pAttr2 == '0') ? 'брака' : 'неисправности') + ' c кодом "' + pAttr1 + '"?')
			if (confirm('Подтверждаете операцию установки ?')) {
				vData = dbQuery('ActionSpoil', '', 'AddSpoil', gRowId + '|' + pLine + '|' + pAttr2, '', '', '') 
				if (vData == '') {alert('Операция завершена успешно');  closeModal('ModalData');} 
				   else {alert('ERROR. ' + vData);};   
				   }; 
   		break;
			
		case 'ContData':
			vData = dbQuery(pActionName, '', gRowId);
			document.getElementById('ModalData').innerHTML = vData;
			document.getElementById('ButModalData1').style.display = 'none';
			openModal('ModalData', 'Доп. сведения по контейнеру "' + gVar01 + '"');
			break;
		case 'ContCheck':
			vData = dbQuery(pActionName, '', gRowId);
			if (vData.length > 30) {alert(vData.replace(/[*]/g, '\n# '));}
			else {
				var vArray = vData.split('|');
				var vTitle = 'Погрузка контейнера "' + gVar01 + '" (Списание ингредиента: "' + ((vArray[0] == '1') ? 'ON' : 'OFF') + '"; Способ упаковки: "' + vArray[5] + '")';
				$.each($('div.divCreateLot .ItemCustom'), function() {$s(this.id, '');});
				$.each($('div#ModalSprut .ItemCustom:disabled'), function() {$s(this.id, 'РЖД');});
				document.getElementById('ButModalSprut1').style.display = 'none';
				$s('P1_REMOVE_INGREDIENT_HID', vArray[0]);
				$s('P1_GX02', vArray[5]); // pack_type
				if (vArray[0] == '0') {$s('P1_AUTO_COMPLETE', '1'); $("#P1_AUTO_COMPLETE").attr('disabled', true);} // Признак списания ингредиента в ПЗ (не списывать)
				else if (vArray[1] == '1') {$s('P1_AUTO_COMPLETE', '0'); $("#P1_AUTO_COMPLETE").attr('disabled', true);} // Способ списания ингредиента (только ручной)
				else if (vArray[1] == '2') {$s('P1_AUTO_COMPLETE', '1'); $("#P1_AUTO_COMPLETE").attr('disabled', true);} // Способ списания ингредиента (только автоматический)
				else {$s('P1_AUTO_COMPLETE', '1'); $("#P1_AUTO_COMPLETE").attr('disabled', false);}
				if (vArray[2] == '1') {$("#P1_WEIGHT_TARE_CONT").attr('disabled', false); document.getElementById('P1_WEIGHT_TARE_CONT').style.background='#FFFF80';}
				else {$("#P1_WEIGHT_TARE_CONT").attr('disabled', true); document.getElementById('P1_WEIGHT_TARE_CONT').style.background='#E5E5E5';}
				if (vArray[4] == '1') {$("#P1_PALET").attr('disabled', false);}
				else {$("#P1_PALET").attr('disabled', true);}
				if (vArray[3] == '1') {$("#ButModalLoad1").attr('disabled', false);}
				else {$("#ButModalLoad1").attr('disabled', true);}
				//$x_HideItemRow("P1_WEIGHT_BRUTTO");
				upItem('P1_STORAGE_UNIT', '#P1_GX03');
				openModal('ModalCreateLot', vTitle);}
			break;
		case 'IngredientRefresh':
			upItem('InformCreateLotNum', '#P1_AUTO_COMPLETE' /*'div#ModalCreateLot .ItemCustom'*/);
			break;
		case 'ConversionWeight':
			var vItem = pLine.substr(6);
			var vQty = document.getElementById(pLine).value;
			if (vQty != '') {vData = dbQuery(pActionName, '', pLine, vQty);} else {vData = '||';}
			if (vData.length > 30) {alert(vData);}
			else {
				var vArray = vData.split('|');
				document.getElementById('nettoi' + vItem).value = vArray[0];
				document.getElementById('pallet' + vItem).value = vArray[1];
				document.getElementById('brutto' + vItem).value = vArray[2];}
			break;
		case 'ContLoading':
			var vMessage = '';
			switch(pLine) {
				case 'Normal': vMessage = 'Подтверждаете погрузку контейнера "' + gVar01 + '"?'; break;
				case 'Virtual': vMessage = 'Подтверждаете фиктивную погрузку контейнера "' + gVar01 + '"?'; break;
				default: scriptStop('Тип погрузки "' + pLine + '" не определен');}
			if (confirm(vMessage)) {
				vData = dbQuery(pActionName, 'div.divCreateLot .ItemCustom', gRowId, pLine, $v('P1_GX02'), '', 17);
				if (vData != '') {alert(vData);} else {submitPage('');}}
			break;
		case 'ContUnloading':
			var vMessage = 'Причина выгрузки ' + ((gVar03 != '') ? 'платформы' : 'контейнера') + ' "' + ((gVar03 != '') ? gVar03 : gVar01) + '"';
			var vReason = prompt(vMessage, '');
			if (vReason == null) {scriptStop('');}
			if (vReason == '') {scriptStop('Укажите причину');}
			vData = dbQuery(pActionName, '', gRowId, gVar02, vReason);
			if (vData != '') {alert(vData);} else {submitPage('');}
			break;
		case 'DeclarationShape':
			if (confirm('Подтверждаете операцию формирования?')) {
				vData = dbQuery(pActionName, '', gRowId);
				if (vData != '') {alert(vData);} else {alert('Документ отправлен на формирование');}}
			break;
			
/*20-09-2018*/			
		case 'SertificatShape':
			if (confirm('Подтверждаете операцию формирования?')) {
				vData = dbQuery(pActionName, '', gRowId);
				if (vData != '') {alert(vData);} else {alert('Документ отправлен на формирование');}}
			break;
			
		case 'SprutSelect':
			vData = dbQuery(pActionName, '', gRowId);
			var vArray = vData.split('|');
			$.each($('div#ModalSprut .ItemCustom:disabled'), function() {$s(this.id, 'РЖД');});
			$s('P1_SPRUT_TYPE', vArray[0]);
			$s('P1_SPRUT_ADD', vArray[1]);
			for (var i = 1; i < vArray.length - 1; i++) {
				$s('P1_SPRUT_S' + i, vArray[i + 1].substr(3, 1));
				$s('P1_SPRUT_N' + i, vArray[i + 1].substr(4));}
			document.getElementById('ButModalSprut1').style.display = '';
			openModal('ModalSprut', 'Корректировка ЗПУ "' + gVar01 + '"');
			break;
		case 'SprutUpdate':
			//var va = ''; $.each($('div#ModalSprut .ItemCustom'), function() {va += this.id + ' / ' + $v(this.id) + '\n';}); alert(va);
			if (confirm('Подтверждаете обновление?')) {
				vData = dbQuery(pActionName, 'div#ModalSprut .ItemCustom', gRowId);
				if (vData == '') {alert('Обновление завершено успешно'); closeModal('ModalSprut');} else {alert(vData);}}
			break;
		case 'CarClean':
			if (confirm('Подтверждаете уборку платформы "' + gVar03 + '"?')) {
				vData = dbQuery(pActionName, '', gVar02); // car_id
				if (vData != '') {alert(vData.replace(/[*]/g, '\n'));} else {submitPage('');}}
			break;
		case 'ContError':
			vData = dbQuery(pActionName, '', gRowId, gVar01);
			alert(vData.replace(/[*]/g, '\n'));
			break;
		case 'ActionUpdate':
			vData = dbQuery(pActionName, '', gRowId, gVar01);
			if (vData != '') {alert(vData);} else {submitPage('');}
			break;
		case 'LotMove':
			if (confirm('Подтверждаете операцию перемещения?')) {
				vData = dbQuery(pActionName, '', gRowId, $v('P1_GX03'));
				if (vData != '') {alert(vData);} else {/*alert('Партия перемещена');*/ submitPage('');}}
			break;
		case 'DeclarationPrint':
			vData = dbQuery(pActionName, '', '', '', '', '', 1);
			if (vData.length < 50) {alert(vData);} else {window.open(vData, "_blank");}
			break;
		case 'WeightSelect':
			vData = dbQuery(pActionName, '', gRowId);
			document.getElementById('ModalData').innerHTML = vData;
			document.getElementById('ButModalData1').style.display = '';
			openModal('ModalData', 'Корректировка весов контейнера "' + gVar01 + '"');
			break;
		case 'WeightUpdate':
			if (confirm('Подтверждаете обновление весов?')) {
				vData = dbQuery(pActionName, '', gRowId, '', '', '', 5);
				if (vData != '') {alert(vData);} else {alert('Операция завершена успешно !'); closeModal('ModalData');}}
			break;
		default:
			scriptStop('Ошибка выполнения функции "runAction". Операция "' + pActionName + '" не определена');
	}
	//console.log(pActionName + ' / gRowId: ' + gRowId + ' / gVar01: ' + gVar01 + ' / gVar02: ' + gVar02 + ' / gVar03: ' + gVar03);
}