<?php

$ss = "ALTER SESSION SET CURRENT_SCHEMA = APPS";

$s = 
"
select tab.RECEIPT_SOURCE_CODE,
       tab.RECEIPT_ORDER_NO,
       tab.ORGANIZATION,
       tab.OKPO,
       tab.KPP,
       tab.INN,
       tab.DIVISION,
       tab.OPERATION_TYPE,
       tab.FILLING_DATE,
       tab.WAREHOUSE,
       tab.SUPPLIER_DESCRIPTION,
       tab.SUPPLIER_CODE,
       tab.INSURANCE_COMPANY,
       tab.CORRESPONDING_ACCOUNT,
       
	   --tab.ACCOMPANYING_NOTE,
	 tab.ACCOMPANYING_NOTE || ' ' || (SELECT to_char(max(op30.DATE_READY), 'dd.mm.yyyy')
                                      FROM asutl.OP030_INVOICE_VW@itl_read op30
                                      left join asutl.OP031_CAR_VW@itl_read op31 on op31.OP030_ID = op30.ID
                                      left join asutl.OP035_cont@itl_read op35   on op35.op030_id = op30.id
                                      WHERE op30.state_id in (4, 31, 35, 36, 38, 42, 44)
                                        and op30.INV_NUMBER = tab.ACCOMPANYING_NOTE2
                                        and (case when op35.cont_number is not null then op35.cont_number else op31.car_number end) = tab.vendor_lot_num) as ACCOMPANYING_NOTE,	   
	   tab.PAYING,
       tab.PASSPORT_NUMBER,
       tab.INVENTORY_ITEMS_DESCRIPTION,
       tab.INVENTORY_ITEMS_PART_NUMBER,
       tab.UNIT_OF_MEASURE_CODE,
       tab.PRIMARY_UOM,
       tab.ORG_ID,
       tab.ITEM_ID,
       tab.UNIT_OF_MEASURE_DESCRIPTION,
       tab.WEIGHT,
       tab.UOM,
       tab.PURCHASING_DOCUMENT,
       tab.CATEGORY,
       tab.AA,
       tab.EXCHANGE_RATE,
       max(tab.NUMBER_BY_INVENTORY_CARDS) as NUMBER_BY_INVENTORY_CARDS,
       sum(tab.QUANTITY_DELIVERED) as QUANTITY_DELIVERED,
       tab.CR_QUANTITY_DELIVERED,
       tab.INV_MAT_ACCT,
       tab.PRICE_CONVERSION,
       tab.PRICE,
       sum(tab.TOTAL_NO_VAT) as TOTAL_NO_VAT,
       sum(tab.VAT_AMT) as VAT_AMT,
       sum(tab.TOTAL_WITH_VAT) as TOTAL_WITH_VAT

