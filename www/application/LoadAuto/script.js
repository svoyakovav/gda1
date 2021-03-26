function openModalForm(pModal) {$(pModal).dialog('open');}
function closeModalForm(pModal) {$(pModal).dialog('close');}
//function disableF5(e) {if ((e.which || e.keyCode) == 116) {e.preventDefault();}};
function asVar(pName, pIncom1, pIncom2) {
  switch(pName) {
    case 'DeliveryEdit':
      $s('P1_GX01', pIncom1);
      $s('P1_GX02', 'Edit');
	  sDelivery(pIncom1, '1');
      break;
	case 'DeliveryCreate':
	  $s('P1_GX01', pIncom1);
	  $s('P1_GX02', 'Create');
	  sAddData('SelectUnloadingPoint');
	  sDelivery('0', '0');
	  break;
	case 'CheckAllDelivery':
	  sDelivery(pIncom1, '0');
	  closeModalForm('#AddModalWindow');
	  break;
	case 'CreateLot':
	  $s('P1_GX01', pIncom1);
	  $s('P1_CARGO_WEIGHT', '');
	  $s('P1_SEATS_QUANTITY', '');
	  $s('P1_WEIGHT_BRUTTO', '');
	  $('#ModalCreateLot').dialog('option', 'title', 'Создание партии (Заказ: ' + pIncom2 + ')');
	  $('#ModalCreateLot').dialog('open');
	  //openModalForm('#ModalCreateLot');
	  break;
  }
}

/*function openModalDelivery() {
  if (document.getElementById('P1_MENU_ITEM').value == 'SHIPMENT_AUTO' && document.getElementById('P1_GX03').value != 'True') {
    $("#P1_PERIOD_DELIVERY").datepicker('disable');
    $("#P1_TIME_ACTION_SKIPPING").attr('disabled', true);
    $("#P1_TIME_START_SKIPPING").datepicker('disable');
    $("#P1_TIME_END_SKIPPING").datepicker('disable');
    $("#P1_SPECIAL_NOTES_SKIPPING").attr('disabled', true);
    $("#P1_APP_NUMBER_SKIPPING").attr('disabled', true);
    $("#P1_DATE_FEED_LOAD_SKIPPING").datepicker('disable');
    $x_disableItem('P1_ORGANIZATIONS_CARRY', true);
    $x_disableItem('P1_CUSTOMER', true);
    $("#P1_UNLOADING_POINT").attr('disabled', true);
    $x_disableItem('P1_AVAILABILITY_CONTAINER', true);
    $("#P1_NUMBER_ATTORNEY").attr('disabled', true);
    $("#P1_EXTRADITION_ATTORNEY").datepicker('disable');
    $("#P1_TERM_ATTORNEY").datepicker('disable');
    $("#P1_GEORGIA_ADOPTED").attr('disabled', true);
    $("#P1_STAMP_VEHICLE").attr('disabled', true);
    $("#P1_NUMBER_VEHICLE").attr('disabled', true);
    $x_disableItem('P1_CARD_VEHICLE', true);
    $("#P1_LICENSE_VEHICLE").attr('disabled', true);
    $("#P1_CARD_SERIES_VEHICLE").attr('disabled', true);
    $("#P1_CARD_NUM_VEHICLE").attr('disabled', true);
    $("#P1_TRAILER_STAMP_1_VEHICLE").attr('disabled', true);
    $("#P1_TRAILER_NUM_1_VEHICLE").attr('disabled', true);
    $("#P1_TRAILER_STAMP_2_VEHICLE").attr('disabled', true);
    $("#P1_TRAILER_NUM_2_VEHICLE").attr('disabled', true);
    $("#P1_DRIVER").attr('disabled', true);
    $("#P1_SHEET_DRIVER").attr('disabled', true);
    $("#P1_CERTIFICATE_DRIVER").attr('disabled', true);
    $("#P1_PRINT_DRIVER").attr('disabled', true);}
  else {
    $("#P1_PERIOD_DELIVERY").datepicker('enable'); 
    $("#P1_TIME_ACTION_SKIPPING").attr('disabled', false);
    $("#P1_TIME_START_SKIPPING").datepicker('enable'); 
    $("#P1_TIME_END_SKIPPING").datepicker('enable');
    $("#P1_SPECIAL_NOTES_SKIPPING").attr('disabled', false);
    $("#P1_APP_NUMBER_SKIPPING").attr('disabled', false);
    $("#P1_DATE_FEED_LOAD_SKIPPING").datepicker('enable');
    $x_disableItem('P1_ORGANIZATIONS_CARRY', false);
    $x_disableItem('P1_CUSTOMER', false);
    $("#P1_UNLOADING_POINT").attr('disabled', false);
    $x_disableItem('P1_AVAILABILITY_CONTAINER', false);
    $("#P1_NUMBER_ATTORNEY").attr('disabled', false);
    $("#P1_EXTRADITION_ATTORNEY").datepicker('enable');
    $("#P1_TERM_ATTORNEY").datepicker('enable');
    $("#P1_GEORGIA_ADOPTED").attr('disabled', false);
    $("#P1_STAMP_VEHICLE").attr('disabled', false);
    $("#P1_NUMBER_VEHICLE").attr('disabled', false);
    $x_disableItem('P1_CARD_VEHICLE', false);
    $("#P1_LICENSE_VEHICLE").attr('disabled', false);
    $("#P1_CARD_SERIES_VEHICLE").attr('disabled', false);
    $("#P1_CARD_NUM_VEHICLE").attr('disabled', false);
    $("#P1_TRAILER_STAMP_1_VEHICLE").attr('disabled', false);
    $("#P1_TRAILER_NUM_1_VEHICLE").attr('disabled', false);
    $("#P1_TRAILER_STAMP_2_VEHICLE").attr('disabled', false);
    $("#P1_TRAILER_NUM_2_VEHICLE").attr('disabled', false);
    $("#P1_DRIVER").attr('disabled', false);
    $("#P1_SHEET_DRIVER").attr('disabled', false);
    $("#P1_CERTIFICATE_DRIVER").attr('disabled', false);
    $("#P1_PRINT_DRIVER").attr('disabled', false);}
  openModalForm('#ModalDelivery')
}*/

