<?php
include("OCILogin.h");

//Проверка доступа к задаче данного юзера

//echo ' $dep42 = ',$dep42;

$sql="
select upper(login) logname, taskcode, dostup
from nalog_user_acc
where upper(login)='".$U_NA."' and taskcode='10301'
";
$stmt=OCIParse($conn, $sql);
OCIDefineByName($stmt,"DOSTUP",$DOSTUP);
OCIExecute($stmt);


 if  ( !OCIFetch($stmt) ) 
  {
     OCIFreeStatement($stmt);
     OCILogoff($conn);
     die("<H3>ЗАДАЧА ВАС НЕ УЗНАЁТ !</H3>");

  }


$doit=$HTTP_POST_VARS['doit'];
$rec =$HTTP_POST_VARS['rec'];
$in =$HTTP_POST_VARS['in'];
$m =$HTTP_POST_VARS['m'];
$CODPR =$HTTP_POST_VARS['CODPR'];
$PERIOD =$HTTP_POST_VARS['PERIOD'];	
$mylist=$HTTP_POST_VARS['mylist'];
$GOD =$HTTP_POST_VARS['GOD'];
if (strlen($doit)==0) $doit="ok";
//if (strlen($CODPR)==0) $CODPR=0;
if (strlen($PERIOD)==0) $PERIOD=0;

 $un=$U_NAME;
 $pr=$U_CPL;
 $cd=$U_CD;		
 
if ($DOSTUP==3)
{
echo $u_name;
}
else{
if ($mylist==1) {$u_name=$U_NA; }
else $u_name=null;
}
Header("Pragma: cache");
Header("Content-Type: application/vnd.ms-excel");
Header("Content-Disposition: attachment; filename=".basename($HTTP_SERVER_VARS["PHP_SELF"],".php").".xls");
header("Content-Transfer-Encoding: binary"); 
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<style>
table {mso-displayed-decimal-separator:"\,";mso-displayed-thousand-separator:" ";}
@page {margin:.98in .79in .98in .79in;mso-header-margin:.5in;mso-footer-margin:.5in;}
tr {mso-height-source:auto;}
col {mso-width-source:auto;}
br {mso-data-placement:same-cell;}
.style0 {mso-number-format:General;text-align:general;vertical-align:bottom;white-space:nowrap;mso-rotate:0;mso-background-source:auto;mso-pattern:auto;color:windowtext;font-size:10.0pt;font-weight:400;font-style:normal;text-decoration:none;font-family:"Arial Cyr";mso-generic-font-family:auto;mso-font-charset:204;border:none;mso-protection:locked visible;mso-style-name:Обычный;mso-style-id:0;}
td {mso-style-parent:style0;padding-top:1px;padding-right:1px;padding-left:1px;mso-ignore:padding;color:windowtext;font-size:10.0pt;font-weight:400;font-style:normal;text-decoration:none;font-family:"Arial Cyr";mso-generic-font-family:auto;mso-font-charset:204;mso-number-format:General;text-align:general;vertical-align:bottom;border:none;mso-background-source:auto;mso-pattern:auto;mso-protection:locked visible;white-space:nowrap;mso-rotate:0;}
.brd1{mso-font-charset:204;font: 9pt;text-align:center;vertical-align:top;border:1.0pt solid windowtext;white-space:normal;}
.brd2{mso-font-charset:204;mso-number-format:"\@";font: 9pt;text-align:center;vertical-align:top;border:0.5pt solid windowtext;white-space:normal;}
.brd22{mso-font-charset:204;mso-number-format:"\#\,\#\#0";font: 9pt;text-align:center;vertical-align:top;border:0.5pt solid windowtext;white-space:normal;}
.brd2_1{mso-font-charset:204;font: 9pt;text-align:left;vertical-align:top;border:0.5pt solid windowtext;white-space:normal;}
</style>
</head>
<body link=blue vlink=purple>

<table border=0 cellpadding=0 cellspacing=0 style='border-collapse: collapse;table-layout:fixed;'>
<col style='mso-width-source:userset;mso-width-alt:1500'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:4500'>
<col style='mso-width-source:userset;mso-width-alt:4500'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:5000'>
<col style='mso-width-source:userset;mso-width-alt:4000'>
<col style='mso-width-source:userset;mso-width-alt:4000'>
<col style='mso-width-source:userset;mso-width-alt:5000'>
<col style='mso-width-source:userset;mso-width-alt:2500'>
<col style='mso-width-source:userset;mso-width-alt:4000'>
<col style='mso-width-source:userset;mso-width-alt:4000'>
<col style='mso-width-source:userset;mso-width-alt:4000'>
<col style='mso-width-source:userset;mso-width-alt:4000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'>
<col style='mso-width-source:userset;mso-width-alt:3000'> 
<col style='mso-width-source:userset;mso-width-alt:4000'> 
<col style='mso-width-source:userset;mso-width-alt:3000'> 
<col style='mso-width-source:userset;mso-width-alt:3000'> 
<col style='mso-width-source:userset;mso-width-alt:3000'> 
<col style='mso-width-source:userset;mso-width-alt:3000'> 
<col style='mso-width-source:userset;mso-width-alt:4000'> 
<col style='mso-width-source:userset;mso-width-alt:3000'> 
<tr><td colspan=26></td></tr>
<tr><td colspan=2></td><td colspan=24>Расчет налоговой базы и суммы налога по автомобилям, мотоциклам, автобусам и другим самоходным машинам и механизмам на пневматическом и гусеничном ходу,</td></tr>
<tr><td colspan=2></td><td colspan=24>снегоходам и мотосаням по каждому транспортному средству с группировкой по кодам <br>
по зарегистрированным транспортным средствам</td></tr>
<tr><td colspan=26></td></tr>
<tr><td colspan=2></td><td colspan=24>
 