from (
SELECT   rt.vendor_lot_num
         ,RSH.RECEIPT_SOURCE_CODE                                                       RECEIPT_SOURCE_CODE                         --ADDED BY PATAN(OSSI) ON 30-NOV-06 AS PER TAR 5988072.993
               ,RSH.RECEIPT_NUM                                                               RECEIPT_ORDER_NO
               ,CLE_F139_CIN_PKG.GET_COMPANY_SHORTNAME(23276 ,'')      ORGANIZATION
               ,CLE_F139_CIN_PKG.GET_COMPANY_OKPO(23276)          OKPO
               ,CLE_F139_CIN_PKG.GET_COMPANY_KPP(23276, '')  KPP
               ,CLE_F139_CIN_PKG.GET_COMPANY_INN(23276, '') INN
               ,OOD.ORGANIZATION_NAME                                                         DIVISION
               ,MAX(RT.SUBINVENTORY) OVER (PARTITION BY RSH.RECEIPT_NUM)                      OPERATION_TYPE
               ,FIRST_VALUE(to_char(rt.transaction_date, 'dd.MM.RRRR')) OVER (PARTITION BY RSH.RECEIPT_NUM order by rt.transaction_id desc nulls last) FILLING_DATE
               ,OOD.ORGANIZATION_CODE                                                         WAREHOUSE
               ,DECODE(RT.SOURCE_DOCUMENT_CODE 
                     ,'PO',(DECODE (FND_PROFILE.VALUE ('CLE_USE_ALTCUSTSUPP_NAME')
                        , 'Y'
                        , NVL (SUBSTR (APS.VENDOR_NAME_ALT
                                                        , 0
                                              , DECODE (INSTR (APS.VENDOR_NAME_ALT
                                                                       , FND_GLOBAL.NEWLINE ()), 0 
                                                                       , LENGTH (APS.VENDOR_NAME_ALT)
                                                              , INSTR (APS.VENDOR_NAME_ALT
                                                                       , FND_GLOBAL.NEWLINE ())-1
                                                       )
                                              )
                                         , APS.VENDOR_NAME)
                           ,'N', APS.VENDOR_NAME
                           , APS.VENDOR_NAME) 
)
                     ,'RMA',NULL
                     ,ORG.ORGANIZATION_NAME)                                                 SUPPLIER_DESCRIPTION
               ,DECODE(RT.SOURCE_DOCUMENT_CODE
                     ,'PO',APS.SEGMENT1
                     ,'RMA',NULL
                     ,ORG.ORGANIZATION_CODE)                                                 SUPPLIER_CODE
               ,'-'                                                                          INSURANCE_COMPANY    
               ,FIRST_VALUE(APPS.XX_INITCORRES_M4(MSIV.INVENTORY_ITEM_ID, MSIV.ORGANIZATION_ID,RSH.RECEIPT_NUM)) OVER (PARTITION BY RSH.RECEIPT_NUM)   CORRESPONDING_ACCOUNT      
               ,RSH.WAYBILL_AIRBILL_NUM||' - '||RSL.Vendor_Lot_Num                           ACCOMPANYING_NOTE
			   ,RSH.WAYBILL_AIRBILL_NUM                         						     ACCOMPANYING_NOTE2
               ,'-'                                                                          PAYING
               ,'-'                                                                          PASSPORT_NUMBER 
               ,case when pl.attribute4 is null
         then MSIV.DESCRIPTION else  pl.attribute4 end                                                             INVENTORY_ITEMS_DESCRIPTION
               ,MSIBK.CONCATENATED_SEGMENTS                                                  INVENTORY_ITEMS_PART_NUMBER  
               ,MUOM.UOM_CODE                                                                UNIT_OF_MEASURE_CODE    
               ,MSIV.PRIMARY_UOM_CODE                                                        PRIMARY_UOM
               ,MSIV.ORGANIZATION_ID                                                         ORG_ID
               ,MSIV.INVENTORY_ITEM_ID                                                       ITEM_ID
               ,RT.UNIT_OF_MEASURE                                                           UNIT_OF_MEASURE_DESCRIPTION
,NVL(CLE_F143_IRO_PKG.GET_CONVERTED_UOM(0,MSIV.ORGANIZATION_ID
                                                ,MSIV.WEIGHT_UOM_CODE
                                                ,WGP.GU_WEIGHT_UOM
                                                ,MSIV.UNIT_WEIGHT
                                                ),0)                                           WEIGHT
,LOWER(WGP.GU_WEIGHT_UOM)                                            UOM                                                
                     ,CLE_F143_IRO_PKG.PURCHASING_DOCFORMULA(RSH.RECEIPT_SOURCE_CODE, RSH.RECEIPT_NUM,RT.TRANSACTION_ID, POH.SEGMENT1 || DECODE(POR.RELEASE_NUM 
                                    ,NULL,NULL 
                                    ,'-' || POR.RELEASE_NUM) 
                                    || DECODE(PL.LINE_NUM 
                                    ,NULL,NULL 
                                    ,'-' || PL.LINE_NUM) 
                                    || DECODE(POLL.SHIPMENT_NUM 
                                    ,NULL,NULL 
                                    ,'-'|| POLL.SHIPMENT_NUM))                    PURCHASING_DOCUMENT
               ,MCK.CONCATENATED_SEGMENTS                                                    CATEGORY                     
               ,'6A'                                                               AA
               ,RT.CURRENCY_CONVERSION_RATE                                                  EXCHANGE_RATE
               ,MAX(MMT.RCV_TRANSACTION_ID) OVER (PARTITION BY CLE_F143_IRO_PKG.PURCHASING_DOCFORMULA(RSH.RECEIPT_SOURCE_CODE, RSH.RECEIPT_NUM,RT.TRANSACTION_ID, POH.SEGMENT1 || DECODE(POR.RELEASE_NUM 
                                    ,NULL,NULL 
                                    ,'-' || POR.RELEASE_NUM) 
                                    || DECODE(PL.LINE_NUM 
                                    ,NULL,NULL 
                                    ,'-' || PL.LINE_NUM) 
                                    || DECODE(POLL.SHIPMENT_NUM 
                                    ,NULL,NULL 
                                    ,'-'|| POLL.SHIPMENT_NUM)))              NUMBER_BY_INVENTORY_CARDS
               , (DECODE(RT.TRANSACTION_TYPE
                             ,'DELIVER',RT.QUANTITY
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER'))
                                                       ,NULL,0
                                                       ,RT.QUANTITY)            
                            ,0))
               -
               (DECODE(RT.TRANSACTION_TYPE
                             ,'RETURN TO RECEIVING',RT.QUANTITY
                             ,0))                                                        QUANTITY_DELIVERED 
        ,SUM((DECODE(RT.TRANSACTION_TYPE
                             ,'DELIVER',RT.QUANTITY
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER'))
                                                       ,NULL,0
                                                       ,RT.QUANTITY)            
                            ,0))
               -
               (DECODE(RT.TRANSACTION_TYPE
                             ,'RETURN TO RECEIVING',RT.QUANTITY
                             ,0)))
               OVER (PARTITION BY RSH.RECEIPT_NUM, MSIV.ORGANIZATION_ID, MSIV.INVENTORY_ITEM_ID,CLE_F143_IRO_PKG.purchasing_docformula(RSH.receipt_source_code, RSH.receipt_num,RT.transaction_id, POH.segment1 || DECODE(POR.release_num 
                                    ,NULL,NULL 
                                    ,'-' || POR.release_num) 
                                    || DECODE(PL.line_num 
                                    ,NULL,NULL 
                                    ,'-' || PL.line_num) 
                                    || DECODE(POLL.shipment_num 
                                    ,NULL,NULL 
                                    ,'-'|| POLL.shipment_num)))                    CR_QUANTITY_DELIVERED       
               ,APPS.XX_CORRES_M4(MSIV.INVENTORY_ITEM_ID, MSIV.ORGANIZATION_ID,RSH.RECEIPT_NUM) INV_MAT_ACCT
               ,case when poh.currency_code != 'RUB'
               then NVL(APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price*poh.rate,0) 
                             else
               NVL(APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price,0) end PRICE
      ,CLE_F143_IRO_PKG.PRICE_CONVERSIONFORMULA (MSIV.PRIMARY_UOM_CODE,MUOM.UOM_CODE,MSIV.INVENTORY_ITEM_ID)    PRICE_CONVERSION                     
               , case when poh.currency_code != 'RUB'
               then NVL(CLE_F143_IRO_PKG.TOTAL_WITHOUT_VAT((DECODE(RT.TRANSACTION_TYPE
                             ,'DELIVER',RT.QUANTITY
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER'))
                                                       ,NULL,0
                                                       ,RT.QUANTITY)            
                            ,0))
               -
               (DECODE(RT.TRANSACTION_TYPE
                             ,'RETURN TO RECEIVING',RT.QUANTITY
                             ,0)) , APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price*poh.rate),0)  else NVL(CLE_F143_IRO_PKG.TOTAL_WITHOUT_VAT((DECODE(RT.TRANSACTION_TYPE
                             ,'DELIVER',RT.QUANTITY
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER'))
                                                       ,NULL,0
                                                       ,RT.QUANTITY)            
                            ,0))
               -
               (DECODE(RT.TRANSACTION_TYPE
                             ,'RETURN TO RECEIVING',RT.QUANTITY
                             ,0)) , APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price),0) end                                    TOTAL_NO_VAT
    ,case when poh.currency_code != 'RUB'
               then NVL(CLE_F143_IRO_PKG.AMOUNT_VAT(xx_tax_rate_code_m4(poh.po_header_id, pl.unit_price),CLE_F143_IRO_PKG.TOTAL_WITHOUT_VAT(((DECODE(RT.TRANSACTION_TYPE 
                             ,'DELIVER',RT.QUANTITY 
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3 
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID 
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID 
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER')) 
                                                       ,NULL,0 
                                                       ,RT.QUANTITY) 
                            ,0)) 
               - 
               (DECODE(RT.TRANSACTION_TYPE 
                             ,'RETURN TO RECEIVING',RT.QUANTITY 
                             ,0))), APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price*poh.rate),xx_tax_rate_m4(poh.po_header_id, pl.unit_price)),0) else NVL(CLE_F143_IRO_PKG.AMOUNT_VAT(xx_tax_rate_code_m4(poh.po_header_id, pl.unit_price),CLE_F143_IRO_PKG.TOTAL_WITHOUT_VAT(((DECODE(RT.TRANSACTION_TYPE 
                             ,'DELIVER',RT.QUANTITY 
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3 
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID 
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID 
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER')) 
                                                       ,NULL,0 
                                                       ,RT.QUANTITY) 
                            ,0)) 
               - 
               (DECODE(RT.TRANSACTION_TYPE 
                             ,'RETURN TO RECEIVING',RT.QUANTITY 
                             ,0))), APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price),xx_tax_rate_m4(poh.po_header_id, pl.unit_price)),0) end                             VAT_AMT
              ,case when poh.currency_code != 'RUB'
               then NVL(((CLE_F143_IRO_PKG.TOTAL_WITHOUT_VAT(((DECODE(RT.TRANSACTION_TYPE 
                             ,'DELIVER',RT.QUANTITY 
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3 
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID 
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID 
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER')) 
                                                       ,NULL,0 
                                                       ,RT.QUANTITY) 
                            ,0)) 
               - 
               (DECODE(RT.TRANSACTION_TYPE 
                             ,'RETURN TO RECEIVING',RT.QUANTITY 
                             ,0))), APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price*poh.rate))+(CLE_F143_IRO_PKG.AMOUNT_VAT(xx_tax_rate_code_m4(poh.po_header_id, pl.unit_price),CLE_F143_IRO_PKG.TOTAL_WITHOUT_VAT(((DECODE(RT.TRANSACTION_TYPE 
                             ,'DELIVER',RT.QUANTITY 
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3 
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID 
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID 
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER')) 
                                                       ,NULL,0 
                                                       ,RT.QUANTITY) 
                            ,0)) 
               - 
               (DECODE(RT.TRANSACTION_TYPE 
                             ,'RETURN TO RECEIVING',RT.QUANTITY 
                             ,0))), APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price*poh.rate),xx_tax_rate_m4(poh.po_header_id, pl.unit_price)))),0) else NVL(((CLE_F143_IRO_PKG.TOTAL_WITHOUT_VAT(((DECODE(RT.TRANSACTION_TYPE 
                             ,'DELIVER',RT.QUANTITY 
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3 
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID 
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID 
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER')) 
                                                       ,NULL,0 
                                                       ,RT.QUANTITY) 
                            ,0)) 
               - 
               (DECODE(RT.TRANSACTION_TYPE 
                             ,'RETURN TO RECEIVING',RT.QUANTITY 
                             ,0))), APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price))+(CLE_F143_IRO_PKG.AMOUNT_VAT(xx_tax_rate_code_m4(poh.po_header_id, pl.unit_price),CLE_F143_IRO_PKG.TOTAL_WITHOUT_VAT(((DECODE(RT.TRANSACTION_TYPE 
                             ,'DELIVER',RT.QUANTITY 
                             ,'CORRECT',DECODE((SELECT  'X' 
                                                                   FROM    RCV_TRANSACTIONS RT3 
                                                                   WHERE   RT3.TRANSACTION_ID  = RT.PARENT_TRANSACTION_ID 
                                                                   AND     RT3.ORGANIZATION_ID = RT.ORGANIZATION_ID 
                                                                   AND     RT3.TRANSACTION_TYPE IN ('DELIVER')) 
                                                       ,NULL,0 
                                                       ,RT.QUANTITY) 
                            ,0)) 
               - 
               (DECODE(RT.TRANSACTION_TYPE 
                             ,'RETURN TO RECEIVING',RT.QUANTITY 
                             ,0))), APPS.XXOF_UOM_CONV_M4(MSIV.inventory_item_id,
                             rt.uom_code,
                             muom.UOM_CODE) * pl.unit_price),xx_tax_rate_m4(poh.po_header_id, pl.unit_price)))),0) end                           TOTAL_WITH_VAT


    FROM    PO.RCV_SHIPMENT_HEADERS                      RSH
              ,APPS.ORG_ORGANIZATION_DEFINITIONS           OOD        
              ,APPS.HR_OPERATING_UNITS                     HOU
              ,PO.RCV_SHIPMENT_LINES                     RSL
              ,APPS.RCV_ROUTING_HEADERS                    RRH        
              ,PO.RCV_TRANSACTIONS                       RT                
              ,AP.AP_SUPPLIERS                           APS
              ,APPS.AP_SUPPLIER_SITES                      APSS
              ,PO.PO_HEADERS_ALL                         POH        
              ,PO.PO_LINES_ALL                           PL
              ,PO.PO_RELEASES_ALL                        POR
              ,PO.PO_LINE_LOCATIONS_ALL                  POLL
             -- ,ZX_LINES                               ZXL
              ,APPS.OE_ORDER_HEADERS                       OEH
              ,APPS.OE_ORDER_LINES                         OEL                
              ,APPS.GL_CODE_COMBINATIONS_KFV               GCCK  
              ,INV.MTL_MATERIAL_TRANSACTIONS              MMT
              ,INV.MTL_SYSTEM_ITEMS_B                     MSIV
              ,APPS.MTL_SYSTEM_ITEMS_B_KFV                 MSIBK
              ,APPS.MTL_UNITS_OF_MEASURE                   MUOM        
              ,APPS.MTL_CATEGORIES_KFV                     MCK        
              ,APPS.ORG_ORGANIZATION_DEFINITIONS           ORG
              ,WSH.WSH_GLOBAL_PARAMETERS                  WGP              