function sDelivery(pDeliveryId, pSelectAdd) {
  var ajaxRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=SDelivery', 0);
  ajaxRequest.addParam('x01', pDeliveryId);
  var gReturn = ajaxRequest.get();
  if (gReturn.indexOf('ORA') >= 0) {alert(gReturn); return;}
  var a = gReturn.split('|');
  
  $s('P1_PERIOD_DELIVERY', a[0]);
  $s('P1_SKIPPING', a[1] + ', ' + a[2] + ', ' + a[3] + ', ' + a[4] + ', ' + a[5] + ', ' + a[6]);
  $s('P1_TIME_ACTION_SKIPPING', a[1]);
  $s('P1_TIME_START_SKIPPING', a[2]);
  $s('P1_TIME_END_SKIPPING', a[3]);
  $s('P1_SPECIAL_NOTES_SKIPPING', a[4]);
  $s('P1_APP_NUMBER_SKIPPING', a[5]);
  $s('P1_DATE_FEED_LOAD_SKIPPING', a[6]);
  document.getElementById('P1_ORGANIZATIONS_CARRY').value = a[7]; document.getElementById('P1_ORGANIZATIONS_CARRY_HIDDENVALUE').value = a[8];
  document.getElementById('P1_CUSTOMER').value = a[9]; document.getElementById('P1_CUSTOMER_HIDDENVALUE').value = a[10];
  if (pSelectAdd == '1') {
    $s('P1_UNLOADING_POINT', a[11]);}
  $s('P1_AVAILABILITY_CONTAINER', a[12]);
  $s('P1_ATTORNEY', a[13] + ', ' + a[14] + ', ' + a[15]);
  $s('P1_NUMBER_ATTORNEY', a[13]);
  $s('P1_EXTRADITION_ATTORNEY', a[14]);
  $s('P1_TERM_ATTORNEY', a[15]);
  $s('P1_GEORGIA_ADOPTED', a[16]);
  $s('P1_VEHICLE', a[17] + ', ' + a[18] + ', ' + a[19] + ', ' + a[20] + ', ' + a[21] + ', ' + a[22] + ', ' + a[23] + ', ' + a[24] + ', ' + a[25] + ', ' + a[26]);
  $s('P1_STAMP_VEHICLE', a[17]);
  $s('P1_NUMBER_VEHICLE', a[18]);
  $s('P1_CARD_VEHICLE', a[19]);
  $s('P1_LICENSE_VEHICLE', a[20]);
  $s('P1_CARD_SERIES_VEHICLE', a[21]);
  $s('P1_CARD_NUM_VEHICLE', a[22]);
  $s('P1_TRAILER_STAMP_1_VEHICLE', a[23]);
  $s('P1_TRAILER_NUM_1_VEHICLE', a[24]);
  $s('P1_TRAILER_STAMP_2_VEHICLE', a[25]);
  $s('P1_TRAILER_NUM_2_VEHICLE', a[26]);
  $s('P1_DRIVER', a[27]);
  $s('P1_INFORMATION_DRIVER', a[28] + ', ' + a[29] + ', ' + a[30]);
  $s('P1_SHEET_DRIVER', a[28]);
  $s('P1_CERTIFICATE_DRIVER', a[29]);
  $s('P1_PRINT_DRIVER', a[30]);
  $s('P1_MASS_DETERMINATION', a[31]);
  $s('P1_ACCOMPANYING_DOCUMENTS', a[32]);
  $s('P1_NUMBER_SHEETS', a[33]);
  $s('P1_INFORM_SPRUT', a[34] + ', ' + a[35] + ', ' + a[36] + ', ' + a[37] + ', ' + a[38] + ', ' + a[39] + ', ' + a[40] + ', ' + a[41] + ', ' + a[42]);
  $s('P1_TYPE_SPRUT', a[34]);
  $s('P1_SPRUT_1', a[35]);
  $s('P1_SPRUT_2', a[36]);
  $s('P1_SPRUT_3', a[37]);
  $s('P1_SPRUT_4', a[38]);
  $s('P1_SPRUT_5', a[39]);
  $s('P1_SPRUT_6', a[40]);
  $s('P1_SPRUT_7', a[41]);
  $s('P1_SPRUT_8', a[42]);
  openModalForm('#ModalDelivery')
  ajaxRequest = null;
}

