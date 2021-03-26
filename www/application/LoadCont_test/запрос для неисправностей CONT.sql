--ActionSpoil
declare
  v_action_name varchar2(20) := wwv_flow.g_x01;
  v_data varchar2(30000) := '';
  v_row_count number;
  v_car_id number;
  type t_item is table of varchar2(50); v_item t_item;
begin
  if (v_action_name = 'SelectSpoil') then
    v_data := v_data || '<input type="text" id="SearchSpoil" size="25" value="' || wwv_flow.g_x02 || '">&nbsp;
                         <button type="button" onClick="javascript:runAction(''OpenSpoil'');">Поиск</button><br>
                         <div class="MenuList" style="width: 450px; height: 400px; overflow-y: scroll; margin: 6px;">
                         <ul>';
    v_row_count := 0;
    for i in (SELECT a.code || ': ' || a.name|| ' [' || 'Н' || ']'  as description, 'FAULT' as spoil_type, a.name as spoil_name, a.id as spoil_id, a.code as spoil_code
                    from asutl.NSI039_CONT_FAULTINESS@itl a  
                    where upper(a.code || a.name) like upper('%' || wwv_flow.g_x02 || '%')and--x1
                          sysdate between a.d_from and a.d_to
                    order by spoil_type desc, spoil_name )
      loop
        v_row_count := v_row_count + 1;
        if (v_row_count <= 200) then
          v_data := v_data || '<li><a href="javascript:onClick=runAction(''AddSpoil'', ' || i.spoil_id || ', ''' || i.spoil_code || ''', ''' || i.spoil_type || ''');">' || i.description || '</a></li>';
        end if;
      end loop;
    v_data := v_data || '</ul></div>';
  elsif (v_action_name = 'AddSpoil') then
    v_car_id := nvl(to_number(regexp_substr(wwv_flow.g_x02, '[^|]+', 1, 1)), 0);
    v_item := t_item(null, null);
     --замена вагонов на контейнера    
	select car025.CONT_NUMBER into v_item(1) from asutl.car025_containers@itl car025 where car025.id = v_car_id;
	-- или select car025.CONT_NUMBER into v_item(1) from asutl.ms_cont_cur_info@itl car025 where car025.car025_id= v_car_id;
	xx_user.customer_pkg.set_cont_spoil@itl(p_car_id         => v_car_id,
                                           p_spoil_type     => regexp_substr(wwv_flow.g_x02, '[^|]+', 1, 3),
                                           p_spoil_id       => to_number(regexp_substr(wwv_flow.g_x02, '[^|]+', 1, 2)),
                                           x_error          => v_data);
    
    if (v_data is not null) then htp.prn(v_data); rollback; return; end if;
    
    for i in (select 'GAVRILOVASA@KUAZOT.RU' as email from dual
              union
              select 'TIKHANOVAEL@KUAZOT.RU' as email from dual)
      loop
        apps.xxka_mail(i.email,
                       'Установка неисправности/брака',
                       '<html><style>p{font-size: 10pt;}</style><body>
                        <p>Коллеги, пользователем <font color="darkorange">' || :APP_USER || '</font> был установлен неисправность/брак
                           на подвижной единице <font color="darkorange">' || v_item(1) || '</font>.' ||
                        '</p></body></html>');
      end loop;
  else
    htp.prn('ORA. Операция "' || v_action_name || '" не определена'); rollback; return;
  end if;
  
  htp.prn(v_data);
  commit;
end;