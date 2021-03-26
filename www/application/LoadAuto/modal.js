//$(document).bind("keydown", disableF5);
$(function() {
  disTimeItem('ButSearchGuild', 7000);
  disTimeItem('ButSearchInvoice', 7000);

  $('#ModalDelivery').dialog({
    modal: true,
    bgiframe: true,
    title: 'Доп. сведения о доставке',
    width: 'auto',
    height: 'auto',
    resizable: false,
    autoOpen: false,
    buttons: [{text: "Закрыть",
               width: "100",
               click: function() {closeModalForm('#ModalDelivery');}},
			  {text: "Выбрать доставку",
               width: "150",
               click: function() {sAddData('SelectAllDelivery');}},
              {text: "OK",
               width: "100",
               click: function() {opDelivery();}}]
  });

  $('#InformSkipping').dialog({
    modal: true,
    bgiframe: true,
    title: 'Сведения о пропуске',
    width: 'auto',
    height: 'auto',
    resizable: false,
    autoOpen: false,
    close: function(event, ui) {$s('P1_SKIPPING', document.getElementById('P1_TIME_ACTION_SKIPPING').value + ', ' +
                                                  document.getElementById('P1_TIME_START_SKIPPING').value + ', ' +
                                                  document.getElementById('P1_TIME_END_SKIPPING').value + ', ' +
                                                  document.getElementById('P1_SPECIAL_NOTES_SKIPPING').value + ', ' +
                                                  document.getElementById('P1_APP_NUMBER_SKIPPING').value + ', ' +
                                                  document.getElementById('P1_DATE_FEED_LOAD_SKIPPING').value);},
    buttons: {Закрыть : function() {closeModalForm('#InformSkipping');}}
  });

  $('#InformAttorney').dialog({
    modal: true,
    bgiframe: true,
    title: 'Сведения о доверенности',
    width: 'auto',
    height: 'auto',
    resizable: false,
    autoOpen: false,
    close: function(event, ui) {$s('P1_ATTORNEY', document.getElementById('P1_NUMBER_ATTORNEY').value + ', ' +
                                                  document.getElementById('P1_EXTRADITION_ATTORNEY').value + ', ' +
                                                  document.getElementById('P1_TERM_ATTORNEY').value);},
    buttons: {Закрыть : function() {closeModalForm('#InformAttorney');}}
  });

  $('#InformVehicle').dialog({
    modal: true,
    bgiframe: true,
    title: 'Сведения о ТС',
    width: 'auto',
    height: 'auto',
    resizable: false,
    autoOpen: false,
    close: function(event, ui) {$s('P1_VEHICLE', document.getElementById('P1_STAMP_VEHICLE').value + ', ' +
                                                 document.getElementById('P1_NUMBER_VEHICLE').value + ', ' +
                                                 $f_ReturnChecked('P1_CARD_VEHICLE') + ', ' +
                                                 document.getElementById('P1_LICENSE_VEHICLE').value + ', ' +
                                                 document.getElementById('P1_CARD_SERIES_VEHICLE').value + ', ' +
                                                 document.getElementById('P1_CARD_NUM_VEHICLE').value + ', ' +
                                                 document.getElementById('P1_TRAILER_STAMP_1_VEHICLE').value + ', ' +
                                                 document.getElementById('P1_TRAILER_NUM_1_VEHICLE').value + ', ' +
                                                 document.getElementById('P1_TRAILER_STAMP_2_VEHICLE').value + ', ' +
                                                 document.getElementById('P1_TRAILER_NUM_2_VEHICLE').value);},
    buttons: {Закрыть : function() {closeModalForm('#InformVehicle');}}
  });

  $('#InformDriver').dialog({
    modal: true,
    bgiframe: true,
    title: 'Сведения о водителе',
    width: 'auto',
    height: 'auto',
    resizable: false,
    autoOpen: false,
    close: function(event, ui) {$s('P1_INFORMATION_DRIVER', document.getElementById('P1_SHEET_DRIVER').value + ', ' +
                                                            document.getElementById('P1_CERTIFICATE_DRIVER').value + ', ' +
                                                            document.getElementById('P1_PRINT_DRIVER').value);},
    buttons: {Закрыть : function() {closeModalForm('#InformDriver');}}
  });

  $('#InformSprut').dialog({
    modal: true,
    bgiframe: true,
    title: 'Сведения о ЗПУ',
    width: 'auto',
    height: 'auto',
    resizable: false,
    autoOpen: false,
    close: function(event, ui) {$s('P1_INFORM_SPRUT', document.getElementById('P1_TYPE_SPRUT').value + ', ' +
                                                      document.getElementById('P1_SPRUT_1').value + ', ' +
                                                      document.getElementById('P1_SPRUT_2').value + ', ' +
                                                      document.getElementById('P1_SPRUT_3').value + ', ' +
                                                      document.getElementById('P1_SPRUT_4').value + ', ' +
                                                      document.getElementById('P1_SPRUT_5').value + ', ' +
                                                      document.getElementById('P1_SPRUT_6').value + ', ' +
                                                      document.getElementById('P1_SPRUT_7').value + ', ' +
                                                      document.getElementById('P1_SPRUT_8').value);},
    buttons: {Закрыть : function() {closeModalForm('#InformSprut');}}
  });

  $('#ModalCreateLot').dialog({
    modal: true,
    bgiframe: true,
    /*title: 'Создание партии',*/
    width: 'auto',
    height: 'auto',
    resizable: false,
    autoOpen: false,
	buttons: [{text: "Закрыть",
               width: "90",
               click: function() {closeModalForm('#ModalCreateLot');}},
              {text: "OK",
               width: "90",
               click: function() {if (confirm('Подтверждаете создание партии?')) {opAdd('CreateLot');}}}]
  });

  $('#AddModalWindow').dialog({
    modal: true,
    bgiframe: true,
    resizable: true,
    autoOpen: false,
	buttons: [{text: "Закрыть",
               width: "90",
               click: function() {closeModalForm('#AddModalWindow');}}]
  });  

});