<?php

$sql="select description descr
      from claccounting 
      where codeaccounting='".$pr."'
    ";
     $stmt=OCIParse($conn, $sql);
     OCIDefineByName($stmt,"DESCR",$DESCR);
     OCIExecute($stmt);
     OCIFetch($stmt);

$sql2="select nameperiod np from tr_period 
      where kodperiod='".$PERIOD."'
     ";

     $stmt2=OCIParse($conn, $sql2);
     OCIDefineByName($stmt2,"NP",$NP);
     OCIExecute($stmt2);
     OCIFetch($stmt2);

//echo 'по '.$pr.' производству: '.$DESCR;
echo '<br>';
echo 'период: '.$NP.' '.$GOD.' года';

?>

 <tr>
  <td rowspan=2 class=brd1>№п/п</td>
  <td rowspan=2 class=brd1>Подразделение</td>
  <td rowspan=2 class=brd1>Код ХО</td>
  <td rowspan=2 class=brd1>Инвентарный номер</td>
  <td rowspan=2 class=brd1>Регистрационный знак</td>
  <td rowspan=2 class=brd1>Код   вида транс. средства</td>
  <td rowspan=2 class=brd1>Марка, модель</td>
  <td rowspan=2 class=brd1>Номер двигателя</td>
  <td rowspan=2 class=brd1>Дата замены двигателя</td>
  <td rowspan=2 class=brd1>Идентифный номер</td>
  <td rowspan=2 class=brd1>Год выпуска</td>
  <td colspan=4 class=brd1>Дата</td>
  <td colspan=2 class=brd1>ПТС/ПСМ</td>
  <td colspan=2 class=brd1>Мощность</td>
  <td rowspan=2 class=brd1>Экологический класс</td>
  <td rowspan=2 class=brd1>Доля Общества в праве на ТС</td>
  <td rowspan=2 class=brd1>Количество месяцев владения</td>
  <td rowspan=2 class=brd1>Коэффициент Кв</td>
  <td rowspan=2 class=brd1>Ставка налога</td>
  <td rowspan=2 class=brd1>Исчисленная сумма налога</td>
  <td rowspan=2 class=brd1>Коэффициент Кп</td>
  <td rowspan=2 class=brd1>Коэффициент Кл</td>
  <td colspan=2 class=brd1>Налоговый вычет (ПЛАТОН)</td>
  <td rowspan=2 class=brd1>Исчисленная сумма налога подлежащая уплате в бюджет</td>
  <td rowspan=2 class=brd1>Код налогового органа</td>
</tr>
 <tr>
  <td class=brd1>регистрации</td>
  <td class=brd1>снятия с регистрации</td>
  <td class=brd1>начала розыска</td>
  <td class=brd1>возврата</td>
  <td class=brd1>серия</td>
  <td class=brd1>номер</td>
  <td class=brd1>кВт</td>
  <td class=brd1>л.с.</td>
  <td class=brd1>код</td>
  <td class=brd1>сумма</td>
 </tr>
 
 <?php
$sql1="select (select decode(sign(max(carid)),1,'DOC',null) from tr_pts t where t.carid=n.carid) QQ,  
 CARID, CODEDEPARTMENT, NUMINV, REGZNAK, KODVTRSR, NAMEMODEL, NOMDVIG, IDNOMER, GODVIPUSKA, DATEREG, HO,KODIMNS,DATEZAMDVIG,EKOLCLASS,DOLYA,KODPLATON,SUMPLATON,
 DATESNREG, DOCSER, DOCNOMER, MOSKVT, MOSLS, KOLPMESVL, to_char(KOEFFICENT)KOEFFICENT, STAVNAL, ISSUMNAL, ISSUMAV, KOEFKP,KOEFKL,
 DATENROZISKA, DATEVOZVRATA, NUMID
 from tr_transnal_n n
    where kvperiod ='".$PERIOD."'  
    and god = '".$GOD."'
    and (codedepartment like '".$CODPR."%'  or ('".$CODPR."' is null and codedepartment is null))
    and nvl(IDNOMER,'-') Like '".$p."%'
    and regznak Like '%".$s."%' 
    and kodimns like '".$m."%' 
    and numinv like '".$in."%'
    and (DATE_CHANGE>=to_date(nvl('".$DAT1."','01.01.1900'),'dd.mm.yyyy') and DATE_CHANGE<=to_date(nvl('".$DAT2."','01.01.2100'),'dd.mm.yyyy')) 
    and user_change like '%".$u_name."%' 
	order by CODEDEPARTMENT";
 //echo $sql1;
 
 $stmt= OCIParse($conn, $sql1);
 OCIExecute($stmt);
 $cnt= OCIFetchStatement($stmt, $result);