function opAdd(pOpName, pIncom1, pIncom2) {
  var ajaxRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=' + pOpName, 0);
  
  switch(pOpName) {
    case 'CreateLot':
      var vDeliveryLineId = document.getElementById('P1_GX01').value;
	  ajaxRequest.add('P1_GX01', vDeliveryLineId);
      ajaxRequest.add('P1_CARGO_WEIGHT', document.getElementById('P1_CARGO_WEIGHT').value);
	  ajaxRequest.add('P1_SEATS_QUANTITY', document.getElementById('P1_SEATS_QUANTITY').value);
	  ajaxRequest.add('P1_WEIGHT_BRUTTO', document.getElementById('P1_WEIGHT_BRUTTO').value);
      var gReturn = ajaxRequest.get();
	  if (gReturn.length > 10) {alert(gReturn); return;}
	  //if (gReturn.length > 10) {alert(vData.replace(/[*]/g, '\n# '));}
      closeModalForm('#ModalCreateLot');
      ajaxRequest = null;
	  opAdd('PickReleaseStart', /*vDeliveryLineId*/ gReturn);
      break;
    case 'PickReleaseStart':
	  ajaxRequest.addParam('x01', pIncom1);
	  var gReturn = ajaxRequest.get();
	  if (gReturn != '') {alert('Ошибка выполнения функции "PickReleaseStart". ' + gReturn);}
	  ajaxRequest = null;
	  apex.submit({showWait: 'True'});
      break;
    case 'PickReleaseFinish':
	  if (confirm('Подтверждаете комплектование партии "' + pIncom2 + '"?')) {
	    ajaxRequest.addParam('x01', pIncom1);
	    ajaxRequest.addParam('x02', pIncom2);
	    var gReturn = ajaxRequest.get();
	    if (gReturn != '') {alert(gReturn); return;}
	    ajaxRequest = null;
		apex.submit({showWait: 'True'});}
      break;
    case 'ShipmentConfirm':
	  if (confirm('Выполнить подтверждение отгрузки?')) {
	    ajaxRequest.addParam('x01', pIncom1);
	    ajaxRequest.addParam('x02', pIncom2);
	    var gReturn = ajaxRequest.get();
	    if (gReturn != '') {alert(gReturn); return;}
	    ajaxRequest = null;
		apex.submit({showWait: 'True'});}
      break;
    case 'QueueInvoice':
	  ajaxRequest.addParam('x01', pIncom1);
	  ajaxRequest.addParam('x02', document.getElementById('P1_GX01').value);
	  ajaxRequest.addParam('x03', pIncom2);
	  var gReturn = ajaxRequest.get();
	  if (gReturn != '') {alert(gReturn); return;} else {alert('Документ отправлен на формирование');}
	  ajaxRequest = null;
      break;
    case 'UnloadInvoice':
	  ajaxRequest.AddArrayItems(apex.jQuery('[name=f01]'),01);
	  var gReturn = ajaxRequest.get();
	  if (gReturn.indexOf('ORA') >= 0) {alert(gReturn); return;}
	  var a = gReturn.split('|');
      for (var i = 0; i < a.length; i++) {window.open(a[i], "_blank");}
	  ajaxRequest = null;
      break;
  }
}

