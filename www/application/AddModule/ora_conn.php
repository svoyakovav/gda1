<?php
	$sid = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = TL-SR-GDD1.kuazot.ru)(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = ITL)))";
	$conn = OCILogon("xx_user", "xx_user2016", $sid, "UTF8");
	if (!$conn) {
	  $err = OCIError();
	  echo $err['message'];
	  die();
	}
?>