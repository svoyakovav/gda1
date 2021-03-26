function openModal(pModalName, pTitleName) {if (pTitleName != '') {$('#' + pModalName).dialog('option', 'title', pTitleName);} $('#' + pModalName).dialog('open');}
function closeModal(pModalName) {$('#' + pModalName).dialog('close');}
function scriptStop(pMessage) {if (pMessage != '') {alert(pMessage);} throw new Error("stop");}
function submitPage(pValue) {if (pValue != '') {document.getElementById('P1_MENU_ITEM').value = pValue;} apex.submit({showWait: 'True'});}
function searchOnLine(pLine, pSearch) {if (pLine.toUpperCase().indexOf(pSearch) >= 0) {return 1;} else {return 0;}}
function disTimeItem(pId, pTime) {if ($('#' + pId).length != 0) {document.getElementById(pId).disabled = true; setTimeout(function() {document.getElementById(pId).disabled = false;}, pTime);}}

function setSize(pSelector, pOffsetX, pOffsetY) {
	$(pSelector).css({
		width: window.innerWidth - $(pSelector).offset().left + pOffsetX + 'px',
		height: window.innerHeight - $(pSelector).offset().top + pOffsetY + 'px'
	});
}

function upItem(pItem, pSelector) {
	var vRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=', 0);
	$.each($(pSelector), function() {vRequest.add(this.id, $v(this.id));});
	vRequest.get();
	$('#' + pItem).trigger('apexrefresh');
	vRequest = null;
}

function dbQuery(pProcessName, pArraySign, pLine, pAttr1, pAttr2, pAttr3, pAttr4, pAttr5) {
	var vRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=' + pProcessName, 0);
	vRequest.addParam('x01', pLine);
	vRequest.addParam('x02', pAttr1);
	vRequest.addParam('x03', pAttr2);
	vRequest.addParam('x04', pAttr3);
	vRequest.addParam('x05', pAttr4);
	vRequest.addParam('x06', pAttr5);
	if (pArraySign == '1') {
		vRequest.AddArrayItems(apex.jQuery('[name=f01]'), 1);
		vRequest.AddArrayItems(apex.jQuery('[name=f02]'), 2);}
	var vResult = vRequest.get();
	if (searchOnLine(vResult, 'ORA') == 1) {scriptStop('Error Process "' + pProcessName + '>' + pLine + '". ' + vResult);}
	vRequest = null;
	return vResult;
}