WHERE   RSH.RECEIPT_NUM IS NOT NULL
--and     ((zxl.last_update_date = (select max(zxl1.last_update_date) from ZX_LINES ZXL1 where 1=1 and ZXL.TRX_ID = ZXL1.TRX_ID and zxl.application_id = zxl1.application_id GROUP BY POH.PO_HEADER_ID) or zxl.last_update_date is null))
AND     ( RSH.SHIP_TO_ORG_ID                           = OOD.ORGANIZATION_ID OR RSH.SHIP_TO_ORG_ID    IS NULL)
AND     OOD.OPERATING_UNIT                             = HOU.ORGANIZATION_ID
AND     RSH.SHIPMENT_HEADER_ID                         = RSL.SHIPMENT_HEADER_ID
AND     RT.ROUTING_HEADER_ID                           = RRH.ROUTING_HEADER_ID(+)
AND     ( RSH.SHIP_TO_ORG_ID                           = RT.ORGANIZATION_ID OR  RSH.SHIP_TO_ORG_ID  IS NULL)
AND     RSH.SHIPMENT_HEADER_ID                         = RT.SHIPMENT_HEADER_ID
AND     RSL.SHIPMENT_LINE_ID                           = RT.SHIPMENT_LINE_ID
AND     RT.VENDOR_ID                                   = APS.VENDOR_ID(+)
AND     RT.VENDOR_ID                                   = APSS.VENDOR_ID (+)
AND     RT.VENDOR_SITE_ID                              = APSS.VENDOR_SITE_ID (+)
AND     RT.PO_HEADER_ID                                = POH.PO_HEADER_ID
AND     RT.PO_LINE_ID                                  = PL.PO_LINE_ID
AND     RT.PO_RELEASE_ID                               = POR.PO_RELEASE_ID(+)
AND     RT.PO_LINE_LOCATION_ID                         = POLL.LINE_LOCATION_ID(+)
--AND     zxl.application_id(+)                = 201
--AND     ZXL.TRX_ID(+)                                  = RT.PO_HEADER_ID
AND     RT.OE_ORDER_HEADER_ID                          = OEH.HEADER_ID(+)
AND     RT.OE_ORDER_LINE_ID                            = OEL.LINE_ID (+)
AND     APSS.ACCTS_PAY_CODE_COMBINATION_ID             = GCCK.CODE_COMBINATION_ID(+)
AND     RSL.ITEM_ID                                    = MSIV.INVENTORY_ITEM_ID
AND     RSL.TO_ORGANIZATION_ID                         = MSIV.ORGANIZATION_ID
AND     MMT.RCV_TRANSACTION_ID(+)                      = RT.TRANSACTION_ID
AND     RT.UNIT_OF_MEASURE                             = MUOM.UNIT_OF_MEASURE
AND     RSL.CATEGORY_ID                                = MCK.CATEGORY_ID(+)
AND     RSL.FROM_ORGANIZATION_ID                       = ORG.ORGANIZATION_ID(+)
AND     MSIV.INVENTORY_ITEM_ID                         = MSIBK.INVENTORY_ITEM_ID
AND     MSIV.ORGANIZATION_ID                           = MSIBK.ORGANIZATION_ID
AND     RT.TRANSACTION_TYPE NOT IN ('TRANSFER','ACCEPT','REJECT','UNORDERED')
AND     OOD.organization_id                            = '$org_id'
/*
AND     RSH.receipt_num BETWEEN NVL('$rec_num',RSH.receipt_num)
                            AND NVL('$rec_num',RSH.receipt_num)
*/