function opDelivery() {
  var vConf = '';
  var vOpName = document.getElementById('P1_GX02').value;
  if (vOpName == 'Create') {vConf = 'Подтверждаете создание доставки?';}
  else if (vOpName == 'Edit') {vConf = 'Подтверждаете обновление доставки?';}
  else {alert('Тип операции не определен'); return;}
  
  if (confirm(vConf)) {
    var ajaxRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=OpDelivery', 0);
    ajaxRequest.add('P1_GX02', vOpName);
    ajaxRequest.add('P1_GX01', document.getElementById('P1_GX01').value);
	/*if (vOpName == 'Create') {ajaxRequest.AddArrayItems(apex.jQuery('[name=f15]'),15);}
    else if (vOpName == 'Edit') {ajaxRequest.add('P1_GX01', document.getElementById('P1_GX01').value);}
    else {return;}*/
	// Аттрибуты "Сведения о пропуске/заявке"
    ajaxRequest.add('P1_TIME_ACTION_SKIPPING', document.getElementById('P1_TIME_ACTION_SKIPPING').value);
    ajaxRequest.add('P1_TIME_START_SKIPPING', document.getElementById('P1_TIME_START_SKIPPING').value);
    ajaxRequest.add('P1_TIME_END_SKIPPING', document.getElementById('P1_TIME_END_SKIPPING').value);
    ajaxRequest.add('P1_SPECIAL_NOTES_SKIPPING', document.getElementById('P1_SPECIAL_NOTES_SKIPPING').value);
    ajaxRequest.add('P1_APP_NUMBER_SKIPPING', document.getElementById('P1_APP_NUMBER_SKIPPING').value);
    ajaxRequest.add('P1_DATE_FEED_LOAD_SKIPPING', document.getElementById('P1_DATE_FEED_LOAD_SKIPPING').value);
    // Аттрибуты "Сведения о доверенности"
    ajaxRequest.add('P1_NUMBER_ATTORNEY', document.getElementById('P1_NUMBER_ATTORNEY').value);
    ajaxRequest.add('P1_EXTRADITION_ATTORNEY', document.getElementById('P1_EXTRADITION_ATTORNEY').value);
    ajaxRequest.add('P1_TERM_ATTORNEY', document.getElementById('P1_TERM_ATTORNEY').value);
    // Аттрибуты "Сведения о ТС"
    ajaxRequest.add('P1_STAMP_VEHICLE', document.getElementById('P1_STAMP_VEHICLE').value);
    ajaxRequest.add('P1_NUMBER_VEHICLE', document.getElementById('P1_NUMBER_VEHICLE').value);
    ajaxRequest.add('P1_CARD_VEHICLE', $f_ReturnChecked('P1_CARD_VEHICLE'));
    ajaxRequest.add('P1_LICENSE_VEHICLE', document.getElementById('P1_LICENSE_VEHICLE').value);
    ajaxRequest.add('P1_CARD_SERIES_VEHICLE', document.getElementById('P1_CARD_SERIES_VEHICLE').value);
    ajaxRequest.add('P1_CARD_NUM_VEHICLE', document.getElementById('P1_CARD_NUM_VEHICLE').value);
    ajaxRequest.add('P1_TRAILER_STAMP_1_VEHICLE', document.getElementById('P1_TRAILER_STAMP_1_VEHICLE').value);
    ajaxRequest.add('P1_TRAILER_NUM_1_VEHICLE', document.getElementById('P1_TRAILER_NUM_1_VEHICLE').value);
    ajaxRequest.add('P1_TRAILER_STAMP_2_VEHICLE', document.getElementById('P1_TRAILER_STAMP_2_VEHICLE').value);
    ajaxRequest.add('P1_TRAILER_NUM_2_VEHICLE', document.getElementById('P1_TRAILER_NUM_2_VEHICLE').value);
    // Аттрибуты "Сведения о водителе"
    ajaxRequest.add('P1_SHEET_DRIVER', document.getElementById('P1_SHEET_DRIVER').value);
    ajaxRequest.add('P1_CERTIFICATE_DRIVER', document.getElementById('P1_CERTIFICATE_DRIVER').value);
    ajaxRequest.add('P1_PRINT_DRIVER', document.getElementById('P1_PRINT_DRIVER').value);
    // Аттрибуты "ЗПУ"
    ajaxRequest.add('P1_TYPE_SPRUT', document.getElementById('P1_TYPE_SPRUT').value);
    ajaxRequest.add('P1_SPRUT_1', document.getElementById('P1_SPRUT_1').value);
    ajaxRequest.add('P1_SPRUT_2', document.getElementById('P1_SPRUT_2').value);
    ajaxRequest.add('P1_SPRUT_3', document.getElementById('P1_SPRUT_3').value);
    ajaxRequest.add('P1_SPRUT_4', document.getElementById('P1_SPRUT_4').value);
    ajaxRequest.add('P1_SPRUT_5', document.getElementById('P1_SPRUT_5').value);
    ajaxRequest.add('P1_SPRUT_6', document.getElementById('P1_SPRUT_6').value);
    ajaxRequest.add('P1_SPRUT_7', document.getElementById('P1_SPRUT_7').value);
    ajaxRequest.add('P1_SPRUT_8', document.getElementById('P1_SPRUT_8').value);
    // Аттрибуты доставки
    ajaxRequest.add('P1_PERIOD_DELIVERY', document.getElementById('P1_PERIOD_DELIVERY').value);
    ajaxRequest.add('P1_ORGANIZATIONS_CARRY', document.getElementById('P1_ORGANIZATIONS_CARRY_HIDDENVALUE').value);
    ajaxRequest.add('P1_CUSTOMER', document.getElementById('P1_CUSTOMER_HIDDENVALUE').value);
    ajaxRequest.add('P1_UNLOADING_POINT', document.getElementById('P1_UNLOADING_POINT').value);
    ajaxRequest.add('P1_AVAILABILITY_CONTAINER', $f_ReturnChecked('P1_AVAILABILITY_CONTAINER'));
    ajaxRequest.add('P1_GEORGIA_ADOPTED', document.getElementById('P1_GEORGIA_ADOPTED').value);
    ajaxRequest.add('P1_DRIVER', document.getElementById('P1_DRIVER').value);
    ajaxRequest.add('P1_MASS_DETERMINATION', document.getElementById('P1_MASS_DETERMINATION').value);
    ajaxRequest.add('P1_ACCOMPANYING_DOCUMENTS', document.getElementById('P1_ACCOMPANYING_DOCUMENTS').value);
    ajaxRequest.add('P1_NUMBER_SHEETS', document.getElementById('P1_NUMBER_SHEETS').value);
    
    var gReturn = ajaxRequest.get();
    if (gReturn != '') {alert(gReturn); return;}
	closeModalForm('#ModalDelivery');
	if (vOpName == 'Create') {apex.submit({showWait: 'True'});}
	ajaxRequest = null;
  }
}