$sql2=" select sum(issumnal) issumnal, sum(issumav) issumav 
	from tr_transnal_n
	where kvperiod ='".$PERIOD."'  
    and god = '".$GOD."'
    and (codedepartment like '".$CODPR."%'  or ('".$CODPR."' is null and codedepartment is null))
	and nvl(IDNOMER,'-') Like '".$p."%'
    and regznak Like '%".$s."%' 
    and kodimns like '".$m."%' 
    and numinv like '".$in."%'
    and (DATE_CHANGE>=to_date(nvl('".$DAT1."','01.01.1900'),'dd.mm.yyyy') and DATE_CHANGE<=to_date(nvl('".$DAT2."','01.01.2100'),'dd.mm.yyyy')) 
    and user_change like '%".$u_name."%'";
$stmt2=OCIParse($conn, $sql2);
OCIDefineByName($stmt2,"ISSUMNAL",$issumnal);
OCIDefineByName($stmt2,"ISSUMAV",$issumav);
OCIExecute($stmt2);
OCIFetch($stmt2);

for ($i=0; $i < $cnt; $i++)
      {?>
<tr>
  <td class=brd2> <? echo $i+1; ?></td>
  <td class=brd2> <? echo $result["CODEDEPARTMENT"][$i]; ?></td>
  <td class=brd2> <? echo $result["HO"][$i]; ?></td>
  <td class=brd2> <? echo $result["NUMINV"][$i]; ?></td>
  <td class=brd2> <? echo $result["REGZNAK"][$i]; ?></td>
  <td class=brd2> <? echo $result["KODVTRSR"][$i]; ?></td>
  <td class=brd2> <? echo $result["NAMEMODEL"][$i]; ?></td>
  <td class=brd2> <? echo $result["NOMDVIG"][$i]; ?></td>
  <td class=brd2> <? echo $result["DATEZAMDVIG"][$i]; ?></td>
  <td class=brd2> <? echo $result["IDNOMER"][$i]; ?></td>
  <td class=brd2> <? echo $result["GODVIPUSKA"][$i]; ?></td>
  <td class=brd2> <? echo $result["DATEREG"][$i]; ?></td>
  <td class=brd2> <? echo $result["DATESNREG"][$i]; ?></td>
  <td class=brd2> <? echo $result["DATENROZISKA"][$i]; ?></td>
  <td class=brd2> <? echo $result["DATEVOZVRATA"][$i]; ?></td>
  <td class=brd2> <? echo $result["DOCSER"][$i]; ?></td>
  <td class=brd2> <? echo $result["DOCNOMER"][$i]; ?></td>
  <td class=brd2> <? echo $result["MOSKVT"][$i]; ?></td>
  <td class=brd2> <? echo $result["MOSLS"][$i]; ?></td>
  <td class=brd2> <? echo $result["EKOLCLASS"][$i]; ?></td>
  <td class=brd2> <? echo $result["DOLYA"][$i]; ?></td>
  <td class=brd22> <? echo $result["KOLPMESVL"][$i]; ?></td>
  <td class=brd2> <? echo $result["KOEFFICENT"][$i]; ?> </td>
  <td class=brd22> <? echo $result["STAVNAL"][$i]; ?></td>
  <td class=brd22> <? echo $result["ISSUMNAL"][$i]; ?></td>
  <td class=brd2> <? echo $result["KOEFKP"][$i]; ?></td>
  <td class=brd2> <? echo $result["KOEFKL"][$i]; ?></td>
  <td class=brd2> <? echo $result["KODPLATON"][$i]; ?></td>
  <td class=brd22> <? echo $result["SUMPLATON"][$i]; ?></td>
  <td class=brd22> <? echo $result["ISSUMAV"][$i]; ?></td>
  <td class=brd2> <? echo $result["KODIMNS"][$i]; ?></td>
 </tr>
<? } ?>
<tr>
<td class=brd2_1 colspan=24> ИТОГО</td>
<td class=brd2> <? echo $issumnal; ?></td>
<td class=brd2 colspan=4> </td>
<td class=brd2> <? echo $issumav; ?></td>
<td class=brd2> </td>
</tr>

</table>

</body>

</html>