AND     RSH.receipt_num in (" . $rec_num . ")

AND     RSH.creation_date BETWEEN DECODE('',NULL,rsh.creation_date,TO_DATE((TO_CHAR('','YYYY/MM/DD')||' 00:00:00'),'YYYY/MM/DD HH24:MI:SS'))                         
AND DECODE('',NULL,rsh.creation_date,TO_DATE((TO_CHAR('','YYYY/MM/DD')||' 23:59:59'),'YYYY/MM/DD HH24:MI:SS'))

GROUP BY  rt.vendor_lot_num
          ,RSH.receipt_source_code                                                   
               ,RSH.RECEIPT_NUM
                    ,HOU.NAME
                    ,OOD.ORGANIZATION_NAME
                    ,RT.SUBINVENTORY
                    ,rt.transaction_id
                    ,to_char(rt.transaction_date, 'dd.MM.RRRR')
                    ,OOD.ORGANIZATION_CODE
                    ,DECODE(RT.SOURCE_DOCUMENT_CODE 
                     ,'PO',(DECODE (APPS.FND_PROFILE.VALUE ('CLE_USE_ALTCUSTSUPP_NAME')
                        , 'Y'
                        , NVL (SUBSTR (APS.VENDOR_NAME_ALT
                                                        , 0
                                              , DECODE (INSTR (APS.VENDOR_NAME_ALT
                                                                       , APPS.FND_GLOBAL.NEWLINE ()), 0 
                                                                       , LENGTH (APS.VENDOR_NAME_ALT)
                                                              , INSTR (APS.VENDOR_NAME_ALT
                                                                       , APPS.FND_GLOBAL.NEWLINE ())-1
                                                       )
                                              )
                                         , APS.VENDOR_NAME)
                           ,'N', APS.VENDOR_NAME
                           , APS.VENDOR_NAME) 
)
                     ,'RMA',NULL
                     ,ORG.ORGANIZATION_NAME)
                     ,DECODE(RT.SOURCE_DOCUMENT_CODE
                           ,'PO',APS.SEGMENT1
                           ,'RMA',NULL
                           ,ORG.ORGANIZATION_CODE)
                      ,'-'
                      ,GCCK.CONCATENATED_SEGMENTS
                      ,RT.VENDOR_SITE_ID
                      ,RSH.WAYBILL_AIRBILL_NUM||' - '||RSL.Vendor_Lot_Num
					  ,RSH.WAYBILL_AIRBILL_NUM 
                      ,RT.ATTRIBUTE1
                      ,'-'
                      ,'-'
                      ,MSIV.DESCRIPTION
                      ,MSIBK.CONCATENATED_SEGMENTS
                      ,poh.currency_code
                      ,poh.rate
                      ,PL.UNIT_PRICE
                      ,rt.uom_code
                      ,MUOM.UOM_CODE
                      ,MSIV.PRIMARY_UOM_CODE   
                      ,MSIV.ORGANIZATION_ID   
                      ,MSIV.INVENTORY_ITEM_ID    
                      ,RT.UNIT_OF_MEASURE
                      ,DECODE(RT.SOURCE_DOCUMENT_CODE
                      ,'RMA',OEL.ORDERED_QUANTITY
                      ,APPS.CLE_F143_IRO_PKG.QUANTITY_DOCUMENT(RSH.RECEIPT_SOURCE_CODE,RSH.RECEIPT_NUM,RT.TRANSACTION_ID,POLL.QUANTITY))
                            ,APPS.CLE_F143_IRO_PKG.PURCHASING_DOCFORMULA(RSH.RECEIPT_SOURCE_CODE, RSH.RECEIPT_NUM, RT.TRANSACTION_ID,(POH.SEGMENT1 || DECODE(POR.RELEASE_NUM 
                                    ,NULL,NULL 
                                    ,'-' || POR.RELEASE_NUM) 
                                    || DECODE(PL.LINE_NUM 
                                    ,NULL,NULL 
                                    ,'-' || PL.LINE_NUM) 
                                    || DECODE(POLL.SHIPMENT_NUM 
                                    ,NULL,NULL 
                                    ,'-'|| POLL.SHIPMENT_NUM)))
                       ,MCK.CONCATENATED_SEGMENTS
                       ,POLL.TAX_CODE_ID
                       ,MMT.ACTUAL_COST
                       ,MMT.RCV_TRANSACTION_ID
             ,poh.po_header_id
                       ,RT.CURRENCY_CONVERSION_RATE 
                       ,RT.TRANSACTION_TYPE
                       ,RT.QUANTITY
                       ,RT.PARENT_TRANSACTION_ID
                       ,RT.ORGANIZATION_ID
                       ,MSIV.WEIGHT_UOM_CODE
                       ,MSIV.UNIT_WEIGHT
                       ,WGP.GU_WEIGHT_UOM    
             ,pl.attribute4) tab
