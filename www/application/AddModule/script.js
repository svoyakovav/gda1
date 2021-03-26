$(function() {
  query('SelectDirIntBlock4');
  
  $('#QueryResult').dialog({
    modal: true,
    bgiframe: true,
    width: 'auto',
    height: 'auto',
    resizable: false,
    autoOpen: false,
    buttons: [{id: "ButQRConfirm",
			   text: "OK",
               width: "90",
               click: function() {query('UpdateTaskBlock5');}},
			  {text: "Закрыть",
               width: "90",
               click: function() {closeModal('#QueryResult');}}]
    });
});

$(document).ready(function() {
	$("#PassAdmin").keyup(function(event) {
	  if (event.keyCode == 13) {login('ASUTL');}
	});

	$("#PassSbyt").keyup(function(event) {
	  if (event.keyCode == 13) {login('SBYTOVIK');}
	});
	
	$("#BL4_CAR_NUMBER_SEQ").keyup(function(event) {
	  document.getElementById('But1SeqBL4').disabled = true;
	  document.getElementById('But3SeqBL4').disabled = true;
	});
});

function openModal(pModal) {$(pModal).dialog('open');}
function closeModal(pModal) {$(pModal).dialog('close');}

function disTimeItem(pId, pTime)
 {
  document.getElementById(pId).disabled = true;
  setTimeout(function() {document.getElementById(pId).disabled = false;}, pTime);
 }

function login(pLogin)
 {
  switch(pLogin) {
    case 'ASUTL':
	  if (document.getElementById('PassAdmin').value == '')
	   {alert('Введите пароль');}
	  else if (document.getElementById('PassAdmin').value == 'eeZialai016')
	   {$("#LayerBanAdmin").fadeOut(600);
		$("#LayerKeyAdmin").fadeOut(600);
		document.getElementById('ButSelectDirInt').tabIndex = 0;
		document.getElementById('ButUpdateDirInt').tabIndex = 0;
		document.getElementById('BL4_CAR_NUMBER_SEQ').tabIndex = 0;
		document.getElementById('But1SeqBL4').tabIndex = 0;
		document.getElementById('But2SeqBL4').tabIndex = 0;
		document.getElementById('But3SeqBL4').tabIndex = 0;
		document.getElementById('ButSelectDirInt').focus();}
	  else
	   {alert('Неверный пароль');}
	  break;
	case 'SBYTOVIK':
	  if (document.getElementById('PassSbyt').value == '')
	   {alert('Введите пароль');}
	  else if (document.getElementById('PassSbyt').value == 'c.cbr')
	   {$("#LayerBanSbyt").fadeOut(600);
		$("#LayerKeySbyt").fadeOut(600);
		document.getElementById('BL5_TASK_NUMBER').tabIndex = 0;
		document.getElementById('ButTaskNumBlock5').tabIndex = 0;
		document.getElementById('BL5_TASK_NUMBER').focus();}
	  else
	   {alert('Неверный пароль');}
	  break;
	default:
	  alert('Неверный логин');
  }
 }
 
