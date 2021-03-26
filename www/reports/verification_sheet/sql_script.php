<?php

$sql_script = "
SELECT COUNT(*) OVER(PARTITION BY CAR_FRONT.CAR_ID) AS CAR_NUMBER_COUNT,
       CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN COUNT(*) OVER(PARTITION BY CAR_FRONT.CONT_ID) ELSE /*1*/COUNT(*) OVER(PARTITION BY CAR_FRONT.CAR_ID) END AS CONT_NUMBER_COUNT,
       CAR_FRONT.CAR_NUMBER,
       CAR_FRONT.CONT_NUMBER,
       UPPER(CAR_FRONT.CAR_KIND) AS CAR_KIND,
       CASE WHEN (CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN CAR_FRONT.WEIGHT_FREIGHT_CONT ELSE CAR_FRONT.WEIGHT_FREIGHT_CAR END) <= 0 THEN 'Порожний' ELSE 'Груженый' END AS LOADING_STATE,
       -- ############## --
       CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN
         CASE WHEN (CAR_FRONT.WEIGHT_FREIGHT_CONT > 0) THEN
           NVL(MS037.REF020_NAME, CAR_FRONT.NOMENCLATURE_NAME_CONT)
         ELSE
           DECODE(UNLOAD_CONT.NAME, NULL, NULL, 'ИЗ ПОД «' || UNLOAD_CONT.NAME || '»')
         END
       ELSE
         CASE WHEN (CAR_FRONT.WEIGHT_FREIGHT_CAR > 0) THEN
           NVL(MS020.REF020_NAME, CAR_FRONT.NOMENCLATURE_NAME_CAR)
         ELSE
           DECODE(UNLOAD_CAR.NSI008_NAME, NULL, 'ПОРОЖНИЙ ВАГОН', 'ИЗ ПОД «' || UNLOAD_CAR.NSI008_NAME || '»')
         END
       END AS NOMENCLATURE_NAME,
       -- ############## --
       CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN CAR_FRONT.WEIGHT_FREIGHT_CONT ELSE CAR_FRONT.WEIGHT_FREIGHT_CAR END AS WEIGHT_FREIGHT_INVOICE,
       
	   CASE WHEN CAR_FRONT.WEIGHT_FREIGHT_CAR <= 0 THEN NULL
            ELSE 
			
			/*
			(select MAX(m043.netto_t) KEEP(DENSE_RANK LAST ORDER BY m043.id)
			 from asutl.MS043_DYNAMIC_SCALE_STR m043
			 where m043.car_numb = CAR_FRONT.CAR_NUMBER
			   and m043.time_opr > sysdate - 1)
			*/
			
			(SELECT MAX(DECODE(APR.NETTO, 0, null, APR.NETTO)) KEEP(DENSE_RANK LAST ORDER BY APR.ID)
			 FROM XXT.XX_ASUTL_PECHAT_PR@oebs_a_d APR
			 WHERE APR.NUM_VAG = CAR_FRONT.CAR_NUMBER
			   AND TO_DATE(APR.DATE_TIME, 'DD.MM.YY HH24:MI:SS') > SYSDATE - 1)
			
			END AS WEIGHT_FREIGHT_SCALES,
       
	   CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN MS037.QUANTITY ELSE MS020.QUANTITY END AS QUANTITY_PLACE,
	   
	   --CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN CASE WHEN MS037.NSI108_ID IN (178/*МЕШКИ*/, 185/*РУЛОНЫ*/, 186/*КАТУШКИ*/) THEN MS037.QUANTITY ELSE NULL END
       --                                          ELSE CASE WHEN MS020.NSI108_ID IN (178/*МЕШКИ*/, 185/*РУЛОНЫ*/, 186/*КАТУШКИ*/) THEN MS020.QUANTITY ELSE NULL END END AS QUANTITY_PLACE,
       
	   CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN nvl((SELECT MAX(NSI112.NAME) FROM ASUTL.MS035_CONT_CSL_HISTORY MS035 INNER JOIN ASUTL.NSI112_SEAL_TYPE NSI112 ON NSI112.ID = MS035.NSI112_TYPE_ID WHERE MS035.MS031_ID = CAR_FRONT.OPERATION_SPRUT_CONT)
                                                    ,(select max(z_attribute1) from apps.xxt_op_unloading_transport@oebs app where app.car_number=CAR_FRONT.cont_number and app.platforma=CAR_FRONT.CAR_NUMBER and 
                                                     app.create_date between CAR_FRONT.begtime and CAR_FRONT.endtime)
                                                     )
                                                 ELSE (SELECT MAX(NSI112.NAME) FROM ASUTL.MS017_CAR_CSL_HISTORY MS017 INNER JOIN ASUTL.NSI112_SEAL_TYPE NSI112 ON NSI112.ID = MS017.NSI112_TYPE_ID WHERE MS017.MS002_ID = CAR_FRONT.OPERATION_SPRUT_CAR) END AS SPRUT_TYPE,
       CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN (SELECT TRIM(XX_USER.XXT_STRAGG(' ' || MS035.MARKS)) FROM ASUTL.MS035_CONT_CSL_HISTORY MS035 WHERE MS035.MS031_ID = CAR_FRONT.OPERATION_SPRUT_CONT)
                                                 ELSE (SELECT TRIM(XX_USER.XXT_STRAGG(' ' || MS017.MARKS)) FROM ASUTL.MS017_CAR_CSL_HISTORY MS017 WHERE MS017.MS002_ID = CAR_FRONT.OPERATION_SPRUT_CAR) END AS SPRUT_NAME,
       CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN UPPER(SUBSTR(NSI005_CONT.NAME, 1, 1)) || LOWER(SUBSTR(NSI005_CONT.NAME, 2))
                                                 ELSE UPPER(SUBSTR(NSI005_CAR.NAME, 1, 1)) || LOWER(SUBSTR(NSI005_CAR.NAME, 2))
                                                 END AS TO_STATION_NAME,
       (SELECT XOU.USER_NAME FROM xxt.xx_railway_shipment_settings@OEBS_A_D XOU WHERE XOU.settings_type = 'GRANT_USER' AND XOU.USER_LOGIN = CASE WHEN (CAR_FRONT.CONT_ID IS NOT NULL) THEN CAR_FRONT.LOADING_USER_CONT ELSE CAR_FRONT.LOADING_USER_CAR END) AS LOADING_USER
