<?php
	include("ora_conn.php");
	$opname = $_POST['pQuery'];
	$parg1 = $_POST['pArg1'];
	$parg2 = $_POST['pArg2'];
	
	if ($opname == 'CheckCarBlock1') {
	  $query = "begin :return_data := xx_user.xx_add_module_pkg.check_include_task_car('$parg1', '$parg2');";
	  $opdesc = 'Проверка подбора вагона "'.$parg1.'" в суточное задание "'.$parg2.'"';
	} elseif ($opname == 'CheckOpBlock1') {
	  $query = "begin
	              select '+<b>Начал операцию</b> ' || ms001.reccreateuser || '+<b>Завершил операцию</b> ' || ms001.recenduser
                  into :return_data
				  from asutl.ms001_opers ms001
                  where ms001.Id = '$parg1';";
	  $opdesc = 'Просмотр данных по операции "'.$parg1.'" над вагоном';
	} elseif ($opname == 'CheckContBlock2') {
	  $query = "begin :return_data := xx_user.xx_add_module_pkg.check_include_task_cont('$parg1', '$parg2');";
	  $opdesc = 'Проверка подбора контейнера "'.$parg1.'" в суточное задание "'.$parg2.'"';
	} elseif ($opname == 'CheckOpBlock2') {
	  $query = "begin
	              select '+<b>Начал операцию</b> ' || ms030.reccreateuser || '+<b>Завершил операцию</b> ' || ms030.recenduser
                  into :return_data
				  from asutl.ms030_cont_opers MS030
                  where ms030.id = '$parg1';";
	  $opdesc = 'Просмотр данных по операции "'.$parg1.'" над контейнером';
	} elseif ($opname == 'CheckOrderBlock3') {
	  $query = "begin :return_data := xx_user.xx_add_module_pkg.check_shipment_order('$parg1', '$parg2');";
	  $opdesc = 'Проверка импорта заказа на отгрузку "'.$parg1.'/'.$parg2.'"';
	} elseif ($opname == 'CheckPartyBlock3') {
	  $query = "declare
				  v_party_id number;
				  v_location_id number;
				  v_count number;
				begin
		   		  select a.ship_to_customer_id,
				         a.ship_to_location_id
				  into v_party_id,
				       v_location_id
				  from xxt.xxpha_sb057_om_oe_order_tl@oebs a
				  where a.order_number = '$parg1'
				    and a.line_number = '$parg2';
				  
				  v_count := 0;
				  for i in (select to_char(hp.party_id) as party_id,
								   hp.jgzz_fiscal_code as inn,
								   hp.tax_reference as kpp,
								   app.global_attribute1 as okpo,
								   hp.known_as as short_party_name,
								   hp.organization_name_phonetic as full_party_name,
								   to_char(xla.location_id) as location_id,
								   xla.territory_name,
								   xla.tgnl_code,
								   xla.index_code,
								   xla.location_address as party_address
							from ar.hz_parties@oebs hp
							inner join apps.xx_location_address_vw@oebs xla on xla.party_id = hp.party_id
							left join ap.ap_suppliers@oebs app on app.party_id = hp.party_id
							where hp.party_id = v_party_id
							  and xla.location_id = v_location_id)
					loop
					  v_count := v_count + 1;
					  :return_data := '+<table width=650 border=0 cellpadding=1>
										 <tr bgcolor=#FFE4B5><td colspan=2 align=center><b>ДАННЫЕ ПО КОНТРАГЕНТУ</b></td></tr>
										 <tr><td align=right><b>Код из ERP</b></td><td>' || i.party_id || '</td></tr>
										 <tr><td align=right><b>ИНН</b></td><td>' || i.inn || '</td></tr>
										 <tr><td align=right><b>КПП</b></td><td>' || i.kpp || '</td></tr>
										 <tr><td align=right><b>ОКПО</b></td><td>' || i.okpo || '</td></tr>
										 <tr><td align=right><b>Сокращенное<br>наименование</b></td><td>' || i.short_party_name || '</td></tr>
										 <tr><td align=right><b>Полное<br>наименование</b></td><td>' || i.full_party_name || '</td></tr>
										 <tr bgcolor=#FFE4B5><td colspan=2 align=center><b>ДАННЫЕ ПО АДРЕСУ</b></td></tr>
										 <tr><td align=right><b>Код из ERP</b></td><td>' || i.location_id || '</td></tr>
										 <tr><td align=right><b>Страна</b></td><td>' || i.territory_name || '</td></tr>
										 <tr><td align=right><b>Код ТГНЛ</b></td><td>' || i.tgnl_code || '</td></tr>
										 <tr><td align=right><b>Индекс</b></td><td>' || i.index_code || '</td></tr>
										 <tr><td align=right><b>Адрес</b></td><td>' || i.party_address || '</td></tr>
					                   </table>';
					end loop;
				  if (v_count = 0) then :return_data := 'Ошибка выборки данных по контрагенту. Данные не найдены'; end if;
				  if (v_count > 1) then :return_data := 'Ошибка выборки данных по контрагенту. Данные задвоены'; end if;";
	  $opdesc = 'Просмотр данных по контрагенту с заказа "'.$parg1.'/'.$parg2.'"';
	} elseif ($opname == 'SelectDirIntBlock4') {
	  $query = "begin
				  :return_data := '+<table border=0 cellspacing=1 cellpadding=3 bgcolor=#AAAAAA>
									 <tr bgcolor=#EEDC82>
									   <th>Справочник</th>
									   <th>Дата обновления</th>
									 </tr>';
				  for i in (select decode(md014.internal_table, 'OP046_SALES_CONTRACTS_VW', 'Договора',
															    'OP047_SALES_CONTRS_STRS_VW', 'Стр. договоров',
																'REF020_ENTERPRISE_FREIGHT', 'Номенклатура',
																null) as directory_name,
								   md014.last_sync_date as last_update_date
							from asutl.md014_extern_table_load md014
							where md014.internal_table in ('OP047_SALES_CONTRS_STRS_VW', 'REF020_ENTERPRISE_FREIGHT', 'OP046_SALES_CONTRACTS_VW')
							order by md014.internal_table)
				    loop
					  :return_data := :return_data || '<tr bgcolor=#FAF0E6><td>' || i.directory_name || '</td><td>' || to_char(i.last_update_date, 'dd.mm.yyyy hh24:mi:ss') || '</td></tr>';
					end loop;
				  :return_data := :return_data || '</table>';";
	  $opdesc = '';
	} elseif ($opname == 'UpdateDirIntBlock4') {
	  $query = "begin
				  update asutl.md014_extern_table_load md014
				  set md014.last_sync_date = null
				  where md014.internal_table in ('OP047_SALES_CONTRS_STRS_VW', 'REF020_ENTERPRISE_FREIGHT', 'OP046_SALES_CONTRACTS_VW');
				  commit;
				  :return_error := 0;
				  :return_data := '0';
	            end;";
	  $opdesc = 'Обновление справочников интеграции';
	} elseif ($opname == 'SelectTaskBlock5') {
	  $query = "declare
				  v_count number := 0;
				  v_task_type_id number;
	            begin
				  for i in (SELECT MS050.ID AS DAILY_TASK_NUMBER,
								   MS050.PLAN_DATE,
								   DECODE(NVL(MS050.FLAG_CONT, 0), 0, 'Вагонное', 'Контейнерное') AS TASK_CAR_TYPE_NAME,
								   MS050.STATUS AS TASK_STATE,
								   MS050.CAR_QUANTITY_LOAD,
								   MS050.NOTES AS NOTES,
								   asutl.Ms050_Tsk.Get_Transfer_Tp_Name(Ms050.Transfer_Tp) AS TASK_TYPE_NAME,
								   Ms050.Transfer_Tp as TASK_TYPE_ID
						    FROM ASUTL.MS050_TASKS MS050
						    WHERE MS050.ID = '$parg1')
				    loop
					  v_count := v_count + 1;
					  v_task_type_id := i.TASK_TYPE_ID;
					  :return_data := '+<table border=0 cellpadding=2>
									     <tr><td align=right><b>Номер суточного</b></td><td>' || i.DAILY_TASK_NUMBER || '</td></tr>
										 <tr><td align=right><b>Тип суточного</b></td><td>' || i.TASK_CAR_TYPE_NAME || '</td></tr>
										 <tr><td align=right><b>Вид отправки</b></td><td>' || i.TASK_TYPE_NAME || '</td></tr>
										 <tr><td align=right><b>Состояние</b></td>
										 <td><select id=DTState size=1>
											   <option value=3 ' || case when (i.TASK_STATE = 3) then 'selected' else null end || '>В работе</option>
											   <option value=4 ' || case when (i.TASK_STATE = 4) then 'selected' else null end || '>Завершено</option>
											   <option value=0 ' || case when (i.TASK_STATE = 0) then 'selected' else null end || '>Заготовка</option>
											   <option value=2 ' || case when (i.TASK_STATE = 2) then 'selected' else null end || '>Корректировка</option>
											   <option value=1 ' || case when (i.TASK_STATE = 1) then 'selected' else null end || '>Отозвано</option>
											 </select>
										 </td></tr>
									     <tr><td align=right><b>Требуется вагонов</b></td><td><input id=DTQuantity type=text size=5 value=' || i.CAR_QUANTITY_LOAD || '></td></tr>
									     <tr><td align=right><b>Плановая дата</b></td>
										     <td><input id=DTPlan type=text size=22 value=''' || to_char(i.PLAN_DATE, 'dd.mm.yyyy hh24:mi:ss') || '''></td>
										 </tr>
									     <tr><td align=right><b>Примечание</b></td><td><input id=DTNotes type=text size=50 value=''' || i.NOTES || '''></td></tr>
									   </table>';
					end loop;
				  
				  if (v_count = 1) and (v_task_type_id = 0) then
					:return_data := :return_data || '<br>
													 <table border=0 cellspacing=1 cellpadding=4 bgcolor=#AAAAAA>
													   <tr bgcolor=#EEDC82>
													     <th>Договор</th><th>Номенклатура</th><th>Кол-во</th><th>ЕИ</th>
													   </tr>';
					for i in (select a.id as line_id,
									 upper(a.op046_doc_num) as invoice_number,
									 a.ref020_freight_name as cargo_name,
									 a.quantity,
									 a.ref022_code as unit_measure
							  from asutl.ms051_ms050_op046_vw a
							  where a.ms050_id_task = '$parg1'
							  order by a.id)
					  loop
						:return_data := :return_data || '<tr bgcolor=#FAF0E6>
														   <td>' || i.invoice_number || '</td>
														   <td><input type=text size=55 value=''' || i.cargo_name || ''' disabled></td>
														   <td><input name=DTContId type=hidden value=' || i.line_id || '>
															   <input name=DTContVal type=text size=7 value=' || i.quantity || '></td>
														   <td>' || i.unit_measure || '</td>
														 </tr>';
					  end loop;
					:return_data := :return_data || '</table>';
				  end if;
				  
				  if (v_count = 0) then :return_data := 'Ошибка выборки данных по суточному. Данные не найдены'; end if;
				  if (v_count > 1) then :return_data := 'Ошибка выборки данных по суточному. Данные задвоены'; end if;";
	  $opdesc = '';
	} elseif ($opname == 'UpdateTaskBlock5') {
	  $query = "begin
				  update asutl.Ms050_Tasks Ms050
				  set ms050.car_quantity_load = '".$_POST['arraydata'][1]."',
					  ms050.notes = '".$_POST['arraydata'][3]."',
					  ms050.plan_date = to_date('".$_POST['arraydata'][2]."', 'dd.mm.yyyy hh24:mi:ss'),
					  Ms050.Status = '".$_POST['arraydata'][0]."'
				  where ms050.id = '$parg1';";
	  
	  for ($i = 0; $i < count($_POST['arrayid']); $i++) {
		$query = $query . "update asutl.ms051_ms050_op046 ms051 set ms051.quantity = '".$_POST['arrayval'][$i]."' where ms051.id = '".$_POST['arrayid'][$i]."';";}
	  
	  $query = $query . "
				  :return_error := 0;
				  :return_data := '0';
				  commit;
				exception
				  when others then :return_error := 1; :return_data := 'Ошибка обновления. ' || sqlerrm;
	            end;";
	  $opdesc = 'Корректировка суточного "'.$parg1.'"';
	} elseif ($opname == 'SelectCarSeqBlock4') {
	  $query = "declare
	              v_car_id number;
				  v_car_number_p varchar2(20);
				  v_car_number_n varchar2(20);
				  v_row_id number;
	            begin
				  select a.id into v_car_id from asutl.car001_cars a where a.car_number = '$parg1';
				  
				  select nvl(car001_p.car_number, '-') as car_number_p,
					     nvl(car001_n.car_number, '-') as car_number_n,
					     ms011.id
				  into v_car_number_p,
					   v_car_number_n,
					   v_row_id
				  from asutl.ms011_car_position_ways ms011
				  left join asutl.car001_cars car001_p on car001_p.id = ms011.car001_id_even
				  left join asutl.car001_cars car001_n on car001_n.id = ms011.car001_id_odd
				  where ms011.car001_id = v_car_id
				    and ms011.d_to = to_date('01.01.3000', 'dd.mm.yyyy');
				  
				  :return_error := 0;
				  :return_data := v_car_number_p || '|' || v_car_number_n || '|' || v_row_id;
				exception
				  when others then :return_error := 1; :return_data := 'Ошибка выборки данных. ' || sqlerrm;
				end;";
	  $opdesc = '';
	} elseif ($opname == 'DeleteCarPSeqBlock4') {
	  $query = "begin
				  update asutl.ms011_car_position_ways ms011 set ms011.car001_id_even = null where ms011.id = '$parg1';
				  :return_error := 0;
				  :return_data := '0';
				  commit;
				exception
				  when others then :return_error := 1; :return_data := 'Ошибка удаления. ' || sqlerrm;
				end;";
	  $opdesc = 'Удаление предыдущего по списку вагона "'.$_POST['arraydata'][0].'" от текущего "'.$_POST['arraydata'][1].'"';
	} elseif ($opname == 'DeleteCarNSeqBlock4') {
	  $query = "begin
				  update asutl.ms011_car_position_ways ms011 set ms011.car001_id_odd = null where ms011.id = '$parg1';
				  :return_error := 0;
				  :return_data := '0';
				  commit;
				exception
				  when others then :return_error := 1; :return_data := 'Ошибка удаления. ' || sqlerrm;
				end;";
	  $opdesc = 'Удаление следующего по списку вагона "'.$_POST['arraydata'][2].'" от текущего "'.$_POST['arraydata'][1].'"';
	}
	
	if ($opname != 'UpdateDirIntBlock4' and $opname != 'UpdateTaskBlock5' and $opname != 'SelectCarSeqBlock4' and
	    $opname != 'DeleteCarPSeqBlock4' and $opname != 'DeleteCarNSeqBlock4') {
	  $query = $query . "   if (substr(:return_data, 1, 1) = '+') then
							  :return_error := 0;
							  :return_data := '<p>' || replace(ltrim(:return_data, '+'), '+', '<br>') || '</p>';
						    else :return_error := 1; end if;
						  exception
						    when others then :return_error := 1; :return_data := 'Ошибка выполнения запроса. ' || sqlerrm;
						  end;";
	}
	
	$sql = OCIParse($conn, $query);
	oci_bind_by_name($sql, ':return_error', $sql_error, 10);
	oci_bind_by_name($sql, ':return_data', $sql_data, 4000);
	OCIExecute($sql);
	oci_free_statement($sql);
	echo json_encode(array('error' => $sql_error, 'data' => $sql_data));
	
	if ($opdesc != '') {
	  $pcip = getenv("REMOTE_ADDR");
	  $query = "begin xx_user.xx_add_module_pkg.add_log('$opdesc', '$pcip'); commit; end;";
	  $sql = OCIParse($conn, $query);
	  OCIExecute($sql);
	  oci_free_statement($sql);
	}
	
	oci_close($conn);
?>