function query(pName)
 {
  var vStep = 0;
  var vArg1 = '';
  var vArg2 = '';
  
  switch(pName) {
    case 'CheckCarBlock1':
	  vArg1 = document.getElementById('BL1_CAR_NUMBER').value;
	  vArg2 = document.getElementById('BL1_TASK_NUMBER').value;
      if (vArg1 == '' || vArg2 == '') {alert('Не указан номер вагона либо суточного'); vStep = 1;}
      break;
	case 'CheckOpBlock1':
	  vArg1 = document.getElementById('BL1_OPERATION_NUMBER').value;
      if (vArg1 == '') {alert('Не указан номер операции'); vStep = 1;}
      break;
	case 'CheckContBlock2':
	  vArg1 = document.getElementById('BL2_CONT_NUMBER').value;
	  vArg2 = document.getElementById('BL2_TASK_NUMBER').value;
      if (vArg1 == '' || vArg2 == '') {alert('Не указан номер контейнера либо суточного'); vStep = 1;}
      break;
	case 'CheckOpBlock2':
	  vArg1 = document.getElementById('BL2_OPERATION_NUMBER').value;
      if (vArg1 == '') {alert('Не указан номер операции'); vStep = 1;}
      break;
	case 'CheckOrderBlock3':
	case 'CheckPartyBlock3':
	  vArg1 = document.getElementById('BL3_HEADER_NUMBER').value;
	  vArg2 = document.getElementById('BL3_LINE_NUMBER').value;
      if (vArg1 == '' || vArg2 == '') {alert('Не указан заказ либо строка заказа'); vStep = 1;}
      break;
	case 'SelectTaskBlock5':
	  vArg1 = document.getElementById('BL5_TASK_NUMBER').value;
      if (vArg1 == '') {alert('Не указан номер суточного'); vStep = 1;}
      break;
	case 'UpdateTaskBlock5':
	  vArg1 = document.getElementById('BL5_TASK_NUMBER').value;
	  var vArray = new Array();
	  vArray[0] = document.getElementById('DTState').value;
	  vArray[1] = document.getElementById('DTQuantity').value;
	  vArray[2] = document.getElementById('DTPlan').value;
	  vArray[3] = document.getElementById('DTNotes').value;
	  var vArrayId = $('input[name="DTContId"]').map(function(){return $(this).val();}).get();
	  var vArrayVal = $('input[name="DTContVal"]').map(function(){return $(this).val();}).get();
      break;
	case 'SelectCarSeqBlock4':
	  vArg1 = document.getElementById('BL4_CAR_NUMBER_SEQ').value;
      if (vArg1 == '') {alert('Не указан номер вагона'); vStep = 1;}
      break;
	case 'DeleteCarPSeqBlock4':
	case 'DeleteCarNSeqBlock4':
	  if (confirm('Подтверждаете удаление вагона?')) {
	    vArg1 = document.getElementById('BL4_CAR_NUMBER_SEQ_ID').value;
        if (vArg1 == '') {alert('Не найден идентификатор позиции вагона'); vStep = 1;}
	    var vArray = new Array();
	    vArray[0] = document.getElementById('BL4_CAR_NUMBER_PSEQ').value;
	    vArray[1] = document.getElementById('BL4_CAR_NUMBER_SEQ').value;
	    vArray[2] = document.getElementById('BL4_CAR_NUMBER_NSEQ').value;}
	  else
	    {vStep = 1;}
      break;
	default:
	  vArg1 = '0';
	  vArg2 = '0';
	}
  
  if (vStep == 0) {
	$.ajax({
	  type: 'POST',
	  url: 'query.php',
	  async: false,
	  data: {'pQuery':pName, 'pArg1':vArg1, 'pArg2':vArg2,
			 'arraydata':vArray,
			 'arrayid':vArrayId,
			 'arrayval':vArrayVal},
	  dataType: 'json',
	  success: function(jsondata) {
		if (jsondata.error == '1') {alert(jsondata.data);}
		else {switch(pName) {
		        case 'DeleteCarPSeqBlock4':
				case 'DeleteCarNSeqBlock4':
				  query('SelectCarSeqBlock4');
				  break;
				case 'SelectCarSeqBlock4':
				  var a = jsondata.data.split('|');
				  document.getElementById('BL4_CAR_NUMBER_PSEQ').value = a[0];
				  document.getElementById('BL4_CAR_NUMBER_NSEQ').value = a[1];
				  document.getElementById('BL4_CAR_NUMBER_SEQ_ID').value = a[2];
				  document.getElementById('But1SeqBL4').disabled = false;
				  document.getElementById('But3SeqBL4').disabled = false;
				  break;
				case 'UpdateTaskBlock5':
				  closeModal('#QueryResult');
				  break;
				case 'SelectDirIntBlock4':
				  document.getElementById('DirIntegration').innerHTML = jsondata.data;
				  break;
			    case 'UpdateDirIntBlock4':
				  query('SelectDirIntBlock4');
				  break;
				default:
				  if (pName == 'SelectTaskBlock5')
				    {document.getElementById('ButQRConfirm').style.display = '';}
				  else
				    {document.getElementById('ButQRConfirm').style.display = 'none';}
				  document.getElementById('QueryResult').innerHTML = jsondata.data;
				  openModal('#QueryResult');
			 }}
	  },
	  error: function(xhr, ajaxOptions, thrownError) {alert('[ERROR_CODE: ' + xhr.status + '] ' + thrownError);}
	  });}
 }