FROM (SELECT CAR001.CAR_NUMBER,
             NVL(MS003.WEIGHT_FREIGHT, 0) AS WEIGHT_FREIGHT_CAR,
             NVL(CONT.MS032_WEIGHT_FREIGHT, 0) AS WEIGHT_FREIGHT_CONT,
             CAR001.ID AS CAR_ID,
             DECODE(NVL(MS003.WEIGHT_FREIGHT, 0), 0, NULL, NSI008.NAME) AS NOMENCLATURE_NAME_CAR,
             DECODE(NVL(CONT.MS032_WEIGHT_FREIGHT, 0), 0, NULL, CONT.NSI008_NAME) AS NOMENCLATURE_NAME_CONT,
             NSI107.SHORT_NAME AS CAR_KIND,
             CONT.CAR025_ID AS CONT_ID,
             CONT.CONT_NUMBER,
             MS011.EVEN_POS AS EVEN_POSITION,
             (SELECT MAX(MS050.OP011_ID) FROM ASUTL.MS050_TASKS MS050 INNER JOIN ASUTL.MS063_TASK_CONT MS063 ON MS063.MS050_ID = MS050.ID AND MS063.ENDTIME IS NULL WHERE NVL(MS050.FLAG_CONT, 0) = 1 AND MS050.STATUS = 3 AND MS063.CAR025_ID = CONT.CAR025_ID) AS CONT_OTPR_ID,
             (SELECT MAX(MS017.MS002_ID) FROM ASUTL.MS017_CAR_CSL_HISTORY MS017 INNER JOIN ASUTL.MS012_CAR_LIFE_CYCLE MS012_C ON MS012_C.CAR001_ID = MS017.CAR001_ID AND MS012_C.MS001_LAST_ID IS NULL WHERE MS017.CAR001_ID = CAR001.ID AND MS012_C.ID = MS012.ID AND MS017.ENDTIME = TO_DATE('01.01.3000', 'DD.MM.YYYY')) AS OPERATION_SPRUT_CAR,
             (SELECT /*MAX(MS035.MS031_ID)*/ MAX(MS035.MS031_ID) KEEP(DENSE_RANK LAST ORDER BY MS035.ID) FROM ASUTL.MS035_CONT_CSL_HISTORY MS035 INNER JOIN ASUTL.MS033_CONT_LIFE_CYCLE MS033_C ON MS033_C.CAR025_ID = MS035.CAR025_ID AND MS033_C.MS030_LAST_ID IS NULL WHERE MS035.CAR025_ID = CONT.CAR025_ID AND MS033_C.ID = MS033.ID AND MS035.ENDTIME = TO_DATE('01.01.3000', 'DD.MM.YYYY')) AS OPERATION_SPRUT_CONT,
             (SELECT MAX(OHA.CREATE_USER_APEX) KEEP(DENSE_RANK LAST ORDER BY OHA.ID_ATTRIBUTE) FROM ASUTL_XI_KUAZOT.OPERS_HEADER_ATTRIBUTE OHA WHERE OHA.VIEW_MOVEMENT = 'LOAD' AND LENGTH(OHA.CAR_NUMBER) <= 8 AND OHA.CAR001_ID = CAR001.ID AND OHA.MS033_ID = MS012.ID) AS LOADING_USER_CAR,
             (SELECT MAX(OHA.CREATE_USER_APEX) KEEP(DENSE_RANK LAST ORDER BY OHA.ID_ATTRIBUTE) FROM ASUTL_XI_KUAZOT.OPERS_HEADER_ATTRIBUTE OHA WHERE OHA.VIEW_MOVEMENT = 'LOAD' AND LENGTH(OHA.CAR_NUMBER) > 8 AND OHA.CAR001_ID = CONT.CAR025_ID AND OHA.MS033_ID = MS033.ID) AS LOADING_USER_CONT,
             -- ############## --
             case when (NVL(MS003.WEIGHT_FREIGHT, 0) = 0) then (select max(ms001.id)
                                                                from asutl.MS002_OP_STRS MS002
                                                                inner join asutl.MS001_OPERS MS001 on ms001.id = ms002.ms001_id
                                                                where MS001.Ref012_Id = 59 -- Выгрузка
                                                                  and MS002.Begtime BETWEEN ms012.begtime AND ms012.endtime
                                                                  and ms002.car001_id = CAR001.ID)
                                                else null end AS LAST_OPERATION_UNLOAD_CAR_ID,
             -- ############## --
             case when (NVL(MS003.WEIGHT_FREIGHT, 0) > 0) then (select max(ms001.id)
                                                                from asutl.MS002_OP_STRS MS002
                                                                inner join asutl.MS001_OPERS MS001 on ms001.id = ms002.ms001_id
                                                                where MS001.Ref012_Id = 58 -- ПОГРУЗКА
                                                                  and MS002.Begtime BETWEEN ms012.begtime AND ms012.endtime
                                                                  and ms002.car001_id = CAR001.ID)
                                                else null end AS LAST_OPERATION_LOAD_CAR_ID,
             -- ############## --
             case when (NVL(CONT.MS032_WEIGHT_FREIGHT, 0) = 0 and cont.Car025_Id is not null) then (SELECT MAX(ms031.nsi008_id) KEEP(DENSE_RANK LAST ORDER BY MS030.ID)
                                                                                                    FROM ASUTL.MS031_cont_OP_STRS MS031
                                                                                                    inner join asutl.ms030_cont_opers MS030 on MS030.ID = ms031.ms030_id
                                                                                                    where MS030.REF012_ID IN (107, -- Выгрузка груза из контейнера
                                                                                                                              106) -- Выгрузка контейнера на вагоне
                                                                                                      and MS031.begtime BETWEEN ms033.begtime AND ms033.endtime
                                                                                                      and ms031.car025_id = cont.Car025_Id
                                                                                                      and ms031.nsi008_id is not null)
                                                                                              else null end AS LAST_OPERATION_UNLOAD_CONT_ID,
             -- ############## --
             case when (NVL(CONT.MS032_WEIGHT_FREIGHT, 0) > 0 and cont.Car025_Id is not null) then (SELECT max(MS030.ID)
                                                                                                    FROM ASUTL.MS031_cont_OP_STRS MS031
                                                                                                    inner join asutl.ms030_cont_opers MS030 on MS030.ID = ms031.ms030_id
                                                                                                    inner join asutl.MS037_CONT_FREIGHT_HISTS ms037 on ms037.ms031_id = ms031.id
                                                                                                    inner join asutl.ref012_operation_types ref012 on ref012.id = ms030.ref012_id
                                                                                                                                                  and substr(ref012.code, 1, 4) = 'ПОГР'
                                                                                                    where MS031.begtime BETWEEN ms033.begtime AND ms033.endtime
                                                                                                      and ms031.car025_id = CONT.CAR025_ID)
                                                                                              else null end AS LAST_OPERATION_LOAD_CONT_ID
,ms033.begtime, ms033.endtime
            -- ############## --
      FROM ASUTL.MS011_CAR_CURRENT_POS_VW MS011
      INNER JOIN ASUTL.CAR001_CARS CAR001 ON CAR001.ID = MS011.CAR001_ID
      INNER JOIN ASUTL.MS003_CAR_STATE_HISTORY MS003 ON MS003.CAR001_ID = MS011.CAR001_ID AND MS003.ENDTIME = TO_DATE('01.01.3000', 'DD.MM.YYYY')
      INNER JOIN ASUTL.MS012_CAR_LIFE_CYCLE MS012 ON MS012.CAR001_ID = CAR001.ID AND MS012.MS001_LAST_ID IS NULL
      LEFT JOIN ASUTL.NSI008_FREIGHT NSI008 ON MS003.NSI008_ID = NSI008.ID
      LEFT JOIN ASUTL.NSI107_CAR_KIND NSI107 ON NSI107.ID = CAR001.Nsi107_Id
      LEFT JOIN ASUTL.MS_CONT_CUR_INFO CONT ON CONT.CAR001_ID = CAR001.ID
      LEFT JOIN ASUTL.MS033_CONT_LIFE_CYCLE MS033 ON MS033.CAR025_ID = CONT.CAR025_ID AND MS033.MS030_LAST_ID IS NULL
      where MS011.Ref009_Id = 115 -- ФРОНТ = ВЗВЕШИВАНИЕ ХЗ
     ) CAR_FRONT