group by 
       tab.RECEIPT_SOURCE_CODE,
       tab.RECEIPT_ORDER_NO,
       tab.ORGANIZATION,
       tab.OKPO,
       tab.KPP,
       tab.INN,
       tab.DIVISION,
       tab.OPERATION_TYPE,
       tab.FILLING_DATE,
       tab.WAREHOUSE,
       tab.SUPPLIER_DESCRIPTION,
       tab.SUPPLIER_CODE,
       tab.INSURANCE_COMPANY,
       tab.CORRESPONDING_ACCOUNT,
       tab.ACCOMPANYING_NOTE,
	   tab.ACCOMPANYING_NOTE2,
       tab.PAYING,
       tab.PASSPORT_NUMBER,
       tab.INVENTORY_ITEMS_DESCRIPTION,
       tab.INVENTORY_ITEMS_PART_NUMBER,
       tab.UNIT_OF_MEASURE_CODE,
       tab.PRIMARY_UOM,
       tab.ORG_ID,
       tab.ITEM_ID,
       tab.UNIT_OF_MEASURE_DESCRIPTION,
       tab.WEIGHT,
       tab.UOM,
       tab.PURCHASING_DOCUMENT,
       tab.CATEGORY,
       tab.AA,
       tab.EXCHANGE_RATE,
       tab.CR_QUANTITY_DELIVERED,
       tab.INV_MAT_ACCT,
       tab.PRICE_CONVERSION,
       tab.PRICE,
	   tab.vendor_lot_num
";

?>