function sAddData(pOpName, pIncom1) {
  $s('P1_GX03', pOpName);
  var ajaxRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=SAddData', 0);
  ajaxRequest.add('P1_GX03', pOpName);
  
  switch(pOpName) {
    case 'SelectAllDelivery':
    case 'UpdateAllDelivery':
	  if ($("#inBlock1").length != 0) {
        ajaxRequest.addParam('x01', document.getElementById('inBlock1').value);
        ajaxRequest.addParam('x02', document.getElementById('inBlock2').value);
	    ajaxRequest.addParam('x03', document.getElementById('inBlock3').value);
	    ajaxRequest.addParam('x04', document.getElementById('inBlock4').value);}
	  document.getElementById('AddModalWindow').innerHTML = ajaxRequest.get();
	  if (pOpName == 'SelectAllDelivery') {
	    $('#AddModalWindow').dialog('option', 'title', 'Перечень доставок');
	    $('#AddModalWindow').dialog('option', 'width', 'auto');
        $('#AddModalWindow').dialog('option', 'height', 500);
        openModalForm('#AddModalWindow');}
      break;
    case 'SelectUnloadingPoint':
      ajaxRequest.addParam('x01', document.getElementById('P1_GX01').value);
      $s('P1_UNLOADING_POINT', ajaxRequest.get());
      break;
    case 'SelectInvoices' :  
	  $s('P1_GX01', pIncom1);
	  ajaxRequest.addParam('x01', pIncom1);
	  document.getElementById('AddModalWindow').innerHTML = ajaxRequest.get();
	  $('#AddModalWindow').dialog('option', 'title', 'Перечень документов');
	  $('#AddModalWindow').dialog('option', 'width', 'auto');
      $('#AddModalWindow').dialog('option', 'height', 'auto');
      openModalForm('#AddModalWindow');
      break;
  }
  ajaxRequest = null;
}

function disTimeItem(pId, pTime) {
  if ($('#' + pId).length != 0) {
    document.getElementById(pId).disabled = true;
    setTimeout(function() {document.getElementById(pId).disabled = false;}, pTime);}
}

/*function uItem(pItemName) {
  var ajaxRequest = new htmldb_Get(null, html_GetElement('pFlowId').value, 'APPLICATION_PROCESS=', 0);
  //if ($("#P1_ORG_GUILD").length != 0) {ajaxRequest.add('P1_ORG_GUILD', document.getElementById('P1_ORG_GUILD').value);}
  ajaxRequest.get();
  ajaxRequest = null;
  $(pItemName).trigger('apexrefresh');
}*/