function runAction(pActionName, pLine, pAttr1, pAttr2, pAttr3, pAttr4, pAttr5) {
	var vData = '';
	switch(pActionName) {
		case 'UnitClean':
			vData = dbQuery('UnitClean', '1');
			if (vData != '') {scriptStop('Действие невозможно:\n# ' + vData);} else {submitPage('');}
			break;
		case 'UnitDebit':
			vData = dbQuery('UnitAddAction', '1', 'UnitDebit');
			if (vData != '') {scriptStop('Действие невозможно:\n# ' + vData);} else {submitPage('');}
			break;
		case 'UnitClick':
			gVar01 = pLine;
			gVar02 = pAttr2;
			var vArray = pAttr1.split('|');
			//vArray[0] - признак обработки приходования партии: 1 - в обработке; 0 - нет;
			//vArray[1] - тип единицы: CAR/CONT;
			//vArray[2] - текущее состояние единицы: "RUN" - вып.; "ERR" - ошибка; "WAR" - предупр.; null - нет;
			//vArray[3] - ид. номенклатуры для назначения заказа: 0 - нет;
			$s('P1_ORDER_INVENTORY', vArray[3]);
			var vMenu = ["tdMenuUnitData", "Информация по единице", "runAction('UnitData')", (vArray[1] == 'CAR') ? '1' : '0',
						 "tdMenuAddOrder", "Назначить заказ", "runAction('ModalAddOrder')", (vArray[2] == '' && vArray[1] == 'CAR' && vArray[3] != '0') ? '1' : '0',
						 "tdMenuDebitClean", "Убрать с приходования", "runAction('UnitDebitClean')", (vArray[0] == '1') ? '1' : '0'];
			for (var i = 0; i < vMenu.length / 4; i++) {
				if (vMenu[i * 4 + 3] == '0') {
					document.getElementById(vMenu[i * 4]).innerHTML = '<font color="#ABABAB">' + vMenu[i * 4 + 1] + '</font>';}
				else {
					document.getElementById(vMenu[i * 4]).innerHTML = '<a href="javascript:onClick=' + vMenu[i * 4 + 2] + ';">' + vMenu[i * 4 + 1] + '</a>';}}
			var vObjMenu = document.getElementById('UnitMenu');
			var vObjCurr = document.getElementById('unit' + pLine);
			vObjMenu.style.display = "block";
			$(vObjMenu).offset({top:$(vObjCurr).offset().top - 8, left:$(vObjCurr).offset().left + 8});
			break;
		case 'UnitDebitClean':
			if (confirm('Убрать единицу "' + gVar02 + '" с приходования?')) {
				vData = dbQuery('UnitDebitClean', '0', gVar01);
				if (vData != '') {scriptStop('Действие невозможно:\n# ' + vData);} else {submitPage('');}
			}
			break;
		case 'UnitNullUnload':
			vData = dbQuery('UnitAddAction', '1', 'NullUnload');
			if (vData != '') {scriptStop('Действие невозможно:\n# ' + vData);} else {submitPage('');}
			break;
		case 'UnitData':
			vData = dbQuery('UnitData', '0', gVar01);
			$("#ModalData").dialog("option", "height", "auto");
			document.getElementById('ModalData').innerHTML = vData;
			document.getElementById('ButModalData1').style.display = 'none';
			openModal('ModalData', 'Доп. сведения по единице "' + gVar02 + '"');
			break;
		case 'BeforeUnitUnload':
			vData = dbQuery('BeforeUnitUnload', '1');
			if (vData.length < 50) {
				scriptStop('Действие невозможно:\n# ' + vData);}
			else {
				$("#ModalData").dialog("option", "height", 400);
				document.getElementById('ModalData').innerHTML = vData;
				document.getElementById('ButModalData1').style.display = '';
				openModal('ModalData', 'Доп. сведения для операции "Разгрузка"');}
			break;
		case 'UnitUnload':
			vData = dbQuery('UnitAddAction', '1', 'UnitUnload');
			if (vData != '') {scriptStop('Действие невозможно:\n# ' + vData);} else {submitPage('');}
			break;
		case 'ModalAddOrder':
			upItem('P1_ORDER_HEADER', '#P1_ORDER_INVENTORY');
			openModal('ModalOrder', 'Перечень заказов "' + gVar02 + '"');
			break;
		case 'SelectOrder':
			vData = dbQuery('SelectOrder', '0', pLine);
			$s('P1_ORDER_QTY', vData);
			break;
		case 'UnitAddOrder':
			vData = dbQuery('UnitAddOrder', '0', gVar02, $v('P1_ORDER_HEADER'), $v('P1_ORDER_LINE'));
			if (vData != '') {scriptStop('Действие невозможно:\n# ' + vData);} else {submitPage('');}
			break;
		case 'PrintSupply':
			vData = dbQuery('PrintSupply', '1');
			window.open(vData, "_blank");
			break;
		default:
			scriptStop('Ошибка выполнения функции "runAction". Операция "' + pActionName + '" не определена');
	}
	//console.log('gVar01 = ' + gVar01 + '; gVar02 = ' + gVar02);
}

function expExcel(pTableId, pFileName) {
	var vTable = document.getElementById(pTableId);
	var vData = "<table border='2px'>";
	for (var j = 0; j < vTable.rows.length; j++) {vData = vData + "<tr>" + vTable.rows[j].innerHTML + "</tr>";}
	vData = vData + "</table>";
	vData = vData.replace(/<th/g, "<th bgcolor='#B8D8EB'");
	//vData = vData.replace(/<A[^>]*>|<\/A>/g, ""); // remove if u want links in your table
	//vData = vData.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
	//vData = vData.replace(/<input[^>]*>|<\/input>/gi, ""); // remove input
	
	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE "); 
	
	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer
		txtArea1.document.open("txt/html","replace");
		txtArea1.document.write(vData);
		txtArea1.document.close();
		txtArea1.focus(); 
		var sa = txtArea1.document.execCommand("SaveAs", true, pFileName);}  
	else //other browser not tested on IE 11
		var sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(vData));  
	
	return sa;
}