-- ############## --
LEFT JOIN ASUTL.MS002_OP_STRS MS002_STR ON MS002_STR.MS001_ID = CAR_FRONT.LAST_OPERATION_LOAD_CAR_ID AND MS002_STR.CAR001_ID = CAR_FRONT.CAR_ID
LEFT JOIN ASUTL.MS020_CAR_FREIGHT_HISTS_VW MS020 ON MS020.MS002_ID = MS002_STR.ID AND MS020.CAR001_ID = CAR_FRONT.CAR_ID
-- ############## --
LEFT JOIN ASUTL.MS031_CONT_OP_STRS MS031 ON MS031.MS030_ID = CAR_FRONT.LAST_OPERATION_LOAD_CONT_ID AND MS031.CAR025_ID = CAR_FRONT.CONT_ID
LEFT JOIN ASUTL.MS037_CONT_FREIGHT_HISTS_VW MS037 ON MS037.MS031_ID = MS031.ID AND MS037.CAR025_ID = CAR_FRONT.CONT_ID
-- ############## --
LEFT JOIN ASUTL.MS050_TASKS MS050 ON MS050.ID = ASUTL.MS050_TSK.GET_TSK_ACT_BY_CAR(CAR_FRONT.CAR_ID)
LEFT JOIN ASUTL.NSI005_STATION NSI005_CAR ON NSI005_CAR.ID = MS050.NSI005_ID_TOSTATION
-- ############## --
LEFT JOIN ASUTL.OP011_OTPR OP011 ON OP011.ID = CAR_FRONT.CONT_OTPR_ID
LEFT JOIN ASUTL.NSI005_STATION NSI005_CONT ON NSI005_CONT.ID = OP011.NSI005_TOSTATION_ID
-- ############## --
LEFT JOIN ASUTL.MS002_OP041_STRS_VW UNLOAD_CAR ON UNLOAD_CAR.MS001_ID = CAR_FRONT.LAST_OPERATION_UNLOAD_CAR_ID AND UNLOAD_CAR.CAR001_ID = CAR_FRONT.CAR_ID
LEFT JOIN ASUTL.NSI008_FREIGHT UNLOAD_CONT ON UNLOAD_CONT.ID = CAR_FRONT.LAST_OPERATION_UNLOAD_CONT_ID
-- ############## --
ORDER BY CAR_FRONT.EVEN_POSITION,
         CAR_FRONT.CONT_NUMBER
";

?>